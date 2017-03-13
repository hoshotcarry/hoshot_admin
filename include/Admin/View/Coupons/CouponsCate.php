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
<title>优惠券分类列表</title>
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 福利管理 <span class="c-gray en">&gt;</span> 优惠券分类列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" onclick="member_add('添加优惠券分类','/admin/Coupons/AddCate','880','580')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a></span> <span class="r">共有数据：<strong><?php echo $total;?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr class="text-c">
				<!--  th width="25"><input type="checkbox" name="" value=""></th-->
				<th width="80">序号</th>
				<th width="150">优惠券名称</th>
				<th width="90">上级节点</th>					
				<th width="150">描述</th>
				<th width="150">状态</th>

				<th width="100">操作</th>
			</tr>
		</thead>

		<?php foreach ($arr as $key => $val){?>
		<tbody>
			<tr class="text-c">
				<!-- td><input type="checkbox" value="<?php echo $val['id']?>" class="check" name="check"></td-->
				<td><?php echo $key+1; ?></td>
				<td><?php echo $val['coupons_name']?></td>
				<td><?php echo '/';?></td>
				<td><?php echo  $val['coupons_dec']?></td>

				<td><?php if($val['del'] == 1){echo '正常';}elseif($val['del'] == 0){echo '禁用';}?></td>
				<td class="td-manage"><?php if($val['status'] == 1){?>
				<!-- a style="text-decoration:none" onClick="member_stop(this,'<?php echo $val['id']?>')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a-->
				<?php } if($val['status'] == 0){?> <a style="text-decoration:none" onClick="member_start(this,'<?php echo $val['id']?>')" href="javascript:;" title="启用"> </a>
				<?php }?> 
				<a title="编辑" href="javascript:;" onclick="member_edit('编辑','/admin/Coupons/EditCate?id=<?php echo $val['id']?>','4','880','550')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i>
				</a></td>
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
        $.post('/admin/CustomerService/CustomerDel',{id:delID},function(data){
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
function member_show(id){
	
	//delID = JSON.stringify(index);
// return;
	var datas = "customer_id="+id;    
	
		$.ajax({
		   type: "POST",
		   url: '/admin/CustomerService/customerActivityList',
		   data: datas,
		   dataType: "json",
		   success: function(data){
			   if(data.ajax_success == 'ajax_success'){
				  // alert('添加活动到客服成功！');
				  // var urls = location.href; 
				  // alert(urls);
				   //window.location.href='{U:("/admin/CustomerService/customerActivityList")}';//"jb51.jsp?backurl="+window.location.href; 
				  
			   }else if (data.ajax_success == 'ajax_error'){
				   alert('添加活动到客服失败！');
			  }else {
				  alert('未知错误！');
		      }
			  
		    // alert( "Data Saved: " + data );
		   },
		   error:function (XMLHttpRequest, textStatus, errorThrown) {
			  //alert(errorThrown);
			    // 通常 textStatus 和 errorThrown 之中
			    // 只有一个会包含信息
			   // ; // 调用本次AJAX请求时传递的options参数
			},
		   complete:function (XMLHttpRequest, textStatus) {
			  // alert(textStatus);// this; // 调用本次AJAX请求时传递的options参数
		   }
	});
	//layer_show(title,url,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$.get('/admin/CustomerService/enb?id='+id,function(data){
		    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
		    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
		    $(obj).remove();
		    layer.msg('已停用!',{icon: 5,time:1000});
		},'json');
	});
}
/*用户-停用*/
function member_setKF(obj,id){
	layer.confirm('确认要设置默认客服吗？',function(index){
		$.get('/admin/CustomerService/setKF?id='+id,function(data){
		    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
		    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已设置默认客服</span>');
		    $(obj).remove();
		    layer.msg('已设置默认客服!',{icon: 6,time:3000});
		    javascript:location.replace(location.href);
		    
		},'json');
	});
}
/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$.get('/admin/CustomerService/cstart?id='+id,function(data){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!',{icon: 6,time:1000});
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