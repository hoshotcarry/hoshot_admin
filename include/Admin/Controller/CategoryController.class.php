<?php

namespace Admin\Controller;

/**
 * 后台分类管理控制器
 */
class CategoryController extends ConmmonController {

    /**
     * 分类管理列表
     */
    public function index(){
        if( isset($REQUEST['r']) ){
        	$listRows = (int)$REQUEST['r'];
        }else{
        	$listRows = 15;
        }
        $total = D('Category')->where('status=1')->count();     
        $page = new \Think\Page($total, $listRows, $REQUEST);
        
        $p = $page->show();
        $tree = D('Category')->limit($page->firstRow . ',' . $page->listRows)->getTree(0,'id,name,title,sort,pid,allow_publish,status,description,create_time,model');
     //   var_dump($tree);
        $this->assign('tree', $tree);
        $this->assign('total', $total);
        $this->assign('page', $p? $p: '');
        C('_SYS_GET_CATEGORY_TREE_', true); //标记系统获取分类树模板
        $this->meta_title = '分类管理';
        $this->display();
    }

    /**
     * 显示分类树，仅支持内部调
     * @param  array $tree 分类树
     */
    public function tree($tree = null){
        C('_SYS_GET_CATEGORY_TREE_') || $this->_empty();
        $this->assign('tree', $tree);
        $this->display('tree');
    }

    /* 编辑分类 */
    public function edit($id = null, $pid = 0){
        $Category = D('Category');

        if(IS_POST){ //提交表单
            if(false !== $Category->update()){
                $this->success('编辑成功！', U('index'));
            } else {
                $error = $Category->getError();
                $this->error(empty($error) ? '未知错误！' : $error);
            }
        } else {
            $cate = array();
            $cate = $Category->where(array('pid'=>0,'status'=>1))->select();

            /* 获取分类信息 */
            $info = $id ? $Category->info($id) : '';

            $this->assign('info',       $info);
            $this->assign('category',   $cate);
            $this->meta_title = '编辑分类';
            $this->display();
        }
    }

    /* 新增分类 */
    public function add($pid = 0){
        $Category = D('Category');

        if(IS_POST){ //提交表单
            if(false !== $Category->update()){
                $this->success('新增成功！', U('index'));
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
            $this->display('add');
        }
    }

    /**
     * 删除一个分类
     */
    public function remove(){
        $cate_id = I('id');
        if(empty($cate_id)){
            $this->error('参数错误!');
        }

        //判断该分类下有没有子分类，有则不允许删除
        $child = M('Category')->where(array('pid'=>$cate_id))->field('id')->select();
        if(!empty($child)){
            $this->error('请先删除该分类下的子分类');
        }

        //判断该分类下有没有内容
        $document_list = M('Document')->where(array('category_id'=>$cate_id))->field('id')->select();
        if(!empty($document_list)){
            $this->error('请先删除该分类下的文章（包含回收站）');
        }

        //删除该分类信息
        $res = M('Category')->delete($cate_id);
        if($res !== false){
            //记录行为
            action_log('update_category', 'category', $cate_id, UID);
            $this->success('删除分类成功！');
        }else{
            $this->error('删除分类失败！');
        }
    }

    /**
     * 操作分类初始化
     * @param string $type
     */
    public function operate($type = 'move'){
        //检查操作参数
        if(strcmp($type, 'move') == 0){
            $operate = '移动';
        }elseif(strcmp($type, 'merge') == 0){
            $operate = '合并';
        }else{
            $this->error('参数错误！');
        }
        $from = intval(I('get.from'));
        empty($from) && $this->error('参数错误！');

        //获取分类
        $map = array('status'=>1, 'id'=>array('neq', $from));
        $list = M('Category')->where($map)->field('id,title')->select();

        $this->assign('type', $type);
        $this->assign('operate', $operate);
        $this->assign('from', $from);
        $this->assign('list', $list);
        $this->meta_title = $operate.'分类';
        $this->display();
    }

    /**
     * 移动分类
     */
    public function move(){
        $to = I('post.to');
        $from = I('post.from');
        $res = M('Category')->where(array('id'=>$from))->setField('pid', $to);
        if($res !== false){
            $this->success('分类移动成功！', U('index'));
        }else{
            $this->error('分类移动失败！');
        }
    }

    /**
     * 合并分类
     */
    public function merge(){
        $to = I('post.to');
        $from = I('post.from');
        $Model = M('Category');

        //检查分类绑定的模型
        $from_models = explode(',', $Model->getFieldById($from, 'model'));
        $to_models = explode(',', $Model->getFieldById($to, 'model'));
        foreach ($from_models as $value){
            if(!in_array($value, $to_models)){
                $this->error('请给目标分类绑定' . get_document_model($value, 'title') . '模型');
            }
        }

        //检查分类选择的文档类型
        $from_types = explode(',', $Model->getFieldById($from, 'type'));
        $to_types = explode(',', $Model->getFieldById($to, 'type'));
        foreach ($from_types as $value){
            if(!in_array($value, $to_types)){
                $types = C('DOCUMENT_MODEL_TYPE');
                $this->error('请给目标分类绑定文档类型：' . $types[$value]);
            }
        }

        //合并文档
        $res = M('Document')->where(array('category_id'=>$from))->setField('category_id', $to);

        if($res){
            //删除被合并的分类
            $Model->delete($from);
            $this->success('合并分类成功！', U('index'));
        }else{
            $this->error('合并分类失败！');
        }

    }
    
    protected function delete ( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
        $data['status']         =   -1;
        $data['update_time']    =   NOW_TIME;
        $this->editRow(   $model , $data, $where, $msg);
    }
    
    public function del($id){
         
        if(IS_POST and !empty($_POST['id'])){
            $id = json_decode($_POST['id']);
            foreach ($id as $val){
                M('Category')->where(array('id'=>$val))->save(array('status'=>-1));
            }
            $this->success('删除角色成功！');
            return false;
        }
        $this->delete('Category',array('id'=>$id));
         
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
            $photo = "/uploads/Picture/icon/".time().  rand(0, 999999).$ext;

            // 生成文件public/uploads/Picture/icon
            file_put_contents('/mnt/alidata/www/api_hoshot/public'.$photo, base64_decode($data), true);
            // 返回
            header('content-type:application/json;charset=utf-8');
            $ret = array('img'=>$photo,'msg'=>'图片上传成功');
            echo json_encode($ret);     
            }
            exit;
    }

}
