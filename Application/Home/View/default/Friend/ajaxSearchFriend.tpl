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
            <dd><a href="javascript:;" class="message addFriend" name="friend" controll="{$vo['id']}">+关注<span class="loading "></span></a></dd>
            <dd id="email">邮件：<a href="mailto:">{$vo['email']}</a> </dd>
        </dl>
    </volist>
</empty>