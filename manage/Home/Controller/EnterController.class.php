<?php

namespace Home\Controller;
use Think\Controller;
class EnterController extends Controller {
       public function login(){
           $_SESSION = array(); //清除SESSION值.
          if(isset($_COOKIE[session_name()])){  //判断客户端的cookie文件是否存在,存在的话将其设置为过期.
                setcookie(session_name(),'',time()-1,'/');
            }
           session_destroy();  //清除服务器的sesion文件
           $this->display();
       }
       public function enter(){
          $username=$_POST['username'];
          $password=$_POST['password'];
          $code=$_POST['verify'];
          $verify = new \Think\Verify();
        if($verify->check($code)==FALSE){
           $this->error('验证码不正确');
        }
           $m=M('User');
           $data['username']=$username;
           $data['password']=$password;
           $arr=$m->field('id')->where($data)->select();

           if($arr){
               $_SESSION['username']=$username;
               $_SESSION['id']=$arr[0]['id'];
               session(C('USER_AUTH_KEY'),$arr[0]['id']);  
               session('name',$username);  
//如果用户是超级管理员，则可以进行一切操作  
               if (session('name')==C('RBAC_SUPERADMIN')) {  
    session(C('ADMIN_AUTH_KEY'),true);  
}  
$rbac=new \Org\Util\Rbac();  
//取出用户权限信息  
$rbac::saveAccessList();  
            $this->success('登录成功',U('Index/personal_information'));
        }else{
        $this->error('登录失败',U('Enter/login'));}
     }
         
}