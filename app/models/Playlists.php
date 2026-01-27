<?php

namespace app\models;

use core\Core;
use core\Model;

/**
 * @property int $playlist_id
 * @property string $title
 * @property int $user_id
 * @property string|null $cover_image
 */
class Playlists extends Model
{

    public static $tableName = "playlists";

    public static function createPlaylist($title, $userId, $coverImage = null)
    {
        $playlist = new self();
        $playlist->title = $title;
        $playlist->user_id = $userId;
        $playlist->cover_image = $coverImage;
        $playlist->save();
    }

    public static function getPlaylists()
    {
        $db = Core::get()->db;
        return $db->select(self::$tableName);
    }
}