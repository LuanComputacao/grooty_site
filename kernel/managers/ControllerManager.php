<?php


namespace Kernel\managers;

use http\Exception;
use Kernel\interfaces\{
    IController, IControllerManager
};
use Kernel\mvcs\Routes;

class ControllerManager implements IControllerManager
{

    private $path = "";
    private $route;
    private $controllerClass = "";
    private $controller;

    function __construct()
    {
        $this->parseUrl();
        $this->checkRoute();
        $this->setControllerClass();
        $this->instantiateController();
    }

    private function parseUrl()
    {
        $this->path = parse_url($_SERVER['REQUEST_URI'])["path"];
    }

    private function checkRoute()
    {
        $this->checkRoutePath();
        if (!isset($this->route)) {
            $this->checkRouteName();
        }
    }

    private function checkRoutePath()
    {
        $this->route = Routes::getRouteByPath($this->path);
    }

    private function checkRouteName()
    {
        $this->route = Routes::getRouteByName($this->path);
    }

    private function setControllerClass()
    {
        try {
            $this->controllerClass = $this->route[array_keys($this->route)[0]][1];
        } catch (Exception $e) {
            http_response_code(404);
            die();
        }
    }

    private function instantiateController()
    {
        if (class_exists($this->controllerClass)) {
            $this->controller = new $this->controllerClass;
        }
    }

    public function getPath(): string
    {
        return $this->path;
    }

    function getRoute()
    {
        return $this->route;
    }

    public function getControllerClass()
    {
        return $this->controllerClass;
    }

    public function callGetOrPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (method_exists($this->controller, "get")) {
                $this->controller->get();
            } else {
                $this->httpMethodNotAllowed('get');
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (method_exists($this->controller, "get")) {
                $this->controller->post();
            } else {
                $this->httpMethodNotAllowed('post');
            }
        }
    }

    private function httpMethodNotAllowed($method)
    {
        echo 'Method' . $method . 'not allowed';
    }

    public function getController(): IController
    {
        return $this->controller;
    }
}