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

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 福利管理 <span class="c-gray en">&gt;</span> 优惠卷主题列表  <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

<form action="" method="get">
	<div class="text-c"> 优惠卷主题：
		
		<input type="text" class="input-text" style="width:250px" placeholder="优惠卷主题" id=""  value="<?php echo $search?>" name="search">
		<button type="submit" class="btn btn-success radius" id="" name="" value=""><i class="Hui-iconfont">&#xe665;</i> 查询 </button>
	</div>
</form>
	</div>	
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" class="btn btn-primary radius"> 优惠卷主题列表</a></span>  <span class="r">共有数据：<strong><?php echo $total;?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr class="text-c">

				<th width="100">管理员</th>
				<th width="80">类型</th>
				<th width="150">优惠劵主题名称</th>				
				<th width="100">面值</th>
				<th width="100">发放数量</th>
				<th width="100">用户已领取数量</th>
				<th width="80">未领取数量</th>
				<th width="70">优惠券有效期</th>
				<th width="100">状态</th>	
				<th width="100">查看优惠卷</th>			

			</tr>
		</thead>
		<?php foreach ($arr as $key => $val){?>
		<tbody>
			<tr class="text-c">
				<td><?php echo $val['account']?></td>
				<td><?php echo $val['coupons_name']?></td>
				<th><a href="/admin/Coupons/CouponsList?coupons_id=<?php echo $val['id']?>" class="" style="width:80%;" ><?php echo $val['coupons_title']?></a></th>
				

				<td><?php echo $val['coupons_value']?></td>
				<td><?php echo $val['coupons_number']?></td>

				<td><?php echo $val['send_num']?></td>
				<td><?php echo $val['count_surplus']?></td>
				<td> <?php echo date('Y-m-d H:i:s',$val['start_time'])?> / <?php echo date("Y-m-d H:i:s",$val['end_time'])?></td>
				
				<th width="80"><?php if($val['status_sta'] == 0 && $val['status_end'] == 0){echo '进行中';}elseif($val['status_sta'] == 1 ){echo '未开始';}elseif($val['status_end'] == 1){echo '已结束';}?></th>
				<td>
				<a title="查看" href="javascript:;" onclick="member_edit('查看','/admin/Coupons/CouponsShow?id=<?php echo $val['id']?>','4','880','800')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i>
				查看
				</a>
				</td>

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

/*查看优惠卷列表*/
function coupons_show(id){
	
	//delID = JSON.stringify(index);
// return;
	var datas = "coupons_id="+id; 
	alert(id)   
	alert(11);
	return ;
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

/*-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
</script> 
</body>
</html>