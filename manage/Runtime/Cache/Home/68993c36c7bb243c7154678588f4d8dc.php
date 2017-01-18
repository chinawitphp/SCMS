<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>海员船员资格证管理系统</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/style-seaman.css">
	<script type="text/javascript" src="/Public/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/Public/js/bootstrap.js"></script>
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
				 <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href=""><?php echo ($vo["username2"]); ?></a></li>
				<li><a href=""><?php echo ($vo["root"]); ?></a></li>
				<li><a href="../enter/login">退出</a></li><?php endforeach; endif; else: echo "" ;endif; ?>
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
			    <li><a href="../index/personal_information.html"><span class="glyphicon glyphicon-comment"></span>个人信息</a></li>
				<li><a href="../index/change_password.html"><span class="glyphicon glyphicon-leaf"></span>修改密码</a></li>
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
				<li><a href="../messagemanage/user_add"><span class="glyphicon glyphicon-plus"></span>添加用户</a></li>
				<li><a href="../messagemanage/user_manage"><span class="glyphicon glyphicon-th"></span>用户管理</a></li>
				<li><a href="../messagemanage/user_information"><span class="glyphicon glyphicon-th-list"></span>常用成员信息</a></li>
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
				<li><a href="./seaman_input.html"><span class="glyphicon glyphicon-pencil"></span>录入</a></li>
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
<div class="col-md-10 col-md-offset-3 main-content">
<div class="row">
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">常用成员信息</h3>
			</div>
			<div class="panel-body">
				<form role="form" class="form-horizontal" action="../messagemanage/userinformation" method="post">
				    <div class="form-group">
				    	<label class="col-sm-2 control-label" for="field-1">姓名</label>
				    	<div class="col-sm-3">
				    		<input type="text" name="username" class="form-control pass_change" id="field-1" placeholder="请输入真实姓名" required="required">
				    	</div>
				    	<label class="col-sm-2 control-label">性别</label>
				    	<div class="col-sm-3 select_user">
                                            <select class="form-control input-lg" name="sex">
				    		<option value="1">男</option>
                                                <option value="0">女</option>
				    	</select>
				    	</div>
				    </div>
				    <div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-2">身份证号</label>
						<div class="col-sm-4">
							<input type="text" name="id" class="form-control pass_change" id="field-2" placeholder="请输入身份证号" value="">
						</div>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group">
                                            <button type="submit" class="btn btn-info btn-single btn-lg">查询</button>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group-separator"></div>
					<div class="form-group">
                                            
					</div>
				</form>
				<form role="form" class="form-horizontal" action="http://localhost/seauser/index.php/home/messagemanage/userinformation_delete" method="post">
                                    <button type="submit" class="btn btn-info btn-single btn-lg">删除</button>
				    <div class="form-group">
					<div class="table-responsive">
							<table cellspacing="0" class="table table-small-font table-bordered table-striped">
								<thead>
								<tr>
									<th><input type="checkbox" name="check_all" onclick="all_check()">全选</th>
									<th>姓名</th>
									<th>身份证号</th>
									<th>性别</th>
									<th>出生日期</th>
									<th></th>
								</tr>
								</thead>
								<tbody>
							       <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$do): $mod = ($i % 2 );++$i;?><tr>
							        <th><input type="checkbox" name="one"></th>
							    	<th><?php echo ($do["username"]); ?></th>
							    	<th><?php echo ($do["id"]); ?></th>
							    	<th><?php echo ($do["sex"]); ?></th>
							    	<th><?php echo ($do["birth"]); ?></th>
							    </tr><?php endforeach; endif; else: echo "" ;endif; ?> 
								</tbody>
							</table>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group-separator"></div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</body>
</html>