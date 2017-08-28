<?php
namespace Home\Controller;
class SpaceController extends HomeController {
    //首页显示
    public function index($id=0,$domain=''){
        if (empty($id) && empty($domain)) $this->error('非法访问');
        if ($this->checkLogin()){
            //一对一查询用户信息
            $info='';

            $User = D('User');
            if ((!empty($id) && is_numeric($id))){
                $info = $User->getUser($id);
                //域名查询用户
            }elseif(!empty($domain)){
                $info = $User->getUserByDomain($domain);
            }else{
                $this->error('非法访问');
            }
            if ($info){

                $this->assign('faceUrl',json_decode($info['face'])->big);
                $this->assign('username',$info['username']);
                $this->assign('intro',$info['info']['intro']);
                $this->assign('birthday',$info['info']['birthday']);
                $this->display();
            }else{
                $this->error('不存在此用户');
            }

        }
    }
}