<?php

require_once 'constants.php';

require_once '../vendor/autoload.php';

use Kernel\{
    App, Error
};
use Kernel\managers\{
    ControllerManager
};

new Error();

require_once '../app/routes.php';

new App(new ControllerManager());
