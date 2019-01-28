<?php


namespace Kernel;


use Kernel\interfaces\IControllerManager;
use Kernel\interfaces\IDBConnection;

class App
{
    private $controller = null;
    private $dbConnection = null;


    function __construct(IControllerManager $controllerManager, IDBConnection $connection)
    {
        $this->controller =  $controllerManager->getController();
        $this->controller->callGetOrPost();
        $this->dbConnection = $connection::getConnection();
    }
}