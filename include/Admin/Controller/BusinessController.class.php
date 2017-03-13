<?php
namespace Admin\Controller;

class BusinessController extends ConmmonController {
	
	public function index(){
		$model = M("business");
		 
		$map = array();
		
		if(IS_GET){
			if(!empty($_GET['start_time']))  $map['create_time'] = array('egt',strtotime($_GET['start_time']));
			if(!empty($_GET['end_time']))    $map['create_time'] = array('elt',strtotime($_GET['end_time']));
			if(!empty($_GET['start_time']) and !empty($_GET['end_time'])){
				$map['create_time'] = array(array('egt',strtotime($_GET['start_time'])),array('elt',strtotime($_GET['end_time'])));
			}
		
			if(!empty($_GET['search'])){
				$map['name']  = array('like', '%'.$_GET['search'].'%');
			}
		
			$this->assign('start_time',$_GET['start_time']);
			$this->assign('end_time',$_GET['end_time']);
			$this->assign('search',$_GET['search']);
		
		}
		 
		$total        =   $model->where($map)->count();
		 
		if( isset($REQUEST['r']) ){
			$listRows = (int)$REQUEST['r'];
		}else{
			$listRows = 15;
		}
		 
		$page = new \Think\Page($total, $listRows, $REQUEST);
		 
		$Works = $model

		->where($map)->order('`create_time` DESC')->limit($page->firstRow . ',' . $page->listRows)->select();
		$p = $page->show();
		$this->assign('arr',$Works);
		$this->assign('total',$total);
		$this->assign('page', $p? $p: '');
		$this->display();
	}
	
	public function add(){
		
		$model = D('business');
		
		if(IS_POST){
					
			$address = $_POST['postion'];
			$dn = explode(',',$address);

			if(empty($_POST['name'])) $this->error('名称不能为空');
			if(false !== $model->create()){
				$model->update_time = time();
				$model->create_time = time();
				$model->longitude = $dn[0] ? $dn[0] : 0;
				$model->latitude = $dn[1] ? $dn[1] : 0;
				$model->status = 0;
				$model->add() ? $this->success('新增成功！', U('index'),'ajax_success') : $this->error(empty($error) ? '未知错误！' : $model->getError());
			}
			
			return ;
		}
		$this->display();
	}
	
	public function edit($id){
		
		$model = M("business");
		
		$bus = $model->where(array('id'=>$id))->find();
		
		if(IS_POST){

			$address = $_POST['postion'];
			$dn = explode(',',$address);
			
			if(empty($_POST['name'])) $this->error('名称不能为空');
			if(false !== $model->create()){
				$model->update_time = time();
				
				$model->longitude = $dn[0] ? $dn[0] : 0;
				$model->latitude = $dn[1] ? $dn[1] : 0;
				$model->where(array('id'=>$id))->save($data);
				$this->success('编辑成功！', U('index'),'ajax_success');
			} else {
				$error = $model->getError();
				$this->error(empty($error) ? '未知错误！' : $error);
			}
			return false;
		}
		
		$this->assign('bus',$bus);
		$this->display();
	}
	
	public function delete($id){
		$del = M("business")->where(array('id'=>$id))->delete();
		$del ? $this->success('操作成功！') : $this->error('操作失败！');
	}
	
	public function start($id){
		M('business')->where(array('id'=>$id))->save(array('status'=>1,'update_time'=>time()));
		$this->success('操作成功！');
	}
	
	protected function forb( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
		$data['status']         =   0;
		$data['update_time']    =   NOW_TIME;
		$this->editRow($model , $data, $where, $msg);
	}
	
	public function enb($id){
		$this->forb('business',array('id'=>$id));
	}
	
	public function del($id){
		 
		if(IS_POST and !empty($_POST['id'])){
			$id = json_decode($_POST['id']);
			foreach ($id as $val){
				M('business')->where(array('id'=>$val))->delete();
			}
			$this->success('删除商家成功！');
			return false;
		}
		$this->delete('business',array('id'=>$id));
		 
	}
	
}