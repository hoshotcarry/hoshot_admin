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
<title>日志管理</title>
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 日志管理  <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container"><form action="" method="get">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" name="start_time" id="datemin" class="input-text Wdate" value="<?php echo $start_time?>" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})"  name="end_time" id="datemax" class="input-text Wdate" value="<?php echo $end_time?>" style="width:120px;">
		
		<button type="submit" class="btn btn-success radius" id="" name="" value=""><i class="Hui-iconfont">&#xe665;</i> 查询日志  </button>
	</div></form>
	
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!--  th width="25"><input type="checkbox" name="" value=""></th>-->
				<th width="80">ID</th>
				<th width="100">操作用户</th>
				<th width="80">IP地址</th>
				<th width="90">操作日期</th>
				<th width="150">日志类型</th>
				<th width="200">操作名称</th>
				<th width="130">备注</th>
			</tr>
		</thead>
		<?php foreach ($arr as $key => $val){?>
		<tbody>
			<tr class="text-c">
				<!-- td><input type="checkbox" value="<?php echo $val['gid']?>" class="check" name="check"></td> -->
				<td><?php echo $val['gid']?></td>
				<td><?php echo $val['account']?></td>
				<td><?php echo long2ip($val['ip'])?></td>
				<td><?php echo date("Y-m-d H:i:s",$val['create_time'])?></td>
				<td><?php if($val['type']==0){echo '安全日志';}else{echo '操作日志';}?></td>
				<td><?php echo $val['title']?></td>
				<td><?php echo $val['remark']?></td>
			</tr>
		</tbody>
		<?php }?>
	</table>
	
	<div style="line-height:66px;"><span class="r">共有数据：<strong><?php echo $total;?></strong> 条</span> <?php echo $page;?></div>
	
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
	  {"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
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
// 	$('.table-sort tbody').on( 'click', 'tr', function () {
// 		if ( $(this).hasClass('selected') ) {
// 			$(this).removeClass('selected');
// 		}
// 		else {
// 			table.$('tr.selected').removeClass('selected');
// 			$(this).addClass('selected');
// 		}
// 	});
});


// $("#delete").click(function(){
// 	layer.confirm('确认要删除吗？',function(index){
// 		index = new Array();
// 		n = -1;
// 		$(".check").each(function(i,x){	
// 		    if($(this).is(':checked')){
// 		    	n++;
// 		    	index[n] = $(this).val();
// 		    }
// 		});
// 		delID = JSON.stringify(index);
//         $.post('/admin/Admin/del',{id:delID},function(data){
//             $.each(index,function(m,n){
//             	$("#del-"+n).parents("tr").remove();
//             });           
// 		    layer.msg('已删除!',{icon:1,time:1000});
//         },'json');	
// 	});
	
// });

</script> 
</body>
</html>