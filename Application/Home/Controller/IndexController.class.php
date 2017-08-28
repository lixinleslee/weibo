<?php
namespace Home\Controller;
class IndexController extends HomeController {
    //首页显示
    public function index(){
        if ($this->checkLogin()){
            $Topic = D('Topic');
            $weiboContent = $Topic->getList(0);
            $this->assign('topic',$weiboContent);
            $this->assign('smallFace',session('user_auth')['face']->small);
            $this->assign('bigFace',session('user_auth')['face']->big);
            $this->assign('domain',session('user_auth')['domain']);
            //$this->assign('sourceContent',$weiboContent[0]['sourceContent'][0]);
            //print_r(session('user_auth'));
            //print_r(session('user_auth'));
            //print_r($weiboContent);
            $this->display('Topic:default');
        }

    }



}