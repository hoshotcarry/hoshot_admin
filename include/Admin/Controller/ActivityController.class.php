<?php
namespace Admin\Controller;
use Think\Controller;

class ActivityController extends ConmmonController {
	
    public function index(){
        
        $model = M("activity");
         
        $map = array();
        $map[C('DB_PREFIX').'activity.activity_price'] = array('neq',0);
                 
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
        ->join(C('DB_PREFIX')."category ON ".C('DB_PREFIX')."category.id = ".C('DB_PREFIX')."activity.channel_id","LEFT")->field(
        		array(
        				C('DB_PREFIX').'activity.*',
        				C('DB_PREFIX').'category.title' => '_title'
        		)
        )
        ->where($map)->limit($page->firstRow . ',' . $page->listRows)->order('`create_time` DESC')->select();
      //  echo $model->getLastSql();
        $p = $page->show();
        $this->assign('arr',$arr);
        $this->assign('total',$total);
        $this->assign('page', $p? $p: '');
        $this->display();
       // !empty($_GET['type']) ? $this->display('index_auth') : $this->display();        		
       
    }
    
    public function show($id){
    	$this->assign('images',M('images')->where(array('moduleType'=>2,'content_id'=>$id))->select());
    	$this->display();
    }
    
    public function info($id){
    	
    	$model = M('activity');
    	
    	$map = array();
    	
    	$map['hoshot_activity.id'] = $id;
    	
    	$model->join(C('DB_PREFIX')."activitys ON ".C('DB_PREFIX')."activity.id = ".C('DB_PREFIX')."activitys.act_id","LEFT")
	    	->join(C('DB_PREFIX')."category ON ".C('DB_PREFIX')."category.id = ".C('DB_PREFIX')."activity.channel_id","LEFT")
	    	->field(
	    			array(
	    					C('DB_PREFIX').'activity.*',
	    					C('DB_PREFIX').'activitys.*',
	    					C('DB_PREFIX').'category.title' => '_title'
	    			)
	    	);
    	$info = $model->where($map)->find();
    	$this->assign('info',$info);
    	$this->assign('tag',M('tags')->field('tagName')->where(array('id'=>array('in',$this->_tag($id))))->select());
    	
    	$this->assign('cart',M('activity_description')->where(array('act_id'=>$id))->select());
    	
    	$this->display();
    	
    }
    
    public function tags(){
    	return M('tags')->where(array('moduleType'=>2))->select();
    }
    
    protected function forb( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
    	$data['status']         =   -1;
    	$data['update_time']    =   NOW_TIME;
    	$this->editRow(   $model , $data, $where, $msg);
    }
    
    public function enb($id){
    	$this->forb('activity',array('id'=>$id));
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
    
    public function add(){
    	if(IS_POST){

    		$model = D('Activity');
    		if($model->create()){
    			
    			if($_POST['son_id'] != 0) $model->channel_id = $_POST['son_id'];
    			
    			$model->update_time = time();
    			$model->create_time = time();
    			$model->user_id = 10000001;
    			$model->end_citys = '[]';
    			$model->status = 0;
    			$model->start_time = strtotime($_POST['start_time']);
    			$model->end_time = strtotime($_POST['end_time']);
    			
    			//77 游摄团 才有目的地址
    			if($_POST['_end_'] == 'yes' && $_POST['channel_id'] == '77' ){
    				$end = M('activity_address')->add(array(
    						'province'  =>  $_POST['end_province'],
    						'county'  =>  $_POST['county'],
    						'city'  =>  $_POST['end_city'],
    						'province'  =>  $_POST['end_address'],
    				));
    			}
    			
    			$model->end_address = serialize($_end[] = $end);
    			
    			$add = $model->add();
    			//carry 2017-01-04 添加活动成功后  加入到默认客服中
    			if ($add) {
    				$mC = M('customer_service');
    				$Clist = $mC->where(array('level'=>0))->field(array('id','account','level'))->find();
    				$data['customer_id'] = $Clist['id'];
    				$data['act_id'] = $add;
    				$res = M('customer_activity')->add($data);
    			}
    			if(!empty($_POST['postion'])) $xy = explode(',',$_POST['postion']);
    			
    			!empty($xy[0]) ? $x = $xy[0] : $x = 0;
    			!empty($xy[0]) ? $y = $xy[1] : $y = 0;
    			
    			M('activitys')->add(array(
    					'act_id' => $add,
    					'longitude' => $x,
    					'latitude' => $y,
    					'count_praise' => 0,
    					'count_comment' => 0,
    					'count_browse' => 1,
    					'count_share' => 0,
    					'count_works' => 0
    			));
    			
    			if($add){
    				
    				foreach ($_POST['checkbox'] as $t => $g){
    					if($g == 'on')
    						M('activity_tags')->add(array(
    								'act_id'   => $add,
    								'tag_id'   => $t,
    						));
    				}
    				   				
    				//活动详情
    			    foreach ($_POST['cont'] as $index => $item){
    					if(!empty($_POST['cont'][$index]))
    					M('activity_description')->add(array(
    							'act_id'     => $add,
    							'shoot_id'   => $_POST['shoot_id'][$index] ? $_POST['shoot_id'][$index] : 0,
    							'images'     => !empty($_FILES['file'.($index+1)]) ? $this->create_images_path(10000001,$_FILES['file'.($index+1)]) : '',
    							'content'    => $_POST['cont'][$index],
    					));
    				}

    				if(!empty($_POST['img'])){
    				$arr = explode('|',$_POST['img']);
    				foreach ($arr as $key => $val){
    				   if(empty($val)) continue;
    				   $images = M('images')->add(
    						array(
    								'content_id'    => $add,
    								'module_id'     => 2,
    								'status'        => 1,
    								'create_time'   => time(),
    								'media_type'    => 0,
    								'path'          => $val
    						)
    				   );
    				}
    				}
    			    if(!empty($_POST['_img'])){
    				$arr = explode('|',$_POST['_img']);
    				foreach ($arr as $key => $val){
    				   if(empty($val)) continue;
    				   $images = M('images')->add(
    						array(
    								'content_id'    =>   $add,
    								'module_id'     =>  2,
    								'status'        => 1,
    								'create_time'   => time(),
    								'media_type'    => 1,
    								'path'          => $val
    						)
    				   );
    				}
    				}
    			}

    			
    			$this->success('添加成功！', U('index'),'ajax_success');
    		}else{
    			$error = $model->getError();
    			$this->error(empty($error) ? '未知错误！' : $error);
    		}
    		return true;
    	}
    	$this->assign('qisclaimer',$this->qisclaimer(0));
    	$this->assign('tags',$this->tags());
    	//$data = Db::name('cities')->where(['pid'=>$id])->select();
    	$id = 0;
    	$county = M('cities')->where(array('pid'=>$id))->select();
    	$this->assign('CountyArr',$county);
    	$this->assign('location',$this->location());
    	$this->assign('category',$this->category());

    	$this->assign('shoot',$this->shoot());
    	
    	$this->assign('son',$this->son_category());

    	$this->display();
    }
    
    public function create_images_path($uid,$media){
    	
    	$upload = new \Think\Upload();// 实例化上传类
    	$upload->maxSize   =     50000000 ;// 设置附件上传大小
    	$upload->rootPath  =     '/mnt/alidata/www/api_hoshot/public'; // 设置附件上传根目录
    	$upload->savePath  =     '/activity/'.$uid.'/'.rand(10000,99999).'/'; // 设置附件上传（子）目录
    	$upload->autoSub   =    false;
    	$upload->saveName  =     (string)time();
    	// 上传文件
    	$info   =   $upload->uploadOne($media);
    	if(!$info) {// 上传错误提示错误信息
    		$this->error("上传失败:".$upload->getError());
    	}else{
    		return '/uploads'.$info['savepath'].$info['savename'];
    	}
    	  	
    }
    
    
    public function category(){
    	return M('category')->where(array('model'=>2,'pid'=>0,'status'=>1))->select();
    }
    
    public function qisclaimer($id){
    	$model = M('qisclaimer');
    	
    	$map = array();
    	
    	if(!empty($id)){
    		$map['id'] = $id;
    		$model->where($map);
    	}
    	
    	if($id == 0){
    		return $model->select();
    	}
    	
    	$rel = $model->find();
    	
    	echo json_encode($rel);
    }
    
    public function recommended($id){
    	if(M('Activity')->where(array('id'=>$id))->save(array('is_recommend'=>1))){
    		$this->success('操作成功！');
    	}else{
    		$this->success('操作失败！');
    	}
    }
    /*
     * carry 2016-12-27  update  编辑时可以上传图片
    *  */
    public function edit($id){
    	if(empty($id)){
    		$this->error('参数错误');
    	}
    	$model = D('Activity');
    	if(IS_POST){
    		
    		if(false !== $model->create()){
    			
    			if($_POST['son_id'] != 0) $model->channel_id = $_POST['son_id'];

    			$model->end_time = strtotime($_POST['end_time']);
    			$model->start_time = strtotime($_POST['start_time']);
    			$model->update_time = time();
    			$model->end_citys = $_POST['end_city'];
    			
    			if($_POST['_end_'] == 'yes'){
    				$end = M('activity_address')->add(array(
    						'province'  =>  $_POST['end_province'],
    						'county'  =>  $_POST['county'],
    						'city'  =>  $_POST['end_city'],
    						'province'  =>  $_POST['end_address'],
    				));
    			}
    			 
    			$model->end_address = serialize($_end[] = $end);
    			
    			$edit = $model->where(array('id'=>$id))->save();		
    			
    			M('qisclaimer')->where(array('id'=>$_POST['qis_id']))->save();
    			
    			if($edit){
    				
    				M('activity_tags')->where(array('act_id'=>$id))->delete();
    				foreach ($_POST['checkbox'] as $t => $g){
    					if($g == 'on')
    					M('activity_tags')->add(array(
    							'act_id'   => $id,
    					        'tag_id'   => $t,
    					));
    				}
    				
    				if(!empty($_POST['postion']))
    					$xy = explode(',',$_POST['postion']);
    					!empty($xy[0]) ? $x = $xy[0] : $x = 0;
    					!empty($xy[1]) ? $y = $xy[1] : $y = 0;
    					 
    					M('activitys')->where(array('act_id'=>$id))->save(array(
    							'longitude' => $x,
    							'latitude' => $y,
    					));
    					
    					
    					//活动详情  carry 2016-12-26  update  编辑时可以上传图片
    					
    					$actCount = count($_FILES)-1;
    					for ($index = 0 ; $index < $actCount; $index++){
    						//foreach ($_POST['cont'] as $index => $item){
    						//if(!empty($_POST['cont'][$index])){
    						$imagesUrl = '';
    						if (!empty($_FILES['file'.($index+1)]['name'])) {
    							//有文件上传
    							$imagesUrl = $this->create_images_path(10000001,$_FILES['file'.($index+1)]);
    						}else{
    							if ($_POST['act_Des_images'.($index+1)]) {
    								$imagesUrl = $_POST['act_Des_images'.($index+1)];
    							}
    					
    						}
    						if ('editToAdd' == $_POST['act_Des_ID'.($index+1)]) {
    							//新增标卡
    							$cartid = M('activity_description')->add(array(
    									'act_id'     => $id,
    									'shoot_id'   => $_POST['shoot_id'][$index] ? $_POST['shoot_id'][$index] : 0,
    									'images'     => $imagesUrl,
    									'content'    => $_POST['cont'][$index],
    							));
    						} else {
    							//修改标卡
    							M('activity_description')->save(array(
    							'id'         => $_POST['act_Des_ID'.($index+1)],
    							'act_id'     => $id,
    							'shoot_id'   => $_POST['shoot_id'][$index] ? $_POST['shoot_id'][$index] : 0,
    							'images'     => $imagesUrl,
    							'content'    => $_POST['cont'][$index],
    							));
    							 
    						}
    						//}
    					}
    				if(!empty($_POST['img'])){
    					M('images')->where(array('content_id' => $id,'media_type'=>0))->delete();
    					$arr = explode('|',$_POST['img']);
    					foreach ($arr as $key => $val){
    						if(empty($val)) continue;
    						$images = M('images')->add(
    								array(
    										'content_id'    =>  $id,
    										'module_id'     =>  2,
    										'status'        => 1,
    										'create_time'   => time(),
    										'media_type'    => 0,
    										'path'          => $val
    								)
    						 );
    					}
    				}
    				if(!empty($_POST['_img'])){
    					M('images')->where(array('content_id' => $id,'media_type'=>1))->delete();
    					$arr = explode('|',$_POST['_img']);
    					foreach ($arr as $key => $val){
    						if(empty($val)) continue;
    						$images = M('images')->add(
    								array(
    										'content_id'    =>  $id,
    										'module_id'     =>  2,
    										'status'        => 1,
    										'create_time'   => time(),
    										'media_type'    => 1,
    										'path'          => $val
    								)
    								);
    					}
    				}
    			}
    			
    			$this->success('编辑成功！', U('index'),'ajax_success');
    		} else {
    			$error = $model->getError();
    			$this->error(empty($error) ? '未知错误！' : $error);
    		}
    		return false;
    	}
    	
    	$model = M('Activity');
    	$info = $model->join(C('DB_PREFIX')."activitys ON ".C('DB_PREFIX')."activity.id = ".C('DB_PREFIX')."activitys.act_id","LEFT")->where(array('id'=>$id))->find();
    	$this->assign('img',M('images')->field('path')->where(array('content_id'=>$id,'media_type' => '1'))->select());
    	$this->assign('_img',M('images')->field('path')->where(array('content_id'=>$id,'media_type' => '0'))->select());
    	$this->assign('tags',$this->tags());
    	$this->assign('_tag',$this->_tag($id));
    	$this->assign('info',$info);
    	$this->assign('qisclaimer',$this->qisclaimer(0));
    	$this->assign('location',$this->location());
    	$this->assign('category',$this->category());
    	$this->assign('cart',M('activity_description')->where(array('act_id'=>$id))->select());
    	
    	$this->assign('shoot',$this->shoot());
    	$this->assign('son',$this->son_category());

    	$this->display();
    }
    
    public function location(){
    	return M('recommended_location')->select();
    }
    
    public function shoot(){
    	return M('shoot_point')->field('id,title')->where(array('status'=>1))->select();
    }
    
    public function _tag($id){
    	foreach (M('activity_tags')->field('tag_id')->where(array('act_id'=>$id))->select() as $item){
    		$_tag[] = $item['tag_id'];
    	}
    	return $_tag;
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
    			M('Activity')->where(array('id'=>$val))->delete();
    			M('user_activity')->where(array('act_id'=>$val))->delete();
    			M('user_favorite')->where(array('mid'=>$val,'module_type'=>2))->delete();
    			M('activity_description')->where(array('act_id'=>$val))->delete();
    		}
    		$this->success('删除活动成功！');
    		return false;
    	}
    	$this->delete('Activity',array('id'=>$id));
    	 
    }
    
    public function start($id){
    	M('Activity')->where(array('id'=>$id))->save(array('status'=>1,'update_time'=>time()));
    	$this->success('操作成功！');
    }
    
}