<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/5/17
 * Time: 14:25
 */
namespace Home\Model;
use Think\Model;

class CommentModel extends Model\RelationModel{
    //自动验证
    protected $_validate=array(
        //-1, 博文长度不合法
        array('content','1,255',-1,self::EXISTS_VALIDATE,'length'),
        array('content_over','0,25',-1,self::EXISTS_VALIDATE,'length'),
    );

    //自动完成
    protected $_auto=array(
        array('comment_time','time',self::MODEL_INSERT,'function'),
    );

    /**
     * 微博评论
     * @param $tid    //微博ID
     * @param $uid    //评论人ID
     * @param $content  //评论内容
     * @return int|mixed|string
     */
    public function wbComment($tid,$uid,$content){
        $map['id']=$tid;
        $data =array();
        $data['tid']=$tid;
        $data['uid'] = $uid;
        $data['content']=$content;
        if($this->create($data)){
            $back=array();
            $commentId = $this->add();
            $back['cid']=$commentId;  //评论ID
            if ($commentId){
                //将对应的微博评论次数+1
                $wbComment = M('Topic');
                //$wbComment->add();
                $wbComment->where($map)->setInc('comment');
                //查询出该文章评论次数
                $wd = $wbComment->field('comment')->where($map)->find();
                //json格式返回微博评论次数和该条评论ID
                $back['tComment']=$wd['comment'];  //微博的评论次数；可以直接在客户端+1，也可以查询服务器数据显示
                return json_encode($back);
            }else{
                return json_encode($back);
            }
        }else{
            return $this->getError();
        }
    }

    //获取评论
    /**获取评论
     * @param $tid      //微博ID
     * @param $start    //分页起始量
     * @return mixed    //返回结果
     */
    public function getComment($tid,$start){
        return $this->format($this->relation(true)
            ->table('__COMMENT__ comment,__USER__  user')
            ->field('comment.content,comment.content_over,comment.comment_time,user.username,user.face,user.domain')
            ->limit($start,C('COMMENT_SHOW_NUM'))
            ->order('comment.comment_time DESC')
            ->where('comment.uid=user.id AND comment.tid='.$tid)
            ->select());
    }

    //格式化
    private function format($list){
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

            //处理时间显示
            $tmp = time() - $list[$key]['comment_time'];  //计算当前时间与发布时间差
            if ($tmp < 60) {
                $list[$key]['time'] = '刚刚发布';
            } else if ($tmp < 60 * 60) {    //如果是当天且在一个小时内，则显示多少分钟前
                $list[$key]['time'] = floor($tmp / 60) . '分钟前发布';
            } elseif (date('y-m-d', strtotime('now')) == date('y-m-d', $list[$key]['comment_time'])) {   //今天内，大于一小时，则显示多少小时前发布
                $list[$key]['time'] = floor($tmp / 60 / 60) . '小时前发布';
            } elseif (date('y-m-d', strtotime('-1 day')) == date('y-m-d', $list[$key]['comment_time'])) {   //昨天发布，显示昨天x时x分发布
                $list[$key]['time'] = '昨天' . date('H:i', $list[$key]['comment_time']) . '发布';
            } elseif (date('y', strtotime('today')) == date('y', $list[$key]['comment_time'])) {   //今年内发布的，显示x月x日发布
                $list[$key]['time'] = date('m月d日 H:i', $list[$key]['comment_time']) . '发布';
            } else {
                $list[$key]['time'] = date('Y年m月d日 H:i', $list[$key]['comment_time']) . '发布';
            }
            //内容合并
            $list[$key]['content'] .= $list[$key]['content_over'];
            //解析@账号
            $list[$key]['content'] .= ' ';  //文末加空格，解决博文只有@账号的情况
            $list[$key]['content'] = preg_replace('/(@)(\S+\s)/i', '<a href="" class="atusername">$1$2</a>', $list[$key]['content']);
            //表情解析,添加根路径
            $list[$key]['content'] = preg_replace('/\[em_(\d{0,2})\]/i', '<img src="' . __ROOT__ . '/Public/Home/face/$1.gif" border="0" />', $list[$key]['content']);
            //头像处理
            $list[$key]['face'] = json_decode($list[$key]['face'], true)['small'];
        }
        //print_r($list);
        return $list;
    }

}