<?php
namespace Home\Controller;
class TrainedManageController extends AuthorityController {
    public function addIndex(){
        $trainname = D("traintype");
        $trainlist=$trainname->select();
        $covenantname = D("covenanttype");
        $covenantlist=$covenantname->select();
        $this->assign('train', $trainlist);
        $this->assign('covenant', $covenantlist);
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
                if(intval(D("trainedfirstinfo")->where($exist)->count())){
                    $sign[sign] = '1';
                    $sign[content] = '已经存在';
                    $this->ajaxReturn($sign);
                }
            }else{
                $this->ajaxReturn($list);
            }
        }
    }
    public function addFirstInfo(){
        //添加个人通用信息
        $commmap['idnumber'] = $_POST['idnumber'];
        $info = D("holdercomminfo");
        $count = intval($info->where($commmap)->count());
        if(!$count){
            $commmap['realname'] = "{$_POST['realname']}";
            $commmap['nation'] = "{$_POST['nation']}";
            $info->data($commmap)->add();
            //获取新加信息对应的id
            $temp_id=$info->field('id')->where($commmap)->select();
            $trainedfirstmap['holderid']=intval($temp_id[0][id]);
        }
        //添加海员证信息
        $trainedfirst = D("trainfirstinfo");
//         if ($_GET['holderid']) {
//             $seamenmap['holderid'] = $_POST['holderid'];
//         }
        $trainedfirstmap['regtime'] = $_POST['regfirsttime'];
        if($trainedfirst->add($trainedfirstmap)){
            $this->success('添加成功') ;
        } else {
            $this->error('添加失败') ;
        }
    }
    public function addInfo(){
        //添加个人通用信息
        $commmap['idnumber'] = $_GET['idnumber'];
        $info = D("holdercomminfo");
        $count = intval($info->where($commmap)->count());
        if(!$count){
            $commmap['realname'] = "{$_GET['realname']}";
            $commmap['nation'] = "{$_GET['nation']}";
            $info->data($commmap)->add();
           
        }
        //获取输入的个人信息对应的id
        $temp_id=$info->field('id')->where($commmap)->select();
        $trainedfirstmap['holderid']=intval($temp_id[0][id]);
        
        $trainedfirst = D("trainedfirstinfo");
        $trainedfirstmap['regtime'] = $_GET['regfirsttime'];
        $trainedfirstmap['regtime'] = $_GET['regfirsttime'];
        if($trainedfirst->add($trainedfirstmap)){
            $temp_id=$trainedfirst->field('id')->where($trainedfirstmap)->select();
            $trainedmap['dipid']=intval($temp_id[0][id]);
        } else {
            $this->error('添加失败') ;
        }
        $trained = D("trainedinfo");
        $trainedmap['trainid'] = "{$_GET['train']}";
        $trainedmap['covenantid'] = $_GET['covenant'];
        $trainedmap['regtime'] = $_GET['regtime'];
        $trainedmap['endtime'] = $_GET['endtime'];
        if($trained->add($trainedmap)){
            $this->success('添加成功') ;
        } else {
            $this->error('添加失败') ;
        }
    }
    public function searchInfo(){
        if($_GET['idnumber']){
            $map['idnumber'] = array('like', "%{$_GET['idnumber']}%");
        }
        if($_GET['realname']){
            $map['realname'] = array('like', "%{$_GET['realname']}%");
        }
//         if($_GET['holderid']){
//             $map['holderid'] = "{$_GET['holderid']}";
//         }
        if($_GET['nation']){
            $map['nation'] = "{$_GET['nation']}";
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
        $map['trainedfirstisdel'] = 0;
        $map['isdel'] = "0";
        
        $search = D("trainedfirstinfo");
        $count = $search->count();
        $Page=new \Think\Page($count,2);
        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录  每页<b>%LIST_ROW%</b>条  第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();
        $list=$search->join('ms_holdercomminfo ON ms_trainedfirstinfo.holderid = ms_holdercomminfo.id')->field('ms_trainedfirstinfo.id,idnumber,realname,regtime')->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        //$this->ajaxReturn($list);
        echo json_encode($list);
        $this->display();
    }
}