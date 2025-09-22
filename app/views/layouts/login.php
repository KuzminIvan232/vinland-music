<?php
/** @var string $GTitle */
/** @var string $Title */
/** @var string $Content */

use app\models\Users;

if (empty($GTitle)) {
    $GTitle = '';
}
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
    <title><?= $GTitle ?></title>
    <link rel="stylesheet" href="/KursovaBE/css/layouts/login.css">
</head>
<body>
<div class="body-container">
    <div class="top-bar-container">
        <div class="top-bar">
            <h1 class="title"><?= $Title ?></h1>
            <div class="navigation">
                <?php if(\app\models\Users::isLoginPage()): ?>
                    <a href="/KursovaBE/users/register">Register</a>
                <?php elseif(\app\models\Users::isRegisterPage()):  ?>
                    <a href="/KursovaBE/users/login">Login</a>
                <?php endif;  ?>
                    <a href="/KursovaBE">Home</a>
            </div>
        </div>
    </div>
    <div class="main-container">
        <?= $Content ?>
    </div>
    <footer></footer>
</div>
</body>
</html>