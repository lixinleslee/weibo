<extend name="Base/common"/>
<block name="head">
    <link rel="stylesheet" href="__CSS__/base.css" type="text/css">
    <link rel="stylesheet" href="__CSS__/setting.css" type="text/css">
    <script type="text/javascript" src="__JS__/base.js"></script>
    <script type="text/javascript" src="__JS__/mention.js"></script>
</block>

<block name="main">
<div class="main_left">
    <ul>
        <li><a href="{:U('Setting/index')}" >个人设置</a> </li>
        <li><a href="{:U('Setting/face')}" >头像设置</a> </li>
        <li><a href="{:U('Setting/domain')}">域名设置</a> </li>
        <li><a href="{:U('Setting/mention')}" class="selected" >@提及到我</a> </li>
    </ul>
</div>
<div class="main_right">
    <div class="personal_setting"">
        <h4>@提及到我</h4>
        <div class="mention">当前共有<span class="count">{$count}</span>条未读微博提及到您：</div>
        <volist name="getList" id="obj" empty="您暂时未被其它微博提及到~">
            <switch name="obj.is_read">
                <case value="0">
                    <p class="content"><span class="WB_author">{$obj.tUsername.username}：&nbsp;</span><span class="content">{$obj.content|mb_substr=0,20,'utf-8'}...</span><span ><a  href="javascript:;" class="red read" control-data="0" mention-id="{$obj.id}">【未阅读】</a></span></p>
                </case>
                <case value="1">
                    <p class="content"><span class="WB_author">{$obj.tUsername.username}：&nbsp;<span class="content">{$obj.content|mb_substr=0,20,'utf-8'}...</span><span ><a  href="javascript:;" class="green read" control-data="1" mention-id="{$obj.id}" >【已阅读】</a></span></p>
                </case>
            </switch>
        </volist>
    </div>
</div>

<div id="inform">
    <p class="inform_default"><span>数据加载中...</span></p>
</div>
</block>