<?php
/** @var string $Title */
/** @var string $Content */
/** @var string $Style */

use app\models\Users;

if (empty($Title)) {
    $Title = '';
}
if (empty($Content)) {
    $Content = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $Title ?></title>
    <link rel="stylesheet" href="<?= $Style ?>">
</head>
<body>
<div class="body-container">
    <div class="aside-container">
        <div class="title-container">
            <h1 class="title"><a href="/KursovaBE">VinlandMusic</a></h1>
        </div>
        <aside class="aside">

        </aside>
    </div>

    <div class="main-container">
        <header class="player-bar-container">
            <div class="player-bar">

            </div>
            <div class="navigation">
                <?php if (\app\models\Users::isUserLoggedIn()) : ?>
                    <a href="/KursovaBE/users/logout">Logout</a>
                <?php else : ?>
                    <a href="/KursovaBE/users/login">Login</a>
                    <a href="/KursovaBE/users/register">Register</a>
                <?php endif; ?>
            </div>
        </header>

        <main class="main">
            <?= $Content ?>
            <!--<div class="song-container">
                <p>main</p>

                <ul class="song-list">
                    <li class="song"></li>
                </ul>
            </div>-->
        </main>
    </div>

    <footer></footer>
</div>
</body>
</html>