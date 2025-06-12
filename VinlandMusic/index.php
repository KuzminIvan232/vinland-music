<?php

use core\Router;

spl_autoload_register(static function ($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        include_once($path);
    }
});


$router = new core\Router(isset($_GET['route']) ? $_GET['route'] : '');
$router->run();
$router->render();