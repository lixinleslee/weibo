<?php
/**
 * Created by PhpStorm
 * Author:Rico
 * Date: 2017/8/26 0026
 * Time: 15:39
 */
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model{
    //自动验证,需要验证的字段必须在data数组中存在
    protected $_validate=array(
        //-8,登录名长度
        array('username','2,50',-8,self::EXISTS_VALIDATE,'length'),
    );


    public function login($username,$password){
        $map = array(
            'username'=>$username
        );
        if ($this->create($map)){
            $info = $this->field('id,username,password')
                         ->where($map)
                         ->find();
            //return $this->getLastSql();
            if($info && $info['password']==sha1($password)){
                //保存session
                session('admin_auth',array(
                    'username'=>$info['username'],
                    'uid'=>$info['id'],
                ));
                return $info['id'];
            }else{
                //用户或密码错误
                return -11;
            }
        }else{
            //未知错误
            return -10;
        }
    }
}