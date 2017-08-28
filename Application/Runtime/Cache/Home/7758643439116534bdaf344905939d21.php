<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<meta name="toTop" content="true">
<title>微博系统</title>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="/weibo/Public/Home/css/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="/weibo/Public/Home/css/jquery-ui.structure.css"/>


    <link rel="stylesheet" href="/weibo/Public/Home/css/base.css" type="text/css">
    <link rel="stylesheet" href="/weibo/Public/Home/css/friend.css" type="text/css">
    <script type="text/javascript" src="/weibo/Public/Home/js/base.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.page.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/friend.js"></script>

<script type="text/javascript">
    var ThinkPHP={
        'ROOT':'/weibo',
        'IMG': '/weibo/Public/<?php echo (MODULE_NAME); ?>/image',
        'FACE': '/weibo/Public/<?php echo (MODULE_NAME); ?>/face',
        'AVATAR': '/weibo/Uploads/Face',
        'INDEX':'<?php echo U('Home/Index');?>',
        'MODULE':'/weibo/Home',
        'COMMENT_SHOW_NUM':<?php echo C('COMMENT_SHOW_NUM');?>,
        'TOPIC_SHOW_NUM':<?php echo C('COMMENT_SHOW_NUM');?>,
        'FRIEND_SHOW_NUM':<?php echo C('FRIEND_SHOW_NUM');?>,
        'PAGE_DIV':<?php echo C('PAGE_DIV');?>,
        'PUBLIC':'/weibo/Public',
    }
</script>
</head>
<body>
<div id="bg">
<div id="header">
    <div class="header_main">
        <div class="header_log"><a href="<?php echo U('Index/index');?>" >微博系统</a></div>
        <div class="header_list">
            <ul>
                <li><a href="<?php echo U('Index/index');?>">首页</a></li>
                <li><a href="####">广场</a></li>
                <li><a href="####">图片</a></li>
                <li><a href="<?php echo U('Friend/addFriend');?>">找人</a></li>
            </ul>
        </div>
        <div class="header_right">
            <div class="header_search">
                <input type="text" name="search" placeholder="搜索内容"/>
                <a href="javascript:;">搜索</a>
            </div>
                <div class="header_member">
                    <ul>
                        <li class="info"><a target="_blank" href="<?php echo U('Space/index',array('id'=>session('user_auth')['uid']));?>"><?php echo session('user_auth')['username'];?></a> </li>
                        <li class="app">消息
                            <dl class="list">
                                <!--
                            <?php if(empty($referCount)): ?><dd><a href="<?php echo U('Setting/mention');?>" >@我的消息<em>(<?php echo ($referCount); ?>)</em></a></dd>
                                <?php else: ?>
                                <dd><a href="<?php echo U('Setting/mention');?>" >@我的消息<em class="red">(<?php echo ($referCount); ?>)</em></a></dd><?php endif; ?>
                            -->
                                <dd><a href="<?php echo U('Setting/mention');?>" >@我的消息<em class="referCount">(0)</em></a></dd>
                                <dd><a href="javascript:;" >收到的消息</a></dd>
                                <dd><a href="javascript:;" >发送的消息</a></dd>
                                <dd><a href="javascript:;" >删除消息</a></dd>
                            </dl>
                        </li>
                        <li class="app">账号
                            <dl class="list">
                                <dd><a href="<?php echo U('Setting/index');?>" >设置</a></dd>
                                <dd><a href="<?php echo U('Friend/index');?>" >好友管理</a></dd>
                                <dd class="line"><a href="<?php echo U('User/logout');?>">退出</a></dd>
                            </dl>
                        </li>
                    </ul>
                    <!--
                <?php if(empty($referCount)): else: ?>
                    <div class="notice">
                        您有<?php echo ($referCount); ?>条未读消息

                    </div><?php endif; ?>
                -->
                    <div class="notice" style="display: none">
                        <span class="text">您有0条未读消息</span>
                        <span class="close">x</span>
                    </div>
                </div>
        </div>

    </div>
</div>
<div id="main">
    
<div class="main_left">
    <ul>
        <li><a href="<?php echo U('Friend/index');?>" class="selected" >我关注的</a> </li>
        <li><a href="<?php echo U('Friend/addFriend');?>">添加好友</a> </li>
        <li><a href="<?php echo U('Friend/concentrated');?>">关注我的</a> </li>
    </ul>
</div>
<div class="main_right">
    <div class="personal_setting"">
        <h4>我关注的</h4>
        <div class="info">
            <?php if(empty($userInfo)): ?><p>没有相关结果</p>
                <?php else: ?>
                <?php if(is_array($userInfo)): $i = 0; $__LIST__ = $userInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
                        <dd class="user"><?php echo ($vo['username']); ?>（男）</dd>
                        <?php if(empty($vo['face'])): ?><dt><img src="/weibo/Public/Home/image/big.gif" alt="头像"></dt>
                            <?php else: ?>
                            <dt><img src="/weibo/<?php echo ($vo['face']['small']); ?>" alt="头像"></dt><?php endif; ?>

                        <dd><a href="<?php echo U('Space/index',array('id'=>$vo['id']));?>" class="message" name="message"> 个人主页</a></dd>
                        <dd><a href="javascript:;" class="message removeFriend" name="friend" controll="<?php echo ($vo['fid']); ?>">-不再关注<span class="loading "></span></a></dd>
                        <dd id="email">邮件：<a href="mailto:"><?php echo ($vo['email']); ?></a> </dd>
                    </dl><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div>
        <input type="hidden" name="total" class="totalNum" value="<?php echo ($totalNum); ?>">
        <div class="page clearfix" id="pageIndex">

        </div>
    </div>
</div>

</div>
<div id="inform">
    <p class="inform_default"><span>数据提交中...</span></p>
</div>
<div id="footer">
    footer
</div>
</div>
</body>
</html>