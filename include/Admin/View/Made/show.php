<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>摄点图片</title>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=QsO2bWfB7XijYr9AnSmGw3HS"></script>
<link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/style.css" />
<link href="/static/uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<link href="/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php foreach ($images as $key => $val){?>
<img src="<?php echo $val['path']?>" alt="" width="500" height="300" style="margin-left: 50px; margin-top:30px" />
<?php }?>
</body>
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Static/js/jquery.cityselect.js"></script>

<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script> 

<script type="text/javascript" src="/lib/My97DatePicker/WdatePicker.js"></script>

<script type="text/javascript" src="/static/uploadify/jquery.uploadify.min.js"></script>

<script type="text/javascript" src="/lib/webuploader/0.1.5/webuploader.min.js"></script> 

<script type="text/javascript" src="/lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="/lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript" src="/static/js/json2.js"></script>


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
	       $but2 = $("#but2").val();
	       $("#but2").val($but2+response.path+'|');
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

 // });  
 </script>


<script type="text/javascript">
	// 百度地图API功能
	var map = new BMap.Map("allmap");    // 创建Map实例
	map.centerAndZoom(new BMap.Point(116.404, 39.915), 11);  // 初始化地图,设置中心点坐标和地图级别
	map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
	map.setCurrentCity("北京");          // 设置地图显示的城市 此项是必须设置的
	map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
</script>
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

var ue = UE.getEditor('description');

</script>
</html>
