<?php
return array(
	//'配置项'=>'配置值'

    'URL_PARAMS_BIND_TYPE'  =>  2, // 设置参数绑定按照变量顺序绑


    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'dateasy', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '', // 密码
    'DB_PORT'   => '', // 端口
    'DB_PREFIX' => '', //前缀


    /* 默认设定 */
    'DEFAULT_APP'           => '@',     // 默认项目名称，@表示当前项目
    'DEFAULT_MODULE'        => 'Home', // 默认模块名称
    'DEFAULT_ACTION'        => 'index', // 默认操作名称
    'DEFAULT_CHARSET'       => 'utf-8', // 默认输出编码
    'DEFAULT_TIMEZONE'      => 'PRC', // 默认时区
    'DEFAULT_AJAX_RETURN'   => 'JSON', // 默认AJAX 数据返回格式,可选JSON XML ...
    'DEFAULT_LANG'          => 'zh-cn', // 默认语言
);