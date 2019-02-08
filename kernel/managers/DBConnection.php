<?php

namespace Kernel\managers;


use Exception;
use Kernel\Conf;
use Kernel\interfaces\IDBConnection;
use PDO;

class DBConnection implements IDBConnection
{
    private static $driver = "mysql";
    private static $host = "localhost";
    private static $dbname = "dbdev";
    private static $user = "dev";
    private static $pwd = "dev";
    private static $charset = 'UTF8';

    private static $pdo;

    public static function getConnection(): PDO
    {
        return self::$pdo ?? self::createConnection();
    }

    private static function createConnection()
    {
        try {
            $driver = Conf::getConf('db_ms') ?? self::$driver;
            $host = Conf::getConf('db_host') ?? self::$host;
            $dbname = Conf::getConf('db_name') ?? self::$dbname;
            $user = Conf::getConf('db_user') ?? self::$user;
            $pwd = Conf::getConf('db_pwd') ?? self::$pwd;
            $charset = Conf::getConf('db_charset') ?? self::$charset;

            $dsn = $driver . ':host=' . $host . ';dbname=' . $dbname . ';charset=' . $charset;

            self::$pdo = new PDO($dsn, $user, $pwd);

            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return self::$pdo;
    }

}