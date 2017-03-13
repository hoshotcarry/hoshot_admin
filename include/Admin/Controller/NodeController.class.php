<?php
namespace Admin\Controller;
use Think\Controller;

class NodeController extends ConmmonController {
	
	
	public function index(){
		
		$this->display();
	}
	
	public function add(){
		
    	$model = D('admin');
    	if(IS_POST){
    	    if(false !== $this->update()){
                $this->success('新增成功！', U('index'),'ajax_success');
            } else {
                $error = $model->getError();
                $this->error(empty($error) ? '未知错误！' : $error);
            }
    	}else{
    		$this->display();
    	}
    	
	}
	
	
	public function update(){
		$model = M('admin_node');
		$data = $model->create();
		if(!$data){ //数据对象创建错误
			return false;
		}
		/* 添加或更新数据 */
		if(empty($data['id'])){
			$res = $model->add();
		}else{
			$res = $model->save();
		}
	
		//记录行为
		action_log('update_admin_node', 'admin_node', $data['id'] ? $data['id'] : $res, UID);
	
		return $res;
	}
	
	public function update_power($rid){
		if(empty($rid)){
			$model->getError('ID错误');
		}
		
		if(IS_POST){
			M('admin_access')->where(array('role_id'=>$rid))->delete();
			$nodeid = json_decode($_POST['id']);
			foreach ($nodeid as $val){
				M('admin_access')->where(array('id'=>$val))->add(array('role_id'=>$rid,'node_id'=>$val));
			}
			$this->success('更新权限成功！');
			return false;
		}
	}
	
	protected function delete ( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
		$data['status']         =   -1;
		$data['update_time']    =   NOW_TIME;
		$this->editRow(   $model , $data, $where, $msg);
	}
	
	public function del($id){
		 
		if(IS_POST and !empty($_POST['id'])){
			$id = json_decode($_POST['id']);
			foreach ($id as $val){
				M('admin_node')->where(array('id'=>$val))->save(array('status'=>-1));
			}
			$this->success('删除节点成功！');
			return false;
		}
		$this->delete('admin_node',array('id'=>$id));
		 
	}
	
}