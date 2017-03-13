<?php

namespace Admin\Controller;
use User\Api\UserApi;
use Think\Controller;
use Think\Exception;

/**
 * 后台用户控制器
 */
class UserController extends ConmmonController {

    /**
     * 用户管理首页
     */
    public function index(){
    	
        $model = M("User");
         
        $map = array();
        $map['status'] = array('neq','-1');
        
        !empty($_GET['type']) ? $map['user_type'] = array('neq','0') :  $map['user_type'] = '0';
         
        if(IS_GET){
        	 
        	if(!empty($_GET['start_time']))  $map['create_time'] = array('egt',strtotime($_GET['start_time']));
        	if(!empty($_GET['end_time']))    $map['create_time'] = array('elt',strtotime($_GET['end_time']));
        	if(!empty($_GET['start_time']) and !empty($_GET['end_time'])){
        		$map['create_time'] = array(array('egt',strtotime($_GET['start_time'])),array('elt',strtotime($_GET['end_time'])));
        	}
            
        	if(!empty($_GET['search'])){
        		$where['account']  = array('like', '%'.$_GET['search'].'%');
        		$where['phone']  = array('like','%'.$_GET['search'].'%');
        		$where['email']  = array('like','%'.$_GET['search'].'%');
        		$where['nickname']  = array('like','%'.$_GET['search'].'%');
        		$where['_logic'] = 'or';
        		$map['_complex'] = $where;
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
         
        $Users = $model
//         ->join(C('DB_PREFIX')."admin_role ON ".C('DB_PREFIX')."admin_role.id = ".C('DB_PREFIX')."admin.group_id","LEFT")->field(
//         		array(
//         				C('DB_PREFIX').'admin.*',
//         				C('DB_PREFIX').'admin_role.*',
//         				C('DB_PREFIX').'admin_role.name' => 'role_name',
//         				C('DB_PREFIX').'admin.id' => 'aid'
//         		)
//         		)
        ->where($map)->limit($page->firstRow . ',' . $page->listRows)->select();
        
        $p = $page->show();
        $this->assign('arr',$Users);
        $this->assign('total',$total);
        $this->assign('page', $p? $p: '');
        		      
        !empty($_GET['type']) ? $this->display('index_auth') : $this->display();        		
       
    }
    
    public function auth($id){M('user')->where(array('id'=>$id))->save(array('auth_status'=>2));}
    
    /**
     * 修改昵称初始化
     */
    public function updateNickname(){
        $nickname = M('Member')->getFieldByUid(UID, 'nickname');
        $this->assign('nickname', $nickname);
        $this->meta_title = '修改昵称';
        $this->display();
    }
    
    public function fz(){
    	return M('substation')->field('id,name')->select();
    }
    
    public function sh($uid){
    	if(IS_POST){
    		$save = M('user')->where(array('id'=>$uid))->save(array(
    				'sub_id' => $_POST['sub_id'],
    				'auth_status' => 2
    		));
    		$this->success('设置成功！',U('index'),'ajax_success');
    	}
    	$this->assign('fz',$this->fz());
    	$this->display();
    }

    /**
     * 修改昵称提交
     */
    public function submitNickname(){
        //获取参数
        $nickname = I('post.nickname');
        $password = I('post.password');
        empty($nickname) && $this->error('请输入昵称');
        empty($password) && $this->error('请输入密码');

        //密码验证
        $User   =   new UserApi();
        $uid    =   $User->login(UID, $password, 4);
        ($uid == -2) && $this->error('密码不正确');

        $Member =   D('Member');
        $data   =   $Member->create(array('nickname'=>$nickname));
        if(!$data){
            $this->error($Member->getError());
        }

        $res = $Member->where(array('uid'=>$uid))->save($data);

        if($res){
            $user               =   session('user_auth');
            $user['username']   =   $data['nickname'];
            session('user_auth', $user);
            session('user_auth_sign', data_auth_sign($user));
            $this->success('修改昵称成功！');
        }else{
            $this->error('修改昵称失败！');
        }
    }

    /**
     * 修改密码初始化
     */
    public function updatePassword(){
        $this->meta_title = '修改密码';
        $this->display();
    }

    /**
     * 修改密码提交
     */
    public function submitPassword(){
        //获取参数
        $password   =   I('post.old');
        empty($password) && $this->error('请输入原密码');
        $data['password'] = I('post.password');
        empty($data['password']) && $this->error('请输入新密码');
        $repassword = I('post.repassword');
        empty($repassword) && $this->error('请输入确认密码');

        if($data['password'] !== $repassword){
            $this->error('您输入的新密码与确认密码不一致');
        }

        $Api    =   new UserApi();
        $res    =   $Api->updateInfo(UID, $password, $data);
        if($res['status']){
            $this->success('修改密码成功！');
        }else{
            $this->error($res['info']);
        }
    }

    /**
     * 用户行为列表
     */
    public function action(){
        //获取列表数据
        $Action =   M('Action')->where(array('status'=>array('gt',-1)));
        $list   =   $this->lists($Action);
        int_to_string($list);
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);

        $this->assign('_list', $list);
        $this->meta_title = '用户行为';
        $this->display();
    }

    /**
     * 新增行为
     */
    public function addAction(){
        $this->meta_title = '新增行为';
        $this->assign('data',null);
        $this->display('editaction');
    }

    /**
     * 编辑行为
     */
    public function editAction(){
        $id = I('get.id');
        empty($id) && $this->error('参数不能为空！');
        $data = M('Action')->field(true)->find($id);

        $this->assign('data',$data);
        $this->meta_title = '编辑行为';
        $this->display();
    }

    /**
     * 更新行为
     */
    public function saveAction(){
        $res = D('Action')->update();
        if(!$res){
            $this->error(D('Action')->getError());
        }else{
            $this->success($res['id']?'更新成功！':'新增成功！', Cookie('__forward__'));
        }
    }
    
    public function start($id){
    	M('User')->where(array('id'=>$id))->save(array('status'=>1,'update_time'=>time()));
    	$this->success('操作成功！');
    }

    /**
     * 会员状态修改
     */
    public function changeStatus($method=null){
        $id = array_unique((array)I('id',0));
        if( in_array(C('USER_ADMINISTRATOR'), $id)){
            $this->error("不允许对超级管理员执行该操作!");
        }
        $id = is_array($id) ? implode(',',$id) : $id;
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map['uid'] =   array('in',$id);
        switch ( strtolower($method) ){
            case 'forbiduser':
                $this->forbid('Member', $map );
                break;
            case 'resumeuser':
                $this->resume('Member', $map );
                break;
            case 'deleteuser':
                $this->delete('Member', $map );
                break;
            default:
                $this->error('参数非法');
        }
    }

    public function add(){
    	
            if(IS_POST){ //注册成功              
                $uid = D('user')->update();
                $comm = array('uid' => $uid, 'province' => I('post.province'), 'city' => I('post.city'),'county'=>I('post.county'),'address'=>I('post.address'));
                $more = array('uid' => $uid,'sex'=>I('post.sex'),'personality_sign'=>I('post.personality_sign'),'birthday'=>I('post.birthday'),'job' => $_POST['job']);
                M('user_token')->add(array(
                		'user_id' => $uid,
                		'token'   => md5('1'),
                		'create_time' => time()
                ));
                if(!$uid){   
                	$this->error('用户添加失败！');
                } else {
                	
                	!empty($_GET['id']) ? $type = 1 : $type = 0;
                	
                	$this->communication($comm,$type);
                	$this->more($more,$type);
                	$this->property($uid);
                	
                	
                	if(!empty($_POST['sf_file'])) $this->add_file($_POST['sf_file'], 1,$uid);
                	if(!empty($_POST['zz_file'])) $this->add_file($_POST['zz_file'], 2,$uid);
                	
                    $this->success('用户添加成功！',U('index'),'ajax_success');
                }
            } else {
                $this->meta_title = '新增用户';
                $this->display();
            }
    }

    //用户通信
    protected function communication($data,$type){
    	if($type == 1) return M('user_communication')->save($data);
    	return M('user_communication')->data($data)->add();

    }
    
    //更多用户资料
    protected function more($data,$type){
    	if($type == 1) return M('user_more')->save($data);
        return M('user_more')->data($data)->add();
    }
    
    //用户财务
    protected function property($uid){
    	return  M('user_property')->add(array(
    			'uid' => $uid
    	));
    	 //echo M('user_property')->getLastSql();
    }
    
    /**
     * 获取用户注册错误信息
     * @param  integer $code 错误编码
     * @return string        错误信息
     */
    private function showRegError($code = 0){
        switch ($code) {
            case -1:  $error = '用户名长度必须在16个字符以内！'; break;
            case -2:  $error = '用户名被禁止注册！'; break;
            case -3:  $error = '用户名被占用！'; break;
            case -4:  $error = '密码长度必须在6-30个字符之间！'; break;
            case -5:  $error = '邮箱格式不正确！'; break;
            case -6:  $error = '邮箱长度必须在1-32个字符之间！'; break;
            case -7:  $error = '邮箱被禁止注册！'; break;
            case -8:  $error = '邮箱被占用！'; break;
            case -9:  $error = '手机格式不正确！'; break;
            case -10: $error = '手机被禁止注册！'; break;
            case -11: $error = '手机号被占用！'; break;
            default:  $error = '未知错误';
        }
        return $error;
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
    			M('User')->where(array('id'=>$val))->save(array('status'=>-1));
    		}
    		$this->success('删除角色成功！');
    		return false;
    	}
    	$this->delete('User',array('id'=>$id));
    	 
    }
    
    protected function forb( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
    	$data['status']         =   0;
    	$data['update_time']    =   NOW_TIME;
    	$this->editRow(   $model , $data, $where, $msg);
    }
    
    public function enb($id){
    	$this->forb('User',array('id'=>$id));
    }
    
//     public function sh($id){
//     	M('user')->where(array('id'=>$id))->save(array(
//     			'auth_status' => 1
//     	));
//     	$this->success('审核成功！', U('index'),'ajax_success');
//     }
    
    public function edit($id){
    	if(empty($id)){
    		$this->error('参数错误');
    	}
    	$model = D('User');
    	if(IS_POST){
    		if(false !== $model->update()){
    			M('user_communication')->where(array('uid'=>$id))->save(array(
    					'province' => $_POST['province'],
    					'city' => $_POST['city'],
    					'county' => $_POST['county'],
    					'address' => $_POST['address'],
    			));
    			M('user_more')->where(array('uid'=>$id))->save(array(
    					'sex' => $_POST['sex'],
    					'personality_sign' => $_POST['personality_sign'],
    					'birthday' => $_POST['birthday'],
    					'job'      => $_POST['job']
    			));
    			$this->success('编辑成功！', U('index'),'ajax_success');
    		} else {
    			$error = $model->getError();
    			$this->error(empty($error) ? '未知错误！' : $error);
    		}
    		return false;
    	}
    	 
    	$info = M('User')->join(C('DB_PREFIX')."user_more ON ".C('DB_PREFIX')."user_more.uid = ".C('DB_PREFIX')."user.id","LEFT")
    	        ->join(C('DB_PREFIX')."user_communication ON ".C('DB_PREFIX')."user_communication.uid = ".C('DB_PREFIX')."user.id","LEFT")
    	        ->field(
        		array(
        				C('DB_PREFIX').'user.*',
        				C('DB_PREFIX').'user_more.*',
        				C('DB_PREFIX').'user_communication.*',
        		)
        		)
        ->where(array('id'=>$id))->find();

    	$this->assign('info',$info);
    	$this->display();
    }
    
    public function auth_edit($id){
    	if(empty($id)){
    		$this->error('参数错误');
    	}
    	$model = D('User');
    	if(IS_POST){
    		if(false !== $model->update()){
    			M('user_communication')->where(array('uid'=>$id))->save(array(
    					'province' => $_POST['province'],
    					'city' => $_POST['city'],
    					'county' => $_POST['county'],
    					'address' => $_POST['address'],
    			));
    			M('user_more')->where(array('uid'=>$id))->save(array(
    					'sex' => $_POST['sex'],
    					'personality_sign' => $_POST['personality_sign'],
    					'birthday' => $_POST['birthday'],
    					'job'      => $_POST['job']
    			));
    			$this->success('编辑成功！', U('index'),'ajax_success');
    		} else {
    			$error = $model->getError();
    			$this->error(empty($error) ? '未知错误！' : $error);
    		}
    		
    		
    		if(!empty($_POST['sf_file'])) $this->add_file($_POST['sf_file'], 1,$id);
    		if(!empty($_POST['zz_file'])) $this->add_file($_POST['zz_file'], 2,$id);
    		
    		return false;
    	}
    
    	$info = M('User')->join(C('DB_PREFIX')."user_more ON ".C('DB_PREFIX')."user_more.uid = ".C('DB_PREFIX')."user.id","LEFT")
    	->join(C('DB_PREFIX')."user_communication ON ".C('DB_PREFIX')."user_communication.uid = ".C('DB_PREFIX')."user.id","LEFT")
    	->field(
    			array(
    					C('DB_PREFIX').'user.*',
    					C('DB_PREFIX').'user_more.*',
    					C('DB_PREFIX').'user_communication.*',
    			)
    			)
    	->where(array('id'=>$id))->find();
    
    	$au = M('user_auth_material')->where(array('user_id'=>$id))->select();

    	$this->assign('au',$au);
    	$this->assign('info',$info);
    	$this->display();
    }
    
    protected function add_file($files,$type,$uid){
    	$model = M('user_auth_material');
    	$files = explode('|',$files);
    	
    	M('user_auth_material')->where(array('user_id'=>$uid,'material_type'=>$type))->delete();
    	
    	foreach ($files as $item){
    		if(empty($item)) break;
    		$data = array(
    				'user_id' => $uid,
    				'create_time' => time(),
    				'material_type' => $type,
    				'path'  =>  $item
    		);
    		$model->add($data);
    	}
    }
    
    
}
