<volist name="topic" id="obj">
    <!---原始样式-->
    <empty name="obj.sourceid">
        <li class="pt_li pt_li_2 S_bg2">
            <div class="pic_txt clearfix">
                <div class="info_box ">
                    <div class="text_box">
                        <input type="hidden" name="reBroadId" class="reBroadId" value="{$obj.id}"/>
                        <div class="title W_autocut">{$obj.content}</div>
                    </div>
                    <div class="pic_mul">
                        <ul class="pic_m3 clearfix">
                            <switch name="obj.count">
                                <case value="0">
                                </case>
                                <case value="1">
                                    <div class="oneImagSmall">
                                        <li class="unlog_pic"><img src="__ROOT__/{$obj['images'][0]['show']}" alt="" class="piccut_v piccut_h"></li>
                                    </div>
                                    <div class="oneImagBig" style="display: none">
                                        <div class="tag">
                                            <ul class="tag_ul">
                                                <li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>
                                                <li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="__ROOT__/{$obj['images'][0]['source']}" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>
                                            </ul>
                                        </div>
                                        <div class="img">
                                            <li class="oneImagBig"><img src="" control-data="__ROOT__/{$obj['images'][0]['middle']}" alt="" class="piccut_v piccut_h"></li>
                                        </div>
                                    </div>
                                </case>
                                <default />
                                <!--多图方案-->

                                <div class="mutilImgSmall" >
                                    <for start="0" end="$obj.count">
                                        <li class="unlog_pic" rel="{$i}"><img src="__ROOT__/{$obj['images'][$i]['show']}" alt="" class="piccut_v piccut_h"></li>
                                    </for>
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
                                        <for start="0" end="$obj.count">
                                            <li class="mutilImg_s" rel="{$i}"><img src="__ROOT__/{$obj['images'][$i]['s']}" control-data="__ROOT__/{$obj['images'][$i]['middle']}" source-data="__ROOT__/{$obj['images'][$i]['source']}" alt="" class="piccut_v piccut_h" ></li>
                                        </for>
                                    </div>
                                </div>

                            </switch>
                            <div class="clearfix">
                            </div>
                        </ul>
                    </div>
                    <div class="subinfo_box">
                        <empty name="obj['face']">
                            <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo_face "><img src="__IMG__/small.gif" alt="" width="18" height="18"></span></a>
                            <else/>
                            <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo_face "><img src="__ROOT__/{$obj['face']}" alt="" width="18" height="18"></span></a>
                        </empty>
                        <empty name="obj['domain']">
                            <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo S_txt2">@{$obj.username}</span></a>
                            <else/>
                            <a target="_blank" href="__ROOT__/i/{$obj.domain}"><span class="subinfo S_txt2">@{$obj.username}</span></a>
                        </empty>

                        <span class="subinfo S_txt2">{$obj['time']}</span>
                        <input type="hidden" name="recommendId" class="recommendId" value="{$obj['id']}"/>
                        <span class="subinfo_rgt recommend"><em class="commend_block">赞</em><em>{$obj['recommend']}</em></span>
                        <span class="subinfo_rgt Su_border commed_trigger"><em class="commend_block">评论</em><em class="comment_num">{$obj.comment}</em></span>
                        <span class="subinfo_rgt Su_border share"><em class="commend_block">分享</em><em>{$obj.broadcount}</em></span>
                        <if condition="$obj['username'] eq session('user_auth')['username']">
                            <span class="subinfo_rgt Su_border weibo_del_span"><em class="weibo_del">删除</em></span>
                        </if>
                    </div>
                </div>
                <div class="commend_div" style="display: none;">
                    <div class="comment_pulish_box clearfix">
                        <div class="comment_face">
                            <empty name="obj['face']">
                                <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo_face "><img src="__IMG__/small.gif" alt="" width="18" height="18"></span></a>
                                <else/>
                                <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo_face "><img src="__ROOT__/{$obj['face']}" alt="" width="18" height="18"></span></a>
                            </empty>
                            <empty name="obj['domain']">
                                <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo S_txt2">@{$obj.username}</span></a>
                                <else/>
                                <a target="_blank" href="__ROOT__/i/{$obj.domain}"><span class="subinfo S_txt2">@{$obj.username}</span></a>
                            </empty>
                        </div>
                        <div class="commend_text">
                            <!--该条微博的ID-->
                            <input type="hidden" name="weibo_id" class="current_weibo_id" value="{$obj.id}"/>
                            <textarea class="commend_content clearfix" name="saytext_2"></textarea>
                            <input type="hidden" name="pic_address_2" id="pic_address_2"/>
                            <span class="emotion" id="emotio_2">表情</span>
                        </div>
                        <input type="button" class="commend_button" value="评论"/>
                    </div>
                    <div class="comment_load"><p class="comment_P">加载中<img src="__IMG__/load_more_1.gif" alt=""></p></div>
                    <div class="page clearfix">
                        <!--<span class="page_span"><a href="javascript:;" page="1" class="page_data selected">1</a></span>-->
                    </div>
                    <input type="hidden" name="totalPage" class="totalPage" value=""/>
                </div>
            </div>
        </li>
        <else/>
        <!--转播样式-->
        <li class="pt_li pt_li_2 S_bg2">
            <div class="pic_txt clearfix">
                <div class="info_box ">
                    <div class="text_box">
                        <input type="hidden" name="reBroadId_2" class="reBroadId_2" value="{$obj.id}"/>
                        <div class="title W_autocut BroadContent">
                            {$obj.content}
                            <div class="reBroad">
                                <div class="pic_txt clearfix">
                                    <div class="info_box ">
                                        <div class="text_box">
                                            <input type="hidden" name="reBroadId" class="reBroadId" value="{$obj['sourceContent']['id']}"/>
                                            <div class="title W_autocut">{$obj['sourceContent']['content']}</div>
                                        </div>
                                        <div class="pic_mul">
                                            <ul class="pic_m3 clearfix">
                                                <switch name="obj['sourceContent']['count']">
                                                    <case value="0">
                                                    </case>
                                                    <case value="1">

                                                        <div class="oneImagSmall">
                                                            <li class="unlog_pic"><img src="__ROOT__/{$obj['sourceContent']['images'][0]['show']}" alt="" class="piccut_v piccut_h"></li>
                                                        </div>
                                                        <div class="oneImagBig" style="display: none">
                                                            <div class="tag">
                                                                <ul class="tag_ul">
                                                                    <li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>
                                                                    <li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="__ROOT__/{$obj['sourceContent']['images'][0]['source']}" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="img">
                                                                <li class="oneImagBig"><img src="" control-data="__ROOT__/{$obj['sourceContent']['images'][0]['middle']}" alt="" class="piccut_v piccut_h"></li>
                                                            </div>
                                                        </div>
                                                    </case>
                                                    <default />

                                                    <div class="mutilImgSmall" >
                                                        <for start="0" end="$obj['sourceContent']['count']">
                                                            <li class="unlog_pic" rel="{$i}"><img src="__ROOT__/{$obj['sourceContent']['images'][$i]['show']}" alt="" class="piccut_v piccut_h"></li>
                                                        </for>
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
                                                            <for start="0" end="$obj['sourceContent']['count']">
                                                                <li class="mutilImg_s" rel="{$i}"><img src="__ROOT__/{$obj['sourceContent']['images'][$i]['s']}" control-data="__ROOT__/{$obj['sourceContent']['images'][$i]['middle']}" source-data="__ROOT__/{$obj['sourceContent']['images'][$i]['source']}" alt="" class="piccut_v piccut_h" ></li>
                                                            </for>
                                                        </div>
                                                    </div>
                                                </switch>
                                                <div class="clearBoth">
                                                </div>
                                            </ul>
                                        </div>
                                        <div class="subinfo_box clearfix">
                                            <empty name="obj['sourceContent']['face']">
                                                <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['sourceContent']['uid']))}"><span class="subinfo_face "><img src="__IMG__/small.gif" alt="" width="18" height="18"></span></a>
                                                <else/>
                                                <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['sourceContent']['uid']))}"><span class="subinfo_face "><img src="__ROOT__/{$obj['sourceContent']['face']}" alt="" width="18" height="18"></span></a>
                                            </empty>
                                            <empty name="obj['sourceContent']['domain']">
                                                <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['sourceContent']['uid']))}"><span class="subinfo S_txt2">@{$obj['sourceContent']['username']}</span></a>
                                                <else/>
                                                <a target="_blank" href="__ROOT__/i/{$obj['sourceContent']['domain']}"><span class="subinfo S_txt2">@{$obj['sourceContent']['username']}</span></a>
                                            </empty>

                                            <span class="subinfo S_txt2">{$obj['sourceContent']['time']}</span>
                                            <input type="hidden" name="recommendId" class="recommendId" value="{$obj['sourceContent']['id']}"/>
                                            <span class="subinfo_rgt recommend"><em class="commend_block">赞</em><em>{$obj['sourceContent']['recommend']}</em></span>
                                            <span class="subinfo_rgt Su_border"><em class="commend_block">转发</em><em>0</em></span>
                                            <span class="subinfo_rgt Su_border share"><em class="commend_block">分享</em><em>{$obj['sourceContent']['broadcount']}</em></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="pic_mul">
                        <ul class="pic_m3 clearfix">
                            <switch name="obj.count">
                                <case value="0">
                                </case>
                                <case value="1">
                                    <div class="oneImagSmall">
                                        <li class="unlog_pic"><img src="__ROOT__/{$obj['images'][0]['show']}" alt="" class="piccut_v piccut_h"></li>
                                    </div>
                                    <div class="oneImagBig" style="display: none">
                                        <div class="tag">
                                            <ul class="tag_ul">
                                                <li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>
                                                <li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="__ROOT__/{$obj['images'][0]['source']}" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>
                                            </ul>
                                        </div>
                                        <div class="img">
                                            <li class="oneImagBig"><img src="" control-data="__ROOT__/{$obj['images'][0]['middle']}" alt="" class="piccut_v piccut_h"></li>
                                        </div>
                                    </div>
                                </case>
                                <default />
                                <for start="0" end="$obj.count">

                                    <div class="mutilImgSmall">
                                        <li class="unlog_pic"><img src="__ROOT__/{$obj['images'][$i]['show']}" alt="" class="piccut_v piccut_h"></li>
                                    </div>

                                    <div class="mutilImgBig">
                                        <div class="middle">

                                        </div>
                                        <div class="small">

                                        </div>
                                    </div>

                                </for>
                            </switch>
                            <div class="clearBoth">
                            </div>
                        </ul>
                    </div>
                    <div class="subinfo_box clearfix">
                        <empty name="obj['face']">
                            <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo_face "><img src="__IMG__/small.gif" alt="" width="18" height="18"></span></a>
                            <else/>
                            <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo_face "><img src="__ROOT__/{$obj['face']}" alt="" width="18" height="18"></span></a>
                        </empty>
                        <empty name="obj['domain']">
                            <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo S_txt2">@{$obj.username}</span></a>
                            <else/>
                            <a target="_blank" href="__ROOT__/i/{$obj.domain}"><span class="subinfo S_txt2">@{$obj.username}</span></a>
                        </empty>

                        <span class="subinfo S_txt2">{$obj['time']}</span>
                        <input type="hidden" name="recommendId" class="recommendId" value="{$obj['id']}"/>
                        <span class="subinfo_rgt recommend"><em class="commend_block">赞</em><em>{$obj['recommend']}</em></span>
                        <span class="subinfo_rgt Su_border commed_trigger"><em class="commend_block">评论</em><em class="comment_num">{$obj.comment}</em></span>
                        <span class="subinfo_rgt Su_border share2"><em class="commend_block share">分享</em><em>{$obj.broadcount}</em></span>
                    </div>
                </div>
                <div class="commend_div" style="display: none;">
                    <div class="comment_pulish_box clearfix">
                        <div class="comment_face">
                            <empty name="obj['face']">
                                <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo_face "><img src="__IMG__/small.gif" alt="" width="18" height="18"></span></a>
                                <else/>
                                <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo_face "><img src="__ROOT__/{$obj['face']}" alt="" width="18" height="18"></span></a>
                            </empty>
                            <empty name="obj['domain']">
                                <a target="_blank" href="{:U('Space/Index',array('id'=>$obj['uid']))}"><span class="subinfo S_txt2">@{$obj.username}</span></a>
                                <else/>
                                <a target="_blank" href="__ROOT__/i/{$obj.domain}"><span class="subinfo S_txt2">@{$obj.username}</span></a>
                            </empty>
                        </div>
                        <div class="commend_text">
                            <!--该条微博的ID-->
                            <input type="hidden" name="weibo_id" class="current_weibo_id" value="{$obj.id}"/>
                            <textarea class="commend_content clearfix" name="saytext_2"></textarea>
                            <input type="hidden" name="pic_address_2" id="pic_address_2"/>
                            <span class="emotion" id="emotio_2">表情</span>
                        </div>
                        <input type="button" class="commend_button" value="评论"/>
                    </div>
                    <div class="comment_load"><p class="comment_P">加载中<img src="__IMG__/load_more_1.gif" alt=""></p></div>
                    <div class="page clearfix">
                        <!--<span class="page_span"><a href="javascript:;" page="1" class="page_data selected">1</a></span>-->
                    </div>
                    <input type="hidden" name="totalPage" class="totalPage" value=""/>
                </div>
            </div>
        </li>

    </empty>

</volist>