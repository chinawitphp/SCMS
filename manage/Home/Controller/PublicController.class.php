<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
       public function verify(){
           ob_clean ();
       $Verify = new \Think\Verify();
       $Verify->fontSize=25;
       $Verify->length=4;
       $Verify->useNoise=false;
       $Verify->codeset='0123456789';
       $Verify->imageW=200;
       $Verify->imageH=50;
       $Verify->entry();     
       }    
       function check_verify($code){
    $verify = new \Think\Verify();
    return $verify->check($code);
}
}