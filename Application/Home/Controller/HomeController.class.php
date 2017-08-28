<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/5/13
 * Time: 20:59
 */
namespace Home\Controller;
use Think\Controller;

class HomeController extends Controller{
    protected function _initialize(){
        //构造函数，显示提醒信息
        $mention = D('Mention');
        $count = $mention->getMentionCount(session('user_auth')['username']);
        $this->assign('referCount',$count);
    }

    /**
     * @判断状态判断,有session则返回true，否则重定向到登录页
     * @return bool
     */
    protected function checkLogin(){
        //查询cookie是否有值，有值则表示自动登录,判断是否有session，没有则直接保存session
        if (cookie('auto') && !session('?user_auth')) {

            $map['username'] = encryption(cookie('auto'), 1);
            //$map['username'] = 1;
            $user = D('User');
            $user_info = $user->field('id,username,face,domain')->where($map)->find();
            //var_dump($user_info);
            if ($user_info) {
                session('user_auth',array(
                    'username'=>$user_info['username'],
                    'uid'=>$user_info['id'],
                    'face'=>json_decode($user_info['face']),
                    'domain'=>$user_info['domain']
                ));
            }
        }
        //如果有session返回true
        if (session('?user_auth')){
            return true;
        }else{
            //重定向到登录页
            $this->error('请登录',U('Login/index'));
        }
    }
}