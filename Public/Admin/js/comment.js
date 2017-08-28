/**
 * Created by Administrator on 2017/8/27 0027.
 */
$(function () {
    var showNum=ThinkPHP['ADMIN_COMMENT_NUM'];     //每页显示条数
    var PageDiv = ThinkPHP['PAGE_DIV'];
    var totalNum = parseInt($('#pageComment').parent().find('.totalNUm').val());
    //分页
    $('#pageComment').pageInit({
        totalNum:totalNum,
        showNum:showNum,
        url:ThinkPHP['MODULE']+'/Comment/ajaxLoadComment',
        type:"POST",
        data:{
            //插件默认以page为参数传递
        },
        beforeSend:function () {

        },
        success:function (data) {
            if (data){
                //$('.personal_setting .info').empty();   //清空原始数据
                //$('.personal_setting .info').append(data);   //添加新的数据
                $('#listDiv').find('.repeat').remove();
                $('#listDiv').find('.deal-repeat').after(data);

            }
        },
        complete:function (jqXHR) {
        }
    });
});