<?php
namespace Home\Controller;
use Think\Verify;

class LoginController extends HomeController {
    public function index(){
        //如果有session，则跳转到首页
        if (!session('?:user_auth')){
            $this->display();
        }else{
            $this->redirect('Home/index');
        }
//        $this->display();

    }
    public function verify(){
        $verify = new Verify();
        $verify->entry();
        //$verify_code = session('','');
        //print_r(session());
        //session('name','a');
    }

}