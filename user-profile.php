<?php
/* Template Name: User Profile */

if (!is_user_logged_in()) {
    wp_redirect( wp_login_url() ); // Redirect to login if not logged in
    exit;
}

get_header();

// Get the current user
$current_user = wp_get_current_user();
$errors = array();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Security check
    check_admin_referer('update-user-profile');

    // Sanitize and update email
    if (isset($_POST['email'])) {
        $email = sanitize_email($_POST['email']);
        if (!is_email($email)) {
            $errors[] = "Invalid email address.";
        } else {
            wp_update_user(array(
                'ID' => $current_user->ID,
                'user_email' => $email,
            ));
        }
    }

    // Sanitize and update password
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = sanitize_text_field($_POST['password']);
        wp_set_password($password, $current_user->ID);
        wp_set_auth_cookie($current_user->ID); // Keep the user logged in after password change
    }

    // Check if there are no errors
    if (empty($errors)) {
        echo '<div class="notice notice-success">Profile updated successfully.</div>';
    }
}
?>

<div class="profile-container">
    <h2>Profile Information</h2>

    <form method="post" action="">
        <?php wp_nonce_field('update-user-profile'); ?>

        <p>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo esc_attr($current_user->user_login); ?>" disabled />
            <span class="note">* Username cannot be changed.</span>
        </p>

        <p>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo esc_attr($current_user->user_email); ?>" required />
        </p>

        <p>
            <label for="password">New Password (optional)</label>
            <input type="password" id="password" name="password" />
        </p>

        <?php if (!empty($errors)) : ?>
            <div class="errors">
                <?php foreach ($errors as $error) {
                    echo '<p class="error">' . esc_html($error) . '</p>';
                } ?>
            </div>
        <?php endif; ?>

        <p>
            <input type="submit" value="Update Profile" />
        </p>
    </form>
</div>

<?php get_footer(); ?>
