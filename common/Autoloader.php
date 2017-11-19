<?php

namespace common;

class Autoloader
{
    /**
     * Autoloader constructor.
     */
    public function __construct()
    {

    }

    public function register(array $autoload = array())
    {

        if (empty($autoload)) {
            spl_autoload_register(array($this, 'autoload'));
        } else {
            spl_autoload_register($autoload);
        }
    }

    private function autoload($class)
    {
        $file = str_replace('\\', '/', $class) . '.php';
        $filePath = ROOT_URI . $file;

        if (file_exists($filePath)) {
            require $filePath;
            return;
        }

        $directories = ['common', 'config', 'controller', 'recipe', 'modelRepository'];

        foreach ($directories as $namespace => $dir) {
            $filePath = ROOT_URI . $dir . '/' . $file;
            if (file_exists($filePath)) {
                require $filePath;
                return;
            }
        }
    }
}
