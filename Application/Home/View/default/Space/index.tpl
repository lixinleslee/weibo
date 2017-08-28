<extend name="Base/common"/>
<block name="head">
    <script type="text/javascript" src="__JS__/base.js"></script>
    <script type="text/javascript" src="__JS__/space.js"></script>
    <link rel="stylesheet" type="text/css" href="__CSS__/base.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/space.css"/>
</block>
<block name="main">
    <div class="main_left">
        <div class="top">
            <dl class="clearfix">

                <dt>
                    <empty name="faceUrl">
                        <img src="__IMG__/big.gif">
                        <else/>
                        <img src="__ROOT__/{$faceUrl}">
                    </empty>

                </dt>
                <dd>昵称：{$username}</dd>
                <dd>生日：{$birthday}</dd>
                <dd>简介：{$intro}</dd>
            </dl>
        </div>
    </div>
    <div class="main_right">
        rigth
    </div>
</block>