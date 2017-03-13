<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看活动</title>
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
<form class="form form-horizontal" id="form-member-add" name="form1" method="post" action="">
<div class="warp">
    <div class="left row cl">
        <div class="_line formControls col-xs-8 col-sm-9"><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动主题：</label>
        <?php echo $info['title']?>
    </div>
    <div class="_line formControls col-xs-8 col-sm-9"><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动时间：</label>
    <?php echo date("Y-m-d H:i:s",$info['start_time'])?> - <?php echo date("Y-m-d H:i:s",$info['end_time'])?>
    </div>
    <div class="_line formControls col-xs-8 col-sm-9"><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动地址：</label>
   	<?php echo $info['province']?> <?php echo $info['city']?> <?php echo $info['county']?> <?php echo $info['address']?>
    </div>
    <div class="row cl">
			<div class="formControls col-xs-8 col-sm-9">
               <div id="container"></div>
			</div>
		 </div>
    <div class="_line formControls col-xs-8 col-sm-9"><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动频道：</label>
                <?php echo $info['channel_id'];?>
        
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动分类：</label> 
              <?php echo $info['_title'];?>
              <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;出行方式：</label>             
                  <?php echo $info['go_type'];?>          
    </div>
    
<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">&nbsp;&nbsp;&nbsp;&nbsp;活动海报：</label>

			<div class="formControls col-xs-8 col-sm-9">
				<div id="thelist" class="uploader-list" style="margin-left: 23px"><img src="<?php echo $info['face']?>" /></div>
			</div>
		</div>
    

    
        <div class="_line formControls col-xs-8 col-sm-9">
			   <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动费用：</label>
               <?php echo $info['activity_price']?> <label>元 / 人&nbsp;&nbsp;&nbsp;&nbsp;</label> 
               <label>活动人数：</label>
               <?php echo $info['need']?>  <label>人</label>

		 </div>
		 
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">活动标签：</label>
			<div class="formControls col-xs-8 col-sm-9">
			  <?php foreach($tag as $item){?>
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
        <div class="act_list">
                   <?php foreach($cart as $item){?>
                   <div class="act_box">
                        <div class="box_size"><?php echo $item['content']?></div>
                        <div class="images" style="height: auto">
                          <img src="<?php echo $item['images']?>" />
                          <div style="width: 100%; height:1px; clear:both"></div>
                        </div>
                        <div style="width: 100%; height:1px; clear:both"></div>
                   </div> <?php }?>
         </div>

			</div>
		</div>
    
    <div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">

			</div>
		</div>
    
       		<div class="row cl">

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
	
    shoot = '';
	
	$(".add_cart").click(function(){
	    $(".act_list").append('<div class="act_box"><div class="box_size"><textarea rows="5" name="cont[]" cols="60"></textarea></div><div class="images"><input type="file" name="fileField[]" id="fileField" /></div></div>');
	});
	
});
</script>

<script>
var longitude = <?php echo $info['longitude']?>;
var latitude  = <?php echo $info['latitude']?>;

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

</html>
