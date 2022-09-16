<?php
namespace app\index;

use lib\Config;

class index{
    public function index()
    {
        $app = Config::get('app.module');
        dump($app);
        //echo json_encode(['code' => 0, 'msg' => '多应用模式']);
    }
}