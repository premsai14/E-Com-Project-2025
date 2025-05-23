<?php
/**
 * Description
 *
 * @package    waitlist.php
 * @since      4.3.8
 * @author     Stas
 * @link       http://xstore.8theme.com
 * @license    Themeforest Split Licence
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly


$waitlist_fields = apply_filters('xstore_waitlist_page_content', array_merge(array(
    'checkbox',
), get_theme_mod('xstore_waitlist_page_content', array(
    'product',
    'price',
    'email',
    'action'
))));

$fields_strings = array(
    'checkbox' => esc_html__('Bulk select', 'xstore-core'),
    'product' => esc_html__('Product', 'xstore-core'),
    'price' => esc_html__('Price', 'xstore-core'),
    'email' => esc_html__('Email', 'xstore-core'),
    'action' => esc_html__('Action', 'xstore-core')
);

extract($waitlist_page_args);

$show_global_actions = in_array('action', $waitlist_fields);
$allow_add_products = false;

$element_options = array();
$element_options['form_attributes'] = array(
    'class="xstore-waitlist-form"',
    'action="'.esc_url($waitlist_url).'"',
);

if ( get_query_var('et_is_customize_preview', false) ) {
    $element_options['form_attributes'][] = 'data-title="' . esc_html__( 'Waitlist', 'xstore-core' ) . '"';
    $element_options['form_attributes'][] = 'data-element="xstore-waitlist"';
}

?>

    <form <?php echo implode(' ', $element_options['form_attributes']); ?>>
        <table class="xstore-waitlist-table">
            <thead>
            <tr>
                <?php
                foreach ($waitlist_fields as $waitlist_field_key) {
                    if (!$show_global_actions && $waitlist_field_key == 'checkbox') continue; ?>
                    <th class="xstore-waitlist-<?php echo esc_attr($waitlist_field_key); ?>">
                        <?php if ($waitlist_field_key == 'checkbox') { ?>
                            <input type="checkbox" name="product-bulk-select" id="waitlist-products-select">
                        <?php } else {
                            echo esc_html($fields_strings[$waitlist_field_key]);
                        } ?>
                    </th>
                <?php }
                ?>
            </tr>
            </thead>
            <tbody class="xstore-waitlist-items">
            <?php
            // $has_sku = in_array('waitlist', (array)get_theme_mod('product_sku_locations', array('cart', 'popup_added_to_cart', 'mini-cart'))) && wc_product_sku_enabled();
            $has_sku = wc_product_sku_enabled();
            $products_count = 0;
            $sitepress_exists = class_exists('SitePress');
            $polylang_exists = function_exists( 'pll_current_language' );
            if ( class_exists('SitePress') ) {
                global $sitepress;
                $sitepress_lang = $sitepress->get_current_language();
            }
            if ( $polylang_exists ) {
                $polylang_lang = pll_current_language();
            }
            foreach ($products as $product_info) {

                $origin_product_id = $product_info['id'];

                if ( $sitepress_exists ) {
                    $product_info['id'] = apply_filters('wpml_object_id', $product_info['id'], get_post_type($product_info['id']), false, $sitepress_lang);
                    // if product does not have ready translations then use original id of product
                    if ( !$product_info['id'] )
                        $product_info['id'] = $origin_product_id;
                }
                elseif ( $polylang_exists ) {
                    $product_info['id'] = PLL()->model->post->get_translation( $product_info['id'], $polylang_lang );
                    // if product does not have ready translations then use original id of product
                    if ( !$product_info['id'] )
                        $product_info['id'] = $origin_product_id;
                }

                add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_true' );
                $post_object = get_post($product_info['id']);
                setup_postdata($GLOBALS['post'] =& $post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
                $product = wc_get_product($product_info['id']);
                if (!$product || $product->get_status() == 'trash') {
                    wp_reset_postdata();
                    continue;
                }

                $products_count++;

                $thumbnail = woocommerce_get_product_thumbnail();
//                    $product_quantity = 1; // @todo get quantity

                ?>
                <tr>
                    <?php
                    foreach ($waitlist_fields as $field) :
                        if ( !$show_global_actions && $field == 'checkbox' ) continue;
                        ?>
                        <td class="xstore-waitlist-<?php echo $field; ?>">
                            <?php switch ($field) {
                                case 'checkbox':
                                    ?>
                                    <input type="checkbox" name="product-<?php echo esc_attr($product_info['id']); ?>">
                                    <?php break;
                                case 'product':
                                    if (!$product->is_visible()) : ?>
                                        <a class="xstore-waitlist-image">
                                            <?php echo str_replace(array('http:', 'https:'), '', $thumbnail) . ''; ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php echo esc_url($product->get_permalink()); ?>"
                                           class="xstore-waitlist-image">
                                            <?php echo str_replace(array('http:', 'https:'), '', $thumbnail) . ''; ?>
                                        </a>
                                    <?php endif; ?>

                                    <div class="xstore-waitlist-details">

                                        <a href="<?php echo esc_url($product->get_permalink()); ?>"
                                           class="product-title">
                                            <?php
                                            echo $product->get_name();
                                            ?>
                                        </a>

                                        <?php if (in_array('price', $waitlist_fields)) : ?>
                                            <span class="mobile-price dt-hide">
                                                <?php
                                                echo WC()->cart->get_product_price($product);
                                                ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php
                                        $has_local_sku = $has_sku && $product->get_sku();
                                        $gtin = apply_filters('etheme_product_option_gtin', true) ? get_post_meta($product_info['id'], '_et_gtin', true) : false;

                                        if ($has_local_sku || $gtin) :
                                            // wp_enqueue_style('etheme-single-post-meta');
                                            ?>
                                            <div class="product_meta mob-hide">
                                                <?php
                                                // if ( in_array('waitlist', (array)get_theme_mod('product_sku_locations', array('cart', 'popup_added_to_cart', 'mini-cart'))) && wc_product_sku_enabled() && $product->get_sku() ) :
                                                if ($has_local_sku) :
                                                    ?>
                                                    <span class="sku_wrapper"><?php esc_html_e('SKU:', 'xstore-core'); ?>
                                                            <span class="sku"><?php echo esc_html(($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'xstore-core')); ?></span>
                                                        </span>
                                                <?php endif;

                                                if ($gtin) : ?>
                                                    <span class="gtin_wrapper"><?php esc_html_e('GTIN:', 'xstore-core'); ?> <span
                                                                class="gtin"><?php echo esc_html($gtin); ?></span></span>
                                                <?php endif; ?>

                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <?php break;
                                case 'price':
                                    woocommerce_template_loop_price();
                                    break;
                                case 'email':
                                    echo $product_info['email'];
                                    break;
                                case 'action': ?>
                                    <span class="actions-wrapper">
                                    <span class="actions-buttons">
                                        <?php
                                        if ( get_query_var('et_is-quick-view', false) ) : ?>
                                            <span class="show-quickly btn bordered mtips mtips-top"
                                                  data-prodid="<?php echo esc_attr($product_info['id']); ?>">
                                                <svg width="1em" height="1em" viewBox="0 0 16 10" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.776 2.79205C10.576 -0.391947 5.376 -0.391947 2.192 2.79205L0 4.96805L2.24 7.20805C3.792 8.76005 5.84 9.60805 8.048 9.60805C10.24 9.60805 12.304 8.76005 13.856 7.20805L16 5.03205L13.776 2.79205ZM2.768 6.66405L1.088 4.96805L2.752 3.30405C5.648 0.408053 10.352 0.408053 13.248 3.30405L14.928 5.00005L13.264 6.66405C10.368 9.54405 5.664 9.54405 2.768 6.66405ZM8 1.43205C6.032 1.43205 4.432 3.03205 4.432 5.00005C4.432 6.96805 6.032 8.56805 8 8.56805C9.968 8.56805 11.568 6.96805 11.568 5.00005C11.568 3.03205 9.968 1.43205 8 1.43205ZM8 7.78405C6.464 7.78405 5.216 6.53605 5.216 5.00005C5.216 3.46405 6.464 2.21605 8 2.21605C9.536 2.21605 10.784 3.46405 10.784 5.00005C10.784 6.53605 9.536 7.78405 8 7.78405Z"
                                                          fill="currentColor"/>
                                                </svg>
                                                <span class="mt-mes"><?php esc_html_e('Quick view', 'xstore-core'); ?></span>
                                            </span>
                                        <?php endif;
                                        add_filter('esc_html', array($instance, 'escape_text'), 10, 2);
                                        add_filter('woocommerce_product_add_to_cart_text', array($instance, 'add_to_cart_icon'), 10);
                                        woocommerce_template_loop_add_to_cart();
                                        remove_filter('woocommerce_product_add_to_cart_text', array($instance, 'add_to_cart_icon'), 10);
                                        remove_filter('esc_html', array($instance, 'escape_text'), 10, 2);
                                        if ( $product->is_purchasable() && $product->is_in_stock() )
                                            $allow_add_products = true;
                                        if ($own_waitlist) :
                                            $instance->print_button($origin_product_id, array(
                                                'has_tooltip' => true,
                                                'class' => array(
                                                    'button',
                                                    'btn',
                                                    'bordered',
                                                ),
                                                'custom_icon' => '<svg width="1em" height="1em" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.44584 4.10767C3.44022 4.10669 3.4368 4.10718 3.43339 4.10742C3.27592 4.10986 3.14945 4.23999 3.15189 4.39722V10.9043C3.15067 10.9805 3.17948 11.0527 3.23295 11.1074C3.28641 11.1621 3.35795 11.1934 3.43461 11.1943H3.43851C3.59428 11.1943 3.72269 11.0684 3.72465 10.9141C3.72489 10.9097 3.72489 10.9053 3.72465 10.9043V4.39771C3.72562 4.32129 3.69706 4.24902 3.64384 4.19385C3.59037 4.13916 3.51908 4.1084 3.44584 4.10767Z" fill="currentColor"/>
                        <path d="M9.4351 2.28906C9.42924 2.28857 9.42533 2.28857 9.42435 2.28906L8.95267 2.28931C8.91592 2.28931 8.8945 2.28906 8.86283 2.28906H6.84818V1.79468C6.84818 1.34961 6.48588 0.987549 6.04105 0.987549H3.95902C3.51395 0.987549 3.15189 1.34961 3.15189 1.79468V2.28906L1.14042 2.28931C1.10741 2.28931 1.08699 2.28906 1.05424 2.28906H0.571082C0.496375 2.28906 0.425819 2.31763 0.371863 2.36963C0.316932 2.42334 0.28617 2.49487 0.285194 2.57104C0.283973 2.64746 0.312781 2.71997 0.366248 2.7749C0.419715 2.82983 0.491248 2.86084 0.567908 2.86182H0.809608V12.2056C0.809608 12.6504 1.17167 13.0127 1.61649 13.0127H8.38334C8.82865 13.0127 9.19096 12.6504 9.19096 12.2056V2.86182H9.42777C9.50346 2.86182 9.57474 2.83301 9.62797 2.78076C9.68265 2.72754 9.7139 2.65601 9.71488 2.57935C9.71683 2.42139 9.59086 2.29102 9.4351 2.28906ZM3.72465 2.28906V1.79468C3.72465 1.66553 3.82987 1.5603 3.95902 1.5603H6.04105C6.16996 1.5603 6.27494 1.66553 6.27494 1.79468V2.28906H3.72465ZM8.61771 2.86182V12.2056C8.61771 12.3345 8.51273 12.4395 8.38334 12.4395H1.61649C1.48734 12.4395 1.38236 12.3345 1.38236 12.2056V2.86182H3.39042C3.42216 2.8667 3.45316 2.8667 3.47953 2.86182H6.51371C6.54594 2.8667 6.5767 2.8667 6.60306 2.86182H8.61771Z" fill="currentColor"/>
                        <path d="M5.00736 4.10767C5.00175 4.10669 4.99833 4.10718 4.99491 4.10742C4.83744 4.10986 4.71122 4.23999 4.71366 4.39722V10.9043C4.71268 10.9805 4.74125 11.0527 4.79447 11.1079C4.84745 11.1626 4.91898 11.1929 4.99613 11.1943H5.00004C5.1558 11.1943 5.28422 11.0674 5.28641 10.9116V4.39771C5.28739 4.32104 5.25883 4.24878 5.2056 4.19385C5.15214 4.13916 5.08085 4.1084 5.00736 4.10767Z" fill="currentColor"/>
                        <path d="M6.27494 4.39722V10.9043C6.27396 10.9805 6.30326 11.0527 6.35648 11.1074C6.40971 11.1626 6.48148 11.1934 6.55814 11.1943H6.56156C6.71732 11.1943 6.84574 11.0674 6.84818 10.9116V4.39771C6.84916 4.32056 6.82035 4.24829 6.76713 4.19385C6.7139 4.1394 6.64359 4.10889 6.5684 4.10742C6.56449 4.10645 6.55961 4.10645 6.55668 4.10742C6.39945 4.10986 6.27299 4.23999 6.27494 4.39722Z" fill="currentColor"/>
                    </svg>',
                                                'email' => $product_info['email'],
                                                'only_icon' => true,
                                                'add_action' => false,
                                                'remove_text' => esc_html__('Delete', 'xstore-core'),
                                                'add_text' => false
                                            )); ?>
                                        <?php else :
//                                            $instance->print_button($origin_product_id, array(
//                                                'has_tooltip' => true,
//                                                'only_icon' => true,
//                                                'class' => array(
//                                                    'button',
//                                                    'btn',
//                                                    'bordered',
//                                                )
//                                            ));
                                        endif; ?>
                                    </span>
                                    <?php if (isset($product_info['time'])) : ?>
                                        <span class="date-added mob-hide">
                                            <?php echo sprintf(__('Added on: %s', 'xstore-core'), str_replace(
                                                array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                                array(esc_html__('January', 'xstore-core'), esc_html__('February', 'xstore-core'), esc_html__('March', 'xstore-core'), esc_html__('April', 'xstore-core'), esc_html__('May', 'xstore-core'), esc_html__('June', 'xstore-core'), esc_html__('July', 'xstore-core'), esc_html__('August', 'xstore-core'), esc_html__('September', 'xstore-core'), esc_html__('October', 'xstore-core'), esc_html__('November', 'xstore-core'), esc_html__('December', 'xstore-core')),
                                                date(get_option('date_format'), $product_info['time']))); ?>
                                        </span>
                                    <?php endif; ?>
                                </span>
                                    <?php
                                    break;
                                default:
                                    # code...
                                    break;
                            } ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
                <?php
                remove_filter( 'woocommerce_product_variation_title_include_attributes', '__return_true' );
                wp_reset_postdata();
            }

            if ($products_count < 1) {
                $woo_new_7_0_1_version = function_exists('etheme_woo_version_check') && etheme_woo_version_check();
                $button_class = '';
                if ($woo_new_7_0_1_version) {
                    $button_class = wc_wp_theme_get_element_class_name('button');
                } ?>
                <tr>
                    <td colspan="<?php echo count($waitlist_fields); ?>">
                        <h4 style="text-align: center;"><?php echo esc_html__('It seems all products from your waitlist are missing on this web-site', 'xstore-core') ?></h4>
                        <p style="text-align: center;"><?php echo esc_html__('We invite you to get acquainted with an assortment of our shop. Surely you can find something for yourself!', 'xstore-core'); ?></p>
                        <?php if (wc_get_page_id('shop') > 0) : ?>
                            <p style="text-align: center;"><a
                                        class="btn black<?php echo esc_attr($button_class ? ' ' . $button_class : ''); ?>"
                                        href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"><span><?php esc_html_e('Return To Shop', 'xstore-core') ?></span></a>
                            </p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php }
            ?>
            </tbody>

        </table>

        <div class="form-actions">
            <div class="flex flex-wrap justify-content-between">
                <?php if ( $show_global_actions ) : ?>
                    <div class="xstore-waitlist-apply-actions flex align-items-center">
                        <select>
                            <?php
                            $global_active_action = array_key_first($global_actions);
                            foreach ($global_actions as $global_action => $global_action_text) {
                                if ( $global_action == 'add' && !$allow_add_products ) continue;
                                echo '<option' . ($global_active_action == $global_action ? ' selected' : '') . ' value="' . esc_attr($global_action) . '">' . $global_action_text . '</option>';
                            } ?>
                        </select>
                        <a class="btn black xstore-waitlist-actions"><?php echo esc_html__('Apply', 'xstore-core'); ?></a>
                    </div>
                <?php else: ?>
                    <div></div>
                <?php endif; ?>
            </div>
        </div>
    </form>

<?php if (count($share_socials)) :
    $element_options['share_attributes'] = array(
        'class="xstore-waitlist-share"'
    );
    if ( get_query_var('et_is_customize_preview', false) ) {
        $element_options['share_attributes'][] = 'data-title="' . esc_html__( 'Waitlist share', 'xstore-core' ) . '"';
        $element_options['share_attributes'][] = 'data-element="social-sharing"';
    }
    $custom_share_url = sprintf('<li><a href="%1s" class="title-tooltip mtips mtips-top copy-to-clipboard" title="%2s" target="_blank" rel="noopener">
			<i class="et-icon et-more"></i><span class="mt-mes">%3s</span></a></li>',
        $share_url, esc_html__('Copy URL', 'xstore-core'), esc_html__('Copy URL', 'xstore-core'));
    ?>
    <div <?php echo implode(' ', $element_options['share_attributes']) ?>>
        <?php echo str_replace('</ul>', $custom_share_url.'</ul>', ETC\App\Controllers\Shortcodes\Share::share_shortcode(
            array(
                'title' => esc_html__('Share on:', 'xstore-core'),
                'post_url' => $share_url,
                'text' => sprintf(esc_html__('See my waitlist on %s', 'xstore-core'), site_url()),
                'post_image' => false,
                'filled' => false,
                'copy_click' => false
            )
        )); ?>
    </div>
<?php
endif;

unset($element_options);
