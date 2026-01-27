<?php
$this->Title = "Playlist";
$this->Style = "/KursovaBE/css/pages/playlists.css";
$this->Script = "/KursovaBE/public/js/playlist/playlists.js";
?>

<div class="playlist-page-container">
    <h1 class="playlist-title">Your Playlists</h1>
    <div class="playlists-container">
        <?php if (!empty($playlists)) : ?>
            <?php foreach ($playlists as $playlist): ?>
                <div class="playlist"
                     data-id="<?= $playlist['playlist_id'] ?>"
                     data-title="<?= $playlist['title'] ?>">
                    <img class="playlist-image" src="<?= $playlist['cover_image'] ?>" alt="playlist cover image"/>
                    <p class="playlist-name"><?= $playlist['title'] ?></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>You have no playlists yet</p>
        <?php endif; ?>
    </div>
    <a href="/KursovaBE/playlists/create">Create playlist</a>
</div>
