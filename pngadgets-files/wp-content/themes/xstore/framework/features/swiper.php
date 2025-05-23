<?php
/**
 * Enqueue elementor or theme swiper.js library
 * see
 * optimization.php
 * theme-init.php
 * speed-optimization.php
 *
 * @package    optimization.php
 * @since      8.0.12
 * @version    1.0.0
 * @author     8theme
 * @link       http://xstore.8theme.com
 * @license    Themeforest Split Licence
 */
use Elementor\Plugin;
defined( 'ETHEME_FW' ) || exit( 'No direct script access allowed' );

// swiper slider files
// from v3.23 Elementor removed such option
//$is_disable_theme_swiper = etheme_get_option( 'disable_theme_swiper_js', false );
//if (
//	Plugin::$instance->experiments->is_feature_active( 'e_optimized_assets_loading' )
//	|| version_compare( ELEMENTOR_VERSION, '3.23', '>=' )
//){
//	if (!$is_disable_theme_swiper){
//		wp_enqueue_script( 'et_swiper-slider' );
//	}
//} else {
//	if (!$is_disable_theme_swiper){
//		add_action( 'wp_footer', function(){
//			// The key of elementor slider lib
//			wp_enqueue_script( 'swiper' );
//		} );
//	}
//	wp_enqueue_script( 'et_swiper-slider-init' );
//}


// swiper slider files
// from v3.23 Elementor removed such option
if (Plugin::$instance->experiments->is_feature_active( 'e_optimized_assets_loading' ) || version_compare( ELEMENTOR_VERSION, '3.23', '>=' )){
	wp_enqueue_script( 'et_swiper-slider' );
} else {
	add_action( 'wp_footer', function(){
		// The key of elementor slider lib
		wp_enqueue_script( 'swiper' );
		wp_enqueue_script( 'et_swiper-slider-init' );
	} );
}

