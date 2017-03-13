<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
/* 2017-01-06 carry 
 * 福利模块
 *  
 *  */
class CouponsController extends ConmmonController {
	
     public  $CSobj; //优惠券表实例
     public  $pageNum = 10;  //默认页面条数

 	public function __construct(){
 		parent::__construct();
		$this->CSobj =  M("Coupons");
	} 
	
	
	
	/*  
	 * edit 优惠券 分类
	 * 
	 * */
	public function EditCate(){
		$MD = M('coupons_type');
		if(IS_POST){
			
			$MD->coupons_name = $_REQUEST['coupons_name'];
			$MD->coupons_dec = $_REQUEST['coupons_dec'];
			$res = $MD->where('id='.$_REQUEST['id'])->save(); // 根据条件更新记录
			if ($res) {
				$this->success('操作成功！', U('CouponsCate'),'ajax_success');
			}else{
				$this->error('新增失败');
			}
		}else{
			$id = $_GET['id'];
			$list = $MD->field(true)->where(array('id='.$id))->find();
			$this->assign('category', $list);
			$this->display('EditCate');
		}
	}
	
	/*
	 * 优惠券分类列表
	 *   */
	public function CouponsCate(){
		$model =M('coupons_type');
		$total        =   $model->where(true)->count();
		
		if( isset($_REQUEST['r']) ){
			$listRows = (int)$_REQUEST['r'];
		}else{
			$listRows = 10;
		}
		
		$page = new \Think\Page($total, $listRows, $_REQUEST);
		$cate = $model->where(true)->select();
		$p = $page->show();
		$this->assign('total',$total);
		$this->assign('page', $p? $p: '');
		$this->assign('arr', $cate);
		$this->display('CouponsCate');
	}
	/*
	 * 优惠券添加分类
	*   */
	public function AddCate(){
		$Category = M('coupons_type');
		
		if(IS_POST){ //提交表单
			//var_dump($_POST);exit();
			if(false !== $Category->add($_POST)){
				$this->success('操作成功！', U('CouponsCate'),'ajax_success');
			} else {
				$error = $Category->getError();
				$this->error(empty($error) ? '未知错误！' : $error);
			}
		} else {
			$cate = array();
		
			/* 获取上级分类信息 */
			$cate = $Category->where('pid=0')->select();
		
			/* 获取分类信息 */
			$this->assign('category', $cate);
			$this->meta_title = '新增分类';
			$this->display('AddCate');
		}
    	
	}
	/*
     *
    * 优惠券列表
    *  */

    public function CouponsIndex(){
    	 
    	$model = M("coupons");
    		
    	$map = array();
    	$map[C('DB_PREFIX').'coupons.del'] = array('eq','1');
    
    	//!empty($_GET['type']) ? $map[C('DB_PREFIX').'customer_service.user_type'] = array('neq','0') :  $map[C('DB_PREFIX').'customer_service.user_type'] = '0';
    	 
    	if(IS_GET){

    		if(!empty($_GET['search'])){
    			$where[C('DB_PREFIX').'coupons.coupons_title']  = array('like', '%'.$_GET['search'].'%');

    			$where['_logic'] = 'or';
    			$map['_complex'] = $where;
    		}
 
//     		$this->assign('start_time',$_GET['start_time']);
//     		$this->assign('end_time',$_GET['end_time']);
    		$this->assign('search',$_GET['search']);
    
    	}
    	 
    	$total        =   $model
     	->join(C('DB_PREFIX')."coupons_type ON ".C('DB_PREFIX')."coupons_type.id = ".C('DB_PREFIX')."coupons.type_id","LEFT")
     	->join(C('DB_PREFIX')."admin ON ".C('DB_PREFIX')."coupons.admin_id = ".C('DB_PREFIX')."admin.id","LEFT")
    	->where($map)->count();

    	if( isset($_REQUEST['r']) ){
    		$listRows = (int)$_REQUEST['r'];
    	}else{
    		$listRows = $this->pageNum;
    	}
   
    	$page = new \Think\Page($total, $listRows, $_REQUEST);
    	 
    	$Users = $model
     	->join(C('DB_PREFIX')."coupons_type ON ".C('DB_PREFIX')."coupons_type.id = ".C('DB_PREFIX')."coupons.type_id","LEFT")
     	->join(C('DB_PREFIX')."admin ON ".C('DB_PREFIX')."coupons.admin_id = ".C('DB_PREFIX')."admin.id","LEFT")
     	->field(
    			array(
    					C('DB_PREFIX').'coupons.*',
    					C('DB_PREFIX').'coupons_type.coupons_name',
    					C('DB_PREFIX').'admin.account',
    					C('DB_PREFIX').'admin.name',
    			)
    	) 
    	->where($map)->limit($page->firstRow . ',' . $page->listRows)->order(array('create_time'=>'desc'))->select();

//     	var_dump($model->getLastSql());
    	$p = $page->show();
    	foreach ($Users as $key=>&$val){
    		$val['send_num'] = $val["coupons_number"]- $val['count_surplus'];
    		$val['status_sta'] = $val["start_time"]>time()? 1: 0;
    		$val['status_end'] = $val["end_time"]<time()? 1: 0;
    	}

    	$this->assign('arr',$Users);
    	$this->assign('total',$total);
    	$this->assign('page', $p? $p: ''); 
    
    	$this->display('CouponsIndex');
    }
    
    private function son_category(){
    	$model = M('category');
    	$map['title'] = array('like','%旅拍团%');
    	$map['status'] = 1;
    	$fid = $model->field('id')->where($map)->find();
    	$list = M('category')->where(array(
    			'pid' => (int)$fid['id'],
    			'status' => 1
    	))->select();
    	return $list;
    }
    public function category(){
    	return M('category')->where(array('model'=>2,'pid'=>0,'status'=>1))->field('id,title')->select();
    }
    
    /*
     * 所属主题优惠卷列表
    *
    *  */
    public function CouponsList(){
//     var_dump($_GET);exit();
    	$coupons_id = $_GET['coupons_id'];
//   onclick="coupons_show()" id="coupons_show"
    	$model = M("coupons");
    	$pre = C('DB_PREFIX');
    	$map = array();
    	$map[$pre.'coupons.del'] = array('eq','1');
    	$map[$pre.'coupons.id'] = $coupons_id;
    	
    	//!empty($_GET['type']) ? $map[C('DB_PREFIX').'customer_service.user_type'] = array('neq','0') :  $map[C('DB_PREFIX').'customer_service.user_type'] = '0';
    	
    	if(IS_GET){
    	
    		if(!empty($_GET['search'])){
    			$where[C('DB_PREFIX').'activity.title']  = array('like', '%'.$_GET['search'].'%');
    			$where[C('DB_PREFIX').'category.title']  = array('like','%'.$_GET['search'].'%');
//     			$where[C('DB_PREFIX').'customer_service.mobilephone']  = array('like','%'.$_GET['search'].'%');
    			$where['_logic'] = 'or';
    			$map['_complex'] = $where;
    		}
    	
//     		$this->assign('start_time',$_GET['start_time']);
//     		$this->assign('end_time',$_GET['end_time']);
    		$this->assign('search',$_GET['search']);
    	
    	}
    	$map[$pre.'coupons_type_relation.coupons_id'] = $coupons_id;
    	$total        =   $model
    			->join($pre."coupons_type_relation ON ".$pre."coupons_type_relation.coupons_id = ".$pre."coupons.id","LEFT")
//     	    	->join($pre."coupons_type ON ".$pre."coupons_type.id = ".$pre."coupons.type_id","LEFT")
		    	->join($pre."coupons_relation ON ".$pre."coupons_relation.coupons_id = ".$pre."coupons.id","LEFT")
		    	->join($pre."user ON ".$pre."coupons_relation.user_id = ".$pre."user.id","LEFT")
		    	
		    	
		    	->join($pre."order ON ".$pre."order.order_number = ".$pre."coupons_type_relation.order_id","LEFT")
		    	->join($pre."activity ON ".$pre."activity.id = ".$pre."order.act_id","LEFT")
		    	->join($pre."category ON ".$pre."activity.channel_id = ".$pre."category.id","LEFT")

//     	->field(
//     			array(
//     					C('DB_PREFIX').'coupons.*',
//     					C('DB_PREFIX').'coupons_type.coupons_name'
//     			)
//     	)
    	->where($map)->group($pre.'coupons_relation.id')->count();
    	
    	if( isset($_REQUEST['r']) ){
    		$listRows = (int)$_REQUEST['r'];
    	}else{
    		$listRows = $this->pageNum;
    	}
    	 
    	$page = new \Think\Page($total, $listRows, $_REQUEST['r']);
    	
    	$Users = $model
    			->join($pre."coupons_type_relation ON ".$pre."coupons_type_relation.coupons_id = ".$pre."coupons.id","LEFT")
// 		    	->join($pre."coupons_type ON ".$pre."coupons_type.id = ".$pre."coupons.type_id","LEFT")
		    	->join($pre."coupons_relation ON ".$pre."coupons_relation.type_rela_id = ".$pre."coupons_type_relation.id","LEFT")
		    	->join($pre."user ON ".$pre."coupons_relation.user_id = ".$pre."user.id","LEFT")
		    	
		    	->join($pre."order ON ".$pre."order.order_number = ".$pre."coupons_type_relation.order_id","LEFT")
		    	->join($pre."activity ON ".$pre."activity.id = ".$pre."order.act_id","LEFT")
		    	->join($pre."category ON ".$pre."activity.channel_id = ".$pre."category.id","LEFT")
		    	->field(
    			array(
    					$pre.'coupons.*',
//     					$pre.'coupons_type.coupons_name',
    					$pre.'coupons_type_relation.id as code_id',
    					$pre."order.act_id",
    					$pre.'coupons.coupons_title',
    					$pre.'activity.title',
    					$pre.'order.pay_time',   					
    					$pre.'category.title as cate_title',
    					$pre.'coupons_relation.coupons_status',
    					$pre.'user.account',
    					$pre.'user.nickname',
    			)
  		  	)
    	->where($map)->limit($page->firstRow . ',' . $page->listRows)->group($pre.'coupons_type_relation.id')->select();
    	
//     	    	var_dump($model->getLastSql());  //->order(['coupons_status',1])  ->order('count(*) desc')
    	$p = $page->show();
    	foreach ($Users as $key=>&$val){
    		$val['send_num'] = $val["coupons_number"]- $val['count_surplus'];
    		$val['status_sta'] = $val["start_time"]>time()? 1: 0;
    		$val['user_name'] = empty($val["nickname"])? $val["account"]: $val["nickname"];
    	}
    	
    	$this->assign('arr',$Users);
    	$this->assign('total',$total);
    	$this->assign('page', $p? $p: '');
    	
    	$this->display('CouponsList');
    }
    
    /* 
     * 发放优惠卷
     *  
     *  */
    public function SendCoupons(){

    	if (IS_POST) {
    		
    		
    		$Cmodel = M('coupons');

    		$data['coupons_title'] = $_POST['coupons_title'];
    		$data['start_time'] = strtotime( $_POST['start_time']);
    		$data['end_time'] = strtotime( $_POST['end_time'] );
    		$data['type_id'] = $_POST['type'];
    		$data['admin_id'] = $_POST['admin_id'];

    		$data['use_scope_min'] = isset($_POST['use_scope_min'])?$_POST['use_scope_min']:0;
    		$data['use_scope_max'] = isset($_POST['use_scope_max'])?$_POST['use_scope_max']:0;
    		$data['coupons_value'] = $_POST['coupons_value'];
    		$data['coupons_number'] = $_POST['coupons_number'];
    		$data['count_surplus'] = $_POST['coupons_number'];
    		
    		$changeType = $data['changeType'] = isset($_POST['changeType'])?$_POST['changeType']:3;
    		$act_type = '';
    		$user_type = 0;
    		$user_type_child = 0;
    		switch ($changeType) {
    			case 1:
    				$data['business_id'] = 0;
    				$data['act_id'] = isset($_POST['actIDs'])?$_POST['actIDs']:0;
    				if ($data['act_id'] != 0) {
    					$data['act_id'] = implode(',',$data['act_id']);
    				}
    				
    				var_dump($data['act_id']);
    				$user_type = isset($_POST['user_type'])?$_POST['user_type']:0;  //用户类型
    				$user_type_child = isset($_POST['user_type_child'])?$_POST['user_type_child']:0;  //认证用户
    				break;
    			case 2:
    				$data['business_id'] = isset($_POST['business_ids'])?$_POST['business_ids']:0;
    				$data['act_id'] = 0;
    				if (isset($_POST['act_type'])&& isset($_POST['son_id']) && $_POST['son_id']>0) {
    					$act_type = $_POST['son_id'];
    				}else{
    					$act_type = isset($_POST['act_type'])?$_POST['act_type']:'';
    				}
    				break;
    			case 3:
		    		if (isset($_POST['act_type'])&& isset($_POST['son_id']) && $_POST['son_id']>0) {
		    			$act_type = $_POST['son_id'];
		    		}else{
		    			$act_type = isset($_POST['act_type'])?$_POST['act_type']:'';
		    		}
    				$user_type = isset($_POST['user_type'])?$_POST['user_type']:0;  //用户类型
    				$user_type_child = isset($_POST['user_type_child'])?$_POST['user_type_child']:0;  //认证用户
    				break;
    			
    			default:
    				;
    			break;
    		}
    		
    		
    		$data['create_time'] = time();
    		
 
    		$data['category_id'] = $act_type;//活 动类型
    		$data['user_type'] = $user_type;
    		$data['user_type_child'] =$user_type_child;
    		
    		$data['is_support'] = isset($_POST['is_support'])?$_POST['is_support']:0;  //是否支付其他活动
//     		echo "<pre />";
// 			var_dump($data);exit();
    		$Cmodel->startTrans();
    		$ret = $Cmodel->add($data);
    		$headCode = '';
    		if (type_id == 1) {
    			//优惠券
    			$headCode = 'HS';
    		}else{
    			//现金卷
    			$headCode = 'JY';
    		}
    		if(false !== $ret){
    			//新增优惠卷 （hoshot_coupons_relation）
    		    for ($i = 0;$i<$_POST['coupons_number'];$i++){
    					$str = md5(rand(10000000, 90000000).uniqid(microtime(true),true));
    					//$uq = date('Ymd').substr(implode(NULL, array_map('hoshot', str_split(substr(uniqid(), 7, 13), 1))), 0);
    					$str = substr($str, 6,8);
	    				$coupons_code = $headCode.$str;//getCouponsCode()
	    			$datas[] = array(
	    					'coupons_id'=> $ret,
	    					'type_id'=> $_POST['type'],
	    					'coupons_code'=> $coupons_code,
	    			);
    			}
    			$res = M('coupons_type_relation')->addAll($datas);
	    		 if ($res){//操作成功
				    // 提交事务
				    $Cmodel->commit();
				    $this->success('操作成功！', U('/admin/Coupons/CouponsIndex'));
				 }else{
				   // 事务回滚
				 	$error = $Cmodel->getError();
				   $Cmodel->rollback(); 
				   $this->error(empty($error) ? 'addType操作失败！' : $error);
				 }
    			
    		} else {
    			$error = $Cmodel->getError();
    			// 事务回滚
    			$Cmodel->rollback();
    			$this->error(empty($error) ? 'add操作失败！' : $error);
    		}

    	}

    	$type = M('coupons_type')->field(true)->select();
    	$user = '';//M('user')->field('id','user_type')->select();
    	$adminid = empty($_SESSION["hoshot_admin"]["user_auth"])?$_SESSION["user_auth"]:$_SESSION["hoshot_admin"]["user_auth"];
    	$result = M('activity')->field('id,title,create_time')->select();//->order('create_time,desc')
    
//     	var_dump($result);
    	$user = M('user')->field('id,user_type,account,name,nickname')->select();
    	$this->assign('actArr',$result);
    	$this->assign('adminArr',$adminid);
    	$this->assign('typeArr',$type);
    	$this->assign('user',$user);
        $cate = $this->category();

    	$this->assign('actType',$cate);
    	$this->assign('son',$this->son_category());
    	$this->display('SendCoupons');
    }
    /*  
     * 查看优惠卷
     * */
 	public function CouponsShow(){
// 		var_dump($_GET['id']);

		$couid = $_GET['id'];
		$model = M("coupons");
		$pre = C('DB_PREFIX');
		$map[$pre.'coupons.del'] = array('eq','1');
 		$map[$pre.'coupons.id'] = $couid;
		$Users = $model
    			->join($pre."coupons_type_relation ON ".$pre."coupons_type_relation.coupons_id = ".$pre."coupons.id","LEFT")
		    	->join($pre."coupons_type ON ".$pre."coupons_type.id = ".$pre."coupons.type_id","LEFT")
		    	->join($pre."coupons_relation ON ".$pre."coupons_relation.type_rela_id = ".$pre."coupons_type_relation.id","LEFT")
		    	->join($pre."user ON ".$pre."coupons.business_id = ".$pre."user.id","LEFT")
		    	
// 		    	->join($pre."order ON ".$pre."order.id = ".$pre."coupons_type_relation.order_id","LEFT")
// 		    	->join($pre."activity ON ".$pre."activity.id = ".$pre."coupons.act_id","LEFT")
// 		    	->join($pre."category ON ".$pre."activity.channel_id = ".$pre."category.id","LEFT")
				->join($pre."category ON ".$pre."coupons.category_id = ".$pre."category.id","LEFT")
		    	->field(
    			array(
    					$pre.'coupons.*',
    					$pre.'coupons_type.coupons_name',
    					$pre.'coupons_type_relation.id as code_id',
//     					$pre."order.act_id",
    					$pre.'coupons.coupons_title',
//     					$pre.'activity.title',
//     					$pre.'order.pay_time',   					
    					$pre.'category.title as cate_title',
    					$pre.'coupons_relation.coupons_status',
    					$pre.'user.account',
    					$pre.'user.nickname',
    			)
  		  	)
    	->where($map)->group($pre.'coupons.id')->select();
 //->order(['coupons_status',1])  ->order('count(*) desc')
    	foreach ($Users as $key=>&$val){
    		if ($val['act_id'] !=0 ) {
    			$cat_ids = explode(',', $val['act_id']);
    			if (is_array($cat_ids)) {
	    			foreach ($cat_ids as $k=>$v){
	    				$title = M('activity')->field('id,title')->where("id=%d",array($v))->find();
	    				$val['title'][]= $title['title'];
	    			}
    			}    			
    		}
    		$val['send_num'] = $val["coupons_number"]- $val['count_surplus'];
    		$val['status_sta'] = $val["start_time"]>time()? 1: 0;
    		$val['user_name'] = empty($val["nickname"])? $val["account"]: $val["nickname"];
    	}
    	$this->assign('arr',$Users);
    	$this->assign('son',$this->son_category());
		$this->assign('adminArr',$couid);
		$this->display('CouponsShow');
		
	}
  
    
    //获取商家名
    public function getCouponsbusiness(){
    	$busiName = $_GET['name'];
    	if (empty($busiName))exit(json_encode(false)) ;
    	$res = M('user')->where(array('account like "%'.$busiName.'%" or nickname like "%'.$busiName.'%"','user_type > 0'))->field('id,user_type,account,name,nickname')->limit(1)->select();
    	if ($res) {
    		exit(json_encode($res)) ;
    	}else{
    		exit(json_encode(false)) ;
    	}
    	
    }
    //获取活动名
    public function getCouponsActivity(){
    	$busiName = $_GET['name'];
    	if (empty($busiName))exit(json_encode(false)) ;
    	$result = M('activity')->where(array('title like "%'.$busiName.'%"'))->field('id,title')->limit(1)->select();
    	if ($result) {
    		exit(json_encode($result)) ;
    	}else{
    		exit(json_encode(false)) ;
    	}
    	
    }
    
}



