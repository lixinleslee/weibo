<extend name="Base/common"/>
<block name="head">
    <link rel="stylesheet" href="__CSS__/base.css" type="text/css">
    <link rel="stylesheet" href="__CSS__/setting.css" type="text/css">
    <link rel="stylesheet" href="__CSS__/cropbox.css" type="text/css">
    <script type="text/javascript" src="__JS__/base.js"></script>
    <script type="text/javascript" src="__JS__/jquery.validate.js"></script>
    <script type="text/javascript" src="__JS__/jquery.cropbox.js"></script>
    <script type="text/javascript" src="__JS__/setting.js"></script>
</block>
<block name="main">
<div class="main_left">
    <ul>
        <li><a href="{:U('Setting/index')}" class="selected" >个人设置</a> </li>
        <li><a href="{:U('Setting/face')}" >头像设置</a> </li>
        <li><a href="{:U('Setting/domain')}" >域名设置</a> </li>
        <li><a href="{:U('Setting/mention')}">@提及到我</a> </li>
    </ul>
</div>
<div class="main_right">
    <div class="personal_setting"">
        <h4>个人设置</h4>
        <form id="personal_form">
            <label for="username">用&nbsp;&nbsp;户&nbsp;名：</label>
            <input type="text" name="username" class="text" value="{$user['username']}" id="username" readonly/>
            <br/>
            <label for="email">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱：</label>
            <input type="email" name="email" class="text" id="email" placeholder="邮箱" value="{$user['email']}"/>
            <span class="star">*</span>
            <br/>
            <label for="intro" class="label_area">个人简介：</label>
            <textarea class="text area" name="intro" id="intro">{$user['info']['intro']}</textarea>
            <br/>
            <label><input type="submit" name="submit" value="修改" class="changeSubmit"/></label>
        </form>
    </div>
</div>
<div id="inform">
    <p class="inform_default"><span>数据加载中...</span></p>
</div>
</block>