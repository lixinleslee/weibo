<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends HomeController {
    public function index(){
        if (!$this->checkLogin()){
            $this->error('请先登录',U('Admin/Admin/login'));
        }
        $this->display();

    }
    public function top(){
        if (!$this->checkLogin()){
            $this->error('请先登录',U('Admin/Admin/login'));
        }
        $this->display();

    }

    public function main(){
        if (!$this->checkLogin()){
            $this->error('请先登录',U('Admin/Admin/login'));
        }
        $this->display();
    }

    public function menu(){
        if (!$this->checkLogin()){
            $this->error('请先登录',U('Admin/Admin/login'));
        }
        $this->display();
    }



}