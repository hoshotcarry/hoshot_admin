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
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>添加作品</title>
</head>
<body>
<article class="page-container">
	<form action="/admin/Works/add?type=<?php echo $_GET['type'];?>" method="post" class="form form-horizontal" id="form-member-add">
	
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>选择活动：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="请输入活动名称通过下拉框选择活动，否则无效" id="name" name="title">
				<input type="hidden" class="input-text" value="" id="_name" name="act_id">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>关联摄点：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select name="shoot_id[]" id="shoot_id">
                        <option value="0">无</option>
                        <?php foreach($shoot as $sh){?>
                        <option value="<?php echo $sh['id']?>"><?php echo $sh['title']?></option>
                        <?php }?>
                        </select>
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">版权保护：</label>
			<div class="formControls col-xs-8 col-sm-9">
              <input type="checkbox" name="checkbox" id="checkbox">
              <label for="checkbox">开启版权保护</label>
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">作品标签：</label>
			<div class="formControls col-xs-8 col-sm-9">
              <?php foreach($tags as $item){?>
			  <input type="checkbox" name="checkbox[<?php echo $item['id']?>]" id="checkbox">
			  <label for="checkbox"><?php echo $item['tagName']?></label>
              <?php }?>
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">作品介绍：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="title" cols="" rows="" class="textarea"  placeholder="说点什么..." onKeyUp="textarealength(this,500)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/500</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">上传作品：</label> <span style="font-size:14px; "><div id="uploader-demo" style="text-indent: 23px;padding-top:20px">  
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
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			    <input type="hidden" name="img" id="but" value="" />
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
<script type="text/javascript" src="/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/static/JQuery-UI/jquery-ui-1.10.4.custom.min.js"></script> 


<!--/_footer /作为公共模版分离出去--> 

 <script>
 $(function() {

	 function DataSouce2(name){
		 var mycars=new Array();
		 $title = $("#name").val();
		 $.ajax( {  
			      url:'/admin/Works/activitys/',// 跳转到 action  
			      data:{  
			    	  title : $title 
			      },  
			     type:'post',  
			     cache:false,  
			     dataType:'json',  
			     success:function(data) {  
			    	 $.each(data,function(index,item){
//		 				 alert(item.title);
						 mycars[index]=item.title+'_'+item.id;
					 });					 
			      },  
			      error : function() {  
			           // view("异常！");  
			           alert("异常！");  
			      } ,
			      async:false 
			 });
		 return mycars; 
	  }
	 
	  $("#name").autocomplete({
		   source: function( request, response ) {
		    var name=$.ui.autocomplete.escapeRegex( request.term );
		    response( $.grep( DataSouce2(name), function( item ){
		     return  item;
		    }) );
		   },
		   select: function(event,ui){

			   str = ui.item.value.split('_');
			   $("#_name").val(str[1]);
		   }
	   })
 })
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
	   $but = $("#but").val();
       $("#but").val($but+response.path+'|');
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

<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>