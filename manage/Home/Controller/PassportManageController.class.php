<?php
namespace Home\Controller;
class PassportManageController extends AuthorityController {
    
    //返回签证机关
    public function addIndex(){
        $signorg = D("ppsignorgtype");
        $list=$signorg->select();
        $this->assign('org', $list);
        $this->display();
    }
    //ajax向此传值，返回json格式数据，包括身份证和姓名
    public function getCommInfo(){
        if ($_GET['idnumber']) {
            $map['idnumber'] = array('like', "{$_GET['idnumber']}%");
            $map['isdel'] = 0;
            $info = D("holdercomminfo");
            $list=$info->field('id,idnumber,realname')->where($map)->select();
            //输完18位后判断是否该身份证对应的是否已有海员证
            if(strlen($_GET['idnumber'])==18){
                $exist['holderid']=intval($list[0][id]);
                if(intval(D("passportinfo")->where($exist)->count())){
                    $this->ajaxReturn(list($warn,$states) = array('已经存在','1'));
                }
            }else{
                $this->ajaxReturn($list);
            }
        }
    }
    //提交数据
    public function addInfo(){
        //添加个人通用信息
        $commmap['idnumber'] = $_GET['idnumber'];
        $info = D("holdercomminfo");
        $count = intval($info->where($commmap)->count());
        if(!$count){
            $commmap['realname'] = "{$_GET['realname']}";
            $commmap['nation'] = "{$_GET['nation']}";
            $info->data($commmap)->add(); 
            //获取新加信息对应的id
            $temp_id=$info->field('id')->where($commmap)->select();
            $seamenmap['holderid']=intval($temp_id[0][id]);
        }
        //添加海员证信息
        $seamen = D("passportinfo");
        if ($_GET['holderid']) {
            $seamenmap['holderid'] = $_GET['holderid'];
        }
        $seamenmap['birtharea'] = "{$_GET['birtharea']}";
        $seamenmap['signorgid'] = $_GET['signorgid'];
        $seamenmap['regtime'] = $_GET['regtime'];
        $seamenmap['endtime'] = $_GET['endtime'];
        $seamen->add($seamenmap); 
    }
    
    public function searchIndex(){
        $signorg = D("ppsignorgtype");
        $list=$signorg->select();
        $this->assign('org', $list);
        $this->display();
    }
    //查询功能实现
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
        //将收到的起止时间转化为时间戳进行比较
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
        //var_dump($temptimestart);
        $search = D("passportinfo");
        $list=$search->join('ms_holdercomminfo ON ms_passportinfo.holderid = ms_holdercomminfo.id')->field('ms_passportinfo.id,idnumber,realname,regtime,endtime')->where($map)->select();
        $this->ajaxReturn($list);
    }
    
    //查看信息详细内容，渲染模版和
    public function infoDetail(){
        $signorg = D("ppsignorgtype");
        $orglist=$signorg->select();
        $map['ms_passportinfo.id'] = "{$_GET['id']}";
        $search = D("passportinfo");
        $infolist=$search->join('ms_holdercomminfo ON ms_passportinfo.holderid = ms_holdercomminfo.id')->field('holderid,idnumber,realname,regtime,endtime,nation,signorgid')->where($map)->select();
        //判断访问来源
        if ($_GET['type']==app){
            $this->ajaxReturn($infolist);
        } else {
            $this->assign('org', $orglist);
            $this->assign('info', $infolist);
            $this->display();
        }
    }
    //修改
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
        $edit = D("passportinfo"); // 实例化User对象
        // 要修改的数据对象属性赋值
        $edit->create($map);
        $edit->where($condition)->save(); // 根据条件更新记录
    }
}