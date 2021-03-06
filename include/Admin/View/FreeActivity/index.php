﻿<!DOCTYPE HTML>
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
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>免费活动</title>
<style type="text/css">
.prev,.num,.current,.next{
    border: 1px solid #ccc;
    cursor: pointer;
    display: inline-block;
    margin-left:2px;
    text-align:center;
    text-decoration: none;
    color: #666;
    height: 26px;
    line-height: 26px;
    text-decoration: none;
    margin:0 0 6px 6px;
    padding:0 10px;
    font-size:14px;
}
.current{border:1px solid #666 !important;}
</style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 运营管理 <span class="c-gray en">&gt;</span> 免费活动    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container"><form action="" method="get">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" name="start_time" id="datemin" class="input-text Wdate" value="<?php echo $start_time?>" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})"  name="end_time" id="datemax" class="input-text Wdate" value="<?php echo $end_time?>" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="活动主题" id=""  value="<?php echo $search?>" name="search">
		<button type="submit" class="btn btn-success radius" id="" name="" value=""><i class="Hui-iconfont">&#xe665;</i> 查询 </button>
	</div></form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" id="delete" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i>批量删除</a> <a href="javascript:;"  data-title="添加活动" onclick="activity_add('添加活动','/admin/FreeActivity/add',800,800)" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加活动 </a></span> <span class="r">共有数据：<strong><?php echo $total;?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">好摄ID</th>
				<th width="100">认证类型</th>									
				<th width="150">活动主题</th>
				<th width="90">活动地址</th>
				<th width="200">活动起始时间</th>
				<th width="130">活动结束时间</th>
				<th width="70">活动类型</th>
				<th width="200">活动人数</th>
				<th width="80">活动状态</th>
				<th width="70">发布时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<?php foreach ($arr as $key => $val){?>
		<tbody>
			<tr class="text-c">
				<td id="del-<?php echo $val['id']?>"><input type="checkbox" value="<?php echo $val['id']?>" class="check" name="check"></td>
				<td><a href="javascript:viod(0)" id="member_show" onclick="member_show()"><?php echo $val['user_id']?></a></td>
				<td><?php if($val['user_id'] == 5){echo '官方';}else{echo $val['user_id'];}?></td>
				<td><?php echo $val['title']?></td>
				<td><?php echo $val['province'].$val['city'].$val['province'].$val['county'].$val['address']?></td>
				<td><?php echo date("Y-m-d H:i:s",$val['start_time'])?></td>
				<td><?php echo date('Y-m-d H:i:s',$val['end_time'])?></td>
				<td><?php echo $val['_title']?></td>
				<th width="200"><?php echo $val['participants']?> / <?php echo $val['need']?></th>
				<th width="80"><?php if($val['status'] == 1){echo '进行中';}elseif($val['status'] == 0){echo '未开始';}elseif($val['status'] == 2){echo '已结束';}?></th>
				<th width="70"><?php echo date("Y-m-d H:i:s",$val['create_time'])?></th>
				<td class="td-manage"><?php if($val['status'] != -1){?><a style="text-decoration:none" onClick="member_stop(this,'<?php echo $val['id']?>')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a><?php } if($val['status'] == -1){?> <a style="text-decoration:none" onClick="member_start(this,'<?php echo $val['id']?>')" href="javascript:;" title="启用"><i class="Hui-iconfont"><i class="Hui-iconfont">&#xe6e1;</i></i> </a><?php }?>
				| <a title="编辑" href="javascript:;"  onclick="activity_edit('修改活动','/admin/FreeActivity/edit?id=<?php echo $val['id']?>',800,800)" class="ml-5" style="text-decoration:none">编辑</a>
				<?php if($val['is_recommend'] == 0){?><a href="#" onClick="activity_recommended(this,'<?php echo $val['id']?>')">推荐</a><?php }else{?> 已推荐 <?php }?> <a title="查看" href="javascript:;"  onclick="activity_info('查看活动','/admin/Activity/info?id=<?php echo $val['id']?>',800,800)">查看</a>
				</td>
			</tr>
		</tbody>
		<?php }?>
	</table>
	
	<div style="line-height:66px;"><?php echo $page;?></div>
	
	</div>
</div>
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/lib/laypage/1.2/laypage.js"></script> 
<script type="text/javascript" src="/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script>

<script type="text/javascript">
$('.table-sort').dataTable({
	"lengthMenu":false,//显示数量选择 
	"bFilter": false,//过滤功能
	"bPaginate": false,//翻页信息
	"bInfo": false,//数量信息
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
	]
});
</script>
<script type="text/javascript">
$(function(){

	$('.table-sort tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});
	
});

function activity_recommended(obj,id){
	layer.confirm('确认要推荐吗？',function(index){
		$.get('/admin/Activity/recommended?id='+id,function(data){
		    layer.msg('已推荐!',{icon:1,time:1000});
		},'json');
	});
}

function activity_add(title,url,w,h){
	layer_show(title,url,w,h);
}

function activity_edit(title,url,w,h){
	layer_show(title,url,w,h);
}

function activity_info(title,url,w,h){
	layer_show(title,url,w,h);
}

$("#delete").click(function(){
	layer.confirm('确认要删除吗？',function(index){
		index = new Array();
		n = -1;
		$(".check").each(function(i,x){
		    if($(this).is(':checked')){
		    	n++;
		    	index[n] = $(this).val();
		    }
		});
		delID = JSON.stringify(index);
        $.post('/admin/FreedomActivity/del',{id:delID},function(data){
            $.each(index,function(m,n){
            	$("#del-"+n).parents("tr").remove();
            });           
		    layer.msg('已删除!',{icon:1,time:1000});
        },'json');	
	});
	
});

/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$.get('/admin/FreedomActivity/enb?id='+id,function(data){
		    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
		    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
		    $(obj).remove();
		    layer.msg('已停用!',{icon: 5,time:1000});
		},'json');
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$.get('/admin/FreedomActivity/start?id='+id,function(data){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!',{icon: 6,time:1000});
		},'json');
	});
}

</script> 
</body>
</html>