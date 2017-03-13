<?php
namespace Admin\Controller;
use Think\Controller;

class WorksController extends ConmmonController {
	
    public function index(){
        
        $model = M("works");
         
        $map = array();
        $map['status'] = array('neq','-1');
//         $map['works_type'] = $_GET['type'];

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
         
        $total        =   $model->where($map)->count();

        if( isset($_REQUEST['r']) ){
        	$listRows = (int)$_REQUEST['r'];
        }else{
        	$listRows = 15;
        }
         
        $page = new \Think\Page($total, $listRows, $_REQUEST);
         
        $Works = $model
//         ->join(C('DB_PREFIX')."admin_role ON ".C('DB_PREFIX')."admin_role.id = ".C('DB_PREFIX')."admin.group_id","LEFT")->field(
//         		array(
//         				C('DB_PREFIX').'admin.*',
//         				C('DB_PREFIX').'admin_role.*',
//         				C('DB_PREFIX').'admin_role.name' => 'role_name',
//         				C('DB_PREFIX').'admin.id' => 'aid'
//         		)
//         		)
        ->where($map)->order('`create_time` DESC')->limit($page->firstRow . ',' . $page->listRows)->select();
        $p = $page->show();
        $this->assign('arr',$Works);      
        $this->assign('total',$total);
        $this->assign('page', $p? $p: '');
        $this->display();
       // !empty($_GET['type']) ? $this->display('index_auth') : $this->display();
       
    }
    
    public function category(){
    	return M('category')->where(array('model'=>2,'pid'=>0,'status'=>1))->select();
    }
    
    public function show($id){
    	$this->assign('images',M('images')->where(array('module_id'=>4,'content_id'=>$id))->select());
    	$this->display();
    }
    
    public function tags(){
    	return M('tags')->where(array('moduleType'=>4))->select();
    }
    
    public function activitys(){
    	$title = $_POST['title'];
    	$map['title']  = array('like', '%'.$title.'%');
    	$arr = M('activity')->field('id,title')->where($map)->select();
    	echo json_encode($arr);
    }
    
    public function add(){
    	
    	if(IS_POST){
    		$model = D('works');
    		if($model->create()){
    			$model->update_time = time();
    			$model->create_time = time();
    			$model->status = 1;
    			$model->user_id = 10000001;
    			$model->count_share = 0;
    			$model->count_comment = 0;
    			$model->count_browse = 1;
    			$model->count_praise = 0;
    			$model->works_type = !empty($_POST['act_id']) ? 1 : 0;
    			
    			if($_POST['copyright'] == 'on') $model->copyright = 1; else $model->copyright = 0;
    			foreach ($_POST['checkbox'] as $key => $val){
    				$tags[] = $key;
    			}
    			$model->tags = json_encode($tags);
    			
    			$id = $model->add();
//     			exit($model->getLastSql());
    			if(!empty($_POST['img'])){
    				$arr = explode('|',$_POST['img']);
    				foreach ($arr as $key => $val){
    					if(empty($val)) continue;
    					$images = M('images')->add(
    							array(
    									'content_id'    => $id,
    									'module_id'     => 4,
    									'status'        => 1,
    									'create_time'   => time(),
    									'media_type'    => 0,
    									'path'          => $val
    							)
    							);
    				}
    			}
    			$this->success('添加成功！', U('index'),'ajax_success');
    		}else{
    			$error = $model->getError();
    			$this->error(empty($error) ? '未知错误！' : $error);
    		}
    		return true;
    	}
    	$this->assign('shoot',$this->shoot());
    	$this->assign('tags',$this->tags());
    	$this->display();
    }
    
    public function edit($id){
    	if(empty($id)){
    		$this->error('参数错误');
    	}
    	$model = D('works');
    	if(IS_POST){
    		if(false !== $model->create()){
    			if($_POST['copyright'] == 'on') $model->copyright = 1; else $model->copyright = 0;
    			foreach ($_POST['checkbox'] as $key => $val){
    				$tags[] = $key;
    			}
    			$model->tags = json_encode($tags);
    			$model->where(array('id'=>$id))->save();
    			
    			if(!empty($_POST['img'])){
    				
    				M('images')->where(array('moduleType'=>4,'content_id'=>$id))->delete();
    				
    				$arr = explode('|',$_POST['img']);
    				foreach ($arr as $key => $val){
    					if(empty($val)) continue;
    					$images = M('images')->add(
    							array(
    									'content_id'    => $id,
    									'module_id'     => 4,
    									'status'        => 1,
    									'create_time'   => time(),
    									'media_type'    => 0,
    									'path'          => $val
    							)
    							);
    				}
    			}
    			
    			$this->success('编辑成功！', U('index'),'ajax_success');
    		} else {
    			$error = $model->getError();
    			$this->error(empty($error) ? '未知错误！' : $error);
    		}
    		return false;
    	}
    	 
    	$info = M('works')->where(array('id'=>$id))->find();
    	$act_title = M('activity')->field('title')->where(array('id'=>$info['act_id']))->find();

    	$this->assign('images',M('images')->where(array('module_id'=>4,'content_id'=>$id))->select());
    	$this->assign('shoot',$this->shoot());
    	$this->assign('act_title',$act_title['title']);
    	$this->assign('tags',$this->tags());
    	$this->assign('info',$info);
    	$this->display();
    }
    
    public function shoot(){
    	return M('shoot_point')->field('id,title')->where(array('status'=>1))->select();
    }
    
    public function del($id){
    
    	if(IS_POST and !empty($_POST['id'])){
    		$id = json_decode($_POST['id']);
    		foreach ($id as $val){
    			M('works')->where(array('id'=>$val))->save(array('status'=>-1));
    		}
    		$this->success('删除角色成功！');
    		return false;
    	}
    	$this->delete('works',array('id'=>$id));
    
    }
    
    protected function forb( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
    	$data['status']         =   0;
    	$data['update_time']    =   NOW_TIME;
    	$this->editRow(   $model , $data, $where, $msg);
    }
    
    public function enb($id){
    	$this->forb('works',array('id'=>$id));
    }
    
    public function start($id){
    	M('works')->where(array('id'=>$id))->save(array('status'=>1,'update_time'=>time()));
    	$this->success('操作成功！');
    }
    
    
    public function recommend($id){
    
    	if(IS_POST and !empty($_POST['id'])){
    		$id = json_decode($_POST['id']);
    		foreach ($id as $val){
    			M('works')->where(array('id'=>$val))->save(array('is_recommend'=>1));
    		}
    		$this->success('推荐成功！');
    		return false;
    	}
    
    }
    
    public function cancelRecommend($id){
    
    	if(IS_POST and !empty($_POST['id'])){
    		$id = json_decode($_POST['id']);
    		foreach ($id as $val){
    			M('works')->where(array('id'=>$val))->save(array('is_recommend'=>0));
    		}
    		$this->success('推荐取消成功！');
    		return false;
    	}
    
    }
    
}