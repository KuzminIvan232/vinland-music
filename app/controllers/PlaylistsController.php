<?php

namespace app\controllers;

require_once 'app/functions/imageCrop.php';

use app\models\Playlists;
use core\Controller;
use core\Template;

class PlaylistsController extends Controller
{

    public function actionCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_SESSION);
            $title = $_POST['title'];
            $userId = $_SESSION['user']['user_id'];
            $file = $_FILES['file'];

            if ($file['error'] === 0) {

                $coverImage = '/KursovaBE/public/uploads/images/' . $file['name'];
                $filePath = 'public/uploads/images/' . $file['name'];

                if (move_uploaded_file($file['tmp_name'], $filePath)) {

                    resizeAndCrop($filePath, $filePath);

                    $playlist = new Playlists();
                    $playlist->title = $title;
                    $playlist->cover_image = $coverImage;
                    $playlist->user_id = $userId;
                    $playlist->createPlaylist($title, $userId, $coverImage);

                    return $this->redirect('/KursovaBE/pages/playlists');
                } else {
                    echo "Помилка при збереженні зображення.";
                }
            } else {
                echo "Помилка при завантаженні зображення.";
            }
        }
        return $this->render();
    }

    public function actionAddTrackToPlaylist()
    {

    }

}