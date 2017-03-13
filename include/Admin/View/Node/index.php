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
<title>权限管理</title>
<style type="text/css">
dl {
    display: block;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
}
dd {
    display: block;
    -webkit-margin-start: 40px;
}
.checkmod {
    border-color: #ebebeb;
    margin-bottom: 20px;
    border: 1px solid #ebebeb;
}
.checkmod dt {
    border-bottom-color: #ebebeb;
    background-color: #ECECEC;
    padding-left: 10px;
    height: 30px;
    line-height: 30px;
    font-weight: bold;
    border-bottom: 1px solid #ebebeb;
    background-color: #ECECEC;
    display: block;
}
.checkmod dd {
    padding-left: 10px;
    line-height: 30px;
    display: block;
    -webkit-margin-start: 40px;
}
.checkbox, .radio {
    display: inline-block;
    height: 20px;
    line-height: 20px;
}
.checkmod dd .divsion {
    margin-right: 20px;
}
label{margin-right:10px}
.rule_check{
margin-left:0px;
}
.db{
margin-left:-30px;
}
</style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 权限管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" id="delete" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加节点','/admin/Node/add','','390')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加节点</a></span></div>
	<div class="mt-20">
	
	
	<?php foreach (node(0) as $m => $n){?>
	<dl class="checkmod">
							<dt class="hd">
								<label class="checkbox"><input class="auth_rules rules_all" type="checkbox" name="rules[]" value="<?php echo $n['id']?>"><?php echo $n['nodeName']?></label>
							</dt>
							
							<dd class="bd">
							    <?php foreach (node($n['id']) as $a => $s){?>
								<div class="rule_check">
                                        <div>
                                            <label class="checkbox">
                                           <input class="auth_rules rules_row" type="checkbox" name="rules[]" value="<?php echo $s['id']?>"><?php echo $s['nodeName']?>                                       </label>
                                        </div>
                                       <span class="divsion">&nbsp;</span>
                                           <span class="child_row">
                                           <?php foreach (node($s['id']) as $k => $i){?>
                                               <label class="checkbox"><input class="auth_rules" type="checkbox" name="rules[]" value="<?php echo $i['id']?>"><?php echo $i['nodeName']?>  </label>
                                           <?php }?>
                                           </span>				                    
                                    </div>
						            <?php }?>
                                </dd>
                                
						</dl>
						<?php }?>
						
	
	</div>
</div>
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/lib/laypage/1.2/laypage.js"></script> 
<script type="text/javascript" src="/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script>

<script type="text/javascript" charset="utf-8">
    +function($){
        var rules = [1,2,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,81,82,83,84,86,87,88,89,90,91,92,93,94,95,96,97,100,102,103,105,106];
        $('.auth_rules').each(function(){
            if( $.inArray( parseInt(this.value,10),rules )>-1 ){
                $(this).prop('checked',true);
            }
            if(this.value==''){
                $(this).closest('span').remove();
            }
        });

        //全选节点
        $('.rules_all').on('change',function(){
            $(this).closest('dl').find('dd').find('input').prop('checked',this.checked);
        });
        $('.rules_row').on('change',function(){
            $(this).closest('.rule_check').find('.child_row').find('input').prop('checked',this.checked);
        });

        $('.checkbox').each(function(){
            $(this).qtip({
                content: {
                    text: $(this).attr('title'),
                    title: $(this).text()
                },
                position: {
                    my: 'bottom center',
                    at: 'top center',
                    target: $(this)
                },
                style: {
                    classes: 'qtip-dark',
                    tip: {
                        corner: true,
                        mimic: false,
                        width: 10,
                        height: 10
                    }
                }
            });
        });

        $('select[name=group]').change(function(){
			location.href = this.value;
        });
        //导航高亮
    }(jQuery);
</script>





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
		$(".auth_rules").each(function(i,x){	
		    if($(this).is(':checked')){
		    	n++;
		    	index[n] = $(this).val();
		    }
		});
		delID = JSON.stringify(index);
        $.post('/admin/Node/del',{id:delID},function(data){
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
	layer.confirm('确认要发布吗？',function(index){
		$.get('/admin/Announcement/enb?id='+id,function(data){
		    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
		    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
		    $(obj).remove();
		    layer.msg('已发布!',{icon: 5,time:1000});
		},'json');
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
		$.get('/admin/Node/del?id='+id,function(data){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},'json');
	});
}
</script> 
</body>
</html>