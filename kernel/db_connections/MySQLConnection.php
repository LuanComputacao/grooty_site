<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 06/01/19
 * Time: 19:06
 */

namespace Kernel;


use Kernel\interfaces\IDBConnection;
use PDO;
use PDOException;

class MySQLConnection implements IDBConnection
{
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
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}