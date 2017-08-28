<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/5/17
 * Time: 14:25
 */
namespace Home\Model;
use Think\Model;

class MentionModel extends Model\RelationModel{

    //自动完成
    protected $_auto=array(
        array('comment_time','time',self::MODEL_INSERT,'function'),
    );
    //关联模型
    protected $_link=array(
      'Topic'=>array(
          'mapping_type'=>self::BELONGS_TO,
          'foreign_key'=>'tid',
          'mapping_fields'=>'content,content_over',
          'mapping_name'=>'topic',
      ),
        'User'=>array(
            'mapping_type'=>self::BELONGS_TO,
            'foreign_key'=>'tuid',
            'mapping_fields'=>'username',
            'mapping_name'=>'tUsername'
        )
    );

    //将提及到的内容插入数据库
    /**
     * 在发布微博时，将提及到的用户放入数据库和缓存文件
     * @param $tid   //TpoicID
     * @param $tuid  //微博作者ID
     * @param $contentArr  //需要插入的用户名一维数组，只能是用户名，不能包含@符号
     */
    public function insertMentionUser($tid,$tuid,$contentArr){
        //如果插入的数据有值
        //print_r($contentArr);
        if (!isArrEmpty($contentArr)){
            $data=array();
            $data['tid']=$tid;
            $data['tuid']=$tuid;

            foreach ($contentArr as $key=>$value){
                $data['username'] = $value;
                $this->add($data);
                //echo $this->getLastSql();
                //将数据写入缓存
                if (S(C('REFER_PREFIX').$value)){
                    S(C('REFER_PREFIX').$value,S(C('REFER_PREFIX').$value)+1);
                }else{
                    S(C('REFER_PREFIX').$value,1);
                }

            }
        }
    }

    /**
     * //根据用户名查询是否被提及到
     * @param $username  //用户名
     * @return mixed    //返回信息集合
     */
    public function getMentionUser($username){
        $map['username'] = $username;
        $result = $this->relation(true)->where($map)->field('id,tid,tuid,is_read')->order('id DESC')->select();
        return $result;
        //print_r($result);
    }

    //查询被提及到的总记录数
    public function getMentionCount($username){
        //S(null);
        $result = $this->relation(true)->where(array('username'=>$username,'is_read'=>0))->field('id')->count();
        return $result;
    }

    //设置阅读标志位
    public function setRead($id){
        $map['id']=$id;
        $data['is_read']=1;
        //更新缓存数据
        if (S(C('REFER_PREFIX').session('user_auth')['username'])){
            S(C('REFER_PREFIX').session('user_auth')['username'],S(C('REFER_PREFIX').session('user_auth')['username'])-1);
        }else{
            S(C('REFER_PREFIX').session('user_auth')['username'],0);
        }
        return $this->where($map)->save($data);
    }
}