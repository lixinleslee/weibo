<?php
/**
 * Created by PhpStorm.
 * User: rico
 * Date: 2017/5/9
 * Time: 19:08
 */
namespace Home\Model;
use Think\Model;

class UserModel extends Model\RelationModel{
    //批量验证打开，全部数据一起验证
    //protected $patchValidate = true;

    //自动验证,需要验证的字段必须在data数组中存在
    protected $_validate=array(
        //-1,注册用户名不能包含@!
        array('username','/^[^@]{2,20}$/i',-1,self::EXISTS_VALIDATE),
        //-2,密码长度不合法
        array('password','6,20',-2,self::EXISTS_VALIDATE,'length'),
        //-3,两次输入的密码不一致
        array('repassword','password',-3,self::EXISTS_VALIDATE,'confirm'),
        //-4,邮箱格式不正确
        array('email','email',-4,self::EXISTS_VALIDATE),

        //验证用户名和邮箱是否唯一
        //-5,用户名已被占用
        array('username','',-5,self::EXISTS_VALIDATE,'unique',self::MODEL_BOTH),

        //邮箱格式不正确
        array('email','',-6,self::EXISTS_VALIDATE,'unique',self::MODEL_BOTH),

        //-7,验证码不正确
        array('verify','check_verify',-7,self::EXISTS_VALIDATE),
        //-8,登录名长度
        array('username_login','2,50',-8,self::EXISTS_VALIDATE,'length'),
        //-9,notemail
        array('username_login','email','notemail',self::EXISTS_VALIDATE),
    );


    //自动完成
    protected $_auto=array(
        array('password','sha1',self::MODEL_BOTH,'function'),
        array('create','time',self::MODEL_INSERT,'function'),
        //array('birthday','strtotime',self::MODEL_INSERT,'function')
    );
    //一对一关联查询用户
    protected $_link=array(
        'user_extend'=>array(
            'mapping_type'=>self::HAS_ONE,
            'mapping_name'=>'info',
            'foreign_key'=>'uid',
            //'mapping_class'=>'user_extend',
            'mapping_fields'=>'intro,birthday'
        ),
    );
    //AJX验证
    public function checkField($data,$type){
        $data1 = array();
        //对输入的数据判断，是否为用户名或者邮箱
        switch ($type){
            case 'username':
                $data1['username'] = $data;
                break;
            case 'email':
                $data1['email'] = $data;
                break;
            case 'verify':
                $data['verify'] = $data;
                break;
        }
         return $this->create($data1) ? 1 : $this->getError();

    }
    public function register($username,$password,$repassword,$email){

        $data = array(
            'username'=>$username,
            'password'=>$password,
            'repassword'=>$repassword,
            'email'=>$email
        );

        if ($this->create($data)){
            //如果数据对象创建成果，则执行添加动作
            $insertId = $this->add();
            return $insertId ? $insertId : 0;

        }else{
            return $this->getError();
        }
//        //
        //return $this->select();
    }

    /**处理前台发送的登录请求
     * @param $username     //用户名
     * @param $password     //密码
     * @param $auto_login   //是否自动登录
     * @return int          //返回值
     */
    public function login($username,$password,$auto_login){
        $data =array();
        $data_login=array(
            'username_login'=>$username,
            'password'=>$password
        );
        if ($this->create($data_login)){
            //处理邮箱登录
            $data['email'] = $username;
            return $this->checkLogin($data,$password,$auto_login);
        }else{
            //处理账号登录
            $data['username'] = $username;
            return $this->checkLogin($data,$password,$auto_login);
        }
    }

    /**
     * 登录方法的辅助方法
     * @param $data       //登录时判断的数据
     * @param $password   //用户提交过来的密码
     * @param null $auto_login   //是否自动登录
     * @return int       //返回值
     */
    private function checkLogin($data,$password,$auto_login=null){
        $result = $this->field('id,username,password,face,domain')->where($data)->find();
        if ($result){

            if ($result['password']==sha1($password)){
                //更新最后登录时间和登录IP
                $update=array(
                    'id'=>$result['id'],
                    'last_login'=>time(),
                    'last_ip'=>get_client_ip(1)
                );
                $this->save($update);
                //如果选择了10天自动保存，则将用户名加密储存在cookie
                if ($auto_login=='on'){
                    cookie('auto',encryption($result['username'],0),3600*24*10);
                }
                //保存session
                session('user_auth',array(
                    'username'=>$result['username'],
                    'uid'=>$result['id'],
                    'face'=>json_decode($result['face']),
                    'domain'=>$result['domain']
                ));
                return $result['id'];
            }else{
                //密码错误
                return -10;
            }
        }else{
            //用户名不存在
            return -11;
        }
        //echo $this->getLastSql();
    }

    //
    /**用ID一对一查询用户
     * @param $uid     //用户ID
     * @return mixed   //返回用户信息
     */
    public function getUser($uid){
        $map['id']=$uid;
        $result = $this->relation(true)->field('id,username,email,face,domain')->where($map)->find();
        //当查询出来的关联信息info不为数组时，表示user_extend没有改ID的记录存在，会导致修改失败；因此需要临时新增一条空数据。
        if (!is_array($result['info'])){
            $User_Extend = M('User_extend');
            $data=array(
                'uid'=>$uid
            );
            $User_Extend->add($data);
        }
        return $result;
    }

    /**用域名一对一查询用户
     * @param $uid     //用户ID
     * @return mixed   //返回用户信息
     */
    public function getUserByDomain($domain){

        $map['domain']=$domain;
          return $this->relation(true)->field('id,username,email,face,domain')->where($map)->find();
        //echo $this->getLastSql();
    }

    /**用用户名查询用户，前端AJAX调用，用户处理博文@账号的问题
     * @param $username   //用户名
     * @return string    //返回URL
     */
    public function getUserByName($username){
        $map['username']=$username;
        $result =  $this->field('id,domain')->where($map)->find();
        if (is_array($result)){  //如果有值
            if (!empty($result['domain'])){
                return __ROOT__.'/i/'.$result['domain'];
            }else{
                return U('Space/index',array('id'=>$result['id']));
            }
        }else{
            echo false;
        }
    }

    //
    /**一对一更新用户
     * @uid            //关联ID
     * @param $email  //邮箱
     * @param $intro  //简介
     * @return mixed
     */
    public function userUpdate($uid,$email,$intro=''){
        $map['id']=$uid;
        $data=array(
            'email'=>$email,
            'info'=>array(
                'intro'=>$intro
            )
        );
         return $this->relation(true)->where($map)->save($data);
        //echo $this->getLastSql();
    }
    /*
     *
     */
    public function domainUpdate($uid,$domain){
        $map['id']=$uid;
        $data=array(
            'domain'=>$domain,
        );
        return $this->where($map)->save($data);
        //echo $this->getLastSql();
    }

    /**
     * 更新用户头像
     * @param $uid   //UID
     * @param $face  //json格式的头像地址
     * @return int  //返回影响条数
     */
    public function faceUpate($uid,$face){
        $map['id']=$uid;
        $data = array(
            'face'=>$face
        );
        $saveData = $this->where($map)->save($data);
       // return $this->getLastSql();
        if ($saveData){
            //更新session或者缓存中头像信息
//            session('user_auth',array(
//                'face'=>json_decode($face)
//            ));
            session('user_auth')['face']=json_decode($face);
            return $saveData;
        }else{
            return 0;
        }
       // return $this->where($map)->save($data) ? :0;
    }

}