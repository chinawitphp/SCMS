<?php

    return array(
    'DEFAULT_THEME' => 'default',//使用的模板
    'URL_MODEL' => 2, // 如果你的环境不支持PATHINFO 请设置为3,设置为2时配合放在项目入口文件一起的rewrite规则实现省略index.php/
    'URL_CASE_INSENSITIVE' => true,//关闭大小写为true.忽略地址大小写
    'TMPL_CACHE_ON' => false,        // 是否开启模板编译缓存,设为false则每次都会重新编译
    'TMPL_STRIP_SPACE' => false,       // 是否去除模板文件里面的html空格与换行
    'TMPL_ACTION_SUCCESS'=>'Public:success',
    'TMPL_ACTION_ERROR'=>'Public:error',

    'APP_ROOT'=>str_replace(array('\\','Conf','config.php','//'), array('/','/','','/'), dirname(__FILE__)),//APP目录物理路径
    'WEB_ROOT'=>str_replace("\\", '/', substr(str_replace('\\Conf\\', '/', dirname(__FILE__)),0,-8)),//网站根目录物理路径
    'WEB_URL'=>"http://".$_SERVER['HTTP_HOST'],//网站域名
    'WEB_URL_SSL'=>"http://".$_SERVER['HTTP_HOST'],
    'CUR_URI'=>$_SERVER['REQUEST_URI'],//当前地址
);