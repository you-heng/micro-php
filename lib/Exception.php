<?php
namespace lib;

use Throwable;

class Exception extends \Exception
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $this->render($message, $code);
        error_reporting(0);
    }

    private function render($message, $code)
    {
        echo json($code, $message);
    }
}