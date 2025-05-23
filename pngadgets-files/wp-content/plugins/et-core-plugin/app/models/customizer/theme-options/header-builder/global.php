<?php
/**
 * The template created for enqueueing all files for header panel
 *
 * @version 1.0.0
 * @since   1.4.0
 */

$index = 0;

if ( !get_option( 'etheme_disable_customizer_header_builder', false ) ) {
    $elements = array_merge(array(
        'panel',
        'logo',
        'header_presets',
        'top_header',
        'main_header',
        'bottom_header',
        'headers_sticky',
        'header_overlap',
        'header_vertical',
        'menu',
        'secondary_menu',
        'menu_dropdown',
        'all_departments',
        'mobile_menu',
        (class_exists('WooCommerce')) ? 'cart' : 'cart_off',
        'wishlist'),
        (get_theme_mod('xstore_waitlist', false) ? array('waitlist') : array()),
        array(
        'compare',
        'account',
        'search',
        'header_socials',
        'contacts',
        'newsletter',
        'button',
        'promo_text',
        'html_blocks',
        'widgets',
        'builder_elements',
        'reset_settings'
    ));
}
else {
    $elements = array(
        'panel-section'
    );
}

foreach ( $elements as $key ) {
	require_once( ET_CORE_DIR . 'app/models/customizer/theme-options/header-builder/' . $key . '.php' );
}