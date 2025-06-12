<?php

namespace core;

class Router
{

    protected $route;
    protected $template;
    public function __construct($route) {
        $this->route = $route;
        $this->template = new \core\Template('app/views/layouts/index.php');
    }
    public function run() {
        $parts = explode('/', $this->route);
        if (strlen($parts[0]) == 0) {
            $parts[0] = 'home';
            $parts[1] = 'index';
        }
        if (count($parts) == 1) {
            $parts[1] = 'index';
        }
        $controller = 'app\\controllers\\' . ucfirst($parts[0]) . 'Controller';
        $method = 'action' . ucfirst($parts[1]);
        if (class_exists($controller)) {
            $controllerObject = new $controller();
            if (method_exists($controller, $method)) {
                $params = $controllerObject->$method();
                $this->template->setParams($params);
            } else {
                $this->error(404);
            }
        } else {
            $this->error(404);
        }
    }

    public function render() {
        $this->template->display();
    }
    public function error($code) {
        http_response_code($code);
        echo $code;
    }
}