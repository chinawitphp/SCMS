<?php
namespace Home\Controller;
use Think\Controller;
class MessagemanageController extends Controller {
    public function user_add(){
        $m=M('User');
        $username=$_SESSION['username'];
        $data['username'] = $username;
        $arr=$m->where($data)->select();
        $this->assign('data',$arr);
        $this->display();
    }
    public function useradd(){
        $m=M('User');
        $data['username']=$_POST['username'];
        $data['password']=$_POST['password'];
        $data['number']=$_POST['number'];
        $data['email']=$_POST['email'];
        $data['username2']=$_POST['username2'];
        $data['root']=$_POST['root'];
        $count=$m->add($data);
        if($count){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
   }
    public function user_manage(){
        $m=M('User');
        $username=$_SESSION['username'];
        $data['username'] = $username;
        $arr=$m->where($data)->select();
        $this->assign('data',$arr);
        $this->display();
    }
    public function userselect(){
         $m=M('User');
         $username=$_SESSION['username'];
         $data['username'] = $username;
         $arr=$m->where($data)->select();
         $this->assign('data',$arr);
         dump($_POST['number']);
         $g=$_POST['username'];
         dump($_POST['username']);
         dump($g);
         if($_POST['username']){
             $da['username']=array('like',"%{$_POST['username']}%");
         }
         if(($_POST['number'])){
              $da['number']=$_POST['number'];
         }
        if(($_POST['root'])){
            $da['root']=$_POST['root'];
        }
        if(($_POST['username2'])){
              $da['username2']=array('like',"%{$_POST['username2']}%");
        }
        if(($_POST['state'])){
             $da['state']=$_POST['state'];
        }
        //$da['_logic']='or';
        dump($da);
         $arr=$m->where($da)->select();
         $this->ajaxReturn($arr);
//         $this->assign('da',$arr);
         //$this->display('user_manage');
    }
     public function state(){
         $m=M('User');
         dump($_POST['one']);
     }
      public function user_information(){
          $m=M('User');
          $username=$_SESSION['username'];
          $data['username'] = $username;
          $arr=$m->where($data)->select();
          $this->assign('data',$arr);
          $this->display();
      }
       public function userinformation(){
            $m=M('User');
            $username=$_SESSION['username'];
            $data['username'] = $username;
            $arr=$m->where($data)->select();
            $this->assign('data',$arr);
            $d=M('Passport');
           if($_POST['username']){
               $list['username']=array('like',"%{$_POST['username']}%");
           }
           if($_POST['id']){
               $list['id']=$_POST['id'];
           }
           if($_POST['sex']){
               $list['sex']=$_POST['sex'];
                }
//            $list['_logic']='or';
                $arr=$d->where($list)->select();
                 $this->ajaxReturn($arr);
//                $this->assign('list',$arr);
//                $this->display('user_information');
        }
         public function userinformation_delete(){
             $m=M('User');
             $id=$_GET['id'];
             $count=$m->delete($id);
             if($count>0){
                    $this->success('删除成功');
             }else{
                    $this->error('删除失败');
             }
    } 
     public function cha(){
       $m=M('User');
      $id=$_GET['id'];
       $arr=$m->find($id);
       $this->assign('data',$arr);
       $this->display();
    }
       public function bbb(){
        $m=M('User');
        $data['id']=$_POST['id'];
        $data['username']=$_POST['username'];
         $data['number']=$_POST['number'];
         $data['root']=$_POST['root'];
         $data['username2']=$_POST['username2'];
         $data['email']=$_POST['email'];
        $count=$m->save($data);
          if($count>0){
            $this->success('chenggong','select');
        }else{
            $this->error('shibai');
        }
    }
    public function del(){
         $m=M('User');
         $id=$_GET['id'];
        $count=$m->delete($id);
        if($count>0){
            $this->success('chenggong');
        }else{
            $this->error('shibai');
        }
    } 
}