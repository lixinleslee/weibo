<extend name="Base/common"/>
<block name="head">
    <link rel="stylesheet" href="__CSS__/base.css" type="text/css">
    <link rel="stylesheet" href="__CSS__/setting.css" type="text/css">
    <link rel="stylesheet" href="__CSS__/cropper.css" type="text/css">
    <link rel="stylesheet" href="__CSS__/faceCrop.css" type="text/css">
    <link rel="stylesheet" href="__CSS__/pekeUpload.css" type="text/css">
    <script type="text/javascript" src="__JS__/base.js"></script>
    <script type="text/javascript" src="__JS__/jquery.validate.js"></script>
    <script type="text/javascript" src="__JS__/pekeUpload.js"></script>
    <script type="text/javascript" src="__JS__/cropper.js"></script>
    <script type="text/javascript" src="__JS__/faceCrop.js"></script>
    <script type="text/javascript" src="__JS__/setting.js"></script>
</block>
<block name="main">
<div class="main_left">
    <ul>
        <li><a href="{:U('Setting/index')}" >个人设置</a> </li>
        <li><a href="{:U('Setting/face')}" class="selected" >头像设置</a> </li>
        <li><a href="{:U('Setting/domain')}">域名设置</a> </li>
        <li><a href="{:U('Setting/mention')}">@提及到我</a> </li>
    </ul>
</div>
<div class="main_right">
    <!--头像裁剪-->
    <div id="head">
        <div class="container">
            <div class="row firstRow" >
                <div class="col-md-9 faceLeft">
                    <!-- <h3 class="page-header">Demo:</h3> -->
                    <div class="img-container">
                        <img src="" alt="图片" id="headImg">
                    </div>
                </div>
                <div class="col-md-3 faceRight">
                    <!-- <h3 class="page-header">Preview:</h3> -->
                    <div class="docs-preview clearfix">
                        <div class="img-preview preview-lg"></div>
                        <div class="img-preview preview-md"></div>
                        <div class="img-preview preview-sm"></div>
                        <div class="img-preview preview-xs"></div>
                    </div>

                    <!-- <h3 class="page-header">Data:</h3> -->
                    <input class="form-control" id="dataX" type="hidden" placeholder="x">
                    <input class="form-control" id="dataY" type="hidden" placeholder="y">
                    <input class="form-control" id="dataWidth" type="hidden" placeholder="width">
                    <input class="form-control" id="dataHeight" type="hidden" placeholder="height">
                    <input class="form-control" id="dataRotate" type="hidden" placeholder="rotate">
                </div>
                <div style="clear: both"></div>
            </div>
            <div class="row">
                <div class="col-md-9 docs-buttons icons">
                    <!-- <h3 class="page-header">Toolbar:</h3> -->
                    <div class="btn-group">
                        <button class="btn btn-primary" data-method="setDragMode" data-option="move" type="button" title="移动">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
                              <span class="icon icon-move"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="setDragMode" data-option="crop" type="button" title="裁剪">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)">
                              <span class="icon icon-crop"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="zoom" data-option="0.1" type="button" title="缩小">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
                              <span class="icon icon-zoom-in"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="zoom" data-option="-0.1" type="button" title="放大">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
                              <span class="icon icon-zoom-out"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button" title="向左旋转">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, -45)">
                              <span class="icon icon-rotate-left"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="rotate" data-option="45" type="button" title="向右旋转">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, 45)">
                              <span class="icon icon-rotate-right"></span>
                            </span>
                        </button>
                    </div>

                    <div class="btn-group second-group">
                        <button class="btn btn-primary" data-method="disable" type="button" title="关闭裁剪">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;disable&quot;)">
                              <span class="icon icon-lock"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="enable" type="button" title="打开裁剪">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;enable&quot;)">
                              <span class="icon icon-unlock"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="clear" type="button" title="清除">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;clear&quot;)">
                              <span class="icon icon-remove"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="reset" type="button" title="重置">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;reset&quot;)">
                              <span class="icon icon-refresh"></span>
                            </span>
                        </button>
                        <button class="btn btn-primary" data-method="destroy" type="button" title="注销">
                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;destroy&quot;)">
                              <span class="icon icon-off"></span>
                            </span>
                        </button>
                    </div>

                    <button class="btn btn-primary submitBtn" data-method="getData" data-option="" data-target="#putData" type="button">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getData&quot;)">
                            完成
                          </span>
                    </button>
                    <input class="form-control" id="putData" type="hidden" >
                    <input class="form-control" id="sourceUrl" type="hidden" value="">
                </div><!-- /.docs-buttons -->
            </div>
            <!----->
            <div style="clear: both"></div>
        </div>
        <div id="faceUpload">
            <input id="file" type="file" name="file" />
        </div>
    </div>

</div>
    <div id="inform">
        <p class="inform_default"><span>数据加载中...</span></p>
    </div>
</block>