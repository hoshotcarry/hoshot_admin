<?php
namespace Admin\Controller;
use User\Api\UserApi as UserApi;

class IndexController extends ConmmonController {

    public function __construct()
    {
        parent::__construct();
        $data = array();
        
        $data['act'] = $this->countData(D('activity'));
        $data['images'] = $this->countData(D('images'));
        $data['works'] = $this->countData(D('works'));
        $data['user'] = $this->countData(D('user'));
        $data['admin'] = $this->countData(D('admin'));
        $this->assign('data',$data);
        
    }
    
    public function index(){
        if(UID){
            $this->meta_title = '管理首页';
            $this->display();
        } else {
            $this->redirect('/admin/Public/login');
        }
    }
    protected function countData($model)
    {
        $data['total'] = $model->count();
        $data['today'] = $model->where('date_format(FROM_UNIXTIME(create_time),"%Y%m%d") = date_format(NOW(),"%Y%m%d")')->count();
        $data['yesterday'] = $model->where('(date_format(NOW(),"%Y%m%d") - date_format(FROM_UNIXTIME(create_time),"%Y%m%d") = 1)')->count();
        $data['week'] = $model->where('date_format(FROM_UNIXTIME(create_time),"%Y%u") = date_format(NOW(),"%Y%u")')->count();
        $data['month'] = $model->where('date_format(FROM_UNIXTIME(create_time),"%Y%m") = date_format(NOW(),"%Y%m")')->count();
        return $data;
    }
}