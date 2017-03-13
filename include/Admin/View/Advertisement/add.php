<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
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
<link href="/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>添加广告</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
	   <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>广告名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="（15字以内）" id="title" name="title"> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>合作商家：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select size="1" name="type">
					<?php foreach ($fil as $item){?>
					<option value="<?php echo $item['id']?>"><?php echo $item['name']?></option>
					<?php }?>
				</select>
				<select size="1" name="type">
					<?php foreach ($sub as $val){?>
					<option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
					<?php }?>
				</select>
				<select size="1" name="club_id">
					<option value="0" selected>韵公园俱乐部</option>
					<option value="0">光影俱乐部</option>
					<option value="1">伟星俱乐部</option>
				</select>
			</div>
		</div>
		<div class="row cl">
		    <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>广告开始投放时间：</label>
			   <input type="text" onfocus="WdatePicker({dateFmt:'yyyy/MM/dd HH:mm:ss'})" name="start_time" id="datemin" class="input-text Wdate" style="width:120px;">
				    &nbsp;&nbsp;&nbsp;广告结束投放时间：
				<input type="text" onfocus="WdatePicker({dateFmt:'yyyy/MM/dd  HH:mm:ss'})"  name="end_time" id="datemax" class="input-text Wdate" style="width:120px;">
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>参与类型：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select size="1" name="type">
					<option value="1">URL参与</option>
					<option value="2">活动参与</option>
				</select>
				<select size="1" name="act_id">
					<option value="0">请选择活动</option>
					<?php foreach ($act as $a => $t){?>
					<option value="<?php echo $t['id']?>"><?php echo $t['title']?></option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">是否开启：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<select size="1" name="status">
					<option value="1">是</option>
					<option value="0">否</option>
				</select>
           </div>
		</div>
		<div class="row cl">
		    <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>选择广告位置：</label>
			   <select size="1" name="place">
					<option value="0" selected>顶部</option>
					<option value="1">中间（左边）</option>
					<option value="2">中部（中间）</option>
					<option value="3">中部（底部）</option>
					<option value="4">底部</option>
				</select>
				    &nbsp;&nbsp;&nbsp;选择位置序号：
				<select size="1" name="order">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
				</select>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>广告价格：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" id="money" name="money"> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>广告图：</label> <span style="font-size:14px; "><div id="uploader-demo" style="text-indent: 23px;padding-top:20px">  
    <!--用来存放item-->       
    <div>  
     <div id="filePicker">选择图片</div>  
     <span id="ctlBtn" class="btn btn-success radius">开始上传</span>  
    </div>  
</div>  
</span>
			<div class="formControls col-xs-8 col-sm-9">
				<div id="thelist" class="uploader-list" style="margin-left: 23px"></div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span></label>
			<div class="formControls col-xs-8 col-sm-9">
				
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			    <input type="hidden" name="image_path" id="image_path" value="">
			    <input type="hidden" name="user_id" value="<?php $uid = session('user_auth'); echo $uid['uid'];?>">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script type="text/javascript" src="/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="/lib/webuploader/0.1.5/webuploader.min.js"></script>
<!--/_footer /作为公共模版分离出去--> 

<script type="text/javascript">  
  $(function(){  
	  
   /*init webuploader*/  
   var $list=$("#thelist");   //这几个初始化全局的百度文档上没说明，好蛋疼。  
   var $btn =$("#ctlBtn");   //开始上传  
   var thumbnailWidth = 100;   //缩略图高度和宽度 （单位是像素），当宽高度是0~1的时候，是按照百分比计算，具体可以看api文档  
   var thumbnailHeight = 100;  
  
   var uploader = WebUploader.create({  
       // 选完文件后，是否自动上传。  
       auto: false,  
  
       // swf文件路径  
       swf: '${ctxStatic }/webupload/Uploader.swf',  
  
       // 文件接收服务端。  
       server: '/admin/File/uploadPicture',  
  
       // 选择文件的按钮。可选。  
       // 内部根据当前运行是创建，可能是input元素，也可能是flash.  
       pick: '#filePicker',  
       fileNumLimit: 1,
  
       // 只允许选择图片文件。  
       accept: {  
           title: 'Images',  
           extensions: 'gif,jpg,jpeg,bmp,png',  
           mimeTypes: 'image/*'  
       },  
       method:'POST',  
   }); 
	   
    
   // 当有文件添加进来的时候  
   uploader.on( 'fileQueued', function( file ) {  // webuploader事件.当选择文件后，文件被加载到文件队列中，触发该事件。等效于 uploader.onFileueued = function(file){...} ，类似js的事件定义。  
       var $li = $(  
               '<div id="' + file.id + '" class="file-item thumbnail">' +  
                   '<img>' +  
                   '<div class="info">' + file.name + '</div>' +  
               '</div>'  
               ),  
           $img = $li.find('img');  
  
  
       // $list为容器jQuery实例  
       $list.append( $li );  
  
       // 创建缩略图  
       // 如果为非图片文件，可以不用调用此方法。  
       // thumbnailWidth x thumbnailHeight 为 100 x 100  
       uploader.makeThumb( file, function( error, src ) {   //webuploader方法  
           if ( error ) {  
               $img.replaceWith('<span>不能预览</span>');  
               return;  
           }  
  
           $img.attr( 'src', src );  
       }, thumbnailWidth, thumbnailHeight );
   });  

   //$(function(){
   // 文件上传过程中创建进度条实时显示。  
   uploader.on( 'uploadProgress', function( file, percentage ) {  
       var $li = $( '#'+file.id ),  
           $percent = $li.find('.progress span');  
  
       // 避免重复创建  
       if ( !$percent.length ) {  
           $percent = $('<p class="progress"><span></span></p>')  
                   .appendTo( $li )  
                   .find('span');  
       }  
  
       $percent.css( 'width', percentage * 100 + '%' );
   });  
  
   // 文件上传成功，给item添加成功class, 用样式标记上传成功。  
   uploader.on( 'uploadSuccess', function( file ,response ) {  
       $("#image_path").val(response.path);
       $( '#'+file.id ).addClass('upload-state-done');  
   });  
  
   // 文件上传失败，显示上传出错。  
   uploader.on( 'uploadError', function( file ) {  
       var $li = $( '#'+file.id ),  
           $error = $li.find('div.error');  
  
       // 避免重复创建  
       if ( !$error.length ) {  
           $error = $('<div class="error"></div>').appendTo( $li );  
       }  
  
       $error.text('上传失败');  
   });  

 
  
   // 完成上传完了，成功或者失败，先删除进度条。  
   uploader.on( 'uploadComplete', function( file ) {  
       $( '#'+file.id ).find('.progress').remove();  
   });  
      $btn.on( 'click', function() {  
        console.log("上传...");  
        uploader.upload();  
        console.log("上传成功");  
      });  
  });

 // });  
 </script>


<!--请在下方写此页面业务相关的脚本--> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
		rules:{
			account:{
				required:true,
				minlength:2,
				maxlength:16
			},
			group_id:{
				required:true,
			},
			phone:{
				required:true,
				isMobile:true,
			},
			email:{
				required:true,
				email:true,
			},
			password:{
				required:true,
			},
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){

			var parent = window.parent.getlay();
		parent.location.reload();
			var index = parent.layer.getFrameIndex(window.name);
			//parent.$('.btn-refresh').click();
			parent.layer.close(index);
			parent.layer.reload(parent);
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>