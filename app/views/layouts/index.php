<?php
/** @var string $Title */
/** @var string $Content */
/** @var string $Style */

/** @var string $Script */

use app\models\Users;

if (empty($Title)) {
    $Title = '';
}
if (empty($Content)) {
    $Content = '';
}
if (empty($Style)) {
    $Style = '';
}
if (empty($Script)) {
    $Script = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $Title ?></title>
    <link rel="stylesheet" href="/KursovaBE/css/layouts/index.css">
    <?php if (!empty($Style)) : ?>
    <link rel="stylesheet" href="<?= $Style ?>">
    <?php endif; ?>
</head>
<body>
<div class="body-container">
    <div class="aside-container">
        <div class="title-container">
            <h1 class="title"><a href="/KursovaBE">VinlandMusic</a></h1>
        </div>
        <aside class="aside">
            <div class="navigation">
                <div class="music-navigation">
                    <?php if (\app\models\Users::isUserLoggedIn()) : ?>
                        <a href="/KursovaBE/pages/catalog">Catalog</a>
                        <a href="/KursovaBE/pages/upload">Upload</a>
                    <?php else : ?>
                        <a href="/KursovaBE/pages/catalog">Catalog</a>
                    <?php endif ?>
                </div>
                <div class="user-navigation">
                    <?php if (\app\models\Users::isUserLoggedIn()) : ?>
                        <a href="/KursovaBE/pages/profile">Profile</a>
                    <?php else : ?>
                        <a href="/KursovaBE/users/login">Login</a>
                        <a href="/KursovaBE/users/register">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </aside>
    </div>

    <div class="main-container">
        <header class="player-bar-container">
            <audio class="pb-track"></audio>
            <div class="player">
                <button class="prev-btn">Prev</button>
                <button class="play-btn">Play</button>
                <button class="next-btn">Next</button>
                <input type="range" class="seek-bar" value="0" min="0" max="100"/>
                <strong class="pb-title">No track selected</strong><span>-</span><span class="pb-artist"></span>
                <div class="pb-timings">
                    <span class="pb-current-time">0:00</span> / <span class="pb-duration">0:00</span>
                </div>
            </div>
        </header>

        <main class="main">
            <?= $Content ?>
        </main>
    </div>

    <footer></footer>
</div>
<script type="module" src="/KursovaBE/public/js/songs/player.js"></script>
<?php if (!empty($Script)) : ?>
<script type="module" src="<?= $Script ?>"></script>
<?php endif; ?>
</body>
</html>