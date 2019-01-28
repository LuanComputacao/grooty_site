<?php

namespace Kernel\managers;


use Exception;
use Kernel\Conf;
use Kernel\interfaces\IDBConnection;
use PDO;
use PDOException;

class DBConnection implements IDBConnection
{
    private static $driver = "mysql";
    private static $host = "localhost";
    private static $dbname = "dbdev";
    private static $user = "dev";
    private static $pwd = "dev";


    private static $pdo;

    public static function getConnection()
    {
        return self::$pdo ?? self::createConnection();
    }

    private static function createConnection()
    {
        try {
            self::$pdo = new PDO(
                'mysql:host=' . Conf::getConf('db_host') . ';dbname=' . Conf::getConf('db_name'),
                Conf::getConf('db_user'),
                Conf::getConf('db_pwd')
            );
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}