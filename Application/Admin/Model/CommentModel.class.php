<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/8/27
 * Time: 23:25
 */
namespace Admin\Model;
use Think\Model;

class CommentModel extends Model\RelationModel{

    /**
     * 查询总记录数
     * @return mixed
     */
    public function getTotalCount(){
        $count = $this->where('1=1')->count();
        return $count;
    }

    /**获取评论
     * @param $page    //分页ID
     * @return mixed    //返回结果
     */
    public function getCommentList($page=1){
        $start = ($page-1) * C('ADMIN_COMMENT_NUM');
        return $this->format($this->relation(true)
            ->table('__COMMENT__ comment,__USER__  user')
            ->field('comment.content,comment.content_over,comment.comment_time,user.username,user.face,user.domain')
            ->limit($start,C('ADMIN_COMMENT_NUM'))
            ->order('comment.comment_time DESC')
            ->where('comment.uid=user.id')
            ->select(),$start);
    }

    /**
     * 格式化评论内容
     * @param $list
     * @param int $start
     * @return mixed
     */
    private function format($list,$start=0){
        foreach ($list as $key=>$value) {
            //如果不为空则循环
            if (!is_null($value)) {
                foreach ($value['images'] as $key2 => $value2) {
                    //json解码返回数组格式
                    $value['images'][$key2] = json_decode($value2['source'], true);
                }
                $list[$key] = $value;
            }
            //新增一个统计图片个数的字段
            $list[$key]['count'] = isArrEmpty($list[$key]['images']) ? 0 : count($list[$key]['images']);
            if ($list[$key]['count']){
                $list[$key]['type'] = '图片评论';
            }else{
                $list[$key]['type'] = '文本评论';
            }
            //处理时间显示
            $list[$key]['comment_time'] = date('Y-m-d H:m:s',$list[$key]['comment_time']);  //计算当前时间与发布时间差
            //内容合并
            $list[$key]['content'] .= $list[$key]['content_over'];
            //解析@账号
            $list[$key]['content'] .= ' ';  //文末加空格，解决博文只有@账号的情况
            $list[$key]['content'] = preg_replace('/(@)(\S+\s)/i', '<a href="" class="atusername">$1$2</a>', $list[$key]['content']);
            //表情解析,添加根路径
            $list[$key]['content'] = preg_replace('/\[em_(\d{0,2})\]/i', '<img src="' . __ROOT__ . '/Public/Home/face/$1.gif" border="0" />', $list[$key]['content']);
            //头像处理
            $list[$key]['face'] = json_decode($list[$key]['face'], true)['small'];
            //格式化编号
            $list[$key]['auto_id'] = intval($start)+(intval($key)+1);
        }
        //print_r($list);
        return $list;
    }

}