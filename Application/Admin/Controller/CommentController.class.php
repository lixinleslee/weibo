<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/8/27
 * Time: 23:30
 */
namespace Admin\Controller;
use Think\Controller;

class CommentController extends HomeController{

    public function comment_list(){
        $Comment = D('Comment');
        $CommentInfo = $Comment->getCommentList(1);
        $this->assign('totalNum',$Comment->getTotalCount());
        $this->assign('CommentInfo',$CommentInfo);
        //print_r($userInfo);
        $this->display();
    }

    /**
     * AJAX分页加载评论
     */
    public function ajaxLoadComment(){
        if (IS_AJAX){
            $Topic = D('Comment');
            $page = I('post.page','','addslashes');
            $CommentInfo = $Topic->getCommentList($page);
            $this->assign('CommentInfo',$CommentInfo);
            $this->display();
        }else{
            $this->error('非法操作!');
        }
    }

}