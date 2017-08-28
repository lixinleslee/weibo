/**
 * Created by rico on 2017/5/6.
 */
$(function () {

    $('#admin_login_form').validate({

        submitHandler:function (form) {
            $(form).ajaxSubmit({
                url:ThinkPHP['MODULE']+'/Admin/checkAdmin',
                type:'POST',
                data:{
                },
                beforeSubmit:function () {
                    //置灰提交按钮
                    //registerForm.dialog('widget').find('button').eq(1).button('disable');

                    //打开提示框
                    //informDiv.dialog('open');
                },
                success:function (data,response,statusText) {
                    var intdata = parseInt(data);
                    var msg = '';
                    if (intdata>0){
                        alert('登录成功');
                        location.href = ThinkPHP["INDEX"];
                    }else {
                        switch (intdata){
                            //未知错误
                            case -10:
                                msg = '未知错误';
                                break;
                            case -11:
                                msg = '用户名或密码错误';
                                break;
                            default:
                                msg = '未知错误';
                        }
                    }

                },
                complete:function (jqXHR) {
                    
                }
            });
        },
        //有验证失败项时处理
        highlight:function (element) {
            //alert(element);
            $(element).next('span').removeClass('pass').addClass('notpass').html('');
        },
        //验证成功时处理
        unhighlight:function (element) {
            $(element).next('span').removeClass('notpass').addClass('pass').html('');
        },

       rules:{
           username:{
               required:true,
               minlength:2,
               maxlength:20
           },
           password:{
               required:true,
               minlength:6,
               maxlength:20

           }
       },
        messages:{
           username:{
               required:'必填',
               minlength:'用户名太短',
               maxlength:'用户名太长'
           },
            password:{
               required:'必填',
                minlength:'密码为6-20位',
                maxlength:'密码太长'
            }
        }
    });

});