<?php
namespace Home\Controller;
use Think\Controller;
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET,POST");
class AuthorityController extends Controller
{
    
    //权限验证
    function _initialize()
    {
       // var_dump($_SESSION); 

         $rbac=new \Org\Util\Rbac();  
    //检测是否登录，没有登录就打回设置的网关  
       $rbac::checkLogin();  
       //检测是否有权限没有权限就做相应的处理  
if(!$rbac::AccessDecision()){  
    echo '<script type="text/javascript">alert("没有权限");</script>';  
    die();  
}  
    }

}
