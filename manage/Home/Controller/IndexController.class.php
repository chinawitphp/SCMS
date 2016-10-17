<?php
namespace Home\Controller;
class IndexController extends AuthorityController {
    
    //权限验证&菜单栏生成
    public function index(){
        /* if (!session("groupid")) {
            $this->redirect('Home/Login');
            exit; 
        } 
        var_dump('验证通过');*/
        
    }
    //登出
    public function logout()
    {
        session(null);
        Writelog($_SESSION('username'),"logout", mktime(),get_client_ip(), "退出成功");
        $this->success('注销成功', "Home/Login");
    }
}