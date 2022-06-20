<?php
namespace lib;

class Config
{
    // 配置参数
    protected static $config = [];
    // 配置文件后缀
    protected static $ext = ".php";

    // 将配置文件加载进来
    protected static function load(string $file, $default = 'app')
    {
        $filename = '';
        // 如果name存在
        if(isset($name)){
            $filename = $file . self::$ext;
        }else{ // 如果不存在
            $filename = $default . self::$ext;
        }
        self::$config = include __DIR__ . "/../config/" . $filename;
    }

    // 获取配置文件
    public static function get(string $name = null, $default = 'app'){
        // 如果没有name就将默认的app配置文件返回
        if(empty($name)){
            return self::load($default);
        }
        // 如果.在name中没有出现就返回默认的配置文件
        if(strpos($name, '.') === false){
            return self::load($default);
        }

        $name = explode('.', $name);
        $name[0] = strtolower($name[0]);
        self::load($name[0]);
        $config = self::$config;
        foreach($name as $val){
            if(isset($config[$val])){
                $config = $config[$val];
            }
        }
        return $config;
    }
}