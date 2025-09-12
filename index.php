<?php

use core\Router;

spl_autoload_register(static function ($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        include_once($path);
    }
});

$core = \core\Core::get();
$core->run(isset($_GET['route']) ? $_GET['route'] : '');
$core->done();