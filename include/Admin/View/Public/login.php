<!doctype html>
<html lang="en" class="login-content" data-ng-app="materialAdmin">
 <head>
  <meta charset="UTF-8"> 
  <title>登录</title>
  <link href="/static/font-awesome/css/font-awesome.css?v=4.3.0" rel="stylesheet">
  <link href="/static/css/material-design-iconic-font/css/material-design-iconic-font.min.css" rel="stylesheet" type="text/css">
  <link href="/static/css/app.min.1.css" rel="stylesheet" type="text/css">
 </head>
 <body class="login-content" data-ng-controller="loginCtrl as lctrl">

    <div class="lc-block" id="l-login" data-ng-class="{'toggled':lctrl.login === 1}">
    	<h1 class="lean">Hoshot</h1>

    	<div class="input-group m-b-20">
    		<span class="input-group-addon">
    			<i class="zmdi zmdi-account"></i>
    		</span>
    		<div class="fg-line">
    			<input type="text"  name="username" id="account" class="form-control" placeholder="请输入帐号" regex="^\w{3,16}$"/>
    		</div>
    	</div>

        <div class="input-group m-b-20">
    		<span class="input-group-addon">
    			<i class="fa fa-unlock-alt fa-2x"></i>
    		</span>
    		<div class="fg-line">
    			<input type="password"  name="password" id="passwd" class="form-control" placeholder="请输入密码" regex="^\w+"/>
    		</div>
    	</div>
        
        <div class="input-group m-b-20">
    		<span class="input-group-addon">
    			<img title="点击刷新" width="120" height="30" class="verify" src="/admin/Public/verify">
    		</span>
    		<div class="fg-line">
    			<input type="text" name="verify" id="code" class="form-control" placeholder="请输入验证码" regex="^\w+"/>
    		</div>
    	</div>
    	
    	<div class="clearfix"></div>
    	
    	<div class="checkbox">
    		<label>
    			<input type="checkbox" value="" />
    			<i class="input-helper">
    				记住密码
    			</i>
    		</label>
            <a href="/Ucenter/Public/forget_password.html">忘记密码?</a>
    	</div>
        
    	<a id="button" href="javascript:viod(0)" class="btn btn-login btn-danger btn-float">
    		<i class="zmdi zmdi-arrow-forward"></i>
    	</a>
        
        <div class="login-navigation">
        	好摄V2.0后台管理系统 <a href="javascript:viod(0)">注册账号</a>
        </div>
    </div>
    
 </body>
 	
<script src="/static/JQuery/jquery-1.8.3.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$(".verify").click(function(){
		var newUrl=$(this).attr("src");
        $(this).attr("src",newUrl);
	});
	$("#button").click(function(){
		var $account = $("#account").val();
		var $passwd  = $("#passwd").val();
		var $code    = $("#code").val();
		$.post("/admin/Public/login",{username:$account,password:$passwd,verify:$code},function(ret){					
			if(ret.status == 1) location.href = ret.url;
			else alert(ret.info);
		},"json");
	});
});
</script>
	<!-- Angular -->
	<script src="/static/js/bower_components/angular/angular.min.js"></script>
	<script src="/static/js/bower_components/angular-resource/angular-resource.min.js"></script>
	<script src="/static/js/bower_components/angular-animate/angular-animate.min.js"></script>
	
	
	<!-- Angular Modules -->
	<script src="/static/js/bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
	<script src="/static/js/bower_components/angular-loading-bar/src/loading-bar.js"></script>
	<script src="/static/js/bower_components/oclazyload/dist/ocLazyLoad.min.js"></script>
	<script src="/static/js/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
	
	<!-- Common js -->
	<script src="/static/js/bower_components/angular-nouislider/src/nouislider.min.js"></script>
	<script src="/static/js/bower_components/ng-table/dist/ng-table.min.js"></script>
	
	<!-- Placeholder for IE9 -->
	<!--[if IE 9 ]>
	    <script src="js/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
	<![endif]-->
	<!-- App level -->
	<script src="/static/js/app.js"></script>
	<script src="/static/js/controllers/main.js"></script>
	
</html>