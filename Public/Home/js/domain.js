/**
 * Created by rico on 2017/6/5.
 */
$(function () {
    $('input[name=submit]').button();
    var informDiv = $('#inform');
    //信息提示框
    informDiv.dialog({
        width:50,
        height:50,
        autoOpen:false,
        resizable:false,
        closeOnEscape:false,
        modal:true

    }).parent().find('.ui-dialog-titlebar').hide();


    $('#domain_form').validate({
        submitHandler:function (form) {
            //var informDiv = $('#inform');
            $.ajax({
                url:ThinkPHP['MODULE']+'/Setting/registerDomain',
                type:'POST',
                data:$(form).serialize(),
                beforeSend:function () {
                    //打开提示框
                    informDiv.dialog('open');
                },
                success:function (data,response,status) {
                    if (parseInt(data)>0){
                        //alert('ok');
                        //返回成功时，
                        informDiv.find('p').removeClass('inform_default inform_fail');
                        informDiv.find('p').addClass('inform_success').find('span').html('域名注册成功');
                        //延迟1s在执行
                        setTimeout(function () {
                            informDiv.find('p').removeClass('inform_success');
                            informDiv.find('p').addClass('inform_default').find('span').html('数据处理中...');
                            informDiv.dialog('close');
                            //修改input框后提示信息样式
                            registerForm.find('.star').removeClass('pass notpass').html('*');

                        },1000);
                    }else {
                        //alert('失败');
                        //失败时，
                        informDiv.find('p').removeClass('inform_default inform_success');
                        informDiv.find('p').addClass('inform_fail').find('span').html('域名注册失败...');
                        //延迟1s再执行
                        setTimeout(function () {
                            informDiv.find('p').removeClass('inform_fail');
                            informDiv.find('p').addClass('inform_default').find('span').html('数据处理中...');
                            //关闭提示框
                            informDiv.dialog('close');
                            location.reload();
                        },1000);
                    }

                }
            })
        },
        showErrors:function (errorMap,errorList) {
            //默认显示错误信息
            this.defaultShowErrors();
        },
        //当有错误提示的时候，显示错误提示图标
        highlight:function (element) {
            $(element).next('.star').removeClass('inform_success').addClass('notpass').html('');
        },
        unhighlight:function (element) {
            $(element).next('.star').removeClass('notpass').addClass('inform_success').html('');
        },
        rules:{
            domain:{
                required:true,
                minlength:4,
                maxlength:10,

                //异步检查域名是否已经注册
                // remote:{
                //
                // }
            },
        },
        messages:{
            domain: {
                required:'必填',
                minlength:'不能少于4位',
                maxlength:'不能大于10位'
            }
        }
    });
});