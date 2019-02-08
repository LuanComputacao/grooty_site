<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 16/12/18
 * Time: 18:46
 */

namespace Kernel\Models;

use Kernel\Conf;
use Kernel\managers\DBConnection;

trait Model
{
    private static $connection;
    private $tableName;
    private $query;
    private $columns;
    public $created;

    /**
     * Returns the traitObjects method
     *
     * @return Model instance
     */
    abstract static function objects();

    abstract function ifExistsQuery(): bool;

    abstract function fillAttributes($columns): void;


    /**
     * Model constructor.
     *
     * @param string $tableName
     */
    private function __construct(string $tableName)
    {
        $this->tableName = $tableName;
        $this->fillColumnNames();
    }

    public function wasCreated()
    {
        return $this->created == true;
    }

    private function storeConnection()
    {
        self::$connection = DBConnection::getConnection();
    }

    /**
     * @param string $tableName Table name
     *
     * @return Model Return an instance of the class
     */
    public static function traitObjects(string $tableName)
    {
        $stClass = __CLASS__;
        $instanceModel = new $stClass($tableName);
        if (!isset(self::$connection) || self::$connection == null) {
            $instanceModel->storeConnection();
        }

        return $instanceModel;
    }

    public function getConnection()
    {
        return self::$connection;
    }

    private function execute(\PDOStatement $stmt, $data = null)
    {
        $this->query = $stmt->queryString;
        if (is_null($data)) {
            $stmt->execute();
        } else {
            $stmt->execute($data);
        }

        return $stmt;
    }

    public function getQuery()
    {
        return $this->query;
    }

    private function fillColumnNames()
    {
        $vars = array_keys(get_object_vars($this));
        $columns = [];
        foreach ($vars as $var) {
            if (preg_match('/^ct/', $var)) {
                $columnVar = preg_replace_callback('/([A-Z])/', function ($word) {
                    return '_' . strtolower($word[0]);
                }, $var);
                $column = preg_replace('/^ct_/', '', $columnVar);
                array_push($columns, [
                    'ct' => $column,
                    'var' => $var,
                    'placeholder' => ':' . $column,
                ]);
            }
        }

        $this->columns = $columns;
    }

    private function getTableColumns()
    {
        $tableColumns = [];
        foreach ($this->columns as $column) {
            array_push($tableColumns, $column['ct']);
        }

        return $tableColumns;
    }

    private function getNamedPlaceholders()
    {
        $placeholders = [];
        foreach ($this->columns as $column) {
            array_push($placeholders, $column['placeholder']);
        }

        return join(', ', $placeholders);
    }

    public function getAll($limit = null)
    {
        if ($limit == null) {
            $limit = Conf::getConf('db_limit') ?? 10;
        }
        $stmt = self::$connection->prepare('SELECT * from ' . $this->tableName . ' LIMIT ' . $limit);
        $this->execute($stmt);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function first()
    {
    }

    public function save()
    {
        $exists = $this->checkIfExists();
        if (!reset($exists)) {
            $this->storeConnection();
            $stmt = self::$connection->prepare('INSERT INTO ' . $this->tableName . '(' . join(', ',
                    $this->getTableColumns()) . ')'
                . ' VALUES' . '(' . $this->getNamedPlaceholders() . ')');
            $data = $this->getColumnTypes();
            $this->execute($stmt, $data);
            $exists = $this->checkIfExists();
            $this->created = true;
        }
        if ($exists) {
            $entity = next($exists);
            $this->fillAttributes(reset($entity));
        }
    }

    private function getColumnTypes()
    {
        $data = [];
        foreach ($this->columns as $key => $column) {
            $attribute = $column['var'];
            $data[$column['ct']] = $this->$attribute;
        }

        return $data;
    }

    private function checkIfExists()
    {
        $query = $this->ifExistsQuery();
        $stmt = self::$connection->prepare($query);
        $this->execute($stmt);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $stmt->rowCount();

        return [$affectedRows > 0 ? true : false, $result];
    }
}
