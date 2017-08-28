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


    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.top.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.browser.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.qqFace.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/pekeUpload.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.pics.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/base.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/index.js"></script>
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Home/css/jquery.qqFace.css"/>
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Home/css/pekeUpload.css"/>
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Home/css/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Home/css/jquery-ui.structure.css"/>
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Home/css/jquery-ui.theme.css"/>
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Home/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Home/css/index.css"/>

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
    
    <div class="main_left ">
        <div class="formDiv">
            <span class="left">和大家分享一点新鲜事吧~</span>
            <span class="right"><strong class="text_number">还可以输入140个字</strong></span>
            <textarea class="text weibo_text" name="saytext" id="saytext"></textarea>
            <input type="hidden" name="pic_address" id="pic_address"/>
            <span class="emotion" id="emotion">表情</span>
            <span class="pic_btn" id="pic_btn" style="display: inline-block">图片</span>
            <input type="button" class="weibo_button" value="提交"/>

        </div>
        <div class="weibo_content clearfix">
            <ul class="weibo_content_ul">
                <li><a href="javascript:;" class="selected">微博列表</a></li>
                <li><a href="javascript:;">我关注的</a></li>
                <li><a href="javascript:;">互听的</a></li>
            </ul>
            <div class="content_list">
                <ul class="pt_ul default" rel="0">
                    <?php if(is_array($topic)): $i = 0; $__LIST__ = $topic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><!---原始样式-->
                        <?php if(empty($obj["sourceid"])): ?><li class="pt_li pt_li_2 S_bg2">
                                <div class="pic_txt clearfix">
                                    <div class="info_box ">
                                        <div class="text_box">

                                            <input type="hidden" name="reBroadId" class="reBroadId" value="<?php echo ($obj["id"]); ?>"/>
                                            <div class="title W_autocut"><?php echo ($obj["content"]); ?></div>
                                        </div>
                                        <div class="pic_mul">
                                            <ul class="pic_m3 clearfix">
                                                <?php switch($obj["count"]): case "0": break;?>
                                                    <?php case "1": ?><div class="oneImagSmall">
                                                            <li class="unlog_pic"><img src="/weibo/<?php echo ($obj['images'][0]['show']); ?>" alt="" class="piccut_v piccut_h"></li>
                                                        </div>
                                                        <div class="oneImagBig" style="display: none">
                                                            <div class="tag">
                                                                <ul class="tag_ul">
                                                                    <li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>
                                                                    <li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="/weibo/<?php echo ($obj['images'][0]['source']); ?>" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="img">
                                                                <li class="oneImagBig"><img src="" control-data="/weibo/<?php echo ($obj['images'][0]['middle']); ?>" alt="" class="piccut_v piccut_h"></li>
                                                            </div>
                                                        </div><?php break;?>
                                                    <?php default: ?>
                                                    <!--多图方案-->

                                                    <div class="mutilImgSmall" >
                                                        <?php $__FOR_START_1022789498__=0;$__FOR_END_1022789498__=$obj["count"];for($i=$__FOR_START_1022789498__;$i < $__FOR_END_1022789498__;$i+=1){ ?><li class="unlog_pic" rel="<?php echo ($i); ?>"><img src="/weibo/<?php echo ($obj['images'][$i]['show']); ?>" alt="" class="piccut_v piccut_h"></li><?php } ?>
                                                    </div>

                                                    <div class="mutilImgBig" style="display: none;">
                                                        <div class="tag">
                                                            <ul class="tag_ul">
                                                                <li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>
                                                                <li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="bigImg">
                                                            <li class="mutilBig_li"><img src="" alt="" class="piccut_v piccut_h"></li>
                                                        </div>
                                                        <div class="smallest">
                                                            <?php $__FOR_START_177380529__=0;$__FOR_END_177380529__=$obj["count"];for($i=$__FOR_START_177380529__;$i < $__FOR_END_177380529__;$i+=1){ ?><li class="mutilImg_s" rel="<?php echo ($i); ?>"><img src="/weibo/<?php echo ($obj['images'][$i]['s']); ?>" control-data="/weibo/<?php echo ($obj['images'][$i]['middle']); ?>" source-data="/weibo/<?php echo ($obj['images'][$i]['source']); ?>" alt="" class="piccut_v piccut_h" ></li><?php } ?>
                                                        </div>
                                                    </div><?php endswitch;?>
                                                <div class="clearBoth">
                                                </div>
                                            </ul>
                                        </div>
                                        <div class="subinfo_box clearfix">
                                            <?php if(empty($obj['face'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                                <?php else: ?>
                                                <a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/<?php echo ($obj['face']); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
                                            <?php if(empty($obj['domain'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a>
                                                <?php else: ?>
                                                <a target="_blank" href="/weibo/i/<?php echo ($obj["domain"]); ?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a><?php endif; ?>

                                            <span class="subinfo S_txt2"><?php echo ($obj['time']); ?></span>
                                            <input type="hidden" name="recommendId" class="recommendId" value="<?php echo ($obj['id']); ?>"/>
                                            <span class="subinfo_rgt recommend"><em class="commend_block">赞</em><em><?php echo ($obj['recommend']); ?></em></span>
                                            <span class="subinfo_rgt Su_border commed_trigger"><em class="commend_block">评论</em><em class="comment_num"><?php echo ($obj["comment"]); ?></em><i class="arrow_up"></i></span>
                                            <span class="subinfo_rgt Su_border share"><em class="commend_block">分享</em><em><?php echo ($obj["broadcount"]); ?></em></span>
                                            <?php if($obj['username'] == session('user_auth')['username']): ?><span class="subinfo_rgt Su_border weibo_del_span"><em class="weibo_del">删除</em></span><?php endif; ?>
                                        </div>
                                    </div>
                                    <!--评论-->
                                    <div class="commend_div" style="display: none;">
                                        <div class="comment_pulish_box clearfix">
                                            <div class="comment_face">
                                                <?php if(empty($obj['face'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                                    <?php else: ?>
                                                    <a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/<?php echo ($obj['face']); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
                                                <?php if(empty($obj['domain'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a>
                                                    <?php else: ?>
                                                    <a target="_blank" href="/weibo/i/<?php echo ($obj["domain"]); ?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a><?php endif; ?>
                                            </div>
                                            <div class="commend_text">
                                                <!--该条微博的ID-->
                                                <input type="hidden" name="weibo_id" class="current_weibo_id" value="<?php echo ($obj["id"]); ?>"/>
                                                <textarea class="commend_content clearfix" name="saytext_2"></textarea>
                                                <input type="hidden" name="pic_address_2" id="pic_address_2"/>
                                                <span class="emotion" id="emotio_2">表情</span>
                                            </div>
                                            <input type="button" class="commend_button" value="评论"/>
                                        </div>
                                        <div class="comment_load"><p class="comment_P">加载中<img src="/weibo/Public/Home/image/load_more_1.gif" alt=""></p></div>
                                        <div class="page clearfix">
                                            <!--<span class="page_span"><a href="javascript:;" page="1" class="page_data selected">1</a></span>-->
                                        </div>
                                        <input type="hidden" name="totalPage" class="totalPage" value=""/>
                                    </div>
                                </div>
                            </li>
                            <?php else: ?>
                            <!--转播样式-->
                            <li class="pt_li pt_li_2 S_bg2">
                                <div class="pic_txt clearfix">
                                    <div class="info_box ">
                                        <div class="text_box">
                                            <input type="hidden" name="reBroadId_2" class="reBroadId_2" value="<?php echo ($obj["id"]); ?>"/>
                                            <div class="title W_autocut BroadContent">
                                                <span id="BroadContent"><?php echo ($obj["content"]); ?></span>
                                                <div class="reBroad">
                                                    <div class="pic_txt clearfix">
                                                        <div class="info_box ">
                                                            <div class="text_box">
                                                                <input type="hidden" name="reBroadId" class="reBroadId" value="<?php echo ($obj['sourceContent']['id']); ?>"/>
                                                                <div class="title W_autocut"><?php echo ($obj['sourceContent']['content']); ?></div>
                                                            </div>
                                                            <div class="pic_mul">
                                                                <ul class="pic_m3 clearfix">
                                                                    <?php switch($obj['sourceContent']['count']): case "0": break;?>
                                                                        <?php case "1": ?><div class="oneImagSmall">
                                                                                <li class="unlog_pic"><img src="/weibo/<?php echo ($obj['sourceContent']['images'][0]['show']); ?>" alt="" class="piccut_v piccut_h"></li>
                                                                            </div>
                                                                            <div class="oneImagBig" style="display: none">
                                                                                <div class="tag">
                                                                                    <ul class="tag_ul">
                                                                                        <li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>
                                                                                        <li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="/weibo/<?php echo ($obj['sourceContent']['images'][0]['source']); ?>" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="img">
                                                                                    <li class="oneImagBig"><img src="" control-data="/weibo/<?php echo ($obj['sourceContent']['images'][0]['middle']); ?>" alt="" class="piccut_v piccut_h"></li>
                                                                                </div>
                                                                            </div><?php break;?>
                                                                        <?php default: ?>

                                                                        <div class="mutilImgSmall" >
                                                                            <?php $__FOR_START_1126853455__=0;$__FOR_END_1126853455__=$obj['sourceContent']['count'];for($i=$__FOR_START_1126853455__;$i < $__FOR_END_1126853455__;$i+=1){ ?><li class="unlog_pic" rel="<?php echo ($i); ?>"><img src="/weibo/<?php echo ($obj['sourceContent']['images'][$i]['show']); ?>" alt="" class="piccut_v piccut_h"></li><?php } ?>
                                                                        </div>

                                                                        <div class="mutilImgBig" style="display: none;">
                                                                            <div class="tag">
                                                                                <ul class="tag_ul">
                                                                                    <li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>
                                                                                    <li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>
                                                                                </ul>
                                                                            </div>

                                                                            <div class="bigImg">
                                                                                <li class="mutilBig_li"><img src="" alt="" class="piccut_v piccut_h"></li>
                                                                            </div>
                                                                            <div class="smallest">
                                                                                <?php $__FOR_START_1721478673__=0;$__FOR_END_1721478673__=$obj['sourceContent']['count'];for($i=$__FOR_START_1721478673__;$i < $__FOR_END_1721478673__;$i+=1){ ?><li class="mutilImg_s" rel="<?php echo ($i); ?>"><img src="/weibo/<?php echo ($obj['sourceContent']['images'][$i]['s']); ?>" control-data="/weibo/<?php echo ($obj['sourceContent']['images'][$i]['middle']); ?>" source-data="/weibo/<?php echo ($obj['sourceContent']['images'][$i]['source']); ?>" alt="" class="piccut_v piccut_h" ></li><?php } ?>
                                                                            </div>
                                                                        </div><?php endswitch;?>
                                                                    <div class="clearBoth">
                                                                    </div>
                                                                </ul>
                                                            </div>
                                                            <div class="subinfo_box clearfix">
                                                                <?php if(empty($obj['sourceContent']['face'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['sourceContent']['uid']));?>"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                                                    <?php else: ?>
                                                                    <a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['sourceContent']['uid']));?>"><span class="subinfo_face "><img src="/weibo/<?php echo ($obj['sourceContent']['face']); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
                                                                <?php if(empty($obj['sourceContent']['domain'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['sourceContent']['uid']));?>"><span class="subinfo S_txt2">@<?php echo ($obj['sourceContent']['username']); ?></span></a>
                                                                    <?php else: ?>
                                                                    <a target="_blank" href="/weibo/i/<?php echo ($obj['sourceContent']['domain']); ?>"><span class="subinfo S_txt2">@<?php echo ($obj['sourceContent']['username']); ?></span></a><?php endif; ?>

                                                                <span class="subinfo S_txt2"><?php echo ($obj['sourceContent']['time']); ?></span>
                                                                <input type="hidden" name="recommendId" class="recommendId" value="<?php echo ($obj['sourceContent']['id']); ?>"/>
                                                                <span class="subinfo_rgt recommend"><em class="commend_block">赞</em><em><?php echo ($obj['sourceContent']['recommend']); ?></em></span>
                                                                <span class="subinfo_rgt Su_border"><em class="commend_block">评论</em><em>0</em></span>
                                                                <span class="subinfo_rgt Su_border share"><em class="commend_block">分享</em><em><?php echo ($obj['sourceContent']['broadcount']); ?></em></span>
                                                                <?php if($obj['sourceContent']['username'] == session('user_auth')['username']): ?><span class="subinfo_rgt Su_border weibo_del_span"><em class="weibo_del">删除</em></span><?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="pic_mul">
                                            <ul class="pic_m3 clearfix">
                                                <?php switch($obj["count"]): case "0": break;?>
                                                    <?php case "1": ?><div class="oneImagSmall">
                                                            <li class="unlog_pic"><img src="/weibo/<?php echo ($obj['images'][0]['show']); ?>" alt="" class="piccut_v piccut_h"></li>
                                                        </div>
                                                        <div class="oneImagBig" style="display: none">
                                                            <div class="tag">
                                                                <ul class="tag_ul">
                                                                    <li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>
                                                                    <li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="/weibo/<?php echo ($obj['images'][0]['source']); ?>" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="img">
                                                                <li class="oneImagBig"><img src="" control-data="/weibo/<?php echo ($obj['images'][0]['middle']); ?>" alt="" class="piccut_v piccut_h"></li>
                                                            </div>
                                                        </div><?php break;?>
                                                    <?php default: ?>
                                                    <?php $__FOR_START_126689467__=0;$__FOR_END_126689467__=$obj["count"];for($i=$__FOR_START_126689467__;$i < $__FOR_END_126689467__;$i+=1){ ?><div class="mutilImgSmall">
                                                            <li class="unlog_pic"><img src="/weibo/<?php echo ($obj['images'][$i]['show']); ?>" alt="" class="piccut_v piccut_h"></li>
                                                        </div>

                                                        <div class="mutilImgBig">
                                                            <div class="middle">

                                                            </div>
                                                            <div class="small">

                                                            </div>
                                                        </div><?php } endswitch;?>
                                                <div class="clearBoth">
                                                </div>
                                            </ul>
                                        </div>
                                        <div class="subinfo_box clearfix">
                                            <?php if(empty($obj['face'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                                <?php else: ?>
                                                <a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/<?php echo ($obj['face']); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
                                            <?php if(empty($obj['domain'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a>
                                                <?php else: ?>
                                                <a target="_blank" href="/weibo/i/<?php echo ($obj["domain"]); ?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a><?php endif; ?>

                                            <span class="subinfo S_txt2"><?php echo ($obj['time']); ?></span>
                                            <input type="hidden" name="recommendId" class="recommendId" value="<?php echo ($obj['id']); ?>"/>
                                            <span class="subinfo_rgt recommend"><em class="commend_block">赞</em><em><?php echo ($obj['recommend']); ?></em></span>
                                            <span class="subinfo_rgt Su_border commed_trigger"><em class="commend_block">评论</em><em class="comment_num"><?php echo ($obj["comment"]); ?></em></span>
                                            <span class="subinfo_rgt Su_border share_2"><em class="commend_block">分享</em><em><?php echo ($obj["broadcount"]); ?></em></span>
                                            <?php if($obj['username'] == session('user_auth')['username']): ?><span class="subinfo_rgt Su_border weibo_del_span"><em class="weibo_del">删除</em></span><?php endif; ?>
                                        </div>
                                    </div>
                                    <!--评论-->
                                    <div class="commend_div" style="display: none;">
                                        <div class="comment_pulish_box clearfix">
                                            <div class="comment_face">
                                                <?php if(empty($obj['face'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                                    <?php else: ?>
                                                    <a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/<?php echo ($obj['face']); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
                                                <?php if(empty($obj['domain'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a>
                                                    <?php else: ?>
                                                    <a target="_blank" href="/weibo/i/<?php echo ($obj["domain"]); ?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a><?php endif; ?>
                                            </div>
                                            <div class="commend_text">
                                                <!--该条微博的ID-->
                                                <input type="hidden" name="weibo_id" class="current_weibo_id" value="<?php echo ($obj["id"]); ?>"/>
                                                <textarea class="commend_content clearfix" name="saytext_2"></textarea>
                                                <input type="hidden" name="pic_address_2" id="pic_address_2"/>
                                                <span class="emotion" id="emotio_2">表情</span>
                                            </div>
                                            <input type="button" class="commend_button" value="评论"/>
                                        </div>
                                        <div class="comment_load"><p class="comment_P">加载中<img src="/weibo/Public/Home/image/load_more_1.gif" alt=""></p></div>
                                        <div class="page clearfix">
                                            <!--<span class="page_span"><a href="javascript:;" page="1" class="page_data selected">1</a></span>-->
                                        </div>
                                        <input type="hidden" name="totalPage" class="totalPage" value=""/>
                                    </div>
                                </div>
                            </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

                    <div class="clearBoth"> </div>
                </ul>
                <div id="loadMore"><em class="text">点击加载更多</em><img class="loading" src="" alt=""/></div>
                <!--无配图刷新开始-->
                <div id="ajax_div_none" style="display: none">
                    <li class="pt_li pt_li_2 S_bg2">
                        <div class="pic_txt clearfix">
                            <div class="info_box ">
                                <div class="text_box">
                                    <input type="hidden" name="reBroadId" class="reBroadId" value="#原始ID#"/>
                                    <div class="title W_autocut">#内容#</div>
                                </div>
                                <div class="pic_mul">
                                    <ul class="pic_m3 clearfix">

                                        <div class="clearBoth">
                                        </div>
                                    </ul>
                                </div>
                                <div class="subinfo_box clearfix">
                                    <?php if(empty($smallFace)): if(empty($domain)): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>session('user_auth')['uid']));?>"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                            <?php else: ?>
                                            <a target="_blank" href="/weibo/i/<?php echo ($domain); ?>"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a><?php endif; ?>
                                        <?php else: ?>
                                        <a target="_blank" href="<?php echo U('Space/Index',array('id'=>session('user_auth')['uid']));?>"><span class="subinfo_face "><img src="/weibo/<?php echo ($smallFace); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
                                    <?php if(empty($domain)): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>session('user_auth')['uid']));?>"><span class="subinfo S_txt2">@<?php echo session('user_auth')['username'];?></span></a>
                                        <?php else: ?>
                                        <a target="_blank" href="/weibo/i/<?php echo ($domain); ?>"><span class="subinfo S_txt2">@<?php echo session('user_auth')['username'];?></span></a><?php endif; ?>
                                    <span class="subinfo S_txt2">刚刚发布</span>
                                    <input type="hidden" name="recommendId" class="recommendId" value="#Current_WB_ID#"/>
                                    <span class="subinfo_rgt recommend"><em class="commend_block">赞</em><em>0</em></span>
                                    <span class="subinfo_rgt Su_border commed_trigger"><em class="commend_block">评论</em><em class="comment_num">0</em></span>
                                    <span class="subinfo_rgt Su_border share"><em class="commend_block">分享</em><em>0</em></span>
                                    #删除微博#
                                </div>
                            </div>
                            <div class="commend_div" style="display: none;">
                                <div class="comment_pulish_box clearfix">
                                    <div class="comment_face">
                                        <?php if(empty($obj['face'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                            <?php else: ?>
                                            <a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/<?php echo ($obj['face']); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
                                        <?php if(empty($obj['domain'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a>
                                            <?php else: ?>
                                            <a target="_blank" href="/weibo/i/<?php echo ($obj["domain"]); ?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a><?php endif; ?>
                                    </div>
                                    <div class="commend_text">
                                        <!--该条微博的ID-->
                                        <input type="hidden" name="weibo_id" class="current_weibo_id" value="#Current_WB_ID#"/>
                                        <textarea class="commend_content clearfix" name="saytext_2"></textarea>
                                        <input type="hidden" name="pic_address_2" id="pic_address_2"/>
                                        <span class="emotion" id="emotio_2">表情</span>
                                    </div>
                                    <input type="button" class="commend_button" value="评论"/>
                                </div>
                                <div class="comment_load"><p class="comment_P">加载中<img src="/weibo/Public/Home/image/load_more_1.gif" alt=""></p></div>
                                <div class="page clearfix">
                                    <!--<span class="page_span"><a href="javascript:;" page="1" class="page_data selected">1</a></span>-->
                                </div>
                                <input type="hidden" name="totalPage" class="totalPage" value=""/>
                            </div>
                        </div>
                    </li>
                </div>

                <!--无配图刷新结束-->
                <!--一张配图开始-->
                <div id="ajax_div_one" style="display: none">
                    <li class="pt_li pt_li_2 S_bg2">
                        <div class="pic_txt clearfix">
                            <div class="info_box ">
                                <div class="text_box">
                                    <input type="hidden" name="reBroadId" class="reBroadId" value="#原始ID#"/>
                                    <div class="title W_autocut">#内容#</div>
                                </div>
                                <div class="pic_mul">
                                    <ul class="pic_m3 clearfix">
                                        <div class="oneImagSmall">
                                            <li class="unlog_pic"><img src="/weibo/#图片#" alt="" class="piccut_v piccut_h showImg"></li>
                                        </div>
                                        <div class="oneImagBig" style="display: none">
                                            <div class="tag">
                                                <ul class="tag_ul">
                                                    <li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>
                                                    <li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="/weibo/#大图#" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>
                                                </ul>
                                            </div>
                                            <div class="img">
                                                <li class="oneImagBig"><img src="" control-data="/weibo/#中图#" alt="" class="piccut_v piccut_h"></li>
                                            </div>
                                        </div>
                                        <div class="clearBoth">
                                        </div>
                                    </ul>
                                </div>
                                <div class="subinfo_box clearfix">
                                    <?php if(empty($smallFace)): ?><a target="_blank" href="javascript:;"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                        <?php else: ?>
                                        <a target="_blank" href="javascript:;"><span class="subinfo_face "><img src="/weibo/<?php echo ($smallFace); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
                                    <a target="_blank" href="javascript:;"><span class="subinfo S_txt2">@<?php echo session('user_auth')['username'];?></span></a>
                                    <span class="subinfo S_txt2">刚刚发布</span>
                                    <input type="hidden" name="recommendId" class="recommendId" value="#Current_WB_ID#"/>
                                    <span class="subinfo_rgt recommend"><em class="commend_block">赞</em><em>0</em></span>
                                    <span class="subinfo_rgt Su_border commed_trigger"><em class="commend_block">评论</em><em class="comment_num">0</em></span>
                                    <span class="subinfo_rgt Su_border share"><em class="commend_block">分享</em><em>0</em></span>
                                    #删除微博#
                                </div>
                            </div>
                            <div class="commend_div" style="display: none;">
                                <div class="comment_pulish_box clearfix">
                                    <div class="comment_face">
                                        <?php if(empty($obj['face'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                            <?php else: ?>
                                            <a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/<?php echo ($obj['face']); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
                                        <?php if(empty($obj['domain'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a>
                                            <?php else: ?>
                                            <a target="_blank" href="/weibo/i/<?php echo ($obj["domain"]); ?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a><?php endif; ?>
                                    </div>
                                    <div class="commend_text">
                                        <!--该条微博的ID-->
                                        <input type="hidden" name="weibo_id" class="current_weibo_id" value="#Current_WB_ID#"/>
                                        <textarea class="commend_content clearfix" name="saytext_2"></textarea>
                                        <input type="hidden" name="pic_address_2" id="pic_address_2"/>
                                        <span class="emotion" id="emotio_2">表情</span>
                                    </div>
                                    <input type="button" class="commend_button" value="评论"/>
                                </div>
                                <div class="comment_load"><p class="comment_P">加载中<img src="/weibo/Public/Home/image/load_more_1.gif" alt=""></p></div>
                                <div class="page clearfix">
                                    <!--<span class="page_span"><a href="javascript:;" page="1" class="page_data selected">1</a></span>-->
                                </div>
                                <input type="hidden" name="totalPage" class="totalPage" value=""/>
                            </div>
                        </div>
                    </li>
                </div>
                <!--一张配图结束-->
                <!--多图无刷新开始-->
                <div id="ajax_div_mutil" style="display: none">
                    <li class="pt_li pt_li_2 S_bg2">
                        <div class="pic_txt clearfix">
                            <div class="info_box ">
                                <div class="text_box">
                                    <input type="hidden" name="reBroadId" class="reBroadId" value="#原始ID#"/>
                                    <div class="title W_autocut">#内容#</div>
                                </div>
                                <div class="pic_mul">
                                    <ul class="pic_m3 clearfix">
                                        #多图#
                                        <div class="clearBoth">
                                        </div>
                                    </ul>
                                </div>
                                <div class="subinfo_box clearfix">
                                    <?php if(empty($smallFace)): ?><a target="_blank" href="javascript:;"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                        <?php else: ?>
                                        <a target="_blank" href="javascript:;"><span class="subinfo_face "><img src="/weibo/<?php echo ($smallFace); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
                                    <a target="_blank" href="javascript:;"><span class="subinfo S_txt2"><?php echo ($_SESSION['user_auth']['username']); ?></span></a>
                                    <span class="subinfo S_txt2">刚刚发布</span>
                                    <input type="hidden" name="recommendId" class="recommendId" value="#Current_WB_ID#"/>
                                    <span class="subinfo_rgt recommend"><em class="commend_block">赞</em><em>0</em></span>
                                    <span class="subinfo_rgt Su_border commed_trigger"><em class="commend_block">评论</em><em class="comment_num">0</em></span>
                                    <span class="subinfo_rgt Su_border share"><em class="commend_block">分享</em><em>0</em></span>
                                    #删除微博#
                                </div>
                            </div>
                            <div class="commend_div" style="display: none;">
                                <div class="comment_pulish_box clearfix">
                                    <div class="comment_face">
                                        <?php if(empty($obj['face'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                            <?php else: ?>
                                            <a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/<?php echo ($obj['face']); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
                                        <?php if(empty($obj['domain'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a>
                                            <?php else: ?>
                                            <a target="_blank" href="/weibo/i/<?php echo ($obj["domain"]); ?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a><?php endif; ?>
                                    </div>
                                    <div class="commend_text">
                                        <!--该条微博的ID-->
                                        <input type="hidden" name="weibo_id" class="current_weibo_id" value="#Current_WB_ID#"/>
                                        <textarea class="commend_content clearfix" name="saytext_2"></textarea>
                                        <input type="hidden" name="pic_address_2" id="pic_address_2"/>
                                        <span class="emotion" id="emotio_2">表情</span>
                                    </div>
                                    <input type="button" class="commend_button" value="评论"/>
                                </div>
                                <div class="comment_load"><p class="comment_P">加载中<img src="/weibo/Public/Home/image/load_more_1.gif" alt=""></p></div>
                                <div class="page clearfix">
                                    <!--<span class="page_span"><a href="javascript:;" page="1" class="page_data selected">1</a></span>-->
                                </div>
                                <input type="hidden" name="totalPage" class="totalPage" value=""/>
                            </div>
                        </div>
                    </li>
                </div>
                <!--多图无刷新结束-->

                <!--无刷新转发样式-->
                <div id="ajax_div_share" style="display: none">
                    <li class="pt_li pt_li_2 S_bg2">
                        <div class="pic_txt clearfix">
                            <div class="info_box ">
                                <div class="text_box">
                                    <input type="hidden" name="reBroadId_2" class="reBroadId_2" value="#新微博ID#"/>
                                    <div class="title W_autocut BroadContent">
                                        <span id="BroadContent">#新微博内容#</span>
                                        <div class="reBroad">
                                            <div class="pic_txt clearfix">
                                                <div class="info_box ">
                                                    <div class="text_box">
                                                        <input type="hidden" name="reBroadId" class="reBroadId" value="#原始ID#"/>
                                                        <div class="title W_autocut">#原始微博内容#</div>
                                                    </div>
                                                    <div class="pic_mul">
                                                        <ul class="pic_m3 clearfix">
                                                            #原微博图片内容#
                                                            <div class="clearBoth">
                                                            </div>
                                                        </ul>
                                                    </div>
                                                    <div class="subinfo_box clearfix">
                                                        <a target="_blank" href="#原作者个人链接#"><span class="subinfo_face "><img src="#原作者头像#" alt="" width="18" height="18"></span></a>
                                                        <a target="_blank" href="#原作者个人链接#"><span class="subinfo S_txt2">@#原作者名称#</span></a>
                                                        <span class="subinfo S_txt2">#原微博发布时间#</span>
                                                        <input type="hidden" name="recommendId" class="recommendId" value="#原始ID#"/>
                                                        <span class="subinfo_rgt recommend"><em class="commend_block">赞</em><em>#原始微博点赞次数#</em></span>
                                                        <span class="subinfo_rgt Su_border commed_trigger"><em class="commend_block">评论</em><em class="comment_num">#原始微博评论次数#</em></span>
                                                        <span class="subinfo_rgt Su_border share"><em class="commend_block">分享</em><em>#原始微博分享次数#</em></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pic_mul">
                                    <ul class="pic_m3 clearfix">

                                        <div class="clearBoth">
                                        </div>
                                    </ul>
                                </div>
                                <div class="subinfo_box clearfix">

                                    <?php if(empty($smallFace)): if(empty($domain)): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>session('user_auth')['uid']));?>">
                                                <?php else: ?>
                                                <a target="_blank" href="/weibo/i/<?php echo ($domain); ?>"><?php endif; ?>
                                        <span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                        <?php else: ?>
                                        <?php if(empty($domain)): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>session('user_auth')['uid']));?>">
                                                <?php else: ?>
                                                <a target="_blank" href="/weibo/i/<?php echo ($domain); ?>"><?php endif; ?>
                                        <span class="subinfo_face "><img src="/weibo/<?php echo ($smallFace); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>

                                    <?php if(empty($domain)): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>session('user_auth')['uid']));?>"><span class="subinfo S_txt2">@<?php echo session('user_auth')['username'];?></span></a>
                                        <?php else: ?>
                                        <a target="_blank" href="/weibo/i/<?php echo ($domain); ?>"><span class="subinfo S_txt2">@<?php echo session('user_auth')['username'];?></span></a><?php endif; ?>

                                    <span class="subinfo S_txt2">刚刚发布</span>
                                    <input type="hidden" name="recommendId" class="recommendId" value="#新微博ID#"/>
                                    <span class="subinfo_rgt recommend"><em class="commend_block">赞</em><em>0</em></span>
                                    <span class="subinfo_rgt Su_border commed_trigger"><em class="commend_block">评论</em><em class="comment_num">0</em></span>
                                    <span class="subinfo_rgt Su_border share_2"><em class="commend_block share">分享</em><em>0</em></span>
                                </div>
                            </div>
                            <!--评论-->
                            <div class="commend_div" style="display: none;">
                                <div class="comment_pulish_box clearfix">
                                    <div class="comment_face">
                                        <?php if(empty($obj['face'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                                            <?php else: ?>
                                            <a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/<?php echo ($obj['face']); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
                                        <?php if(empty($obj['domain'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a>
                                            <?php else: ?>
                                            <a target="_blank" href="/weibo/i/<?php echo ($obj["domain"]); ?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a><?php endif; ?>
                                    </div>
                                    <div class="commend_text">
                                        <!--该条微博的ID-->
                                        <input type="hidden" name="weibo_id" class="current_weibo_id" value="<?php echo ($obj["id"]); ?>"/>
                                        <textarea class="commend_content clearfix" name="saytext_2"></textarea>
                                        <input type="hidden" name="pic_address_2" id="pic_address_2"/>
                                        <span class="emotion" id="emotio_2">表情</span>
                                    </div>
                                    <input type="button" class="commend_button" value="评论"/>
                                </div>
                                <div class="comment_load"><p class="comment_P">加载中<img src="/weibo/Public/Home/image/load_more_1.gif" alt=""></p></div>
                                <div class="page clearfix">
                                    <!--<span class="page_span"><a href="javascript:;" page="1" class="page_data selected">1</a></span>-->
                                </div>
                                <input type="hidden" name="totalPage" class="totalPage" value=""/>
                            </div>
                        </div>
                    </li>
                </div>
            </div>
            <!--转发-->
            <div id="reBroadCast" style="display: none;">
                <div class="sourceContent" style="display: none"></div>
                <div class="sourcePic" style="display: none"></div>
                <input type="hidden" class="reBroadId" value="" name="reBroadId"/>
                <input type="hidden" class="reBroadId_2" value="" name="reBroadId_2"/>
                <span class="reBroadSourceTitle"><a target="_blank" class="sourceAuthor" href="javascript:;"> @张三</a></span>
                <textarea class="reBroadArea" placeholder="输入转播内容"></textarea>
            </div>
        </div>
    </div>
    <div class="main_right ">
        <dl>
            <?php if(empty($domain)): ?><dt><a target="_blank" href="<?php echo U('Space/index',array('id'=>session('user_auth')['uid']));?>">
                        <?php if(empty($bigFace)): ?><img src="/weibo/Public/Home/image/big.gif" alt="" class="face">
                            <?php else: ?>
                            <img src="/weibo/<?php echo ($bigFace); ?>" alt="" class="face"><?php endif; ?>

                    </a></dt>
                <dd><a target="_blank" href="<?php echo U('Space/index',array('id'=>session('user_auth')['uid']));?>" ><?php echo session('user_auth')['username'];?></a></dd>
                <?php else: ?>
                <dt><a target="_blank" href="/weibo/i/<?php echo ($domain); ?>">
                        <?php if(empty($bigFace)): ?><img src="/weibo/Public/Home/image/big.gif" alt="" class="face">
                            <?php else: ?>
                            <img src="/weibo/<?php echo ($bigFace); ?>" alt="" class="face"><?php endif; ?>

                    </a></dt>
                <dd><a target="_blank" href="/weibo/i/<?php echo ($domain); ?>" ><?php echo session('user_auth')['username'];?></a></dd><?php endif; ?>

        </dl>
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