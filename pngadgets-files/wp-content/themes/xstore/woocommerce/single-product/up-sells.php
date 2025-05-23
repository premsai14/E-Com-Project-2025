<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version 9.6.0
 * @xstore-version 9.4.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

global $product, $woocommerce_loop;

$upsells         = $product->get_upsell_ids();
$upsell_location = etheme_get_option( 'upsell_location', 'sidebar' );

$posts_per_page = apply_filters( 'upsell_limit', $posts_per_page );
$upsell_type    = ( $upsell_location == 'sidebar' ) ? 'widget' : 'slider';
$upsell_type    = apply_filters( 'upsell_type', $upsell_type );

if ( sizeof( $upsells ) == 0 ) {
	return;
}

$heading = apply_filters( 'woocommerce_product_upsell_products_heading', esc_html__( 'You may also like...', 'xstore' ) );

if ( $heading && $upsell_type != 'widget' ) {
	echo '<h2 class="products-title upsell-products-title"><span>' . apply_filters( 'upsell_products_title', $heading ) . '</span></h2>';
}

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => array( 'product', 'product_variation' ),
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->get_id() ),
	'meta_query'          => $meta_query,
);

if ( $upsell_type == 'widget' ) {
	$slider_args = array(
		'before'          => '<h4 class="widget-title"><span>' . $heading . '</span></h4>',
		'slider_autoplay' => false,
		'slider_speed'    => '0',
		'autoheight'      => false,
		'large'           => 1,
		'notebook'        => 1,
		'tablet_land'     => 1,
		'tablet_portrait' => 1,
		'mobile'          => 1,
		'attr'            => 'data-slidesPerColumn="3"',
		'widget'          => true,
		'echo'            => false
	);
	
	$slider_args['wrapper_class'] = 'upsell-products';
	
	$product_view = etheme_get_option( 'product_view', 'disable' );
	if ( ! empty( $woocommerce_loop['product_view'] ) ) {
		$product_view = $woocommerce_loop['product_view'];
	}
	
	$custom_template = etheme_get_option( 'custom_product_template', 'default' );
	if ( ! empty( $woocommerce_loop['custom_template'] ) ) {
		$custom_template = $woocommerce_loop['custom_template'];
	}
	
	if ( $product_view == 'custom' && $custom_template != '' ) {
		$slider_args['class'] = ' products-with-custom-template products-template-' . $custom_template;
		$slider_args['attr']  = 'data-post-id="' . $custom_template . '"';
	}
	
	echo '<div class="sidebar-slider">' . etheme_slider( $args, 'product', apply_filters('upsell_slides_slider_args', $slider_args) ) . '</div>';
} elseif ( $upsell_type == 'slider' ) {
	$slider_args = array(
		'title'           => '',
		'slider_autoplay' => false,
		'slider_speed'    => '0',
		'autoheight'      => false,
		'echo'            => true,
	);
	
	$slider_args['wrapper_class'] = 'upsell-products';
	
	$cols_gap            = 10;
	$cols_gap            = apply_filters( 'upsell_cols_gap', $cols_gap );
	$slider_args['attr'] = 'data-space="' . $cols_gap . '"';
	
	$product_view = etheme_get_option( 'product_view', 'disable' );
	if ( ! empty( $woocommerce_loop['product_view'] ) ) {
		$product_view = $woocommerce_loop['product_view'];
	}
	
	$custom_template = etheme_get_option( 'custom_product_template', 'default' );
	if ( ! empty( $woocommerce_loop['custom_template'] ) ) {
		$custom_template = $woocommerce_loop['custom_template'];
	}
	
	if ( $product_view == 'custom' && $custom_template != '' ) {
		$slider_args['class'] = ' products-with-custom-template products-template-' . $custom_template;
		$slider_args['attr']  .= ' data-post-id="' . $custom_template . '"';
	}
	
	$upsell_slides = array();
	$upsell_slides = apply_filters( 'upsell_slides', $upsell_slides );
	
	if ( isset( $upsell_slides['large'] ) && ! empty( $upsell_slides['large'] ) ) {
		$slider_args['large'] = $upsell_slides['large'];
	}
	
	if ( isset( $upsell_slides['notebook'] ) && ! empty( $upsell_slides['notebook'] ) ) {
		$slider_args['notebook'] = $upsell_slides['notebook'];
	}
	
	if ( isset( $upsell_slides['tablet_land'] ) && ! empty( $upsell_slides['tablet_land'] ) ) {
		$slider_args['tablet_land'] = $upsell_slides['tablet_land'];
	}
	
	if ( isset( $upsell_slides['tablet_portrait'] ) && ! empty( $upsell_slides['tablet_portrait'] ) ) {
		$slider_args['tablet_portrait'] = $slider_args['mobile'] = $upsell_slides['tablet_portrait'];
	}
	
	etheme_slider( $args, 'product', apply_filters('upsell_slides_slider_args', $slider_args) );
} else {
	$columns                                = 4;
	$columns                                = apply_filters( 'upsell_columns', $columns );
	$woocommerce_loop['product_loop_class'] = 'upsell-products';
	etheme_products( $args, false, $columns );
}


wp_reset_postdata();
