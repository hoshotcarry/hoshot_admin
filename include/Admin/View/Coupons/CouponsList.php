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
<title>福利管理</title>
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

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 福利管理 <span class="c-gray en">&gt;</span> 优惠卷列表  <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container"></div>

<form action="" method="get">
	<div class="text-c"> 
		
		<input type="text" class="input-text" style="width:250px" placeholder="" id=""  value="<?php echo $search?>" name="search">
		<button type="submit" class="btn btn-success radius" id="" name="" value=""><i class="Hui-iconfont">&#xe665;</i> 查询 </button>
	</div></form>
		
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" class="btn btn-primary radius"> 优惠卷列表</a></span>  <span class="r">共有数据：<strong><?php echo $total;?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr class="text-c">

				<th width="100">用户呢称</th>
				<th width="80">活动名称</th>
				<th width="150">活动类型</th>				
				<th width="100">优惠券主题名称</th>
	
				<th width="100">消费时间</th>
				<th width="100">面值</th>
				<th width="100">状态</th>				

			</tr>
		</thead>
		<?php foreach ($arr as $key => $val){?>
		<tbody>
			<tr class="text-c">
				<td><?php if ($val['user_name']) { echo $val['user_name'];}else{ echo "-" ;}?></td>
				<td><?php if ($val['title']) { echo $val['title'];}else{ echo "-" ;}?></td>

				<td><?php if ($val['cate_title']) { echo $val['cate_title'];}else{ echo "-" ;}?></td>
				<td><?php echo $val['coupons_title']?></td>

				<td><?php if ($val['pay_time']) { echo date('Y-m-d H:i:s',$val['pay_time']);}else{ echo "-" ;}?></td>
				<td><?php echo $val['coupons_value']?></td>

				<th width="80"><?php if($val['coupons_status'] == 0){echo '未使用';}elseif($val['coupons_status'] == 1){echo '已使用';}elseif($val['coupons_status'] == 3){echo '已过期';}?></th>


			</tr>
		</tbody>
		<?php }?>
	</table>

	<div style="height:36px;border:1px solid #fff;background:#F5FAFE; padding:10px 5px 15px 20px;">
	    <div style="height:33px;width:80%;float:right;"><?php echo $page;?></div>
	    <div style="height:33px;width:19%;float:left;"> 

	</div>
	
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

$("#suregoin").click(function(){
	
	var sel = document.getElementById('customer_type');
	var selected_val = sel.options[sel.selectedIndex].value;
	var selected_text = sel.options[sel.selectedIndex].text;

		index = new Array();

		n = -1;
		$(".check").each(function(i,x){	
		    if($(this).is(':checked')){
		    	n++;
		    	
		    	index[n] = $(this).val();
		    }
		});



		delID = JSON.stringify(index);

		if(delID =='[]'){
			alert("请选择活动.");
			return ;
			}
		var datas ="id="+delID+"&customer_id="+selected_val;    

 		$.ajax({
			   type: "POST",
			   url: '/admin/CustomerService/joinActivity',
			   data: datas,
			   dataType: "json",
			   success: function(data){
// 				   alert(data.idsCount);
				   if(data.ajax_success == 'ajax_success'){
					   alert('添加'+data.idsCount+'个活动到客服：[ '+selected_text+' ]成功!');
					   javascript:location.replace(location.href);
				   }else if (data.ajax_success == 'ajax_error'){
					   alert('添加活动到客服失败!');
					   javascript:location.replace(location.href);
				  }else if ( data.ajax_success ==  'exist_success'){
					   alert('已经存在此活动!');
			      }else{
			    	  alert('未知错误！');
			      }
				  
			    // alert( "Data Saved: " + data );
			   },
			   error:function (XMLHttpRequest, textStatus, errorThrown) {
				  /// alert(errorThrown);
				    // 通常 textStatus 和 errorThrown 之中
				    // 只有一个会包含信息
				   // ; // 调用本次AJAX请求时传递的options参数
				},
			   complete:function (XMLHttpRequest, textStatus) {
				  // alert(textStatus);// this; // 调用本次AJAX请求时传递的options参数
			   }
		});
	
	
});

/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$.get('/admin/Activity/enb?id='+id,function(data){
		    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
		    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
		    $(obj).remove();
		    layer.msg('已停用!',{icon:1,time:1000});
		},'json');
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$.get('/admin/Activity/start?id='+id,function(data){
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