<?php
/**
 * Created by PhpStorm
 * Author:Rico
 * Date: 2017/8/26 0026
 * Time: 15:02
 */
namespace Admin\Controller;
use Think\Controller;

class HomeController extends Controller{
    protected function checkLogin(){
        if (session('?admin_auth')){
            return true;
        }else{
            //重定向到登录页
            //$this->error('请登录',U('Admin/Admin/login'));
            return false;
        }
    }
}