<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
/* 2016-12-28 carry 
 * 客服管理模块
 *  
 *  */
class CustomerServiceController extends ConmmonController {
 /*    public  $CSobj; //客服表实例

 	public function __construct(){
		$this->CSobj =  M("customer_service");
	} */
	/*
     *
    * 客服列表
    *  */

    public function CustomerIndex(){
    	 
    	$model = M("customer_service");
    		
    	$map = array();
    	$map[C('DB_PREFIX').'customer_service.del'] = array('eq','1');
    
    	//!empty($_GET['type']) ? $map[C('DB_PREFIX').'customer_service.user_type'] = array('neq','0') :  $map[C('DB_PREFIX').'customer_service.user_type'] = '0';
    	 
    	if(IS_GET){

    		if(!empty($_GET['search'])){
    			$where[C('DB_PREFIX').'customer_service.account']  = array('like', '%'.$_GET['search'].'%');
    			$where[C('DB_PREFIX').'customer_service.phone']  = array('like','%'.$_GET['search'].'%');
    			$where[C('DB_PREFIX').'customer_service.mobilephone']  = array('like','%'.$_GET['search'].'%');
    			$where['_logic'] = 'or';
    			$map['_complex'] = $where;
    		}
    		 
    
    		$this->assign('start_time',$_GET['start_time']);
    		$this->assign('end_time',$_GET['end_time']);
    		$this->assign('search',$_GET['search']);
    
    	}
    	 
    	$total        =   $model
     	->join(C('DB_PREFIX')."substation ON ".C('DB_PREFIX')."substation.filiale_id = ".C('DB_PREFIX')."customer_service.filiale_id","LEFT")->field(
    			array(
    					C('DB_PREFIX').'customer_service.*',
    					C('DB_PREFIX').'substation.name'
    			)
    	) 
    	->where($map)->count();

    	if( isset($_REQUEST['r']) ){
    		$listRows = (int)$_REQUEST['r'];
    	}else{
    		$listRows = 15;
    	}
    
    	$page = new \Think\Page($total, $listRows, $_REQUEST);
    	 
    	$Users = $model
    	->join(C('DB_PREFIX')."substation ON ".C('DB_PREFIX')."substation.filiale_id = ".C('DB_PREFIX')."customer_service.filiale_id","LEFT")->field(
    			array(
    					C('DB_PREFIX').'customer_service.*',
    					C('DB_PREFIX').'substation.name'
    			)
    	)
    	->where($map)->limit($page->firstRow . ',' . $page->listRows)->select();
    	//         ->join(C('DB_PREFIX')."admin_role ON ".C('DB_PREFIX')."admin_role.id = ".C('DB_PREFIX')."admin.group_id","LEFT")->field(
    			//         		array(
    					//         				C('DB_PREFIX').'admin.*',
    					//         				C('DB_PREFIX').'admin_role.*',
    					//         				C('DB_PREFIX').'admin_role.name' => 'role_name',
    					//         				C('DB_PREFIX').'admin.id' => 'aid'
    					//         		)
    			//         		)
    	

    	$p = $page->show();
    	foreach ($Users as $key=>&$val){
    		$val['total_act'] = $this->getTotalActivity($val["id"]);
    	}
    	$this->assign('arr',$Users);
    	$this->assign('total',$total);
    	$this->assign('page', $p? $p: '');
    
    	$this->display('CustomerIndex');
    }
    /* 
     * 管理活动的总数
     *  
     *  */
    public function getTotalActivity($CID){
    	$model = M("activity");
    	
    	$map = array();
    	//$map[C('DB_PREFIX').'activity.activity_price'] = array('neq',0);
    	if (!empty($CID)) {
    		$map[C('DB_PREFIX').'customer_activity.customer_id'] = array('eq',$CID);
    	}
    	    	
    	$model
    	->join(C('DB_PREFIX')."category ON ".C('DB_PREFIX')."category.id = ".C('DB_PREFIX')."activity.channel_id","LEFT")
    	->join(C('DB_PREFIX')."customer_activity ON ".C('DB_PREFIX')."customer_activity.act_id = ".C('DB_PREFIX')."activity.id","LEFT")
    	->join(C('DB_PREFIX')."customer_service ON ".C('DB_PREFIX')."customer_service.id = ".C('DB_PREFIX')."customer_activity.customer_id","right");
    	$total        =   $model->where($map)->count();
    	return $total;
    }
    /*
     * 添加客服
    *  */
    public function CustomerAdd(){
    
    	if (IS_POST) {
    		try {
    			$model = M('customer_service');
    			$model->create();
    			$model->create_time = time();
    			$model->update_time = time();
    			if(false !== $model->add()){
    				$this->success('新增成功！', U('index'),'ajax_success',1);
    			} else {
    				$error = $model->getError();
    				$this->error(empty($error) ? '未知错误！' : $error);
    			}
    		} catch (Exception $e) {
    			E($e->__toString(),$e->getCode());
    
    		}
    	}
    	 
    	$list = M('substation')->field('id,filiale_id,name')->select();//M('Filiale')
 
    	$uid = empty($_SESSION["hoshot_admin"]["user_auth"])?$_SESSION["user_auth"]:$_SESSION["hoshot_admin"]["user_auth"];
    	$this->assign('adminArr',$uid);
    	$this->assign('typeArr',$list);
    	$this->display('CustomerAdd');
    }

    /*
     * 编辑客服
    *  */
    public function CustomerEdit(){
    	try {
    		if(IS_POST){
    			
    			$Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表 

    			$res = $Model->execute("update ".C('DB_PREFIX')."customer_service 
    					set 
    						account='".$_POST['account']."' ,
    						mobilephone= '".$_POST['mobilephone']."',
    						phone='".$_POST['phone']."',
    						filiale_id=".$_POST['filiale_id'].",
    						update_time=".time()."
    						where id=".$_POST['id']
    					);
    			if ($res) {
    				$this->success('编辑成功！', U('CustomerIndex'),'ajax_success',1);
    				//$this->redirect('','',2,'操作成功！');
    			}else{
    				$this->error('操作失败！');
    			}
    
    		}
    		/* 
    		 * array(6) {
    		 *  ["id"]=> string(1) "4" ["admin_id"]=> string(1) "1" ["account"]=> string(9) "客服004" 
    		 *  ["mobilephone"]=> string(11) "15118149066" 
    		 *  ["phone"]=> string(6) "123456" ["filiale_id"]=> string(2) "1 " }
    		 *  */
    		$mC = M('customer_service');
    		$id = '';
    		$id = $_GET['id'];
    		$list = M('substation')->field('id,filiale_id,name')->select();
    		$this->assign('list',$list);
    		$Clist = $mC->where(array(C('DB_PREFIX').'customer_service.id'=>$id))
    		->join(C('DB_PREFIX')."substation ON ".C('DB_PREFIX')."substation.filiale_id = ".C('DB_PREFIX')."customer_service.filiale_id","LEFT")->field(
    				array(
    						C('DB_PREFIX').'customer_service.*',
    						C('DB_PREFIX').'substation.name'    	
    				)
    		)
    		->find();

    		$this->assign('customerList',$Clist);
    		$uid = empty($_SESSION["hoshot_admin"]["user_auth"])?$_SESSION["user_auth"]:$_SESSION["hoshot_admin"]["user_auth"];
    		$this->assign('adminArr',$uid);
    		$this->display('CustomerEdit');
    	} catch (Exception $e) {
    		$this->error( $e->__toString().":". $e->getCode());
    	}
    }
    /*
     * 删除客服
    * */
    public function CustomerDel($id){
    	if(IS_POST and !empty($_POST['id'])){
    		$id = json_decode($_POST['id']);
    		foreach ($id as $val){
    			M('customer_service')->where(array('id'=>$val))->save(array('del'=>0));
    		}
    		$this->success('删除客服成功！');
    		return false;
    	}
    	$this->delete('customer_service',array('id'=>$id));
    }
    public function cstart($id){
    
    	M('customer_service')->where(array('id'=>$id))->save(array('status'=>1,'update_time'=>time()));
    	$this->success('操作成功！');
    }
    /*
     * 设置默认客服    0 , 1为普通客服。
    *   */
    public function setKF($id){
    
    	$model = M('customer_service');
    	$res = $model->where(array('level'=>0))->find();
    	if ($res) {
    		$resU = $model->where(array('id'=>$res['id']))->save(array('level'=>1,'update_time'=>time()));
    		if ($resU) {
    			$model->where(array('id'=>$id))->save(array('level'=>0,'update_time'=>time()));
    			$this->success('操作成功！', U('CustomerIndex'),'ajax_success');
    		}
    
    
    	}else {
    		$model->where(array('id'=>$id))->save(array('level'=>0,'update_time'=>time()));
    		$this->success('操作成功！', U('CustomerIndex'),'ajax_success');
    	}
    
    }
    /*
     * 客服 要管理 的活动列表
    *
    *   */
    public function CustomerActivity(){
    	$model = M("activity");
    	 
    	$map = array();
    	//$map[C('DB_PREFIX').'activity.activity_price'] = array('neq',0);
    	 
    	if(IS_GET){
    
    		if(!empty($_GET['start_time']))  $map[C('DB_PREFIX').'activity.create_time'] = array('egt',strtotime($_GET['start_time']));
    		if(!empty($_GET['end_time']))    $map[C('DB_PREFIX').'activity.create_time'] = array('elt',strtotime($_GET['end_time']));
    		if(!empty($_GET['start_time']) and !empty($_GET['end_time'])){
    			$map[C('DB_PREFIX').'activity.create_time'] = array(array('gt',strtotime($_GET['start_time'])),array('lt',strtotime($_GET['end_time'])));
    		}
    
    		if(!empty($_GET['search'])){
    			$map[C('DB_PREFIX').'activity.title']  = array('like', '%'.$_GET['search'].'%');
    			//         		$where['phone']  = array('like','%'.$_GET['search'].'%');
    			//         		$where['email']  = array('like','%'.$_GET['search'].'%');
    			//         		$where['nickname']  = array('like','%'.$_GET['search'].'%');
    			//         		$where['_logic'] = 'or';
    			//         		$map['_complex'] = $where;
    		}
    		 
    
    		$this->assign('start_time',$_GET['start_time']);
    		$this->assign('end_time',$_GET['end_time']);
    		$this->assign('search',$_GET['search']);
    
    	}
    	 
    	$total        =   $model->where($map)->count();
    	 
    	if( isset($_REQUEST['r']) ){
    		$listRows = (int)$_REQUEST['r'];
    	}else{
    		$listRows = 10;
    	}
    	 
    	$page = new \Think\Page($total, $listRows, $_REQUEST);
    	 
    	$arr = $model
    	->join(C('DB_PREFIX')."category ON ".C('DB_PREFIX')."category.id = ".C('DB_PREFIX')."activity.channel_id","LEFT")
    	
    	->join(C('DB_PREFIX')."customer_activity ON ".C('DB_PREFIX')."activity.id = ".C('DB_PREFIX')."customer_activity.act_id","left")
    	->join(C('DB_PREFIX')."customer_service ON ".C('DB_PREFIX')."customer_service.id = ".C('DB_PREFIX')."customer_activity.customer_id","left")
    	->field(
    			array(
    					C('DB_PREFIX').'activity.*',
    					C('DB_PREFIX').'customer_service.account',
    					C('DB_PREFIX').'category.title' => '_title'
    			)
    	)
    	

    	->where($map)->limit($page->firstRow . ',' . $page->listRows)->order('`create_time` DESC')->select();
    	 //echo $model->getLastSql();
    	$p = $page->show();
    	$mC = M('customer_service');
    	$uid = empty($_SESSION["hoshot_admin"]["user_auth"]['uid'])?$_SESSION["user_auth"]['uid']:$_SESSION["hoshot_admin"]["user_auth"]['uid'];
    	$Clist = $mC->where(array('admin_id'=>$uid))->field(array('id','account','level'))->select();
    	foreach ($Clist as $key=>$vals){
    		if ($vals['level']==0) {
    			//$dfCoust = $vals['account'];
    			$dfCoustID = $vals['id'];
    		}
    	}
    	$ids =0;
    	foreach ($arr as $k=>$val){
    		if(!$val['account']){
    			$ids++;
    			$data[] = array(
    					"customer_id"=>$dfCoustID,
    					'act_id'=>$val["id"]
    			);
    		}
    	}
    	if ($ids>0) {
    		$model = M('customer_activity');
    		$res = $model->addAll($data);
    	}
    	
    	
    	$this->assign('arr',$arr);
    	
    
    	$this->assign('customerList',$Clist);
    	$this->assign('total',$total);
    	$this->assign('page', $p? $p: '');
    	$this->display('CustomerActivity');
    	 
    	 
    }
    /*
     *添加活动到 客服
    *  */
    public  function joinActivity(){
    	try {

    		$cusid= $_POST['customer_id'];

    		if(IS_POST and !empty($_POST['id'])){
    			$id = json_decode($_POST['id']);
				
    			$res = true;
    			$ids = '';
    			$idArr = 0;
    			//$model = M('customer_activity');
    			$Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
    			foreach ($id as $val){
    				$resU = $this->checkCustomerAdd($val);
    				
    				if (false === $resU) {
    					$idArr++;
    					 //添加活动到 客服
    					$data[] = array(
    						"customer_id"=>$cusid,
    						'act_id'=>$val
    					);
    					
    					$Model->execute("INSERT INTO  ".C('DB_PREFIX')."customer_activity (`customer_id`,`act_id`) VALUES(".$cusid.",".$val.")");
    					//$sql.= $Model->getlastSql();
    				}else if ($resU === true){
    					// 换客服
    					$ids[] = $val;
    				}

    
    			}
    			$idsCount = count($idArr);
    			//$ress = M('customer_activity')-> addAll($data);
    			//修改活动所在客服
    			if (!empty($ids)) {
    				$ress = $this->updCusActivity($cusid,$ids);
    			}
    			
    			if ($ress) {
    				exit(json_encode(array('ajax_success'=>'ajax_success','idsCount'=>$idArr)));
    				
    			}else{
    				exit(json_encode(array('ajax_success'=>'ajax_error')));
    			}
    				
    		}
    		//$this->delete('Activity',array('id'=>$id));
    	} catch (Exception $e) {
    		E('error','-1');
    	}
    
    }
    
    /* 
     * 删除客服的活动
     *  */
    public function delCusActivity($cusid,$ids){
    	try {
    		
    	} catch (Exception $e) {
    	}
    	
    }

    /*
     * 修改客服的活动
    *  */
    public function updCusActivity($cusid,$ids){
    	try {
    		$idsCt = count($ids);
    		$idArr = '';
    		foreach ($ids as $val){
    			$resU = $this->checkCustomerAdd($val,$cusid);
    		
    			if (false === $resU) {
    				// 换客服
    				$idArr[] = $val;
    			}else if ($resU === true){   				
    				//已经存在此客户 客服
    			}	
    		
    		}
    		 $idsCount = count($idArr);
			 $idsStr = empty($idArr)?'':implode($idArr, ',');	
			 if ($idsCt>0&&empty($idsStr)) {
			 	exit(json_encode(array('ajax_success'=>"exist_success")));;
			 }		
	    	 $Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表	    	 
	    	 $res = $Model->execute("update ".C('DB_PREFIX')."customer_activity
    					set
    						customer_id = ".$cusid."

    						where act_id in (".$idsStr.")"
	    	 );
	    	 $sql = $Model->getLastSql();
	    	 if ($res) {
	    	 	exit(json_encode(array('ajax_success'=>'ajax_success','idsCount'=>$idsCount)));
	    	 	//$this->success('编辑成功！', U('/admin/CustomerService/customerActivityList?customer_id='.$cusid),'ajax_success');
	    	 	//$this->redirect('','',2,'操作成功！');
	    	 }else{
	    	 	exit(json_encode(array('ajax_success'=>"exist_error")));
	    	 }
    	} catch (Exception $e) {
    		
    	}
    	 
    }    
    /*
     * 检查该活动是否被添加
     *   */
    public function checkCustomerAdd($actid,$cusid = null){
    	$model = M('customer_activity');
    	if (null === $cusid) {
    		$cid =array('act_id'=>$actid);
    	}else{
    		$cid =array('customer_id'=>$cusid ,'act_id'=>$actid);
    	}
    	 
    	$res = $model->where($cid)->find();
    	if ($res) {
    		return true;
    	}else{
    		return false;
    	}
    	 
    }
    /*
     * 单个客服 所管理的活动列表
    *  */
    public  function customerActivityList(){
    	
    	$CID = $_REQUEST['customer_id'];
    	empty($CID) && $this->error('参数不能为空！');

    	$model = M("activity");
    
    	$map = array();
    	//$map[C('DB_PREFIX').'activity.activity_price'] = array('neq',0);
    	if (!empty($CID)) {
    		$map[C('DB_PREFIX').'customer_activity.customer_id'] = array('eq',$CID);
    	} 
    
    	if(IS_GET){
    		 
    		if(!empty($_GET['start_time']))  $map[C('DB_PREFIX').'activity.create_time'] = array('egt',strtotime($_GET['start_time']));
    		if(!empty($_GET['end_time']))    $map[C('DB_PREFIX').'activity.create_time'] = array('elt',strtotime($_GET['end_time']));
    		if(!empty($_GET['start_time']) and !empty($_GET['end_time'])){
    			$map[C('DB_PREFIX').'activity.create_time'] = array(array('gt',strtotime($_GET['start_time'])),array('lt',strtotime($_GET['end_time'])));
    		}
    		 
    		if(!empty($_GET['search'])){
    			$map[C('DB_PREFIX').'activity.title']  = array('like', '%'.$_GET['search'].'%');
    			  //       		$where['phone']  = array('like','%'.$_GET['search'].'%');
    			 //        		$where['email']  = array('like','%'.$_GET['search'].'%');
    			 //       		$where['nickname']  = array('like','%'.$_GET['search'].'%');
    			//         		$where['_logic'] = 'or';
    			 //        		$map['_complex'] = $where;
    		}
    		 
    		 
    		$this->assign('start_time',$_GET['start_time']);
    		$this->assign('end_time',$_GET['end_time']);
    		$this->assign('search',$_GET['search']);
    		 
    	}
    	$model
    	->join(C('DB_PREFIX')."category ON ".C('DB_PREFIX')."category.id = ".C('DB_PREFIX')."activity.channel_id","LEFT")
    	->join(C('DB_PREFIX')."customer_activity ON ".C('DB_PREFIX')."customer_activity.act_id = ".C('DB_PREFIX')."activity.id","LEFT")
    	->join(C('DB_PREFIX')."customer_service ON ".C('DB_PREFIX')."customer_service.id = ".C('DB_PREFIX')."customer_activity.customer_id","right");
    	$total        =   $model->where($map)->count();
    
    	if( isset($_REQUEST['r']) ){
    		$listRows = (int)$_REQUEST['r'];
    	}else{
    		$listRows = 10;
    	}
    
    	$page = new \Think\Page($total, $listRows, $_REQUEST);
    	//hoshot_customer_activity
    	$arr = $model
    	->join(C('DB_PREFIX')."category ON ".C('DB_PREFIX')."category.id = ".C('DB_PREFIX')."activity.channel_id","LEFT")
    	->join(C('DB_PREFIX')."customer_activity ON ".C('DB_PREFIX')."customer_activity.act_id = ".C('DB_PREFIX')."activity.id","LEFT")
    	->join(C('DB_PREFIX')."customer_service ON ".C('DB_PREFIX')."customer_service.id = ".C('DB_PREFIX')."customer_activity.customer_id","right")
    	->field(
    			array(
    					C('DB_PREFIX').'activity.*',
    					C('DB_PREFIX').'customer_service.id',
    					C('DB_PREFIX').'customer_service.account',
    					C('DB_PREFIX').'category.title' => '_title'
    			)
    	)
    	->where($map)->limit($page->firstRow . ',' . $page->listRows)->order('`create_time` DESC')->select();
    	  //echo $model->getLastSql();
    	$p = $page->show();
    	$this->assign('arr',$arr);
    	$mC = M('customer_service');
    	//$Clist = $mC->where(array('admin_id'=>$_SESSION["user_auth"]['uid']))->field(array('id','account'))->select();
    	 
    	//$this->assign('customerList',$Clist);
    	$this->assign('total',$total);
    	$this->assign('page', $p? $p: '');
    	$this->display('CustomerService/customerActivityList');
    
    }
    
    
    
    

}



