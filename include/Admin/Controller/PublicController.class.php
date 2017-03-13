<?php

namespace Admin\Controller;
use User\Api\AdminApi;

class PublicController extends \Think\Controller {


    public function login($username = null, $password = null, $verify = null){
    	
        if(IS_POST){
            /* 检测验证码 TODO: */
//             if(!check_verify($verify)){
//                 $this->error('验证码输入错误！');
//             }

                        
            /* 调用UC登录接口登录 */
            $User = new AdminApi;
            $_SESSION = '';
            $uid = $User->login($username, $password);
            if(0 < $uid){ //UC登录成功
                /* 登录用户 */
                $Member = D('Admin');
                if($Member->login($uid)){ //登录用户           	
                    //TODO:跳转到登录前页面
                    $_SESSION [C('USER_AUTH_KEY')] = $uid;
                    
                    $Member->where('id='.$uid)->setInc('count_login');
                    $login_log = array(
                        'action'    => '12',
                        'ip'        => ip2long(get_client_ip()),
                        'user_id'   => (int)$uid,
                        'type'      => 1,
                        'create_time'   => time(),
                        'remark'    => 'login',
                    );
                    $admin_log = M('AdminLog');
                    $data = $admin_log->add($login_log);
                    if(!$data){
                        $this->error($admin_log->getError());
                    }
                    $this->success('登录成功！', U('/admin/Index/index'));
                } else {
                    $this->error($Member->getError());
                }

            } else { //登录失败
                switch($uid) {
                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
                    case -2: $error = '密码错误！'; break;
                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
                }
                $this->error($error);
            }
        } else {
            if(is_login()){
                $this->redirect('/admin/Index/index');
            }else{
                /* 读取数据库中的配置 */
                $config	=	S('DB_CONFIG_DATA');
                if(!$config){
                    $config	=	D('Config')->lists();
                    S('DB_CONFIG_DATA',$config);
                }
                C($config); //添加配置
                
                $this->display();
            }
        }
    }

    /* 退出登录 */
    public function logout(){
        if(is_login()){
            D('Admin')->logout();
            session('[destroy]');
            $this->success('退出成功！', U('login'));
        } else {
            $this->redirect('login');
        }
    }

    public function verify(){
        $config =    array(
            'useCurve'  => false,
            'useNoise'  => false, // 关闭验证码杂点
            'fontSize'  => 30
        );
        $verify = new \Think\Verify($config);
        $verify->entry(1);
    }
    
    public function welcome(){
    	$this->display();
    }
    
    public function userInfo(){
    	$uid = $_GET['uid'] ? $_GET['uid'] : $this->error('用户不存在');
    }

}
