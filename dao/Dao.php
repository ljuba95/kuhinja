<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 11/30/2017
 * Time: 10:19 PM
 */

namespace dao;


use common\database\DBBroker;

abstract class Dao
{

    protected $db;

    /**
     * Dao constructor.
     * @param $db
     */
    public function __construct()
    {
        $this->db = DBBroker::getInstance();
    }

    protected function createQuery(string $tableName = null, string $whereCondition = null, $count = false, int $page = 1, int $limit = DEFAULT_ROWNUMBER): string
    {
        $page = $page > 0 ? $page : 1;
        $limit = ($limit > 0 || $limit === -1) ? $limit : DEFAULT_ROWNUMBER;

        $query = $count ? 'SELECT COUNT(*)' : 'SELECT *';


        $query .= ' FROM ' . $tableName;

        if (!is_null($whereCondition)) {
            $query .= ' WHERE ' . $whereCondition;
        }


        if (!$count) {
            $offset = ceil(($page - 1) * $limit);
            if ($limit !== -1) {
                $query .= " LIMIT $offset, $limit";
            }
        }

        return $query;
    }
}