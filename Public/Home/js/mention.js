/**
 * Created by rico on 2017/6/16.
 */
$(function () {
    //点击阅读，将提及到我的数据表状态位进行修改
    $('.main_right').on('click','.content .read',function () {
        var controlData = parseInt($(this).attr('control-data'));   //是否阅读标志位
        var id = $(this).attr('mention-id');
        var count = $(this).parent().parent().parent().find('.mention').find('.count');
        var mention = $('.header_member .notice .text');
        var mention2 = $('.header_member .list .referCount');
        //alert(count);
        var aThis=this;
        //AJAX提及，将阅读标志位置1
        if (!controlData){
            $.ajax({
                url:ThinkPHP['MODULE']+'/Setting/setRead',
                type:'POST',
                data:{
                    id:id
                },
                beforeSend:function () {
                    //alert($('.header_member .notice .text').text());
                },
                success:function (data,response,status) {
                    if (data){
                        //将显示的数量-1
                        var tmp = count.text()-1;
                        count.text(tmp);
                        setTimeout(function () {
                            //alert($('.header_member .notice .text').text());
                            mention.text('您有'+tmp+'条未读消息');
                            if (tmp==0){
                                mention.parent().hide();
                            }
                            mention2.text('('+tmp+')').css({
                                color:'red',
                                fontWeight:'bold'
                            });
                            $(aThis).removeClass('red').addClass('green');
                            $(aThis).text('【已阅读】');
                        },500);

                        //alert($(aThis).attr('class'));
                    }
                }

            });
        }

    });
});