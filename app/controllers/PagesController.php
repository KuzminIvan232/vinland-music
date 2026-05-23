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
        if (!\app\models\Users::isUserLoggedIn()) {
            return $this->redirect('/KursovaBE/users/login');
        }

        $currentUser = \app\models\Users::getCurrentUser();

        if ($this->isPost) {
            $newLogin = trim($this->post->new_login);
            $newPass = $this->post->new_password;
            $newPass2 = $this->post->new_password2;

            if (empty($newLogin)) {
                $this->addErrorMessage('Login cannot be empty');
            }
            elseif ($newLogin !== $currentUser['login']) {
                $existing = \app\models\Users::verifyLogin($newLogin);
                if (!empty($existing)) {
                    $this->addErrorMessage('Login already taken');
                }
            }

            $passwordToSave = $currentUser['password'];
            if (!empty($newPass) || !empty($newPass2)) {
                if ($newPass !== $newPass2) {
                    $this->addErrorMessage('New passwords do not match');
                }
                elseif (strlen($newPass) < 4) {
                    $this->addErrorMessage('New password must be at least 4 characters');
                }
                else {
                    $passwordToSave = $newPass;
                }
            }

            if (!$this->isErrorMessagesExist()) {
                \app\models\Users::updateUser(
                    $currentUser['user_id'],
                    $newLogin,
                    $passwordToSave,
                    $currentUser['role']
                );

                $updatedUser = $currentUser;
                $updatedUser['login'] = $newLogin;
                $updatedUser['password'] = $passwordToSave;
                \app\models\Users::updateSession($updatedUser);
                $currentUser = $updatedUser;

                $this->template->setParam('success_message', 'Profile updated successfully');
            }
        }

        return $this->render(null, [
            'current_user' => $currentUser,
        ]);
    }

    public function actionCatalog()
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

                $uploadDir = 'public/uploads/songs';
                $webPath = '/KursovaBE/public/uploads/songs';
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

                }
                else {
                    echo "Помилка при збереженні файлу!";
                }
            }
            else {
                echo "Помилка при завантаженні файлу!";
            }
        }
        return $this->render();
    }

    public function actionPlaylists()
    {
        $playlists = \app\models\Playlists::getPlaylists();

        return $this->render(null, [
            'playlists' => $playlists
        ]);
    }
}