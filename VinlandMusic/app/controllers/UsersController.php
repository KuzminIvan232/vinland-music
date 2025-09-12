<?php

namespace app\controllers;

use core\Controller;
use core\Post;

class UsersController extends Controller
{
    public function actionLogin()
    {
        if (\app\models\Users::isUserLoggedIn()) {
            $this->redirect('/KursovaBE/VinlandMusic');
        }
        if ($this->isPost) {
            $user = \app\models\Users::verifyLoginAndPassword($this->post->login, $this->post->password);
            if (!empty($user)) {
                \app\models\Users::loginUser($user);
                return $this->redirect('/KursovaBE/VinlandMusic');
            } else {
                $this->setErrorMessage('wrong login or password');
            }
        }

        return $this->render();
    }

    public function actionRegister()
    {
        if ($this->isPost) {

            $user = \app\models\Users::verifyLogin($this->post->login);

            if (!empty($user)) {
                $this->addErrorMessage('user already exists');
            }
            if(strlen($this->post->login) === 0) {
                $this->addErrorMessage('login is required');
            }
            if (strlen($this->post->password) === 0) {
                $this->addErrorMessage('password is required');
            }
            if ($this->post->password != $this->post->password2) {
                $this->addErrorMessage('password does not match');
            }
            if (!$this->isErrorMessagesExist()) {
                \app\models\Users::registerUser($this->post->login, $this->post->password);
                return $this->redirect('/KursovaBE/VinlandMusic/users/login');
            }
        }
        return $this->render();
    }

    public function actionLogout()
    {
        \app\models\Users::logoutUser();
        return $this->redirect('/KursovaBE/VinlandMusic/users/login');
    }

}