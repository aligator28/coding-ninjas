<?php 
add_filter('add_to_cart_redirect', 'ninja_add_to_cart_redirect');

function ninja_add_to_cart_redirect() {
    global $woocommerce;
    $checkout_url = $woocommerce->cart->get_checkout_url();
    return $checkout_url;
}