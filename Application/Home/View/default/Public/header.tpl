<div id="header">
    <div class="header_main">
        <div class="header_log"><a href="{:U('Index/index')}" >微博系统</a></div>
        <div class="header_list">
            <ul>
                <li><a href="{:U('Index/index')}">首页</a></li>
                <li><a href="####">广场</a></li>
                <li><a href="####">图片</a></li>
                <li><a href="{:U('Friend/addFriend')}">找人</a></li>
            </ul>
        </div>
        <div class="header_right">
            <div class="header_search">
                <input type="text" name="search" placeholder="搜索内容"/>
                <a href="javascript:;">搜索</a>
            </div>
                <div class="header_member">
                    <ul>
                        <li class="info"><a target="_blank" href="{:U('Space/index',array('id'=>session('user_auth')['uid']))}">{:session('user_auth')['username']}</a> </li>
                        <li class="app">消息
                            <dl class="list">
                                <!--
                            <empty name="referCount">
                                <dd><a href="{:U('Setting/mention')}" >@我的消息<em>({$referCount})</em></a></dd>
                                <else/>
                                <dd><a href="{:U('Setting/mention')}" >@我的消息<em class="red">({$referCount})</em></a></dd>
                            </empty>
                            -->
                                <dd><a href="{:U('Setting/mention')}" >@我的消息<em class="referCount">(0)</em></a></dd>
                                <dd><a href="javascript:;" >收到的消息</a></dd>
                                <dd><a href="javascript:;" >发送的消息</a></dd>
                                <dd><a href="javascript:;" >删除消息</a></dd>
                            </dl>
                        </li>
                        <li class="app">账号
                            <dl class="list">
                                <dd><a href="{:U('Setting/index')}" >设置</a></dd>
                                <dd><a href="{:U('Friend/index')}" >好友管理</a></dd>
                                <dd class="line"><a href="{:U('User/logout')}">退出</a></dd>
                            </dl>
                        </li>
                    </ul>
                    <!--
                <empty name="referCount">
                    <else/>
                    <div class="notice">
                        您有{$referCount}条未读消息

                    </div>
                </empty>
                -->
                    <div class="notice" style="display: none">
                        <span class="text">您有0条未读消息</span>
                        <span class="close">x</span>
                    </div>
                </div>
        </div>

    </div>
</div>