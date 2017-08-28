<?php
/**
 * Created by PhpStorm
 * Author:Rico
 * Date: 2017/8/27 0027
 * Time: 16:25
 */
namespace Admin\Model;
use Think\Model;

class UserModel extends Model{
    public function getTotalCount(){
        $count = $this->where('1=1')->count();
        return $count;
    }

    /**
     * 取得指定数量的数据
     * @param $start
     * @return mixed
     */
    public function getAllMember($page=1){
        $start = ($page-1)*C('USER_SHOW_NUM');
        $result = $this->field('id,username,email,create,domain')
                       ->limit($start,C('USER_SHOW_NUM'))
                       ->select();
        //格式化数据
        if ($result){
            foreach ($result AS $key=>$value){
                $result[$key]['create'] = date('Y-m-d H:m:s',$result[$key]['create']);
                if (!$result[$key]['domain']){
                    $result[$key]['domain'] = '-';
                }
                //数据编号
                $result[$key]['auto_id'] = intval($start) + (intval($key)+1);
            }
        }

        return $result;
    }
}