<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微博系统--登录页</title>
    <script type="text/javascript" src="__JS__/jquery.js"></script>
    <script type="text/javascript" src="__JS__/jquery-ui.js"></script>
    <script type="text/javascript" src="__JS__/jquery.validate.js"></script>
    <script type="text/javascript" src="__JS__/jquery.form.js"></script>
    <script type="text/javascript" src="__JS__/login.js"></script>
    <link rel="stylesheet" type="text/css" href="__CSS__/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/jquery-ui.structure.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/login.css"/>
    <script type="text/javascript">
        var ThinkPHP={
            'IMG': '__ROOT__/Public/{$Think.MODULE_NAME}/image',
            'INDEX':'{:U('Home/Index')}',
            'MODULE':'__MODULE__'
        }
    </script>
</head>
<body>

<div id="main">
    <div id="login">
        <div class="top">
        <form id="login_form" action="" method="post">
            <span class="username">
            <input type="text" name="username" id="username_login" class="text" placeholder="账号/邮箱"/>
            </span>
            <span class="password">
                <input type="password" name="password" id="password_login" class="text" placeholder="密码"/>
            </span>
            <input type="submit" name="submit" class="submit" value="登录"/>
            <input type="checkbox" name="auto_login">10天自动登录
        </form>
        </div>
        <div class="buttom">
            <a href="javascript:;" id="new_register">新用户注册</a>
            <a href="javascript:;" id="getPassword">找回密码？</a>
        </div>
    </div>
</div>
<div id="footer">
</div>
<p class="footer">京ICP证030173号违法和不良信息举报电话：010-59922822</p>

    <form id="register" style="display: none">
        <ol class="show_errors"></ol>
        <label for="username">用&nbsp;&nbsp;户&nbsp;&nbsp;名：</label>
        <input type="text" name="username" class="text" id="username" placeholder="必填,2-20位"/>
        <span class="star">*</span>
        <br/>
        <label for="password">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
        <input type="password" name="password" class="text" id="password" placeholder="必填,6-20位"/>
        <span class="star">*</span>
        <br/>
        <label for="notpassword">确认密码：</label>
        <input type="password" name="notpassword" class="text" id="notpassword" placeholder="必填,与密码一致"/>
        <span class="star">*</span>
        <br/>
        <label for="email">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱：</label>
        <input type="email" name="email" class="text" id="email" placeholder="邮箱"/>
        <span class="star">*</span>
        <br/>
        <label for="birthday">生&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日：</label>
        <input type="text" name="birthday" class="text" id="birthday" readonly placeholder="生日"/>
    </form>
<form id="verify_form" form-click="" >
        <ol class="show_errors"></ol>
        <label for="verify">验证码：</label>
        <input type="text" name="verify" class="text" id="verify"/>
        <span class="star">*</span>
        <a href="javascript:;" class="changeImg">点击换一换</a>
        <img src="{:U('verify')}" class="changeImg" id="img_code">
</form>
<div id="inform" >
    <p class="inform_default"><span>数据加载中...</span></p>
</div>
</body>
</html>