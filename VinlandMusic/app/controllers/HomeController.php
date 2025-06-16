<?php

namespace app\controllers;

use core\Controller;
use core\Template;

class HomeController extends Controller
{

    public function actionIndex() {
        return $this->render();
    }

}