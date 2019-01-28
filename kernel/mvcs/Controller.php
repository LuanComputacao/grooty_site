<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 18/12/18
 * Time: 03:06
 */

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
        echo 'Method <strong>' . $method . '</strong> not allowed';
    }
}