/**
 * Created by Administrator on 2017/7/30 0030.
 */
$(function () {
    //搜索好友
    var showNum=ThinkPHP['FRIEND_SHOW_NUM'];     //每页显示条数
    var PageDiv = ThinkPHP['PAGE_DIV'];
    var totalNum = parseInt($('.personal_setting input[class=totalNum]').val());  //总条数，根据业务逻辑，一般只会在按照默认搜索时才会出现分页
    $('.personal_setting').on('click','#searchFriend',function () {
        var searchType = $('.searchSelect').val();
        var searchText = $('.searchText').val();

            $.ajax({
                url:ThinkPHP['MODULE']+'/Friend/ajaxSearchFriend',
                type:'POST',
                data:{
                    searchType:searchType,
                    searchText:searchText
                },
                beforeSend:function () {
                    $('#searchFriend').attr('disabled','disabled');
                    $('.searchDiv .loadSpan').addClass('searchLoad');
                    $('.personal_setting .info').find('*').remove();
                },
                success:function (data,response,status) {
                    //添加数据
                   $('.personal_setting .info').append(data);
                   //$('.personal_setting .page').append(showPageRepeat);
                },
                complete:function (jqXHR) {
                    $('.searchDiv .loadSpan').removeClass('searchLoad');
                    $('#searchFriend').removeAttr('disabled');
                }

            });

        //搜索好友页分页
        $('#page').pageInit({
            totalNum:totalNum,
            showNum:showNum,
            url:ThinkPHP['MODULE']+'/Friend/ajaxSearchFriend',
            type:"POST",
            data:{
                searchType:searchType,
                searchText:searchText
            },
            beforeSend:function () {

            },
            success:function (data) {
                if (data){
                    $('.personal_setting .info').empty();   //清空原始数据
                    $('.personal_setting .info').append(data);   //添加新的数据

                }
            },
            complete:function (jqXHR) {
            }
        });
    });

    //显示我的关注的好友的页面分页
    $('#pageIndex').pageInit({
        totalNum:totalNum,
        showNum:showNum,
        url:ThinkPHP['MODULE']+'/Friend/ajaxGetConceredFriend',
        type:"POST",
        data: {

        },
        beforeSend:function () {

        },
        success:function (data) {
            if (data){
                $('.personal_setting .info').empty();
                $('.personal_setting .info').append(data);
            }
        },
        complete:function (jqXHR) {
        }
    });

    //关注我的页面分页
    $('#pageConcered').pageInit({
        totalNum:totalNum,
        showNum:showNum,
        url:ThinkPHP['MODULE']+'/Friend/ajaxConcentrated',
        type:"POST",
        data: {

        },
        beforeSend:function () {

        },
        success:function (data) {
            if (data){
                $('.personal_setting .info').empty();
                $('.personal_setting .info').append(data);
            }
        },
        complete:function (jqXHR) {
        }
    });

    //添加关注
    $('.personal_setting').on('click','.info .addFriend',function () {
        var PersonId = $(this).attr('controll');
        var CurrentThis= this;
        $.ajax({
            url:ThinkPHP['MODULE']+'/Friend/ajaxAddFriend',
            type:'POST',
            data:{
                personId:PersonId
            },
            beforeSend:function () {
                $(CurrentThis).find('.loading').addClass('inform_default');
            },
            success:function (data,response,status) {
                if (data){
                    $(CurrentThis).find('.loading').removeClass('inform_default inform_fail').addClass('inform_success');
                    setTimeout(function () {
                        $(CurrentThis).parent().parent().remove();
                    },1000);
                }
            },
            complete:function (jqXHR) {
                setTimeout(function () {
                    $(CurrentThis).find('.loading').removeClass('inform_default inform_fail inform_success');
                },1500);

            }
        });
    });

    //取消关注
    $('.personal_setting').on('click','.info .removeFriend',function () {
        var PersonId = $(this).attr('controll');
        var CurrentThis= this;
        $.ajax({
            url:ThinkPHP['MODULE']+'/Friend/ajaxRemoveFriend',
            type:'POST',
            data:{
                personId:PersonId
            },
            beforeSend:function () {
                $(CurrentThis).find('.loading').addClass('inform_default');
            },
            success:function (data,response,status) {
                if (data){
                    $(CurrentThis).find('.loading').removeClass('inform_default inform_fail').addClass('inform_success');
                    setTimeout(function () {
                        $(CurrentThis).parent().parent().remove();
                    },1000);
                }
            },
            complete:function (jqXHR) {
                setTimeout(function () {
                    $(CurrentThis).find('.loading').removeClass('inform_default inform_fail inform_success');
                },1500);

            }
        });
    });


});