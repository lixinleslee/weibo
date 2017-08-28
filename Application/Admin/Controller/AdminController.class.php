<?php
/**
 * Created by PhpStorm
 * Author:Rico
 * Date: 2017/8/26 0026
 * Time: 16:29
 */
namespace Admin\Controller;
class AdminController extends HomeController{
    /**
     * 登录页
     */
    public function login(){
        if ($this->checkLogin()){
            $this->redirect('Index/Index');
        }else{
            $this->display();
        }

    }

    /**
     * 验证管理员
     */
    public function checkAdmin(){
        $user = D('Admin');
        $result = $user->login(I('post.username','','addslashes'),I('post.password','','addslashes'));
        echo $result;

    }
}