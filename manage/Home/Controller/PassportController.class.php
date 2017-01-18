<?php
namespace Home\Controller;
use Think\Controller;
class PassportController extends Controller {
    public function addIndex(){
        $signorg = D("signorgtype");
        $list=$signorg->select();
        $this->assign('org', $list);
        $this->display();
    }
    public function getCommInfo(){
        if ($_GET['idnumber']) {
            $map['idnumber'] = array('like', "{$_GET['idnumber']}%");
            $map['isdel'] = 0;
            $info = D("passport");
            $list=$info->field('id,idnumber,realname')->where($map)->select();
            if(strlen($_GET['idnumber'])==18){
                $exist['holderid']=intval($list[0][id]);
                if(intval(D("seameninfo")->where($exist)->count())){
                    $this->ajaxReturn(list($warn,$states) = array('已经存在','1'));
                }
            }else{
                $this->ajaxReturn($list);
            }
        }
    }
    public function addInfo(){
        $commmap['idnumber'] = $_GET['idnumber'];
        $info = D("holdercomminfo");
        $count = intval($info->where($commmap)->count());
        if(!$count){
            $commmap['realname'] = "{$_GET['realname']}";
            $commmap['nation'] = "中国";
            $info->data($commmap)->add(); 
            $temp_id=$info->field('id')->where($commmap)->select();
            $seamenmap['holderid']=intval($temp_id[0][id]);
        }
        $seamen = D("seameninfo");
        if ($_GET['holderid']) {
            $seamenmap['holderid'] = $_GET['holderid'];
        }
        $seamenmap['birtharea'] = "{$_GET['birtharea']}";
        $seamenmap['signorgid'] = $_GET['signorgid'];
        $seamenmap['regtime'] = $_GET['regtime'];
        $seamenmap['endtime'] = $_GET['endtime'];
        if($seamen->add($seamenmap)){
            $this->success('添加成功') ;
        } else {
            $this->error('添加失败') ;
        }
    }
    
    public function searchIndex(){
        $signorg = D("signorgtype");
        $list=$signorg->select();
        $this->assign('org', $list);
        $this->display();
    }
    public function searchInfo(){
        if($_GET['idnumber']){
            $map['idnumber'] = array('like', "%{$_GET['idnumber']}%");
        }
        if($_GET['realname']){
            $map['realname'] = array('like', "%{$_GET['realname']}%");
        }
        if($_GET['holderid']){
            $map['holderid'] = "{$_GET['holderid']}";
        }
        if($_GET['nation']){
            $map['nation'] = "{$_GET['nation']}";
        }
        if($_GET['birtharea']){
            $map['birtharea'] = "{$_GET['birtharea']}";
        }
        if($_GET['signorgid']){
            $map['signorgid'] = "{$_GET['signorgid']}";
        }
        if($_GET['regtimebegin']){
            $temptimestart=explode("-",$_GET['regtimebegin']);
            $timestampstart=mktime(0,0,0,$temptimestart[1],$temptimestart[2],$temptimestart[0]);
        } else {
            $timestampstart=57600;//1970-01-02
        }
        if($_GET['regtimeend']){
            $temptimeend=explode("-",$_GET['regtimeend']);  
            $timestampend=mktime(0,0,0,$temptimeend[1],$temptimeend[2],$temptimeend[0]);
        } else {
            $timestampend=time();
        }
        $map['regtime'] = array('between', array(date('Y-m-d',$timestampstart),date('Y-m-d',$timestampend)));
        if($_GET['endtimebegin']){
            $temptimestart=explode("-",$_GET['endtimebegin']);
            $timestampstart=mktime(0,0,0,$temptimestart[1],$temptimestart[2],$temptimestart[0]);
        } else {
            $timestampstart=57600;//1970-01-02
        }
        if($_GET['endtimeend']){
            $temptimeend=explode("-",$_GET['endtimeend']);  
            $timestampend=mktime(0,0,0,$temptimeend[1],$temptimeend[2],$temptimeend[0]);
        } else {
            $timestampend=time();
        }
        $map['endtime'] = array('between', array(date('Y-m-d',$timestampstart),date('Y-m-d',$timestampend)));
        $map['seamenisdel'] = "0";
        $map['isdel'] = "0";
        
        $search = D("seameninfo");
        $count = $search->count();
        $Page=new \Think\Page($count,3);
        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录  每页<b>%LIST_ROW%</b>条  第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();
        $list=$search->join('ms_holdercomminfo ON ms_seameninfo.holderid = ms_holdercomminfo.id')->field('ms_seameninfo.id,idnumber,realname,regtime,endtime')->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        //$this->ajaxReturn($list);
        echo json_encode($list);
        //$this->assign('list',$list);// 赋值数据集
        //$this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }
    
    public function infoDetail(){
        $signorg = D("signorgtype");
        $orglist=$signorg->select();
        $map['ms_seameninfo.id'] = "{$_GET['id']}";
        $search = D("seameninfo");
        $infolist=$search->join('ms_holdercomminfo ON ms_seameninfo.holderid = ms_holdercomminfo.id')->field('holderid,idnumber,realname,regtime,endtime,signorgid')->where($map)->select();
        //判断访问来源
        if ($_GET['type']==app){
            $this->ajaxReturn($infolist);
        } else {
            $this->assign('org', $orglist);
            $this->assign('info', $infolist);
            $this->display();
        }
    }
    public function infoEdit(){
        $condition['holderid'] = "{$_GET['holderid']}";
        if($_GET['signorgid']){
            $map['signorgid'] = "{$_GET['signorgid']}";
        }
        if($_GET['regtime']){
            $map['regtime'] = "{$_GET['regtime']}";
        }
        if($_GET['endtime']){
            $map['endtime'] = "{$_GET['endtime']}";
        }
        $edit = D("seameninfo"); 
        $edit->create($map);
        $edit->where($condition)->save(); 
    }
}

