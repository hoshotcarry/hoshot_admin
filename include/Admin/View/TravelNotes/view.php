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

<title>添加分公司</title>
</head>
<body>
<article class="page-container">
    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">游记标题：</label>
            <div class="formControls col-xs-8 col-sm-9"><?php echo $data['title'];?></div>
    </div>
    <?php if( !empty($data['background']) ){?>
    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">游记标题：</label>
            <div class="formControls col-xs-8 col-sm-9"><img src="<?php echo U($data["background"],'','');?>" width="200" /></div>
    </div>
    <?php }?>
    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">作者：</label>
            <div class="formControls col-xs-8 col-sm-9"><?php echo getUserNameById($data['user_id']);?></div>
    </div>
<!--    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">出发时间：</label>
            <div class="formControls col-xs-8 col-sm-9"><?php echo date('Y-m-d H:i:s',$data['start_time']);?></div>
    </div>
    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">出行人数：</label>
            <div class="formControls col-xs-8 col-sm-9"><?php echo $data['people_num'];?></div>
    </div>
    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">出行天数：</label>
            <div class="formControls col-xs-8 col-sm-9"><?php echo $data['days'];?></div>
    </div>
    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">人均消费：</label>
            <div class="formControls col-xs-8 col-sm-9"><?php echo $data['per_capita'];?></div>
    </div>-->
    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">游记标签：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <?php foreach(getTagsById(unserialize($data['tags'])) as $tags){ ?>
                <label><?php echo $tags['tagName']?></label>
                <?php }?>
            </div>
    </div>
    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">发布时间：</label>
            <div class="formControls col-xs-8 col-sm-9"><?php echo date('Y-m-d H:i:s',$data['create_time']);?></div>
    </div>
    
    <?php foreach($card as $val){ ?>
    <hr />
    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">游记小标题：</label>
            <div class="formControls col-xs-8 col-sm-9"><?php echo $val['title'];?></div>
    </div>
    
    <?php if( !empty($val['image']) ){?>
    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">游记图片：</label>
            <div class="formControls col-xs-8 col-sm-9"><img src="<?php echo U($val['image'],'','');?>" width="200" /></div>
    </div>
    <?php }?>
    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">游记内容：</label>
            <div class="formControls col-xs-8 col-sm-9"><?php echo $val['content'];?></div>
    </div>
    <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">发布时间：</label>
            <div class="formControls col-xs-8 col-sm-9"><?php echo date('Y-m-d H:i:s',$val['create_time']);?></div>
    </div>
    <?php }?>
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
<!--/_footer /作为公共模版分离出去--> 

<!--请在下方写此页面业务相关的脚本--> 

<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>