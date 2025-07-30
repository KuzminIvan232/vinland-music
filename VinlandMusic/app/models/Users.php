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
}