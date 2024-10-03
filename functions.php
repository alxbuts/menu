<?

function plain_theme_setup() {
    add_theme_support('title-tag');

    add_theme_support('custom-logo', array(
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'plain_theme_setup');