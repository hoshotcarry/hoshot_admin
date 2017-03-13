<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AuthRuleModel;
use Admin\Model\AuthGroupModel;
use User\Api\AdminApi;

class AdminController extends ConmmonController {
   
    public function edit($id){
    	if(empty($id)){
    		$this->error('参数错误');
    	}
    	$model = D('admin');
    	if(IS_POST){
    		if(false !== $model->update()){
    			if(M('auth_group_access')->where(array('uid'=>$id))->find()){
    				M('auth_group_access')->where(array('uid'=>$id))->save(array('group_id'=>$_POST['group_id']));
    			}else{
    				M('auth_group_access')->add(array('group_id'=>$_POST['group_id'],'uid'=>$id));
    			}
    			
    			$this->success('编辑成功！', U('index'),'ajax_success');
    		} else {
    			$error = $model->getError();
    			$this->error(empty($error) ? '未知错误！' : $error);
    		}  		
    		return false;
    	}
    	
    	$info = M('admin')->where(array('id'=>$id))->find();
    	$this->assign('role',M("auth_group")->select());
    	$this->assign('info',$info);
    	$this->display();
    }
    
    public function info($id){
    	$model = M('admin');
    	$info = $model->where(array('id'=>$id))->find();
    	$info['role'] = M('auth_group')->where(array('id'=>$info['group_id']))->find();
    	if($info['group_id'] == 0) $info['role']['title'] = '超级管理员';
    	$this->assign('info',$info);
    	$this->display();
    }
    
    /**
     * 禁用条目
     * @param string $model 模型名称,供D函数使用的参数
     * @param array  $where 查询时的 where()方法的参数
     * @param array  $msg   执行正确和错误的消息,可以设置四个元素 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     */
    protected function forbid ( $model , $where = array() , $msg = array( 'success'=>'状态禁用成功！', 'error'=>'状态禁用失败！')){
        $data    =  array('status' => 0);
        $this->editRow( $model , $data, $where, $msg);
    }

    /**
     * 恢复条目
     * @param string $model 模型名称,供D函数使用的参数
     * @param array  $where 查询时的where()方法的参数
     * @param array  $msg   执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     */
    protected function resume (  $model , $where = array() , $msg = array( 'success'=>'状态恢复成功！', 'error'=>'状态恢复失败！')){
        $data    =  array('status' => 1);
        $this->editRow(   $model , $data, $where, $msg);
    }

    /**
     * 还原条目
     * @param string $model 模型名称,供D函数使用的参数
     * @param array  $where 查询时的where()方法的参数
     * @param array  $msg   执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     */
    protected function restore (  $model , $where = array() , $msg = array( 'success'=>'状态还原成功！', 'error'=>'状态还原失败！')){
        $data    = array('status' => 1);
        $where   = array_merge(array('status' => -1),$where);
        $this->editRow(   $model , $data, $where, $msg);
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
    
    public function start($id){
    	M('admin')->where(array('id'=>$id))->save(array('status'=>1,'update_time'=>time()));
    	$this->success('操作成功！');
    }
    
    public function del($id){
    	
    	if(IS_POST and !empty($_POST['id'])){
    		$id = json_decode($_POST['id']);
    		foreach ($id as $val){
    			M('admin')->where(array('id'=>$val))->save(array('status'=>-1));
    		}
    		$this->success('删除角色成功！');
    		return false;
    	}
    	$this->delete('admin',array('id'=>$id));
    	
    }
    
    protected function forb( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
    	$data['status']         =   0;
    	$data['update_time']    =   NOW_TIME;
    	$this->editRow(   $model , $data, $where, $msg);
    }
    
    public function enb($id){
    	$this->forb('admin',array('id'=>$id));
    }
    
    /**
     * 修改密码提交
     */
    public function submitPassword(){
    	//获取参数
    	$password   =   I('post.password');
    	//empty($password) && $this->error('请输入原密码');
    	$data['password'] = I('post.password');
    	empty($data['password']) && $this->error('请输入新密码');
    	$repassword = I('post.repassword');
    	empty($repassword) && $this->error('请输入确认密码');
    
    	if($data['password'] !== $repassword){
    		$this->error('您输入的新密码与确认密码不一致');
    	}
    
    	$Api    =   new AdminApi();
    	$res    =   $Api->updateInfo($_GET['id'], $password, $data);
    	if($res['status']){
    		$this->success('修改密码成功！','','ajax_success');
    	}else{
    		$this->error($res['info']);
    	}
    }
    
    
    
    public function index(){
    	
    	$model = M("admin");
    	
    	$map = array();
    	$map[C('DB_PREFIX').'admin.status'] = array('neq','-1');
    	
    	if(IS_GET){
   
    		if(!empty($_GET['start_time']))  $map['create_time'] = array('egt',strtotime($_GET['start_time']));
    		if(!empty($_GET['end_time']))  $map['create_time'] = array('elt',strtotime($_GET['end_time']));
    		if(!empty($_GET['start_time']) and !empty($_GET['end_time'])){
    			$map['create_time'] = array(array('gt',strtotime($_GET['start_time'])),array('lt',strtotime($_GET['end_time'])));
    		}
    		
    		$where['account']  = array('like', '%'.$_GET['search'].'%');
    		$where['phone']  = array('like','%'.$_GET['search'].'%');
    		$where['email']  = array('like','%'.$_GET['search'].'%');
    		$where['_logic'] = 'or';
    		$map['_complex'] = $where;
    		
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
    	
    	$adminUsers = $model->join(C('DB_PREFIX')."auth_group ON ".C('DB_PREFIX')."auth_group.id = ".C('DB_PREFIX')."admin.group_id","LEFT")->field(
				array(
						C('DB_PREFIX').'admin.*',
						C('DB_PREFIX').'auth_group.*',
						C('DB_PREFIX').'admin.status' => '_status',
						C('DB_PREFIX').'admin.id' => 'aid'
				)
		)->where($map)->limit($page->firstRow . ',' . $page->listRows)->select();

    	$p = $page->show();
    	
    	$this->assign('arr',$adminUsers);
    	$this->assign('total',$total);
    	$this->assign('page', $p? $p: '');
    	
    	$this->display();
    }
    
    public function add(){
    	
    	$this->assign('role',M("auth_group")->select());
    	$model = D('admin');
    	if(IS_POST){
    		$id = $model->update();
    	    if(false !== $id){
    	    	M('auth_group_access')->where(array('uid'=>$id))->save(array('group_id'=>$_POST['group_id']));
                $this->success('新增成功！', U('index'),'ajax_success');
            } else {
                $error = $model->getError();
               $this->error(empty($error) ? '未知错误！' : $error);
            }
    	}else{
    		$this->display();
    	}
    		
    }

   
    
    public function log(){
    	 
    	$model = M("admin_log");
    	 
    	$map = array();
    	//$map['status'] = array('neq','-1');
    	 
    	if(IS_GET){
    		 
    		if(!empty($_GET['start_time']))  $map[C('DB_PREFIX').'admin_log.create_time'] = array('gt',strtotime($_GET['start_time']));
    		if(!empty($_GET['end_time']))  $map[C('DB_PREFIX').'admin_log.create_time'] = array('lt',strtotime($_GET['end_time']));
    		if(!empty($_GET['start_time']) and !empty($_GET['end_time'])){
    			$map[C('DB_PREFIX').'admin_log.create_time'] = array(array('gt',strtotime($_GET['start_time'])),array('lt',strtotime($_GET['end_time'])));
    		}
    
//     		$where['account']  = array('like', '%'.$_GET['search'].'%');
//     		$where['phone']  = array('like','%'.$_GET['search'].'%');
//     		$where['email']  = array('like','%'.$_GET['search'].'%');
//     		$where['_logic'] = 'or';
//     		$map['_complex'] = $where;
    
    		$this->assign('start_time',$_GET['start_time']);
    		$this->assign('end_time',$_GET['end_time']);
    		//$this->assign('search',$_GET['search']);
    
    	}
    	 
    	$total        =   $model->where($map)->count();
    
    	if( isset($REQUEST['r']) ){
    		$listRows = (int)$REQUEST['r'];
    	}else{
    		$listRows = 15;
    	}
    	 
    	$page = new \Think\Page($total, $listRows, $REQUEST);
    	 
    	$adminUsers = $model->join(C('DB_PREFIX')."action ON ".C('DB_PREFIX')."action.id = ".C('DB_PREFIX')."admin_log.action","LEFT")->join(C('DB_PREFIX')."admin ON ".C('DB_PREFIX')."admin.id = ".C('DB_PREFIX')."admin_log.user_id","LEFT")->field(
    			array(
    					C('DB_PREFIX').'action.*',
    					C('DB_PREFIX').'admin_log.*',
    					C('DB_PREFIX').'admin.account',
//     					C('DB_PREFIX').'admin_role.name' => 'role_name',
    					C('DB_PREFIX').'admin_log.id' => 'gid'
    			)
    			)->where($map)->limit($page->firstRow . ',' . $page->listRows)->select();
//     			echo $model->getLastSQL();
    			$p = $page->show();
    			 
    			$this->assign('arr',$adminUsers);
    			$this->assign('total',$total);
    			$this->assign('page', $p? $p: '');
    			 
    			$this->display();
    }

}
