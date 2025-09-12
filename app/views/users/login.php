<?php
/** @var string $error_message */
$this->Title = "Login";
?>

<div class="form-container">
    <div class="form-div">
        <form method="post" action="">
            <table>
                <?php
                if (!empty($error_message)) : ?>
                <tr>
                    <p><?= $error_message ?></p>
                </tr>
                <?php endif; ?>
                <tr>
                    <td><label for="login">Login:</label></td>
                    <td><input type="text" name="login" id="login" class="form"/></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password" id="password" class="form"/></td>
                </tr>
                <tr>
                    <td><button type="submit" class="form">Login</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>