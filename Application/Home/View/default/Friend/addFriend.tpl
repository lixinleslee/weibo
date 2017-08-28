<extend name="Base/common"/>
<block name="head">
    <link rel="stylesheet" href="__CSS__/base.css" type="text/css">
    <link rel="stylesheet" href="__CSS__/friend.css" type="text/css">
    <script type="text/javascript" src="__JS__/base.js"></script>
    <script type="text/javascript" src="__JS__/jquery.validate.js"></script>
    <script type="text/javascript" src="__JS__/jquery.page.js"></script>
    <script type="text/javascript" src="__JS__/friend.js"></script>
</block>
<block name="main">
<div class="main_left">
    <ul>
        <li><a href="{:U('Friend/index')}">我关注的</a> </li>
        <li><a href="{:U('Friend/addFriend')}" class="selected" >添加好友</a> </li>
        <li><a href="{:U('Friend/concentrated')}">关注我的</a> </li>
    </ul>
</div>
<div class="main_right">
    <div class="personal_setting"">
        <h4>添加好友</h4>
        <div class="searchDiv">
            <select name="searchSelect" class="searchSelect">
                <option value="1">默认全部</option>
                <option value="2">按域名</option>
                <option value="3">按昵称</option>
            </select>
            <input type="text" name="search" class="text searchText"/>
            <input type="button" name="submit" id="searchFriend" class="submit" value="搜索好友">
            <span class="loadSpan"></span>
        </div>
        <input type="hidden" name="total" class="totalNum" value="{$totalNum}">
        <div class="info">

        </div>
        <div class="page clearfix" id="page">

        </div>
    </div>
</div>
</block>