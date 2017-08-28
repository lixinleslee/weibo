<extend name="Base/common" />
<block name="head">
    <script type="text/javascript" src="__JS__/jquery.top.js"></script>
    <script type="text/javascript" src="__JS__/jquery.browser.js"></script>
    <script type="text/javascript" src="__JS__/jquery.qqFace.js"></script>
    <script type="text/javascript" src="__JS__/pekeUpload.js"></script>
    <script type="text/javascript" src="__JS__/jquery.pics.js"></script>
    <script type="text/javascript" src="__JS__/jquery-ui.js"></script>
    <script type="text/javascript" src="__JS__/base.js"></script>
    <script type="text/javascript" src="__JS__/index.js"></script>
    <link rel="stylesheet" type="text/css" href="__CSS__/jquery.qqFace.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/pekeUpload.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/jquery-ui.structure.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/jquery-ui.theme.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/base.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/index.css"/>
</block>
<block name="main">
    <div class="main_left ">
        <div class="formDiv">
            <span class="left">和大家分享一点新鲜事吧~</span>
            <span class="right"><strong class="text_number">还可以输入140个字</strong></span>
            <textarea class="text weibo_text" name="saytext" id="saytext"></textarea>
            <input type="hidden" name="pic_address" id="pic_address"/>
            <span class="emotion" id="emotion">表情</span>
            <span class="pic_btn" id="pic_btn" style="display: inline-block">图片</span>
            <input type="button" class="weibo_button" id="weibo_submit" value="提交"/>

        </div>
        <div class="weibo_content clearfix">
            <ul class="weibo_content_ul">
                <li class="li_type" rel="0"><a href="javascript:;" class="type selected">微博列表</a></li>
                <li class="li_type" rel="1"><a href="javascript:;" class="type">我关注的</a></li>
                <li class="li_type" rel="2"><a href="javascript:;" class="type">互听的</a></li>
            </ul>
            <div class="content_list">
                <ul class="pt_ul default" next-page="" totalPage="">
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
                                            <span class="subinfo_rgt Su_border commed_trigger"><em class="commend_block">评论</em><em class="comment_num">{$obj.comment}</em><i class="arrow_up"></i></span>
                                            <span class="subinfo_rgt Su_border share"><em class="commend_block">分享</em><em>{$obj.broadcount}</em></span>
                                            <if condition="$obj['username'] eq session('user_auth')['username']">
                                                <span class="subinfo_rgt Su_border weibo_del_span"><em class="weibo_del">删除</em></span>
                                            </if>
                                        </div>
                                    </div>
                                    <!--评论-->
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
                                                <span id="BroadContent">{$obj.content}</span>
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
                                                                <span class="subinfo_rgt Su_border"><em class="commend_block">评论</em><em>0</em></span>
                                                                <span class="subinfo_rgt Su_border share"><em class="commend_block">分享</em><em>{$obj['sourceContent']['broadcount']}</em></span>
                                                                <if condition="$obj['sourceContent']['username'] eq session('user_auth')['username']">
                                                                    <span class="subinfo_rgt Su_border weibo_del_span"><em class="weibo_del">删除</em></span>
                                                                </if>
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
                                            <span class="subinfo_rgt Su_border share_2"><em class="commend_block">分享</em><em>{$obj.broadcount}</em></span>
                                            <if condition="$obj['username'] eq session('user_auth')['username']">
                                                <span class="subinfo_rgt Su_border weibo_del_span"><em class="weibo_del">删除</em></span>
                                            </if>
                                        </div>
                                    </div>
                                    <!--评论-->
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
                                    <empty name="smallFace">
                                        <empty name="domain">
                                            <a target="_blank" href="{:U('Space/Index',array('id'=>session('user_auth')['uid']))}"><span class="subinfo_face "><img src="__IMG__/small.gif" alt="" width="18" height="18"></span></a>
                                            <else/>
                                            <a target="_blank" href="__ROOT__/i/{$domain}"><span class="subinfo_face "><img src="__IMG__/small.gif" alt="" width="18" height="18"></span></a>
                                        </empty>
                                        <else/>
                                        <a target="_blank" href="{:U('Space/Index',array('id'=>session('user_auth')['uid']))}"><span class="subinfo_face "><img src="__ROOT__/{$smallFace}" alt="" width="18" height="18"></span></a>
                                    </empty>
                                    <empty name="domain">
                                        <a target="_blank" href="{:U('Space/Index',array('id'=>session('user_auth')['uid']))}"><span class="subinfo S_txt2">@{:session('user_auth')['username']}</span></a>
                                        <else/>
                                        <a target="_blank" href="__ROOT__/i/{$domain}"><span class="subinfo S_txt2">@{:session('user_auth')['username']}</span></a>
                                    </empty>
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
                                        <input type="hidden" name="weibo_id" class="current_weibo_id" value="#Current_WB_ID#"/>
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
                                            <li class="unlog_pic"><img src="__ROOT__/#图片#" alt="" class="piccut_v piccut_h showImg"></li>
                                        </div>
                                        <div class="oneImagBig" style="display: none">
                                            <div class="tag">
                                                <ul class="tag_ul">
                                                    <li class="S_li_1"><span class="S_zoom_out"><a href="javascript:;" class="S_text1 A_zoom_out"><i class="I_zoom_out"></i>收起</a> </span></li>
                                                    <li class="S_li_2"><span class="S_zoom_in"><a target="_blank" href="javascript:;" control-data="__ROOT__/#大图#" class="S_text1 S_text2 A_zoom_in"><i class="I_zoom_in"></i>查看原图</a> </span></li>
                                                </ul>
                                            </div>
                                            <div class="img">
                                                <li class="oneImagBig"><img src="" control-data="__ROOT__/#中图#" alt="" class="piccut_v piccut_h"></li>
                                            </div>
                                        </div>
                                        <div class="clearBoth">
                                        </div>
                                    </ul>
                                </div>
                                <div class="subinfo_box clearfix">
                                    <empty name="smallFace">
                                        <a target="_blank" href="javascript:;"><span class="subinfo_face "><img src="__IMG__/small.gif" alt="" width="18" height="18"></span></a>
                                        <else/>
                                        <a target="_blank" href="javascript:;"><span class="subinfo_face "><img src="__ROOT__/{$smallFace}" alt="" width="18" height="18"></span></a>
                                    </empty>
                                    <a target="_blank" href="javascript:;"><span class="subinfo S_txt2">@{:session('user_auth')['username']}</span></a>
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
                                        <input type="hidden" name="weibo_id" class="current_weibo_id" value="#Current_WB_ID#"/>
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
                                    <empty name="smallFace">
                                        <a target="_blank" href="javascript:;"><span class="subinfo_face "><img src="__IMG__/small.gif" alt="" width="18" height="18"></span></a>
                                        <else/>
                                        <a target="_blank" href="javascript:;"><span class="subinfo_face "><img src="__ROOT__/{$smallFace}" alt="" width="18" height="18"></span></a>
                                    </empty>
                                    <a target="_blank" href="javascript:;"><span class="subinfo S_txt2">{$Think.session.user_auth.username}</span></a>
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
                                        <input type="hidden" name="weibo_id" class="current_weibo_id" value="#Current_WB_ID#"/>
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

                                    <empty name="smallFace">
                                        <empty name="domain">
                                            <a target="_blank" href="{:U('Space/Index',array('id'=>session('user_auth')['uid']))}">
                                                <else/>
                                                <a target="_blank" href="__ROOT__/i/{$domain}">
                                        </empty>
                                        <span class="subinfo_face "><img src="__IMG__/small.gif" alt="" width="18" height="18"></span></a>
                                        <else/>
                                        <empty name="domain">
                                            <a target="_blank" href="{:U('Space/Index',array('id'=>session('user_auth')['uid']))}">
                                                <else/>
                                                <a target="_blank" href="__ROOT__/i/{$domain}">
                                        </empty>
                                        <span class="subinfo_face "><img src="__ROOT__/{$smallFace}" alt="" width="18" height="18"></span></a>
                                    </empty>

                                    <empty name="domain">
                                        <a target="_blank" href="{:U('Space/Index',array('id'=>session('user_auth')['uid']))}"><span class="subinfo S_txt2">@{:session('user_auth')['username']}</span></a>
                                        <else/>
                                        <a target="_blank" href="__ROOT__/i/{$domain}"><span class="subinfo S_txt2">@{:session('user_auth')['username']}</span></a>
                                    </empty>

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
            <empty name="domain">
                <dt><a target="_blank" href="{:U('Space/index',array('id'=>session('user_auth')['uid']))}">
                        <empty name="bigFace">
                            <img src="__IMG__/big.gif" alt="" class="face">
                            <else/>
                            <img src="__ROOT__/{$bigFace}" alt="" class="face">
                        </empty>

                    </a></dt>
                <dd><a target="_blank" href="{:U('Space/index',array('id'=>session('user_auth')['uid']))}" >{:session('user_auth')['username']}</a></dd>
                <else/>
                <dt><a target="_blank" href="__ROOT__/i/{$domain}">
                        <empty name="bigFace">
                            <img src="__IMG__/big.gif" alt="" class="face">
                            <else/>
                            <img src="__ROOT__/{$bigFace}" alt="" class="face">
                        </empty>

                    </a></dt>
                <dd><a target="_blank" href="__ROOT__/i/{$domain}" >{:session('user_auth')['username']}</a></dd>
            </empty>

        </dl>
    </div>
</block>
