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
    
        //rbac
        // 配置文件增加设置
        //是否需要认证，设置为true时$rbac::AccessDecision()函数才会根据当前的操作检查权限并返回true或false，，设为false只返回true
        'USER_AUTH_ON'     =>    true,
        //认证类型,2代表每次进行操作的时候都会数据库取出权限(权限更改即时生效)，1代表只在登录的时候取出权限(权限更改下次登录时生效)
        'USER_AUTH_TYPE'     =>    1,
        //认证识别号,执行$rbac::saveAccessList();的时候回用以这个为键值的session去数据库取权限
        'USER_AUTH_KEY' =>    'userid',
        //认证网关,执行$rbac::checkLogin()函数(检查是否登录),如果没有登录，去到这个设置的网址(当前url直接加上这个设置的值)
        'USER_AUTH_GATEWAY' =>'/Login',
        //数据库连接DSN???
        //'RBAC_DB_DSN'  =>,
        //角色表名称
        'RBAC_ROLE_TABLE' =>'ms_role',
        //用户表名称(rbac类说的是用户表，其实是用户角色关联表)
        'RBAC_USER_TABLE' =>'ms_role_user',
        //权限表名称
        'RBAC_ACCESS_TABLE' =>'ms_access',
        //节点表名称
        'RBAC_NODE_TABLE' =>'ms_node',
        //定义rbac超级管理员,登录成功之后把用户名和这个值进行比对，一样就是超级管理员
        'RBAC_SUPERADMIN'   =>  'admin',
        //超级管理员识别,当当前用户是超级管理员时，把键值为这个值的session这个设置为true，当前用户就能进行一切操作
        'ADMIN_AUTH_KEY'    =>  'superadmin',
);