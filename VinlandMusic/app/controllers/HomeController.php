<?php

namespace app\controllers;

class HomeController
{

    public function actionIndex() {
        return [
            'Title' => 'home title',
            'Content' => 'home page content'
        ];
    }

}