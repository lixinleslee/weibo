<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/5/17
 * Time: 14:22
 */
namespace Home\Controller;
use Think\Controller;

class TopicController extends HomeController{
    public function index(){

    }
    //博文发布
    public function publish(){
        //sleep(3);
        //如果为AJAX提交，则处理数据
        if (IS_AJAX){
            $tid =null;
            //先发布微博
            $topic = D('Topic');
            $tid = $topic->publish(I('post.content'),session('user_auth')['uid']);
            //如果微博发布成功，则保存图片
            if ($tid){
                //不再对进行图片二次编码
                $img = I('post.images','',false);
                //echo strlen($img[0]);
                //多图时，数组保存图片
                if (isset($img)){
                    $imgModel = D('Images');
                    //图片保存成功则返回TID，否则返回0
                    echo $imgModel->saveImg($img,$tid) ? $tid :0;
                }else{
                    //
                    echo $tid;
                }
            }else{
                echo '0';
            }

        }else{
            //跳转到登录页
            $this->error('非法访问',U('Login/index'));
        }
    }

    /**
     * 微博默认列表
     */
    public function ajaxGetDefault(){
        //sleep(3);
        if (IS_AJAX){
            $Topic = D('Topic');
            $weiboContent = $Topic->getList(0);
            $this->assign('topic',$weiboContent);
            //print_r(session('user_auth'));
            //print_r(session('user_auth'));
            //print_r($weiboContent);
            $this->display('Topic:ajaxLoad');
        }else{
            $this->error('非法访问');
        }
    }

    /**
     * 我关注的列表
     */
    public function ajaxGetConcentrated(){
       // if (IS_AJAX){
            $Topic = D('Topic');
            $weiboContent = $Topic->getConcentratedList(session('user_auth')['uid'],I('post.start'));
            $this->assign('topic',$weiboContent);
            //print_r(session('user_auth'));
            //print_r(session('user_auth'));
            //print_r($weiboContent);
            $this->display('Topic:ajaxLoad');
       //}else{
        //    $this->error('非法访问');
        //}
    }

    /**
     * AJAX请求加载更多微博
     *
     */
    public function ajaxLoad(){
        sleep(5);
        if (IS_AJAX){
            $Topic = D('Topic');
            $weiboContent = $Topic->getList(I('post.start'));  //加载起始项
            //$weiboContent = $Topic->getList(10);  //加载起始项
            $this->assign('topic',$weiboContent);
            //print_r($weiboContent);
            $this->display();
        }else{
            $this->error('非法访问');
        }
    }

    /**
     * AJAX获取微博总页数
     */
    public function ajaxDefaultTotalPage(){
        if (IS_AJAX){
            $Topic = D('Topic');
            echo ceil(($Topic->where('1=1')->count())/C('TOPIC_SHOW_NUM'));  //每页显示10条，返回总页码数
        }else{
            $this->error('非法访问');
        }
    }

    /**
     * AJAX获取我关注的好友的微博总页码数
     */
    public function ajaxConcentratedTotalPage(){
        if (IS_AJAX){
            $Topic = D('Topic');
            echo ceil(($Topic->ajaxConcentratedTotalPage(session('user_auth')['uid']))/C('TOPIC_SHOW_NUM'));  //每页显示10条，返回总页码数
        }else{
            $this->error('非法访问');
        }
    }

    public function reBroadCast(){
        //sleep(3);
        if (IS_AJAX){
            $Topic = D('Topic');
            echo $Topic->reBroadCast(I('post.reContent'),session('user_auth')['uid'],I('post.reId'),I('post.reId_2'));  //单次转播
        }else{
            $this->error('非法访问');
        }
    }
    //点赞处理，根据用户ID和微博ID判断，同一用户点击相同微博一次点赞+1，点击两次点赞-1
    public function ajaxRecommend(){
        if (IS_AJAX){
            $Topic = D('Topic');
            echo $Topic->reComment(I('post.tid'),session('user_auth')['uid']);
        }else{
            $this->error('非法访问');
        }
    }

    /**
     * AJAX从缓存获取@用户的次数
     */
    public function ajaxGetReferCount(){
        if (IS_AJAX){
            echo S(C('REFER_PREFIX').session('user_auth')['username']);
        }else{
            $this->error('非法操作');
        }
    }

    public function delOneWeibo(){
        if (IS_AJAX){
//            echo 1;
//            sleep(2);
            $Topic = D('Topic');
            echo $Topic->delOneWeibo(I('post.WBId'));
            //echo 1;
        }else{
            $this->error('非法操作');
        }
    }




}