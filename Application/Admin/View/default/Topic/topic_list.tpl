<!DOCTYPE html>
<html lang="en">
<head>
    <include file="Public/head" />
    <link rel="stylesheet" type="text/css" href="__CSS__/menu.css">
    <script type="text/javascript" src="__JS__/topic.js"></script>
    <meta charset="UTF-8">
    <title>Topic</title>
</head>
<body style="background: #FFFFFF">
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">

        <table cellspacing="1" cellpadding="3" border="0">
            <tbody>
            <tr>
                <th colspan="6" class="group-title">微博信息</th>
            </tr>
            <tr class="deal-repeat">
                <th class="title"><a href="javascript:listTable.sort('ad_name'); ">编号</a></th>
                <th class="title"><a href="javascript:listTable.sort('media_type'); ">发布者</a></th>
                <th class="title"><a href="javascript:listTable.sort('start_date'); " title="点击对列表排序">微博内容</a></th>
                <th class="title"><a href="javascript:listTable.sort('end_date'); ">微博类型</a></th>
                <th class="title"><a href="javascript:listTable.sort('click_count'); ">发布时间</a></th>
                <th class="title">操作</th>
            </tr>
                <foreach name="topicInfo" item="info">
                    <tr class="repeat">
                        <td style="background-color: rgb(255, 255, 255);"><span>{$info.auto_id}</span></td>
                        <td style="background-color: rgb(255, 255, 255);" align="left"><span>{$info.username}</span></td>
                        <td style="background-color: rgb(255, 255, 255);" align="center"><span>{$info.content}</span></td>
                        <td style="background-color: rgb(255, 255, 255);" align="center"><span>{$info.type}</span></td>
                        <td style="background-color: rgb(255, 255, 255);" align="right"><span>{$info.create_time}</span></td>
                        <td style="background-color: rgb(255, 255, 255);" align="right"><span>
                          <a href="slideshow.php?act=edit&amp;id=29" title="编辑"><img src="__IMG__/icon_edit.gif" width="16" height="16" border="0"></a>
                          <a href="javascript:;" onclick="listTable.remove({$info.id}, '您确认要删除这条记录吗?')" title="移除"><img src="__IMG__/icon_drop.gif" width="16" height="16" border="0"></a></span>
                        </td>
                    </tr>
                </foreach>
            <tr>
                <td colspan="10" nowrap="true" align="right">      <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
                    <!--
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
                    -->
                    <input type="hidden" class="totalNUm" value="{$totalNum}">
                    <div class="page clearfix" id="pageTopic">

                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</form>
</body>
</html>