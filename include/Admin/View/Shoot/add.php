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
<script src="http://webapi.amap.com/maps?v=1.3&key=64f731cf2ac66b4949818c73c57ef4df"></script>
<script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>

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
<style type="text/css">
#container {width:520px; height: 520px; } 
</style>
<title>添加摄点</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>摄点主题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="title" name="title">
			</div>
		</div>

<!-- 		<div class="row cl"> -->
<!-- 			<label class="form-label col-xs-4 col-sm-3"></label> -->
<!-- 			<div class="formControls col-xs-8 col-sm-9">  -->
<!--  			<input class="input-text" type="text" placeholder="详细地址" name="address" id="name" style="width:360px">
<!-- 			</div> -->
<!-- 		</div> -->
		
<!-- 		<div class="row cl"> -->
<!-- 			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>摄点分类：</label> -->
<!-- 			<div class="formControls col-xs-8 col-sm-9"> -->
<!-- 				<select class="select" size="1" name="cat_id"> -->
<!-- 					<?php foreach ($category as $c => $r){?>
<!--                     <option value="<?php echo $r['id']?>"><?php echo $r['title']?></option>
 <!--                    <?php }?>
<!-- 				</select> -->
<!-- 			</div> -->
<!-- 		</div> -->

       <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">摄点类型：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select class="select" size="1" name="rec_id" style="width:200px">
					<option value="0">特色摄点</option>
					<option value="1">热门摄点</option>
				</select>
			</div>
		</div>
        
         <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">推荐器材：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <input type="text" class="input-text" placeholder="输入推荐器材" id="equipment" name="equipment">
			</div>
		 </div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">推荐气节：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select class="select" size="1" name="season" style="width:200px">
                    <option value="全部季节">全部季节</option>
					<option value="春">春</option>
					<option value="夏">夏</option>
                    <option value="秋">秋</option>
					<option value="冬">冬</option>
				</select>    <select class="select" size="1" name="weather" style="width:200px">
					<option value="全部天气">全部天气</option>
					<option value="晴">晴</option>
					<option value="风">风</option>
					<option value="云">云</option>
					<option value="雾">雾</option>
					<option value="雨">雨</option>
					<option value="雪">雪</option>
					<option value="霜">霜</option>
				</select>
			</div>
		</div>
        
         <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">推荐时间：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select class="select" size="1" name="recom_time" style="width:200px">
                    <option value="任何时间">任何时间</option>
					<option value="日出">日出</option>
					<option value="晨">晨</option>
                    <option value="午">午</option>
                    <option value="傍晚">傍晚</option>
                    <option value="夜">夜</option>
				</select>
			</div>
		 </div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">推荐位置：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select class="select" size="1" name="rec_id" style="width:200px">
					<option value="0">特色摄点</option>
					<option value="1">热门摄点</option>
				</select> <span class="c-red">*</span> 推荐排序   <select class="select" size="1" name="rec_order" style="width:200px">
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
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">摄点介绍：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="remark" cols="" rows="" class="textarea"  placeholder="说点什么..." onKeyUp="textarealength(this,100)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
			</div>
		</div>
<!--        <div class="row cl"> -->
<!-- 			<label class="form-label col-xs-4 col-sm-3">摄点标签：</label> -->
<!-- 			<div class="formControls col-xs-8 col-sm-9"> -->
<!--			  <?php foreach($tags as $item){?>
<!--			  <input type="checkbox" name="checkbox[<?php echo $item['id']?>]" id="checkbox">
<!--			  <label for="checkbox"><?php echo $item['tagName']?></label>
<!--              <?php }?>
<!--             </div> -->
<!-- 		</div> -->
		<div class="row cl"></div>
		    <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;" ><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;所在地：</label>
	    <span id="city_4">&nbsp;&nbsp;&nbsp;&nbsp;<select class="prov" id="prov" name="province"></select> 
			<select class="city" id="city" name="city" disabled="disabled" ></select>
			<select class="dist" id="dist" name="county" disabled="disabled"></select> 
			<input type="text" id="address" name="address" class="input-text" style="width:19%" value="<?php echo $info['address']?>" />
			 <span class="btn btn-success radius" id="restPlaceSearch" >确认地址</span>
			
		</span>
    </div>
    <div class="row cl">
<div class="row cl">&nbsp;&nbsp;&nbsp;&nbsp;</div>
		    <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 标记位置：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <div id="container"></div>
			</div>
		 </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">摄点海报：</label> <span style="font-size:14px; "><div id="uploader-demo" style="text-indent: 23px;padding-top:20px">  
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
			    <input name="images" type="hidden" id="but" size="5">
			    <input name="postion" type="hidden" id="postion" size="8" />
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.cityselect.js"></script>
<script type="text/javascript" src="/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script type="text/javascript" src="/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="/static/admin/js/mapRestposition.js"></script>
<!--/_footer /作为公共模版分离出去--> 


<script type="text/javascript">
// var newAddress =  "深圳清华信息港";
// initShowMap(newAddress);

function initShowMap(newAddress){

	var map = new AMap.Map("container", {
        resizeEnable: true
    });
    var MapPosition;
    AMap.service(["AMap.PlaceSearch"], function() {
        var placeSearch = new AMap.PlaceSearch({ //构造地点查询类
            pageSize: 5,
            pageIndex: 1,
            city: "010", //城市
            map: map
          //  panel: "panel"
        });
        //关键字查询
var RenewAddress;
        if(newAddress == ''){
        	alert("请输入信息");
        	RenewAddress = "深圳清华信息港";
        	 //return;
        }else{
        	RenewAddress = newAddress;
        }

        placeSearch.search(RenewAddress,function(status,result){

        	if (status === 'complete' && result.info === 'OK') {

		        var poiArr =result.poiList.pois;
		       		//console.log(poiArr[0].Poi .id )
		             //console.log( poiArr.length)		          
		          MapPosition =poiArr[0].location;
		         // alert(MapPosition.getLng()
		        	// console.log(MapPosition)
		        	showMapRest(MapPosition);
				
	           //for (var i = 0; i < poiArr.length; i++) {
	                        // addmarker(i, poiArr[i]);
	               // }
	              //  mapObj.setFitView();
			} else {
				MapPosition = undefined;
				alert("亲!没有相关信息，请重新输入!");
				showMapRest(MapPosition);
		        //document.getElementById('tip').innerHTML = result.info;
		    } 
        });
    });
}
    
 function showMapRest(MapPosition){
	 
	 if(undefined === MapPosition ){
		 //默认地址
		 LngP = 113.94633;
		 LatP = 22.553923;
	 }else{
		 var LngP = MapPosition.getLng();
		 var LatP = MapPosition.getLat();
	 }
     var map = new AMap.Map('container', {
         resizeEnable: true,
         center: [LngP,LatP],
         zoom: 13
     });    
     map.clearMap();  // 清除地图覆盖物
     var center = map.getCenter();
     //写入表单
     $("#postion").val(LngP+','+LatP);
     var markers = [{
         icon: '/static/admin/images/mapPic1.png', //自定义标点图
         position: [center.getLng(), center.getLat()]
     }];
     // 添加一些分布不均的点到地图上,地图上添加三个点标记，作为参照
     markers.forEach(function(marker) {
         new AMap.Marker({
             map: map,
             icon: marker.icon,
             position: [marker.position[0], marker.position[1]],
             offset: new AMap.Pixel(-12, -36)
         });
     });
 }
 
</script>
<script>
$("#restPlaceSearch").click(function(){

	var prov = $("#prov").val();
	var city = $("#city").val();
	var dist = $("#dist").val();
	var address = $("#address").val();
	if(address == null){
		address='';
	}
	if( address == undefined ){
		address ='';
	}
	if( prov == undefined ){
		prov='';
	}
	if( city == undefined ){
		city='';
	}
	if( dist == undefined ){
		dist='';
	}
	var newAddr = prov+city+dist+address;

	initShowMap(newAddr);
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
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>

<script type="text/javascript">
$(function(){

	$("#city_4").citySelect({
    	prov:"广东", 
    	city:"深圳",
		dist:"南山区",
		nodata:"none"
	}); 
	
        $("#address").val("清华信息港");
		var prov = "广东";
		var city = "深圳";
		var dist = "南山区";
		var address = "清华信息港";
		if(address == null){
			address='';
		}
		if( address == undefined ){
			address ='';
		}
		if( prov == undefined ){
			prov='';
		}
		if( city == undefined ){
			city='';
		}
		if( dist == undefined ){
			dist='';
		}
		var newAddr = prov+city+dist+address;

		initShowMap(newAddr);

});

</script>