<?php
namespace Admin\Controller;
use Think\Controller;
class PayCountController extends ConmmonController{
	
	public function index(){
		
		$map = array();
		$map['status'] = array('neq','-1');
		
		 
		if(IS_GET){
		
			if(!empty($_GET['start_time']))  $map['create_time'] = array('egt',strtotime($_GET['start_time']));
			if(!empty($_GET['end_time']))    $map['create_time'] = array('elt',strtotime($_GET['end_time']));
			if(!empty($_GET['start_time']) and !empty($_GET['end_time'])){
				$map['create_time'] = array(array('egt',strtotime($_GET['start_time'])),array('elt',strtotime($_GET['end_time'])));
			}
		
			if(!empty($_GET['search'])){
				$map['title']  = array('like', '%'.$_GET['search'].'%');
			}
			 		
			$this->assign('start_time',$_GET['start_time']);
			$this->assign('end_time',$_GET['end_time']);
			$this->assign('search',$_GET['search']);
		
		}
		
		$total        =    M('activity')->where($map)->count();
		 
		if( isset($REQUEST['r']) ){
			$listRows = (int)$REQUEST['r'];
		}else{
			$listRows = 15;
		}
		 
		$page = new \Think\Page($total, $listRows, $REQUEST);
		
		$arr = M('activity')->where($map)->limit($page->firstRow . ',' . $page->listRows)->select();
		
		foreach ($arr as $key => $val){
			$arr[$key]['all'] = M('order')->field('money')->where(array('status'=>1,'act_id'=>$val['id']))->sum('money');
			$arr[$key]['back'] = M('back_order')->where(array('status'=>1,'act_id'=>$val['id']))->sum('back_money');
		}
		
		$this->assign('arr',$arr);
		
		$p = $page->show();

		$this->assign('total',$total);
		$this->assign('page', $p? $p: '');
		
		$this->display();
	}
	
}