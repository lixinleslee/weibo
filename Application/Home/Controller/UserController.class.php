<?php
namespace Home\Controller;

class UserController extends HomeController {
    public function index(){
        if (IS_AJAX){

        }else{
            $this->error('非法访问',U('Login/index'));
        }
    }

    public function register(){
        if (IS_AJAX){
            $userModel = D('User');
            $insertId = $userModel->register(I('post.username'),I('post.password'),I('post.notpassword'),I('post.email'));
            echo $insertId;
        }else{
            $this->error('非法访问');
        }

    }

    //login验证
    public function login(){
        //sleep(5);
        if (IS_AJAX){
            $userModel = D('User');
            $usertId = $userModel->login(I('post.username'),I('post.password'),I('post.auto_login'));
            //echo I('post.username');
            echo $usertId;
        }else{
            $this->error('非法访问');
        }

    }
    //用于AJAX验证
    public function checkUsername(){
        //sleep(3);
        if (IS_AJAX){
            $userModel = D('User');
            //验证用户名是否被占用
            $result = $userModel->checkField(I('post.username'),'username');
            //echo $result;
            if ($result==1){
                echo 'true';
            }else{
                echo 'false';
            }
        }

    }
    public function checkEmail(){
        //sleep(5);
        if (IS_AJAX){
            $userModel = D('User');
            //验证用户名是否被占用
            $result = $userModel->checkField(I('post.email'),'email');
            if ($result==1){
                echo 'true';
            }else{
                echo 'false';
            }
            //print_r($result);
        }
    }

    /**
     * 检查验证码
     */
    public function checkVerify(){
        if (IS_AJAX){
            if (check_verify(I('post.verify'),'')){
                echo 'true';
            }else{
                echo 'false';
            }
        }
    }
    /*
     * 退出
     */
    public function logout(){
        //销毁session
        session(null);
        //销毁自动登录的cookie
        cookie('auto',null);
        //跳转
        $this->success('退出成功',U('Login/index'));
    }

    public function ajaxGetUserByName(){
        if (IS_AJAX && !empty(I('post.username'))) {
            $userModel = D('User');
            echo $userModel->getUserByName(I('post.username'));
            //echo 1;
        }else{
            $this->error('非法访问');
        }
    }



}