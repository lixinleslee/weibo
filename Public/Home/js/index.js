/**
 * Created by rico on 2017/5/6.
 */
$(function () {
    //当图片加载完后，对div高度设置
    // $(window).load(function () {
    //     setHeight();
    // });
    //信息提示框
    $('#inform').dialog({
        width:50,
        height:50,
        autoOpen:false,
        resizable:false,
        closeOnEscape:false,
        modal:true

    }).parent().find('.ui-dialog-titlebar').hide();
    //页面中心区域

    var weiboText = $('.weibo_text');
    var textNum = $('.text_number');
    var reBroadCast = $('#reBroadCast');


    //切换显示列表，【我关注的】、【微博列表】

    //当点击发布按钮时，判断字符输入并作出相应动作
    $('.weibo_button').button().click(function (e) {

        //如果博文和图片都不存在，则提示输入内容
        if ((weiboText.val().length==0) && ($('input[name=imgSrc]').length==0)){
            //提示请输入文本内容
            //alert('请输入内容');
            $('#inform').html('请输入内容...').dialog('open');
            setTimeout(function () {
             $('#inform').html('...').dialog('close');
            },1000)

            //如果只发布图片微博，则自动添加文本为:图片分享
        } else if ((weiboText.val().length==0) && ($('input[name=imgSrc]').length>0)){
            weiboText.val('分享图片');
            setTimeout(function () {
                submitAjax($('input[name=imgSrc]'));
            },500);
        }else {
            if (weibo_num(weiboText,textNum)){
                //AJAX提交数据
                submitAjax($('input[name=imgSrc]'));
            }else {
                //提示输入的字符太长
                alert('内容超出,会自动被截取');
            }
        }
    });
    function setHeight() {
        var mainDiv = $('#main');
        //做板块
        var mainLeftDiv = $('.main_left');
        //有板块
        var mainRightDiv = $('.main_right');
        if(mainLeftDiv.height()>800){
            //有板块和页面基础DIV同时变化
            mainRightDiv.height(mainLeftDiv.height()+10);
            mainDiv.height(mainLeftDiv.height()+30);
        }
    }

    //联动页面大小,当页面自动伸展时，个板块作出相应动作
    setHeight();

    //表情插件
    $('#emotion').qqFace({
        id : 'facebox',
        assign:'saytext',
        path:ThinkPHP['FACE']+'/'	//表情存放的路径

    });
    //发布框的字符处理
    weiboText.on('keyup',function () {
        weibo_num($('.weibo_text'),$('.text_number'));
    });

    //处理输入框字符个数
    /**
     * 字符数统计处理
     * @param obj   //需要统计字符数的jquery对象框
     * @param targetShow   //需要显示文字信息的目标框
     * @returns {boolean}  //如果满足要求返回true，否则返回false
     */
    function weibo_num(obj,targetShow) {
        var length = obj.val().length;
        var total = 280;  //总得输入为280个字节
        var tmp = 0;
        //两字英文字母的大小等于一个汉字的大小等于一个字符
        if (length>0){
            for(var i=0;i<length;i++){
                //判断输入的字符的ASCII编码是否大于255，是则表示为非字母
                if (obj.val().charCodeAt(i)>255){
                    tmp +=2;
                }else {
                    tmp ++;
                }

            }
            var result = parseInt((total-tmp)/2-0.5);
            if (result>=0){
                targetShow.html('您还可以输入'+result+'个字');
                return true;
            }else {
                targetShow.html('<strong style="color: red">您已超过'+Math.abs(result)+'个字</strong>');
                return false;
            }
        }
    }

    //AJAX
    function submitAjax(images) {
        var informDiv = $('#inform');
        //处理所有图片的URL
        var srcs=[];
        images.each(function (index) {
            //删除多余的success键值对
            var tmp = $.parseJSON($(images[index]).val());
            $.each(tmp,function (_key) {
                if (_key=='success'){
                    delete tmp[_key];
                }
            });
            tmp = JSON.stringify(tmp);
           srcs.push(tmp);
        });
        //alert(srcs);

        $.ajax({
            url:ThinkPHP['MODULE']+'/Topic/publish',
            type:'POST',
            data:{
                content:weiboText.val(),
                images:srcs,
            },
            beforeSend:function () {
                //打开loading框
                $('#inform').dialog('open');
                //清空图片地址保存input
                $('.formDiv').find('input[name=imgSrc]').each(function (index) {
                    $(this).remove();
                });
                //关闭图片上传插件
                $('.formDiv').find('#imgbox').remove();
            },
            success:function (data,response,status) {
                //alert(data);
                if (parseInt(data)>0){
                    //发布成功
                    //返回成功时，提示成功并关闭对话框和重置输入框
                    informDiv.find('p').removeClass('inform_default').addClass('inform_success').find('span').html('发布成功...');
                    //alert($('.pt_ul').height());
                    //AJAX无刷新
                    var html = '';
                    switch (images.length){
                        case 0:
                            html = $('#ajax_div_none').html();
                            //alert(html);
                            break;
                        case 1:
                            html = $('#ajax_div_one').html();
                            //alert(html);
                            break;
                        default:
                            html = $('#ajax_div_mutil').html();
                            //alert(html);
                            break;
                    }
                    //alert(typeof html1.indexOf('#content#'));
                    if (html.indexOf('#内容#')>0){
                        //alert('大于0');
                        //@用户名解析
                        var content =weiboText.val()+' ';
                        content = content.replace(/(@)(\S+\s)/g,'<a target="_blank" href="" class="atusername">$1$2</a>');
                        html = html.replace(/#内容#/g,content);
                        //替换表情
                        html = html.replace(/\[em_(\d{0,2})+\]/g,'<img src="'+ThinkPHP["FACE"]+'/$1.gif"/>');

                    }
                    //微博ID替换
                    if (html.indexOf('#原始ID#')>0){
                        //alert('ID');
                        html = html.replace(/#原始ID#/g,data);
                    }
                    if (html.indexOf('#Current_WB_ID#')>0){
                        //alert('ID');
                        html = html.replace(/#Current_WB_ID#/g,data);
                    }
                    if (html.indexOf('#删除微博#')>0){
                        var tmp = '<span class="subinfo_rgt Su_border weibo_del_span"><em class="weibo_del">删除</em></span>';
                        html = html.replace(/#删除微博#/g,tmp);
                    }
                    //单图替换
                    if (html.indexOf('#图片#')>0){
                        html = html.replace(/#图片#/g,$.parseJSON(images.val())['show']);
                        html = html.replace(/#中图#/g,$.parseJSON(images.val())['middle']);
                        html = html.replace(/#大图#/g,$.parseJSON(images.val())['source']);
                    }
                    //多图替换
                    if (html.indexOf('#多图#')>0){
                        var imgs='';
                        var mutilImgSmallStr = '<div class="mutilImgSmall" >';
                        var mutilImgSmallEnd = '</div>';
                        var mutilImgSmallLi = '';
                        var mutilImgBigStar = '<div class="mutilImgBig" style="display: none;">'+
                                                    '<div class="tag">'+
                                                        '<ul class="tag_ul">'+
                                                            '<li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>'+
                                                            '<li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>'+
                                                        '</ul>'+
                                                    '</div>'+
                                                    '<div class="bigImg">'+
                                                        '<li class="mutilBig_li"><img src="" alt="" class="piccut_v piccut_h"></li>'+
                                                    '</div>'+
                                                    '<div class="smallest">';
                        var mutilImgBigEnd = '</div></div>';
                        var mutiImgBigLi = '';
                        //alert();
                        for (var i=0;i<images.length;i++){
                            var tmpShow = $.parseJSON($(images[i]).val())['show'];
                            var tmpSmallest = $.parseJSON($(images[i]).val())['s'];
                            var tmpMiddle = $.parseJSON($(images[i]).val())['middle'];
                            var tempBig = $.parseJSON($(images[i]).val())['source'];
                            //alert(tmp);
                            //imgs += '<li class="unlog_pic"><img src="'+ThinkPHP['ROOT']+'/'+tmpShow+'" alt="" class="piccut_v piccut_h"></li>';
                            mutilImgSmallLi +='<li class="unlog_pic" rel="'+i+'"><img src="'+ThinkPHP['ROOT']+'/'+tmpShow+'" alt="" class="piccut_v piccut_h showImg"></li>';
                            mutiImgBigLi +='<li class="mutilImg_s" rel="'+i+'"><img src="'+ThinkPHP['ROOT']+'/'+tmpSmallest+'" control-data="'+ThinkPHP['ROOT']+'/'+tmpMiddle+'" source-data="'+ThinkPHP['ROOT']+'/'+tempBig+'" alt="" class="piccut_v piccut_h" ></li>';
                        }
                        imgs = mutilImgSmallStr + mutilImgSmallLi +mutilImgSmallEnd + mutilImgBigStar + mutiImgBigLi + mutilImgBigEnd;

                        //alert(imgs);
                        //将图片添加进hml
                        html = html.replace(/#多图#/g,imgs);
                    }
                    //延迟500ms在执行
                    setTimeout(function () {
                        informDiv.find('p').removeClass('inform_success').find('span').html('数据提交中...');
                        informDiv.dialog('close');
                        $('.weibo_text').val('');
                        //alert(html);
                        $('.weibo_content .content_list .pt_ul').prepend(html);

                        setTimeout(function () {
                            AtUserName();
                            // reBroadCastFun();
                            // reBroadCastFun_2();
                        },500);
                        setHeight();

                    },500);

                }else {
                    //发布失败失败时
                    informDiv.find('p').removeClass('inform_default inform_success').addClass('inform_fail').find('span').html('发布失败...');
                    //延迟500ms再执行
                    setTimeout(function () {
                        informDiv.find('p').removeClass('inform_fail').addClass('inform_default').find('span').html('数据提交...');
                        informDiv.dialog('close');
                    },500);
                }
            },
        })

    }

    /**
     * 单图放大缩小操作
     */
    //图片缩小
    $('.weibo_content').on('click','.content_list .oneImagBig .oneImagBig .piccut_v',function () {
        $(this).parent().parent().parent().prev('.oneImagSmall').css('display','block');
        $(this).parent().parent().parent().css('display','none');
        setHeight();

    });

    //点击收起按钮，缩小图片
    $('.weibo_content').on('click','.content_list .oneImagBig .A_zoom_out',function () {
        $(this).parent().parent().parent().parent().parent().prev('.oneImagSmall').css('display','block');
        $(this).parent().parent().parent().parent().parent().css('display','none');
        setHeight();
        //$(this).parent().parent().css('display','none');
    });

    //点击查看原图
    //点击收起按钮，缩小图片
    $('.weibo_content').on('click','.oneImagBig .A_zoom_in',function () {
        var sourceImgSrc = $(this).attr('control-data');
        //加载原图
        $(this).attr('href',sourceImgSrc);
        $(this).parent().parent().parent().parent().parent().prev('.oneImagSmall').css('display','block');
        $(this).parent().parent().parent().parent().parent().css('display','none');
        setHeight();
        //$(this).parent().parent().css('display','none');
    });

    //图片放大
    $('.weibo_content').on('click','.oneImagSmall .piccut_v',function () {
        var middleImgSrc = $(this).parent().parent().parent().find('.img').find('.piccut_v').attr('control-data');
        $(this).parent().parent().parent().find('.img').find('.piccut_v').attr('src',middleImgSrc);  //在点击查看时才进行图片的加载
        $(this).parent().parent().next('.oneImagBig').css('display','block');
        $(this).parent().parent().css('display','none');
        setHeight();
    });

    /**
     * 多图放大缩小
     */
    //放大
    $('.weibo_content').on('click','.mutilImgSmall .piccut_v',function () {
        //需要放大的图片编号
        var currentRel=$(this).parent().attr('rel');
        //需要放大的图片URL
        var currentSourceSrc = $(this).parent().parent().parent().find('.mutilImgBig').find('.smallest').find('.mutilImg_s[rel='+currentRel+']').find('.piccut_v').attr('control-data');
        //原图URL
        var SourceSrc = $(this).parent().parent().parent().find('.mutilImgBig').find('.smallest').find('.mutilImg_s[rel='+currentRel+']').find('.piccut_v').attr('source-data');
        //alert(SourceSrc);
        //清空缩略图样式
        $(this).parent().parent().parent().find('.mutilImgBig').find('.smallest').find('.mutilImg_s').each(function () {
            $(this).css({
                background:'#f0f0fa',
            });
        });
        //给选中的缩略图添加样式
        $(this).parent().parent().parent().find('.mutilImgBig').find('.smallest').find('.mutilImg_s[rel='+currentRel+']').css({
            background:'#CC2222',
        });
        //大图URL赋值
        $(this).parent().parent().parent().find('.mutilImgBig .bigImg').find('.piccut_v').attr('src',currentSourceSrc);
        //原始图URL处理
        $(this).parent().parent().parent().find('.mutilImgBig .tag').find('.A_zoom_in').attr('control-data',SourceSrc);
        //显示大图
        $(this).parent().parent().parent().find('.mutilImgBig').css('display','block');
        //隐藏小图
        $(this).parent().parent().css('display','none');
        setHeight();
    });
    //点击下方的缩略图
    $('.weibo_content').on('click','.mutilImgBig .smallest .piccut_v',function () {
        //需要放大的图片URL
        var currentSourceSrc = $(this).attr('control-data');
        //原始图URL
        var sourceUrl = $(this).attr('source-data');
        //alert(currentSourceSrc);
        //大图URL赋值
        $(this).parent().parent().prev('.bigImg').find('.piccut_v').attr('src',currentSourceSrc);
        //原始图URL处理
        $(this).parent().parent().prev('.bigImg').prev('.tag').find('.A_zoom_in').attr('control-data',sourceUrl);
        //清除CSS样式
        var currentLi = $(this).parent().attr('rel');
        $(this).parent().parent().find('.mutilImg_s').each(function () {
                $(this).css({
                    background:'#f0f0fa',
                });
        });
        //将选中的预览框添加选中样式
        $(this).parent().css('background','#CC2222');
        setHeight();
    });

    //点击图片缩小
    $('.weibo_content').on('click','.mutilImgBig .bigImg .piccut_v',function () {
        //显示小图
        $(this).parent().parent().parent().prev('.mutilImgSmall').css('display','block');
        //隐藏大图显示
        $(this).parent().parent().parent().css('display','none');
        setHeight();
    });

    //点击收起按钮缩小
    $('.weibo_content').on('click','.mutilImgBig .tag .A_zoom_out',function () {
        //显示小图
        $(this).parent().parent().parent().parent().parent().prev('.mutilImgSmall').css('display','block');
        //隐藏大图显示
        $(this).parent().parent().parent().parent().parent().css('display','none');
        setHeight();
    });

    //查看原图
    $('.weibo_content').on('click','.mutilImgBig .tag .A_zoom_in',function () {
        var sourceSrc = $(this).attr('control-data');
        $(this).attr('href',sourceSrc);
    });



    /**
     *
     * @type {boolean}
     */

    // $.ajax({
    //     url:ThinkPHP['MODULE']+'/Topic/ajaxDefaultTotalPage',
    //     type:'POST',
    //     data:{
    //
    //     },
    //     success:function (data,response,status) {
    //         //添加数据
    //         //$('#loadMore').before(data);
    //         totalPage = parseInt(data);   //总页码
    //         //alert(data);
    //     }
    //
    // });

    /**
     * 获取总页码数，并保存在totalPage属性节点
     * @param type
     */
    function getTotalPage(type) {
        var url='';
        var totalPage=1;   //初始化页码
        switch (type){
            case '0':
                url=ThinkPHP['MODULE']+'/Topic/ajaxDefaultTotalPage';     //默认类型总页码
                break;
            case '1':
                url=ThinkPHP['MODULE']+'/Topic/ajaxConcentratedTotalPage'; //我关注的好友微博总页码
                break;
            case '2':
                url=ThinkPHP['MODULE']+'/Topic/ajaxDefaultTotalPage';
                break;
            default:
                url=ThinkPHP['MODULE']+'/Topic/ajaxDefaultTotalPage';
        }
        //AJAX获取总页码数
        $.ajax({
            url:url,
            type:'POST',
            data:{

            },
            success:function (data,response,status) {
                totalPage = parseInt(data);
                $('.pt_ul').attr('totalPage',totalPage);
                $('.pt_ul').attr('next-page','2');
            }

        });
    }

    //分类处理【微博列表】、【我关注的】、【互听的】
    //默认将last-type赋值为0，即默认加载【微博列表】

    var loading = ThinkPHP['IMG']+'/load_more_1.gif';
    $('#main .weibo_content .weibo_content_ul').attr('last-type','0');
    //默认加载微博列表总页码
    getTotalPage($('.pt_ul').attr('totalPage'));
    $('.content_list .pt_ul').attr('next-page','2'); //初始化next-page
    //$('.content_list .pt_ul').attr('page','2'); //初始化next-page
    $('#main').on('mouseover','.main_left .weibo_content .weibo_content_ul li',function () {
        //初始化page参数
        //当鼠标悬停时，加载对于模块的微博内容
        $(this).parent().find('.type').removeClass('selected');
        $(this).find('.type').addClass('selected');
        var type = $(this).attr('rel');
        var lastTtpe = $(this).parent().attr('last-type');
        var liThis=this;
        var weibo_submit = $('#weibo_submit');
        var url='';
        //加载中
        var loadMore = $('#loadMore');

        //为确保发布的微博是在微博列表中，需要按不同类型进来关闭和打开按钮
        switch (type){
            case "0":   //获取默认列表
                url=ThinkPHP['MODULE']+'/Topic/ajaxGetDefault';
                weibo_submit.removeAttr('disabled');
                //打开发布按钮
                break;
            case "1":  //获取我关注的列表
                url=ThinkPHP['MODULE']+'/Topic/ajaxGetConcentrated';
                //关闭发布按钮
                weibo_submit.attr('disabled','disabled');
                break;
            case "2":  //获取互听的列表
                url=ThinkPHP['MODULE']+'/Topic/ajaxGetDefault';
                weibo_submit.attr('disabled','disabled');
                break;
            default:  //获取默认列表
                url=ThinkPHP['MODULE']+'/Topic/ajaxGetDefault';
        }
        //本次悬停和上次悬停的节点一致时，不再执行加载
        if (lastTtpe==type){
            //当下一页小于等于总页码数时，显示“点击加载更多”，否则显示没有更多数据
            // if(){
            //
            // }
            loadMore.find('.loading').attr('src','');
            loadMore.find('.text').html('点击加载更多');
            return;
        }else {
            $(this).parent().attr('last-type',type);
            //保存page
            //$(this).parent().parent().find('.content_list').find('.pt_ul').attr('page',2);
            $(this).parent().parent().find('.content_list').find('.pt_ul').attr('next-page',2);
            getTotalPage(type);

            $.ajax({
                url:url,
                type:'POST',
                data:{

                },
                beforeSend:function () {
                    $(liThis).parent().parent().find('.pt_ul').find('li').remove();
                    loadMore.find('.loading').attr('src',loading);
                    loadMore.find('.text').html('加载中');
                },
                success:function (data,response,status) {
                    //添加数据
                    //$('#loadMore').before(data);
                    $(liThis).parent().parent().find('.pt_ul').prepend(data);

                },
                complete:function (jqXHR) {
                    loadMore.find('.loading').attr('src','');
                    loadMore.find('.text').html('点击加载更多');
                    setHeight();
                }
            });

        }



    });


    //点击加载更多,根据类型不同，加载的项不同
    $('#loadMore').on('click',function () {
        var pt_ul = $(this).parent().find('.pt_ul');
        var loadPage=parseInt(pt_ul.attr('next-page'));
        var loadStart = (loadPage-1)*ThinkPHP['TOPIC_SHOW_NUM'];  //起始加载
        var type = $('.weibo_content_ul').attr('last-type');
        var LoadThis = this;
        var loading = ThinkPHP['IMG']+'/load_more_1.gif';
        var loadMore = $(this);
        var url='';
        var totalPage = parseInt($('.content_list').find('.pt_ul').attr('totalPage'));

        switch (type){
            case "0":   //获取默认列表
                url=ThinkPHP['MODULE']+'/Topic/ajaxLoad';
                break;
            case "1":  //获取我关注的列表
                url=ThinkPHP['MODULE']+'/Topic/ajaxGetConcentrated';
                break;
            case "2":  //获取互听的列表
                url=ThinkPHP['MODULE']+'/Topic/ajaxGetDefault';
                break;
            default:  //获取默认列表
                url=ThinkPHP['MODULE']+'/Topic/ajaxLoad';
        }
        if (loadPage<=totalPage){
            //loadMore.html('点击加载更多');
                    setTimeout(function () {
                        //AJAX加载
                        $.ajax({
                            url:url,
                            type:'POST',
                            data:{
                                'start':loadStart
                            },
                            beforeSend:function () {
                                loadMore.find('.loading').attr('src',loading);
                                loadMore.find('.text').html('加载中');
                            },
                            success:function (data,response,status) {
                                //添加数据
                                //$('#loadMore').before(data);
                                if(data){
                                    $(LoadThis).parent().find('.pt_ul').append(data);
                                }else {

                                }


                            },
                            complete:function (jqXHR) {
                                loadMore.find('.loading').attr('src','');
                                loadMore.find('.text').html('点击加载更多');
                                pt_ul.attr('next-page',(loadPage+1));
                                setHeight();
                            }

                        });

                        setTimeout(function () {
                            AtUserName();
                            reBroadCastFun();
                            reBroadCastFun_2();
                        },500);
                    },500);
        }else {
            loadMore.find('.loading').attr('src','');
            loadMore.find('.text').html('没有更多数据');
        }
    });

    // $(window).scroll(function () {
    //     if (loadPage<=totalPage){
    //         //当鼠标滑动到加载可视区时执行AJAX请求，获取新数据
    //         if($(window).scrollTop()>=($('#loadMore').offset().top+$('#loadMore').outerHeight()-$(window).height()-20)){
    //             if (window.scrollFlat){
    //                 // alert(totalPage);
    //                 //延迟执行
    //                 setTimeout(function () {
    //                     //console.log($('#loadMore').offset().top+$('#loadMore').outerHeight()-$(window).height());
    //                     //AJAX加载
    //
    //                     $.ajax({
    //                         url:ThinkPHP['MODULE']+'/Topic/ajaxLoad',
    //                         type:'POST',
    //                         data:{
    //                             'start':loadStart
    //                         },
    //                         success:function (data,response,status) {
    //                             //添加数据
    //                             $('#loadMore').before(data);
    //                         }
    //
    //                     });
    //                     //重置标志位
    //                     window.scrollFlat = true;
    //                     loadPage +=1;
    //                     loadStart = (loadPage-1)*ThinkPHP['TOPIC_SHOW_NUM'];
    //
    //                     setTimeout(function () {
    //                         AtUserName();
    //                         reBroadCastFun();
    //                         reBroadCastFun_2();
    //                     },500);
    //                     setHeight();
    //                 },500);
    //                 // setTimeout(function () {
    //                 //     alert($('.pt_ul').height());
    //                 // },500)
    //
    //             }
    //             window.scrollFlat = false;
    //         }
    //
    //     }else {
    //         $('#loadMore').html('没有更多数据');
    //     }
    //
    // });

    AtUserName();
    //处理@账号后，处理超链接
    function AtUserName() {
        var atUserName = $('.atusername');
        // $('.at').each(function (index) {
        //alert(atUserName.length);
        for(var i =0; i<atUserName.length;i++){

            var username = atUserName.eq(i).text().substr(1);
            //alert(username);
            //AJAX处理
            if (!atUserName.eq(i).attr('href')){
                $.ajax({
                    url:ThinkPHP['MODULE']+'/User/ajaxGetUserByName',
                    type:'POST',
                    async:false,
                    data:{
                        username:username,
                    },
                    success:function (data,response,status) {
                        if (data){
                            //用户名存在
                            atUserName.eq(i).attr('href',data);
                            atUserName.eq(i).attr('data-control',true);
                        }else {
                            //用户名不存在
                            //删除超链接
                            //alert(typeof $('.at').eq(index));
                            //atUserName.eq(i).remove();
                            atUserName.eq(i).attr('href','javascript:;');
                        }
                    }


                });
            }

        }

    }

    //创建转发框
    reBroadCast.dialog({
        autoOpen:false,
        width:600,
        height:290,
        resizable:false,
        title:'微博转发',
        modal:true,
        buttons:{
            '转发':function () {
                var informDiv = $('#inform');
                //alert();
                var reId =$(this).parent().find('#reBroadCast').find('.reBroadId').val();
                var reId_2 =$(this).parent().find('#reBroadCast').find('.reBroadId_2').val();
                var reContent =$(this).parent().find('#reBroadCast').find('.reBroadArea').val();  //转发者输入的内容
                //alert(reId);
                if (reContent==''){
                    reContent = '微博分享';
                }
                    $.ajax({
                        url:ThinkPHP['MODULE']+'/Topic/reBroadCast',
                        type:'POST',
                        //async:false,
                        data:{
                            reId:reId,
                            reId_2:reId_2,
                            reContent:reContent
                        },
                        beforeSend:function () {
                            //置灰提交按钮
                            reBroadCast.dialog('widget').find('button').eq(1).button('disable');
                            //打开loading框
                            informDiv.dialog('open');
                            informDiv.find('p').removeClass('inform_fail').addClass('inform_default').find('span').html('转发中...');
                        },
                        success:function (data,response,status) {
                            //转发完成
                            var sourceObj = $.parseJSON(data)['sContent'];
                            var newId = $.parseJSON(data)['newId'];
                            //alert(sourceObj);
                            //alert(sourceObj['images'].length);
                            if (parseInt(newId)>0){
                                var html = '';

                                html = $('#ajax_div_share').html();

                                //alert(typeof html1.indexOf('#content#'));
                                if (html.indexOf('#新微博内容#')>0){
                                    //alert('大于0');
                                    //alert(reContent);
                                    //@账号解析
                                    var content = reContent+' ';
                                    content = content.replace(/(@)(\S+\s)/g,'<a href="" class="atusername">$1$2</a>');
                                    html = html.replace(/#新微博内容#/g,content);
                                    //替换表情
                                    html = html.replace(/\[em_(\d{0,2})+\]/g,'<img src="'+ThinkPHP["FACE"]+'/$1.gif"/>');
                                    //alert(html);
                                }

                                if (html.indexOf('#Current_WB_ID#')>0){
                                    //alert('ID');
                                    html = html.replace(/#Current_WB_ID#/g,newId);
                                }

                                if (html.indexOf('#新微博ID#')>0){
                                    //alert('ID');
                                    html = html.replace(/#新微博ID#/g,newId);
                                }
                                //微博ID替换
                                if (html.indexOf('#原始ID#')>0){
                                    //alert('ID');
                                    html = html.replace(/#原始ID#/g,sourceObj['id']);
                                }
                                //原始微博内容替换
                                if (html.indexOf('#原始微博内容#')>0){
                                    //alert('ID');
                                    var content = '';
                                    if (sourceObj['content_over']){
                                        content = sourceObj['content']+sourceObj['content_over'] +' ';
                                        content = content.replace(/(@)(\S+\s)/g,'<a target="_blank" href="" class="atusername">$1$2</a>');
                                        html = html.replace(/#原始微博内容#/g,content);
                                    }else {
                                        content = sourceObj['content']+' ';
                                        content = content.replace(/(@)(\S+\s)/g,'<a href="" class="atusername">$1$2</a>');
                                        html = html.replace(/#原始微博内容#/g,content);
                                    }

                                    //表情解析
                                    html = html.replace(/\[em_(\d{0,2})+\]/g,'<img src="'+ThinkPHP["FACE"]+'/$1.gif"/>');
                                }
                                //原作者个人链接
                                if (html.indexOf('#原作者个人链接#')>0){
                                    //如果个人域名存在，则用域名链接方式，否则用id链接方式
                                    if(sourceObj['domain']){
                                        html = html.replace(/#原作者个人链接#/g,ThinkPHP['ROOT']+'/i/'+sourceObj['domain']+'');
                                    }else {
                                        html = html.replace(/#原作者个人链接#/g,'{:U("Space/Index",array("id"=>'+sourceObj["id"]+'))');
                                    }
                                }
                                //原作者个人头像
                                if (html.indexOf('#原作者头像#')>0){
                                    //如果头像存在则替换，否则采用默认样式
                                    if(sourceObj['face']){
                                        html = html.replace(/#原作者头像#/g,ThinkPHP['ROOT']+'/'+sourceObj['face']+'');
                                    }else {
                                        html = html.replace(/#原作者头像#/g,ThinkPHP['IMG']+'/small.gif');
                                    }
                                }
                                //原作者名称
                                if (html.indexOf('#原作者名称#')>0){
                                    //替换作者名称
                                        html = html.replace(/#原作者名称#/g,sourceObj['username']);
                                }
                                //原作者名称
                                if (html.indexOf('#原微博发布时间#')>0){
                                    //替换作者名称
                                    html = html.replace(/#原微博发布时间#/g,sourceObj['time']);
                                }

                                //原作者名称
                                if (html.indexOf('#原始微博点赞次数#')>0){
                                    //替换作者名称
                                    html = html.replace(/#原始微博点赞次数#/g,sourceObj['recommend']);
                                }
                                //原作者名称
                                if (html.indexOf('#原始微博评论次数#')>0){
                                    //替换作者名称
                                    html = html.replace(/#原始微博评论次数#/g,sourceObj['comment']);
                                }
                                //原作者名称
                                if (html.indexOf('#原始微博分享次数#')>0){
                                    //替换作者名称
                                    html = html.replace(/#原始微博分享次数#/g,sourceObj['broadcount']);
                                }

                                //图片替换
                                if (html.indexOf('#原微博图片内容#')>0){
                                    //无图
                                    if(parseInt(sourceObj['count'])==0){
                                        html = html.replace(/#原微博图片内容#/g,'');
                                    }else if (parseInt(sourceObj['count'])==1){   //单图替换
                                        var imgContent = '<div class="oneImagSmall">'+
                                                                '<li class="unlog_pic"><img src="'+ThinkPHP['ROOT']+'/'+sourceObj['images'][0]['show']+'" alt="" class="piccut_v piccut_h"></li>'+
                                                          '</div>'+
                                                          '<div class="oneImagBig" style="display: none">'+
                                                            '<div class="tag">'+
                                                                '<ul class="tag_ul">'+
                                                                    '<li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>'+
                                                                    '<li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="'+ThinkPHP['ROOT']+'/'+sourceObj['images'][0]['source']+'" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>'+
                                                                '</ul>'+
                                                            '</div>'+
                                                            '<div class="img">'+
                                                                '<li class="oneImagBig"><img src="" control-data="'+ThinkPHP['ROOT']+'/'+sourceObj['images'][0]['middle']+'" alt="" class="piccut_v piccut_h"></li>'+
                                                            '</div>'+
                                                          '</div>';

                                        html = html.replace(/#原微博图片内容#/g,imgContent);
                                    }else {   //多图替换
                                        var mutilImgSmallStr = '<div class="mutilImgSmall" >';
                                        var mutilImgSmallEndRepeat = '';
                                        var mutilImgSmallEnd = '</div>';
                                        var mutilImgBigStr = '<div class="mutilImgBig" style="display: none;">'+
                                                                '<div class="tag">'+
                                                                    '<ul class="tag_ul">'+
                                                                        '<li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>'+
                                                                        '<li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>'+
                                                                    '</ul>'+
                                                                '</div>'+
                                                                '<div class="bigImg">'+
                                                                    '<li class="mutilBig_li"><img src="" alt="" class="piccut_v piccut_h"></li>'+
                                                                '</div>'+
                                                                '<div class="smallest">';
                                        var mutilImgBigRepeat='';
                                        var mutilImgBigEnd = '</div></div>';

                                        for (var i =0; i<parseInt(sourceObj['count']);i++){
                                            mutilImgSmallEndRepeat += '<li class="unlog_pic" rel="'+i+'"><img src="'+ThinkPHP['ROOT']+'/'+sourceObj['images'][i]['show']+'" alt="" class="piccut_v piccut_h"></li>'
                                            mutilImgBigRepeat += '<li class="mutilImg_s" rel="'+i+'"><img src="'+ThinkPHP['ROOT']+'/'+sourceObj['images'][i]['s']+'" control-data="'+ThinkPHP['ROOT']+'/'+sourceObj['images'][i]['middle']+'" source-data="'+ThinkPHP['ROOT']+'/'+sourceObj['images'][i]['source']+'" alt="" class="piccut_v piccut_h" ></li>'
                                        }
                                        var mutilImgContent = mutilImgSmallStr+mutilImgSmallEndRepeat+mutilImgSmallEnd+mutilImgBigStr+mutilImgBigRepeat+mutilImgBigEnd;

                                        html = html.replace(/#原微博图片内容#/g,mutilImgContent);


                                    }

                                }
                                //alert(html);

                                // //多图替换
                                // if (html.indexOf('#多图#')>0){
                                //     var imgs='';
                                //     var mutilImgSmallStr = '<div class="mutilImgSmall" >';
                                //     var mutilImgSmallEnd = '</div>';
                                //     var mutilImgSmallLi = '';
                                //     var mutilImgBigStar = '<div class="mutilImgBig" style="display: none;">'+
                                //         '<div class="tag">'+
                                //         '<ul class="tag_ul">'+
                                //         '<li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>'+
                                //         '<li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>'+
                                //         '</ul>'+
                                //         '</div>'+
                                //         '<div class="bigImg">'+
                                //         '<li class="mutilBig_li"><img src="" alt="" class="piccut_v piccut_h"></li>'+
                                //         '</div>'+
                                //         '<div class="smallest">';
                                //     var mutilImgBigEnd = '</div></div>';
                                //     var mutiImgBigLi = '';
                                //     //alert();
                                //     for (var i=0;i<images.length;i++){
                                //         var tmpShow = $.parseJSON($(images[i]).val())['show'];
                                //         var tmpSmallest = $.parseJSON($(images[i]).val())['s'];
                                //         var tmpMiddle = $.parseJSON($(images[i]).val())['middle'];
                                //         var tempBig = $.parseJSON($(images[i]).val())['source'];
                                //         //alert(tmp);
                                //         //imgs += '<li class="unlog_pic"><img src="'+ThinkPHP['ROOT']+'/'+tmpShow+'" alt="" class="piccut_v piccut_h"></li>';
                                //         mutilImgSmallLi +='<li class="unlog_pic" rel="'+i+'"><img src="'+ThinkPHP['ROOT']+'/'+tmpShow+'" alt="" class="piccut_v piccut_h"></li>';
                                //         mutiImgBigLi +='<li class="mutilImg_s" rel="'+i+'"><img src="'+ThinkPHP['ROOT']+'/'+tmpSmallest+'" control-data="'+ThinkPHP['ROOT']+'/'+tmpMiddle+'" source-data="'+ThinkPHP['ROOT']+'/'+tempBig+'" alt="" class="piccut_v piccut_h" ></li>';
                                //     }
                                //     imgs = mutilImgSmallStr + mutilImgSmallLi +mutilImgSmallEnd + mutilImgBigStar + mutiImgBigLi + mutilImgBigEnd;
                                //
                                //     //alert(imgs);
                                //     //将图片添加进hml
                                //     html = html.replace(/#多图#/g,imgs);
                                // }
                                //alert(html);
                                informDiv.find('p').removeClass('inform_default').addClass('inform_success').find('span').html('转发成功...');
                                setTimeout(function () {
                                    informDiv.find('p').removeClass('inform_success').find('span').html('数据提交中...');
                                    informDiv.dialog('close');
                                    $('#reBroadCast').find('.reBroadArea').val('');
                                    reBroadCast.dialog('widget').find('button').eq(1).button('enable');
                                    reBroadCast.dialog('close');
                                    // $('.weibo_text').val('');
                                    // //alert(html);
                                    $('.weibo_content .content_list .pt_ul').prepend(html);

                                    setTimeout(function () {
                                        AtUserName();
                                        //reBroadCastFun();
                                        //reBroadCastFun_2();
                                    },500);
                                },500);
                            }else {
                                //发布失败失败时
                                informDiv.find('p').removeClass('inform_default inform_success').addClass('inform_fail').find('span').html('转发失败...');
                                //延迟500ms再执行
                                setTimeout(function () {
                                    informDiv.find('p').removeClass('inform_fail').addClass('inform_default').find('span').html('数据提交...');
                                    informDiv.dialog('close');
                                    reBroadCast.dialog('widget').find('button').eq(1).button('enable');
                                },500);
                            }
                        }
                    });

            }
        }
    });

    reBroadCastFun();
    reBroadCastFun_2();
    //转发原始微博
    function reBroadCastFun() {
        $('.weibo_content ').each(function (index) {

                $(this).on('click','.pt_li .share',function () {
                    //alert('');
                    var reId = $(this).parent().parent().find('.reBroadId').val();
                    var sourceAuthorHref=$(this).parent().find('a').eq(1).attr('href');
                    var sourceAuthor=$(this).parent().find('a').eq(1).text();
                    reBroadCast.dialog('open');
                    $('#reBroadCast').find('.reBroadId').val(reId);
                    $('#reBroadCast').find('.reBroadId_2').val('');
                    $('#reBroadCast').find('.reBroadSourceTitle').attr('href',sourceAuthorHref);
                    $('#reBroadCast').find('.sourceAuthor').attr('href',sourceAuthorHref);
                    $('#reBroadCast').find('.sourceAuthor').text(sourceAuthor);
                    $('#reBroadCast').find('.reBroadArea').val('');
                });

            //var reBroadContent = $('#reBroadCast').find('.reBroadArea').val();

        });
    }

    //处理转发样式按钮时，分享转发人微博
    function reBroadCastFun_2() {
        $('.weibo_content ').each(function (index) {

                $(this).on('click','.pt_li .share_2',function () {
                    var reId = $(this).parent().parent().find('.reBroadId').val();
                    var reId_2 = $(this).parent().parent().find('.reBroadId_2').val();
                    var sourceAuthorHref=$(this).parent().parent().find('.subinfo_box').eq(0).find('a').eq(1).attr('href');
                    var sourceAuthor=$(this).parent().parent().find('.subinfo_box').eq(0).find('a').eq(1).text();
                    var reBrodAuthor = $(this).parent().parent().find('.subinfo_box').eq(1).find('a').eq(1).text();
                    var BroadContent = $(this).parent().parent().find('#BroadContent').text();
                    var reBrodContent = '//'+reBrodAuthor+' '+$.trim(BroadContent);
                    reBroadCast.dialog('open');
                    $('#reBroadCast').find('.reBroadArea').val('');  //初始化
                    $('#reBroadCast').find('.reBroadId').val(reId);  //原始微博ID
                    $('#reBroadCast').find('.reBroadId_2').val(reId_2);  //转发者微博ID
                    $('#reBroadCast').find('.reBroadSourceTitle').attr('href',sourceAuthorHref);
                    $('#reBroadCast').find('.sourceAuthor').attr('href',sourceAuthorHref);
                    $('#reBroadCast').find('.sourceAuthor').text(sourceAuthor);
                    $('#reBroadCast').find('.reBroadArea').val(reBrodContent);
                });

            //var reBroadContent = $('#reBroadCast').find('.reBroadArea').val();

        });
    }

    //评论
    var showNum=ThinkPHP['COMMENT_SHOW_NUM'];     //每页显示条数
    var PageDiv = ThinkPHP['PAGE_DIV'];
    //打开评论框
     $('.weibo_content ').on('click','.pt_li .info_box .subinfo_box .commed_trigger',function () {
         $(this).parent().parent().parent().find('.commend_div').find('.commend_button').button();
         //加载评论选项
         var showPageRepeat='';
         var totalCommentPage='';
         //alert('');
         var commentTotal = parseInt($(this).find('.comment_num').text());
         totalCommentPage = Math.ceil(commentTotal/showNum);
         if (totalCommentPage>1){  //大于一页才显示,并且第一页为选定状态
                 showPageRepeat +='<span class="page_span"><a href="javascript:;" page="1" class="page_data selected">'+1+'</a></span>';
                if (totalCommentPage<5){
                    for (var i=1;i<totalCommentPage;i++){
                        showPageRepeat +='<span class="page_span"><a href="javascript:;" page="'+(i+1)+'" class="page_data">'+(i+1)+'</a></span>';
                    }
                }else {
                    //大于4页时，显示123...最后一页
                    for (var j=1;j<4;j++){
                        showPageRepeat +='<span class="page_span"><a href="javascript:;" page="'+(j+1)+'" class="page_data">'+(j+1)+'</a></span>';
                    }
                    showPageRepeat +='<span class="page_span disable">...</span>';
                    showPageRepeat +='<span class="page_span"><a href="javascript:;" page="'+totalCommentPage+'" class="page_data">'+totalCommentPage+'</a></span>';
                }

             }
             //alert(showPageRepeat);
             var totalPageObj =$(this).parent().parent().parent().find('.commend_div').find('.totalPage');
             var current_weibo_id = $(this).parent().parent().parent().find('.commend_div').find('.current_weibo_id').val();
             var comment_div = $(this).parent().parent().parent().find('.commend_div');
             if($(this).parent().parent().next('.commend_div').is(':hidden')){
                 $('.weibo_content .content_list .pt_ul .pt_li .commend_div').each(function (index) {
                     $(this).hide();
                     //清空评论框内容
                     $(this).find('.commend_text').find('.commend_content').val('');
                     //删除表情赋值ID
                     $(this).find('.commend_text').find('.commend_content').attr('id','');
                 });
                 $(this).parent().parent().next('.commend_div').show();
                 $(this).parent().parent().next('.commend_div').find('.commend_text').find('.commend_content').attr('id','saytext_2');
                 //alert(qqFaceAssignId);
                 $(this).parent().parent().next('.commend_div').find('#emotio_2').qqFace({
                     id : 'facebox2',
                     assign:'saytext_2',
                     path:ThinkPHP['FACE']+'/'	//表情存放的路径
                 });

                 //AJAX加载评论内容
                 $.ajax({
                     url:ThinkPHP['MODULE']+'/Comment/getComment',
                     type:'POST',
                     async:false,
                     data:{
                         currentWBId:current_weibo_id,
                         page:0
                     },
                     beforeSend:function () {
                         comment_div.find('.comment_list').remove();
                     },
                     success:function (data,response,status) {
                         if (data){
                             comment_div.find('.comment_load').css('display','none');
                             //comment_div.find('.comment_load').next('.').remote();
                             comment_div.find('.page').before(data);
                             //判断page如果有变更则刷新页面显示
                             //alert();
                             if ((comment_div.find('.page').find('span').length!=totalCommentPage)&&(comment_div.find('.page').find('span').length!=0)){
                                 //alert('');
                                 comment_div.find('.page').empty();

                                 comment_div.find('.page').append(showPageRepeat);

                             }else if(comment_div.find('.page').find('span').length==0){
                                 comment_div.find('.page').append(showPageRepeat);
                             }
                             //alert();
                             //解析@uasernam
                             AtUserName();
                             //保存totalpage
                             totalPageObj.val(totalCommentPage);
                         }
                     }
                 });
             }else {
                 $(this).parent().parent().next('.commend_div').hide();
                 comment_div.find('.comment_load').css('display','');
             }
             setHeight();

     });

    //点击评论分页
    $('.weibo_content').on('click',' .pt_ul .pt_li .commend_div .page_data',function () {
        var current_weibo_id = $(this).parent().parent().parent().find('.current_weibo_id').val();
        var comment_div = $(this).parent().parent().parent();
        var clickPage = parseInt($(this).text());
        var totalPage = $(this).parent().parent().parent().find('.totalPage').val();

        var pageList = first(clickPage)+page(clickPage,totalPage)+last(clickPage,totalPage);
        //将页面链接进行样式修改
        // $(this).parent().parent().find('.page_data').each(function (index) {
        //     $(this).removeClass('selected');
        // });
        // $(this).addClass('selected');
        //重新安装分页样式
        comment_div.find('.page').empty();
        comment_div.find('.page').append(pageList);

        $.ajax({
            url:ThinkPHP['MODULE']+'/Comment/getComment',
            type:'POST',
            async:false,
            data:{
                currentWBId:current_weibo_id,
                page:(clickPage-1)*showNum
            },
            beforeSend:function () {
                comment_div.find('.comment_load').css('display','block');
                //加载中,删除评论b项
                comment_div.find('.comment_list').remove();

            },
            success:function (data,response,status) {
                if (data){
                    comment_div.find('.comment_load').css('display','none');
                    //comment_div.find('.comment_load').next('.').remote();
                    comment_div.find('.page').before(data);
                    //解析@uasernam
                    AtUserName();
                }
            },
            complete:function (jqXHR) {
                setHeight();
            }
        });
    });

    //分页样式处理
    function page(page,totalPage) {
        var tmp='';
        var pageList='';
        for (var i = PageDiv;i>=1;i--){
            tmp = page-i;
            if (tmp<1) continue;
            pageList+= '<span class="page_span"><a href="javascript:;" page="'+(tmp)+'" class="page_data">'+(tmp)+'</a></span>';
        }
        pageList += '<span class="page_span"><a href="javascript:;" page="'+(page)+'" class="page_data selected">'+(page)+'</a></span>';
        for (var j = 1;j<PageDiv; j++){
            tmp = page+j;
            if (tmp>totalPage) break;
            pageList += '<span class="page_span"><a href="javascript:;" page="'+(tmp)+'" class="page_data">'+(tmp)+'</a></span>';
        }
        return pageList;
    }

    //首页
    function first(page) {
        if (page-1>PageDiv){
            return '<span class="page_span"><a href="javascript:;" page="'+1+'" class="page_data">'+1+'</a></span>'+
                '<span class="page_span">...</span>';
        }
        return " ";
    }
    function last(page,totalPage) {
        if (totalPage-page>PageDiv){
            return '<span class="page_span">...</span>'
                    +'<span class="page_span"><a href="javascript:;" page="'+totalPage+'" class="page_data">'+totalPage+'</a></span>';
        }
        return " ";
    }



    //表情插件
    // $('#emotio_2').qqFace({
    //
    // });
    //当点击评论提交按钮时
    $('.weibo_content').on('click','.pt_ul .pt_li .commend_div .comment_pulish_box .commend_button',function () {
        //alert()
        //如果博文和图片都不存在，则提示输入内容
        var comment_content = $(this).prev('.commend_text').find('.commend_content');
        var weibo_id = $(this).parent().find('.current_weibo_id').val();
        //获取该条微博的评论区对象
        var WBComment = $(this).parent().parent().parent().find('.subinfo_box').find('.commed_trigger').find('.comment_num');
        if ((comment_content.length==0)){
            //提示请输入文本内容
            //alert('请输入内容');
            $('#inform').html('请输入内容...').dialog('open');
            setTimeout(function () {
                $('#inform').html('...').dialog('close');
            },1000)

        }else {
            if (comment_content.val().length<280){   //需要将中英文分开计算
                //提交评论
                var informDiv = $('#inform');
                $.ajax({
                    url:ThinkPHP['MODULE']+'/Comment/wbComment',
                    type:'POST',
                    async:false,
                    data:{
                        currentWBId:weibo_id,
                        commendContent:comment_content.val(),
                    },
                    beforeSend:function () {
                        //置灰提交按钮

                        //打开loading框
                        informDiv.dialog('open');
                        informDiv.find('p').removeClass('inform_fail').addClass('inform_default').find('span').html('评论提交中...');
                    },
                    success:function (data,reponse,status) {
                        var commentId = $.parseJSON(data)['cid'];
                        var tComment  = $.parseJSON(data)['tComment'];
                        //alert(commentId);
                        if (commentId>0){
                            informDiv.find('p').removeClass('inform_default').addClass('inform_success').find('span').html('评论成功...');
                            //alert(1);
                            setTimeout(function () {
                                //清空评论框
                                comment_content.val('');
                                informDiv.find('p').removeClass('inform_success').find('span').html('数据提交中...');
                                informDiv.dialog('close');
                                //评论数+1;
                                WBComment.text(tComment);
                            },500);
                        }else {
                            //发布失败失败时
                            informDiv.find('p').removeClass('inform_default inform_success').addClass('inform_fail').find('span').html('评论失败...');
                            //延迟500ms再执行
                            setTimeout(function () {
                                informDiv.find('p').removeClass('inform_fail').addClass('inform_default').find('span').html('数据提交...');
                                informDiv.dialog('close');
                            },500);
                        }
                    },
                    complete:function (event,request,settings) {
                        //alert(2);
                        //清空评论框,防止服务器无响应时页面卡死
                        setTimeout(function () {
                            comment_content.val('');
                            informDiv.find('p').removeClass('inform_success').find('span').html('数据提交中...');
                            informDiv.dialog('close');
                        },1000);

                    }
                });
            }else {
                //提示输入的字符太长
                alert('内容超出,会自动被截取');
            }
        }
    });

    //点赞处理，同一用户点击一次+1，点击两次不变
    $('.weibo_content').on('click','.pt_ul .pt_li .recommend',function () {
        var currentValObj = $(this).find('em').eq(1);  //当前的点赞值
        var currentVal = parseInt(currentValObj.text());
        var topicId = $(this).parent().find('.recommendId').val();  //需要点赞的微博ID
        $.ajax({
            url:ThinkPHP['MODULE']+'/Topic/ajaxRecommend',
            type:'POST',
            data:{
                tid:topicId,
            },
            beforeSend:function () {
                //点赞显示出变为Loading
            },
            success:function (data,reponse,status) {
                //data为json格式，如果control=1则点赞+1；如果control=-1,则点赞-1
                var data = $.parseJSON(data);
                if(data['success']){

                    if (data['control']=='1'){
                        //评论数+1
                        currentValObj.text(currentVal+1);
                    }else {
                        //评论数-1
                        currentValObj.text(currentVal-1);
                    }
                }else {
                    //评论数量不变，出现错误
                }
            }
        });

    });
    //删除微博
    $('.weibo_content').on('click',' .pt_ul .pt_li .weibo_del_span',function () {
        var WBId = $(this).parent().find('.recommendId').val();
        var DelThis = this;
        //AJAX删除
        $.ajax({
            url:ThinkPHP['MODULE']+'/Topic/delOneWeibo',
            type:'POST',
            data:{
                WBId:WBId
            },
            beforeSend:function () {
                $(DelThis).addClass('weibo_del_span_clicked');
            },
            success:function (data,response,status) {
                if (data){
                    $(DelThis).parent().parent().parent().parent().remove();
                    setHeight();
                }
            },
            complete:function (jqxhr) {
                $(DelThis).removeClass('weibo_del_span_clicked');
            }
        });
    });



});
