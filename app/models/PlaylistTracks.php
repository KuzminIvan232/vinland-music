<?php

namespace app\models;

use core\Model;
use core\Core;

/**
 * @property int $playlist_id
 * @property int $song_id
 */

class PlaylistTracks extends Model
{
    public static $tableName = 'playlist_tracks';
    public static function addTrackToPlaylist($playlistId, $songId)
    {
        $playlistTracks = new self();
        $playlistTracks->playlist_id = $playlistId;
        $playlistTracks->song_id = $songId;
        $playlistTracks->save();
    }

    public static function getTracksFromPlaylist($playlistId)
    {
        $db = Core::get()->db;
        return $db->select(self::$tableName, '*', ['playlist_id' => $playlistId]);
    }
}