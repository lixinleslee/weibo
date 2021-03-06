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
    <link rel="stylesheet" href="/weibo/Public/Home/css/cropper.css" type="text/css">
    <link rel="stylesheet" href="/weibo/Public/Home/css/faceCrop.css" type="text/css">
    <link rel="stylesheet" href="/weibo/Public/Home/css/pekeUpload.css" type="text/css">
    <script type="text/javascript" src="/weibo/Public/Home/js/base.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/pekeUpload.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/cropper.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/faceCrop.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/setting.js"></script>

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
        <li><a href="<?php echo U('Setting/face');?>" class="selected" >头像设置</a> </li>
        <li><a href="<?php echo U('Setting/domain');?>">域名设置</a> </li>
        <li><a href="<?php echo U('Setting/mention');?>">@提及到我</a> </li>
    </ul>
</div>
<div class="main_right">
    <!--头像裁剪-->
    <div id="head">
        <div class="container">
            <div class="row firstRow" >
                <div class="col-md-9 faceLeft">
                    <!-- <h3 class="page-header">Demo:</h3> -->
                    <div class="img-container">
                        <img src="" alt="图片" id="headImg">
                    </div>
                </div>
                <div class="col-md-3 faceRight">
                    <!-- <h3 class="page-header">Preview:</h3> -->
                    <div class="docs-preview clearfix">
                        <div class="img-preview preview-lg"></div>
                        <div class="img-preview preview-md"></div>
                        <div class="img-preview preview-sm"></div>
                        <div class="img-preview preview-xs"></div>
                    </div>

                    <!-- <h3 class="page-header">Data:</h3> -->
                    <input class="form-control" id="dataX" type="hidden" placeholder="x">
                    <input class="form-control" id="dataY" type="hidden" placeholder="y">
                    <input class="form-control" id="dataWidth" type="hidden" placeholder="width">
                    <input class="form-control" id="dataHeight" type="hidden" placeholder="height">
                    <input class="form-control" id="dataRotate" type="hidden" placeholder="rotate">
                </div>
                <div style="clear: both"></div>
            </div>
            <div class="row">
                <div class="col-md-9 docs-buttons icons">
                    <!-- <h3 class="page-header">Toolbar:</h3> -->
                    <div class="btn-group">
                        <button class="btn btn-primary" data-method="setDragMode" data-option="move" type="button" title="移动">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
                              <span class="icon icon-move"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="setDragMode" data-option="crop" type="button" title="裁剪">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)">
                              <span class="icon icon-crop"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="zoom" data-option="0.1" type="button" title="缩小">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
                              <span class="icon icon-zoom-in"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="zoom" data-option="-0.1" type="button" title="放大">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
                              <span class="icon icon-zoom-out"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button" title="向左旋转">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, -45)">
                              <span class="icon icon-rotate-left"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="rotate" data-option="45" type="button" title="向右旋转">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, 45)">
                              <span class="icon icon-rotate-right"></span>
                            </span>
                        </button>
                    </div>

                    <div class="btn-group second-group">
                        <button class="btn btn-primary" data-method="disable" type="button" title="关闭裁剪">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;disable&quot;)">
                              <span class="icon icon-lock"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="enable" type="button" title="打开裁剪">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;enable&quot;)">
                              <span class="icon icon-unlock"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="clear" type="button" title="清除">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;clear&quot;)">
                              <span class="icon icon-remove"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="reset" type="button" title="重置">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;reset&quot;)">
                              <span class="icon icon-refresh"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="destroy" type="button" title="注销">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;destroy&quot;)">
                              <span class="icon icon-off"></span>
                            </span>
                        </button>
                    </div>

                    <button class="btn btn-primary submitBtn" data-method="getData" data-option="" data-target="#putData" type="button">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getData&quot;)">
                            完成
                          </span>
                    </button>
                    <input class="form-control" id="putData" type="hidden" >
                    <input class="form-control" id="sourceUrl" type="hidden" value="">
                </div><!-- /.docs-buttons -->
            </div>
            <!----->
            <div style="clear: both"></div>
        </div>
        <div id="faceUpload">
            <input id="file" type="file" name="file" />
        </div>
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