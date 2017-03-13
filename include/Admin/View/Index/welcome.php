<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>我的桌面</title>
</head>
<body>
<div class="page-container">

	<p class="f-20 text-success">欢迎回来，<?php echo $_SESSION['hoshot_admin']['user_auth']['account']?> <span class="f-14">hoshot v2.0</span></p>
        <p>登录次数：<?php echo $_SESSION['hoshot_admin']['user_auth']['count_login'];?> </p>
	<p>上次登录IP：<?php echo $_SESSION['hoshot_admin']['user_auth']['last_login_ip'];?>  上次登录时间：<?php echo date("Y-m-d H:i:s",$_SESSION['hoshot_admin']['user_auth']['last_login_time']);?></p>

	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th colspan="7" scope="col">信息统计</th>
			</tr>
			<tr class="text-c">
				<th>统计</th>
				<th>活动库</th>
				<th>图片库</th>
				<th>作品库</th>
				<th>用户</th>
				<th>管理员</th>
			</tr>
		</thead>
		<tbody>
			<tr class="text-c">
				<td>总数</td>
				<td><?php echo $data['act']['total'];?></td>
				<td><?php echo $data['images']['total'];?></td>
				<td><?php echo $data['works']['total'];?></td>
				<td><?php echo $data['user']['total'];?></td>
				<td><?php echo $data['admin']['total'];?></td>
			</tr>
			<tr class="text-c">
				<td>今日</td>
				<td><?php echo $data['act']['today'];?></td>
				<td><?php echo $data['images']['today'];?></td>
				<td><?php echo $data['works']['today'];?></td>
				<td><?php echo $data['user']['today'];?></td>
				<td><?php echo $data['admin']['today'];?></td>
			</tr>
			<tr class="text-c">
				<td>昨日</td>
				<td><?php echo $data['act']['yesterday'];?></td>
				<td><?php echo $data['images']['yesterday'];?></td>
				<td><?php echo $data['works']['yesterday'];?></td>
				<td><?php echo $data['user']['yesterday'];?></td>
				<td><?php echo $data['admin']['yesterday'];?></td>
			</tr>
			<tr class="text-c">
				<td>本周</td>
				<td><?php echo $data['act']['week'];?></td>
				<td><?php echo $data['images']['week'];?></td>
				<td><?php echo $data['works']['week'];?></td>
				<td><?php echo $data['user']['week'];?></td>
				<td><?php echo $data['admin']['week'];?></td>
			</tr>
			<tr class="text-c">
				<td>本月</td>
				<td><?php echo $data['act']['month'];?></td>
				<td><?php echo $data['images']['month'];?></td>
				<td><?php echo $data['works']['month'];?></td>
				<td><?php echo $data['user']['month'];?></td>
				<td><?php echo $data['admin']['month'];?></td>
			</tr>
		</tbody>
	</table>
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr>
				<th colspan="2" scope="col">服务器信息</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>服务器IP地址</td>
				<td><?php echo $_SERVER['SERVER_ADDR']?></td>
			</tr>
			<tr>
				<td>服务器域名</td>
				<td><?php echo $_SERVER['HTTP_HOST']?></td>
			</tr>
			<tr>
				<td>服务器端口 </td>
				<td><?php echo $_SERVER['SERVER_PORT']?></td>
			</tr>
			<tr>
				<td>本文件所在文件夹 </td>
				<td><?php echo $_SERVER['DOCUMENT_ROOT']?></td>
			</tr>
			<tr>
				<td>服务器操作系统 </td>
				<td><?php echo PHP_OS?></td>
			</tr>
			<tr>
				<td>服务器的语言种类 </td>
				<td><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE']?></td>
			</tr>
			<tr>
				<td>服务器当前时间 </td>
				<td><?php echo date("Y-m-d H:i:s");?></td>
			</tr>
			<tr>
				<td>虚拟内存 </td>
				<td><?php echo memory_get_peak_usage(true);?></td>
			</tr>
		</tbody>
	</table>
</div>
<footer class="footer mt-20">
	<div class="container">
		<p>感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br>
			Copyright &copy;2015 hoshot.admin v2.0 All Rights Reserved.<br>
			本后台系统由<a href="http://www.hoshot.cn/" target="_blank" title="hoshot">hoshot</a>提供前端技术支持</p>
	</div>
</footer>
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/h-ui/js/H-ui.js"></script> 
</body>
</html>