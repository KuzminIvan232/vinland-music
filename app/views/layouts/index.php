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
    <link rel="stylesheet" href="/KursovaBE/css/layouts.css">
    <!--<link rel="stylesheet" href="<?php /*= $Style */?>">-->
</head>
<body>
<div class="body-container">
    <div class="aside-container">
        <div class="title">
            <h1 class="main-title">VinlandMusic</h1>
        </div>
        <aside class="aside">
            <p>options</p>
        </aside>
    </div>

    <div class="main-container">
        <header class="player-bar">
            <p>player bar</p>
            <?php if (\app\models\Users::isUserLoggedIn()) : ?>
                <a href="/KursovaBE/users/logout">Logout</a>
            <?php else : ?>
                <?php if(\app\models\Users::isLoginPage()): ?>
                    <a href="/KursovaBE/users/register">Register</a>
                <?php elseif(\app\models\Users::isRegisterPage()): ?>
                    <a href="/KursovaBE/users/login">Login</a>
                <?php else: ?>
                    <a href="/KursovaBE/users/login">Login</a>
                    <a href="/KursovaBE/users/register">Register</a>
                <?php endif; ?>
            <?php endif; ?>
            <a href="/KursovaBE">Home</a>
        </header>
        <main class="main">
            <h1 class="temp-title"><?= $Title ?></h1>
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