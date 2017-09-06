<?php
return array(
	 'DB_TYPE'               =>  'mysql',                 // 数据库类型
    'DB_HOST'               =>  '127.0.0.1',     // 服务器地址
    'DB_NAME'               =>  'md',     // 数据库名
    'DB_USER'               =>  'root',     // 用户名
    'DB_PWD'                =>  '123456',      // 密码
    'DB_PORT'               =>  '3306',     // 端口
    'DB_PREFIX'             =>  'h_',   // 数据库表前缀
	'SHOW_PAGE_TRACE'        => true,          // 是否显示调试面板
    'URL_CASE_INSENSITIVE'   => true,             // URL不区分大小写
    'LOAD_EXT_CONFIG'        => 'db,web',        // 加载网站设置文件
    'TMPL_PARSE_STRING'      => array(                           // 定义常用路径
        '__HOME_CSS__'       => __ROOT__.'/Public/Home/css',
        '__HOME_JS__'        => __ROOT__.'/Public/Home/js',
        '__HOME_IMAGES__'    => __ROOT__.'/Public/Home/images',
        '__ADMIN_CSS__'      => __ROOT__.'/Public/Admin/css',
        '__ADMIN_JS__'       => __ROOT__.'/Public/Admin/js',
        '__ADMIN_IMAGES__'   => __ROOT__.'/Public/Admin/images',
        '__ADMIN_PLUGINS__'  => __ROOT__.'/Public/Admin/plugins',
        '__MOBILE_CSS__'     => __ROOT__.'/Public/Mobile/css',
        '__MOBILE_JS__'      => __ROOT__.'/Public/Mobile/js',
        '__MOBILE_IMAGES__'  => __ROOT__.'/Public/Mobile/images',
        '__COM_JS__'         => __ROOT__.'/Public/Com/js',   
        '__COM_CSS__'        => __ROOT__.'/Public/Com/css',   
        '__COM_IMAGES__'     => __ROOT__.'/Public/Com/images',   
    ),


    //***********************************URL设置**************************************
    'MODULE_ALLOW_LIST'     => array('Home','Admin','Mobile','Api', 'Wechat'),    //允许访问列表
    'DEFAULT_MODULE'        => 'Home',
    'URL_MODEL'             => 2,
);