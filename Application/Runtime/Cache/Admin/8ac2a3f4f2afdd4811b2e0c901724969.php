<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>main</title>
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
</head>
<body>
<div class="list-div">
    <table cellspacing="1" cellpadding="3">
        <tbody>
        <tr>
            <th colspan="4" class="group-title">系统信息</th>
        </tr>
        <tr>
            <td width="20%">服务器操作系统:</td>
            <td width="30%">WINNT (127.0.0.1)</td>
            <td width="20%">Web 服务器:</td>
            <td width="30%">Apache/2.4.9 (Win64) PHP/5.5.12</td>
        </tr>
        <tr>
            <td>PHP 版本:</td>
            <td>5.5.12</td>
            <td>MySQL 版本:</td>
            <td>5.6.17</td>
        </tr>
        <tr>
            <td>安全模式:</td>
            <td>否</td>
            <td>安全模式GID:</td>
            <td>否</td>
        </tr>
        <tr>
            <td>Socket 支持:</td>
            <td>是</td>
            <td>时区设置:</td>
            <td>Asia/Chongqing</td>
        </tr>
        <tr>
            <td>GD 版本:</td>
            <td>GD2 ( JPEG GIF PNG)</td>
            <td>Zlib 支持:</td>
            <td>是</td>
        </tr>
        <tr>
            <td>IP 库版本:</td>
            <td>20071024</td>
            <td>文件上传的最大大小:</td>
            <td>64M</td>
        </tr>
        <tr>
            <td>ECShop 版本:</td>
            <td>v3.0.0 RELEASE 20160518</td>
            <td>安装日期:</td>
            <td>2017-08-04</td>
        </tr>
        <tr>
            <td>编码:</td>
            <td>UTF-8</td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>