<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/30 0030
 * Time: 16:57
 * @好友管理
 */
namespace Home\Controller;
class FriendController extends HomeController{
    /**
     * 显示关注的好友
     */
    public function index(){
        $friend = D('Friend');
        $count = $friend->getMyConceredCount(session('user_auth')['uid']);
        $page = I('post.page','',false)?:1;
        $info = $friend->getFriend(session('user_auth')['uid'],$page);
        $this->assign('userInfo',$info);
        //print_r($info);
        $this->assign('totalNum',$count[0]['total']);
        $this->display();
    }

    /**
     * AJAX分页获取我关注的好友
     */
    public function ajaxGetConceredFriend(){
        $friend = D('Friend');
        $page = I('post.page','',false)?:1;
        $info = $friend->getFriend(session('user_auth')['uid'],$page);
        //print_r($info);
        $this->assign('userInfo',$info);
        $this->display();
    }

    /**
     * 添加好友方法
     */
    public function addFriend(){
        //获得全部用户数量,一般只有按照默认搜索才会出现分页，因此在页面调用时统计全部待添加好友数量
        $friend = D('Friend');
        $total = $friend->getFriendCount();
        $this->assign('totalNum',$total[0]['total']);
        $this->display();
    }

    /**
     * AJAX搜索好友
     */
    public function ajaxSearchFriend(){
        //sleep(3);
        $type = I('post.searchType') ?: json_decode(I('post.dataArr','',false),true)['searchType'];
        $info = I('post.searchText')?: json_decode(I('post.dataArr','',false),true)['searchText'];
        $page=I('post.page')?:1;
        $friend = D('Friend');
        $getResult = $friend->search($type,$info,$page);
        //print_r($getResult);
        $this->assign('userInfo',$getResult);
        $this->display();
    }

    /**
     * 查询关注我的用户
     */
    public function concentrated(){
        $friend = D('Friend');
        $page = I('post.page','',false)?:1;
        $count = $friend->getConcentratedCount(session('user_auth')['uid']);
        $info = $friend->concentrated(session('user_auth')['uid'],$page);
        $this->assign('totalNum',$count[0]['total']);
        $this->assign('userInfo',$info);
        //print_r($info);
        $this->display();
    }

    /**
     * ajax获取关注我的好友
     */
    public function ajaxConcentrated(){
        $page=I('post.page')?:1;
        $friend = D('Friend');
        $page=I('post.page')?:1;
        $info = $friend->concentrated(session('user_auth')['uid'],$page);
        $this->assign('userInfo',$info);
        $this->display();
    }

    /**
     * AJAX添加关注
     */
    public function ajaxAddFriend(){
        //sleep(3);
        $friend = D('Friend');
        $result = $friend->ajaxAddFriend(session('user_auth')['uid'],I('post.personId'));
        echo $result;
    }

    /**
     * AJAX取消关注
     */
    public function ajaxRemoveFriend(){
        //sleep(3);
        $friend = D('Friend');
        $result = $friend->ajaxRemoveFriend(session('user_auth')['uid'],I('post.personId'));
        echo $result;
    }

}