<?php
/**
 * Created by PhpStorm
 * Author:Rico
 * Date: 2017/8/27 0027
 * Time: 14:42
 */
namespace Admin\Controller;
class TopicController extends HomeController{

    /**
     * 获取微博列表
     */
    public function topic_list(){
        $Topic = D('Topic');
        $topicInfo = $Topic->getList(1);
        $this->assign('totalNum',$Topic->getTotalCount());
        $this->assign('topicInfo',$topicInfo);
        //print_r($userInfo);
        $this->display();
    }

    public function ajaxLoadTopic(){
        if (IS_AJAX){
            $Topic = D('Topic');
            $page = I('post.page','','addslashes');
            $topicInfo = $Topic->getList($page);
            $this->assign('topicInfo',$topicInfo);
            $this->display();
        }else{
            $this->error('非法操作!');
        }
    }
}