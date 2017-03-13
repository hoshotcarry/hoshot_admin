<?php
namespace Admin\Controller;

class ForbiddenController extends ConmmonController {
	
	//keyword_forbidden
	public function index(){
		$model = M("keyword_forbidden");
    	
    	$map = array();
    	$map['status'] = 1;
    	
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
    	
    	$arr = $model->join(C('DB_PREFIX')."keyword_type ON ".C('DB_PREFIX')."keyword_type.id = ".C('DB_PREFIX')."keyword_forbidden.keyword_type_id","LEFT")->field(
    			array(
    					C('DB_PREFIX').'keyword_forbidden.*',
    					C('DB_PREFIX').'keyword_type.type '
    			)
    			)->where($map)->limit($page->firstRow . ',' . $page->listRows)->select();
    	$p = $page->show();

    	$this->assign('arr',$arr);
    	$this->assign('total',$total);
    	$this->assign('page', $p? $p: '');
    	
    	$this->display();
	}
	
	public function add(){
		 
		$model = D('Forbidden');
		
		$this->assign('type',M('keyword_type')->select());
		
		if(IS_POST){
			if(empty($_POST['keyword'])) $this->error('关键词不能为空');
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
	
	public function edit($id){
		if(empty($id)){
			$this->error('参数错误');
		}
		$model = D('Forbidden');
		
		$this->assign('type',M('keyword_type')->select());
		
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
				M('keyword_forbidden')->where(array('id'=>$val))->save(array('status'=>-1));
			}
			$this->success('删除角色成功！');
			return false;
		}
		$this->delete('keyword_forbidden',array('id'=>$id));
		 
	}
	
	protected function forb( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
		$data['status']         =   1;
		$data['update_time']    =   NOW_TIME;
		$this->editRow( $model , $data, $where, $msg);
	}
	
	public function enb($id){
		$this->forb('keyword_forbidden',array('id'=>$id));
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