<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/5/12
 * Time: 19:27
 */
//验证码检验
/**
 * @param $code     //验证码
 * @param $id       //验证码ID
 * @return bool     //返回值
 */
function check_verify($code,$id){

    $verify = new \Think\Verify();
    return $verify->check($code,$id);
}

//加密cookie
/**
 * @param $source    //需要加密的源数据
 * @param $type      //类型，0为加密，1为解密
 */
function encryption($source,$type){
    $key = C('SECURITY_KEY');     //秘钥
    $encryption_key = sha1($key);   //秘钥加密
    if ($type==0){
        return base64_encode($encryption_key^$source);   //异或运算后再加密

    }elseif($type==1){
        $source = base64_decode($source);  //先进行一层解密
        return $source^$encryption_key;
    }

}

/**判断数组是否为空，支持多为数组；字符串0和数值0会被判定为空
 * @param $arr   //传入的数组
 * @return bool  //为空返回true，否则返回false
 */
function isArrEmpty($arr){
    $result = true;
    foreach ($arr as $key=>$value){
        //字符串empty误判，需要单独判断
        if (!empty($value)){
            //数组判断
            if (is_array($value)){
                $result = isArrEmpty($value);
                //return 2;
            }else
                $result= false;
        }
    }
    return $result;
}
