<?php

/**
 * UCenter客户端配置文件
 * 注意：该配置文件请使用常量方式定义
 */

define('UC_APP_ID', 1); //应用ID
define('UC_API_TYPE', 'Model'); //可选值 Model / Service
define('UC_AUTH_KEY', '7K2d/p<Jl(|_?C.L+r5kmh`4VR*{egqT%Ov&BM0,'); //加密KEY
define('UC_DB_DSN', 'mysqli://hoshot_v2_dev:hfjxu611283@59.110.175.142:3306/hoshot_v2_dev'); // 数据库连接，使用Model方式调用API必须配置此项
define('UC_TABLE_PREFIX', 'hoshot_'); // 数据表前缀，使用Model方式调用API必须配置此项
