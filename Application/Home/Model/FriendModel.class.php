<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/30 0030
 * Time: 17:00
 */
namespace Home\Model;
use Think\Model;

class FriendModel extends Model {

    /**
     * 查询待添加好友总数，全user表查询
     * @return mixed
     */
    public function getFriendCount(){
        $sid = session('user_auth')['uid'];
        $sql = "SELECT count(*) AS total FROM `weibo_user` AS a WHERE NOT EXISTS (SELECT `id` FROM `weibo_friend` AS b WHERE a.id=b.fid AND b.uid='{$sid}') AND a.id<>{$sid} ";
        return $this->query($sql);
    }

    /**
     * 查询用户所关注的好友总数
     * @param $uid          //用户ID
     * @return mixed        //返回总数
     */
    public function getMyConceredCount($uid){
        $sql = "SELECT count(*) AS total FROM `weibo_friend` AS a WHERE a.uid='{$uid}'";
        return $this->query($sql);
    }

    /**
     * 查询关注我的好友总数
     * @param $uid
     * @return mixed
     */
    public function getConcentratedCount($uid){
        $sql = "SELECT count(*) AS total FROM `weibo_friend` AS a WHERE a.fid='{$uid}'";
        return $this->query($sql);
    }
    /**
     * 获取关注的好友
     * @param $uid   //当前用户ID
     * @param int $start   //显示起始值
     * @return mixed   //返回结果集
     */
    public function getFriend($uid,$page){
        $pageStart=($page-1)*C('FRIEND_SHOW_NUM');
        $pageNum=C('FRIEND_SHOW_NUM');
        $map['uid']=$uid;
        $result = $this->join('LEFT JOIN __USER__ ON __FRIEND__.fid=__USER__.id')->where($map)->LIMIT($pageStart,$pageNum)->select();
        return $this->formatFace($result);
    }

    /**
     * 搜索用户
     * @param $type    //搜索类型，1为默认搜索；2为按照昵称搜索；3为按照域名搜索
     * @param $info
     * @return string
     */
    public function search($type,$info,$page=1){
        $result=$sql='';
        $sid = session('user_auth')['uid'];
        $pageNum = C('FRIEND_SHOW_NUM');  //显示条数
        $pageStart = ($page-1)*$pageNum;
        switch ($type){
            case "1":
                //搜索除了本人外的全部并且未添加关注的注册用户
                $sql = "SELECT a.id,a.username,a.domain,a.email,a.face FROM `weibo_user` AS a WHERE NOT EXISTS (SELECT `id` FROM `weibo_friend` AS b WHERE a.id=b.fid AND b.uid='{$sid}') AND a.id<>{$sid} ORDER BY `id` ASC LIMIT {$pageStart},{$pageNum} ";
                break;
            case "2":
                //按域名搜索
                $sql = "SELECT a.id,a.username,a.domain,a.email,a.face FROM `weibo_user` AS a WHERE NOT EXISTS (SELECT `id` FROM `weibo_friend` AS b WHERE a.id=b.fid AND a.domain='{$info}')   ORDER BY `id` ASC  LIMIT {$pageStart},{$pageNum} ";
                break;
            case "3":
                //按昵称搜索
                $sql = "SELECT a.id,a.username,a.domain,a.email,a.face FROM `weibo_user` AS a WHERE NOT EXISTS (SELECT `id` FROM `weibo_friend` AS b WHERE a.id=b.fid AND a.username='{$info}')   ORDER BY `id` ASC  LIMIT {$pageStart},{$pageNum} ";
                break;
        }
        $result=$this->query($sql);
        //处理头像路径，将json格式处理为数组
        return $this->formatFace($result);
    }

    /**
     * 处理用户头像URL，将json格式转换为array模式
     * @param $arr
     * @return mixed
     */
    private function formatFace($arr){
        foreach ($arr as $key=>$value){
            $arr[$key]['face']=json_decode($arr[$key]['face'],true);
        }
        return $arr;

    }

    /**
     * AJAX添加关注
     * @param $uid            //当前用户ID
     * @param $targetId       //被关注人ID
     * @param string $remark  //备注
     * @return bool           //返回布尔值
     */
    public function ajaxAddFriend($uid,$targetId,$remark=''){
        $data=array(
            'uid'=>$uid,
            'fid'=>$targetId,
            'remark'=>$remark
        );
        if ($this->create($data)){
            $result = $this->add();
            if ($result){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * AJAX取消好友关注
     * @param $uid        //当前用户ID
     * @param $targetId   //被取消关注的ID
     * @return bool      //返回布尔值
     */
    public function ajaxRemoveFriend($uid,$targetId){
        $data=array(
            'uid'=>$uid,
            'fid'=>$targetId
        );
        $del = $this->where($data)->delete();
        if ($del){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 查询关注我的用户
     * @param $uid         //当前用户ID
     * @param int $page   //分页起始量
     * @return mixed       //返回结果集
     */
    public function concentrated($uid,$page){
        $pageStart = ($page-1)*C('FRIEND_SHOW_NUM');
        $pageDiv = C('FRIEND_SHOW_NUM');
        $map['fid']=$uid;
        $map2['uid']=$uid;
        $result = $this->join('LEFT JOIN __USER__ ON __FRIEND__.uid=__USER__.id')->where($map)->LIMIT($pageStart,$pageDiv)->select();  //关注我的
        $result1 = $this->field('fid')->where($map2)->select();   //我关注的
        //$re = $this->query($sql);
        //print_r($result);
        //print_r($result1);
        //处理数据，如果两者互相关注了，则在result结果集后面增加一个eachOther字段赋值为1
        foreach ($result as $key=>$value){
            foreach ($result1 as $key2=>$value2) {
                if ($result[$key]['uid']==$result1[$key2]['fid']){
                    $result[$key]['eachOther']=1;
                }
            }
        }
        //print_r($result);
        return $this->formatFace($result);
    }

}