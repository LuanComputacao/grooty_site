<?php

namespace Kernel\mvcs;

use Kernel\interfaces\IController;

class Controller implements IController
{
    public function callGetOrPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (method_exists($this, "get")) {
                call_user_func([$this, 'get']);
            } else {
                $this->httpMethodNotAllowed('get');
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (method_exists($this, "post")) {
                call_user_func([$this, 'post']);
            } else {
                $this->httpMethodNotAllowed('post');
            }
        }
    }

    private function httpMethodNotAllowed($method)
    {
        echo 'Method ' . $method . ' not allowed';
    }

    protected static function allowCORSOrigin($originURL)
    {
        header("Access-Control-Allow-Origin: " . $originURL);
    }

    /**
     * @param $methods array Can have som values from the array [GET, POST, PUT,  DELETE, OPTIONS]
     */
    protected static function allowCORSMethods($methods)
    {
        header("Access-Control-Allow-Methods:" . join(" ,", $methods));
    }
}