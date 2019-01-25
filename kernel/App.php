<?php


namespace Kernel;


use Kernel\interfaces\IControllerManager;

class App
{
    private $controller = null;


    function __construct(IControllerManager $controllerManager)
    {
        $this->controller =  $controllerManager->getController();
        $this->controller->callGetOrPost();
    }
}