<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>活动图片</title>
<link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/style.css" />

</head>

<body>
<?php foreach ($images as $key => $val){?>
<img src="<?php echo $val['path']?>" alt="" width="500" height="300" style="margin-left: 50px; margin-top:30px" />
<?php }?>
</body>
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
</html>
