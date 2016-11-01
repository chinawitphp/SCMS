<?php
namespace Home\Controller;
class HealthCertificateManageController extends AuthorityController {
    
    //返回部分分类
    public function addIndex(){
            $signorg = D("departtype");
            $list=$signorg->select();
            $this->assign('depart', $list);
            $this->display();
    }
    //ajax向此传值，返回json格式数据，包括身份证和姓名
    public function getCommInfo(){
        if ($_GET['idnumber']) {
            $map['idnumber'] = array('like', "{$_GET['idnumber']}%");
            $map['isdel'] = 0;
            $info = D("holdercomminfo");
            $result=$info->field('id,idnumber,realname')->where($map)->select();
            //输完18位后判断是否该身份证对应的是否已有健康证
            if(strlen($_GET['idnumber'])==18){
                $exist['holderid']=intval($result[0][id]);
                //var_dump(D("healthinfo")->where($exist)->count());
                if(intval(D("healthinfo")->where($exist)->count())){
                    $this->ajaxReturn(list($warn,$states) = array('已经存在','1'));
                }
            }else{
                $this->ajaxReturn($result);
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
            $heathmap['holderid']=intval($temp_id[0][id]);
        }
        //添加健康证信息
        $health = D("healthinfo");
        if ($_GET['holderid']) {
            $healthmap['holderid'] = $_GET['holderid'];
        }
        $healthmap['departid'] = $_GET['departid'];
        $healthmap['dipid'] = $_GET['dipid'];
        $healthmap['regtime'] = $_GET['regtime'];
        $healthmap['endtime'] = $_GET['endtime'];
        $health->add($healthmap); 
    }
    public function searchIndex(){
        $signorg = D("departtype");
        $list=$signorg->select();
        $this->assign('depart', $list);
        $this->display();
    }
    public function searchInfo(){
        if($_GET['idnumber']){
            $map['idnumber'] = array('like', "%{$_GET['idnumber']}%");
        }
        if($_GET['realname']){
            $map['realname'] = array('like', "%{$_GET['realname']}%");
        }
        if($_GET['dipid']){
            $map['dipid'] = array('like', "%{$_GET['dipid']}%");
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
        $map['healthisdel'] = "0";
        $map['isdel'] = "0";
        $search = D("healthinfo");
        $list=$search->join('ms_holdercomminfo ON ms_healthinfo.holderid = ms_holdercomminfo.id')->field('ms_healthinfo.id,idnumber,realname,regtime,endtime,dipid')->where($map)->select();
        $this->ajaxReturn($list);
    }
    
    //查看详细内容
    public function infoDetail(){
        $depart = D("departtype");
        $departlist=$depart->select();
        $map['ms_healthinfo.id'] = "{$_GET['id']}";
        $search = D("healthinfo");
        $infolist=$search->join('ms_holdercomminfo ON ms_healthinfo.holderid = ms_holdercomminfo.id')->field('holderid,idnumber,realname,regtime,endtime,nation,departid,dipid')->where($map)->select();
        //判断访问来源
        if ($_GET['type']==app){
            $this->ajaxReturn($infolist);
        } else {
            $this->assign('depart', $departlist);
            $this->assign('info', $infolist);
            $this->display();
        }
    }
    //修改
    public function infoEdit(){
        $condition['holderid'] = "{$_GET['holderid']}";
        if($_GET['departid']){
            $map['departid'] = "{$_GET['departid']}";
        }
        if($_GET['regtime']){
            $map['regtime'] = "{$_GET['regtime']}";
        }
        if($_GET['endtime']){
            $map['endtime'] = "{$_GET['endtime']}";
        }
        if($_GET['dipid']){
            $map['dipid'] = "{$_GET['dipid']}";
        }
        $edit = D("healthinfo"); 
        $edit->create($map);
        $edit->where($condition)->save();        
    }
}