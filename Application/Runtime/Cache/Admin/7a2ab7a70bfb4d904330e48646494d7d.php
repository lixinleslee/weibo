<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="/weibo/Public/Admin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="/weibo/Public/Admin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/weibo/Public/Admin/js/jquery.validate.js"></script>
<script type="text/javascript" src="/weibo/Public/Admin/js/jquery.form.js"></script>
<link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/easyui/themes/icon.css">
<link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/easyui/themes/color.css">
<link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/css/basic.css">

<script type="text/javascript">
    var ThinkPHP={
        'ROOT':'/weibo',
        'IMG': '/weibo/Public/<?php echo (MODULE_NAME); ?>/image',
        'FACE': '/weibo/Public/<?php echo (MODULE_NAME); ?>/face',
        'AVATAR': '/weibo/Uploads/Face',
        'INDEX':'<?php echo U('Index/Index');?>',
        'MODULE':'/weibo/Admin',
        'COMMENT_SHOW_NUM':<?php echo C('COMMENT_SHOW_NUM');?>,
        'TOPIC_SHOW_NUM':<?php echo C('COMMENT_SHOW_NUM');?>,
        'FRIEND_SHOW_NUM':<?php echo C('FRIEND_SHOW_NUM');?>,
        'PAGE_DIV':<?php echo C('PAGE_DIV');?>,
        'PUBLIC':'/weibo/Public',
    }
</script>
    <link rel="stylesheet" type="text/css" href="/weibo/Public/Admin/css/menu.css">
    <script type="text/javascript" src="/weibo/Public/Admin/js/transport.js"></script>
    <script type="text/javascript" src="/weibo/Public/Admin/js/utils.js"></script>
    <script type="text/javascript" src="/weibo/Public/Admin/js/listtable.js"></script>
    <meta charset="UTF-8">
    <title>Member</title>
</head>
<body style="background: #FFFFFF">
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">

        <table cellspacing="1" cellpadding="3" border="0">
            <tbody>
            <tr>
                <th colspan="6" class="group-title">用户信息</th>
            </tr>
            <tr>
                <th class="title"><a href="javascript:listTable.sort('ad_name'); ">编号</a></th>
                <th class="title"><a href="javascript:listTable.sort('media_type'); ">用户名</a></th>
                <th class="title"><a href="javascript:listTable.sort('start_date'); " title="点击对列表排序">邮箱</a></th>
                <th class="title"><a href="javascript:listTable.sort('end_date'); ">注册时间</a></th>
                <th class="title"><a href="javascript:listTable.sort('click_count'); ">个人域名</a></th>
                <th class="title">操作</th>
            </tr>
            <tr>
                <td class="first-cell" style="background-color: rgb(255, 255, 255);">
                    <span onclick="javascript:listTable.edit(this, 'edit_ad_name', 29)">图片3</span>
                </td>
                <td style="background-color: rgb(255, 255, 255);" align="left"><span><img src="../data/slideimg/thumb/1503584638170906513.jpg" alt="图片3"></span></td>
                <td style="background-color: rgb(255, 255, 255);" align="center"><span>2017-08-27 15:08:59</span></td>
                <td style="background-color: rgb(255, 255, 255);" align="center"><span>http://localhost/ecshop/goods.php?id=72</span></td>
                <td style="background-color: rgb(255, 255, 255);" align="right"><span>0</span></td>
                <td style="background-color: rgb(255, 255, 255);" align="right"><span>
      <a href="slideshow.php?act=edit&amp;id=29" title="编辑"><img src="/weibo/Public/Admin/images/icon_edit.gif" width="16" height="16" border="0"></a>
      <a href="javascript:;" onclick="listTable.remove(29, '您确认要删除这条记录吗?')" title="移除"><img src="/weibo/Public/Admin/images/icon_drop.gif" width="16" height="16" border="0"></a></span>
                </td>
            </tr>
            <tr>
                <td colspan="10" nowrap="true" align="right">      <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
                    <div id="turn-page">
                        总计  <span id="totalRecords">3</span>
                        个记录分为 <span id="totalPages">1</span>
                        页当前第 <span id="pageCurrent">1</span>
                        页，每页 <input size="3" id="pageSize" value="15" onkeypress="return listTable.changePageSize(event)" type="text">
                        <span id="page-link">
          <a href="javascript:listTable.gotoPageFirst()">第一页</a>
          <a href="javascript:listTable.gotoPagePrev()">上一页</a>
          <a href="javascript:listTable.gotoPageNext()">下一页</a>
          <a href="javascript:listTable.gotoPageLast()">最末页</a>
          <select id="gotoPage" onchange="listTable.gotoPage(this.value)">
            <option value="1">1</option>          </select>
        </span>
                    </div>
                </td>
            </tr>
            </tbody></table>


    </div>
</form>
</body>
</html>