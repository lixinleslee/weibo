<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/5/17
 * Time: 14:25
 */
namespace Home\Model;
use Think\Model;

class TopicModel extends Model\RelationModel{
    //自动验证
    protected $_validate=array(
        //-1, 博文长度不合法
        array('content','1,255',-1,self::EXISTS_VALIDATE,'length'),
        array('content_over','0,25',-1,self::EXISTS_VALIDATE,'length'),
    );

    //自动完成
    protected $_auto=array(
        array('create','time',self::MODEL_INSERT,'function'),
    );
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

    /**获取微博内容，并格式化图片URL
     * @param $start  //分页开始
     * @return mixed
     */
    public function getList($start){
        return $this->imageFormat($this->relation(true)
                                        ->table('__TOPIC__ topic,__USER__  user')
                                        ->field('topic.id,topic.content,topic.content_over,topic.uid,topic.create,topic.sourceid,topic.broadcount,topic.comment,topic.recommend,user.username,user.face,user.domain')
                                        ->limit($start,C('TOPIC_SHOW_NUM'))
                                        ->order('topic.create DESC')
                                        ->where('topic.uid=user.id')
                                        ->select()
        );
    }

    /**
     * 获取我关注的好友的微博，并格式化图片
     * @param $start
     * @return mixed
     */
    public function getConcentratedList($uid,$start){

        $result2= $this->imageFormat($this->relation(true)
            ->table('__TOPIC__ topic,__USER__  user,__FRIEND__ c')
            ->field('topic.id,topic.content,topic.content_over,topic.uid,topic.create,topic.sourceid,topic.broadcount,topic.comment,topic.recommend,user.username,user.face,user.domain,c.fid')
            ->limit($start,C('TOPIC_SHOW_NUM'))
            ->order('topic.create DESC')
            ->where('topic.uid=user.id AND c.uid='.$uid.' AND user.id=c.fid')
            ->select()
        );
        //print_r($result2);
        return $result2;
    }

    public function ajaxConcentratedTotalPage($uid){
        $this->table('__TOPIC__ topic,__FRIEND__ c')
            ->where('topic.uid=c.fid AND c.uid='.$uid)
            ->count();
    }

    /**
     * 发布微博
     * @param $allContent   //微博内容
     * @param $uid          //UserID
     * @return int|mixed|string   //返回微博ID
     */
    public function publish($allContent,$uid){
        $content=$content_over = ''; //初始化
        $data =array();             //初始化
        //对博文的长度进行判断，255个字符外需要添加进content_over字段中
        if(mb_strlen($allContent,'utf8')>255){
            //截图字符串,并复制给表字段
            $content = mb_substr($allContent,0,255,'utf8');
            $content_over = mb_substr($allContent,255,25,'utf8');
            $data['uid']=$uid;
            $data['content']=$content;
            $data['content_over']=$content_over;
            //echo  $data['content_over'];
        }else{
            $data['uid']=$uid;
            $data['content']=$allContent;
        }
        //创建数据并插入
        if ($this->create($data)){
            $tId = $this->add();
            if ($tId){
                //解析@用户名
                preg_match_all('/(@\S+)/i',$allContent,$arr);
                foreach ($arr[0] as $key=>$value){
                    //将用户名分离
                    $arr[0][$key] = substr($value,1);
                }
                //将@到的用户名插入mention表中
                $Mention = D('Mention');
                $Mention->insertMentionUser($tId,$uid,$arr[0]);
                return $tId ? : 0;
            }

        }else{
            return $this->getError();
        }

    }

    /**
     * 图片JSON格式处理为URL格式(头像和微博图片)
     * @param $list     //传入的数组
     * @return mixed   //返回数组
     */
    public function imageFormat($list){
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

            //处理时间显示
            $tmp = time() - $list[$key]['create'];  //计算当前时间与发布时间差
            if ($tmp < 60){
                $list[$key]['time'] = '刚刚发布';
            }else if ($tmp<60*60){    //如果是当天且在一个小时内，则显示多少分钟前
                $list[$key]['time'] = floor($tmp/60).'分钟前发布';
            }elseif (date('y-m-d',strtotime('now'))==date('y-m-d',$list[$key]['create'])){   //今天内，大于一小时，则显示多少小时前发布
                $list[$key]['time'] = floor($tmp/60/60).'小时前发布';
            }elseif (date('y-m-d',strtotime('-1 day'))==date('y-m-d',$list[$key]['create'])){   //昨天发布，显示昨天x时x分发布
                $list[$key]['time'] = '昨天'.date('H:i',$list[$key]['create']).'发布';
            }elseif (date('y',strtotime('today'))==date('y',$list[$key]['create'])){   //今年内发布的，显示x月x日发布
                $list[$key]['time'] = date('m月d日 H:i',$list[$key]['create']).'发布';
            }else{
                $list[$key]['time'] = date('Y年m月d日 H:i',$list[$key]['create']).'发布';
            }

            //内容合并
            $list[$key]['content'] .=$list[$key]['content_over'];
            //解析@账号
            $list[$key]['content'] .=' ';  //文末加空格，解决博文只有@账号的情况
            $list[$key]['content'] =preg_replace('/(@)(\S+\s)/i','<a target="_blank" href="" class="atusername">$1$2</a>',$list[$key]['content']);
            //表情解析,添加根路径
            $list[$key]['content'] = preg_replace('/\[em_(\d{0,2})\]/i','<img src="'.__ROOT__.'/Public/Home/face/$1.gif" border="0" />',$list[$key]['content']);
            //头像处理
            $list[$key]['face'] = json_decode($list[$key]['face'],true)['small'];
            //转发微博处理
            if ($list[$key]['sourceid']>0){
                $list[$key]['sourceContent'] = $this->getSourceContent($list[$key]['sourceid']);
            }
        }
        //print_r($list);
      return $list;
    }

    /**
     * 获取转发微博的ID
     * @param $sourceId  //原微博ID
     * @return string
     */
    private function getSourceContent($sourceId){
        return $this->imageFormat2($this->relation(true)
            ->table('__TOPIC__ topic,__USER__  user')
            ->field('topic.id,topic.content,topic.content_over,topic.uid,topic.create,topic.sourceid,topic.broadcount,topic.comment,topic.recommend,user.username,user.face,user.domain')
            ->where('topic.uid=user.id AND topic.id='.$sourceId)
            ->find());
    }

    /**
     * //格式化转发微博的内容
     * @param $list
     * @return mixed
     */
    private function imageFormat2($list){

            //如果不为空则循环
            if (!isArrEmpty($list)){
                foreach ($list['images'] as $key=>$value){
                    //json解码返回数组格式
                    $list['images'][$key] = json_decode($value['source'],true);
                }
                //$list['images']= $value;
            }
            //新增一个统计图片个数的字段
            $list['count']= isArrEmpty($list['images']) ? 0: count($list['images']);

            //处理时间显示
            $tmp = time() - $list['create'];  //计算当前时间与发布时间差
            if ($tmp < 60){
                $list['time'] = '刚刚发布';
            }else if ($tmp<60*60){    //如果是当天且在一个小时内，则显示多少分钟前
                $list['time'] = floor($tmp/60).'分钟前发布';
            }elseif (date('y-m-d',strtotime('now'))==date('y-m-d',$list['create'])){   //今天内，大于一小时，则显示多少小时前发布
                $list['time'] = floor($tmp/60/60).'小时前发布';
            }elseif (date('y-m-d',strtotime('-1 day'))==date('y-m-d',$list['create'])){   //昨天发布，显示昨天x时x分发布
                $list['time'] = '昨天'.date('H:i',$list['create']).'发布';
            }elseif (date('y',strtotime('today'))==date('y',$list['create'])){   //今年内发布的，显示x月x日发布
                $list['time'] = date('m月d日 H:i',$list['create']).'发布';
            }else{
                $list['time'] = date('Y年m月d日 H:i',$list['create']).'发布';
            }

            //内容合并
            $list['content'] .=$list['content_over'];
            //解析@账号
            $list['content'] .=' ';  //文末加空格，解决博文只有@账号的情况
            $list['content'] =preg_replace('/(@)(\S+\s)/i','<a href="" class="atusername">$1$2</a>',$list['content']);
            //表情解析,添加根路径
            $list['content'] = preg_replace('/\[em_(\d{0,2})\]/i','<img src="'.__ROOT__.'/Public/Home/face/$1.gif" border="0" />',$list['content']);
            //头像处理
            $list['face'] = json_decode($list['face'],true)['small'];
            //转发微博处理
            if ($list['sourceid']>0){
                $list['sourceContent'] = $this->getSourceContent($list['sourceid']);
            }

        return $list;
    }

    /**微博转发
     * @param $allContent   //当前转发的内容
     * @param $uid          //当前转发的USERID
     * @param $sourceWeiboId //原始的微博ID
     * @param $reId          //上一个转播者ID
     * @return int|string
     */
    public function reBroadCast($allContent,$uid,$sourceWeiboId,$reId){
        $content=$content_over = ''; //初始化
        $data =array();             //初始化
        //对博文的长度进行判断，255个字符外需要添加进content_over字段中
        if(mb_strlen($allContent,'utf8')>255){
            //截图字符串,并复制给表字段
            $content = mb_substr($allContent,0,255,'utf8');
            $content_over = mb_substr($allContent,255,25,'utf8');
            $data['content']=$content;
            $data['content_over']=$content_over;
            //echo  $data['content_over'];
        }else{
            $data['content']=$allContent;
        }
        $data['uid']=$uid;
        $data['sourceid']=$sourceWeiboId;
        //创建数据并插入
        if ($this->create($data)){
            $insertId = $this->add();
            //如果插入成功，则执行微博转发次数加1
            if ($insertId && empty($reId)){   //当前作者为第一层转播者
                $map['id']=$sourceWeiboId;    //原始微博+1
                $this->where($map)->setInc('broadcount');
            }elseif($insertId && !empty($reId)){  //当前作者转播的第一层转播者的微博，不是转播原始微博
                $map['id']=$reId;    //上层转播者微博+1
                $this->where($map)->setInc('broadcount');
            }
            //取得原作者内容
            $arr=array(
              'sContent'=>$this->getSourceContent($sourceWeiboId),
                'newId'=>$insertId
            );
            //数据插入成功，返回博文ID
//            return $insertId ? : 0;
            return $insertId ? json_encode($arr): 0;
            //echo $this->getLastSql();
        }else{
            return $this->getError();
        }

    }

    /**
     * 点赞处理
     * @param $tid  //微博ID
     * @param $uid  //点赞者的ID
     * @return int  //返回json格式数据
     */
    public function reComment($tid,$uid){
        //先查询用户点赞表中是否已经存在该文章，存在则返回control=-1,否则进行新增动作，并将topic表中的相应微博点赞+1
        $recommend = M('Recommend');
        $map['tid'] = $tid;
        $map['uid'] = $uid;
        $map1['id'] = $tid;
        $result = $recommend->where($map)->field('id')->find();
        if ($result){
            //微博点赞数-1
            $this->where($map1)->setDec('recommend');
            //点赞表删除相应的tid和uid记录
            $recommend->where($map)->delete();
            $arr=array(
                'success'=>1,
                'control'=>-1
            );
            return json_encode($arr);
        }else{
            //相应微博点赞+1
            $this->where($map1)->setInc('recommend');
            $recommend->add($map);
            $arr=array(
                'success'=>1,
                'control'=>1
            );
            return json_encode($arr);
        }
    }

    /**
     * 删除一条微博
     * @param $WBId    //微博ID
     * @return mixed  //返回结果信息
     */
    public function delOneWeibo($WBId){
        $map['id']=$WBId;
          $delWB = $this->relation(true)->where($map)->limit(1)->delete();
          if ($delWB){
              //删除mention表
              $mention =M('Mention');
              $mention->where(array('tid'=>$WBId))->delete();
              $Recommond = M('Recommend');
              $Recommond->where(array('tid'=>$WBId))->delete();
              $Commont = M('Comment');
              $Commont->where(array('tid'=>$WBId))->delete();
              return 1;
          }else{
              //微博删除失败
              return 'false';
          }

    }

}