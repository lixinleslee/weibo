<?php if (!defined('THINK_PATH')) exit(); if(is_array($topicInfo)): foreach($topicInfo as $key=>$info): ?><tr class="repeat">
        <td style="background-color: rgb(255, 255, 255);"><span><?php echo ($info["auto_id"]); ?></span></td>
        <td style="background-color: rgb(255, 255, 255);" align="left"><span><?php echo ($info["username"]); ?></span></td>
        <td style="background-color: rgb(255, 255, 255);" align="center"><span><?php echo ($info["content"]); ?></span></td>
        <td style="background-color: rgb(255, 255, 255);" align="center"><span><?php echo ($info["type"]); ?></span></td>
        <td style="background-color: rgb(255, 255, 255);" align="right"><span><?php echo ($info["create_time"]); ?></span></td>
        <td style="background-color: rgb(255, 255, 255);" align="right"><span>
                <a href="slideshow.php?act=edit&amp;id=29" title="编辑"><img src="/weibo/Public/Admin/images/icon_edit.gif" width="16" height="16" border="0"></a>
                <a href="javascript:;" onclick="listTable.remove(<?php echo ($info["id"]); ?>, '您确认要删除这条记录吗?')" title="移除"><img src="/weibo/Public/Admin/images/icon_drop.gif" width="16" height="16" border="0"></a></span>
        </td>
    </tr><?php endforeach; endif; ?>