<?php

namespace Kernel\managers;

class DebugManager
{
    public static function spit($args = '')
    {
        echo '<hr>';
        echo '<pre>';
        if ($args != '') {
            var_dump($args);
        }
        echo '</pre>';
        echo '<hr>';
    }

    public static function spitDie($args = '')
    {
        self::spit($args);
        die();
    }

}
