<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

    <header>
        <?php
        if (has_custom_logo()) {
            the_custom_logo();
        } else {
        ?>
            <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
            <p><?php bloginfo('description'); ?></p>
        <?php
        }
        ?>
        <?php get_search_form() ?>
        <div>
            <?php
            $theme_uri = get_stylesheet_directory_uri();
            if (get_page_by_path('user-profile')) {
                echo "<a href='/user-profile'><img src='$theme_uri/assets/user.svg'></a>";
            }
            ?>
            <?php if (function_exists('woocommerce_mini_cart')) : ?>
                <div class="mini-cart-container">
                    <a href="<?php echo wc_get_cart_url(); ?>" class="cart-icon">
                        <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    </a>
                    <div class="mini-cart-dropdown">
                        <?php woocommerce_mini_cart(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </header>