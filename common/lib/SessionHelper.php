<?php

namespace common\lib;

class SessionHelper
{

    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key)
    {
        return isset($_SESSION[$key]) ?: null;
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

}