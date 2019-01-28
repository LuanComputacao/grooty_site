<?php

require_once '../kernel/bootstrap.php';

use Kernel\App as App;

use Kernel\managers\ControllerManager;
use Kernel\managers\DBConnection;

//phpinfo();
new App(new ControllerManager(), new DBConnection());