<?php
namespace Admin\Controller;

class TravelNotesController extends ConmmonController {
	
	//keyword_forbidden
	public function index(){
            $model = M("travel_notes");

    //    	$map = array();
            $map['status'] = 1;    	

            $total =   $model->where($map)->count();

            if( isset($REQUEST['r']) ){
                    $listRows = (int)$REQUEST['r'];
            }else{
                    $listRows = 10;
            }

            $page = new \Think\Page($total, $listRows, $REQUEST);

            $arr = $model->where($map)->limit($page->firstRow . ',' . $page->listRows)->order(['create_time'=>'desc'])->select();
            $p = $page->show();

            $this->assign('arr',$arr);
            $this->assign('total',$total);
            $this->assign('page',$page);
            $this->assign('page', $p? $p: '');

            $this->display();
	}
        
        //查看详情
        public function view()
        {
            $model = M('travel_notes');
            $id = I('get.id');
            empty($id) && $this->error('参数不能为空！');
            
            $data = $model->field(true)->find($id);
            
            $card = M('travel_notes_card')->where('pid='.$id)->order('sort_order desc')->select();
            $this->assign('data',$data);
            $this->assign('card',$card);
            $this->meta_title = '编辑行为';
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
				M('travel_notes')->where(array('id'=>$val))->save(array('status'=>-1));
			}
			$this->success('删除成功！');
			return false;
		}
		$this->delete('travel_notes',array('id'=>$id));
		 
	}
	
	protected function forb( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
		$data['status']         =   1;
		$data['update_time']    =   NOW_TIME;
		$this->editRow(   $model , $data, $where, $msg);
	}
	
	public function enb($id){
		$this->forb('keyword_forbidden',array('id'=>$id));
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
	
}