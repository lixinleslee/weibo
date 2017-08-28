<!DOCTYPE html>
<html lang="en">
<head>
    <include file="Public/head" />
    <link rel="stylesheet" type="text/css" href="__CSS__/menu.css">
    <script type="text/javascript" src="__JS__/menu.js"></script>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body style="cursor: auto;">
<div id="tabbar-div">
    <p><span class="main_tab_menu"><a href="javascript:toggleCollapse();"><img id="toggleImg" src="__IMG__/menu_plus.gif" alt="展开" width="9" height="9" border="0"></a></span>
        <span class="tab-front" id="menu-tab">菜单</span>
    </p>
</div>
<div id="main-div">
    <div id="menu-list">
        <ul id="menu-ul">
            <li class="menu-li collapse" key="01_certificate_manage" name="menu">
                用户管理        <ul style="display: none;">
                    <li class="menu-item"><a href="{:U('Admin/User/member_list')}" target="main-frame">微博用户查询</a></li>
                     </ul>
            </li>
            <li class="menu-li collapse" key="02_cat_and_goods" name="menu">
                微博管理        <ul style="display: none;">
                    <li class="menu-item"><a href="{:U('Admin/Topic/topic_list')}" target="main-frame">微博列表</a></li>
                    </ul>
            </li>
            <li class="menu-li collapse" key="03_promotion" name="menu">
                评论管理        <ul style="display: none;">
                    <li class="menu-item"><a href="{:U('Admin/Comment/comment_list')}" target="main-frame">评论列表</a></li>
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