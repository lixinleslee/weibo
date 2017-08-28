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