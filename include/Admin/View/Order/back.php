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
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>退单管理</title>
<style type="text/css">
.prev,.num,.current,.next{
    border: 1px solid #ccc;
    cursor: pointer;
    display: inline-block;
    margin-left: 2px;
    text-align: center;
    text-decoration: none;
    color: #666;
    height: 26px;
    line-height: 26px;
    text-decoration: none;
    margin: 0 0 6px 6px;
    padding: 0 10px;
    font-size: 14px;
}
.current{border: 1px solid #666 !important;}
</style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 退单管理  <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container"><form action="" method="get">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" name="start_time" id="datemin" class="input-text Wdate" value="<?php echo $start_time?>" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})"  name="end_time" id="datemax" class="input-text Wdate" value="<?php echo $end_time?>" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="退单名称" id=""  value="<?php echo $search?>" name="search">
		<button type="submit" class="btn btn-success radius" id="" name="" value=""><i class="Hui-iconfont">&#xe665;</i> 查询 </button>
	</div></form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" id="delete" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span> <span class="r">共有数据：<strong><?php echo $total;?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="100">退单编号</th>
				<th width="80">好摄ID</th>				
				<th width="90">用户昵称</th>					
				<th width="150">退单名称</th>
				<th width="200">退单金额</th>
				<th width="130">申请时间</th>
				<th width="80">退单状态</th>
				<th width="70">退款金额</th>
				<th width="200">已发生费用</th>
				<th width="200">操作人</th>
				<th width="200">操作时间</th>
				<th width="70">备注</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<?php foreach ($arr as $key => $val){?>
		<tbody>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $val['_id']?>" class="check" name="check"></td>
				<td><a href="javascript:viod(0)" id="member_show" onclick="member_show()"><?php echo $val['_order_number']?></a></td>
				<td><?php echo $val['user_id']?></td>
				<td><?php echo getNickname($val['user_id'])?></td>
				<td><?php echo $val['order_title']?></td>
				<td><?php echo $val['back_money']?></td>
				<td><?php echo date("Y-m-d H:i:s",$val['submit_time'])?></td>
				<td><?php if($val['_status'] == 1){echo '已退款';}elseif($val['_status'] == 0){echo '已关闭';}elseif($val['_status'] == 2){echo '申请退款';}?></td>								
				<th width="200"><?php echo $val['back_money']?></th>
				<th width="200"><?php echo $val['insurance_order']?></th>
				<th width="200"><?php echo get_admin($val['admin_id'])?></th>
				<td><?php echo date("Y-m-d H:i:s",$val['create_time'])?></td>
				<th width="70"><?php echo $val['mark']?></th>
				<td class="td-manage"><?php  if($val['_status'] == 2){?><a title="退款" href="javascript:;" onclick="member_start('退款','<?php echo $val['_id']?>')" class="ml-5" style="text-decoration:none">确认</a><?php }?></td>
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
// 	$('.table-sort').dataTable({
// 		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
// 		"bStateSave": true,//状态保存
// 		"aoColumnDefs": [
// 		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
// 		  {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
// 		]
// 	});
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
        $.post('/admin/Order/del',{id:delID},function(data){
            $.each(index,function(m,n){
            	$("#del-"+n).parents("tr").remove();
            });           
		    layer.msg('已删除!',{icon:1,time:1000});
        },'json');	
	});
	
});

/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$.get('/admin/Order/enb?id='+id,function(data){
		    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
		    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
		    $(obj).remove();
		    layer.msg('已停用!',{icon: 5,time:1000});
		},'json');
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要退款吗？',function(index){
		$.get('/admin/Order/sub_back?id='+id,function(data){
		layer.msg('已退款!',{icon: 6,time:1000});
		},'json');
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

</script> 
</body>
</html>