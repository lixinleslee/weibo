/**
 * Created by rico on 2017/5/6.
 */
$(function () {
    var rand = Math.floor(Math.random()*5)+1;
    $('body')
        .css('background','url('+ThinkPHP['IMG']+'/login_'+rand+'.jpg'+') no-repeat')
        .css('background-size','100%');
    $('#login_form input[type=submit]').button();
    //alert('');
    //登录验证
    $('#login_form').validate({
        submitHandler:function (form) {
        //     alert('');
        //     //打开验证码框
            $('#verify_form').attr('form-click','login');
            $('#verify_form').dialog('open');

        },
        rules:{
            username:{
                required:true,
                //isLegal:true
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
                //isLegal:'账号不合法'
            },
            password:{
                required:'必填',
                minlength:'不得小于6位',
                maxlength:'不得大于20位'
            }
        }
    });

    //信息提示框
    $('#inform').dialog({
        width:50,
        height:50,
        autoOpen:false,
        resizable:false,
        closeOnEscape:false,
        modal:true

    }).parent().find('.ui-dialog-titlebar').hide();

    //注册
    $('#new_register').on('click',function () {
        $('#register').dialog('open');
    });

    //验证码
    $('#verify_form').dialog({
        autoOpen:false,
        width:380,
        height:230,
        resizable:false,
        modal:true,
        buttons:{
            '完成':function () {
                $(this).submit();
            },

        },
        close:function (e) {
            $('#register').dialog('widget').find('button').eq(1).button('enable');
        }
    }).validate({
        submitHandler:function (form) { //验证码完成后执行表单提交
            //处理注册
            //定义对话框句柄
            var registerForm = $('#register');
            var informDiv = $('#inform');
            var submitButton = $('#login_form input[type=submit]');
            var loginForm = $('#login_form');
            var verifyForm = $('#verify_form');
            if (verifyForm.attr('form-click')=='register'){
                registerForm.ajaxSubmit({
                    url:ThinkPHP['MODULE']+'/User/register',
                    type:'POST',
                    data:{
                        verify:$('#verify').val(),
                    },
                    beforeSubmit:function () {
                        //置灰提交按钮
                        registerForm.dialog('widget').find('button').eq(1).button('disable');

                        //打开提示框
                        informDiv.dialog('open');
                    },
                    success:function (response,statusText) {
                        //恢复提交按钮
                        registerForm.dialog('widget').find('button').eq(1).button('enable');
                        if (parseInt(response)>0){
                            //返回成功时，提示成功并关闭对话框和重置表单
                            informDiv.find('p').removeClass('inform_default inform_fail');
                            informDiv.find('p').addClass('inform_success').find('span').html('注册成功');
                            //延迟1s在执行
                            setTimeout(function () {
                                informDiv.find('p').removeClass('inform_success');
                                informDiv.find('p').addClass('inform_default').find('span').html('数据处理中...');
                                informDiv.dialog('close');
                                registerForm.dialog('close');
                                verifyForm.dialog('close');
                                registerForm.resetForm();
                                verifyForm.resetForm();
                                //修改input框后提示信息样式
                                registerForm.find('.star').removeClass('pass notpass').html('*');

                            },1000);

                        }else {
                            //失败时，提示失败并关闭提示框,保留注册框
                            informDiv.find('p').removeClass('inform_default inform_success');
                            informDiv.find('p').addClass('inform_fail').find('span').html('注册失败...');
                            //延迟1s再执行
                            setTimeout(function () {
                                informDiv.find('p').removeClass('inform_fail');
                                informDiv.find('p').addClass('inform_default').find('span').html('数据处理中...');
                                //关闭提示框
                                informDiv.dialog('close');
                                //关闭验证码框
                                verifyForm.dialog('close');
                                //重置验证码框
                                verifyForm.resetForm();
                            },1000);

                        }
                    },
                });
            }else if(verifyForm.attr('form-click')=='login'){
                //处理登录
                loginForm.ajaxSubmit({
                    url:ThinkPHP['MODULE']+'/User/login',
                    type:'POST',
                    data:{
                        auto:$('#auto_login').val(),
                    },
                    beforeSend:function () {
                        submitButton.button('disable');
                        //打开提示框
                        informDiv.dialog('open');
                    },
                    success: function(responseText){
                        submitButton.button('enable');
                        //alert(typeof responseText);
                        //登录成功，返回的时ID
                        if (parseInt(responseText)>0){
                            //返回成功时，提示成功并关闭对话框和重置表单
                            informDiv.find('p').removeClass('inform_default inform_fail');
                            informDiv.find('p').addClass('inform_success').find('span').html('登录成功...');
                            //延迟1s在执行
                            setTimeout(function () {
                                informDiv.find('p').removeClass('inform_success');
                                informDiv.find('p').addClass('inform_default').find('span').html('数据处理中...');
                                informDiv.dialog('close');
                                loginForm.resetForm();
                                verifyForm.dialog('close');
                                verifyForm.resetForm();
                                location.href=ThinkPHP["INDEX"];

                            },1000);
                            //密码错误
                        }else if (responseText=='-10'){
                            //失败时，提示失败并关闭提示框,保留注册框
                            informDiv.find('p').removeClass('inform_default inform_success');
                            informDiv.find('p').addClass('inform_fail').find('span').html('密码错误...');
                            //延迟1s再执行
                            setTimeout(function () {
                                informDiv.find('p').removeClass('inform_fail');
                                informDiv.find('p').addClass('inform_default').find('span').html('数据处理中...');
                                //关闭提示框
                                informDiv.dialog('close');
                                //关闭验证码框
                                verifyForm.dialog('close');
                                //重置验证码框
                                verifyForm.resetForm();
                            },1000);
                            //用户名错误
                        }else if (responseText=='-11'){
                            //失败时，提示失败并关闭提示框,保留注册框
                            informDiv.find('p').removeClass('inform_default inform_success');
                            informDiv.find('p').addClass('inform_fail').find('span').html('用户名错误...');
                            //延迟1s再执行
                            setTimeout(function () {
                                informDiv.find('p').removeClass('inform_fail');
                                informDiv.find('p').addClass('inform_default').find('span').html('数据处理中...');
                                //关闭提示框
                                informDiv.dialog('close');
                                //关闭验证码框
                                verifyForm.dialog('close');
                                //重置验证码框
                                verifyForm.resetForm();
                            },1000);
                        }
                    }
                });
            }

        },
        showErrors:function () {
            var errors = this.numberOfInvalids();
            if (errors>0){
                $('#verify_form').dialog('option','height',(errors*20)+230);
            }else {
                $('#verify_form').dialog('option','height',230);
            }
            this.defaultShowErrors();
        },
        //有验证失败项时处理
        highlight:function (element) {
            $(element).next().removeClass('pass').addClass('notpass').html('');
        },
        //验证成功时处理
        unhighlight:function (element) {
            $(element).next().removeClass('notpass').addClass('pass').html('');
        },
        errorLabelContainer:'ol.show_errors',
        wrapper:'li',
        rules:{
            verify:{
                required:true,
                remote:{
                    url:ThinkPHP['MODULE']+'/User/checkVerify',
                    type:'POST',
                    beforeSend:function () {
                        //在验证码后面显示加载中
                        $('#verify').next().removeClass('notpass pass').addClass('loading').html('');
                    },
                    complete:function (jqXHR) {
                        //alert(typeof jqXHR.responseText);
                        if(jqXHR.responseText=='true'){ //验证成功
                            $('#verify').next().removeClass('notpass loading').addClass('pass').html('');
                            setTimeout(function () {
                                //重置表单
                                $(form).resetForm();
                                $('#verify').next().removeClass('notpass pass loading').html('*');
                            },1000);

                        }else {
                            $('#verify').next().removeClass('pass loading').addClass('notpass').html('');
                        }
                    }

                }
            },

        },
        messages:{
            verify:{
                required:'验证码不能为空',
                remote:'验证码不正确'
            }
        }
    });
    //点击刷新验证码
    var img_code = $('#img_code');
    var img_src = img_code.attr('src');
    $('.changeImg').on('click',function () {
        img_code.attr('src',img_src+'?tm='+Math.random());
    });


    //创建注册框
    $('#register').dialog({
        title:'新用户注册',
        autoOpen:false,
        modal:true,
        width:400,
        height:330,
        resizable:false,
        buttons:{
            '注册':function () {
                $(this).submit();
                // alert('');
                // $('#register').submit();
            }
        }
    }).validate({
        //验证完数据
        submitHandler:function (form){
            var verify_form = $('#verify_form');
            //给验证码的自定义属性赋值
            verify_form.attr('form-click','register');
            //弹出验证码
            verify_form.dialog('open');
            //将注册按钮置灰
            $('#register').dialog('widget').find('button').eq(1).button('disable');
    },

        showErrors:function (errorMap,errorList) {
            //默认显示错误信息
            this.defaultShowErrors();
            //每当显示一条错误信息，注册框高度增加20
            var errors = this.numberOfInvalids();
            if(errors>0){
                $('#register').dialog("option","height",errors * 20 + 330);
            }else {
                $('#register').dialog("option","height",330);
            }
        },
        //当有错误提示的时候，显示错误提示图标
        highlight:function (element) {
            $(element).next('.star').removeClass('pass').addClass('notpass').html('');
        },
        unhighlight:function (element) {
            $(element).next('.star').removeClass('notpass').addClass('pass').html('');
        },
        //错误显示位置
        errorLabelContainer:'ol.show_errors',
        wrapper:'li',
        rules:{
            username:{
                required:true,
                minlength:2,
                maxlength:20,
                inAt:true,
                remote:{
                    url:ThinkPHP['MODULE']+'/User/checkUsername',
                    type:'POST',
                    beforeSend:function () {
                        //现在加载中信息
                        $('#username').next().removeClass('pass notpass').addClass('loading');

                    },
                    complete:function (jqXHR) {
                        //AJX请求处理完毕后
                        if(jqXHR.responseText=='true'){
                            $('#username').next().removeClass('loading').addClass('pass');
                        }else {
                            $('#username').next().removeClass('loading').addClass('notpass');

                        }
                    }
                }
            },
            password:{
                required:true,
                rangelength:[6,20],
            },
            notpassword:{
                required:true,
                equalTo:'#password'
            },
            email:{
                required:true,
                email:true,
                //checkEmail:true,
                remote:{
                    url:ThinkPHP['MODULE']+'/User/checkEmail',
                    type:'POST',
                    beforeSend:function () {
                        $('#email').next().removeClass('pass notpass').addClass('loading');
                    },
                    complete:function (jqXHR) {
                        //AJX请求处理完毕后
                        if(jqXHR.responseText=='true'){
                            $('#email').next().removeClass('loading').addClass('pass');
                        }else {
                            $('#email').next().removeClass('loading').addClass('notpass');

                        }
                    }
                }
            }
        },messages:{
            username:{
                required:'用户名不能为空',
                minlength:'用户名不得小于2位',
                maxlength:'用户名不得大于20位',
                inAt:'账号名不能包含特殊字符',
                remote:'用户名被占用',
            },
            password:{
                required:'密码不能为空',
                rangelength:'密码须为6-20位之间',
            },
            notpassword:{
                required:'确认密码不能为空',
                equalTo:'两次密码不一致'
            },
            email:{
                required:'邮箱必填',
                email:'邮箱格式不正确',
                remote:'邮箱被占用'
            },
            birthday:{
                date:'请输入正确的日期'
            }
        }
    });

    //邮箱自动补全
    $('#email').autocomplete({
        delay:0, //默认30s显示，0为立即显示
        autoFocus:true, //设置为true时，提示列中的第一个项目被选中

        source:function (request,response) {
            var hosts=["qq.com", "163.com", "126.com", "sina.com.cn", "gmail.com", "hotmail.com"];//邮箱域名集合
            var term=request.term;//获取用户的输入
            var name=term;//邮箱的用户名
            var host="";//邮箱的域名,如qq.com
            var ix = term.indexOf('@');//判断用户输入是否有@
            var result = [];//最终呈现的邮箱列表

            //如果用户输入的emai有@，则重新将用户名和域名赋值
            if (ix>-1){
                name = term.slice(0,ix-1);
                host = term.slice(ix);
            }
            //用户有值输入，且没有输入@
            //如果用户已经输入@和后面的全部或部分域名，那么就找到相关的域名提示，比如abc@1 就提示abc@163.com
            //如果用户还没有输入@或后面的域名。那么就把所有的域名都提示出来
            if (name){
                var getHosts = []; //根据用户输入的域名，在hosts列表中找到相应集合
                if (host){ //并且host也有值
                    getHosts = $.grep(hosts,function (val,key) {  //在hosts中查找保护host的列表，赋值给gethosts
                        if (val.indexOf(host)>-1){       //输入的host在域名集合中存在
                            return val;
                        }
                    });

                }else {
                    getHosts = hosts;   //用户没有输入域名的时候，直接返回所有域名
                }
                result = $.map(getHosts,function (val) {  //gethosts里面的所有域名
                    return name + '@' + val;  //构造完整邮箱格式
                })
            }
            response(result);

        }
    });

    //日历
    $('#birthday').datepicker({
        yearRange:'1900:2050',
        changeYear:true,
        changeMonth:true,
        showMonthAfterYear:true,
        maxDate:0,
        dayNamesMin:["日","一","二","三","四","五","六"],
        monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
        nextText:'下一年',
        prevText:'上一年',
        firstDay:1,
        dateFormat:'yy-mm-dd'
    });

//自定义验证规则,注册用户名不能包含特殊字符
    $.validator.addMethod('inAt',function (value,elment) {
        var mode = /^[^@`~!#$%^&*()'"]+$/;
        return this.optional(elment) || mode.test(value);
    },'账号有@');
    //自定义验证规则，登录用户名不能包含特殊符号
    $.validator.addMethod('isLegal',function (value,element) {
        //如果有@则判断邮箱格式
        if (value.indexOf('@')>-1){
            return this.optional( element ) ||/^[a-z\d]+(\.[a-z\d]+)*@[a-z\d]+(\.-_[a-z\d]+)*(\.)[a-z\d]+(\.[a-z\d]+)*$/.test( value );
        }else {
            var mode = /^[^`~!#$%^&*()'"]{2,20}$/i;
            return this.optional(element) || mode.test(value);
        }

    },'账号不合法');

    $.validator.addMethod('isEmail',function (value,element) {

        return this.optional( element ) ||/^[a-z\d]+(\.[a-z\d]+)*@[a-z\d]+(\.-_[a-z\d]+)*(\.)[a-z\d]+(\.[a-z\d]+)*$/.test( value );
    },'邮箱格式错误')

});











