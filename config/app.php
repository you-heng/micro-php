<?php
return [
    'multi'         => false,    // true-多应用模式 false-单应用模式
    'module'        => 'index', // 默认模块
    'controller'    => 'index', // 默认控制器
    'action'        => 'index', // 默认方法
    'database'      => [        // 数据库配置
        'default'    =>    'mysql',
        'connections'    =>    [
            'mysql'    =>    [
                // 数据库类型
                'type'        => 'mysql',
                // 服务器地址
                'hostname'    => '127.0.0.1',
                // 数据库名
                'database'    => 'test',
                // 数据库用户名
                'username'    => 'root',
                // 数据库密码
                'password'    => 'root',
                // 数据库连接端口
                'hostport'    => '3306',
                // 数据库连接参数
                'params'      => [],
                // 数据库编码默认采用utf8
                'charset'     => 'utf8',
                // 数据库表前缀
                'prefix'      => '',
            ],
        ],
    ],
];