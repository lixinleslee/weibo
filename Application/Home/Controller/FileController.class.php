<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/5/17
 * Time: 17:48
 */
namespace Home\Controller;


class FileController extends HomeController{
    /**
     * 图片上传方法
     */
    public function upload(){
        if (IS_AJAX){
            //初始化参数
            $upload = D('File');
            echo $upload->upload();
        }else{
            $this->error('非法访问');
        }

    }

    /**
     * 头像图片上传
     */
    public function faceUpload(){
        //sleep(3);
        if (IS_AJAX){
            $faceUpload = D('File');
            echo $faceUpload->faceUpload();
        }else{
            $this->error('非法访问');
        }
    }

    public function faceSave(){
        if (IS_AJAX){
            $faceUpload = D('File');
            $face = $faceUpload->faceSave(I('post.imgUrl'),I('post.cropData','',false));
            if (isset($face)){
                //保存头像
                $User = D('User');
                echo $User->faceUpate(session('user_auth')['uid'],$face);
            }else{
                echo 0;
            }
        }else{
            $this->error('非法访问');
        }
    }

}