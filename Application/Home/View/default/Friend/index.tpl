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
        <li><a href="{:U('Friend/index')}" class="selected" >我关注的</a> </li>
        <li><a href="{:U('Friend/addFriend')}">添加好友</a> </li>
        <li><a href="{:U('Friend/concentrated')}">关注我的</a> </li>
    </ul>
</div>
<div class="main_right">
    <div class="personal_setting"">
        <h4>我关注的</h4>
        <div class="info">
            <empty name="userInfo">
                <p>没有相关结果</p>
                <else />
                <volist name="userInfo" id="vo">
                    <dl>
                        <dd class="user">{$vo['username']}（男）</dd>
                        <empty name="vo['face']">
                            <dt><img src="__IMG__/big.gif" alt="头像"></dt>
                            <else/>
                            <dt><img src="__ROOT__/{$vo['face']['small']}" alt="头像"></dt>
                        </empty>

                        <dd><a href="{:U('Space/index',array('id'=>$vo['id']))}" class="message" name="message"> 个人主页</a></dd>
                        <dd><a href="javascript:;" class="message removeFriend" name="friend" controll="{$vo['fid']}">-不再关注<span class="loading "></span></a></dd>
                        <dd id="email">邮件：<a href="mailto:">{$vo['email']}</a> </dd>
                    </dl>
                </volist>
            </empty>
        </div>
        <input type="hidden" name="total" class="totalNum" value="{$totalNum}">
        <div class="page clearfix" id="pageIndex">

        </div>
    </div>
</div>
</block>