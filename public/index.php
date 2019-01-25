<?php

require_once '../kernel/bootstrap.php';

use Kernel\App as App;
use Kernel\managers\ControllerManager;

new App(new ControllerManager());