<?php
/** @var string $error_message */
$this->Title = "Registration";
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
                    <td><input value="<?= $this->controller->post->login ?>" type="text" name="login" id="login" class="form"/></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password" id="password" class="form"/></td>
                </tr>
                <tr>
                    <td><label for="password2">Password again:</label></td>
                    <td><input type="password" name="password2" id="password2" class="form"/></td>
                </tr>
                <tr>
                    <td><button type="submit" class="form">Register</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>