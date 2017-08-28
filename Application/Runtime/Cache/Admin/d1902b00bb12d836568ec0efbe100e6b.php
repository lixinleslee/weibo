<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <script type="text/javascript">
    var ThinkPHP={
        'ROOT':'/weibo',
        'IMG': '/weibo/Public/<?php echo (MODULE_NAME); ?>/image',
        'FACE': '/weibo/Public/<?php echo (MODULE_NAME); ?>/face',
        'AVATAR': '/weibo/Uploads/Face',
        'INDEX':'<?php echo U('Admin/Index');?>',
        'MODULE':'/weibo/Admin',
        'COMMENT_SHOW_NUM':<?php echo C('COMMENT_SHOW_NUM');?>,
        'TOPIC_SHOW_NUM':<?php echo C('COMMENT_SHOW_NUM');?>,
        'FRIEND_SHOW_NUM':<?php echo C('FRIEND_SHOW_NUM');?>,
        'PAGE_DIV':<?php echo C('PAGE_DIV');?>,
        'PUBLIC':'/weibo/Public',
    }
</script>
    <title>微博系统--后台首页</title>
    <script type="text/javascript" src="/weibo/Public/Admin/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="/weibo/Public/Admin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/weibo/Public/Admin/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/weibo/Public/Admin/js/jquery.form.js"></script>
    <script type="text/javascript" src="/weibo/Public/Admin/js/index.js"></script>
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/css/basic.css">
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/css/index.css">
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