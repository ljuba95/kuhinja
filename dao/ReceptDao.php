<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 11/30/2017
 * Time: 10:20 PM
 */

namespace dao;


use model\Recept;

class ReceptDao extends Dao
{

    public function loadAll(): array
    {
        $res = $this->db->query('SELECT * FROM RECIPES');
    }

    public function loadPage($page = 1): array
    {
        $query = $this->createQuery('recipes', null, false, $page);
        $res = $this->db->query($query);
        return $this->getResults($res);
    }

    public function count()
    {
        $query = 'SELECT COUNT(*) as ct FROM recipes';

        list($ct) = $this->db->query($query);
        return reset($ct);
    }

    public function loadById($id): ?Recept
    {

        $res = $this->db->query('SELECT * FROM recipes WHERE id = ' . $id);
        return $this->populate($res[0]);
    }

    private function populate($row)
    {
        $recipe = new Recept();
        $recipe->setId($row['id']);
        $recipe->setName($row['name']);
        $recipe->setText($row['text']);
        $recipe->setDateCreated($row['date_created']);
        $recipe->setTimeNeeded($row['time_needed']);
        $recipe->setImg($row['img']);
        $recipe->setUserId($row['user_id']);
        return $recipe;
    }

    private function getResults($rs)
    {
        $arr = array();
        if (!empty($rs)) {
            foreach ($rs as $row) {
                $arr[] = $this->populate($row);
            }

        }
        return $arr;
    }
}