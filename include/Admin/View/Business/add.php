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
<style type="text/css">
#container {width:520px; height: 520px; } 
</style>
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->
<title>添加商家</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 商家名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="输入商家名称"  placeholder="" id="title" name="name">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 商家地址：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <input type="text" class="input-text" id="address" placeholder="请输入商家地址, 如: 广东深圳南山区 清华信息港" id="equipment" name="address" style="width:80%;">
			   <span class="btn btn-success radius" id="restPlaceSearch" >确认地址</span>
			</div>
		 </div>
		 
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">商家电话：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <input type="text" class="input-text" maxlength="15" placeholder="输入商家电话" id="equipment" name="phone">
			</div>
		 </div>
		 
		 <div class="row cl">
		    <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 标记位置：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <div id="container"></div>
			</div>
		 </div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
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

<!--/_footer /作为公共模版分离出去--> 
<script type="text/javascript">
var newAddress =  "广东深圳南山区清华信息港";
initShowMap(newAddress);

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

<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>