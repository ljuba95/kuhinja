<?php

namespace common;

use \InvalidArgumentException, \ReflectionClass;

class FrontController
{

    protected $controller = CONTROLLER_NAMESPACE . DEFAULT_CONTROLLER;
    protected $action = DEFAULT_ACTION;
    protected $params = array();
    protected $basePath = ROOT_URI;

    public function __construct(array $options = array())
    {
        if (empty($options)) {
            $this->parseUri();
        } else {
            if (isset($options["controller"])) {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);
            }
            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
    }

    private function parseUri()
    {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        $path = preg_replace('/[^a-zA-Z0-9]\//', "", $path);
        if (strpos($path, $this->basePath) === 0) {
            $path = substr($path, strlen($this->basePath));
        }
        @list($controller, $action, $params) = explode("/", $path, 3);
        if (!empty($controller)) {
            $this->setController($controller);
        }
        if (!empty($action)) {
            $this->setAction($action);
        }
        if (!empty($params)) {
            $this->setParams(explode("/", $params));
        }
    }

    private function setController($controller)
    {
        $controller = CONTROLLER_NAMESPACE . ucfirst(strtolower($controller)) . "Controller";
        if (!class_exists($controller)) {
            throw new InvalidArgumentException(
                "The action controller '$controller' has not been defined.");
        }
        $this->controller = $controller;
    }

    private function setAction($action)
    {
        $reflector = new ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action . 'Action')) {
            throw new InvalidArgumentException(
                "The controller action '$action' has been not defined.");
        }
        $this->action = $action;
    }

    private function setParams(array $params)
    {
        $this->params = $params;
    }

    public function run()
    {
        call_user_func_array(array(new $this->controller, $this->action . 'Action'), $this->params);
    }


}