<?php

namespace common\lib;

use dao\UserDao;
use model\User;

class SessionHelper
{

    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function delete(string $key)
    {
        unset($_SESSION[$key]);
    }

    public static function setFlashMessage(string $key, string $value): void
    {
        if (!isset($_SESSION['flash'])) {
            $_SESSION['flash'] = [];
        }

        $_SESSION['flash'][$key] = $value;
    }

    public static function getFlashMessage(string $key): string
    {
        if (!isset($_SESSION['flash'])) {
            $_SESSION['flash'] = [];
        }

        $value = isset($_SESSION['flash'][$key]) ? $_SESSION['flash'][$key] : '';
        unset($_SESSION['flash'][$key]);

        return $value;
    }

    public static function loggedUser(): ?User{
        $userId = SessionHelper::get('user_id');
        if (is_null($userId)){
            return null;
        }
        $dao = new UserDao();
        return $dao->loadById($userId);
    }

    public static function loginUser(User $user){
        SessionHelper::set('user_id',$user->getId());
    }
}