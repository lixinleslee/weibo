/**
 * Created by rico on 2017/5/31.
 */
;$(function () {
    var pics={
        'init':function () {
            //定义图片加载框ID
            var defaut={
                id:'imgbox'
            };
            var id = defaut.id;
            //创建图片上传框
            $('#pic_btn').on('click',function (e) {
                var strImg;
                if($('#'+id).length<=0){
                    strImg = '<div id="'+id+'" style="position:absolute;display:none;z-index:999;" class="imgBox">';
                    strImg +='<input id="file" type="file" name="file"/>';
                    strImg +='<span id="pic_close_btn" class="pic_close_btn">关闭</span>';
                    strImg +='</div>';
                }
                $(this).parent().append(strImg);
                var offset = $(this).position();
                var top = offset.top + $(this).outerHeight();
                $('#'+id).css('top',top+4);
                $('#'+id).css('left',offset.left-65);
                $('#'+id).show();
                e.stopPropagation();

                //加载插件
                //alert($('.formDiv').find('#imgbox').find('.pekecontainer').length);
                //return;
                    if ($('.formDiv').find('#imgbox').find('.pekecontainer').length<=0){
                        //清空图片地址保存输入框
                        $('.formDiv').find('input[name=imgSrc]').each(function (index) {
                            $(this).remove();
                        });
                        //加载图片上传插件
                        $('.formDiv').find('#imgbox').find('#file').pekeUpload({
                            url:ThinkPHP['MODULE']+'/File/upload',
                            maxSize:0,
                            allowedExtensions:"jpeg|jpg|png|gif",
                            onFileError:function (file,error) {
                                //上传错误处理
                                //alert(file.name);
                                //alert(error);
                            },
                            onFileSuccess:function (file,data,pos) {
                                //上传正确处理
                                //处理三张图片的URL
                                //var allSrcs = $.parseJSON(data)['source']+','+$.parseJSON(data)['thumb']+','+$.parseJSON(data)['show'];
                                //将加载图替换为上传图片
                                //alert($('.pekerow[rel="' + pos + '"]'));
                                var src = ThinkPHP['ROOT']+'/'+$.parseJSON(data)['thumb'];
                                $('.pekerow[rel="' + pos + '"]').find('.pekeitem_preview').find('.thumbnail').attr('src',src);
                                //var srcContainer =
                                //var imgSrcs = '<input class="srcs" type="hidden" rel="'+pos+'" name="imgSrc" value="'+allSrcs+'">';
                                var imgSrcs = "<input class='srcs' type='hidden' rel='"+pos+"' name='imgSrc' value='"+data+"'>";
                                $('.formDiv').append(imgSrcs);
                                //显示删除链接
                                $('.pekerow[rel="' + pos + '"]').find('.pkdelfile').find('.delbutton').css('display','block');
                            }
                        });
                    }
            });
            //关闭图选框
            $('.formDiv').on('click','#pic_close_btn',function () {
                $(this).parent().remove();
            });

            //加载上传插件
            // $(".formDiv").on('click','#file',function () {
            //     //alert($(this).parent().find('.pekecontainer').length);
            //     //var pekecontainer = $(this).attr('id');
            //     // if ($(this).parent().find('.pekecontainer').length<=0){
            //     //     $(this).pekeUpload({
            //     //         url:ThinkPHP['MODULE']+'/File/upload',
            //     //         maxSize:0,
            //     //         allowedExtensions:"jpeg|jpg|png|gif",
            //     //         onFileError:function (file,error) {
            //     //             //alert(file.name);
            //     //             //alert(error);
            //     //         },
            //     //         onFileSuccess:function (file,data) {
            //     //             //alert(data);
            //     //         }
            //     //     });
            //     // }
            //
            // })
        },
        //图片上传

    }
    pics.init();
})(jQuery);
