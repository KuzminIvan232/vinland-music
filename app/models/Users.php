<?php

namespace app\models;

use core\Model;

/**
 * @property int $user_id
 * @property string $login
 * @property string $password
 * @property int $role
 */
class Users extends Model
{
    public static $tableName = "users";

    public static function verifyLoginAndPassword($login, $password)
    {
        $rows = self::findByCondition(['login' => $login, 'password' => $password]);
        if (!empty($rows)) {
            return $rows;
        } else {
            return null;
        }
    }

    public static function verifyLogin($login)
    {
        $rows = self::findByCondition(['login' => $login]);
        if (!empty($rows)) {
            return $rows;
        } else {
            return null;
        }
    }
    public static function isUserLoggedIn()
    {
        return !empty(\core\Core::get()->session->get('user'));
    }

    public static function loginUser($user)
    {
        \core\Core::get()->session->set('user', $user);
    }

    public static function logoutUser()
    {
        \core\Core::get()->session->remove('user');
    }

    public static function registerUser($login, $password)
    {
        $user = new self();
        $user->login = $login;
        $user->password = $password;
        $user->role = 'user';
        $user->save();
    }

    public static function isLoginPage()
    {
        if ($_SERVER['REQUEST_URI'] == '/KursovaBE/users/login') {
            return true;
        } else {
            return false;
        }
    }

    public static function isRegisterPage()
    {
        if ($_SERVER['REQUEST_URI'] == '/KursovaBE/users/register') {
            return true;
        } else {
            return false;
        }
    }

    public static function isProfilePage()
    {
        if ($_SERVER['REQUEST_URI'] == '/KursovaBE/users/profile') {
            return true;
        } else {
            return false;
        }
    }
}