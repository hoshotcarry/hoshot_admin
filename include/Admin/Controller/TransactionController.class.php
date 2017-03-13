<?php
namespace Admin\Controller;
use Think\Controller;
class TransactionController extends ConmmonController{
	
	public function index(){
		if(IS_GET){
			
			$model = M('pay_log');
			
			if(!empty($_GET['start_time']))  $map[C('DB_PREFIX').'pay_log.create_time'] = array('egt',strtotime($_GET['start_time']));
			if(!empty($_GET['end_time']))  $map[C('DB_PREFIX').'pay_log.create_time'] = array('elt',strtotime($_GET['end_time']));
			if(!empty($_GET['start_time']) and !empty($_GET['end_time'])){
				$map[C('DB_PREFIX').'pay_log.create_time'] = array(array('egt',strtotime($_GET['start_time'])),array('elt',strtotime($_GET['end_time'])));
			}
			 
			if(!empty($_GET['search'])){
				$map[C('DB_PREFIX').'activity.title']  = array('like', '%'.$_GET['search'].'%');
			}
			 
			$this->assign('start_time',$_GET['start_time']);
			$this->assign('end_time',$_GET['end_time']);
			$this->assign('search',$_GET['search']);
			
			
			$total        =   $model->where($map)->count();
			 
			if( isset($REQUEST['r']) ){
				$listRows = (int)$REQUEST['r'];
			}else{
				$listRows = 15;
			}
			 
			$page = new \Think\Page($total, $listRows, $REQUEST);
			 
			$arr = $model
			->join(C('DB_PREFIX')."activity ON ".C('DB_PREFIX')."activity.id = ".C('DB_PREFIX')."pay_log.activity_id","LEFT")
			->field(
			    array(
					C('DB_PREFIX').'pay_log.id' => 'pid',
					C('DB_PREFIX').'pay_log.create_time' => 'ctime',
			    	C('DB_PREFIX').'pay_log.status' => '_status',
			    	C('DB_PREFIX').'pay_log.user_id' => '_uid',
			    	C('DB_PREFIX').'pay_log.money',
			    	C('DB_PREFIX').'pay_log.platform',
			    	C('DB_PREFIX').'pay_log.activity_id',
				    C('DB_PREFIX').'activity.title ' 
				)
			)
			->where($map)->limit($page->firstRow . ',' . $page->listRows)->select();
			$p = $page->show();

			$this->assign('arr',$arr);
			$this->assign('total',$total);
			$this->assign('page', $p? $p: '');
			
			
		}
		$this->display();
	}
	
}