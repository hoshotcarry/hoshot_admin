<?php

namespace Admin\Controller;

class FunctionController extends ConmmonController
{
	public $rootPath =  './Uploads/'; //保存根路径
	    
    public function index(){
        
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
    public function version(){
        $this->meta_title = '版本列表';
        
        $model = M("AppVersion");
        
        $total = $model->where('status=1')->count();         
        if( isset($REQUEST['r']) ){
        	$listRows = (int)$REQUEST['r'];
        }else{
        	$listRows = 15;
        }
        $page = new \Think\Page($total, $listRows, $REQUEST);
        
        $p = $page->show();
        $version = $model->where('status=1')->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('arr',$version);
        $this->assign('total',$total);
        $this->assign('page', $p? $p: '');
        $this->display();
    }
    /**
     * 编辑行为
     */
    public function versionEditAction(){
        $id = I('get.id');
        empty($id) && $this->error('参数不能为空！');
        $data = M('AppVersion')->field(true)->find($id);

        $this->assign('data',$data);
        $this->meta_title = '编辑行为';
        $this->display();
    }
    public function picAdd()
    {

            $img = $_POST['img'];

            if(empty($img))
            {
                    return false;
            }

            // 获取图片
            list($type, $data) = explode(',', $img);

            // 判断类型
            if(strstr($type,'image/jpeg')!=='')
            {
                    $ext = '.jpg';
            }elseif(strstr($type,'image/gif')!=='')
            {
                    $ext = '.gif';
            }elseif(strstr($type,'image/png')!=='')
            {
                    $ext = '.png';
            }
            $userinfo = session('mam_spo_uinfo');
            $uid = $userinfo['id'];
            $model = M('Sharepic');
            $r = $model->field('user_id')->where('user_id='.$uid.' and is_del=0')->find();	
            if(!empty($r)){
                    $ret = array('img'=>'','msg'=>'对不起！亲！您已经传过一张照片了！');
                    echo json_encode($ret);	
                    exit;
            }else{
            // 生成的文件名
            $photo = "/uploads/Picture/".time().  rand(0, 99999).$ext;
            // 生成文件
            file_put_contents('/mnt/alidata/www/api_hoshot/public'.$photo, base64_decode($data), true);
            // 返回
            header('content-type:application/json;charset=utf-8');
            $ret = array('img'=>$photo,'msg'=>'图片上传成功');
            echo json_encode($ret);		
            }
            exit;
    }
    /*
     * carry 2016-12-21  上传apk
    *
    *  */
    public function UpLoadApk($nowTime,$action){
    	
    	switch ($action) {
    		case 'version_edit':
	    		$dataParam = array('Y-m-d',$nowTime);
	    		break;
    		case 'version_add':
    			$dataParam = array('Y-m-d',$nowTime);
    			break;
    		default:
    			$dataParam ='Y-m-d';
    		break;
    	}
    	$config = array(
    			'rootPath'      =>     $this->rootPath,
    	);

    	$upload = new \Think\Upload($config);// 实例化上传类
    	$upload->maxSize   =     50000000 ;// 设置附件上传大小
    	//            $upload->exts      =     array('apk');// 设置附件上传类型
    	$upload->rootPath  =     '/'; // 设置附件上传根目录
    	$upload->subName   =    array('date', $dataParam); //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
    	$upload->savePath  =     'uploads/Download/'; // 设置附件上传（子）目录
    	$upload->replace   =    true; //存在同名是否覆盖
    	$upload->autoSub   =    true;
    	$upload->saveName  =    $nowTime;
    	 
    	$info   =   $upload->uploadOne($_FILES['file']);
    	if(!$info) {// 上传错误提示错误信息
    		$this->error("上传失败:".$upload->getError());
    	}
    	return $info;
    }
    /*
     * carry 2016-12-20  修改上传位置错误而app检测更新时无法更新问题,增加事务处理,及逆向逻辑判断
    *
    *  */
    public function version_add(){
    	
        if(IS_POST){
        	$info = '';
            $model = D('app_version');
            $versionRes = $model->where(array('app_version'=>$_POST['app_version'],'flatform'=>$_POST['flatform'],'status'=>1))->find();
            $nowTime = (string)time();
            if ($versionRes) {           
            	$error = $model->getError();
            	$this->error(empty($error) ? "此版本号(".$_POST['app_version'].")已存在，请做删除或修改处理！" : $error);
            }else{
            	$model->startTrans();//开启事务
				$info = $this->UpLoadApk($nowTime,"version_add");
            }
            if($info){
                $data = array(
                    'app_id'      =>  $_POST['app_id'],
                    'remark'      =>  $_POST['remark'],
                    'flatform'    =>  $_POST['flatform'],
                    'app_version' =>  $_POST['app_version'],
                    'status'      =>  $_POST['status'],
                    'online_time' =>  $nowTime,//strtotime($_POST['online_time']),
                    'logo'        =>  '',//!empty($_POST['logo']) ? $_POST['logo'] : '',
                    'file'        => $info['savepath'].$info['savename'],
                );

                //                dump(scandir('/mnt/alidata/www/hoshot_dev/public/Uploads/'.$info['savepath']));die;
                $liunxPath = $_SERVER['DOCUMENT_ROOT'].'/Uploads';
                //$liunxPath = '/mnt/alidata/www/hoshot_dev/public/Uploads';//$_SERVER['DOCUMENT_ROOT'];//
                $sourcePath = $liunxPath.'/'.$data['file'];
                $oldApk = $liunxPath.'/uploads/Download/hoshot.apk';
                
                if(false !== $model->update($data)){
               	 
                	$resD = chmod($liunxPath.$info['savepath'], 0777);
                	
                	if (file_exists($oldApk)) {
                		//旧的apk存在先删除 再copy              		
                		if (!unlink($oldApk)) {
                			$error = $model->getError();
                			$res = $model->rollback();                			
                  			$this->error(empty($error) ? 'unlink错误！' : $error);
                		}else{
                		
                			$resC = copy($sourcePath, $oldApk);
							if (!$resC) {
								$model->rollback();
								$error = $model->getError();               	
                  				$this->error(empty($error) ? 'copy错误！' : $error);
							}
                			$model->commit();
                			$this->success('发布成功！', U('index'),'ajax_success');
                		}
                	}else{
                		
                		$resC = copy($sourcePath, $oldApk);
                		$model->commit();
                		$this->success('发布成功！', U('index'),'ajax_success');               		
                	}
                	
                	
                } else {
                	$model->rollback();
                	//更新失败   如果有上传的服务器的文件  就删除
                	$error = $model->getError();
                	if (file_exists($sourcePath)) {
                		if (!unlink($sourcePath)) {
                			$this->error(empty($error) ? 'unlink错误！' : $error);;
                		}
                	}               	
                    $this->error(empty($error) ? 'update错误啦！' : $error);
                }
            }else{
            	$error = $model->getError();
            	$this->error(empty($error) ? '请添加上传文件!' : $error);
        	
            }
        } else {
            $this->meta_title = '发布新版本';
            $this->display();
        }
    }
    /*
     * carry 2016-12-20  增加事务处理,及逆向逻辑判断,增加编辑可以上传文件
    *
    *  */
    public function version_edit(){
    	
        if(IS_POST){

        	$filePath = $_POST['old_file'];
			$nowTime = $_POST['online_time'];
			if ($_FILES['file']['error'] === UPLOAD_ERR_OK ) {
				$info = $this->UpLoadApk($nowTime,"version_edit");
				$filePath = $info['savepath'].$info['savename'];
			}

            $model = D('app_version');
            $versionRes = false;
            if ($_POST['old_app_version'] != $_POST['app_version'] ) {
            	$versionRes = $model->where(array('app_version'=>$_POST['app_version'],'flatform'=>$_POST['flatform'],'status'=>1))->find();

            }
            if ($versionRes) {
            	$error = $model->getError();
            	$this->error(empty($error) ? "此版本号(".$_POST['app_version'].")已存在！" : $error);
            }else{
            	$model->startTrans();//开启事务
            }
            $data = array(
            		'id'           =>  $_POST['id'],
            		'app_id'       =>  $_POST['app_id'],
            		'remark'       =>  $_POST['remark'],
            		'flatform'     =>  $_POST['flatform'],
            		'app_version'  =>  $_POST['app_version'],
            		'status'       =>  $_POST['status'],
            		'online_time'  =>  $nowTime,//strtotime($_POST['online_time']),
            		//'logo'       =>  '',//!empty($_POST['logo']) ? $_POST['logo'] : '',
            		'file'         => $filePath,
            );
            //                dump(scandir('/mnt/alidata/www/hoshot_dev/public/Uploads/'.$info['savepath']));die;
            $liunxPath = $_SERVER['DOCUMENT_ROOT'].'/Uploads';
            //$liunxPath = '/mnt/alidata/www/hoshot_dev/public/Uploads';//$_SERVER['DOCUMENT_ROOT'];//
            $sourcePath = $liunxPath.'/'.$data['file'];
            
            if(false !== $model->update()){
            	if ($_FILES['file']['error'] === UPLOAD_ERR_OK ) {

	            	$oldApk = $liunxPath.'/uploads/Download/hoshot.apk';
	            	
	            	$resD = chmod($liunxPath.$info['savepath'], 0777);
	            	 
	            	if (file_exists($oldApk)) {
	            		//旧的apk存在先删除 再copy
	            		if (!unlink($oldApk)) {
	            			$error = $model->getError();
	            			$res = $model->rollback();
	            			$this->error(empty($error) ? 'unlink错误！' : $error);
	            		}else{
	            	
	            			$resC = copy($sourcePath, $oldApk);
	            			if (!$resC) {
	            				$model->rollback();
	            				$error = $model->getError();
	            				$this->error(empty($error) ? 'copy错误！' : $error);
	            			}
	            			$model->commit();
	            			$this->success('发布成功！', U('index'),'ajax_success');
	            		}
	            	}else{
	            	
	            		$resC = copy($sourcePath, $oldApk);
	            		$model->commit();
	            		$this->success('修改成功！', U('index'),'ajax_success');
	            	}
            	}else{
            		$model->commit();
            		$this->success('修改成功！', U('index'),'ajax_success');
            	}	
            } else {
            	$model->rollback();
                $error = $model->getError();
                if (file_exists($sourcePath)) {
                	if (!unlink($sourcePath)) {
                		$this->error(empty($error) ? 'unlink错误！' : $error);;
                	}
                }
                $this->error(empty($error) ? 'update错误！' : $error);
            }
        } else {
            $this->meta_title = '发布新版本';
            $id = I('get.id');
            empty($id) && $this->error('参数不能为空！');
            $data = D('app_version')->field(true)->find($id);
            $this->assign('data',$data);
            $this->display();
        }
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
    /* 
     *   carry 2016-12-21 删除服务器上的版本apk ,及直接删除数据库记录 而不是修改状态
     * 
     *  */
    public function version_del($id){
    	 
    	if(IS_POST and !empty($_POST['id'])){
    		$id = json_decode($_POST['id']);
    		
    		$liunxPath = $_SERVER['DOCUMENT_ROOT'].'/Uploads/';

    		
			$delErr = array();
    		foreach ($id as $val){
    			$model = M('app_version');
    			$versionRes = $model->where(array('id'=>$val,'status'=>1))->find();
    			$filePath   = $versionRes['file'];
    			if (file_exists($liunxPath.$filePath)) {
    			    if (!unlink($liunxPath.$filePath)) {
	    				$delErr[$val] = $val;
	    				$error = $model->getError();               	
	                    $this->error(empty($error) ? '错误啦！' : $error);
	    			}else{
	    				//删除数据库记录
	    				$res = $model->where(array('id'=>$val))->delete(); 
	    				
	    				//$res = $model->where(array('id'=>$val))->save(array('status'=>0));	
	    			}
    			}
		
    		}
    		$this->success('删除成功！');
    		return false;
    	}
    	$this->delete('app_version',array('id'=>$id));
    	 
    }
    
    public function tags(){
        $this->meta_title = '标签列表';
        
        $model = M("tags");
        
        $total = $model->count();         
        if( isset($REQUEST['r']) ){
        	$listRows = (int)$REQUEST['r'];
        }else{
        	$listRows = 15;
        }
        $page = new \Think\Page($total, $listRows, $REQUEST);
        
        $p = $page->show();
        $version = $model->where()->limit($page->firstRow . ',' . $page->listRows)->select();
        $model = M('modules')->select();
        $model_data = [];
        foreach ($model as $val)
        {
            $model_data[$val['id']] = $val['name'];
        }
        $this->assign('model_data',$model_data);
        $this->assign('arr',$version);
        $this->assign('total',$total);
        $this->assign('page', $p? $p: '');
        $this->display();
    }
    /**
     * 编辑行为
     */
    public function tagsAction(){
        $id = I('get.id');
        empty($id) && $this->error('参数不能为空！');
        $data = M('tags')->field(true)->find($id);

        $this->assign('data',$data);
        $this->meta_title = '编辑行为';
        $this->display();
    }
    
    public function tags_add(){
    	
        if(IS_POST){
            $model = D('tags');
            if(false !== $model->update()){
                $this->success('发布成功！', U('index'),'ajax_success');
            } else {
                $error = $model->getError();
                $this->error(empty($error) ? '错误啦！' : $error);
            }
        } else {
            $model = M('modules')->select();
            $this->assign('model',$model);
            $this->meta_title = '发布新版本';
            $this->display();
        }
    }
    
    public function tags_edit(){
    	
        if(IS_POST){
            $model = D('tags');
            if(false !== $model->update()){
                $this->success('修改成功！', U('index'),'ajax_success');
            } else {
                $error = $model->getError();
                $this->error(empty($error) ? '错误啦！' : $error);
            }
        } else {
            $this->tagsEditAction();
        }
    }
    
    /**
     * 编辑行为
     */
    public function tagsEditAction(){
        $id = I('get.id');
        empty($id) && $this->error('参数不能为空！');
        $data = D('tags')->field(true)->find($id);
        $model = M('modules')->select();
        $this->assign('model',$model);
        $this->assign('data',$data);
        $this->meta_title = '编辑行为';
        $this->display();
    }
    
    
    public function tags_del(){
    	 
    	if(IS_POST and !empty($_POST['id'])){
    		$id = json_decode($_POST['id']);
    		foreach ($id as $val){
    			D('tags')->where(array('id'=>$val))->delete();
    		}
    		$this->success('删除标签成功！');
    		return false;
    	}
        $this->error('删除标签失败！');
        return false;
    }
    
    public function comment(){
        $this->meta_title = '评论列表';
        
        $model = M("comment");
            
        if(!empty($_GET['search'])){
                $map[C('DB_PREFIX').'comment.content']  = array('like', '%'.$_GET['search'].'%');
//         		$where['phone']  = array('like','%'.$_GET['search'].'%');
//         		$where['email']  = array('like','%'.$_GET['search'].'%');
//         		$where['nickname']  = array('like','%'.$_GET['search'].'%');
//         		$where['_logic'] = 'or';
//         		$map['_complex'] = $where;
        }

        $this->assign('search',$_GET['search']);
        
        $total = $model->where($map)->count();         
        if( isset($REQUEST['r']) ){
        	$listRows = (int)$REQUEST['r'];
        }else{
        	$listRows = 15;
        }
        $page = new \Think\Page($total, $listRows, $REQUEST);
        
        $p = $page->show();
        $version = $model->where($map)->join(C('DB_PREFIX').'user ON '.C('DB_PREFIX').'user.id = '.C('DB_PREFIX').'comment.user_id','LEFT')
                ->field(array(
                        C('DB_PREFIX').'comment.id',
                        C('DB_PREFIX').'user.nickname',
                        C('DB_PREFIX').'user.user_type',
                        C('DB_PREFIX').'comment.title',
                        C('DB_PREFIX').'comment.module_type',
                        C('DB_PREFIX').'comment.content',
                        C('DB_PREFIX').'comment.create_time',
                        C('DB_PREFIX').'comment.status',
                    ))
                ->limit($page->firstRow . ',' . $page->listRows)->select();
//        var_dump($version);die;
        $this->assign('arr',$version);
        $this->assign('total',$total);
        $this->assign('user_type_arr',C('USER_TYPE_ARR'));
        $this->assign('module_type_arr',C('MODULE_TYPE_ARR'));
        $this->assign('page', $p? $p: '');
        $this->display();
    }
    public function comment_stop(){
        $model = M("comment");
        $id = I('id','get');
        if( !empty($id) )
        {
            $model->where(array('id'=>$id))->save(array('status'=>0));
            $this->success('修改成功');
        }else{
            $this->error('非法参数！');
        }    
    }
    public function comment_start(){
        $model = M("comment");
        $id = I('id','get');
        if( !empty($id) )
        {
            $model->where(array('id'=>$id))->save(array('status'=>1));
            $this->success('修改成功');
        }else{
            $this->error('非法参数！');
        }    
    }
    
    
    public function comment_del(){
    	 
    	if(IS_POST and !empty($_POST['id'])){
    		$id = json_decode($_POST['id']);
    		foreach ($id as $val){
    			D('comment')->where(array('id'=>$val))->delete();
    		}
    		$this->success('删除评论成功！');
    		return false;
    	}
        $this->error('删除评论失败！');
        return false;
    }
    
    //
    public function message(){
        $model = M('user_message');
        $this->meta_title = '私密消息列表';
        
        
        $total = $model->count();         
        if( isset($REQUEST['r']) ){
        	$listRows = (int)$REQUEST['r'];
        }else{
        	$listRows = 15;
        }
        $page = new \Think\Page($total, $listRows, $REQUEST);
        
        $p = $page->show();
        $version = $model->where()->limit($page->firstRow . ',' . $page->listRows)->select();
//        var_dump($version);die;
        $this->assign('arr',$version);
        $this->assign('total',$total);
        $this->assign('page', $p? $p: '');
        $this->display();
    }
    
    
    public function sys_message(){
        $model = M('message');
        $this->meta_title = '系统消息列表';
        
        
        $total = $model->count();         
        if( isset($REQUEST['r']) ){
        	$listRows = (int)$REQUEST['r'];
        }else{
        	$listRows = 15;
        }
        $page = new \Think\Page($total, $listRows, $REQUEST);
        
        $p = $page->show();
        $version = $model->where()->limit($page->firstRow . ',' . $page->listRows)->select();
//        var_dump($version);die;
        $this->assign('arr',$version);
        $this->assign('total',$total);
        $this->assign('page', $p? $p: '');
        $this->display();
    }
    
    public function saveSysMessage(){
        
        if(IS_POST){
        $model = D('message');
//    var_dump($model);die;
        $data['title']  = !empty($_POST['title']) ? $_POST['title'] : '';
        $data['content']  = !empty($_POST['content']) ? $_POST['content'] : '';
        $data['create_time'] = time();
        $data['status'] = 1;
            if(false !== $model->update($data)){
                $this->success('添加成功！', U('index'),'ajax_success');
            } else {
                $error = $model->getError();
                $this->error(empty($error) ? '错误啦！' : $error);
            }
        } else {
            $this->meta_title = '新增系统消息';
            $this->display();
        }
    }
    public function sys_message_start(){
        $model = M("message");
        $id = I('id','get');
        if( !empty($id) )
        {
            $model->where(array('id'=>$id))->save(array('status'=>1));
            $this->success('修改成功');
        }else{
            $this->error('非法参数！');
        }    
    }
    public function sys_message_stop(){
        $model = M("message");
        $id = I('id','get');
        if( !empty($id) )
        {
            $model->where(array('id'=>$id))->save(array('status'=>0));
            $this->success('修改成功');
        }else{
            $this->error('非法参数！');
        }    
    }
    
    
    public function sys_message_edit(){
    	
        if(IS_POST){
            $model = D('message');
            if(false !== $model->update()){
                $this->success('修改成功！', U('index'),'ajax_success');
            } else {
                $error = $model->getError();
                $this->error(empty($error) ? '错误啦！' : $error);
            }
        } else {
            $id = I('get.id');
            empty($id) && $this->error('参数不能为空！');
            $data = M('message')->field(true)->find($id);

            $this->assign('data',$data);
            $this->meta_title = '编辑行为';
            $this->display();
        }
    }
    
    public function sys_message_del($id){
    	 
    	if(IS_POST and !empty($_POST['id'])){
    		$id = json_decode($_POST['id']);
    		foreach ($id as $val){
    			M('message')->where(array('id'=>$val))->delete();
    		}
    		$this->success('删除成功！');
    		return false;
    	}
    	$this->delete('app_version',array('id'=>$id));
    	 
    }
    
    public function overseas(){
        $this->meta_title = '城市列表';
        
        $model = M("OverseasCities");
        
        $total = $model->count();         
        if( isset($REQUEST['r']) ){
        	$listRows = (int)$REQUEST['r'];
        }else{
        	$listRows = 15;
        }
        $page = new \Think\Page($total, $listRows, $REQUEST);
        
        $p = $page->show();
        $version = $model->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('arr',$version);
        $this->assign('total',$total);
        $this->assign('page', $p? $p: '');
        $this->display();
    }
    
    public function overseas_edit(){
    	
        if(IS_POST){
            $model = D('overseas_cities');
            if(false !== $model->update()){
                $this->success('修改成功！', U('index'),'ajax_success');
            } else {
                $error = $model->getError();
                $this->error(empty($error) ? '错误啦！' : $error);
            }
        } else {
            $this->meta_title = '修改城市';
            $id = I('get.id');
            empty($id) && $this->error('参数不能为空！');
            $all_country = M('cities')->where(['pid'=>0,'id'=>['NEQ',1]])->select();
            $data = M('overseas_cities')->field(true)->find($id);
            $this->assign('all_country',$all_country);
            $this->assign('data',$data);
            $this->display();
        }
    }
    
    public function overseas_add(){
    	
        if(IS_POST){
            $model = D('overseas_cities');
            $data = array(
                'country'   => !empty($_POST['country']) ? $_POST['country'] : '',
                'country_id'   => !empty($_POST['country_id']) ? $_POST['country_id'] : '',
                'sort_order'    => !empty($_POST['sort_order']) ? $_POST['sort_order'] : 0,
                'update_time'   => time(),
                'create_time'   => time(),
            );
            if(false !== $model->add($data)){
                $this->success('发布成功！', U('index'),'ajax_success');
            } else {
                $error = $model->getError();
                $this->error(empty($error) ? '错误啦！' : $error);
            }
        } else {
            $this->meta_title = '添加城市';
            $all_country = M('cities')->where(['pid'=>0,'id'=>['NEQ',1]])->select();
            $this->assign('all_country',$all_country);
            $this->display();
        }
    }
    public function overseas_start(){
        $model = M("overseas_cities");
        $id = I('id','get');
        if( !empty($id) )
        {
            $model->where(array('id'=>$id))->save(array('status'=>1));
            $this->success('修改成功');
        }else{
            $this->error('非法参数！');
        }    
    }
    public function overseas_stop(){
        $model = M("overseas_cities");
        $id = I('id','get');
        if( !empty($id) )
        {
            $model->where(array('id'=>$id))->save(array('status'=>0));
            $this->success('修改成功');
        }else{
            $this->error('非法参数！');
        }    
    }
    public function overseas_del($id){
    	 
    	if(IS_POST and !empty($_POST['id'])){
    		$id = json_decode($_POST['id']);
    		foreach ($id as $val){
    			M('overseas_cities')->where(array('id'=>$val))->delete();
    		}
    		$this->success('删除成功！');
    		return false;
    	}
    	$this->delete('app_version',array('id'=>$id));
    	 
    }
    
    public function hot_cities(){
        $this->meta_title = '城市列表';
        
        $model = M("HotCities");
        
        $total = $model->count();         
        if( isset($REQUEST['r']) ){
        	$listRows = (int)$REQUEST['r'];
        }else{
        	$listRows = 15;
        }
        $page = new \Think\Page($total, $listRows, $REQUEST);
        
        $p = $page->show();
        $version = $model->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('arr',$version);
        $this->assign('total',$total);
        $this->assign('page', $p? $p: '');
        $this->display();
    }
    
    public function hot_cities_edit(){
    	
        if(IS_POST){
            $model = D('hot_cities');
            if(false !== $model->update()){
                $this->success('修改成功！', U('index'),'ajax_success');
            } else {
                $error = $model->getError();
                $this->error(empty($error) ? '错误啦！' : $error);
            }
        } else {
            $this->meta_title = '修改城市';
            $id = I('get.id');
            empty($id) && $this->error('参数不能为空！');
//            $all_province = M('cities')->where(['pid'=>1,'id'=>['NEQ',1]])->select();
            $data = M('hot_cities')->field(true)->find($id);
//            $this->assign('all_province',$all_province);
            $this->assign('data',$data);
            $this->display();
        }
    }
    
    public function hot_cities_add(){
    	
        if(IS_POST){
            $model = D('hot_cities');
            $data = array(
                'province'   => !empty($_POST['province']) ? $_POST['province'] : '',
                'city'   => !empty($_POST['city']) ? $_POST['city'] : '',
                'city_id'   => !empty($_POST['city_id']) ? $_POST['city_id'] : '',
                'sort_order'    => !empty($_POST['sort_order']) ? $_POST['sort_order'] : 0,
                'update_time'   => time(),
                'create_time'   => time(),
            );
            if(false !== $model->add($data)){
                $this->success('发布成功！', U('index'),'ajax_success');
            } else {
                $error = $model->getError();
                $this->error(empty($error) ? '错误啦！' : $error);
            }
        } else {
            $this->meta_title = '添加城市';
//            $all_province = M('cities')->where(['pid'=>1])->select();
//            $json = '{"citylist":[';
//            foreach ($all_province as $key=>$val) {
//                $json .= '{"p":"'.$val['name'].'","c":[';
//                if( $val['is_latter'] == 0 ){
//                    $json .= '{"n":"'.$val['name'].'","i":"'.$val['id'].'"}';
//                }else{
//                    $all_city = M('cities')->where(['pid'=>$val['id']])->select();
//                    foreach ($all_city as $k=>$c ) {
//                        $json .= '{"n":"'.$c['name'].'","i":"'.$c['id'].'"}';
//                        $json .= $k == (count($all_city)-1) ? '' : ',';
//                    }
//                }
//                $json .= ']}';
//                $json .= $key == (count($all_province)-1) ? '' : ',';
//            }
//            $json .= ']}';
//            echo $json;die;
//            
//            $this->assign('all_province',$all_province);
            $this->display();
        }
    }
    public function hot_cities_start(){
        $model = M("hot_cities");
        $id = I('id','get');
        if( !empty($id) )
        {
            $model->where(array('id'=>$id))->save(array('status'=>1));
            $this->success('修改成功');
        }else{
            $this->error('非法参数！');
        }    
    }
    public function hot_cities_stop(){
        $model = M("hot_cities");
        $id = I('id','get');
        if( !empty($id) )
        {
            $model->where(array('id'=>$id))->save(array('status'=>0));
            $this->success('修改成功');
        }else{
            $this->error('非法参数！');
        }    
    }
    public function hot_cities_del($id){
    	 
    	if(IS_POST and !empty($_POST['id'])){
    		$id = json_decode($_POST['id']);
    		foreach ($id as $val){
    			M('hot_cities')->where(array('id'=>$val))->delete();
    		}
    		$this->success('删除成功！');
    		return false;
    	}
    	 
    }

}