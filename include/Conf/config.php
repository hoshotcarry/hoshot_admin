<?php

/**
 * 系统配文件
 * 所有系统级别的配置
 */
return array(
    /* 模块相关配置 */
    'AUTOLOAD_NAMESPACE' => array('Addons' => ONETHINK_ADDON_PATH), //扩展模块列表
    'DEFAULT_MODULE'     => 'Home',
    'MODULE_DENY_LIST'   => array('Common', 'User'),
		
	'URL_CASE_INSENSITIVE' =>true,
    //'MODULE_ALLOW_LIST'  => array('Home','Admin'),

    /* 系统数据加密设置 */
    'DATA_AUTH_KEY' => '7K2d/p<Jl(|_?C.L+r5kmh`4VR*{egqT%Ov&BM0,', //默认数据加密KEY

		/* 调试配置 */
		'SHOW_PAGE_TRACE' => true,
		
		'HTML_CACHE_ON'       => true,
		'HTML_CACHE_RULES'    => array(
				'News:index' => array('{:module}_{:action}_{id}', 0)
		),
		
		/* 用户相关设置 */
		'USER_MAX_CACHE'     => 1000, //最大缓存用户数
		'USER_ADMINISTRATOR' => 1, //管理员用户ID
		
		/* URL配置 */
		'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
		'URL_MODEL'            => 2, //URL模式
		'VAR_URL_PARAMS'       => '',  //PATHINFO URL参数变量
		'URL_PATHINFO_DEPR'    => '/', //PATHINFO URL分割符
		
		/* 全局过滤配置 */
		'DEFAULT_FILTER' => '', //全局过滤函数
		
		/* 数据库配置 */
		'DB_TYPE'   => 'mysqli', // 数据库类型
		'DB_HOST'   => '59.110.175.142', // 服务器地址
		'DB_NAME'   => 'hoshot_v2', // 数据库名
		'DB_USER'   => 'hoshot_v2', // 用户名
		'DB_PWD'    => 'hfjxu611283',  //密码
		'DB_PORT'   => '3306', // 端口
		'DB_PREFIX' => 'hoshot_', // 数据库表前缀
		
		/* 文档模型配置 (文档模型核心配置，请勿更改) */
		'DOCUMENT_MODEL_TYPE' => array(2 => '主题', 1 => '目录', 3 => '段落'),
);

        
        
        
        
        