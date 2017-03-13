<?php

namespace Admin\Controller;

class TagsController extends ConmmonController
{
    public function index(){
        
    }
    
    public function tags(){
        $this->meta_title = '标签列表';
        
        $model = M("tags");
        
        $total = $model->count();         
        if( isset($REQUEST['r']) ){
        	$listRows = (int)$REQUEST['r'];
        }else{
        	$listRows = 5;
        }
        $page = new \Think\Page($total, $listRows, $REQUEST);
        
        $p = $page->show();
        $version = $model->where($map)->limit($page->firstRow . ',' . $page->listRows)->select();
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
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     50000000 ;// 设置附件上传大小
            $upload->exts      =     ['apk'];// 设置附件上传类型
            $upload->rootPath  =     '/Uploads/'; // 设置附件上传根目录
            $upload->savePath  =     'Download/'; // 设置附件上传（子）目录
            $upload->autoSub   =    true;
            $upload->saveName  =     (string)time();
            // 上传文件 
            $info   =   $upload->uploadOne($_FILES['file']);
            if(!$info) {// 上传错误提示错误信息
                $this->error("上传失败:".$upload->getError());
            }else{
                $data = [
                    'app_id'    =>  $_POST['app_id'],
                    'remark'    =>  $_POST['remark'],
                    'flatform'    =>  $_POST['flatform'],
                    'app_version'    =>  $_POST['app_version'],
                    'status'    =>  $_POST['status'],
                    'online_time'    =>  strtotime($_POST['online_time']),
                    'logo'      =>  !empty($_POST['logo']) ? $_POST['logo'] : '',
                    'file'      => $upload->rootPath.$info['savepath'].$info['savename'],
                ];
                if(false !== $model->update($data)){
                    $this->success('发布成功！', U('index'),'ajax_success');
                } else {
                    $error = $model->getError();
                    $this->error(empty($error) ? '错误啦！' : $error);
                }
            }
        } else {
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
            $this->meta_title = '发布新版本';
            $this->display();
        }
    }
}