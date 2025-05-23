<?php
/**
 * View class to load authorize template
 *
 * @since      3.0.3
 * @version    1.0.0
 * @package    ETC
 * @subpackage ETC/views
 */
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

// In case AMP enabled
$is_amp = ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() );

//$page = ( is_checkout() ) ? 'checkout' : 'myaccount';

$page = apply_filters('etheme_social_login_page', 'myaccount');

update_option( 'etheme_fb_login', $page );

$facebook_login_url = add_query_arg( 'etheme_authorize', 'facebook', wc_get_page_permalink( $page ) );
$google_login_url   = add_query_arg( 'etheme_authorize', 'google', wc_get_page_permalink( $page ) );
if ( isset( $args['google'] ) || isset( $args['facebook'] ) ) {
	if ( function_exists( 'etheme_enqueue_style' ) ) {
		etheme_enqueue_style( 'socials-login' );
	}
}
?>
<div class="text-center et-or-wrapper">
    <div>
        <span><?php echo esc_html__( 'or sign in with a social network', 'xstore-core' ); ?></span>
    </div>
</div>
<?php if ( isset( $args['google'] ) ): $google_rand_filter_id = rand(0,999); // for validators ?>
    <div class="et-google-login-wrapper text-center">
        <a href="<?php echo esc_url( $google_login_url ); ?>"
           class="et-google-login-button full-width text-center inline-block text-uppercase <?php echo $is_amp ? 'button' : ''; ?>">
            <i class="et-icon et-google" style="margin-inline-end: .3em;">
                <svg width="2em" height="2em" viewBox="0 0 46 46" version="1.1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" style="vertical-align: middle">
                    <defs>
                        <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox"
                                id="filter-<?php echo esc_html($google_rand_filter_id); ?>">
                            <feOffset dx="0" dy="1" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                            <feGaussianBlur stdDeviation="0.5" in="shadowOffsetOuter1"
                                            result="shadowBlurOuter1"></feGaussianBlur>
                            <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.168 0"
                                           in="shadowBlurOuter1" type="matrix"
                                           result="shadowMatrixOuter1"></feColorMatrix>
                            <feOffset dx="0" dy="0" in="SourceAlpha" result="shadowOffsetOuter2"></feOffset>
                            <feGaussianBlur stdDeviation="0.5" in="shadowOffsetOuter2"
                                            result="shadowBlurOuter2"></feGaussianBlur>
                            <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.084 0"
                                           in="shadowBlurOuter2" type="matrix"
                                           result="shadowMatrixOuter2"></feColorMatrix>
                            <feMerge>
                                <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                                <feMergeNode in="shadowMatrixOuter2"></feMergeNode>
                                <feMergeNode in="SourceGraphic"></feMergeNode>
                            </feMerge>
                        </filter>
                        <rect id="path-2<?php echo esc_html($google_rand_filter_id); ?>" x="0" y="0" width="40" height="40" rx="2"></rect>
                        <rect id="path-3<?php echo esc_html($google_rand_filter_id); ?>" x="5" y="5" width="38" height="38" rx="1"></rect>
                    </defs>
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <g sketch:type="MSArtboardGroup" transform="translate(-1.000000, -1.000000)">
                            <g sketch:type="MSLayerGroup" transform="translate(4.000000, 4.000000)"
                               filter="url(#filter-<?php echo esc_html($google_rand_filter_id); ?>)">
                                <g>
                                    <use fill="#4285F4" fill-rule="evenodd" sketch:type="MSShapeGroup"
                                         xlink:href="#path-2<?php echo esc_html($google_rand_filter_id); ?>"></use>
                                    <use fill="none" xlink:href="#path-2<?php echo esc_html($google_rand_filter_id); ?>"></use>
                                    <use fill="none" xlink:href="#path-2<?php echo esc_html($google_rand_filter_id); ?>"></use>
                                    <use fill="none" xlink:href="#path-2<?php echo esc_html($google_rand_filter_id); ?>"></use>
                                </g>
                            </g>
                            <g>
                                <use fill="#FFFFFF" fill-rule="evenodd" sketch:type="MSShapeGroup"
                                     xlink:href="#path-3<?php echo esc_html($google_rand_filter_id); ?>"></use>
                                <use fill="none" xlink:href="#path-3<?php echo esc_html($google_rand_filter_id); ?>"></use>
                                <use fill="none" xlink:href="#path-3<?php echo esc_html($google_rand_filter_id); ?>"></use>
                                <use fill="none" xlink:href="#path-3<?php echo esc_html($google_rand_filter_id); ?>"></use>
                            </g>
                            <g sketch:type="MSLayerGroup" transform="translate(15.000000, 15.000000)">
                                <path d="M17.64,9.20454545 C17.64,8.56636364 17.5827273,7.95272727 17.4763636,7.36363636 L9,7.36363636 L9,10.845 L13.8436364,10.845 C13.635,11.97 13.0009091,12.9231818 12.0477273,13.5613636 L12.0477273,15.8195455 L14.9563636,15.8195455 C16.6581818,14.2527273 17.64,11.9454545 17.64,9.20454545 L17.64,9.20454545 Z"
                                      fill="#4285F4" sketch:type="MSShapeGroup"></path>
                                <path d="M9,18 C11.43,18 13.4672727,17.1940909 14.9563636,15.8195455 L12.0477273,13.5613636 C11.2418182,14.1013636 10.2109091,14.4204545 9,14.4204545 C6.65590909,14.4204545 4.67181818,12.8372727 3.96409091,10.71 L0.957272727,10.71 L0.957272727,13.0418182 C2.43818182,15.9831818 5.48181818,18 9,18 L9,18 Z"
                                      fill="#34A853" sketch:type="MSShapeGroup"></path>
                                <path d="M3.96409091,10.71 C3.78409091,10.17 3.68181818,9.59318182 3.68181818,9 C3.68181818,8.40681818 3.78409091,7.83 3.96409091,7.29 L3.96409091,4.95818182 L0.957272727,4.95818182 C0.347727273,6.17318182 0,7.54772727 0,9 C0,10.4522727 0.347727273,11.8268182 0.957272727,13.0418182 L3.96409091,10.71 L3.96409091,10.71 Z"
                                      id="Shape" fill="#FBBC05" sketch:type="MSShapeGroup"></path>
                                <path d="M9,3.57954545 C10.3213636,3.57954545 11.5077273,4.03363636 12.4404545,4.92545455 L15.0218182,2.34409091 C13.4631818,0.891818182 11.4259091,0 9,0 C5.48181818,0 2.43818182,2.01681818 0.957272727,4.95818182 L3.96409091,7.29 C4.67181818,5.16272727 6.65590909,3.57954545 9,3.57954545 L9,3.57954545 Z"
                                      fill="#EA4335" sketch:type="MSShapeGroup"></path>
                                <path d="M0,0 L18,0 L18,18 L0,18 L0,0 Z" sketch:type="MSShapeGroup"></path>
                            </g>
                            <g sketch:type="MSLayerGroup" id="handles_square"></g>
                        </g>
                    </g>
                </svg>
            </i>
			<?php esc_html_e( 'Google', 'xstore-core' ) ?>
        </a>
    </div>
<?php endif; ?>
<?php if ( isset( $args['facebook'] ) ): ?>
    <div class="et-facebook-login-wrapper text-center">
        <a href="<?php echo esc_url( $facebook_login_url ); ?>"
           class="et-facebook-login-button full-width text-center inline-block text-uppercase <?php echo $is_amp ? 'button' : ''; ?>">
            <i class="et-icon et-facebook" style="margin-inline-end: .3em;"></i>
			<?php esc_html_e( 'Facebook', 'xstore-core' ) ?>
        </a>
    </div>
<?php endif; ?>
