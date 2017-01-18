// sidebar选择开始
	function openMenu(type){
		switch(type)
		{
		 case 'menu_1':
		   $("#menu1").slideToggle(300,function(){
		   });
		 break;
		 case 'menu_2':
		   $("#menu2").slideToggle(300,function(){
		   });
		 break;
		 case 'menu_3':
		   $("#menu3").slideToggle(300,function(){
		   });
		 break;
		 case 'menu_4':
		   $("#menu4").slideToggle(300,function(){
		   });
		 break;
		 case 'menu_5':
		   $("#menu5").slideToggle(300,function(){
		   });
		 break;
		 case 'menu_6':
		   $("#menu6").slideToggle(300,function(){
		   });
		 break;
		 case 'menu_7':
		   $("#menu7").slideToggle(300,function(){
		   });
		 break;
		 case 'menu_8':
		   $("#menu8").slideToggle(300,function(){
		   });
		 break;
		 case 'menu_9':
		   $("#menu9").slideToggle(300,function(){
		   });
		 break;
		 default:break;
		}
	}
// sidebar选择结束
// login开始
   function login(){
   	alert("123");
   	var userName=$("input[name='username']").val();
   	var passWord=$("input[name='password']").val();
  	alert(userName);
  	alert(passWord);
   	$.ajax({
   		type:"POST",
   		url:"test.php",
   		data:"login_name="+escape(userName)+"pass_word="+escape(passWord),
   		success:function(msg){
   			if (msg=="1") {
   				alert("000");
   			}
   		},
   	}).done(function(msg){
   		alert("0000");
   	});
 
   }
// login结束
// seaman-input-addIndex开始
   // function addIndex(){
   // 	$.ajax({
   // 		type:"GET",
   // 		url:"./index.php/home/seamenManage/infoDetail/?id=8&type=app",
   // 		//jsonp:"callback",
   // 		dataType:"json",
   // 		success:function(msg){
   // 			alert("msg");
   // 		},
   // 		error:function(){
   // 			alert("有错误");
   // 		},
   // 	});
   // 	// $.get("/index.php/home/seamenManage/getCommInfo/?idnumber=9551&realname=zxc&nation=china&birtharea=china&signorgid=1&regtime=2015-09-14&endtime=2015-09-14&holderid=123",
   // 	// 	{},function(data,status){
   // 	// 		console.log(data);
   // 	// 		console.log(status);
   // 	// 	})
   // };
// seaman-input-addIndex结束
// seaman-input-ID card开始
//--------------更新： 2016.11.1---------------------------
function id_card(){
	var card=$("input[name='card']").val();
	if (card.length==18){
		var year=card.substr(6,4);
		var month=card.substr(10,2);
		var day=card.substr(12,2);
		var sex=card.substr(15,2);
	}
	$("input[name='birth']").val(year+"-"+month+"-"+day);
	if (sex%2==0){
		$("select[name='sex']").val("女");
	}
	else{
		$("select[name='sex']").val("男");
	}
}
// seaman-input-ID card结束
// user-manage-checkbox 全选功能开始
function all_check(){
	var check_all=$("input[name='check_all']");
	var check_list=$("input[name='check_list']");
	 if (check_all[0].checked==true){
		for (var i=0;i<check_list.length;i++){
			check_list[i].checked=true;
	}}
	else{
		for (var i=0;i<check_list.length;i++){
		check_list[i].checked=false;
	}}
}
// user-manage-checkbox 全选功能结束
// ------------更新：2016.11.5-------------------
function seaman_check(){
	//var htmlstr="";
	//htmlstr+="<div class=\"table-responsive\">"+"<table cellspacing=\"0\" class=\"table table-small-font table-bordered table-striped\">"+"<thead><tr><th>身份证号</th><th>持证人姓名</th><th>性别</th><th>有效期至</th><th>操作</th></tr></thead><tbody></tbody></table></div><div id=\"page\"></div>"
	//$("div[name='detail']").html(htmlstr);
	$("div.no_display").css({"display":"inline"});
	var idnumber="?idnumber="+$("input[name='card']").val();
	var realname="&realname="+$("input[name='name']").val();
	var nation="&nation="+$("input[name='country']").val();
	var birtharea="&birtharea="+$("select[name='area']").val();
	var signorgid="&signorgid="+$("input[name='sign_id']").val();
	var regtimebegin="&regtimebegin="+$("input[name='regtime_begin']").val();
	var regtimeend="&regtimeend="+$("input[name='regtime_end']").val();
	var endtimebegin="&endtimebegin="+$("input[name='endtime_begin']").val();
	var endtimeend="&endtimeend="+$("input[name='endtime_end']").val();
	var param=idnumber+realname+nation+birtharea+signorgid+regtimebegin+regtimeend+endtimebegin+endtimeend;
	$.ajax({
		type:"GET",
		url:"http://123.56.236.250/index.php/home/seamenManage/searchinfo/"+param,
		dataType:"json",
		success:function(msg){
			//console.log(msg);
			var in_html="";
			for (var i=0;i<msg.length;i++){
				var check_id=msg[i].id;
				var check_idnumber=msg[i].idnumber;
				var check_realname=msg[i].realname;
				var sex_id=check_idnumber.substr(15,2);
				var check_sex=(sex_id%2==0)?"女":"男";
				var check_time=msg[i].endtime;
				//pass_param(check_id);
				in_html+="<tr><th>"+check_idnumber+"</th><th>"+check_realname+"</th><th>"+check_sex+"</th><th>"+check_time+"</th><th onclick='"+pass_param(check_id)+"'><a>详细</a></th></tr>";
				
			}
			$("tbody#in_html").html(in_html);
		},
	});
	// 翻页功能开始
	$("#page").Page({
	   totoalPages:9,
	   liNums:7,
	   activeClass:"activP",
	   callBack:function(page){
		   //console.log(page);
	    }
      });
	// 翻页功能结束
	
}

function pass_param(id){
	//console.log(id);
	var x='';
	x='into_detail('+id+')';
	return x;
}

function into_detail(id){
	 //console.log(id);
	 window.location.href="../infoDetail.html?"+id;
}

// -----------------更新：2016.12.3----------------------
$(function(){
	
	// $("#in_html").on('click',"#get_detail",function(){
	// 	console.log(this);

	// });

})
// -----------------更新：2016.12.7----------------------
function check_expired(){
	var diptype="type="+$("select[name='dip_card']").val();
	var idnumber="&idnumber="+$("input[name='card']").val();
	var realname="&realname="+$("input[name='name']").val();
	var regtimebegin="&regtimebegin"+$("input[name='reg_time']").val();
	var regtimeend="regtimeend"+$("input[name='end_time']").val();
	var param=diptype+idnumber+realname+regtimebegin+regtimeend;
	$.ajax({
		type:"GET",
		url:"http://123.56.236.250/index.php/home/DipExpriedSearch/Search/?"+param,
		dataType:"json",
		success:function(msg){
			var color_code=msg[0].color;//临近过期的颜色
			var in_html="";
			for (var i=1;i<msg.length;i++){
				var id=msg[i].id;
				var idnumber=msg[i].idnumber;
				var realname=msg[i].realname;
				var regtime=msg[i].regtime;
				var endtime=msg[i].endtime;
				var dipname=msg[i].dipname;
				var isexp=msg[i].isexp;
				var color="";
				var expmouth="";
				if (isexp==1){
					color=color_code;
					expmouth=msg[i].expmouth;
				}
				else if (isexp==2){
					color="#39CCCC";//过期的颜色
				}
				else if (isexp==0){
					color="#00FFFF";//正常的颜色
				}
				in_html+="<tr style='background-color:"+color+"'><th>"+dipname+"</th><th>"+realname+"</th><th>"+idnumber+"</th><th>"+regtime+"</th><th>"+endtime+"</th><th>"+expmouth+"</th></tr>";
			}
			$("tbody#in_html").html(in_html);
		},
	});
		$("#page").Page({
		   totoalPages:9,
		   liNums:7,
		   activeClass:"activP",
		   callBack:function(page){
			   //console.log(page);
		    }
	      });
}
// -----------------更新：2016.12.15----------------------