<?php

namespace core;

class Core
{
    public $layoutPath = 'app/views/layouts/index.php';
    public $route;
    public $template;
    public $moduleName;
    public $actionName;
    public $db;
    public $session;
    public Controller $controllerObject;
    private static $instance;

    private function __construct()
    {
        $this->template = new \core\Template($this->layoutPath);
        $host = \core\Config::get()->dbHost;
        $name = \core\Config::get()->dbName;
        $login = \core\Config::get()->dbLogin;
        $password = \core\Config::get()->dbPassword;
        $this->db = new Database($host, $name, $login, $password);
        $this->session = new Session();
        session_start();
    }

    public function setLayoutPath($pathToView)
    {
        $this->layoutPath = $pathToView;
        $this->template = new \core\Template($this->layoutPath);
    }

    public function run($route)
    {
        $this->route = new \core\Router($route);
        $params = $this->route->run();
        if (!empty($params)) {
            $this->template->setParams($params);
        }
    }

    public function done()
    {
        $this->template->display();
    }

    public static function get()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}