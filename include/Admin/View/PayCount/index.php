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
<title>交易统计</title>

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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 统计管理 <span class="c-gray en">&gt;</span> 交易统计   <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container"><form action="" method="get">
	
	<div class="cl pd-5 bg-1 bk-gray mt-20"><input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" name="start_time" id="datemin" class="input-text Wdate" value="<?php echo $start_time?>" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})"  name="end_time" id="datemax" class="input-text Wdate" value="<?php echo $end_time?>" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="活动主题" id=""  value="<?php echo $search?>" name="search">
        <select name="select5" id="select5" class="input-text" style="width:150px">
                  <option value="0">分站</option>
        </select>
        <select name="select5" id="select5" class="input-text" style="width:150px">
                  <option value="0">数据来源</option>
              </select>
		<button type="submit" class="btn btn-success radius" id="" name="" value=""><i class="Hui-iconfont">&#xe665;</i> 查询 </button></div></form>
	<p><br/></p>
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr class="text-c">
				<th width="100">分站</th>
				<th width="100">活动主题</th>
				<th width="100">好摄ID</th>
				<th width="100">日期</th>
				<th width="100">数据来源</th>
				<th width="100">收入总额</th>
				<th width="100">退单总额</th>
				<th width="100">已发生费用</th>
				<th width="100">平台价总额</th>
				<th width="100">净收入</th>
			</tr>
		</thead>
		<?php foreach ($arr as $key => $val){?>
		<tbody>
			<tr class="text-c">
				<th><?php echo fz($val['user_id'])?></th>
				<th><?php echo $val['title']?></th>
				<th><?php echo get_account($val['user_id']) ? get_account($val['user_id']) : $val['user_id']?></th>
				<th><?php echo date('Y-m-d',$val['create_time'])?></th>
				<th>无</th>
				<th><?php echo sprintf('%.2f',$val['all'])?></th>
				<td><?php echo sprintf('%.2f',$val['back'])?></td>
				<td>0</td>
				<td><?php echo sprintf('%.2f',$val['platform_price'] * $val['participants'])?></td>
				<td><?php echo sprintf('%.2f',$val['all'])?></td>
			</tr>
		</tbody>
		<?php }?>
	</table>
	
	<div style="line-height:66px;"><?php echo $page;?></div>
	
</div>

<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script type="text/javascript" src="/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script> 

<script type="text/javascript" src="/Static/js/json2.js"></script>

<script type="text/javascript">
$(function(){

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
	
});

</script> 
<script type="text/javascript">
$(function(){
    $("#DataTables_Table_0_wrapper").hide();

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
        $.post('/admin/Forbidden/del',{id:delID},function(data){
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
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!',{icon: 6,time:1000});
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
        $.get('/admin/Forbidden/del?id='+id,function(data){
            $(obj).parents("tr").remove();
		    layer.msg('已删除!',{icon:1,time:1000});
        },'json');	
	});
}
</script> 
</body>
</html>