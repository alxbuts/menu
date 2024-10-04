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

    <header class="bg-dark text-dark-darker">
        <div class="container mx-auto flex justify-between items-center py-5">
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
            <div class="flex justify-between items-center gap-4">
                <?php
                $theme_uri = get_stylesheet_directory_uri();
                if (get_page_by_path('user-profile')) {
                    echo "<a href='/user-profile'><img src='$theme_uri/assets/user.svg' alt='user'></a>";
                }
                ?>
                <?php if (function_exists('woocommerce_mini_cart')) : ?>
                    <div class="mini-cart-container">
                        <a href="<?php echo wc_get_cart_url(); ?>" class="cart-icon flex bg-pink p-3 px-6 border-pink border rounded">
                            <?php echo "<img src='$theme_uri/assets/cart.svg' alt='cart' class='object-contain mr-2'>"; ?>
                            <span class="cart-pricing"><?php echo WC()->cart->get_cart_total(); ?></span>
                        </a>
                        <div class="mini-cart-dropdown hidden">
                            <?php woocommerce_mini_cart(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="bg-dark border-t border-dark-lighter">
            <nav class="container mx-auto">
                <button class="products-menu flex items-center text-white py-4" aria-label="Open Products Menu">
                    <?php echo "<img src='$theme_uri/assets/menu.svg' alt='menu' class='object-contain mr-1'>"; ?>
                    <span>Products</span>
                </button>
                <div class="primary-menu-container bg-white absolute w-full left-0 z-10 min-h-312 shadow hidden">
                    <div class="container mx-auto">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_class'     => 'primary-menu py-4',
                            'container'      => false, // Set to 'nav' to wrap the menu in a <nav> tag.
                        ));
                        ?>
                    </div>
                </div>
            </nav>
        </div>
    </header>