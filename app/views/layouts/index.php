<?php
/** @var string $Title */
/** @var string $Content */
/** @var string $Style */
/** @var string $Script */
/** @var string $track */

use app\models\Users;

if (empty($Title)) {
    $Title = '';
}
if (empty($Content)) {
    $Content = '';
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
    <?php if(!empty($Style)) : ?>
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
                <?php if (\app\models\Users::isUserLoggedIn()) : ?>
                    <div class="music-navigation">
                        <a href="/KursovaBE/pages/catalog">Catalog</a>
                        <a href="/KursovaBE/pages/upload">Upload</a>
                    </div>
                <?php endif?>
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
            <div class="player-bar">
                    <!--<audio class="track" src="<?php /*= $track['src'] */?>"></audio>
                    <div class="player">
                        <button class="play-pause-btn">Play</button>
                        <input type="range" class="seek-bar" value="0" min="0" max="100"/>
                        <strong><?php /*= $track['title'] */?></strong> - <?php /*= $track['artist'] */?>
                        <div class="timings">
                            <span class="current-time">0:00</span> / <span class="duration">0:00</span>
                        </div>
                    </div>-->
            </div>
        </header>

        <main class="main">
            <?= $Content ?>
        </main>
    </div>

    <footer></footer>
</div>
<script src="<?= $Script ?>"></script>
</body>
</html>