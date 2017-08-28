<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
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
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/css/top.css">
    <script type="text/javascript" src="/weibo/Public/Admin/js/top.js"></script>

</head>
<body>
<div id="header-div">
    <div class="submenu-div">
        <div class="member_info">
            您好，admin
        </div>
        <ul>
            <li><a href="javascript:web_address();">帮助</a></li>
            <li><a href="message.php?act=list" target="main-frame">管理员留言</a></li>
            <li class="personal-set" onmouseover="showBar(this);" onmouseleave="hideBar(this);">
                <a href="privilege.php?act=modif" target="main-frame">个人设置</a>
                <div class="panel-hint" style="display: none;">
                    <ul>
                        <li class="btn-first">
                            <a href="privilege.php?act=modif" target="main-frame">个人中心</a>
                        </li>
                        <li>
                            <a href="index.php?act=clear_cache" target="main-frame" class="fix-submenu">清除缓存</a>
                        </li>
                        <li class="btn-exit">
                            <a href="privilege.php?act=logout" target="_top" class="fix-submenu">退出</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li><a href="javascript:window.top.frames['main-frame'].document.location.reload();window.top.frames['header-frame'].document.location.reload()">刷新</a></li>
            <li style="border-left:none;"><a href="<?php echo U('Admin/Index/main');?>" target="main-frame">起始页</a></li>
        </ul>
        <div id="send_info" style="padding: 5px 10px 0 0; clear:right;text-align: right; color: #FF9900;width:40%;float: right;">
        </div>
        <div id="load-div" style="padding: 5px 10px 0px 0px; text-align: right; color: rgb(255, 153, 0); display: none; width: 40%; float: right;"><img src="/weibo/Public/Admin/images/top_loader.gif" alt="正在处理您的请求..." style="vertical-align: middle" width="16" height="16"> 正在处理您的请求...</div>
    </div>
</div>
</body>
</html>