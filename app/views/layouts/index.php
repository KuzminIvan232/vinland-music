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
                        <a href="/KursovaBE/pages/catalog">
                            <svg style="display: flex; justify-content: center; align-items: center" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M17.316 4.052a.99.99 0 0 0-.9.14c-.262.19-.416.495-.416.82v8.566a4.573 4.573 0 0 0-2-.464c-1.99 0-4 1.342-4 3.443 0 2.1 2.01 3.443 4 3.443 1.99 0 4-1.342 4-3.443V6.801c.538.5 1 1.219 1 2.262 0 .56.448 1.013 1 1.013s1-.453 1-1.013c0-1.905-.956-3.18-1.86-3.942a6.391 6.391 0 0 0-1.636-.998 4 4 0 0 0-.166-.063l-.013-.005-.005-.002h-.002l-.002-.001ZM4 5.012c-.552 0-1 .454-1 1.013 0 .56.448 1.013 1 1.013h9c.552 0 1-.453 1-1.013 0-.559-.448-1.012-1-1.012H4Zm0 4.051c-.552 0-1 .454-1 1.013 0 .56.448 1.013 1 1.013h9c.552 0 1-.454 1-1.013 0-.56-.448-1.013-1-1.013H4Zm0 4.05c-.552 0-1 .454-1 1.014 0 .559.448 1.012 1 1.012h4c.552 0 1-.453 1-1.012 0-.56-.448-1.013-1-1.013H4Z" clip-rule="evenodd"/>
                            </svg>
                            Catalog
                        </a>
                        <a href="/KursovaBE/pages/upload">
                            <svg style="display: flex; justify-content: center; align-items: center" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 3a1 1 0 0 1 .78.375l4 5a1 1 0 1 1-1.56 1.25L13 6.85V14a1 1 0 1 1-2 0V6.85L8.78 9.626a1 1 0 1 1-1.56-1.25l4-5A1 1 0 0 1 12 3ZM9 14v-1H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-4v1a3 3 0 1 1-6 0Zm8 2a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                            </svg>
                            Upload
                        </a>
                        <a href="/KursovaBE/pages/playlists">
                            <svg style="display: flex; justify-content: center; align-items: center" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Zm4.996 2a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 8a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 11a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 14a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Z" clip-rule="evenodd"/>
                            </svg>
                            Playlists
                        </a>
                    <?php else : ?>
                        <a href="/KursovaBE/pages/catalog">
                            <svg style="display: flex; justify-content: center; align-items: center" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M17.316 4.052a.99.99 0 0 0-.9.14c-.262.19-.416.495-.416.82v8.566a4.573 4.573 0 0 0-2-.464c-1.99 0-4 1.342-4 3.443 0 2.1 2.01 3.443 4 3.443 1.99 0 4-1.342 4-3.443V6.801c.538.5 1 1.219 1 2.262 0 .56.448 1.013 1 1.013s1-.453 1-1.013c0-1.905-.956-3.18-1.86-3.942a6.391 6.391 0 0 0-1.636-.998 4 4 0 0 0-.166-.063l-.013-.005-.005-.002h-.002l-.002-.001ZM4 5.012c-.552 0-1 .454-1 1.013 0 .56.448 1.013 1 1.013h9c.552 0 1-.453 1-1.013 0-.559-.448-1.012-1-1.012H4Zm0 4.051c-.552 0-1 .454-1 1.013 0 .56.448 1.013 1 1.013h9c.552 0 1-.454 1-1.013 0-.56-.448-1.013-1-1.013H4Zm0 4.05c-.552 0-1 .454-1 1.014 0 .559.448 1.012 1 1.012h4c.552 0 1-.453 1-1.012 0-.56-.448-1.013-1-1.013H4Z" clip-rule="evenodd"/>
                            </svg>
                            Catalog
                        </a>
                    <?php endif ?>
                </div>
                <div class="user-navigation">
                    <?php if (\app\models\Users::isUserLoggedIn()) : ?>
                        <a href="/KursovaBE/pages/profile">
                            <svg style="display: flex; justify-content: center; align-items: center" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                            </svg>
                            Profile
                        </a>
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
                <div class="player-buttons">
                    <button class="prev-btn">
                        <svg style="display: flex; justify-content: center; align-items: center"
                             xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" viewBox="0 0 24 24">
                            <path d="M13.729 5.575c1.304-1.074 3.27-.146 3.27 1.544v9.762c0 1.69-1.966 2.618-3.27 1.544l-5.927-4.881a2 2 0 0 1 0-3.088l5.927-4.88Z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <button class="play-btn">
                        <svg style="display: flex; justify-content: center; align-items: center; position: relative; left: 2px"
                             xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" viewBox="0 0 24 24">
                            <path d="M8.6 5.2A1 1 0 0 0 7 6v12a1 1 0 0 0 1.6.8l8-6a1 1 0 0 0 0-1.6l-8-6Z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <button class="next-btn">
                        <svg style="display: flex; justify-content: center; align-items: center"
                             xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" viewBox="0 0 24 24">
                            <path d="M10.271 5.575C8.967 4.501 7 5.43 7 7.12v9.762c0 1.69 1.967 2.618 3.271 1.544l5.927-4.881a2 2 0 0 0 0-3.088l-5.927-4.88Z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
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