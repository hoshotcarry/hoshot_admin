<?php

namespace Admin\Model;
use Think\Model;

/**
 * 用户模型
 */

class AdminModel extends Model {

    protected $_validate = array(
        array('account', '1,16', '用户名长度为1-16个字符', self::EXISTS_VALIDATE, 'length'),
        array('account', '', '用户名被占用', self::EXISTS_VALIDATE, 'unique'), //用户名被占用
    	array('phone', '', '手机号码已注册', self::EXISTS_VALIDATE, 'unique'), //用户名被占用
    	array('phone', '11', '手机号码不正确', self::EXISTS_VALIDATE, 'length'), //用户名被占用
    	array('email', '', 'email已注册', self::EXISTS_VALIDATE, 'unique'), //用户名被占用
    );
    
    protected $_auto = array(
    		//array('password', 'think_ucenter_md5', self::MODEL_BOTH, 'function', UC_AUTH_KEY),
    		array('create_time', NOW_TIME, self::MODEL_INSERT),
    		array('update_time', NOW_TIME, self::MODEL_BOTH),
    		array('count_login', '1', self::MODEL_BOTH),
    );

    public function lists($status = 1, $order = 'uid DESC', $field = true){
        $map = array('status' => $status);
        return $this->field($field)->where($map)->order($order)->select();
    }
    
    /**
     * 登录指定用户
     * @param  integer $uid 用户ID
     * @return boolean      ture-登录成功，false-登录失败
     */
    public function login($uid){
        /* 检测是否在当前应用注册 */
        $user = $this->field(true)->find($uid);

        if(!$user || 1 != $user['status']) {
            $this->error = '用户不存在或已被禁用！'; //应用级别禁用
            return false;
        }

        //记录行为
        action_log('user_login', 'member', $uid, $uid);

        /* 登录用户 */
        $this->autoLogin($user);
        return true;
    }
    
    public function update(){
    	$data = $this->create();   	
    	$this->data['password'] = $this->think_ucenter_md5($data['password']);
    	if(!$data){ //数据对象创建错误
    		return false;
    	}

    	/* 添加或更新数据 */
    	if(empty($data['id'])){
    		$res = $this->add();
    	}else{
    		$res = $this->save();
    	}
    
    	//记录行为
    	action_log('update_admin', 'admin', $data['id'] ? $data['id'] : $res, UID);
    
    	return $res;
    }
    
    public function think_ucenter_md5($str, $key = '7K2d/p<Jl(|_?C.L+r5kmh`4VR*{egqT%Ov&BM0,'){
    	return '' === $str ? '' : md5(sha1($str) . $key);
    }

    /**
     * 注销当前用户
     * @return void
     */
    public function logout(){
        session('user_auth', null);
        session('user_auth_sign', null);
    }

    /**
     * 自动登录用户
     * @param  integer $user 用户信息数组
     */
    private function autoLogin($user){
        /* 更新登录信息 */
        $data = array(
            'uid'             => $user['id'],
            'login'           => array('exp', '`login`+1'),
            'last_login_time' => NOW_TIME,
            'last_login_ip'   => get_client_ip(1),
        );
        $this->save($data);
        
        $admin_log = M('AdminLog')->where('user_id="'.$user['id'].'" and action="12"')->order('id desc')->limit(1,1)->select();
        /* 记录登录SESSION和COOKIES */
        $auth = array(
            'uid'             => $user['id'],
            'account'        => $user['account'],
            'last_login_time' => $admin_log[0]['create_time'],
            'count_login'     => $user['count_login'],
            'last_login_ip'     =>  long2ip($admin_log[0]['ip']),
        );
        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));

    }

    public function getNickName($uid){
        return $this->where(array('uid'=>(int)$uid))->getField('account');
    }

}
