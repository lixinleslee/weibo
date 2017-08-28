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
    <link rel="stylesheet" href="/weibo/Public/Home/css/setting.css" type="text/css">
    <script type="text/javascript" src="/weibo/Public/Home/js/base.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/mention.js"></script>

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
        <li><a href="<?php echo U('Setting/index');?>" >个人设置</a> </li>
        <li><a href="<?php echo U('Setting/face');?>" >头像设置</a> </li>
        <li><a href="<?php echo U('Setting/domain');?>">域名设置</a> </li>
        <li><a href="<?php echo U('Setting/mention');?>" class="selected" >@提及到我</a> </li>
    </ul>
</div>
<div class="main_right">
    <div class="personal_setting"">
        <h4>@提及到我</h4>
        <div class="mention">当前共有<span class="count"><?php echo ($count); ?></span>条未读微博提及到您：</div>
        <?php if(is_array($getList)): $i = 0; $__LIST__ = $getList;if( count($__LIST__)==0 ) : echo "您暂时未被其它微博提及到~" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i; switch($obj["is_read"]): case "0": ?><p class="content"><span class="WB_author"><?php echo ($obj["tUsername"]["username"]); ?>：&nbsp;</span><span class="content"><?php echo (mb_substr($obj["content"],0,20,'utf-8')); ?>...</span><span ><a  href="javascript:;" class="red read" control-data="0" mention-id="<?php echo ($obj["id"]); ?>">【未阅读】</a></span></p><?php break;?>
                <?php case "1": ?><p class="content"><span class="WB_author"><?php echo ($obj["tUsername"]["username"]); ?>：&nbsp;<span class="content"><?php echo (mb_substr($obj["content"],0,20,'utf-8')); ?>...</span><span ><a  href="javascript:;" class="green read" control-data="1" mention-id="<?php echo ($obj["id"]); ?>" >【已阅读】</a></span></p><?php break; endswitch; endforeach; endif; else: echo "您暂时未被其它微博提及到~" ;endif; ?>
    </div>
</div>

<div id="inform">
    <p class="inform_default"><span>数据加载中...</span></p>
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