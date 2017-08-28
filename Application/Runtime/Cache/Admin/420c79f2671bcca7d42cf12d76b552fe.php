<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
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
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/css/menu.css">
    <script type="text/javascript" src="/weibo/Public/Admin/js/menu.js"></script>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body style="cursor: auto;">
<div id="tabbar-div">
    <p><span class="main_tab_menu"><a href="javascript:toggleCollapse();"><img id="toggleImg" src="/weibo/Public/Admin/images/menu_plus.gif" alt="展开" width="9" height="9" border="0"></a></span>
        <span class="tab-front" id="menu-tab">菜单</span>
    </p>
</div>
<div id="main-div">
    <div id="menu-list">
        <ul id="menu-ul">
            <li class="menu-li collapse" key="01_certificate_manage" name="menu">
                用户管理        <ul style="display: none;">
                    <li class="menu-item"><a href="<?php echo U('Admin/User/member_list');?>" target="main-frame">微博用户查询</a></li>
                     </ul>
            </li>
            <li class="menu-li collapse" key="02_cat_and_goods" name="menu">
                微博管理        <ul style="display: none;">
                    <li class="menu-item"><a href="<?php echo U('Admin/Topic/topic_list');?>" target="main-frame">微博列表</a></li>
                    </ul>
            </li>
            <li class="menu-li collapse" key="03_promotion" name="menu">
                评论管理        <ul style="display: none;">
                    <li class="menu-item"><a href="<?php echo U('Admin/Comment/comment_list');?>" target="main-frame">评论列表</a></li>
                         </ul>
            </li>
            <li class="menu-li collapse" key="11_system" name="menu">
                系统设置        <ul style="display: none;">
                    <li class="menu-item"><a href="shop_config.php?act=list_edit" target="main-frame">页面显示设置</a></li>
                      </ul>
            </li>
             </ul>
    </div>
    <div id="help-div" style="display:none">
        <h1 id="help-title"></h1>
        <div id="help-content"></div>
    </div>
</div>

</body>
</html>