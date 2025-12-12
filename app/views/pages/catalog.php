<?php
$this->Title = 'Catalog';
$this->Style = '/KursovaBE/css/pages/catalog.css';
$this->Script = '/KursovaBE/public/js/songs/catalog.js';
?>

<div class="catalog-page-container">
    <h1 class="catalog-title">Music Catalog</h1>
    <?php if (!empty($tracks)): ?>
        <?php foreach ($tracks as $track): ?>
            <div class="track"
                 data-src="<?= $track['src'] ?>"
                 data-title="<?= $track['title'] ?>"
                 data-artist="<?= $track['artist'] ?>"
                 data-duration="<?= $track['duration'] ?>">
                <span><strong><?= $track['title'] ?></strong></span><span>-</span><span><?= $track['artist'] ?></span>
                <span class="duration">0:00</span>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>There is no uploaded tracks yet</p>
    <?php endif; ?>
</div>
