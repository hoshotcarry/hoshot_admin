<?php

namespace Admin\Model;
use Think\Model;

/**
 * 插件模型
 */

class TagsModel extends Model {
    
    
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
    );
    
    public function update($data = []){
    	$rdata = $this->create($data);
    	if(!$rdata){ //数据对象创建错误
    		return false;
    	}

    	/* 添加或更新数据 */
    	if(empty($rdata['id'])){
    		$res = $this->add();
    	}else{
    		$res = $this->save();
    	}
    
    	//记录行为
    	action_log('add tags', 'admin', $rdata['id'] ? $rdata['id'] : $res, UID);
    
    	return $res;
    }
}