<?php if (!defined('THINK_PATH')) exit(); if(empty($userInfo)): ?><p>没有相关结果</p>
<?php else: ?>
    <?php if(is_array($userInfo)): $i = 0; $__LIST__ = $userInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
            <dd class="user"><?php echo ($vo['username']); ?>（男）</dd>
            <?php if(empty($vo['face'])): ?><dt><img src="/weibo/Public/Home/image/big.gif" alt="头像"></dt>
                <?php else: ?>
                <dt><img src="/weibo/<?php echo ($vo['face']['small']); ?>" alt="头像"></dt><?php endif; ?>
            <dd><a href="<?php echo U('Space/index',array('id'=>$vo['id']));?>" class="message" name="message"> 个人主页</a></dd>
            <dd><a href="javascript:;" class="message addFriend" name="friend" controll="<?php echo ($vo['id']); ?>">+关注<span class="loading "></span></a></dd>
            <dd id="email">邮件：<a href="mailto:"><?php echo ($vo['email']); ?></a> </dd>
        </dl><?php endforeach; endif; else: echo "" ;endif; endif; ?>