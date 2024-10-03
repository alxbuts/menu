<?

function plain_theme_enqueue_woocommerce_ajax() {
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_script( 'wc-cart-fragments' ); 
    }
}
add_action( 'wp_enqueue_scripts', 'plain_theme_enqueue_woocommerce_ajax' );

function plain_theme_setup() {
    add_theme_support('title-tag');

    add_theme_support('custom-logo', array(
        'flex-height' => true,
        'flex-width'  => true,
    ));

    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'plain_theme_setup');

add_filter( 'woocommerce_add_to_cart_fragments', 'cart_count_fragments', 10, 1 );

function cart_count_fragments( $fragments ) {
    $fragments['span.cart-pricing'] = '<span class="cart-pricing">'. WC()->cart->get_cart_total() .'</span>';
    return $fragments;
}