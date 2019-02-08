<?php


namespace Kernel;


class Error
{
    function __construct()
    {
        ini_set('display_errors', (Conf::getConf('env') === 'dev') ? 1 : 0);
        ini_set('display_startup_errors', 1);
        error_reporting(constant('E_ALL'));
    }
}