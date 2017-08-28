<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/5/17
 * Time: 14:22
 */
namespace Home\Controller;
use Think\Controller;

class CommentController extends HomeController{
    public function index(){
        if (IS_AJAX){

        }else{
            $this->error('非法访问');
        }
    }
    //博文评论
    public function wbComment(){
        if (IS_AJAX){
//            echo 0;
            $Commend = D('Comment');
            echo $Commend->wbComment(I('post.currentWBId'),session('user_auth')['uid'],I('post.commendContent'));
        }else{
            $this->error('非法访问');
        }
    }

    public function getCommentCount(){
        if (IS_AJAX){
            $Comment= D('Comment');
            echo $Comment->getCommentTotal(I('post.currentWBId'));  //每页显示10条，返回总页码数
        }else{
            $this->error('非法访问');
        }
    }

    /**
     * AJAX加载评论选项
     */
    public function getComment(){
        //sleep(1);
        if (IS_AJAX){
            $Commend = D('Comment');
            $commentContent =  $Commend->getComment(I('post.currentWBId'),I('post.page'));
            $this->assign('getComment',$commentContent);
            $this->display();
        }else{
            $this->error('非法访问');
        }
    }

}