<?php
/**
 * Admin waitlist request email
 *
 * @package XStoreCore\Modules\WooCommerce
 * @version 1.0.0
 * @since 5.1.9
 */

defined( 'ABSPATH' ) || exit;

echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n";
echo esc_html( wp_strip_all_tags( $email_heading ) );
echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo $introduction;

echo "\n\n----------------------------------------\n\n";

echo sprintf(__('Customer email: %s', 'xstore-core'), $customer_email_address);
echo "\n";
echo sprintf(__('Product name: %s', 'xstore-core'), wp_kses( $product_info['name'], wp_kses_allowed_html() ));
echo "\n";
if ( $product_info['sku'] ) :
    echo sprintf(__('SKU: %s', 'xstore-core'), $product_info['sku']);
endif;
echo "\n";
echo sprintf(__('Product link: %s', 'xstore-core'), $product_info['permalink']);


echo "\n\n----------------------------------------\n\n";

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
    echo esc_html( wp_strip_all_tags( wptexturize( $additional_content ) ) );
    echo "\n\n----------------------------------------\n\n";
}

echo wp_kses_post( apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) ) );
