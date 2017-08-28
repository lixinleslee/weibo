<meta charset="UTF-8">
<meta name="toTop" content="true">
<title>微博系统</title>
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="__CSS__/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="__CSS__/jquery-ui.structure.css"/>

<block name="head"></block>
<script type="text/javascript">
    var ThinkPHP={
        'ROOT':'__ROOT__',
        'IMG': '__ROOT__/Public/{$Think.MODULE_NAME}/image',
        'FACE': '__ROOT__/Public/{$Think.MODULE_NAME}/face',
        'AVATAR': '__ROOT__/Uploads/Face',
        'INDEX':'{:U('Home/Index')}',
        'MODULE':'__MODULE__',
        'COMMENT_SHOW_NUM':{:C('COMMENT_SHOW_NUM')},
        'TOPIC_SHOW_NUM':{:C('COMMENT_SHOW_NUM')},
        'FRIEND_SHOW_NUM':{:C('FRIEND_SHOW_NUM')},
        'PAGE_DIV':{:C('PAGE_DIV')},
        'PUBLIC':'__PUBLIC__',
    }
</script>