<?php

namespace app\models;

use \core\Model;

/**
 * @property int $song_id
 * @property string $title
 * @property string $artist
 * @property int $duration
 * @property string $src
 * @property string $genre
 */
class Songs extends Model
{
    public static $tableName = "songs";
}