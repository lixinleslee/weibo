<!DOCTYPE html>
<html>
<head>
    <include file="Public/head" />
    <title>微博系统--后台首页</title>
     <script type="text/javascript" src="__JS__/login.js"></script>
     <link rel="stylesheet" type="text/css" href="__CSS__/login.css">
</head>
<body>
<form class="login_form" id="admin_login_form">
    <fieldset class="fieldset">
        <legend>微博系统管理员登录</legend>
        <label for="name" class="label">用户名：</label>
        <input type="text" name="username" id="username" placeholder="用户名|邮箱" class="text easyui-validatebox">
        <span class="star">*</span>
        <br>
        <label for="password" class="label">密　码：</label>
        <input type="password" name="password" id="password" placeholder="密码" class="text easyui-validatebox">
        <span class="star">*</span>
        <br>
        <span><input type="submit" name="submit" class="submit" value="登录"></span>
    </fieldset>
</form>
</body>
</html>