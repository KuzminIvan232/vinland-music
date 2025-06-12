<?php

namespace app\controllers;

use core\Template;

class HomeController
{

    public function actionIndex() {
        $template = new \core\Template('app/views/home/index.php');
/*        $template->setParams(['Param1 => test1', 'Param2 => test2']);*/
        return [
            'Title' => 'home page',
            'Content' => $template->getHTML()
        ];
    }

}