<extend name="Public/base"/>

<block name="body">
	<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
	<div class="main-title">
		<h2>{:isset($info['id'])?'编辑':'新增'}分类</h2>
	</div>
	<div class="tab-wrap">
		<ul class="tab-nav nav">
			<li data-tab="tab1" class="current"><a href="javascript:void(0);">基 础</a></li>
			<li data-tab="tab2"><a href="javascript:void(0);">高 级</a></li>
		</ul>
		<div class="tab-content">
			<form action="{:U()}" method="post" class="form-horizontal">
				<!-- 基础 -->
				<div id="tab1" class="tab-pane in tab1">
					<div class="form-item">
						<label class="item-label">上级分类<span class="check-tips"></span></label>
						<div class="controls">
							<input type="text" class="text input-large" disabled="disabled" value="{$category['title']|default='无'}"/>
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">
							分类名称<span class="check-tips">（名称不能为空）</span>
						</label>
						<div class="controls">
							<input type="text" name="title" class="text input-large" value="{$info.title|default=''}">
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">
							分类标识<span class="check-tips">（英文字母）</span>
						</label>
						<div class="controls">
							<input type="text" name="name" class="text input-large" value="{$info.name|default=''}">
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">
							发布内容<span class="check-tips">（是否允许发布内容）</span>
						</label>
						<div class="controls">
							<label class="inline radio"><input type="radio" name="allow_publish" value="0">不允许</label>
							<label class="inline radio"><input type="radio" name="allow_publish" value="1" checked>仅允许后台</label>
							<label class="inline radio"><input type="radio" name="allow_publish" value="2" >允许前后台</label>
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">
							是否审核<span class="check-tips">（在该分类下发布的内容是否需要审核）</span>
						</label>
						<div class="controls">
							<label class="inline radio"><input type="radio" name="check" value="0" checked>不需要</label>
							<label class="inline radio"><input type="radio" name="check" value="1">需要</label>
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">绑定文档模型<span class="check-tips">（分类支持发布的文档模型）</span></label>
						<div class="controls">
							<volist name=":get_document_model()" id="list">
								<label class="checkbox">
									<input type="checkbox" name="model[]" value="{$list.id}">{$list.title}
								</label>
							</volist>
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">允许文档类型</label>
						<div class="controls">
							<volist name=":C('DOCUMENT_MODEL_TYPE')" id="type">
								<label class="checkbox">
									<input type="checkbox" name="type[]" value="{$key}">{$type}
								</label>
							</volist>
						</div>
					</div>
					<div class="controls">
						<label class="item-label">分类图标</label>
						<input type="file" id="upload_picture">
						<input type="hidden" name="icon" id="icon" value="{$info['icon']|default=''}"/>
						<div class="upload-img-box">
						<notempty name="info['icon']">
							<div class="upload-pre-item"><img src="__ROOT__{$info.icon|get_cover='path'}"/></div>
						</notempty>
						</div>
					</div>
					<script type="text/javascript">
					//上传图片
				    /* 初始化上传插件 */
					$("#upload_picture").uploadify({
				        "height"          : 30,
				        "swf"             : "__STATIC__/uploadify/uploadify.swf",
				        "fileObjName"     : "download",
				        "buttonText"      : "上传图片",
				        "uploader"        : "{:U('File/uploadPicture',array('session_id'=>session_id()))}",
				        "width"           : 120,
				        'removeTimeout'	  : 1,
				        'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
				        "onUploadSuccess" : uploadPicture,
				        'onFallback' : function() {
				            alert('未检测到兼容版本的Flash.');
				        }
				    });
					function uploadPicture(file, data){
				    	var data = $.parseJSON(data);
				    	var src = '';
				        if(data.status){
				        	$("#icon").val(data.id);
				        	src = data.url || '__ROOT__' + data.path;
				        	$("#icon").parent().find('.upload-img-box').html(
				        		'<div class="upload-pre-item"><img src="' + src + '"/></div>'
				        	);
				        } else {
				        	updateAlert(data.info);
				        	setTimeout(function(){
				                $('#top-alert').find('button').click();
				                $(that).removeClass('disabled').prop('disabled',false);
				            },1500);
				        }
				    }
					</script>
				</div>

				<!-- 高级 -->
				<div id="tab2" class="tab-pane tab2">
					<div class="form-item">
						<label class="item-label">可见性<span class="check-tips">（是否对用户可见，针对前台）</span></label>
						<div class="controls">
							<select name="display">
								<option value="1">所有人可见</option>
								<option value="0">不可见</option>
								<option value="2">管理员可见</option>
							</select>
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">
							回复<span class="check-tips">（是否允许对内容进行回复，需要详情页模板支持回复显示与提交）</span>
						</label>
						<div class="controls">
							<label class="inline radio"><input type="radio" name="reply" value="1" checked>允许</label>
							<label class="inline radio"><input type="radio" name="reply" value="0">不允许</label>
						</div>
					</div>
					<!-- <div class="form-item reply hidden">
						<label class="item-label">回复绑定的文档模型</label>
						<div class="controls">
							<volist name=":get_document_model()" id="list">
								<label class="checkbox">
									<input type="checkbox" name="reply_model[]" value="{$list.id}">{$list.title}
								</label>
							</volist>
						</div>
					</div> -->
					<div class="form-item">
						<label class="item-label">
							排序<span class="check-tips">（仅对当前层级分类有效）</span>
						</label>
						<div class="controls">
							<input type="text" name="sort" class="text input-small" value="{$info.sort|default=0}">
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">
							列表行数
						</label>
						<div class="controls">
							<input type="text" name="list_row" class="text input-small" value="{$info.list_row|default=10}">
						</div>
					</div>

				</div>

				<!-- 高级 -->
				<div id="tab2" class="tab-pane tab2">
					<div class="form-item">
						<label class="item-label">网页标题</label>
						<div class="controls">
							<input type="text" name="meta_title" class="text input-large" value="{$info.meta_title|default=''}">
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">关键字</label>
						<div class="controls">
							<label class="textarea input-large">
								<textarea name="keywords">{$info.keywords|default=''}</textarea>
							</label>
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">描述</label>
						<div class="controls">
							<label class="textarea input-large">
								<textarea name="description">{$info.description|default=''}</textarea>
							</label>
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">频道模板</label>
						<div class="controls">
							<input type="text" name="template_index" class="text input-large" value="{$info.template_index|default=''}">
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">列表模板</label>
						<div class="controls">
							<input type="text" name="template_lists" class="text input-large" value="{$info.template_lists|default=''}">
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">详情模板</label>
						<div class="controls">
							<input type="text" name="template_detail" class="text input-large" value="{$info.template_detail|default=''}">
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">编辑模板</label>
						<div class="controls">
							<input type="text" name="template_edit" class="text input-large" value="{$info.template_edit|default=''}">
						</div>
					</div>
				</div>

				<div class="form-item">
					<input type="hidden" name="id" value="{$info.id|default=''}">
					<input type="hidden" name="pid" value="{:isset($category['id'])?$category['id']:$info['pid']}">
					<button type="submit" id="submit" class="btn submit-btn ajax-post" target-form="form-horizontal">确 定</button>
					<button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
				</div>
			</form>
		</div>
	</div>
</block>

<block name="script">
	<script type="text/javascript">
		<present name="info.id">
		Think.setValue("allow_publish", {$info.allow_publish|default=1});
		Think.setValue("check", {$info.check|default=0});
		Think.setValue("model[]", {$info.model|json_encode} || [1]);
		Think.setValue("type[]", {$info.type|json_encode} || [2]);
		Think.setValue("display", {$info.display|default=1});
		Think.setValue("reply", {$info.reply|default=0});
		Think.setValue("reply_model[]", {$info.reply_model|json_encode} || [1]);
		</present>
		$(function(){
			showTab();
			$("input[name=reply]").change(function(){
				var $reply = $(".form-item.reply");
				parseInt(this.value) ? $reply.show() : $reply.hide();
			}).filter(":checked").change();
		});
		//导航高亮
		highlight_subnav('{:U('Category/index')}');
	</script>
</block>
