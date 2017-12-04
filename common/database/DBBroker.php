<?php

namespace common\database;

use common\lib\LoggingHelper;
use \PDO;

class DBBroker
{
    private static $instance;
    private $config;

    /** @var  $pdo PDO */
    protected $pdo;

    private function __construct()
    {
        $this->config = require(ROOT_URI . 'config/config.php');
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new DBBroker();
            self::$instance->connect();
        }

        return self::$instance;
    }

    private function connect()
    {
        if (is_null($this->pdo)) {
            try {
                $this->pdo = new PDO("mysql:host={$this->config['database']['host']};dbname={$this->config['database']['schema']};port={$this->config['database']['port']}",
                    $this->config['database']['username'],
                    $this->config['database']['password'],
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ));

                $this->setNames();
            } catch (\PDOException $ex) {
                throw $ex;
            } catch (\Exception $e) {
                throw $e;
            }
        }
    }

    private function disconnect()
    {
        $this->pdo = null;
    }

    private function setNames()
    {
        $this->pdo->query("SET NAMES 'utf8'");
    }


    public function starTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function commit()
    {
        $this->pdo->commit();
    }


    public function rollBack()
    {
        $this->pdo->rollBack();
    }

    public function insert(string $tableName, array $attributes): bool
    {
        $this->setNames();

        $params = str_repeat('?, ', count($attributes));
        $params = substr($params, 0, -2);

        $stmt = $this->pdo->prepare("INSERT INTO $tableName VALUES($params)");


        $param = 0;
        foreach ($attributes as $val) {
            $binded = $stmt->bindValue(++$param, $val);
            if (!$binded) {
                break;
            }
        }

        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (\Exception $e) {
            if (LOGGING_ERROR) {
                LoggingHelper::logToFile($e->getMessage(), $e->getTrace(), LOGGING_DBERROR_FILE);
            }

            throw $e;
        }

        throw new \Exception('Problem with bind parameters');
    }

    public function update(string $tableName, array $attributes, string $condition = null): bool
    {
        $this->setNames();

        $params = str_repeat('?, ', count($attributes));
        $params = substr($params, 0, -2);

        $stmt = $this->pdo->prepare("UPDATE $tableName($params)");

        $param = 0;
        foreach ($attributes as $column) {
            $binded = $stmt->bindParam(++$param, $column['value'], $column['type'], !empty($column['columnSize']) ? $column['columnSize'] : null);
            if (!$binded) {
                break;
            }
        }

        try {
            if ($binded && $stmt->execute()) {
                return true;
            }
        } catch (\Exception $e) {
            echo 'exception za insert';
            if (LOGGING_ERROR) {
                LoggingHelper::logToFile($e->getMessage(), $e->getTrace(), LOGGING_DBERROR_FILE);
            }
            throw $e;
        }

        throw new \Exception('Problem with bind parameters');
    }

    public function query($query, $loadOne = false): array
    {
        $this->setNames();
        $stmt = $this->pdo->query($query);

        if ($loadOne) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result === false ? array() : $result;
    }

    public function quoute(string $text, int $parameterType = PDO::PARAM_STR)
    {
        return $this->pdo->quote($text, $parameterType);
    }

    public function lastInsertId(string $name = null): string
    {
        return $this->pdo->lastInsertId($name);
    }
}

