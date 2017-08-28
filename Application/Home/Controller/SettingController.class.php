<?php
namespace Home\Controller;
class SettingController extends HomeController {
    //首页显示
    public function index(){
        if ($this->checkLogin()){
            //一对一查询用户信息
            $User = D('User');
            $info = $User->getUser(session('user_auth')['uid']);
            $this->assign('user',$info);
            $this->display();
        }

    }

    //域名查询
    public function domain(){
        if ($this->checkLogin()){
            //一对一查询用户域名
            $User = D('User');
            $info = $User->getUser(session('user_auth')['uid']);
            $this->assign('domain',$info['domain']);
            $this->display();
        }else{
            $this->error('请登录',U('Login/index'));
        }

    }

    //@提及到我
    public function mention(){
        if ($this->checkLogin()){
            $mention = D('Mention');
            $result = $mention->getMentionUser(session('user_auth')['username']);
            $count = $mention->getMentionCount(session('user_auth')['username']);
            //合并微博的content和content_over内容
            foreach ($result as $key=>$value){
                $result[$key]['content'] = $result[$key]['topic']['content'].$result[$key]['topic']['content_over'];
            }
            //print_r($result);
            $this->assign('count',$count);
            $this->assign('getList',$result);
            $this->display();
        }else{
            $this->error('请登录',U('Login/index'));
        }
    }

    //AJAX设置阅读标志位
    public function setRead(){
        if (IS_AJAX){
            $setRead = D('Mention');
            $result = $setRead->setRead(I('post.id'));
            echo $result;
        }else{
            $this->error('非法访问');
        }
    }

    //注册域名
    public function registerDomain(){
        if (IS_AJAX){
            //sleep(3);
            $UserUpdate = D('User');
            $result = $UserUpdate->domainUpdate(session('user_auth')['uid'],I('post.domain'));
            echo $result;
        }else{
            $this->error('非法访问');
        }
    }

    /**
     * 查询用户头像
     */
    public function face(){
        if ($this->checkLogin()){
            //一对一查询用户信息
            $User = D('User');
            $info = $User->getUser(session('user_auth')['uid']);
            $this->assign('user',$info);
            $this->display();
        }

    }

    /**
     * 用户信息更新
     */
    public function userUpdate(){
        if (IS_AJAX){
            //sleep(3);
            $UserUpdate = D('User');
            $result = $UserUpdate->userUpdate(session('user_auth')['uid'],I('post.email'),I('post.intro'));
            echo $result;
        }else{
            $this->error('非法访问');
        }
    }

}