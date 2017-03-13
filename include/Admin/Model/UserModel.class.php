<?php

namespace Admin\Model;
use Think\Model;

/**
 * 用户模型
 */

class UserModel extends Model {

	protected $_validate = array(
			array('account', '1,16', '用户名长度为1-16个字符', self::EXISTS_VALIDATE, 'length',1),
			array('account', '', '用户名被占用', self::EXISTS_VALIDATE, 'unique',1), //用户名被占用
			array('phone', '', '手机号码已注册', self::EXISTS_VALIDATE, 'unique',1), //用户名被占用
			array('phone', '11', '手机号码不正确', self::EXISTS_VALIDATE, 'length',1), //用户名被占用
			//array('email', '', 'email已注册', self::EXISTS_VALIDATE, 'unique'), //用户名被占用
	);

	protected $_auto = array(
			//array('password', 'think_ucenter_md5', self::MODEL_BOTH, 'function', UC_AUTH_KEY),
			array('create_time', NOW_TIME, self::MODEL_INSERT),
			array('update_time', NOW_TIME, self::MODEL_BOTH),
			array('last_login_time', NOW_TIME, self::MODEL_INSERT),
			array('last_login_ip', 'get_client_ip', 1,'function'),
			array('count_login', '1', self::MODEL_BOTH),
			array('status', '1', self::MODEL_BOTH),
	);

	public function lists($status = 1, $order = 'uid DESC', $field = true){
		$map = array('status' => $status);
		return $this->field($field)->where($map)->order($order)->select();
	}
	
	public function update(){
		$data = $this->create();
		if(!$data){ //数据对象创建错误
			return false;
		}
	
		/* 添加或更新数据 */
		if(empty($data['id'])){
			$data['account'] = $data['phone'];//substr(md5($data['phone']),20);
			$data['password'] = $this->think_ucenter_md5($data['password'],C('UC_AUTH_KEY'));
			$res = $this->add($data);
		}else{
			if(empty($data['password'])) unset($data['password']);
			else $data['password'] = $this->think_ucenter_md5($_POST['password'],C('UC_AUTH_KEY'));
			$res = $this->save($data);
		}
	
		//记录行为
		action_log('add_user', 'user', $data['id'] ? $data['id'] : $res, UID);
	
		return $res;
	}
	
	/**
	 * 系统非常规MD5加密方法
	 * @param  string $str 要加密的字符串
	 * @return string
	 */
	protected function think_ucenter_md5($str, $key = 'ThinkUCenter'){
		return '' === $str ? '' : md5(sha1($str) . $key);
	}
	
}