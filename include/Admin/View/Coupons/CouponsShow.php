<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看优惠券</title>
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

<link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/style.css" />
<link href="/static/uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<link href="/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#container {width:600px; height: 350px;border:1px solid #fff;margin-left:50px;color:red; } 
.warp{width:80%; height:auto; clear:both;margin:0 auto;}
.left{float:left; width:500px; height:auto; margin-right:20px}
.right{float:left; width:500px; height:auto}
._line{width:100%; height:42px; line-height:42px}
.line-left{float:left; width:240px; height:42px; line-height:42px}
</style>
</head>

<body>
<article class="page-container">


<form class="form form-horizontal" id="form-member-add" name="form1" method="post" action=""  enctype="multipart/form-data">
<div class="warp">
 <?php foreach ($arr as $k=>$val){}?>
    <div class="left row cl">
        <div class="_line formControls col-xs-8 col-sm-9" style="width:600px;"><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;福利卷主题：</label>
        <input type="hidden" name="admin_id" id="admin_id" class="input-text" style="width:370px" value=" <?php echo $val['coupons_title'];?>" />
         <input type="text" name="coupons_title" id="coupons_title" class="input-text" style="width:370px"  value=" <?php echo $val['coupons_title'];?>"  readonly="readonly"  />
    </div>
    <div class="_line formControls col-xs-8 col-sm-9"><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;有 效 时 间：</label>
     <input name="" type="text" class="input-text"  style="width:150px" id="" size="15"  value="<?php echo date("Y-m-d H:i:s",$val['start_time'])?>"  readonly="readonly"    />
 <label for="textfield"> - </label> <input name="" type="text" class="input-text"  style="width:150px" id="" size="15"  value="<?php echo date("Y-m-d H:i:s",$val['end_time'])?>"  readonly="readonly"    />
    </div>
    <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;" ><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;福利卷类型：</label>
	    <span id="">
	        <select name="type" id="type">	        
                  <option value="<?php echo $val['id'] ?> " style="width:50%;"><?php echo $val['coupons_name'] ?> </option>
	        </select> 			
		</span>
    </div>



     <!-- div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;" >
     <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;消费额范围：</label>
		 <input name="use_scope_min" type="text" class="input-text"  style="width:150px" id="use_scope_min" size="15"  />&nbsp; 至&nbsp; <input name="use_scope_max" type="text" class="input-text"  style="width:150px" id="use_scope_max" size="15" />元
    </div> --> 
 

       <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;heigth:150px;" >

		 <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;福利卷面额：</label>
		  <input name="coupons_value" type="text" class="input-text"  style="width:150px" id="coupons_value" size="15"  value=" <?php echo $val['coupons_value'];?>"  readonly="readonly"  />&nbsp;元
    </div> 
  
   
      <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;heigth:150px;" >
       <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发 放 数 量：</label>
		 <input name="coupons_number" type="text" class="input-text"  style="width:150px" id="coupons_number" size="15"  value=" <?php echo $val['coupons_number'];?>"  readonly="readonly"    />&nbsp;张


    <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;heigth:150px;" >

		 <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="changeType" id="onlyoneact" <?php  $actid = $val['act_id'];if ($actid != 0 ) {  ?>  checked = "checked"   readonly="readonly" <?php }else{?> <?php }?> /></label>
		 <label for="textfield" style="color:red;"> A.(选择后，只有该活动才能享受该优惠劵)</label>
		 
    </div> 
    <?php  if ($val['act_id'] != 0 ) {  ?>
    <div class="_line formControls col-xs-8 col-sm-9"  id="act_notice_id"  style="float:left;width:600px;height:50px;" >
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="textfield" > 活动列表:</label>
        <label for="textfield"> 
                 <select name="son_id" id="son_id">
                  <?php foreach ( $val['title'] as  $ke=> $v){?>
                  <option value="<?php echo $ke?>"><?php echo $v?></option>
                  <?php }?>
              </select>	
      </label>
		  
    </div> 
     <?php }else{?>
     
      <?php }?> 
    <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:600px;" >

		 <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="changeType" id="is_business" value="2"  <?php  if ($val['business_id'] != 0 ) {  ?>  checked = "checked"   readonly="readonly" <?php }else{?> <?php }?> /></label>
		 <label for="textfield" style="color:#00CC00;"> B.(选择后，该所属商家发布的所有活动将享受该优惠劵)</label>
		 
    </div> 
    

       <?php  if ($val['business_id'] != 0 ) {  ?>     
    <div class="_line formControls col-xs-8 col-sm-9"   id="business_notice_id"   style="float:left;width:800px;heigth:150px;" >
        <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="business_ids" type="hidden" id="business_ids"  class="input-text"  style="width:300px" size="15"  />
        <input name="" type="text" id="business_id"  class="input-text"  style="width:300px" size="15"  placeholder="请输入商家昵称"  value=" <?php echo $val['user_name'];?>"  readonly="readonly"  /></label>
		
    </div>    
         <?php }else{?>
     
      <?php }?>     
    <!-- div  style="float:left;width:800px;border:1px solid #eee;" >
        <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;height:0px;" >
        <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="business_id" type="text" id="business_id"  class="input-text"  style="width:150px" size="15" value="" /></label>
		  
		  <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-success radius" id="business_id_sure" >确认</span></label>
    </div> 
    </div>    --> 
       
        
    <div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;heigth:150px;" >

		 <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="changeType" id="business_all" value="3"  <?php  if ($val['changeType'] == 3 ) {  ?>     checked = "checked"   readonly="readonly" <?php }?>    /></label>
		 <label for="textfield" style="color:#00CC00;"> C.(发布所有商家，活动类型活动)</label>
		 
    </div> 
    

          <div class="_line formControls col-xs-8 col-sm-9" id = "actType" style="float:left;width:800px; " ><label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动类型：</label>
	    <span id="">
	     <?php  if ($val['act_id'] == 0 ) {  ?>
	        <select name="act_type" id="act_type">
	        
	          <?php  if ($val['category_id'] != 0 ) {  ?>
                  <option value="<?php echo $val['id']; ?> " style="width:50%;"><?php echo $val['cate_title'];?></option>
               <?php }else if ($val['category_id'] == 0 ){?>
     			 <option value="0" style="width:50%;">全 部 活 动</option>
    		 <?php }?>
	        </select> 	
	          
	            <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;子节点类型：</label>
              <select name="son_id" id="son_id">
 
               <?php  if ($val['title'] == '旅拍团' ) {  ?>
                  <?php foreach ($son as $s){?>
                  <option value="<?php echo $s['id']?>"><?php echo $s['title']?></option>
                  <?php }?>
               <?php }else{?>
     			 <option value="0">无</option>
    		     <?php }?>

              </select>	
                <?php }?>	
		</span>
    </div> 

 
 <?php  if ($val['business_id'] == 0 ) {  ?>
      <div class="_line formControls col-xs-8 col-sm-9" id = "userType"  style="float:left;width:800px;" >
      
    <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用户类型：</label>
	    <span id="">
	        <select name="user_type" id="user_type">
	       		 <?php  if ($val['user_type'] == 0 ) {  ?>
	       			  <option value="0" style="width:50%;">  所有用户    </option>
	             <?php }else if($val['user_type'] == 1){?>
     			 	     <option value="1" style="width:50%;">普通用户类型 </option>               		
    		     <?php }else{?>
    			     <option value="2" style="width:50%;">认证用户类型</option>
	      		   <?php }?>

              
	        </select> 	
	        		
		</span>
		    <label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认证用户：</label>
	    <span id="">
	        <select name="user_type_child" id="user_type_child">
	         <?php  if ($val['user_type_child'] == 0 ) {  ?>
	       		 <option value="0" style="width:50%;"> 无   </option>
	            <?php }else if($val['user_type_child'] == 1){?>
     			 	     <option value="1" style="width:50%;">摄影师</option>
     			 	     <?php }else if($val['user_type_child'] == 2){?>
     			 	      <option value="2" style="width:50%;">麻豆</option>
     			 	     <?php }else if($val['user_type_child'] == 3){?>
     			 	     <option value="3" style="width:50%;">社会团体</option>
     			 	     <?php }else if($val['user_type_child'] == 4){?>
     			 	      <option value="4" style="width:50%;">商业机构</option>
     			 	     <?php }else if($val['user_type_child'] == 5){?>
     			 	     <option value="5" style="width:50%;">官方</option>         		
    		    	 <?php }else{?>
    			     <option value="2" style="width:50%;">无</option>
	      		  	 <?php }?>
	                   
	        </select> 			
		</span>
		  
    </div>
             <?php }?>	            
        
        
        <!--div class="_line formControls col-xs-8 col-sm-9" style="float:left;width:800px;heigth:150px;" >

		 <!-- label for="textfield">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="is_support" id="checkbox"  <?php  if ($val['is_support'] == 1 ) {  ?>  checked = "checked"   readonly="readonly" <?php }else{?> <?php }?> /></label>
		 <label for="textfield" style="color:#06f;"> D:是否支持消费完该优惠劵后，赠送其他活动优惠劵</label>
		 
    </div> 
     -->
 
    
    <div class="row cl">
			<div class="formControls col-xs-8 col-sm-9">
			
              
			</div>
	 </div>
	 
	     <div class="row cl">
			<div class="formControls col-xs-8 col-sm-9">
               <div id="container">
                <label for="textfield" style="color:;"> 活动优惠劵说明:</label>
<br />选择条件：<br />

 &nbsp;&nbsp;&nbsp;  1.A,B和C只能三选一。<br />

 &nbsp;&nbsp;&nbsp;  2.必选项或者可选项，默认为全部<br />

   

后台发放和APP获取优惠劵原则：

<br />&nbsp;&nbsp;&nbsp;  1.所有的优惠劵将享受 "先到先得"的原则。用户在APP首页活动界面领取优惠劵。

<br />&nbsp;&nbsp;&nbsp;  2.如果后台操作人员勾选了D。则使用该优惠劵的活动，支持赠送其他优惠劵服务。

<br />此APP操作界面为（我的订单详情页面，优惠劵领取框）.

<br />&nbsp;&nbsp;&nbsp; 3.如支持赠送其他一个或者多个优惠劵服务，如果后台发现可赠送多个优惠劵。随机选择   一个赠送 即可。    
               </div>
			</div>
		 </div>
	 
	
    
    <div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">

			</div>
		</div>
    
       		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
		    
                
			</div>
		</div>
			<div class="row cl"  style="height:20px;>
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3"></div>
	
			</div>
		</div>
    
</div>
 
    

  <p>&nbsp;</p>
</form>

</article>


</body>

</html>

