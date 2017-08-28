<?php if (!defined('THINK_PATH')) exit(); if(C('LAYOUT_ON')) { echo ''; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>跳转提示</title>
    <style type="text/css">
        body{
            background: #eee;
        }
        .info{
            width:800px;
            height:140px;
            background: #fff;
            margin:200px auto 0 auto;
            padding:100px 0 0 0;
            text-align: center;
        }
        .text{
            display: inline-block;
            height:48px;
            font-size:32px;
            font-weight:bold;
            text-indent:48px;
        }
         .success{
            background: url("/weibo/Public/<?php echo (MODULE_NAME); ?>/image/jump_success.gif") no-repeat;
        }
        .error{
            background: url("/weibo/Public/<?php echo (MODULE_NAME); ?>/image/jump_error.gif") no-repeat;
        }
        .jump{
            text-align: right;
            padding:20px 10px 0 0;
        }
        .jump a{
            text-decoration: none;
            color: #369;
        }
        .jump a:hover{
            color: #f60;
        }
    </style>
</head>
<body>
    <?php
 if($status){ ?>
        <div class="info">
            <span class="text success"><?php echo ($message); ?></span>
            <p class="jump">
                页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
            </p>
        </div>
    <?php
 }else{ ?>
        <div class="info">
            <span class="text error"><?php echo ($error); ?></span>
            <p class="jump">
                页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
            </p>
        </div>
    <?php
 } ?>
    <script type="text/javascript">
        (function(){
            var wait = document.getElementById('wait'),href = document.getElementById('href').href;
            var interval = setInterval(function(){
                var time = --wait.innerHTML;
                if(time <= 0) {
                    location.href = href;
                    clearInterval(interval);
                };
            }, 1000);
        })();
    </script>
</body>
</html>