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
    function generateUUIDv4(): string {
        $data = random_bytes(16);
        // Версія 4 (random)
        $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
        // Варіант RFC 4122
        $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}