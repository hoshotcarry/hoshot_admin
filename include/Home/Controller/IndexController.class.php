<?php

namespace Home\Controller;
use OT\DataDictionary;
use Think\Controller;
/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends Controller {

	//系统首页
    public function index(){
    	
    	//echo 'Hoshot!';

        //$category = D('Category')->getTree();
       // $lists    = D('Document')->lists(null);

      //  $this->assign('category',$category);//栏目
      //  $this->assign('lists',$lists);//列表
        //$this->assign('page',D('Document')->page);//分页

                 
        $this->display();
    }

}