<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>


<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.cityselect.js"></script>

<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script> 

<script type="text/javascript" src="/lib/My97DatePicker/WdatePicker.js"></script>


<script type="text/javascript" src="/lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="/lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript" src="/static/js/json2.js"></script>



<link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/style.css" />

<link rel="stylesheet" type="text/css"  href="/static/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css"  href="/static/admin/css/bootstrap-select.css" />

<script type="text/javascript" src="/static/JQuery/jquery-1.10.2.min.js" ></script>

<script type="text/javascript" src="/static/admin/js/bootstrap-select.js" ></script>
<script type="text/javascript" src="/static/admin/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="/lib/bootstrap.min.js" ></script>


    <script type="text/javascript">
        $(window).on('load', function () {

            $('.selectpicker').selectpicker({
                'selectedText': 'cat'
            });

            // $('.selectpicker').selectpicker('hide');
        });
    </script>


<style type="text/css">
#containers {width:600px; height: 250px;border:1px solid #ccc;margin-left:50px;color:red; } 
.warp{width:80%; height:auto; clear:both;margin:0 auto;}
.left{float:left; width:500px; height:auto; margin-right:20px}
.right{float:left; width:500px; height:auto}
._line{width:100%; height:42px; line-height:42px}
.line-left{float:left; width:240px; height:42px; line-height:42px}
</style>



</head>

<body>

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 福利管理 <span class="c-gray en">&gt;</span> 发放优惠卷 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" class="btn btn-primary radius"> 发放优惠卷</a></span> </div>

<form class="form form-horizontal" id="form-member-add" name="form1" method="post" action=""  enctype="multipart/form-data">
<div class="warp">
    <div class="left row cl">
        <div class="_line formControls col-xs-8 col-sm-9" style="width:600px;"><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;福利卷主题：</label>
        <input type="hidden" name="admin_id" id="admin_id" class="input-text" style="width:370px" value="<?php echo $adminArr['uid'];?>" />
         <input type="text" name="coupons_title" id="coupons_title" class="input-text" style="width:370px"  />
    </div>
    <div class="_line formControls col-xs-8 col-sm-9"><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;有 效 时 间：</label>
    <input name="start_time" type="text" style="width:170px" id="start_time" size="15" class="input-text Wdate" onfocus="WdatePicker({dateFmt:'yyyy/MM/dd HH:mm'})"/> <label for="textfield"> - </label> <input name="end_time" style="width:170px" type="text" id="end_time" size="15" class="input-text Wdate" onfocus="WdatePicker({dateFmt:'yyyy/MM/dd HH:mm'})" />
    </div>
    <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;" ><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;福利卷类型：</label>
	    <span id="">
	        <select name="type" id="type">	        
	        <?php foreach ($typeArr as $k=>$val){?>
                  <option value="<?php echo $val['id'] ?> " style="width:50%;"><?php echo $val['coupons_name'] ?> </option>
               <?php } ?>  
	        </select> 			
		</span>
    </div>



     <!-- div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;" >
     <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;消费额范围：</label>
		 <input name="use_scope_min" type="text" class="input-text"  style="width:150px" id="use_scope_min" size="15"  />&nbsp; 至&nbsp; <input name="use_scope_max" type="text" class="input-text"  style="width:150px" id="use_scope_max" size="15" />元
    </div> --> 
 

       <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;heigth:150px;" >

		 <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;福利卷面额：</label>
		  <input name="coupons_value" type="text" class="input-text"  style="width:150px" id="coupons_value" size="15" />&nbsp;元
    </div> 
  
   
      <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;heigth:150px;" >
       <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发 放 数 量：</label>
		 <input name="coupons_number" type="text" class="input-text"  style="width:150px" id="coupons_number" size="15"  />&nbsp;张

    </div> 
    
    <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;heigth:150px;" >


		 <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="changeType" id="onlyoneact" value="1"/></label>
		 <label for="textfield" style="color:red;"> A.(选择后，只有该活动才能享受该优惠劵)</label>
		 
    </div> 
                    <div class="col-lg-10">
                     <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-success radius" id="act_name_sure" >确认</span></label>
                    <select id="bs3Select" class="selectpicker show-tick form-control" multiple data-live-search="true">
                        <option  value="1">我的活动1</option>
                        <option value="2">我的活动2</option>
                        <option  value="3">我的活动3</option>
                        
                            <option value="4">我的活动4</option>
                            <option value="5">我的活动5</option>
                            <option value="6">我的活动6</option>
						<!--optgroup label="test" data-subtext="another test" data-icon="icon-ok">
						 <option class="get-class" disabled>ox</option>
                            <option>ASD</option>
                            <option selected>Bla</option>
                            <option>Ble</option>
                        </optgroup-->
                    </select>
                </div>
    <div class="_line formControls col-xs-8 col-sm-9"  id="act_notice_id"  style="float:left;width:900px;heigth:150px;display:none;" >
        <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <input name="act_name_id" type="hidden" id="act_name_id"  class="input-text"  style="width:150px" size="15" /><input name="" type="text" id="act_name"  class="input-text"  style="width:300px" size="15" placeholder="请输入活动主题名称" /></label>
		  
		  <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-success radius" id="act_name_sure" >确认</span></label>
    </div> 
    
    <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:600px;" >

		 <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="changeType" id="is_business" value="2" /></label>
		 <label for="textfield" style="color:#00CC00;"> B.(选择后，该所属商家发布的所有活动将享受该优惠劵)</label>
		 
    </div> 
    

        
    <div class="_line formControls col-xs-8 col-sm-9"   id="business_notice_id"   style="float:left;width:800px;heigth:150px;display:none;" >
        <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="business_ids" type="hidden" id="business_ids"  class="input-text"  style="width:300px" size="15"  /><input name="" type="text" id="business_id"  class="input-text"  style="width:300px" size="15"  placeholder="请输入商家昵称" /></label>
		  
		  <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-success radius" id="business_id_sure" >确认</span></label>
    </div>    
        
    <!-- div  style="float:left;width:800px;border:1px solid #eee;" >
        <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;height:0px;" >
        <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="business_id" type="text" id="business_id"  class="input-text"  style="width:150px" size="15" value="" /></label>
		  
		  <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-success radius" id="business_id_sure" >确认</span></label>
    </div> 
    </div>    --> 
       
        
    <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;heigth:150px;" >

		 <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="changeType" id="business_all" value="3" /></label>
		 <label for="textfield" style="color:#00CC00;"> C.(发布所有商家，活动类型活动)</label>
		 
    </div> 
    

          <div class="_line formControls col-xs-8 col-sm-9" id = "actType" style="float:left;width:800px; " ><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动类型：</label>
	    <span id="">
	        <select name="act_type" id="act_type">
	         <option value="0" style="width:50%;">全 部 活 动</option>
	        <?php foreach ($actType as $k=>$val){?>
                  <option value="<?php echo $val['id']; ?> " style="width:50%;"><?php echo $val['title'];?></option>
               <?php } ?>  
	        </select> 	
	           
	            <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;子节点类型：</label>
              <select name="son_id" id="son_id">
                  <option value="0">无</option>
                  <?php foreach ($son as $s){?>
                  <option value="<?php echo $s['id']?>"><?php echo $s['title']?></option>
                  <?php }?>
              </select>		
		</span>
    </div> 

 

      <div class="_line formControls col-xs-8 col-sm-9" id = "userType"  style="float:left;width:800px;" >
    <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用户类型：</label>
	    <span id="">
	        <select name="user_type" id="user_type">
	        <option value="0" style="width:50%;"> 全 部   </option>
	     		  <option value="1" style="width:50%;">普通用户类型 </option>
                  <option value="2" style="width:50%;">认证用户类型</option>
              
	        </select> 	
	        		
		</span>
		    <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认证用户：</label>
	    <span id="">
	        <select name="user_type_child" id="user_type_child">
	        <option value="0" style="width:50%;"> 无   </option>
                  <option value="1" style="width:50%;">摄影师</option>
                  <option value="2" style="width:50%;">麻豆</option>
                  <option value="3" style="width:50%;">社会团体</option>
                  <option value="4" style="width:50%;">商业机构</option>
                  <option value="5" style="width:50%;">官方</option> 
	        </select> 			
		</span>
    </div>
        <!--div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;heigth:150px;" >

		 < label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="is_support" id="checkbox" value="" /></label>
		 <label for="textfield" style="color:#06f;"> D:是否支持消费完该优惠劵后，赠送其他活动优惠劵</label> 
		 
    </div> -->
    
 
    
    <div class="row cl">
			<div class="formControls col-xs-8 col-sm-9">
			
              
			</div>
	 </div>
	 
	     <div class="row cl">
			<div class="formControls col-xs-8 col-sm-9">
               <div id="containers">
                <label for="textfield" style="color:;"> 活动优惠劵说明:</label><br />
			 选择条件：<br />

 &nbsp;&nbsp;&nbsp;  1.A,B和C只能三选一。<br />

 &nbsp;&nbsp;&nbsp;  2.必选项或者可选项，默认为全部<br />


后台发放和APP获取优惠劵原则：<br />

 &nbsp;&nbsp;&nbsp;  1.所有的优惠劵将享受 "先到先得"的原则。用户在APP首页活动界面领取优惠劵。<br />

 &nbsp;&nbsp;&nbsp;  2.如果后台操作人员勾选了C。则使用该优惠劵的活动，支持赠送其他优惠劵服务。<br />

   此APP操作界面为（我的订单详情页面，优惠劵领取框）.<br />

  &nbsp;&nbsp;&nbsp; 3.如支持赠送其他一个或者多个优惠劵服务，如果后台发现可赠送多个优惠劵。随机选择   一个赠送 即可。<br />

               
               </div>
			</div>
		 </div>
	 
	
    
    <div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">

			</div>
		</div>
    
       		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
		    
                <input class="btn btn-primary radius" type="submit" name="button" id="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" />
			</div>
		</div>
		
		<div class="row cl"  style="height:20px;>
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">

			</div>
		</div>
    
</div>
 
    

  <p>&nbsp;</p>
</form>
            <div class="form-group" style="width:1000px;height:400px;">
                <label for="bs3Select" class="col-lg-2 control-label">选择发布的活动：</label>
                <div class="col-lg-10">
                    <select id="bs3Select" class="selectpicker show-tick form-control" multiple data-live-search="true">
                        <option>我的活动1</option>
                        <option>我的活动2</option>
                        <option >我的活动3</option>
                        
                            <option>我的活动4</option>
                            <option>我的活动5</option>
                            <option>我的活动6</option>
						<!--optgroup label="test" data-subtext="another test" data-icon="icon-ok">
						 <option class="get-class" disabled>ox</option>
                            <option>ASD</option>
                            <option selected>Bla</option>
                            <option>Ble</option>
                        </optgroup-->
                    </select>
                </div>
              </div>

</body>

<script>
$(function(){

	var numCount =1;
	
	
shoot = '';
	
	$(".add_cart").click(function(){
		numCount ++;
	    $(".act_list").append('<div class="act_box"><div class="box_size"><textarea rows="5" name="cont[]" cols="60"></textarea></div><div class="images"><input type="file" name="file'+numCount+'" id="fileField'+numCount+'" /></div></div>');
	});
});
</script>
<script> 
$(function(){
	
	
	$("#form-member-add").validate({
		rules:{
			coupons_title:{
				required:true,
				minlength:2,
				maxlength:50
			},
			coupons_value:{
				required:true,
				//isMobile:true,
			},
			coupons_number:{
				required:true,
// 				isMobile:true,
				},
			start_time:{
				required:true,
			},
			end_time:{
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
$("#onlyoneact").click(function(){
	$("#actType").attr("style","display:none");
	$("#userType").attr("style","display:block");
	$("#act_notice_id").attr("style","display:block")
	$("#business_notice_id").attr("style","display:none")
	if( strleng($("#business_ids").val()) > 0 ){	
	    $("#business_ids").val("");
	}
});
$("#is_business").click(function(){
	$("#actType").attr("style","display:block");
	$("#userType").attr("style","display:none");
	$("#act_notice_id").attr("style","display:none");
	$("#business_notice_id").attr("style","display:block");
	if( strleng($("#act_name_id").val()) > 0 ){	
	    $("#act_name_id").val("");
	}
});
$("#business_all").click(function(){
	$("#actType").attr("style","display:block");
	$("#userType").attr("style","display:block");
	$("#act_notice_id").attr("style","display:none");
	$("#business_notice_id").attr("style","display:none");
		
	if( strleng($("#act_name_id").val()) > 0 ){	
		    $("#act_name_id").val("");
	}
	if( strleng($("#business_ids").val()) > 0 ){	
	    $("#business_ids").val("");
	}
// 	alert($("#business_ids").val());
// 	alert($("#act_name_id").val());
});

function strleng(str){
	var l = str.length; 
	var blen = 0; 
	for(i=0; i<l; i++) { 
	if ((str.charCodeAt(i) & 0xff00) != 0) { 
	blen ++; 
	} 
	blen ++; 
	}
	return blen;
}
$("#user_type_child").attr("disabled","disabled");

$("#user_type").change(function(){
	$title = $(this).find("option:selected").text();
	if($title == '认证用户类型'){
		$("#user_type_child").removeAttr("disabled");
	}else{
		$("#_end").attr("style","display:none");

		$("#user_type_child ").get(0).selectedIndex=0; //设置Select索引值为1的项选中 
// 		$("#son_id ").val(4); // 设置Select的Value值为4的项选中 
// 		$("#son_id option[text=' ']").attr("selected", true); //设置Select的Text值为  空 的项选中 

		$("#user_type_child").attr("disabled","disabled");
	}
});

$("#close").click(function(){
	layer.closeAll();
});


$("#son_id").attr("disabled","disabled");
$("#act_type").change(function(){
	var title = $(this).find("option:selected").text();

	if( title == '旅拍团'){
		$("#son_id ").get(0).selectedIndex=1;
		$("#son_id").removeAttr("disabled");
	}else{
		$("#son_id ").get(0).selectedIndex=0; //设置Select索引值为1的项选中 
		$("#son_id").attr("disabled","");
	}
});	
</script>

<script>
$(function(){
	$("#business_id_sure").click(function(){
		var busname = $("#business_id");
		name = busname.val();

		if(name.length <= 0){
			alert('请输入数据!');
			return;
		}
		$.get('/admin/Coupons/getCouponsbusiness?name='+name,function(result){

			if(result == false){
				alert('无数据!');
				return;
				}
           var jsons = eval(result); 
            $.each(jsons, function (index, item) {  
                var Key = jsons[index].id;  
                var user_type = jsons[index].user_type;  
                var user_account = jsons[index].account;
                var user_nickname = jsons[index].nickname;
                var name;
                if(user_nickname){
                	name = user_nickname;
                }else{
                	name = user_account
                }
                $("#business_ids").val(Key)
				busname.val(name)
               // $("#list").html($("#list").html() + "<br>" + Key + "----" + Info.name); //+ " - " + idnumber + " - " + sex + "<br/>");  
            });

			//$("#textarea").val(result.content);
		},'json'); 
	});
	$("#act_name_sure").click(function(){
		var actname = $("#act_name");
		name = actname.val();
		if(name.length <= 0){
			alert('请输入数据!');
			return;
		}
		$.get('/admin/Coupons/getCouponsActivity?name='+name,function(result){
			if(result == false){
				alert('无数据!');
				return;
				}
// 			results = eval('('+result+')');
            var jsons = eval(result); 
            $.each(jsons, function (index, item) {  
                var Key = jsons[index].id;  
                var Info = jsons[index].title;  
                	$("#act_name_id").val(Key)
					actname.val(Info)
            }); 
		},'json'); 
	});	
	
});
</script>



</html>


