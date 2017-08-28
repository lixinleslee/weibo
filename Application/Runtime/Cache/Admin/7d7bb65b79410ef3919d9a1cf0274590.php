<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="/weibo/Public/Admin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="/weibo/Public/Admin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/weibo/Public/Admin/js/jquery.validate.js"></script>
<script type="text/javascript" src="/weibo/Public/Admin/js/jquery.form.js"></script>
<script type="text/javascript" src="/weibo/Public/Admin/js/jquery.page.js"></script>
<link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/easyui/themes/icon.css">
<link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/easyui/themes/color.css">
<link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/css/basic.css">

<script type="text/javascript">
    var ThinkPHP={
        'ROOT':'/weibo',
        'IMG': '/weibo/Public/<?php echo (MODULE_NAME); ?>/image',
        'FACE': '/weibo/Public/<?php echo (MODULE_NAME); ?>/face',
        'AVATAR': '/weibo/Uploads/Face',
        'INDEX':'<?php echo U('Index/Index');?>',
        'MODULE':'/weibo/Admin',
        'ADMIN_TOPIC_NUM':<?php echo C('ADMIN_TOPIC_NUM');?>,
        'ADMIN_COMMENT_NUM':<?php echo C('ADMIN_COMMENT_NUM');?>,
        'USER_SHOW_NUM':<?php echo C('USER_SHOW_NUM');?>,
        'PAGE_DIV':<?php echo C('PAGE_DIV');?>,
        'PUBLIC':'/weibo/Public',
    }
</script>

    <frameset rows="60,*" framespacing="0" border="0">
        <frame  rows="60,*" src="<?php echo U('Admin/Index/top');?>" id="header-frame" name="header-frame" frameborder="no" scrolling="no">
        <frameset cols="180, *" framespacing="0" border="0" id="frame-body">
            <frame src="<?php echo U('Admin/Index/menu');?>" id="menu-frame" name="menu-frame" frameborder="no" scrolling="yes">
            <frame src="<?php echo U('Admin/Index/main');?>" id="main-frame" name="main-frame" frameborder="no" scrolling="yes">
        </frameset>
    </frameset>
</head>
<body>
</body>
</html>