<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>海员船员资格证管理系统</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/style-seaman.css">
	<script type="text/javascript" src="/Public/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/Public/js/seaman.js"></script>
</head>
<body>
<div class="header">
	<div class="container">
		<div class="logo">
			<a href="./personal_information.html"><h1>海员船员资格证管理系统</h1></a>
		</div>
		<div class="navigation">
			<ul>
				<li><a href="">张三</a></li>
				<li><a href="">超级管理员</a></li>
				<li><a href="">退出</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="col-md-3 sidebar">
	<div class="drop-navigation">
		<ul class="nav nav-sidebar">
			<li><a href="#" onclick="openMenu('menu_1')"><span class="glyphicon glyphicon-user"></span>用户信息<span class="glyphicon
			 glyphicon-chevron-down"></span></a></li>
			<ul id="menu1"><!-- 哈哈 onclick自定义传值，修改自定义id的显示与否，用jq的.slideToggle() -->
			    <li><a href="./personal_information.html"><span class="glyphicon glyphicon-comment"></span>个人信息</a></li>
				<li><a href="./change_password.html"><span class="glyphicon glyphicon-leaf"></span>修改密码</a></li>
			</ul>
			<!-- <script type="text/javascript">
				$("li a.menu").click(function(){
					$("ul.cl-effect-1").slideToggle(300,function(){
						//href如果不链接#，而是空值的话，click之后就会刷新页面，就像是href抵消了一次click
					});
				});
			</script> -->
			<li><a href="#" onclick="openMenu('menu_2')"><span class="glyphicon glyphicon-file"></span>用户信息管理<span class="glyphicon
			 glyphicon-chevron-down"></span></a></li>
			<ul id="menu2">
				<li><a href="./user_add.html"><span class="glyphicon glyphicon-plus"></span>添加用户</a></li>
				<li><a href="./user_manage.html"><span class="glyphicon glyphicon-th"></span>用户管理</a></li>
				<li><a href="./user_information.html"><span class="glyphicon glyphicon-th-list"></span>常用成员信息</a></li>
			</ul>
			<li><a href="#" onclick="openMenu('menu_3')"><span class="glyphicon glyphicon-file"></span>海船船员培训合格证书管理<span class="glyphicon
			 glyphicon-chevron-down"></span></a></li>
			<ul id="menu3">
				<li><a href="./train_input.html"><span class="glyphicon glyphicon-pencil"></span>录入</a></li>
				<li><a href="./train_check.html"><span class="glyphicon glyphicon-search"></span>查询</a></li>
				<li><a href="./train_detail.html"><span class="glyphicon glyphicon-stats"></span>详细</a></li>
			</ul>
			<li><a href="#" onclick="openMenu('menu_4')"><span class="glyphicon glyphicon-file"></span>海船船员健康证书管理<span class="glyphicon
			 glyphicon-chevron-down"></span></a></li>
			<ul id="menu4">
				<li><a href="./health_input.html"><span class="glyphicon glyphicon-pencil"></span>录入</a></li>
				<li><a href="./health_check.html"><span class="glyphicon glyphicon-search"></span>查询</a></li>
				<li><a href="./health_detail.html"><span class="glyphicon glyphicon-stats"></span>详细</a></li>
			</ul>
			<li><a href="#" onclick="openMenu('menu_5')"><span class="glyphicon glyphicon-file"></span>海船船员适任证书管理<span class="glyphicon
			 glyphicon-chevron-down"></span></a></li>
			<ul id="menu5">
				<li><a href="./qualify_input.html"><span class="glyphicon glyphicon-pencil"></span>录入</a></li>
				<li><a href="./qualify_check.html"><span class="glyphicon glyphicon-search"></span>查询</a></li>
				<li><a href="./qualify_detail.html"><span class="glyphicon glyphicon-stats"></span>详细</a></li>
			</ul>
			<li><a href="#" onclick="openMenu('menu_6')"><span class="glyphicon glyphicon-file"></span>海员证管理<span class="glyphicon
			 glyphicon-chevron-down"></span></a></li>
			<ul id="menu6">
				<li><a href="/Home/SeamenManage/addIndex/"><span class="glyphicon glyphicon-pencil"></span>录入</a></li>
				<li><a href="./seaman_check.html"><span class="glyphicon glyphicon-search"></span>查询</a></li>
				<li><a href="./seaman_detail.html"><span class="glyphicon glyphicon-stats"></span>详细</a></li>
			</ul>
			<li><a href="#" onclick="openMenu('menu_7')"><span class="glyphicon glyphicon-file"></span>护照管理<span class="glyphicon
			 glyphicon-chevron-down"></span></a></li>
			<ul id="menu7">
				<li><a href="./passport_input.html"><span class="glyphicon glyphicon-pencil"></span>录入</a></li>
				<li><a href="./passport_check.html"><span class="glyphicon glyphicon-search"></span>查询</a></li>
				<li><a href="./passport_detail.html"><span class="glyphicon glyphicon-stats"></span>详细</a></li>
			</ul>
			<li><a href="./expired_check.html"><span class="glyphicon glyphicon-zoom-in"></span>证书过期情况查询</a></li>
			<li><a href="#" onclick="openMenu('menu_8')"><span class="glyphicon glyphicon-time"></span>日志管理<span class="glyphicon
			 glyphicon-chevron-down"></span></a></li>
			<ul id="menu8">
				<li><a href="./log_manage.html"><span class="glyphicon glyphicon-search"></span>日志查询</a></li>
			</ul>
			<li><a href="#" onclick="openMenu('menu_9')"><span class="glyphicon glyphicon-cog"></span>参数设置<span class="glyphicon
			 glyphicon-chevron-down"></span></a></li>
			<ul id="menu9">
				<li><a href="./set_time.html"><span class="glyphicon glyphicon-bell"></span>提醒时间设置</a></li>
				<li><a href="./set_type.html"><span class="glyphicon glyphicon-bookmark"></span>证书种类设置</a></li>
				<li><a href="./set_name.html"><span class="glyphicon glyphicon-font"></span>培训合格证名称设置</a></li>
				<li><a href="./set_sign.html"><span class="glyphicon glyphicon-briefcase"></span>签发机关管理</a></li>
				<li><a href="./set_limit.html"><span class="glyphicon glyphicon-ban-circle"></span>适用的限制</a></li>
				<li><a href="./set_level.html"><span class="glyphicon glyphicon-tower"></span>等级与职务</a></li>
				<li><a href="./set_item.html"><span class="glyphicon glyphicon-book"></span>公约条款</a></li>
				<li><a href="./set_department.html"><span class="glyphicon glyphicon-list"></span>部门设置</a></li>
			</ul>
		</ul>
		<div class="side-bottom"></div>
	</div>
</div>
<div class="col-md-9 col-md-offset-3 main-content ">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title">签发机关管理</h3></div>
				<div class="panel-body">
					<div class="table-responsive">
						<table cellspacing="0" class="table table-small-font table-bordered table-striped">
							<thead>
							<tr>
								<th>签发机关名称</th>
								<th>操作</th>
							</tr>
							</thead>
							<tbody>
						    <?php if(is_array($org)): foreach($org as $key=>$vo): ?><tr>
						    	<th><?php echo ($vo["ms_signorgname"]); ?></th>
						    	<th> 
						    	<form name="input" action="/home/sign_org_set/edit/?id=<?php echo ($vo["id"]); ?>&signorgname=edittest" method="post">
								<input type="submit" value="修改"  /><br/>
								</form></th>
						    	<th>删除</th>
						    </tr><?php endforeach; endif; ?>
						    <tr>
						    	<th></th>
						    	<th></th>
						    	<th>新增</th>
						    </tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>