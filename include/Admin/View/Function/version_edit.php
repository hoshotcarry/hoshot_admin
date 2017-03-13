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
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>添加用户</title>
</head>
<body>

<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add"  enctype="multipart/form-data">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>版本更新说明：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea type="text" class="textarea" placeholder="请版本更新说明" id="remark" name="remark" value=""><?php echo $data['remark']?></textarea>
				
				<input type="hidden" name="old_file" value="<?php echo $data['file']?>">
				<input type="hidden"  name="online_time" value="<?php echo $data['online_time']?>">
				<input type="hidden"  name="old_app_version" value="<?php echo $data['app_version']?>">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>更新平台：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<select class="select" size="1" name="flatform">
					<option value="1" <?php if($data['flatform'] == 1){echo 'selected';}?>>IOS</option>
					<option value="2" <?php if($data['flatform'] == 2){echo 'selected';}?>>Android</option>
				</select>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上传版本号：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"  name="app_version" id="app_version" value="<?php echo $data['app_version']?>">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>APP ID号：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"  name="app_id" id="app_id" value="<?php echo $data['app_id']?>">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">上传版本：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="file" name="file" value="<?php echo $data['file']?>"><span class="c-red"> 注:上传会覆盖原有文件.</span>
			</div>
		</div>
		<!--<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">APP LOGO：</label>
			<div class="formControls col-xs-8 col-sm-9">
                        <p class="showimg" id="showimg"><img src="<?php echo $data['logo']?>" width="200" /> </p>
				<input type="file" name="logo" id="logo" value="<?php echo $data['logo']?>">
			</div> 
		</div>-->
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>是否上线：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<select class="select" size="1" name="status">
					<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>是</option>
					<option value="0" <?php if($data['status'] == 2){echo 'selected';}?>>否</option>
				</select>
			</div>
		</div>
		<!-- div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>上线时间：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" onfocus="WdatePicker({minDate:'%y-%M-%d',dateFmt:'yyyy/MM/dd HH:mm:ss'})" name="online_time" id="online_time" class="input-text Wdate" value="<?php echo date("Y-m-d H:i:s",$data['online_time'])?>" style="width:220px;">
			</div>
		</div> -->
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="input-text" type="hidden" name="id" value="<?php echo $data['id']?>">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Static/js/jquery.cityselect.js"></script>
<script type="text/javascript" src="/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script type="text/javascript" src="/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="/lib/My97DatePicker/WdatePicker.js"></script> 
<!--/_footer /作为公共模版分离出去--> 

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
			}
// 			password:{
// 				required:true,
// 			},
			
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
  <script type="text/javascript">
  /*window.onload = function(){

    // 选择图片
    document.getElementById('logo').onchange = function(event){
        var img = event.target.files[0];

        // 判断是否图片
        if(!img){
            return ;
        }

        // 判断图片格式
        if(!(img.type.indexOf('image')==0 && img.type && /\.(?:jpg|png|gif)$/.test(img.name)) ){
            alert('图片只能是jpg,gif,png');
            return ;
        }

        var reader = new FileReader();
        reader.readAsDataURL(img);
		
        reader.onload = function(e){ // reader onload start
            // ajax 上传图片
			var get_url = "picAdd";


            $.post(get_url, { img: e.target.result},function(ret){	
               if(ret.img!=''){
                  alert(ret.msg);
                    $('#showimg').html('<img src="' + ret.img + '" width="200">');
					$("#logo").val(ret.img);
                }else if(ret.msg!=""){
					alert(ret.msg);
				}else{
                    alert('图片上传失败！');
                }
            },'json');
        } // reader onload end
    }

  }*/
  
  </script>
</body>
</html>