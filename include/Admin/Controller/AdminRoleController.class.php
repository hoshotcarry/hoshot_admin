<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AuthRuleModel;
use Admin\Model\AuthGroupModel;

class AdminRoleController extends ConmmonController {
	
	public $model;
	
	public function _initialize(){
		$this->model = D('admin_role');
	}
	
	public function index(){
		$role = $this->model->select();
		$this->assign('role',$role);
		$this->assign('count',$this->model->count());
		$this->display();
	}
	
	/* 新增角色 */
	public function add(){
		$role = $this->model;
	
		if(IS_POST){ //提交表单
			if(false !== $role->update()){
				$this->success('新增成功！', U('index'),'ajax_success');
			} else {
				$error = $role->getError();
				$this->error(empty($error) ? '未知错误！' : $error);
			}
		} else {
			$this->display();
		}
	}
	
	public function del(){
		
		if(IS_POST and !empty($_POST['id'])){
			$id = json_decode($_POST['id']);
			foreach ($id as $val){
				//M('AdminRole')->where(array('id'=>$val))->save(array('status'=>-1));
				M('auth_group')->delete($val);
			}			
			$this->success('删除角色成功！');
			return false;
		}
		
		$cate_id = I('id');
		if(empty($cate_id)){
			$this->error('参数错误!');
		}
	
		$res = M('auth_group')->delete($cate_id);
		if($res !== false){
			//记录行为
			//action_log('update_category', 'category', $cate_id, UID);
			$this->success('删除角色成功！');
		}else{
			$this->error('删除角色失败！');
		}
	}
	

	public function node($rid){
		$arr = M('admin_access')->field('node_id')->where(array('role_id'=>$rid))->select();
		
		foreach ($arr as $val){
			$node[] = $val['node_id'];
		}

		$this->assign('node',$node);
		$this->display();
	}
	
	public function edit(){
		$role = $this->model;
		
		if(IS_POST){ //提交表单
			if(false !== $role->update()){
				$this->success('更新成功！', U('index'),'ajax_success');
			} else {
				$error = $role->getError();
				$this->error(empty($error) ? '未知错误！' : $error);
			}
		} else {
			$this->assign('role',$role->info(I('get.id')));
			$this->display();
		}
	}
	
}