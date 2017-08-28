<?php
/**
 * Created by PhpStorm
 * Author:Rico
 * Date: 2017/8/27 0027
 * Time: 14:42
 */
namespace Admin\Controller;
class UserController extends HomeController{

    /**
     * 取得首页数据的用户
     */
    public function Member_list(){
        $User = D('User');
        $userInfo = $User->getAllMember(1);
        $this->assign('totalNum',$User->getTotalCount());
        $this->assign('userInfo',$userInfo);
        //print_r($userInfo);
        $this->display();
    }

    public function ajaxLoadUser(){
        if (IS_AJAX){
            $User = D('User');
            $page = I('post.page','','addslashes');
            $userInfo = $User->getAllMember($page);
            $this->assign('userInfo',$userInfo);
            $this->display();
        }else{
            $this->error('非法操作!');
        }
    }
}