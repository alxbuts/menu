<?

function plain_theme_enqueue_woocommerce_ajax()
{
    if (class_exists('WooCommerce')) {
        wp_enqueue_script('wc-cart-fragments');
    }

    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css');
}
add_action('wp_enqueue_scripts', 'plain_theme_enqueue_woocommerce_ajax');

function plain_theme_setup()
{
    add_theme_support('title-tag');

    add_theme_support('custom-logo', array(
        'flex-height' => true,
        'flex-width'  => true,
    ));

    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'plain_theme_setup');

add_filter('woocommerce_add_to_cart_fragments', 'cart_count_fragments', 10, 1);

function cart_count_fragments($fragments)
{
    $fragments['span.cart-pricing'] = '<span class="cart-pricing">' . WC()->cart->get_cart_total() . '</span>';
    return $fragments;
}

function plain_theme_register_nav()
{
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'plain-theme'),
    ));
}
add_action('after_setup_theme', 'plain_theme_register_nav');

function plain_theme_enqueue_media_uploader() {
    wp_enqueue_media();
    wp_enqueue_script('menu-image-uploader', get_template_directory_uri() . '/js/menu-image-uploader.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'plain_theme_enqueue_media_uploader');

// Add custom fields to menu items
function plain_theme_add_image_field_to_menu_item($item_id, $item, $depth, $args) {
    $image_url = get_post_meta($item_id, '_menu_item_image', true);
    ?>
    <p class="description description-wide">
        <label for="edit-menu-item-image-<?php echo $item_id; ?>">
            <?php _e('Menu Item Image'); ?><br>
            <input type="hidden" id="edit-menu-item-image-<?php echo $item_id; ?>" class="widefat edit-menu-item-image" name="menu-item-image[<?php echo $item_id; ?>]" value="<?php echo esc_attr($image_url); ?>" />
            <img src="<?php echo esc_url($image_url); ?>" style="max-width: 100%; height: auto; display: <?php echo $image_url ? 'block' : 'none'; ?>" />
            <button type="button" class="button upload-image-button"><?php _e('Upload Image'); ?></button>
            <button type="button" class="button remove-image-button" style="display: <?php echo $image_url ? 'inline-block' : 'none'; ?>;"><?php _e('Remove Image'); ?></button>
        </label>
    </p>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'plain_theme_add_image_field_to_menu_item', 10, 4);

// Save custom fields when menu items are updated
function plain_theme_save_image_field_to_menu_item($menu_id, $menu_item_db_id, $args) {
    if (isset($_POST['menu-item-image'][$menu_item_db_id])) {
        $image_url = sanitize_text_field($_POST['menu-item-image'][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_image', $image_url);
    }
}
add_action('wp_update_nav_menu_item', 'plain_theme_save_image_field_to_menu_item', 10, 3);

// Display images in menu items

function plain_theme_display_image_in_menu_item($item_output, $item, $depth, $args) {
    $image_url = get_post_meta($item->ID, '_menu_item_image', true);
    if ($image_url) {
        $image_tag = '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($item->title) . '" class="menu-item-image" />';
        $item_output = $image_tag . $item_output;
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'plain_theme_display_image_in_menu_item', 10, 4);