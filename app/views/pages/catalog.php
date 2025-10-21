<?php
$this->Title = 'Catalog';
$this->Style = '/KursovaBE/css/pages/catalog.css';
$this->Script = '/KursovaBE/public/js/songs/player.js';
?>

<div class="catalog-page-container">
    <h1 class="catalog-title">Music Catalog</h1>
    <?php if (!empty($tracks)): ?>
        <?php foreach ($tracks as $track): ?>
            <div class="track-container">
                <audio class="track" src="<?= $track['src'] ?>"></audio>
                <div class="player">
                    <button class="play-pause-btn">Play</button>
                    <input type="range" class="seek-bar" value="0" min="0" max="100"/>
                    <span><strong><?= $track['title'] ?></strong></span><span>-</span><span><?= $track['artist'] ?></span>
                    <div class="timings">
                        <span class="current-time">0:00</span> / <span class="duration">0:00</span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>There is no uploaded tracks yet</p>
    <?php endif; ?>
</div>
