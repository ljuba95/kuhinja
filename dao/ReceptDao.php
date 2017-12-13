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

    public function loadByUser($id): array
    {
        $res = $this->db->query('SELECT * FROM recipes WHERE user_id = ' . $id);
        return $this->getResults($res);
    }

    public function count()
    {
        $query = 'SELECT COUNT(*) as ct FROM recipes';

        list($ct) = $this->db->query($query);
        return reset($ct);
    }

    public function save(Recept $recept) : bool {

        return $this->db->insert('recipes',array(null, $recept->getName(),$recept->getText(),$recept->getImg(),$recept->getTimeNeeded(),$recept->getDateCreated(),$recept->getUserId()));
    }

    public function loadById($id): ?Recept
    {

        $res = $this->db->query('SELECT * FROM recipes WHERE id = ' . $id);
        return $this->populate($res[0]);
    }

    public function update(Recept $recept) : bool{

        return $this->db->update('recipes', ['name','text','img','time_needed','date_created'],
            [$recept->getName(),$recept->getText(),$recept->getImg(),$recept->getTimeNeeded(),$recept->getDateCreated()], 'id = '. $recept->getId());
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

    public function delete($id) : bool
    {
        return $this->db->delete('recipes', $id);
    }

    public function searchByName($query)
    {
        $q = $this->createQuery('recipes', "name LIKE '$query%'", false,1);
        $res = $this->db->query($q);
        return $this->getResults($res);
    }
}