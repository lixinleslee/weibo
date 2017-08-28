<extend name="Base/common"/>
<block name="head">
    <link rel="stylesheet" href="__CSS__/base.css" type="text/css">
    <link rel="stylesheet" href="__CSS__/setting.css" type="text/css">
    <script type="text/javascript" src="__JS__/base.js"></script>
    <script type="text/javascript" src="__JS__/jquery.validate.js"></script>
    <script type="text/javascript" src="__JS__/domain.js"></script>
</block>
<block name="main">
<div class="main_left">
    <ul>
        <li><a href="{:U('Setting/index')}" >个人设置</a> </li>
        <li><a href="{:U('Setting/face')}" >头像设置</a> </li>
        <li><a href="{:U('Setting/domain')}" class="selected" >域名设置</a> </li>
        <li><a href="{:U('Setting/mention')}">@提及到我</a> </li>
    </ul>
</div>
<div class="main_right">
    <div class="personal_setting"">
        <h4>域名设置</h4>
        <form id="domain_form">
            <empty name="domain">
                <label for="domain">域&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</label>
                <input type="text" name="domain" class="text" id="domain" placeholder="域名为4-10个字符，注册后不能修改" value=""/>
                <span class="star">*</span>
                <br/>
                <label><input type="submit" name="submit" value="注册" class="changeSubmit"/></label>
                <else/>
                <label for="domain">个人域名：</label>
                <a href="__ROOT__/i/{$domain}">HTTP://{:$_SERVER['SERVER_NAME']}__ROOT__/i/{$domain}</a>
                <br/>
            </empty>
        </form>
    </div>
</div>

<div id="inform">
    <p class="inform_default"><span>数据加载中...</span></p>
</div>
</block>