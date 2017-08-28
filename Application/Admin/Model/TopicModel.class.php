<?php
/**
 * Created by PhpStorm
 * Author:Rico
 * Date: 2017/8/27 0027
 * Time: 16:25
 */
namespace Admin\Model;
use Think\Model;

class TopicModel extends Model\RelationModel {
    //一对多关联微博查询
    protected $_link=array(
        'Images'=>array(
            'mapping_type'=>self::HAS_MANY,
//            'class_name'=>'Images',
            'foreign_key'=>'tid',
            'mapping_fields'=>'source',
            'mapping_name'=>'images',
        )
    );

    /**
     * 查询总记录数
     * @return mixed
     */
    public function getTotalCount(){
        $count = $this->where('1=1')->count();
        return $count;
    }

    /**获取微博内容，并格式化图片URL
     * @param $start  //分页开始
     * @return mixed
     */
    public function getList($page=1){
        $start = ($page-1) * C('ADMIN_TOPIC_NUM');
        return $this->imageFormat($this->relation(true)
            ->table('__TOPIC__ topic,__USER__  user')
            ->field('topic.id,topic.content,topic.content_over,topic.uid,topic.create,topic.sourceid,topic.broadcount,topic.comment,topic.recommend,user.username,user.face,user.domain')
            ->limit($start,C('ADMIN_TOPIC_NUM'))
            ->order('topic.create DESC')
            ->where('topic.uid=user.id')
            ->select(),$start
        );
    }

    /**
     * 图片JSON格式处理为URL格式(头像和微博图片)
     * @param $list     //传入的数组
     * @param $start  //分页量，用于计算显示的编号
     * @return mixed   //返回数组
     */
    public function imageFormat($list,$start=0){
        foreach ($list as $key=>$value){
            //如果不为空则循环
            if (!is_null($value)){
                foreach ($value['images'] as $key2=>$value2){
                    //json解码返回数组格式
                    $value['images'][$key2] = json_decode($value2['source'],true);
                }
                $list[$key] = $value;
            }
            //新增一个统计图片个数的字段
            $list[$key]['count']= isArrEmpty($list[$key]['images']) ? 0: count($list[$key]['images']);

            if ($list[$key]['count']){
                $list[$key]['type'] = '图片微博';
            }else{
                $list[$key]['type'] = '文本微博';
            }

            //处理时间显示
            $list[$key]['create_time'] = date('Y-m-d H:m:s',$list[$key]['create']);  //计算当前时间与发布时间差

            //内容合并
            $list[$key]['content'] .=$list[$key]['content_over'];
            //解析@账号
            $list[$key]['content'] .=' ';  //文末加空格，解决博文只有@账号的情况
            $list[$key]['content'] =preg_replace('/(@)(\S+\s)/i','<a target="_blank" href="" class="atusername">$1$2</a>',$list[$key]['content']);
            //表情解析,添加根路径
            $list[$key]['content'] = preg_replace('/\[em_(\d{0,2})\]/i','<img src="'.__ROOT__.'/Public/Home/face/$1.gif" border="0" />',$list[$key]['content']);
            //头像处理
            $list[$key]['face'] = json_decode($list[$key]['face'],true)['small'];
            //显示的编号处理
            $list[$key]['auto_id'] = intval($start)+(intval($key)+1);
        }
        //print_r($list);
        return $list;
    }

}