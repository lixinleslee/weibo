<div class="comment_list">
    <!--评论循环体-->
<volist name="getComment" id="obj">
    <div class="list_ul">
        <div class="list_li clearfix" node-type="root_comment">
            <div class="WB_face_comment">
                <empty name="obj['face']">
                    <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo_face "><img src="__IMG__/small.gif" alt="" width="18" height="18"></span></a>
                    <else/>
                    <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo_face "><img src="__ROOT__/{$obj['face']}" alt="" width="18" height="18"></span></a>
                </empty>
            </div>
            <div class="root_comment_con clearfix">
                <div class="root_comment_text">
                    <empty name="obj['domain']">
                        <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo S_txt2">@{$obj.username}</span></a>
                        <else/>
                        <a target="_blank" href="__ROOT__/i/{$obj.domain}"><span class="subinfo S_txt2">@{$obj.username}</span></a>
                    </empty>
                    ：{$obj.content}</div>
                <div class="root_comment_info clearfix">
                    <div class="comment_fun">
                        <ul>
                            <li><a href="javascript:;">回复</a> </li>
                            <li><a href="javascript:;">点赞</a></li>
                        </ul>
                    </div>
                    <div class="comment_time clearfix">{$obj.time}</div>
                </div>
            </div>
        </div>
    </div>
</volist>
</div>