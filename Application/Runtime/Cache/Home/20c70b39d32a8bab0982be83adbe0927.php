<?php if (!defined('THINK_PATH')) exit();?><div class="comment_list">
    <!--评论循环体-->
<?php if(is_array($getComment)): $i = 0; $__LIST__ = $getComment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><div class="list_ul">
        <div class="list_li clearfix" node-type="root_comment">
            <div class="WB_face_comment">
                <?php if(empty($obj['face'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/Public/Home/image/small.gif" alt="" width="18" height="18"></span></a>
                    <?php else: ?>
                    <a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo_face "><img src="/weibo/<?php echo ($obj['face']); ?>" alt="" width="18" height="18"></span></a><?php endif; ?>
            </div>
            <div class="root_comment_con clearfix">
                <div class="root_comment_text">
                    <?php if(empty($obj['domain'])): ?><a target="_blank" href="<?php echo U('Space/Index',array('id'=>$obj['uid']));?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a>
                        <?php else: ?>
                        <a target="_blank" href="/weibo/i/<?php echo ($obj["domain"]); ?>"><span class="subinfo S_txt2">@<?php echo ($obj["username"]); ?></span></a><?php endif; ?>
                    ：<?php echo ($obj["content"]); ?></div>
                <div class="root_comment_info clearfix">
                    <div class="comment_fun">
                        <ul>
                            <li><a href="javascript:;">回复</a> </li>
                            <li><a href="javascript:;">点赞</a></li>
                        </ul>
                    </div>
                    <div class="comment_time clearfix"><?php echo ($obj["time"]); ?></div>
                </div>
            </div>
        </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>