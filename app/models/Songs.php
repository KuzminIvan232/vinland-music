<?php

namespace app\models;

use core\Core;
use \core\Model;

/**
 * @property int $song_id
 * @property string $title
 * @property string $artist
 * @property int $duration
 * @property string $src
 * @property string $genre
 * @property string $file_name
 */
class Songs extends Model
{
    public static $tableName = "songs";

    public static function addSong($title, $artist, $duration, $src, $genre, $fileName)
    {
        $song = new self();
        $song->title = $title;
        $song->artist = $artist;
        $song->duration = $duration;
        $song->src = $src;
        $song->genre = $genre;
        $song->file_name = $fileName;
        $song->save();
    }

    public static function getSongs()
    {
        $db = Core::get()->db;
        return $db->select(self::$tableName);
    }

    // change song name or delete methods
}