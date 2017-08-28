<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/5/22
 * Time: 20:24
 */
namespace Home\Model;
use Think\Model;

class ImagesModel extends Model{
    /**
     * 保存微博图片
     * @param $imgArr   //图片地址，数组
     * @param $tid      //微博博文ID
     * @return int     //返回值
     */
    public function saveImg($imgArr,$tid){
        //循环保存图片地址
        foreach ($imgArr as $key=>$value){
            $data=array(
                'source'=>$value,
                'tid'=>$tid
            );
            $this->add($data);
        }
        return 1;
    }
}