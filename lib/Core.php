<?php
namespace lib;

use think\facade\Db;

final class Core{

    public static function run()
    {
        define("APP_PATH", dirname(__DIR__));
        self::Db();
        self::Load();
    }

    private static function Db()
    {
        return Db::setConfig(Config::get('app.database'));
    }

    private static function Load()
    {
        include_once "Helper.php";
        $url = $_SERVER['REQUEST_URI'];
        if($url !== '/'){
            $url = ltrim($url, '/');
            $url = rtrim($url, '/');
            $url = explode('/', $url);
        }else{
            $url = [
                Config::get('app.module'),
                Config::get('app.controller'),
                Config::get('app.action'),
            ];
            if(!Config::get('app.multi')){
                unset($url[0]);
                $url = array_merge($url);
            }
        }
        $count = count($url)-2;
        if(Config::get('app.multi')){
            if(!is_dir(APP_PATH . '/app/' . $url[0])){
                echo json(-1, $url[0] . '-模块不存在');die;
            }
        }

        $class_name = '\\app\\';
        for($i=0; $i<count($url) - 1; $i++){
            if($i === $count){
                $class_name .= ucfirst($url[$i]);
            }else{
                $class_name .= $url[$i]. '\\';
            }
        }

        if(!is_file(APP_PATH . $class_name . '.php')){
            $msg = $count . '-控制器不存在';
            if(Config::get('app.multi')){ $msg = $url[0] . '-模块的' . $count . '-控制器不存在'; }
            echo json(-1, $msg);die;
        }

        try {
            $class = new $class_name();
            $method = $url[count($url) - 1];
            if(method_exists($class, $method)){
                $class->$method();
            }else{
                $msg = $url[count($url) - 2] . '-控制器' . $method. '-方法不存在';
                if(Config::get('app.multi')){ $msg = $url[0] . '-模块的' . $url[count($url) - 2] . '-控制器' . $method. '-方法不存在'; }
                throw new Exception($msg, -1);
            }
        }catch (Exception $exception){

        }
    }

}