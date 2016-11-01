<?php
namespace Home\Controller;
class SignOrgSetController extends SysSetController {
    public function index(){
        $signorg = D("signorgtype");
        $list=$signorg->select();
        $this->assign('org', $list);
        $this->display();
    }
    
    public function edit(){
        $map['MS_Signorgname']= "{$_GET['signorgname']}";
        $signorg = D("signorgtype");
        $condition['id']= $_GET['id'];
        $signorg->create($map);
        $signorg->where($condition)->save();
    }
    
    public function add(){
        $map['MS_Signorgname']= "{$_GET['signorgname']}";
        $signorg = D("signorgtype");
        //var_dump($map);
        if($signorg->add($map)){
            $this->success('添加成功') ;
        } else {
            $this->error('添加失败') ;
        } 
    }
    public function del(){
        $condition['id']= $_GET['id'];
        $signorg = D("signorgtype");
        $signorg->where($condition)->delete();
    }
}