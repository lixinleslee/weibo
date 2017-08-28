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


    <script type="text/javascript" src="/weibo/Public/Home/js/base.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/space.js"></script>
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Home/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Home/css/space.css"/>

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
        <div class="top">
            <dl class="clearfix">

                <dt>
                    <?php if(empty($faceUrl)): ?><img src="/weibo/Public/Home/image/big.gif">
                        <?php else: ?>
                        <img src="/weibo/<?php echo ($faceUrl); ?>"><?php endif; ?>

                </dt>
                <dd>昵称：<?php echo ($username); ?></dd>
                <dd>生日：<?php echo ($birthday); ?></dd>
                <dd>简介：<?php echo ($intro); ?></dd>
            </dl>
        </div>
    </div>
    <div class="main_right">
        rigth
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