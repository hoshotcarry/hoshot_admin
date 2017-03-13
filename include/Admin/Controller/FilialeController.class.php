<?php
namespace Admin\Controller;

class FilialeController extends ConmmonController {
	
	//keyword_forbidden
	public function index(){
		$model = M("substation");
    	
    	$map = array();
    	//$map['status'] = 1;
    	
    	if(IS_GET){
   
//     		if(!empty($_GET['start_time']))  $map['create_time'] = array('gt',strtotime($_GET['start_time']));
//     		if(!empty($_GET['end_time']))  $map['create_time'] = array('lt',strtotime($_GET['end_time']));
//     		if(!empty($_GET['start_time']) and !empty($_GET['end_time'])){
//     			$map['create_time'] = array(array('gt',strtotime($_GET['start_time'])),array('lt',strtotime($_GET['end_time'])));
//     		}
    		
//     		if(!empty($_GET['search'])){
//     			$where['content']  = array('like', '%'.$_GET['search'].'%');
//     		}
    		   		
//     		$this->assign('start_time',$_GET['start_time']);
//     		$this->assign('end_time',$_GET['end_time']);
//     		$this->assign('search',$_GET['search']);
    		
    	}
    	
    	$total        =   $model->where($map)->count();
    	
    	if( isset($REQUEST['r']) ){
    		$listRows = (int)$REQUEST['r'];
    	}else{
    		$listRows = 15;
    	}
    	
    	$page = new \Think\Page($total, $listRows, $REQUEST);
    	
    	$arr = $model->join(C('DB_PREFIX')."filiale ON ".C('DB_PREFIX')."filiale.id = ".C('DB_PREFIX')."substation.filiale_id","LEFT")->field(
    			array(
    					C('DB_PREFIX').'substation.*',
    					C('DB_PREFIX').'filiale.name',
    					C('DB_PREFIX').'substation.name' => 'sub_name',
    					C('DB_PREFIX').'substation.id' => 'sub_id'
    			)
    			)->where($map)->limit($page->firstRow . ',' . $page->listRows)->select();
    	$p = $page->show();

    	$this->assign('arr',$arr);
    	$this->assign('total',$total);
    	$this->assign('page', $p? $p: '');
    	
    	$this->display();
	}
	
	public function add(){
		 
		$model = D('Filiale');
		
		//$this->assign('type',M('keyword_type')->select());
		
		if(IS_POST){
			if(false !== $model->update()){
				$this->success('新增成功！', U('index'),'ajax_success');
			} else {
				$error = $model->getError();
				$this->error(empty($error) ? '未知错误！' : $error);
			}
		}else{
			$this->display();
		}    
		
	}
	
	public function sub_add(){
			
		$model = M('substation');

		$this->assign('type',M('Filiale')->select());
		if(IS_POST){
			$model->create();
			$model->create_time = time();
			$model->update_time = time();
			if(false !== $model->add()){
				$this->success('新增成功！', U('index'),'ajax_success');
			} else {
				$error = $model->getError();
				$this->error(empty($error) ? '未知错误！' : $error);
			}
		}else{
			$this->display('_add');
		}
	
	}
	
	public function edit($id){
		if(empty($id)){
			$this->error('参数错误');
		}
		$model = D('substation');
		
		$this->assign('type',M('Filiale')->select());
		
		if(IS_POST){
			$model->create();
			if(false !== $model->where(array('id'=>$id))->save()){
				$this->success('编辑成功！', U('index'),'ajax_success');
			} else {
				$error = $model->getError();
				$this->error(empty($error) ? '未知错误！' : $error);
			}
			return false;
		}

		$info = M('substation')->where(array('id'=>$id))->find();

		$this->assign('info',$info);
		$this->display('_edit');
	}
	
	public function sub_edit($id){
		if(empty($id)){
			$this->error('参数错误');
		}
		$model = D('Filiale');
	
		$this->assign('type',M('Filiale')->select());
	
		if(IS_POST){
			if(false !== $model->update()){
				$this->success('编辑成功！', U('index'),'ajax_success');
			} else {
				$error = $model->getError();
				$this->error(empty($error) ? '未知错误！' : $error);
			}
			return false;
		}
	
		$info = M('keyword_forbidden')->where(array('id'=>$id))->find();
	
		$this->assign('info',$info);
		$this->display();
	}
	
	/**
	 * 条目假删除
	 * @param string $model 模型名称,供D函数使用的参数
	 * @param array  $where 查询时的where()方法的参数
	 * @param array  $msg   执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
	 *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
	 *
	 */
	protected function delete ( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
		$data['status']         =   -1;
		$data['update_time']    =   NOW_TIME;
		$this->editRow(   $model , $data, $where, $msg);
	}
	
	public function del($id){
		 
		if(IS_POST and !empty($_POST['id'])){
			$id = json_decode($_POST['id']);
			foreach ($id as $val){
				M('substation')->where(array('id'=>$val))->delete();
			}
			$this->success('删除分站成功！');
			return false;
		}
		$this->delete('substation',array('id'=>$id));
		 
	}
	
	protected function forb( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
		$data['status']         =   1;
		$data['update_time']    =   NOW_TIME;
		$this->editRow(   $model , $data, $where, $msg);
	}
	
	public function enb($id){
		$this->forb('substation',array('id'=>$id));
	}
	
	final protected function editRow ( $model ,$data, $where , $msg ){
		$id    = array_unique((array)I('id',0));
		$id    = is_array($id) ? implode(',',$id) : $id;
		$where = array_merge( array('id' => array('in', $id )) ,(array)$where );
		$msg   = array_merge( array( 'success'=>'操作成功！', 'error'=>'操作失败！', 'url'=>'' ,'ajax'=>IS_AJAX) , (array)$msg );
		if( M($model)->where($where)->save($data)!==false ) {
			$this->success($msg['success'],$msg['url'],$msg['ajax']);
		}else{
			$this->error($msg['error'],$msg['url'],$msg['ajax']);
		}
	}
	
}