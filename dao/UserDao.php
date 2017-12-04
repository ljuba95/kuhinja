<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 12/4/2017
 * Time: 9:21 PM
 */

namespace dao;


use model\User;

class UserDao extends Dao
{

    public function loadAll(): array
    {
        $res = $this->db->query('SELECT * FROM USERS');
    }

    public function loadById($id): ?User
    {
        $res = $this->db->query('SELECT * FROM users WHERE id = ' . $id);
        return $this->getResults($res)[0];
    }

    public function loadByEmail($email): ?User
    {
        $res = $this->db->query('SELECT * FROM users WHERE email = \'' . $email . '\'');
        if(!isset($res[0])){
            return null;
        }
        return $this->populate($res[0]);
    }

    public function save(User $user) : bool {

        return $this->db->insert('users',array(null, $user->getName(),$user->getEmail(),md5($user->getPassword())));
    }

    private function populate($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setName($row['name']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);
        return $user;
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