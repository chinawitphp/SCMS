<?php
namespace Home\Controller;
use Think\Controller;
class PageController extends Controller {
    public function limit(){
        $User = M('User'); // 实例化User对象
        $count      = $User->where('status=1')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,1);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $list = $User->where('status=1')->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display('Messagemanage:change'); // 输出模板
        
    }
}
        