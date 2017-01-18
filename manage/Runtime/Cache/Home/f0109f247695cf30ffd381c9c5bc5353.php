<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>登陆</title>
<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="/Public/css/style-seaman.css">
<script type="text/javascript" src="/Public/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/js/seaman.js"></script>
<style type="text/css">
    *{
    	font-family: 微软雅黑;
    }
	.login{
	margin: 150px auto 0 auto;
    margin-left: auto;
    margin-right: auto;
    min-height: 420px;
    max-width: 420px;
    background-color: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-sizing: border-box;
	}
	.message {
    margin: 10px 0 0 -60px;
    padding: 18px 10px 18px 60px;
    background: #39CCCC;
    position: relative;
    color: #fff;
    font-size: 20px;
    }
	body{
		background: url(/Public/timg.jpg) ;
		/*background-repeat: no-repeat;*/
		background-size: cover;
	}
	#darkbanner{
		background: url(./images/aiwrap.png);
		/*background-image: url();*/
		width: 18px;
		height: 10px;
		margin: 0 0 30px -58px;
		position: relative;
	}
	/*input[type=text],
	input[type=file],
	input[type=password],
	input[type=email], select {
	    border: 1px solid #DCDEE0;
	    vertical-align: middle;
	    border-radius: 3px;
	    height: 50px;
	    padding: 0px 16px;
	    font-size: 14px;
	    color: #555555;
	    outline:none;
	    width:100%;
	}*/
	
	

</style>
</head>
<body>
<div class="login">
	<div class="message">海员船员资格证管理系统</div>
	<div id="darkbanner"></div>
	<form method="post" action="../enter/enter">
		<input type="hidden" name="action" value="login">
		<input type="text" name="username" placeholder="用户名" required="required" class="user_name" value="">
		<hr class="hr15">
		<input type="password" name="password" placeholder="密码" required="required" class="pass_word" value="">
        <hr class="hr15">
        <input type="text" name="verify" placeholder="验证码" required="required" class="verify">
        <img src="<?php echo U('Home/Public/verify',array());?>" onClick="this.src=this.src+'?'+Math.random()">
        <hr class="hr15">
        <input type="submit" name="login_button" value="登陆" onclick="">
        <hr class="hr20">
        <a onclick="alert('请联系管理员或超级管理员')">忘记密码?</a>
	</form>
</div>
</body>
</html>