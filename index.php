<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

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
        if (get_page_by_path('user-profile')){
            echo "<a href='/user-profile'><img src='$theme_uri/assets/user.svg'></a>";
        }
        ?>
        </div>
    </header>

    <main>
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
        ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div><?php the_content(); ?></div>
        <?php
            }
        } else {
            echo '<p>No posts found.</p>';
        }
        ?>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </footer>

    <?php wp_footer(); ?>
</body>

</html>