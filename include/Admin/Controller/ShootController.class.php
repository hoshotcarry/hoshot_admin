<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AuthRuleModel;
use Admin\Model\AuthGroupModel;
use User\Api\AdminApi;

class ShootController extends ConmmonController {
   
    public function edit($id){
    	if(empty($id)){
    		$this->error('参数错误');
    	}
    	$model = D('shoot_point');
    	$address = $_POST['postion'];
    	$dn = explode(',',$address);
    	if(IS_POST){
    		if(false !== $model->create()){
    			$model->longitude = $dn[0] ? $dn[0] : 0;
    			$model->latitude = $dn[1] ? $dn[1] : 0;
    			$edit = $model->where(array('id'=>$id))->save();
     			    				
    				M('images')->where(array('module_id'=>3,'content_id'=>$id))->delete();
    				
    				if(!empty($_POST['images'])){
    					$arr = explode('|',$_POST['images']);
    					foreach ($arr as $key => $val){
    						if(empty($val)) continue;
    						$images = M('images')->add(
    								array(
    										'content_id'    => $id,
    										'module_id'     => 3,
    										'status'        => 1,
    										'create_time'   => time(),
    										'media_type'    => 0,
    										'path'          => $val
    								)
    						);
    					}
    				}
    			
    			//}
    			
    			$this->success('编辑成功！', U('index'),'ajax_success');
    		} else {
    			$error = $model->getError();
    			$this->error(empty($error) ? '未知错误！' : $error);
    		}  		
    		return false;
    	}

    	$info = M('shoot_point')->where(array('id'=>$id))->find();
    	$this->assign('info',$info);
    	$this->assign('tags',$this->tags());
    	$this->assign('category',$this->category());
    	
    	$this->assign('images',M('images')->where(array('module_id'=>3,'content_id'=>$id,'status'=> 1))->select());
    	$this->display();
    }
    
    public function tags(){
    	return M('tags')->where(array('moduleType'=>'3'))->select();
    }
    
    public function show($id){
    	$this->assign('images',M('images')->where(array('module_id'=>3,'content_id'=>$id,'status'=> 1))->select());
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
    			M('shoot_point')->where(array('id'=>$val))->save(array('status'=>-1));
    		}
    		$this->success('删除摄点成功！');
    		return false;
    	}
    	$this->delete('shoot_point',array('id'=>$id));
    	
    }
    
    public function start($id){
    	M('shoot_point')->where(array('id'=>$id))->save(array('status'=>1,'update_time'=>time()));
    	$this->success('操作成功！');
    }
    
    protected function forb( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
    	$data['status']         =   0;
    	$data['update_time']    =   NOW_TIME;
    	$this->editRow(   $model , $data, $where, $msg);
    }
    
    public function enb($id){
    	$this->forb('shoot_point',array('id'=>$id));
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
 
    
    public function index(){
    	
    	$model = M("shoot_point");
    	
    	$map = array();
    	$map['status'] = array('neq','-1');
    	
    	if(IS_GET){
   
    		if(!empty($_GET['start_time']))  $map['create_time'] = array('egt',strtotime($_GET['start_time']));
    		if(!empty($_GET['end_time']))  $map['create_time'] = array('elt',strtotime($_GET['end_time']));
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
    	
    	$total        =   $model->where($map)->count();
    	
    	if( isset($REQUEST['r']) ){
    		$listRows = (int)$REQUEST['r'];
    	}else{
    		$listRows = 15;
    	}
    	
    	$page = new \Think\Page($total, $listRows, $REQUEST);
    	
    	$arr = $model
    	->join(C('DB_PREFIX')."recommended_location ON ".C('DB_PREFIX')."recommended_location.id = ".C('DB_PREFIX')."shoot_point.rec_id","LEFT")->field(
    			array(
    					C('DB_PREFIX').'recommended_location.name',
    					C('DB_PREFIX').'shoot_point.*',
    			)
    			)
    	->where($map)->limit($page->firstRow . ',' . $page->listRows)->order('`create_time` DESC')->select();
    	$p = $page->show();

    	$this->assign('arr',$arr);
    	$this->assign('total',$total);
    	$this->assign('page', $p? $p: '');
    	$this->assign('category',$this->category());
    	$this->display();
    }
    
    public function category(){
    	return M('category')->where(array('model'=>3,'pid'=>0,'status'=>1))->select();
    }
    
    public function add(){
    	
    	$model = D('shoot_point');
    	$this->assign('tags',$this->tags());
    	$this->assign('category',$this->category());
    	$address = $_POST['postion'];
    	$dn = explode(',',$address);
    	if(IS_POST){
    		if(empty($_POST['title'])) $this->error('主题不能为空');
    	    if(false !== $model->create()){
    	    	$model->update_time = time();
    	    	$model->create_time = time();
    	    	$model->longitude = $dn[0] ? $dn[0] : 0;
    	    	$model->latitude = $dn[1] ? $dn[1] : 0;
    	    	$model->status = 1;
    	    	$model->count_comment = 0;
    	    	$model->count_sc = 0;
    	    	$model->count_browse = 1;
    	    	$model->user_id = 10000001;
    	    	$add = $model->add();
    	    	if($add){
    	    		
    	    			if(!empty($_POST['images'])){
    	    				$arr = explode('|',$_POST['images']);
    	    				foreach ($arr as $key => $val){
    	    					if(empty($val)) continue;
    	    					$images = M('images')->add(
    	    							array(
    	    									'content_id'    => $add,
    	    									'module_id'     => 3,
    	    									'status'        => 1,
    	    									'create_time'   => time(),
    	    									'media_type'    => 0,
    	    									'path'          => $val
    	    							)
    	    					);
    	    				}
    	    			}
  
    	    	}
                $this->success('新增成功！', U('index'),'ajax_success');
            } else {
                $error = $model->getError();
                $this->error(empty($error) ? '未知错误！' : $error);
            }
    	}else{
    		$this->display();
    	}
    		
    }

  
    /**
     * 通用分页列表数据集获取方法
     *
     *  可以通过url参数传递where条件,例如:  index.html?name=asdfasdfasdfddds
     *  可以通过url空值排序字段和方式,例如: index.html?_field=id&_order=asc
     *  可以通过url参数r指定每页数据条数,例如: index.html?r=5
     *
     * @param sting|Model  $model   模型名或模型实例
     * @param array        $where   where查询条件(优先级: $where>$_REQUEST>模型设定)
     * @param array|string $order   排序条件,传入null时使用sql默认排序或模型属性(优先级最高);
     *                              请求参数中如果指定了_order和_field则据此排序(优先级第二);
     *                              否则使用$order参数(如果$order参数,且模型也没有设定过order,则取主键降序);
     *
     * @param array        $base    基本的查询条件
     * @param boolean      $field   单表模型用不到该参数,要用在多表join时为field()方法指定参数
     *
     * @return array|false
     * 返回数据集
     */
    protected function lists ($model,$where=array(),$order='',$base = array('status'=>array('egt',0)),$field=true){
        $options    =   array();
        $REQUEST    =   (array)I('request.');
        if(is_string($model)){
            $model  =   M($model);
        }

        $OPT        =   new \ReflectionProperty($model,'options');
        $OPT->setAccessible(true);

        $pk         =   $model->getPk();
        if($order===null){
            //order置空
        }else if ( isset($REQUEST['_order']) && isset($REQUEST['_field']) && in_array(strtolower($REQUEST['_order']),array('desc','asc')) ) {
            $options['order'] = '`'.$REQUEST['_field'].'` '.$REQUEST['_order'];
        }elseif( $order==='' && empty($options['order']) && !empty($pk) ){
            $options['order'] = $pk.' desc';
        }elseif($order){
            $options['order'] = $order;
        }
        unset($REQUEST['_order'],$REQUEST['_field']);

        $options['where'] = array_filter(array_merge( (array)$base, /*$REQUEST,*/ (array)$where ),function($val){
            if($val===''||$val===null){
                return false;
            }else{
                return true;
            }
        });
        if( empty($options['where'])){
            unset($options['where']);
        }
        $options      =   array_merge( (array)$OPT->getValue($model), $options );
        $total        =   $model->where($options['where'])->count();

        if( isset($REQUEST['r']) ){
            $listRows = (int)$REQUEST['r'];
        }else{
            $listRows = C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
        }
        $page = new \Think\Page($total, $listRows, $REQUEST);
        if($total>$listRows){
            $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        }
        $p =$page->show();
        $this->assign('_page', $p? $p: '');
        $this->assign('_total',$total);
        $options['limit'] = $page->firstRow.','.$page->listRows;

        $model->setProperty('options',$options);

        return $model->field($field)->select();
    }

}
