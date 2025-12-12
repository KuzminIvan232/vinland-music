<?php

namespace app\controllers;

require_once 'app/functions/uuid.php';

use app\models\Songs;
use core\Controller;
use core\Template;

class PagesController extends Controller
{
    public function actionHome()
    {
        return $this->render();
    }

    public function actionProfile()
    {
        return $this->render();
    }

    public function actionCatalog() //відображати пісні
    {
        $songs = \app\models\Songs::getSongs();

        return $this->render(null, [
            'tracks' => $songs
        ]);
    }

    public function actionUpload()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $file = $_FILES['file'];
            $title = $_POST['title'];
            $artist = trim($_POST['artist']);
            $duration = $_POST['duration'];
            $genre = trim($_POST['genre']);

            if ($file['error'] === 0) {

                $uploadDir = 'public/uploads/';
                $webPath = '/KursovaBE/public/uploads/';
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

                // Генеруємо унікальне ім’я через UUID
                $uuid = $this->generateUUIDv4();
                $fileName = $uuid . '.' . $ext;
                $filePath = $uploadDir . $fileName;
                $src = $webPath . $fileName;


                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    $song = new Songs();
                    $song->title = $title;
                    $song->artist = $artist;
                    $song->duration = $duration;
                    $song->src = $src;
                    $song->genre = $genre;
                    $song->file_name = $fileName;
                    $song->addSong($title, $artist, $duration, $src, $genre, $fileName);

                } else {
                    echo "Помилка при збереженні файлу!";
                }
            } else {
                echo "Помилка при завантаженні файлу!";
            }
        }
        return $this->render();
    }

    public function actionPlaylist()
    {
        return $this->render();
    }
}