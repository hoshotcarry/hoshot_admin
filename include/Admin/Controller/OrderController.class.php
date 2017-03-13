<?php
namespace Admin\Controller;
use Think\Controller;

class OrderController extends ConmmonController {
    public function index(){
    	
    	$model = M("order");
    	
    	$map = array();
    	$map[C('DB_PREFIX').'order.status'] = array('neq','-2');
    	
    	if(IS_GET){
   
    		if(!empty($_GET['start_time']))  $map[C('DB_PREFIX').'order.pay_time'] = array('egt',strtotime($_GET['start_time']));
    		if(!empty($_GET['end_time']))  $map[C('DB_PREFIX').'order.pay_time'] = array('elt',strtotime($_GET['end_time']));
    		if(!empty($_GET['start_time']) and !empty($_GET['end_time'])){
    			$map[C('DB_PREFIX').'order.pay_time'] = array(array('gt',strtotime($_GET['start_time'])),array('lt',strtotime($_GET['end_time'])));
    		}
    		
    		if(!empty($_GET['search'])){
    			$map[C('DB_PREFIX').'order.order_title']  = array('like', '%'.$_GET['search'].'%');
    		}
    		   		
    		$this->assign('start_time',$_GET['start_time']);
    		$this->assign('end_time',$_GET['end_time']);
    		$this->assign('search',$_GET['search']);
    		
    	}
    	
    	$total        =   $model->where($map)->count(                                                                                                                            );
    	
    	if( isset($_REQUEST['r']) ){
    		$listRows = (int)$_REQUEST['r'];
    	}else{
    		$listRows = 15;
    	}
    	
    	$page = new \Think\Page($total, $listRows, $_REQUEST);
    	
    	$arr = $model
    	->join(C('DB_PREFIX')."orders ON ".C('DB_PREFIX')."orders.ord_id = ".C('DB_PREFIX')."order.id","LEFT")
//     	->field(
//     			array(
//     					C('DB_PREFIX').'announcement.*',
//     					C('DB_PREFIX').'admin.account '
//     			)
//     			)
    	->where($map)->order('order_time desc')->limit($page->firstRow . ',' . $page->listRows)->select();
    	$p = $page->show();

    	$this->assign('arr',$arr);
    	$this->assign('total',$total);
    	$this->assign('page', $p? $p: '');
    	$this->display();
    }
    
    public function sub_back($id){
    	$model = M("order_back");
    	$model->startTrans();
    	$back =$model->where(array('id'=>$id))->find();
    	if ($back['status'] == 1) {
    		    exit(json_encode(array(
    			'success' => '操作成功',
    			'code' => 200,
    	)));
    	}
    	$num = '';
    	$num = M("user_activity")->where(array('act_id'=>$back['act_id'],'user_id'=>$back['user_id'],'order_id'=>$back['order_id']))->find();
		if (!$num) {
			$num = M("user_activity")->where(array('act_id'=>$back['act_id'],'user_id'=>$back['user_id']))->find();
		}
    	$modNum = M("activity")->where(array('id'=>$back['act_id']))->setDec('participants',$num['num']); 	
    	$modStatus = M("order")->where(array('id'=>$back['order_id']))->setField('status',3);
    	//修改用户活动状态为-1
    	$ret = M('user_activity')->where(array('user_id'=>$back['user_id'] ,'act_id'=>$back['act_id'],'status'=>1,'order_id'=>$back['order_id']))->setField('status',-1);
    	$backStatus = M("order_back")->where(array('id'=>$id))->save(array('status'=>1,'create_time'=>time()));
    	if ($modNum && $modStatus && $backStatus) {
    		$model->commit();
    		 exit(json_encode(array(
    			'success' => '操作成功',
    			'code' => 200,
    		)));
    	}else{
    		 $model->rollback();
    		exit(json_encode(array(
    				'success' => '操作失败',
    				'code' => 200,
    		)));    	
    	}

    	
    }
    
    public function back(){
    	$model = M("order_back");
    	 
    	$map = array();
    	$map[C('DB_PREFIX').'order_back.status'] = array('neq','-2');
    	 
    	if(IS_GET){
    		 
    		    		if(!empty($_GET['start_time']))  $map['submit_time'] = array('egt',strtotime($_GET['start_time']));
    		    		if(!empty($_GET['end_time']))  $map['submit_time'] = array('elt',strtotime($_GET['end_time']));
    		    		if(!empty($_GET['start_time']) and !empty($_GET['end_time'])){
    		    			$map['submit_time'] = array(array('egt',strtotime($_GET['start_time'])),array('elt',strtotime($_GET['end_time'])));
    		    		}
    	
    		    		if(!empty($_GET['search'])){
    		    			$map['order_title']  = array('like', '%'.$_GET['search'].'%');
    		    		}
    			
    		    		$this->assign('start_time',$_GET['start_time']);
    		    		$this->assign('end_time',$_GET['end_time']);
    		    		$this->assign('search',$_GET['search']);
    	
    	}
    	 
    	$total        =   $model->where($map)->count();
    	 
    	if( isset($_REQUEST['r']) ){
    		$listRows = (int)$_REQUEST['r'];
    	}else{
    		$listRows = 11;
    	}
    	 
    	$page = new \Think\Page($total, $listRows, $_REQUEST);
    	 
    	$arr = $model
    	->join(C('DB_PREFIX')."order ON ".C('DB_PREFIX')."order.id = ".C('DB_PREFIX')."order_back.order_id","LEFT")
    	    	->field(
    			    			array(
    					    					C('DB_PREFIX').'order_back.*',
    					    					C('DB_PREFIX').'order.* ',
    			    					        C('DB_PREFIX').'order_back.id ' => '_id',
    			    					        C('DB_PREFIX').'order_back.order_number' => '_order_number',
    			    					        C('DB_PREFIX').'order_back.status' => '_status',
    					    			)
    			    			)
    	->where($map)->order('submit_time desc')->limit($page->firstRow . ',' . $page->listRows)->select();
    	$p = $page->show();
    	
    	$this->assign('arr',$arr);
    	$this->assign('total',$total);
    	$this->assign('page', $p? $p: '');
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
    	$data['status']         =   -2;
    	$data['update_time']    =   NOW_TIME;
    	$this->editRow(   $model , $data, $where, $msg);
    }
    
    public function del($id){
    	 
    	if(IS_POST and !empty($_POST['id'])){
    		$id = json_decode($_POST['id']);
    		foreach ($id as $val){
    			M('order')->where(array('id'=>$val))->save(array('status'=>-1));
    		}
    		$this->success('删除角色成功！');
    		return false;
    	}
    	$this->delete('order',array('id'=>$id));
    	 
    }
    
    protected function forb( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
    	$data['status']         =   1;
    	$data['update_time']    =   NOW_TIME;
    	$this->editRow($model , $data, $where, $msg);
    }
    
    public function enb($id){
    	$this->forb('order',array('id'=>$id));
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