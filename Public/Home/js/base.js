/**
 * Created by rico on 2017/5/28.
 */
$(function () {
    //提示框
    var informDiv = $('#loading');
    //信息提示框
    $('#inform').dialog({
        width:50,
        height:50,
        autoOpen:false,
        resizable:false,
        closeOnEscape:false,
        modal:true

    }).parent().find('.ui-dialog-titlebar').hide();

    //loading
    informDiv.dialog({
        width:50,
        height:50,
        autoOpen:false,
        resizable:false,
        closeOnEscape:false,
        modal:true

    }).parent().find('.ui-dialog-titlebar').hide();

    //首页导航条信息和账号下拉菜单
    $('.app').hover(function () {
        //鼠标悬停处理
        $(this).find('.list').show();
    },function () {
        //鼠标移开处理
        $(this).find('.list').hide();
    });

    //未读提醒框
    $('.header_member').on('click','.notice .close',function () {
       $(this).parent().remove();
    });

    //AJAX轮循
    getReferCount();
    function getReferCount() {
        //没隔5分钟读取缓存数据
        $.ajax({
            url:ThinkPHP['MODULE']+'/Topic/ajaxGetReferCount',
            type:'POST',
            data:{

            },
            beforeSend:function () {

            },
            success:function (data,reponse,status) {
                if (parseInt(data)){
                    $('.header_member .notice .text').text('您有'+data+'条未读消息').parent().show();
                    $('.header_member .list .referCount').text('('+data+')').css({
                        color:'red',
                        fontWeight:'bold'
                    });
                }else {
                    $('.header_member .notice .text').text('您有'+data+'条未读消息').parent().hide();
                    $('.header_member .list .referCount').text('('+data+')').css({
                        color:'333',
                        fontWeight:'normal'
                    });
                }
            }
        });
        //递归
        setTimeout(function () {
            getReferCount();
        },2000);
    }



});
