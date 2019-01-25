<?php


use Controllers\{
    AboutController, HomeController
};
use Kernel\mvcs\Routes;

$urlsMap = [
    "home" => ["/", HomeController::class],
    "about" => ["/about", AboutController::class],
];

new Routes($urlsMap);