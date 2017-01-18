<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if($_SESSION['username'] && $_SESSION['username']!=''){
            $this->success('登陆过',U('Index/personal_information'));
        }else{
           $this->display('Enter/login');
        }
    }
    public function personal_information(){
        $m=M('User');
        $username=$_SESSION['username'];
        $data['username'] = $username;
        $arr=$m->where($data)->select();
        $this->assign('data',$arr);
        $this->display(); 
        
    }
    public function change_password(){
        $m=M('User');
        $username=$_SESSION['username'];
        $data['username'] = $username;
        $arr=$m->where($data)->select();
        $this->assign('data',$arr);
//        $username2=$_POST['username2'];
//        $this->assign('data',$username2);
        $this->display(); 
    }
    public function panduan(){
      $m=M('User');
      $data['username'] =$_SESSION['username'];
      $data['password'] =$_POST['password'];
      $a=$_POST['newpassword'];
      $b=$_POST['repassword'];
      if(!preg_match("/^[A-Za-z0-9]+$/ ",$a)){
          $this->error("密码只能包含数字或字母");
    }
      if($a==$b){
      $arr=$m->where($data)->select();
        if($arr!=NULL){
          $da['password']=$_POST['newpassword'];
          $re=$m->where($data)->save($da);
            if($re>0){
               $this->success("修改成功",U('Enter/login'));
            }else{
              $this->error("修改失败");
          }
        }else{
           $this->error("旧密码不正确");
        }
      }else{
          $this->error("俩次密码不一致！");
      }
    }
   
}