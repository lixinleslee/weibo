<?php
return array(
	//'配置项'=>'配置值'
    //设置访问目录
    'MODULE_ALLOW_LIST'=>array('Home','Admin'),
    //设置模板后缀
    'TMPL_TEMPLATE_SUFFIX'  =>  '.tpl',
    //设置默认主题
    'DEFAULT_THEME'=>'default',
    //数据库配置
    //数据库类型
    'DB_TYPE'   => 'pdo',
    'DB_USER'   => 'root',
    'DB_PWD'    => 'root',
    'DB_PREFIX' => 'weibo_',
    'DB_DSN'    => 'mysql:host=localhost;dbname=weibo;charset=UTF8',
    //URL模式
    'URL_MODEL'=>2,
    //打开页面trace
    //'SHOW_PAGE_TRACE' =>true,
//    'HTML_CACHE_ON'     =>false,
//    'DB_SQL_BUILD_CACHE' => false,
    //定义秘钥
    'SECURITY_KEY'=>'LESLEE',
    //跳转页面模板
    'TMPL_ACTION_ERROR' => '/Public/jump',
    'TMPL_ACTION_SUCCESS' => '/Public/jump',
    //文件上传路径
    'UPLOAD_PATH'=>'./Uploads/',
    'DEFAULT_TIMEZONE'      =>  'PRC',
    'FACE_PATH'=>'./Uploads/Face/',
    //开启路由功能
    'URL_ROUTER_ON'=>true,
    //配置路由规则
    'URL_ROUTE_RULES'=>array(
        'i/:domain'=>'Space/index'
        //等效域名Space/index/i/domain
    ),
    //微博显示条数
    'TOPIC_SHOW_NUM'=>5,
    //评论显示条数
    'COMMENT_SHOW_NUM'=>1,
    //好友显示条数
    'FRIEND_SHOW_NUM'=>6,
    //分页跨度如：首页..34567..尾页,当前页左右显示两个页码
    'PAGE_DIV'=>4,
    //被提及保存前缀
    'REFER_PREFIX'=>'referCount'
);