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

<title>添加用户</title>
</head>
<body>
<article class="page-container">
	<form action="/admin/User/add" method="post" class="form form-horizontal" id="form-member-add" enctype=”multipart/form-data”>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机号：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="" id="phone" name="phone">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="(不修改留空)" id="password" name="password">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" name="account" id="account">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"> 职业：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" name="job" id="job">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">上传头像：</label>
			<div class="formControls col-xs-8 col-sm-9">
				           <div id="flash1">
                                <p id="swf1">本组件需要安装Flash Player后才可使用，请从<a href="http://www.adobe.com/go/getflashplayer">这里</a>下载安装。</p>
                            </div>
                            <div id="editorPanelButtons" >
                                <p>
                                    <a href="javascript:;" class="btn btn-w-m btn-primary button_upload"><i class="fa fa-upload"></i> 上传</a>
                                    <a href="javascript:;" class="btn btn-w-m btn-white button_cancel">取消</a>
                                </p>
                            </div>
                            <input class="input-text" type="hidden" name="avatar" id="avatar">
			                <img style="display: none" id="img-avatar" src="">
               </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>认证类型：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<select class="select" size="1" name="user_type">
					<option value="1">摄影师</option>
					<option value="2">麻豆</option>
					<option value="3">社会团体</option>
					<option value="4">商业机构</option>
					<option value="5">官方</option>
				</select>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">个性签名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="personality_sign" cols="" rows="" class="textarea"  placeholder="说点什么..." onKeyUp="textarealength(this,100)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>性别：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<select class="select" size="1" name="sex">
					<option value="0" selected>女</option>
					<option value="1">男</option>
				</select>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>生日：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input name="birthday" type="text" id="birthday" size="15" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy/MM/dd'})">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">所在地：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="btn-upload form-group">
			<div id="city_4">
			<select class="prov" name="province"></select> 
			<select class="city"  name="city" disabled="disabled"></select>
			<select class="dist"  name="county" disabled="disabled"></select>
		    </div>

				</span> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"></label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<input class="input-text" type="text" placeholder="详细地址" name="address" id="name" style="width:360px">
			</div>
		</div>
		

		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">身份上传：</label> <span style="font-size:14px; "><div id="uploader-demo" style="text-indent: 23px;padding-top:20px">  
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
			<label class="form-label col-xs-4 col-sm-3">资质上传：</label> <span style="font-size:14px; "><div id="uploader-demo" style="text-indent: 23px;padding-top:20px">  
    <!--用来存放item-->       
    <div>  
     <div id="filePicker2">选择图片</div>  
     <span id="ctlBtn2" class="btn btn-success radius">开始上传</span>  
    </div>  
</div>  
</span>
			<div class="formControls col-xs-8 col-sm-9">
	        <div id="thelist2" class="uploader-list" style="margin-left: 23px"></div>
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="remark" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" onKeyUp="textarealength(this,100)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
			</div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			    <input class="input-text" type="hidden" name="sf_file" id="sf_file">
			    <input class="input-text" type="hidden" name="zz_file" id="zz_file">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.cityselect.js"></script>
<script type="text/javascript" src="/lib/layer/2.1/layer.js"></script>

<script type="text/javascript" src="/static/fullAvatarEditor/scripts/swfobject.js"></script>
<script type="text/javascript" src="/static/fullAvatarEditor/scripts/fullAvatarEditor.js"></script>
<script type="text/javascript" src="/static/fullAvatarEditor/scripts/jQuery.Cookie.js"></script>
<script type="text/javascript" src="/static/fullAvatarEditor/scripts/action.js"></script>

<script type="text/javascript" src="/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script type="text/javascript" src="/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<!--/_footer /作为公共模版分离出去--> 
<script type="text/javascript">
$(function(){
	
	//demo04
	$("#city_4").citySelect({
    	prov:"湖南", 
    	city:"长沙",
		dist:"岳麓区",
		nodata:"none"
	}); 
	
});
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
			nickname:{
				required:true,
				minlength:2,
				maxlength:16
			},
			phone:{
				required:true,
				isMobile:true,
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
		       $but = $("#sf_file").val();
		       $("#sf_file").val($but+response.path+'|');
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


		  $(function(){  
			  
			   /*init webuploader*/  
			   var $list2=$("#thelist2");   //这几个初始化全局的百度文档上没说明，好蛋疼。  
			   var $btn2 =$("#ctlBtn2");   //开始上传  
			   var thumbnailWidth = 100;   //缩略图高度和宽度 （单位是像素），当宽高度是0~1的时候，是按照百分比计算，具体可以看api文档  
			   var thumbnailHeight = 100;  
			  
			   var uploader2 = WebUploader.create({  
			       // 选完文件后，是否自动上传。  
			       auto: false,  
			  
			       // swf文件路径  
			       swf: '${ctxStatic }/webupload/Uploader.swf',  
			  
			       // 文件接收服务端。  
			       server: '/admin/File/uploadPicture',  
			  
			       // 选择文件的按钮。可选。  
			       // 内部根据当前运行是创建，可能是input元素，也可能是flash.  
			       pick: '#filePicker2',  
			  
			       // 只允许选择图片文件。  
			       accept: {  
			           title: 'Images',  
			           extensions: 'gif,jpg,jpeg,bmp,png',  
			           mimeTypes: 'image/*'  
			       },  
			       method:'POST',  
			   }); 
				   
			    
			   // 当有文件添加进来的时候  
			   uploader2.on( 'fileQueued', function( file ) {  // webuploader事件.当选择文件后，文件被加载到文件队列中，触发该事件。等效于 uploader.onFileueued = function(file){...} ，类似js的事件定义。  
			       var $li2 = $(  
			               '<div id="' + file.id + '" class="file-item thumbnail">' +  
			                   '<img>' +  
			                   '<div class="info">' + file.name + '</div>' +  
			               '</div>'  
			               ),  
			           $img = $li2.find('img');  
			  
			  
			       // $list为容器jQuery实例  
			       $list2.append( $li2 );  
			  
			       // 创建缩略图  
			       // 如果为非图片文件，可以不用调用此方法。  
			       // thumbnailWidth x thumbnailHeight 为 100 x 100  
			       uploader2.makeThumb( file, function( error, src ) {   //webuploader方法  
			           if ( error ) {  
			               $img.replaceWith('<span>不能预览</span>');  
			               return;  
			           }  
			  
			           $img.attr( 'src', src );  
			       }, thumbnailWidth, thumbnailHeight );  
			   });  

			   //$(function(){
			   // 文件上传过程中创建进度条实时显示。  
			   uploader2.on( 'uploadProgress', function( file, percentage ) {  
			       var $li2 = $( '#'+file.id ),  
			           $percent = $li2.find('.progress span');  
			  
			       // 避免重复创建  
			       if ( !$percent.length ) {  
			           $percent = $('<p class="progress"><span></span></p>')  
			                   .appendTo( $li2 )  
			                   .find('span');  
			       }  
			  
			       $percent.css( 'width', percentage * 100 + '%' );  
			   });  
			  
			   // 文件上传成功，给item添加成功class, 用样式标记上传成功。  
			   uploader2.on( 'uploadSuccess', function( file ,response ) {  
			       $but2 = $("#zz_file").val();
			       $("#zz_file").val($but2+response.path+'|');
			       $( '#'+file.id ).addClass('upload-state-done');  
			   });  
			  
			   // 文件上传失败，显示上传出错。  
			   uploader2.on( 'uploadError', function( file ) {  
			       var $li = $( '#'+file.id ),  
			           $error = $li.find('div.error');  
			  
			       // 避免重复创建  
			       if ( !$error.length ) {  
			           $error = $('<div class="error"></div>').appendTo( $li );  
			       }  
			  
			       $error.text('上传失败');  
			   });  

			 
			  
			   // 完成上传完了，成功或者失败，先删除进度条。  
			   uploader2.on( 'uploadComplete', function( file ) {  
			       $( '#'+file.id ).find('.progress').remove();  
			   });  
			      $btn2.on( 'click', function() {  
			        console.log("上传...");  
			        uploader.upload();  
			        console.log("上传成功");  
			      });  
			  });

		  

</script>


<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>