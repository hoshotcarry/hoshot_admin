<?php

namespace Admin\Model;
use Think\Model;


class AnnouncementModel extends Model {

//     protected $_validate = array(
//         array('account', '1,16', '用户名长度为1-16个字符', self::EXISTS_VALIDATE, 'length'),
//         array('account', '', '用户名被占用', self::EXISTS_VALIDATE, 'unique'), //用户名被占用
//     	array('phone', '', '手机号码已注册', self::EXISTS_VALIDATE, 'unique'), //用户名被占用
//     	array('phone', '11', '手机号码不正确', self::EXISTS_VALIDATE, 'length'), //用户名被占用
//     	array('email', '', 'email已注册', self::EXISTS_VALIDATE, 'unique'), //用户名被占用
//     );
    
    protected $_auto = array(
//    		array('password', 'think_ucenter_md5', self::MODEL_BOTH, 'function', UC_AUTH_KEY),
    		array('create_time', NOW_TIME, self::MODEL_INSERT),
//    		array('update_time', NOW_TIME, self::MODEL_BOTH),
//    		array('count_login', '1', self::MODEL_BOTH),
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
    		$res = $this->add();
    	}else{
    		$res = $this->save();
    	}
    
    	//记录行为
    	action_log('update_admin', 'admin', $data['id'] ? $data['id'] : $res, UID);
    
    	return $res;
    }

    public function getNickName($uid){
        return $this->where(array('uid'=>(int)$uid))->getField('account');
    }

}
