<?php
$this->Title = "Playlist";
$this->Style = "/KursovaBE/css/pages/playlists.css";
$this->Script = "/KursovaBE/public/js/playlist/playlists.js";
?>

<div class="playlist-page-container">
    <h1 class="playlist-title">Your Playlists</h1>
    <?php if (!empty($playlists)) : ?>
        <?php foreach ($playlists as $playlist): ?>
            <div class="playlist"
                 data-id="<?= $playlist['playlist_id'] ?>"
                 data-title="<?= $playlist['title'] ?>">
                <span><strong><?= $playlist['title'] ?></strong></span>
                <img class="playlist-image" src="<?= $playlist['cover_image'] ?>" alt="playlist cover image"/>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>You have no playlists yet</p>
    <?php endif; ?>
    <a href="/KursovaBE/playlists/create">Create playlist</a>
</div>
