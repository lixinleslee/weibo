<?php if (!defined('THINK_PATH')) exit(); if(is_array($topic)): $i = 0; $__LIST__ = $topic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><!---原始样式-->
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
                                    <?php $__FOR_START_470430552__=0;$__FOR_END_470430552__=$obj["count"];for($i=$__FOR_START_470430552__;$i < $__FOR_END_470430552__;$i+=1){ ?><li class="unlog_pic" rel="<?php echo ($i); ?>"><img src="/weibo/<?php echo ($obj['images'][$i]['show']); ?>" alt="" class="piccut_v piccut_h"></li><?php } ?>
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
                                        <?php $__FOR_START_841560800__=0;$__FOR_END_841560800__=$obj["count"];for($i=$__FOR_START_841560800__;$i < $__FOR_END_841560800__;$i+=1){ ?><li class="mutilImg_s" rel="<?php echo ($i); ?>"><img src="/weibo/<?php echo ($obj['images'][$i]['s']); ?>" control-data="/weibo/<?php echo ($obj['images'][$i]['middle']); ?>" source-data="/weibo/<?php echo ($obj['images'][$i]['source']); ?>" alt="" class="piccut_v piccut_h" ></li><?php } ?>
                                    </div>
                                </div><?php endswitch;?>
                            <div class="clearfix">
                            </div>
                        </ul>
                    </div>
                    <div class="subinfo_box">
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
                        <span class="subinfo_rgt Su_border share"><em class="commend_block">分享</em><em><?php echo ($obj["broadcount"]); ?></em></span>
                        <?php if($obj['username'] == session('user_auth')['username']): ?><span class="subinfo_rgt Su_border weibo_del_span"><em class="weibo_del">删除</em></span><?php endif; ?>
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
                            <?php echo ($obj["content"]); ?>
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
                                                        <?php $__FOR_START_1318572573__=0;$__FOR_END_1318572573__=$obj['sourceContent']['count'];for($i=$__FOR_START_1318572573__;$i < $__FOR_END_1318572573__;$i+=1){ ?><li class="unlog_pic" rel="<?php echo ($i); ?>"><img src="/weibo/<?php echo ($obj['sourceContent']['images'][$i]['show']); ?>" alt="" class="piccut_v piccut_h"></li><?php } ?>
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
                                                            <?php $__FOR_START_1468777152__=0;$__FOR_END_1468777152__=$obj['sourceContent']['count'];for($i=$__FOR_START_1468777152__;$i < $__FOR_END_1468777152__;$i+=1){ ?><li class="mutilImg_s" rel="<?php echo ($i); ?>"><img src="/weibo/<?php echo ($obj['sourceContent']['images'][$i]['s']); ?>" control-data="/weibo/<?php echo ($obj['sourceContent']['images'][$i]['middle']); ?>" source-data="/weibo/<?php echo ($obj['sourceContent']['images'][$i]['source']); ?>" alt="" class="piccut_v piccut_h" ></li><?php } ?>
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
                                            <span class="subinfo_rgt Su_border"><em class="commend_block">转发</em><em>0</em></span>
                                            <span class="subinfo_rgt Su_border share"><em class="commend_block">分享</em><em><?php echo ($obj['sourceContent']['broadcount']); ?></em></span>
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
                                <?php $__FOR_START_1413707500__=0;$__FOR_END_1413707500__=$obj["count"];for($i=$__FOR_START_1413707500__;$i < $__FOR_END_1413707500__;$i+=1){ ?><div class="mutilImgSmall">
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
                        <span class="subinfo_rgt Su_border share2"><em class="commend_block share">分享</em><em><?php echo ($obj["broadcount"]); ?></em></span>
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