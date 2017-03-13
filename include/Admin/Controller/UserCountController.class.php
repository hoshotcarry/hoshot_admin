<?php
namespace Admin\Controller;
use Think\Controller;
class UserCountController extends ConmmonController{
	
	public function index(){	
        
		
		$total        =   count(M()->query("SELECT date_format(FROM_UNIXTIME( `create_time`),'%Y-%m-%d') AS time,count(*) as count FROM `hoshot_user` WHERE 1 group by time"));
		if( isset($REQUEST['r']) ){
			$listRows = (int)$REQUEST['r'];
		}else{
			$listRows = 15;
		}
		
		$all = M('user')->count();
		 
		$page = new \Think\Page($total, $listRows, $REQUEST);
		
		
		$arr = M()->query("SELECT date_format(FROM_UNIXTIME( `create_time`),'%Y-%m-%d') AS time,count(*) as count FROM `hoshot_user` WHERE 1 group by time limit ".$page->firstRow . "," . $page->listRows);
		
		foreach ($arr as $key => $val){
			
			$all = M('user')->where('create_time < '.strtotime($val['time']))->count();
			$arr[$key]['all'] = $all+1;
			$arr[$key]['ip'] = $this->ip($val['time']);
			$arr[$key]['pv'] = $this->pv($val['time']) ? $this->pv($val['time']) : 0;
			$arr[$key]['uv'] = $this->uv($val['time']);
			
		}
		
		$p = $page->show();
		$this->assign('total',$total);
		
		$this->assign('page', $p? $p: '');
		$this->assign('arr',$arr);
		$this->display();
	}
	
	private function ip($date){
		//$count = M()->query("SELECT date_format(FROM_UNIXTIME( `create_time`),'%Y-%m-%d') AS time,count(*) as count FROM `hoshot_ip_log` WHERE date = ".$date);
		return M('ip_log')->where(array('update_date'=>$date))->count();//
	}
	
	private function pv($date){
		return M('ip_log')->where(array('update_date'=>$date))->sum('cs');
	}
	
	private function uv($date){
		return M('ip_log')->where(array('create_date'=>$date))->count();
	}
	
}