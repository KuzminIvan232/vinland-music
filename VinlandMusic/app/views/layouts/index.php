<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $Title ?></title>
    <link rel="stylesheet" href="/KursovaBE/VinlandMusic/css/layouts.css">
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