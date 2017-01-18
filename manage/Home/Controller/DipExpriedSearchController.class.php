<?php
namespace Home\Controller;
class DipExpriedSearchController extends AuthorityController {
    public function Index(){
        $dipname = D("expiredtime");
        $list=$dipname->select();
        //var_dump($list);
         $this->assign('dip', $list);
         $this->display();
    }
    
    public function Search(){
        $diptype="{$_GET['type']}";
        $timemap['id'] = $diptype;
        $exptime = D("expiredtime");
        $commmontime=$exptime->select();
        foreach ($commmontime as $key=>$val){
            if($commmontime[$key]['id'] == '100' && $expmouth == ''){
                $expmouth == $commmontime[$key]['expiredtime'];
            }
            if($diptype == $commmontime[$key]['id']){
                $expmouth= $commmontime[$key]['expiredtime'];
            } 
        }
        if($_GET['idnumber']){
            $map['idnumber'] = array('like', "%{$_GET['idnumber']}%");
        }
        if($_GET['realname']){
            $map['realname'] = array('like', "%{$_GET['realname']}%");
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
        //获取当日时间，月份+提醒月份，通过比较符合条件的结果过期日期与加后日期大小即可知道是否临近过期
        $timenow=date("y-m-d",time()); //2010-08-29
        $temptimeend=explode("-",$timenow);
        $temptimeend[0]='20'.$temptimeend[0];
        $timeexpiredtoday=mktime(0,0,0,$temptimeend[1],$temptimeend[2],$temptimeend[0]);
        $timeexpirednow=mktime(0,0,0,intval($temptimeend[1])+$expmouth,$temptimeend[2],$temptimeend[0]);
        $map['regtime'] = array('between', array(date('Y-m-d',$timestampstart),date('Y-m-d',$timestampend)));
        //2为已过期 1为临近过期 0为正常
        switch ($diptype)
        {
            case 1:
                $search = D("seameninfo");
                $list=$search->join('ms_holdercomminfo ON ms_seameninfo.holderid = ms_holdercomminfo.id')->field('ms_seameninfo.id,idnumber,realname,regtime,endtime')->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
                foreach ($list as $key=>$val){
                    $list[$key][dipname]= "海员船员培训合格证书";
                    $tempregend=explode("-",$list[$key]['endtime']);
                    $regstampend=mktime(0,0,0,$tempregend[1],$tempregend[2],$tempregend[0]);
                    if($regstampend<$timeexpiredtoday){
                        $list[$key][isexp]= 2;
                    } elseif($regstampend<$timeexpirednow){
                        $list[$key][isexp]= 1;
                        $list[$key][expmouth] = ($tempregend[0]-$temptimeend[0])*12 +$tempregend[1]-$temptimeend[1];
                    } else{
                        $list[$key][isexp]= 0;
                        $list[$key][expmouth] = ($tempregend[0]-$temptimeend[0])*12 +$tempregend[1]-$temptimeend[1];
                    }
                }  
                array_unshift($list,array("num"=>"111","color"=>"ori"));
                echo json_encode($list);
                break;
            case 2:
                $search = D("qualifyinfo");
                $list=$search->join('ms_holdercomminfo ON ms_qualifyinfo.holderid = ms_holdercomminfo.id')->field('ms_qualifyinfo.id,idnumber,realname,regtime,endtime')->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
                //var_dump($list);
                foreach ($list as $key=>$val){
                    $list[$key][dipname]= "海员船员适任证书";
                    $tempregend=explode("-",$list[$key]['endtime']);
                    $regstampend=mktime(0,0,0,$tempregend[1],$tempregend[2],$tempregend[0]);
                    if($regstampend<$timeexpiredtoday){
                        $list[$key][isexp]= 2;
                    } elseif($regstampend<$timeexpirednow){
                        $list[$key][isexp]= 1;
                    } else{
                        $list[$key][isexp]= 0;
                    }
                }
                echo json_encode($list);
                break;
            case 3:
                echo "Number 3";
                break;
            default:
                echo "证件类型错误";
        }
    }
}