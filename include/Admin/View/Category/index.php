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
<title>分类管理</title>
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 功能管理 <span class="c-gray en">&gt;</span>分类管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" id="delete" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('新增系统消息','/admin/Category/add','','580')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 新增分类</a> </span> <span class="r">共有数据：<strong><?php echo $total;?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">分类ID</th>
				<th width="100">分类名称</th>
				<th width="300">频道描述</th>
				<th width="100">创建时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<?php foreach ($tree as $key => $val){?>
		<tbody>
			<tr class="text-c">
				<td><input type="checkbox" id="del-<?php echo $val['id']?>" value="<?php echo $val['id']?>" class="check" name="check"></td>
				<td><?php echo $val['id']?></td>
				<td><?php echo $val['title']?></td>
				<td><?php echo $val['description']?></td>
				<td><?php echo date('Y-m-d h:m:i' ,$val['create_time'])?></td>
				<td class="td-manage">
                                        <a title="编辑" href="javascript:;" onclick="member_edit('编辑','/admin/Category/edit?id=<?php echo $val['id']?>','4','','600')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>   <a title="删除" id="del-<?php echo $val['id']?>" href="javascript:;" onclick="member_del(this,'<?php echo $val['id']?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
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

function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
        $.get('/admin/Category/del?id='+id,function(data){
            $(obj).parents("tr").remove();
		    layer.msg('已删除!',{icon:1,time:1000});
        },'json');	
	});
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
        $.post('/admin/Category/del',{id:delID},function(data){
            $.each(index,function(m,n){
            	$("#del-"+n).parents("tr").remove();
            });           
		    layer.msg('已删除!',{icon:1,time:1000});
        },'json');	
	});
	
});

function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

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
</script> 
</body>
</html>