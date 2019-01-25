<?php

namespace Kernel\mvcs;


class Routes
{
    public static $routes;
    private static $route_names;

    public function __construct($urlsMap)
    {
        self::setRoutes($urlsMap) ;
        self::setRouteNames();
    }

    public static function getRouteByName($route_name)
    {
        return array_filter(self::$routes, function ($k) use ($route_name){
            return $k == $route_name;
        }, ARRAY_FILTER_USE_KEY);
    }

    public static function getRouteByPath($route_path)
    {
        return array_filter(self::$routes, function ($k, $v) use ($route_path){
            return $k[0] == $route_path;
        }, ARRAY_FILTER_USE_BOTH)?? null;
    }

    public static function setRoutes($routes)
    {
        self::$routes = $routes;
    }

    public static function setRouteNames()
    {
        self::$route_names = array_keys(self::$routes);
    }
}