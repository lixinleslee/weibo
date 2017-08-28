<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/6/2
 * Time: 14:36
 */
namespace Home\Model;
use Think\Image;
use Think\Model;
use Think\Upload;

class FileModel extends Model{
    /**
     * 图片上传方法
     * @return string   //返回json格式数据
     */
    public function upload(){
        $config = array(
            //'maxSize'    =>    1024,
            //'saveName'   =>    array('uniqid',''),
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            //'autoSub'    =>    true,
            'subName'    =>    array('date','Ymd'),);
        $user = new Upload($config);

        $info = $user->upload();
        if ($info){
            //原图保存地址
            $sourceImg = C('UPLOAD_PATH').$info['file']['savepath'].$info['file']['savename'];
            //首页显示地址
            $showImg = C('UPLOAD_PATH').$info['file']['savepath'].'180X108_'.$info['file']['savename'];
            //上传后回显地址
            $thumbImg = C('UPLOAD_PATH').$info['file']['savepath'].'108_'.$info['file']['savename'];
            //中等图
            $middle = C('UPLOAD_PATH').$info['file']['savepath'].'500_'.$info['file']['savename'];
            //缩略图
            $smallest = C('UPLOAD_PATH').$info['file']['savepath'].'80_'.$info['file']['savename'];
            $img = new Image();
            //打开保存的原始图
            $img->open($sourceImg);
            //middle
            $img->thumb(500,500,Image::IMAGE_THUMB_FIXED)->save($middle);
            //生成前台显示图，108X108
            $img->thumb(108,108,Image::IMAGE_THUMB_CENTER)->save($thumbImg);
            //showImg
            $img->thumb(180,108,Image::IMAGE_THUMB_CENTER)->save($showImg);
            //smallest
            $img->thumb(80,80,Image::IMAGE_THUMB_CENTER)->save($smallest);

            $response = array(
                'success'=>1,
                'source'=>$sourceImg,
                'show'=>$showImg,
                'thumb'=>$thumbImg,
                'middle'=>$middle,
                's'=>$smallest
            );
            return json_encode($response);
        }else{
            $response['success'] = 0;
            $response['error'] = "''".$user->getError()."''";
            return json_encode($response);
        }
    }

    /**
     * 头像上传
     * @return string
     */
    public function faceUpload(){
        $config = array(
            //'maxSize'    =>    1024,
            //'saveName'   =>    array('uniqid',''),
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            //'autoSub'    =>    true,
            'subName'    =>    array('date','Ymd'),
            'savePath'  =>     'Face',
            );
        $user = new Upload($config);

        $info = $user->upload();
        if ($info){
            $uid=session('user_auth')['uid'];
            //头像原图保存地址
            $sourceImg = C('UPLOAD_PATH').$info['file']['savepath'].$info['file']['savename'];
            $img = new Image();
            //打开保存的原始图
            $img->open($sourceImg);
            $img->thumb(500,500,Image::IMAGE_THUMB_CENTER)->save($sourceImg);
            $response = array(
                'success'=>1,
                'source'=>$sourceImg,
            );
            return json_encode($response);
        }else{
            $response['success'] = 0;
            $response['error'] = "''".$user->getError()."''";
            return json_encode($response);
        }
    }

    /**
     * 头像保存
     * @param $imgUrl      //需要剪切的图片路径
     * @param $cropData    //头像剪切参数（x,y,w,h）
     * @return string
     */
    public function faceSave($imgUrl,$cropData){
        //裁剪图像,以UID加前缀保存
        $bigFace = C('FACE_PATH').session('user_auth')['uid'].'.jpg';
        $middleFace = C('FACE_PATH').session('user_auth')['uid'].'_middle.jpg';
        $smallFace = C('FACE_PATH').session('user_auth')['uid'].'_small.jpg';
        $X = json_decode($cropData)->x;
        $Y = json_decode($cropData)->y;
        $W = json_decode($cropData)->width;
        $H = json_decode($cropData)->height;
        $img = new Image();
        $img->open($imgUrl);
        //裁剪和缩放
        //200X200
        $img->crop($W,$H,$X,$Y)->save($bigFace);
        //缩放
        $img->thumb(200,200,6)->save($bigFace);
        $img->thumb(50,50,6)->save($smallFace);
        $faceJson = array(
          'big'=>$bigFace,
          'small'=>$smallFace
        );
        return json_encode($faceJson,JSON_UNESCAPED_SLASHES);

    }
}