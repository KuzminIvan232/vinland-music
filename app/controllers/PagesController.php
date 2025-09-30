<?php

namespace app\controllers;

use app\models\Songs;
use core\Controller;
use core\Template;

class PagesController extends Controller
{
    public function actionHome()
    {

        $db = \core\Core::get()->db;

        /*$song = new Songs();
        $song->title = 'nutshell';
        $song->artist = 'alice_in_chains';
        $song->duration = '4:02';
        $song->src = 'jfdsalkfjakl';
        $song->genre = 'country';
        $song->save();*/

        /*Songs::deleteByCondition([
            'artist' => 'alice_in_chains'
        ]);*/

        return $this->render();
    }
    public function actionProfile()
    {
        return $this->render();
    }

    public function actionCatalog()
    {
        return $this->render();
    }

}