<?php
namespace Home\Controller;
class SeamenManageController extends AuthorityController {
    
    //返回签证机关
    public function addIndex(){
        $signorg = D("signorgtype");
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
                if(intval(D("seameninfo")->where($exist)->count())){
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
            $commmap['nation'] = "中国";
            $info->data($commmap)->add(); 
            //获取新加信息对应的id
            $temp_id=$info->field('id')->where($commmap)->select();
            $seamenmap['holderid']=intval($temp_id[0][id]);
        }
        //添加海员证信息
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
    
    //查看信息详细内容，渲染模版
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
        $edit = D("seameninfo"); // 实例化User对象
        // 要修改的数据对象属性赋值
        $edit->create($map);
        $edit->where($condition)->save(); // 根据条件更新记录
    }
}