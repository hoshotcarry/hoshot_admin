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

<title>添加定制游</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 主题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select class="input-text" id="title" name="title">
                       <option value="自然风光" <?php if($info['title'] == '自然风光') echo 'selected';?>>自然风光</option>
                       <option value="历史人文" <?php if($info['title'] == '历史人文') echo 'selected';?>>历史人文</option>
                       <option value="休闲度假" <?php if($info['title'] == '休闲度假') echo 'selected';?>>休闲度假</option>
                       <option value="美食主题" <?php if($info['title'] == '美食主题') echo 'selected';?>>美食主题</option>
                       <option value="豪华游轮" <?php if($info['title'] == '豪华游轮') echo 'selected';?>>豪华游轮</option>
                       <option value="其他" <?php if($info['title'] == '其他') echo 'selected';?>>其他</option>
                </select>
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 拟用户id：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"  value="<?php echo $info['user_id'];?>" id="title" name="user_id">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 姓名：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <input type="text" class="input-text" value="<?php echo $info['name'];?>" id="equipment" name="name">
			</div>
		 </div>
		 
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 电话：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <input type="text" class="input-text" value="<?php echo $info['phone'];?>"  name="phone">
			</div>
		 </div>
		 
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">类型：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <select class="input-text" id="type" name="type">
                       <option value="1" <?php if($info['type'] == 1) echo 'selected';?>>企业单位</option>
                       <option value="2" <?php if($info['type'] == 2) echo 'selected';?>>组织机构</option>
                       <option value="3" <?php if($info['type'] == 3) echo 'selected';?>>个人好友</option>
                </select>
			</div>
		 </div>
		 
         <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"> 人数：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $info['people'];?>" name="people">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"> 天数：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $info['people'];?>" name="days">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">价格：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <input type="text" class="input-text" value="<?php echo $info['price'];?>" name="price">
			</div>
		 </div>
		 
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">更多：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <input type="text" class="input-text" value="<?php echo $info['more'];?>" name="more">
			</div>
		 </div>
		 
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"> 性质：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select class="input-text" id="nature" name="nature">
				       <?php if($info['type'] == 1){?>                                            
                       <option value="公司奖励" <?php if($info['nature'] == '公司奖励') echo 'selected';?>>公司奖励</option>
                       <option value="机构员工" <?php if($info['nature'] == '机构员工') echo 'selected';?>>机构员工</option>
                       <option value="商务会议" <?php if($info['nature'] == '商务会议') echo 'selected';?>>商务会议</option>
                       <option value="年末会议" <?php if($info['nature'] == '年末会议') echo 'selected';?>>年末会议</option>
                       <option value="业余培训" <?php if($info['nature'] == '业余培训') echo 'selected';?>>业余培训</option>
                       <option value="其他" <?php if($info['nature'] == '其它') echo 'selected';?>>其它</option>
                       <?php }?>
                       
                       <?php if($info['type'] == 2){?>
                       <option value="机构外游" <?php if($info['nature'] == '机构外游') echo 'selected';?>>机构外游</option>
                       <option value="机构比赛" <?php if($info['nature'] == '机构比赛') echo 'selected';?>>机构比赛</option>
                       <option value="课外培训" <?php if($info['nature'] == '课外培训') echo 'selected';?>>课外培训</option>
                       <option value="户外拓展" <?php if($info['nature'] == '户外拓展') echo 'selected';?>>户外拓展</option>
                       <option value="其他" <?php if($info['nature'] == '其他') echo 'selected';?>>其他</option>
                       <?php }?>
                       
                       <?php if($info['type'] == 3){?>
                       <option value="家庭欢聚" <?php if($info['nature'] == '家庭欢聚') echo 'selected';?>>家庭欢聚</option>
                       <option value="友人结伴" <?php if($info['nature'] == '友人结伴') echo 'selected';?>>友人结伴</option>
                       <option value="情侣蜜月" <?php if($info['nature'] == '情侣蜜月') echo 'selected';?>>情侣蜜月</option>
                       <option value="独自出发" <?php if($info['nature'] == '独自出发') echo 'selected';?>>独自出发</option>
                       <option value="其他" <?php if($info['nature'] == '其他') echo 'selected';?>>其他</option>
                       <?php }?>
                       
                </select>
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"> 交通：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select class="input-text" id="model" name="traffic">
                       <option value="飞机" <?php if($info['traffic'] == '飞机') echo 'selected';?>>飞机</option>
                       <option value="火车/高铁" <?php if($info['traffic'] == '火车/高铁') echo 'selected';?>>火车/高铁</option>
                       <option value="汽车" <?php if($info['traffic'] == '汽车') echo 'selected';?>>汽车</option>
                       <option value="游轮" <?php if($info['traffic'] == '游轮') echo 'selected';?>>游轮</option>
                       <option value="自驾" <?php if($info['traffic'] == '自驾') echo 'selected';?>>自驾</option>
                       <option value="其他" <?php if($info['traffic'] == '其它') echo 'selected';?>>其它</option>
                </select>
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">酒店：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <select class="input-text" id="model" name="hotel">
                       <option value="豪华五星" <?php if($info['hotel'] == '豪华五星') echo 'selected';?>>豪华五星</option>
                       <option value="豪华四星" <?php if($info['hotel'] == '豪华四星') echo 'selected';?>>豪华四星</option>
                       <option value="高级三星" <?php if($info['hotel'] == '高级三星') echo 'selected';?>>高级三星</option>
                       <option value="特色酒店" <?php if($info['hotel'] == '特色酒店') echo 'selected';?>>特色酒店</option>
                       <option value="名宿" <?php if($info['hotel'] == '民宿') echo 'selected';?>>民宿</option>
                       <option value="其他" <?php if($info['hotel'] == '其它') echo 'selected';?>>其它</option>
                </select>
			</div>
		 </div>
		 
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">房型：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <select class="input-text" id="model" name="room_size">
                       <option value="标准房" <?php if($info['room_size'] == '标准房') echo 'selected';?>>标准房</option>
                       <option value="豪华房"<?php if($info['room_size'] == '豪华房') echo 'selected';?>>豪华房</option>
                       <option value="其他"<?php if($info['room_size'] == '其它') echo 'selected';?>>其它</option>
                </select>
			</div>
		 </div>
		 
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"> 用餐：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select class="input-text" id="model" name="dining">
                       <option value="顶级餐厅" <?php if($info['dining'] == '顶级餐厅') echo 'selected';?>>顶级餐厅 </option>
                       <option value="当地风味" <?php if($info['dining'] == '当地风味') echo 'selected';?>>当地风味</option>
                       <option value="其他" <?php if($info['dining'] == '其它') echo 'selected';?>>其它</option>
                </select>
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"> 签证：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <select class="input-text" id="model" name="visa">
                       <option value="" <?php if(empty($info['visa'])) echo 'selected';?>>无</option>
                       <option value="需要办理" <?php if($info['visa'] == '需要办理') echo 'selected';?>>需要办理</option>
                       <option value="自行办理" <?php if($info['visa'] == '自行办理') echo 'selected';?>>自行办理</option>
                </select>
			</div>
		 </div>
		 
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"> 目的地：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $info['destination'];?>" name="destination">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"> 起始地：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <input type="text" class="input-text" value="<?php echo $info['start_adress'];?>" name="start_adress">
			</div>
		 </div>
		 
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 我的地址：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <input type="text" class="input-text" value="<?php echo $info['address'];?>" name="address">
			</div>
		 </div>
		 
		  <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 开始时间：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input name="start_time" type="text" id="start_time" value="<?php echo date("Y/m/d H:i:s",$info['start_time']);?>" size="15" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy/MM/dd HH:mm'})"/>
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 结束时间：</label>
			<div class="formControls col-xs-8 col-sm-9">
               <input name="end_time" type="text" id="end_time" size="15" value="<?php echo date("Y/m/d H:i:s",$info['end_time']);?>"  class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy/MM/dd HH:mm'})" />
			</div>
		 </div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
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
<script type="text/javascript">
$(function(){
	$("#type").change(function(){
		$title = $(this).find("option:selected").text();
		$("#nature").empty();
		if($title == '组织机构'){
			$("#nature").append('<option value="机构外游">机构外游</option><option value="机构比赛">机构比赛</option><option value="课外培训">课外培训</option><option value="户外拓展">户外拓展</option><option value="其他">其他</option>');
		}
		if($title == '个人好友'){
			$("#nature").append('<option value="家庭欢聚">家庭欢聚</option><option value="友人结伴">友人结伴</option><option value="情侣蜜月">情侣蜜月</option><option value="独自出发">独自出发</option><option value="其他">其他</option>');
		}
	});
});
</script>
</body>
</html>