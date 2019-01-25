<?php


namespace Kernel;


use Symfony\Component\Yaml\Yaml;

class Conf
{
    private static $conf;
    private static $instance;

    private function __construct()
    {
        $this->read();
    }

    private function read()
    {
        self::$conf = Yaml::parseFile(APP_DIR . 'conf.yml');
    }

    public static function createInstance()
    {
        if (!isset(self::$conf)) {
            $stClass = __CLASS__;
            self::$instance = new $stClass();
        }
    }


    public static function getConf($confKey)
    {
        return self::getConfs()[$confKey] ?? null;
    }

    public static function getConfs()
    {
        if (!isset(self::$instance)) {
            self::createInstance();
        }
        return self::$conf;
    }

}