<?php
// 格式化输出
function dump($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

// json
function json($code, $msg, $data = [])
{
    return json_encode(['code' => $code, 'msg' => $msg, 'data' => $data]);
}