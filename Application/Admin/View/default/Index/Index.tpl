<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <include file="Public/head"/>

    <frameset rows="60,*" framespacing="0" border="0">
        <frame  rows="60,*" src="{:U('Admin/Index/top')}" id="header-frame" name="header-frame" frameborder="no" scrolling="no">
        <frameset cols="180, *" framespacing="0" border="0" id="frame-body">
            <frame src="{:U('Admin/Index/menu')}" id="menu-frame" name="menu-frame" frameborder="no" scrolling="yes">
            <frame src="{:U('Admin/Index/main')}" id="main-frame" name="main-frame" frameborder="no" scrolling="yes">
        </frameset>
    </frameset>
</head>
<body>
</body>
</html>