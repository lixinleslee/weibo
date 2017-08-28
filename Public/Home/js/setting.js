/**
 * Created by rico on 2017/5/28.
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
    //个人信息修改
    $('#personal_form').validate({
        submitHandler:function (form) {
            //var informDiv = $('#inform');
           $.ajax({
               url:ThinkPHP['MODULE']+'/Setting/UserUpdate',
               type:'POST',
               data:$(form).serialize(),
               beforeSend:function () {
                   //打开提示框
                   informDiv.dialog('open');
               },
               success:function (data,response,status) {
                   if (response=='success'){
                       //alert('ok');
                       //返回成功时，
                       informDiv.find('p').removeClass('inform_default inform_fail');
                       informDiv.find('p').addClass('inform_success').find('span').html('修改成功');
                       //延迟1s在执行
                       setTimeout(function () {
                           informDiv.find('p').removeClass('inform_success');
                           informDiv.find('p').addClass('inform_default').find('span').html('数据处理中...');
                           informDiv.dialog('close');
                           //修改input框后提示信息样式
                           registerForm.find('.star').removeClass('pass notpass').html('*');

                       },1000);
                   }else {
                       alert('失败');
                       //失败时，
                           informDiv.find('p').removeClass('inform_default inform_success');
                           informDiv.find('p').addClass('inform_fail').find('span').html('修改失败...');
                           //延迟1s再执行
                           setTimeout(function () {
                               informDiv.find('p').removeClass('inform_fail');
                               informDiv.find('p').addClass('inform_default').find('span').html('数据处理中...');
                               //关闭提示框
                               informDiv.dialog('close');
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
            email:{
                required:true,
                email:true
            },
        },
        messages:{
            email: {
                required:'邮箱必填',
                email:'格式错误'
            }
        }
    });


    //图片上传
    $("#file").pekeUpload({
        url:ThinkPHP['MODULE']+'/File/faceUpload',
        maxSize:0,
        locations:'face',  //头像页上传
        allowedExtensions:"jpeg|jpg|png|gif",
        showPreview:false,
        showFilename:false,
        showDeleteLink:false,
        onFileError:function (file,error) {
            //alert(file.name);
            //alert(error);
        },
        onFileBeforeSend:function () {
            informDiv.dialog('open');
            informDiv.find('p').find('span').html('图片上传中...');
        },
        onFileSuccess:function (file,data,pos) {
            informDiv.find('p').removeClass('inform_default').addClass('inform_success').find('span').html('上传成功...');

            setTimeout(function () {
                informDiv.find('p').removeClass('inform_success').find('span').html('数据提交中...');
                informDiv.dialog('close');
            },500);
            var cropData = '';
            //将加载图替换为上传图片
            var src = ThinkPHP['ROOT']+'/'+$.parseJSON(data)['source'];
            //重置input框的裁剪数据
            $('#putData').val('{"x":0,"y":0,"width":0,"height":0,"rotate":0}');
            //保存头像原图URL
            $('#sourceUrl').val($.parseJSON(data)['source']);
            //将图片加载在头像插件里
            //$('#headImg').attr('src',src);
            resetCrop.reset(src);
            //完成头像裁剪
            $('.submitBtn').on('click',function () {
                //对数据进行判断，如果宽或高为0，则不提交，提醒用户进行裁剪
                setTimeout(function () {
                    cropData = $('#putData').val();
                    if(($.parseJSON(cropData)['width']==0)&&($.parseJSON(cropData)['height']==0)){
                        //提示尚未进行任何裁剪
                        $('#inform').html('请裁剪图像...').dialog('open');
                        setTimeout(function () {
                            $('#inform').html('...').dialog('close');
                        },1000);

                        return false;
                    }

                    //AJAX提交
                    $.ajax({
                        url:ThinkPHP['MODULE']+'/File/faceSave',
                        type:'POST',
                        data:{
                            cropData:cropData,
                            imgUrl:$('#sourceUrl').val(),
                        },
                        beforeSend:function () {
                            informDiv.dialog('open');
                        },
                        success:function (data,response,status) {
                            if (parseInt(data)>0) {
                                //发布成功
                                //返回成功时，提示成功并关闭对话框
                                informDiv.find('p').removeClass('inform_default').addClass('inform_success').find('span').html('上传成功...');

                                setTimeout(function () {
                                    informDiv.find('p').removeClass('inform_success').find('span').html('数据提交中...');
                                    informDiv.dialog('close');
                                    //清除插件
                                    resetCrop.destroy();
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
                        }

                    });
                },500);




            });

        }
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

});