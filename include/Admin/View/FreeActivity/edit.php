<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加活动</title>
<script src="http://webapi.amap.com/maps?v=1.3&key=64f731cf2ac66b4949818c73c57ef4df"></script>
<script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>


<link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/style.css" />
<link href="/static/uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<link href="/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#container {width:798px; height: 280px; } 
.warp{width:100%; height:auto; clear:both}
.left{float:left; width:500px; height:auto; margin-right:20px}
.right{float:left; width:500px; height:auto}
._line{width:100%; height:42px; line-height:42px}
.line-left{float:left; width:240px; height:42px; line-height:42px}
</style>
</head>

<body>

<form class="form form-horizontal" id="form-member-add" name="form1" method="post" action=""  enctype="multipart/form-data">
<div class="warp">
    <div class="left row cl">
        <div class="_line formControls col-xs-8 col-sm-9"><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动主题：</label>
        <input type="hidden" name="act_id" id="act_id" class="input-text" style="width:370px" value="<?php echo $info['id']?>" />
        <input type="text" name="title" id="title" class="input-text" style="width:370px" value="<?php echo $info['title']?>" />
    </div>
    <div class="_line formControls col-xs-8 col-sm-9"><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动时间：</label>
    <input name="start_time" type="text" style="width:170px" id="start_time" size="15" class="input-text Wdate" value="<?php echo date("Y-m-d H:i:s",$info['start_time'])?>" onfocus="WdatePicker({dateFmt:'yyyy/MM/dd HH:mm'})"/> <label for="textfield"> - </label> <input name="end_time" style="width:170px" type="text" id="end_time" size="15" class="input-text Wdate" value="<?php echo date("Y-m-d H:i:s",$info['end_time'])?>" onfocus="WdatePicker({dateFmt:'yyyy/MM/dd HH:mm'})" />
    </div>
    <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;" ><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动地址：</label>
    <span id="city_4"><select class="prov" id="prov" name="province"></select> 
	<select class="city" id="city" name="city" disabled="disabled" ></select>
	<select class="dist" id="dist" name="county" disabled="disabled"></select> 

	<input type="hidden" name="address" id="longitude" class="input-text" style="width:19%" value="<?php echo $info['longitude']?>" />
	<input type="hidden" name="address" id="latitude" class="input-text" style="width:19%" value="<?php echo $info['latitude']?>" />

	<input type="text" name="address" id="address" class="input-text" style="width:19%" value="<?php echo $info['address']?>" />
	<span class="btn btn-success radius" id="restPlaceSearch" >确认地址</span>
	</span>
    </div>
    <div class="row cl">
			<div class="formControls col-xs-8 col-sm-9">
               <div id="container"></div>
			</div>
		 </div>
    <div class="_line formControls col-xs-8 col-sm-9"><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动频道：</label>
        <select name="channel_id" id="channel_id">
                <?php foreach ($category as $c => $r){?>
                <option value="<?php echo $r['id']?>" <?php if($r['id'] == $info['channel_id']) echo 'selected'?>><?php echo $r['title']?></option>
                <?php }?>
              </select>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select name="son_id" id="son_id">
                  <option value="0">无</option>
                  <?php foreach ($son as $s){?>
                  <option value="<?php echo $s['id']?>"><?php echo $s['title']?></option>
                  <?php }?>
              </select>
    </div>
    
<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">&nbsp;&nbsp;&nbsp;&nbsp;活动海报：</label> <span style="font-size:14px; "><div id="uploader-demo" style="text-indent: 23px;padding-top:20px"> <div>  
			 <div id="filePicker">选择图片</div>  
             <span id="ctlBtn" class="btn btn-success radius">开始上传</span>  
    </div>  
</div>  

			<div class="formControls col-xs-8 col-sm-9">
				<div id="thelist" class="uploader-list" style="margin-left: 23px"><img src="<?php echo $info['face']?>" /></div>
			</div>
		</div>
    
        <div class="_line formControls col-xs-8 col-sm-9">
               <input type="text" class="input-text" style="display:none" id="equipment" name="activity_price" value="0">
               <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动人数：</label>
               <input type="text" class="input-text" style="width: 100px" id="equipment" name="need" value="<?php echo $info['need']?>">  <label>人</label>

		 </div>
		 
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">活动标签：</label>
			<div class="formControls col-xs-8 col-sm-9">
			  <?php foreach($tags as $item){?>
			  <input type="checkbox" name="checkbox[<?php echo $item['id']?>]" id="checkbox" <?php if(in_array($item['id'],$_tag))echo 'checked'?>>
			  <label for="checkbox"><?php echo $item['tagName']?></label>
              <?php }?>
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">活动详情：</label>
			<div class="formControls col-xs-8 col-sm-9">

        <style>
        .act_box{width:500px; padding:20px; margin-top:20px; height:auto; background-color:#CCC}
		.box_shoot{ margin-top:13px; margin-bottom:13px}
		.add_cart{width:540px; cursor:pointer; height:36px; line-height:36px; background-color:#396; text-align:center; margin-top:20px; color:#FFF}
		.images img{max-width:460px; max-height:300px; margin-bottom:26px; margin-top:26px}
        </style>
        <div class="act_list"><?php foreach($cart as $key=>$item){?>
                   <div class="act_box">
                        <div class="box_size"><textarea rows="5" name="cont[]" cols="60"><?php echo $item['content']?></textarea></div>
                        <div class="images" style="height: auto">
                          <img src="<?php echo $item['images']?>" />
                           <input type="hidden" name="act_Des_images<?php echo $key+1; ?>"  value="<?php echo $item['images']?>" />
                           <input type="hidden" name="act_Des_ID<?php echo $key+1; ?>"  value="<?php echo $item['id']?>" />
                           <input type="file" name="file<?php echo $key+1; ?>" id="fileField<?php echo $key+1; ?>" />
                          <div style="width: 100%; height:1px; clear:both"></div>
                        </div>
                        <div style="width: 100%; height:1px; clear:both"></div>
                   </div> <?php }?>
         </div>
         
         <div class="add_cart">增加详情卡片</div>

			</div>
		</div>
    
    <div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">

			</div>
		</div>
    
       		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			    <input name="postion" type="hidden" id="postion" size="8" value="<?php echo $info['longitude']?>,<?php echo $info['latitude']?>" /><input type="hidden" name="face" id="but" value="<?php echo $info['face']?>" />
                <input class="btn btn-primary radius" type="submit" name="button" id="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" />
			</div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">

			</div>
		</div>
    
</div>


  <p>&nbsp;</p>
</form>
</body>
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.cityselect.js"></script>

<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script> 

<script type="text/javascript" src="/lib/My97DatePicker/WdatePicker.js"></script>

<script type="text/javascript" src="/static/uploadify/jquery.uploadify.min.js"></script>

<script type="text/javascript" src="/lib/webuploader/0.1.5/webuploader.min.js"></script> 

<script type="text/javascript" src="/lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="/lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript" src="/static/js/json2.js"></script>

<script>

$(function(){
	var numCount =<?php echo count($cart); ?>;
	
shoot = '';

$(".add_cart").click(function(){
		numCount ++;
	    $(".act_list").append('<div class="act_box"><div class="box_size"><textarea rows="5" name="cont[]" cols="60"></textarea></div><div class="images"><input type="file" name="file'+numCount+'" id="fileField'+numCount+'" /> <input type="hidden" name="act_Des_ID'+numCount+'"  value="editToAdd" /></div></div>');
	});
});
</script>
<script>

$("#son_id").attr("disabled","disabled");

$("#channel_id").change(function(){
	$title = $(this).find("option:selected").text();
	if($title == '旅拍团'){
		$("#son_id").removeAttr("disabled");
	}
});

    $("#close").click(function(){
		layer.closeAll();
	});
</script>
<script>

var longitude = $("#longitude").val();
var latitude  = $("#latitude").val();

var map = new AMap.Map('container',{
    resizeEnable: true,
    zoom: 13,
    center: [longitude,latitude]
});
AMap.plugin('AMap.Geocoder',function(){
var geocoder = new AMap.Geocoder({
    city: "010"//城市，默认：“全国”
});
var marker = new AMap.Marker({
    map:map,
    bubble:true
})
var input = document.getElementById('input');
var message = document.getElementById('message');

map.on('click',function(e){
    marker.setPosition(e.lnglat);
    $("#postion").val(e.lnglat);
    geocoder.getAddress(e.lnglat,function(status,result){})
})

});
map.clearMap();  // 清除地图覆盖物
//var center = map.getCenter();

var markers = [{
    icon: '/static/admin/images/mapPic1.png', //自定义标点图
    position: [longitude, latitude]
}];
// 添加一些分布不均的点到地图上,地图上添加三个点标记，作为参照
markers.forEach(function(marker) {
    new AMap.Marker({
        map: map,
        icon: marker.icon,
        position: [longitude, latitude],
        offset: new AMap.Pixel(-12, -36)
    });
});
</script>

<script type="text/javascript">
//var newAddress =  "深圳清华信息港";//默认地址
//initShowMap(newAddress);

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
alert(RenewAddress)
        placeSearch.search(RenewAddress,function(status,result){

        	if (status === 'complete' && result.info === 'OK') {

		        var poiArr =result.poiList.pois;
		       		//console.log(poiArr[0].Poi .id )
		             //console.log( poiArr.length)		          
		          MapPosition =poiArr[0].location;
		         // alert(MapPosition.getLng())
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
		 var LngP = $("#longitude").val();
		 var LatP  = $("#latitude").val();
		 //LngP = 113.94633;
		 //LatP = 22.553923;
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

<script>
$(function(){
	$("#qis_id").change(function(){
		$id = $(this).val();
		$.get('/admin/Activity/qisclaimer?id='+$id,function(result){
			$("#textarea").val(result.content);
		},'json');
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
	   $("#thelist").text('');
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
       $("#but").val(response.path);
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

<script type="text/javascript">
$(function(){
	
	//demo04
	$("#city_4").citySelect({
		prov:"<?php echo $info['province']?>", 
    	city:"<?php echo $info['city']?>",
		dist:"<?php echo $info['county']?>", 
		nodata:"none"
	}); 

	$("#city_3").citySelect({
    	prov:"广东", 
    	city:"深圳",
		dist:"南山区",
		nodata:"none"
	});
});

var ue = UE.getEditor('description');

</script>
</html>
