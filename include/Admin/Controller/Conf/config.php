<?php

/**
 * 前台配置文件
 * 所有除开系统级别的前台配置
 */
return array(
    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX'    => 'hoshot_', // 缓存前缀
    'DATA_CACHE_TYPE'      => 'File', // 数据缓存类型
    'UC_AUTH_KEY' => '7K2d/p<Jl(|_?C.L+r5kmh`4VR*{egqT%Ov&BM0,',
    
	'TMPL_ENGINE_TYPE' =>'PHP',
	'TMPL_TEMPLATE_SUFFIX'=>'.php',

    /* 文件上传相关配置 */
    'DOWNLOAD_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xml', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './uploads/Download/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //下载模型上传配置（文件上传类配置）

    /* 图片上传相关配置 */
    'PICTURE_UPLOAD' => array(
		'mimes'    => '', //允许上传的文件MiMe类型
		'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
		'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
		'autoSub'  => true, //自动子目录保存文件
		'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		'rootPath' => './uploads/Picture/', //保存根路径
		'savePath' => '', //保存路径
		'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
		'saveExt'  => '', //文件保存后缀，空则使用原后缀
		'replace'  => false, //存在同名是否覆盖
		'hash'     => true, //是否生成hash编码
		'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //图片上传相关配置（文件上传类配置）

    'PICTURE_UPLOAD_DRIVER'=>'local',
    //本地上传文件驱动配置
    'UPLOAD_LOCAL_CONFIG'=>array(),
    'UPLOAD_BCS_CONFIG'=>array(
        'AccessKey'=>'',
        'SecretKey'=>'',
        'bucket'=>'',
        'rename'=>false
    ),
    'UPLOAD_QINIU_CONFIG'=>array(
        'accessKey'=>'__ODsglZwwjRJNZHAu7vtcEf-zgIxdQAY-QqVrZD',
        'secrectKey'=>'Z9-RahGtXhKeTUYy9WCnLbQ98ZuZ_paiaoBjByKv',
        'bucket'=>'onethinktest',
        'domain'=>'onethinktest.u.qiniudn.com',
        'timeout'=>3600,
    ),


    /* 编辑器图片上传相关配置 */
    'EDITOR_UPLOAD' => array(
		'mimes'    => '', //允许上传的文件MiMe类型
		'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
		'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
		'autoSub'  => true, //自动子目录保存文件
		'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		'rootPath' => './uploads/Editor/', //保存根路径
		'savePath' => '', //保存路径
		'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
		'saveExt'  => '', //文件保存后缀，空则使用原后缀
		'replace'  => false, //存在同名是否覆盖
		'hash'     => true, //是否生成hash编码
		'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ),

    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__ADDONS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
    ),

    /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'hoshot_admin', //session前缀
    'COOKIE_PREFIX'  => 'hoshot_admin_', // Cookie前缀 避免冲突
    'VAR_SESSION_ID' => 'session_id',	//修复uploadify插件无法传递session_id的bug

    /* 后台错误页面模板 */
    'TMPL_ACTION_ERROR'     =>  'Public/error', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  'Public/success', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'   =>  'Public/exception',// 异常页面的模板文件
    'USER_TYPE_ARR' => array(
                0 => '普通用户',
                1 => '摄影师',
                2 => '麻豆',
                3 => '社会团体',
                4 => '商业机构',
                5 => '官方',
),
    'MODULE_TYPE_ARR'   =>  array(
                1 => '圈子',
                2 => '摄点',
                3 => '活动',
    ),
		
		
		
// 		'SESSION_AUTO_START'        =>  true,
// 		'TMPL_ACTION_ERROR'         =>  'Public:success', // 默认错误跳转对应的模板文件
// 		'TMPL_ACTION_SUCCESS'       =>  'Public:success', // 默认成功跳转对应的模板文件
// 		'USER_AUTH_ON'              =>  true,
// 		'USER_AUTH_TYPE'			=>  2,		// 默认认证类型 1 登录认证 2 实时认证
// 		'USER_AUTH_KEY'             =>  'authId',	// 用户认证SESSION标记
// 		'ADMIN_AUTH_KEY'			=>  'administrator',
// 		'USER_AUTH_MODEL'           =>  'User',	// 默认验证数据表模型
// 		'AUTH_PWD_ENCODER'          =>  'md5',	// 用户认证密码加密方式
// 		'USER_AUTH_GATEWAY'         =>  '/Public/login',// 默认认证网关
// 		'NOT_AUTH_MODULE'           =>  'Public',	// 默认无需认证模块
// 		'REQUIRE_AUTH_MODULE'       =>  '',		// 默认需要认证模块
// 		'NOT_AUTH_ACTION'           =>  '',		// 默认无需认证操作
// 		'REQUIRE_AUTH_ACTION'       =>  '',		// 默认需要认证操作
// 		'GUEST_AUTH_ON'             =>  false,    // 是否开启游客授权访问
// 		'GUEST_AUTH_ID'             =>  0,        // 游客的用户ID
// 		'DB_LIKE_FIELDS'            =>  'title|remark',
// 		'RBAC_ROLE_TABLE'           =>  'admin_role',
// 		'RBAC_USER_TABLE'           =>  'admin',
// 		'RBAC_ACCESS_TABLE'         =>  'admin_access',
// 		'RBAC_NODE_TABLE'           =>  'admin_node',
// 		'SHOW_PAGE_TRACE'           =>  0//显示调试信息			
		
);
