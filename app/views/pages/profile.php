<?php
/** @var array $current_user */
/** @var string $error_message */
/** @var string $success_message */
$this->Title = "Profile";
$this->Style = "/KursovaBE/css/pages/profile.css";
?>

<div class="profile-page-container">
    <h1 class="profile-title">Your Profile</h1>

    <div class="profile-card">
        <div class="profile-info">
            <span class="profile-label">Current login:</span>
            <span class="profile-value"><?= htmlspecialchars($current_user['login']) ?></span>
        </div>

        <?php if (!empty($error_message)) : ?>
            <div class="profile-message profile-error"><?= $error_message ?></div>
        <?php endif; ?>

        <?php if (!empty($success_message)) : ?>
            <div class="profile-message profile-success"><?= htmlspecialchars($success_message) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="profile-section">
                <h2 class="profile-section-title">Change Login</h2>
                <div class="profile-field">
                    <label for="new_login">New login:</label>
                    <input type="text" id="new_login" name="new_login"
                           value="<?= htmlspecialchars($current_user['login']) ?>" required>
                </div>
            </div>

            <div class="profile-section">
                <h2 class="profile-section-title">Change Password</h2>
                <p class="profile-hint">Leave blank to keep your current password.</p>
                <div class="profile-field">
                    <label for="new_password">New password:</label>
                    <input type="password" id="new_password" name="new_password">
                </div>
                <div class="profile-field">
                    <label for="new_password2">Confirm new password:</label>
                    <input type="password" id="new_password2" name="new_password2">
                </div>
            </div>


            <button type="submit" class="profile-save-btn">Save changes</button>
        </form>
    </div>

    <a href="/KursovaBE/users/logout" class="profile-logout">Logout</a>
</div>