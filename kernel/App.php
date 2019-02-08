<?php


namespace Kernel;


use Kernel\interfaces\IControllerManager;
use Kernel\interfaces\IDBConnection;

class App
{
    private $controller = null;

    function __construct(IControllerManager $controllerManager)
    {
        $this->controller =  $controllerManager->getController();
        $this->controller->callGetOrPost();
    }
}