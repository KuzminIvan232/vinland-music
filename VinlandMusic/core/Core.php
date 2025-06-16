<?php

namespace core;

class Core
{
    public $layoutPath = 'app/views/layouts/index.php';
    public $route;
    public $template;
    public $moduleName;
    public $actionName;
    private static $instance;
    private function __construct() {
        $this->template = new \core\Template($this->layoutPath);
    }

    public function run($route) {
        $this->route = new \core\Router($route);
        $params = $this->route->run();
        $this->template->setParams($params);
    }

    public function done() {
        $this->template->display();
        $this->route->done();
    }

    public static function get() {
        if (empty(self::$instance)) {
           self::$instance = new Core();
        }
        return self::$instance;
    }
}