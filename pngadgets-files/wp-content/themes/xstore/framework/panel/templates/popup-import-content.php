<?php
/**
 * Template "Demos" for 8theme dashboard.
 *
 * @since   
 * @version 1.0.8
 */

$disable_next = false;

$classes = array();
$classes['et_step-theme_activation'] = '';
$classes['et_step-reset']    = 'active';
$classes['et_step-child_theme'] = 'hidden';
$classes['et_step-remove_content'] = 'hidden';
$classes['et_navigate-next'] = '';
$classes['et_step-requirements'] = 'hidden';
$classes['et_step-engine'] = ( count($_POST['steps']) == 1 && in_array('engine', $_POST['steps']) ) ? '' : 'hidden';
$data_engine_default = ( isset( $_POST['engine'] ) && in_array( $_POST['engine'], array(
		'wpb',
		'elementor'
	) ) ) ? $_POST['engine'] : false;


if(isset($_POST['version'])){
	$versions  = etheme_get_demo_versions();
	$version   = $versions[ $_POST['version'] ];
	$to_import = $version['to_import'];
} else {
	$version = array('title' => 'Can not get version');
	$to_import = array();
}

$connection = etheme_api_connection_check();

$xstore_branding_settings = get_option( 'xstore_white_label_branding_settings', array() );
$global_admin_class = EthemeAdmin::get_instance();
$brand_title = 'XStore';
if ( count($xstore_branding_settings) && isset($xstore_branding_settings['control_panel'])) {
//    if ( $xstore_branding_settings['control_panel']['icon'] )
//        $brand_icon = $xstore_branding_settings['control_panel']['icon'];
    if ( $xstore_branding_settings['control_panel']['label'] )
        $brand_title = $xstore_branding_settings['control_panel']['label'];
}

?>
<div class="et_popup-import-content text-left">

	<?php //$connection = false; // step connect ?>
	<?php if ( in_array('connect', $_POST['steps']) && ! $connection ): ?>
        <?php $classes['et_step-reset'] = 'hidden'; ?>
        <div class="et_popup-step et_step-connect active">
            <br/><h3 class="et_step-title text-center"><?php echo esc_html__('Connection Error','xstore'); ?></h3>
            <p class="step-description text-left">
	            <?php echo esc_html__('We are sorry to inform you that the XStore theme is unable to connect to the XStore API. Please check your internet connection, server whitelists and SSL certificate.','xstore'); ?>
            </p>
            <span class="et-button full-width et_import-try-again">
                <?php echo esc_html__('Try Again','xstore'); ?>
                <?php $global_admin_class->get_loader(); ?>
            </span>
        </div>
	<?php endif; ?>

    <?php if(true) : ?>
        <?php // step required ?>
        <?php if ( in_array('required', $_POST['steps']) ): ?>
            <div class="et_popup-step et_step-required active">
                <div>
                    <svg width="63.9" height="63" viewBox="0 0 71 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M58.47 20.4401C59.3979 20.4401 60.15 19.6879 60.15 18.7601C60.15 17.8322 59.3979 17.0801 58.47 17.0801C57.5422 17.0801 56.79 17.8322 56.79 18.7601C56.79 19.6879 57.5422 20.4401 58.47 20.4401Z" fill="#222222"></path>
                        <path d="M59.6601 22.8199C59.5201 23.2399 59.5201 23.7299 59.7301 24.1499C61.3401 27.5799 62.1801 31.2199 62.1801 34.9999C62.1801 36.6799 62.0401 38.4299 61.6901 40.0399C61.6201 40.4599 61.6901 40.9499 61.9701 41.2999C62.2501 41.6499 62.6001 41.9299 63.0201 41.9999C63.1601 41.9999 63.2301 42.0699 63.3701 42.0699C64.1401 42.0699 64.8401 41.5099 65.0501 40.7399C65.4001 38.8499 65.6101 36.8899 65.6101 34.9999C65.6101 30.6599 64.7001 26.5299 62.8101 22.6799C62.3901 21.8399 61.4101 21.4899 60.5701 21.9099C60.1501 22.0499 59.8001 22.3999 59.6601 22.8199Z" fill="#222222"></path>
                        <path d="M29.21 55.6502H42.72C43.63 55.6502 44.4 54.8802 44.4 53.9702V48.5802C44.4 47.6702 43.63 46.9002 42.72 46.9002H41.74V29.6102C41.74 28.7002 40.97 27.9302 40.06 27.9302H29.21C28.3 27.9302 27.53 28.7002 27.53 29.6102V35.0002C27.53 35.9102 28.3 36.6802 29.21 36.6802H30.19V46.8302H29.21C28.3 46.8302 27.53 47.6002 27.53 48.5102V53.9002C27.53 54.8802 28.3 55.6502 29.21 55.6502ZM40.06 50.2602H41.04V52.2902H30.96V50.2602H31.94C32.85 50.2602 33.62 49.4902 33.62 48.5802V35.0002C33.62 34.0902 32.85 33.3202 31.94 33.3202H30.96V31.2902H38.38V48.5102C38.38 49.4902 39.15 50.2602 40.06 50.2602Z" fill="#222222"></path>
                        <path d="M36 25.8999C39.15 25.8999 41.74 23.3099 41.74 20.1599C41.74 17.0099 39.15 14.4199 36 14.4199C32.85 14.4199 30.26 17.0099 30.26 20.1599C30.26 23.3099 32.85 25.8999 36 25.8999ZM33.62 20.0899C33.62 18.7599 34.67 17.7099 36 17.7099C37.33 17.7099 38.38 18.7599 38.38 20.0899C38.38 21.4199 37.33 22.4699 36 22.4699C34.67 22.4699 33.62 21.4199 33.62 20.0899Z" fill="#222222"></path>
                        <path d="M36.0001 0C17.0301 0 1.00009 16.03 1.00009 35C1.00009 41.37 2.82009 48.23 5.90009 53.34L1.07009 67.76C0.860086 68.39 1.00009 69.02 1.49009 69.51C1.84009 69.86 2.26009 70 2.68009 70C2.89009 70 3.03009 70 3.24009 69.93L17.6601 65.1C22.8401 68.18 29.7001 70 36.0001 70C54.9701 70 71.0001 53.97 71.0001 35C71.0001 16.03 54.9701 0 36.0001 0ZM9.33009 53.69C9.47009 53.2 9.40009 52.71 9.12009 52.22C6.11009 47.46 4.36009 41.02 4.36009 35C4.43009 17.85 18.8501 3.43 36.0001 3.43C53.1501 3.43 67.5701 17.92 67.5701 35C67.5701 52.08 53.1501 66.57 36.0001 66.57C29.9101 66.57 23.4701 64.75 18.7801 61.81C18.5001 61.67 18.2201 61.53 17.8701 61.53C17.6601 61.53 17.5201 61.53 17.3101 61.6L5.41009 65.59L9.33009 53.69Z" fill="#222222"></path>
                    </svg>
                </div>
                <h3 class="et_demo-required-theme-plugin">
                    <?php echo sprintf(esc_html__('This demo requires next versions of XStore theme v.%s and XStore Core plugin v.%s', 'xstore'),
                '<span class="min-theme-version">{{{min_theme_version}}}</span>',
                        '<span class="min-plugin-version">{{{min_plugin_version}}}</span>');
                ?></h3>
                <h3 class="et_demo-required-theme"><?php echo sprintf(esc_html__('This demo requires next version of XStore theme v.%s', 'xstore'),
                '<span class="min-theme-version">{{{min_theme_version}}}</span>'); ?></h3>
                <h3 class="et_demo-required-plugin"><?php echo sprintf(esc_html__('This demo requires next version of XStore Core plugin v.%s', 'xstore'),
                '<span class="min-plugin-version">{{{min_plugin_version}}}</span>'); ?></h3>
                <a class="et-button et-button-green no-loader" href="<?php echo ( is_multisite() && ! is_network_admin() ) ? network_admin_url( 'update-core.php?force-check=1' ): admin_url( 'update-core.php?force-check=1' ); ?>" target="_blank"><?php echo esc_html__('Update now', 'xstore'); ?></a>
            </div>
        <?php endif; ?>

        <?php // step reset ?>
        <?php if ( false && !etheme_is_activated() ):
            $classes['et_step-reset'] = 'hidden';
            $_POST['steps'] = array(); // prevent next steps from showing
            $_POST['navigation'] = 'false'; ?>
            <div class="et_popup-step et_step-theme_activation <?php echo esc_attr($classes['et_step-theme_activation']); ?>">
                <br/><h3 class="et_step-title text-center"><?php echo esc_html__('Theme Registration', 'xstore'); ?></h3>
                <p class="">
                    <?php echo esc_html__('It is important to activate XStore using your purchase code to access premium plugins and lifetime auto updates.', 'xstore'); ?>
                </p>
                <a class="et-button et-button-green no-loader full-width" href="<?php echo admin_url('admin.php?page=et-panel-welcome'); ?>" target="_blank"><?php echo esc_html__('Register now', 'xstore'); ?></a>
            </div>
        <?php endif; ?>

        <?php if ( in_array('reset', $_POST['steps']) ): ?>
            <div class="et_popup-step et_step-reset <?php echo esc_attr($classes['et_step-reset']); ?>">
<!--                <br/><h3 class="et_step-title">--><?php //echo sprintf(esc_html__('Welcome to %s Demo Setup Wizard', 'xstore'), $brand_title); ?><!--</h3>-->
                <br/><h3 class="et_step-title text-center"><?php echo esc_html__('Welcome to Demo Setup Wizard', 'xstore'); ?></h3>
                <p>
                    <?php echo esc_html__('Dear Valued Customer, whether you\'re launching an online store, corporate site, blog, portfolio, or any other type of website, our prebuilt options provide a solid foundation.', 'xstore'); ?>
                </p>
                <p>
                    <?php echo esc_html__('Installing a prebuilt website is a breeze with XStore. Simply follow our step-by-step wizard, and in no time, you\'ll have a professionally designed website up and running.', 'xstore'); ?>
                </p>
            </div>
        <?php endif; ?>

        <?php // step requirements ?>
        <?php if (in_array('requirements', $_POST['steps']) ): ?>
            <?php
                $classes['et_step-reset'] = 'hidden';
                $system = class_exists('Etheme_System_Requirements') ? Etheme_System_Requirements::get_instance() : new Etheme_System_Requirements();
                $system->system_test(true);
                $result = $system->result();
            ?>
            <?php if ( ! $result ): ?>
                <div class="et_popup-step et_step-requirements <?php echo esc_attr($classes['et_step-requirements']); ?>">
                    <br/><h3 class="et_step-title text-center"><?php echo esc_html__('System Requirements','xstore'); ?></h3>
                    <?php $system->html(); ?>
                    <p class="et-message et-error"><?php esc_html_e( 'Your system does not meet the requirements.', 'xstore' ); ?><p>
                </div>
            <?php endif ?>
        <?php endif ?>

	    <?php // step remove_content ?>
	    <?php if (in_array('remove_content', $_POST['steps']) ): ?>
		    <?php
	            $et_imported_data = get_option('et_imported_data', array());
                $is_remove = false;
                $et_imported_data = get_option('et_imported_data', array());

                if (count($et_imported_data)){
                    foreach ($et_imported_data as $type){
                        if (count($type)){
                            $is_remove = true;
                        }
                    }
                }
		    ?>
		    <?php if ($is_remove): ?>
                <div class="et_popup-step et_step-remove_content text-left> <?php echo esc_attr($classes['et_step-remove_content']); ?>">
                    <br/>
                    <h3 class="et_step-title text-center"><?php esc_html_e('Content Reset Required', 'xstore'); ?></h3>
                    <p class="step-description et_notice text-left">
                        <?php esc_html_e('Before installing a prebuilt website, it\'s recommended to use the "Content Reset" feature. This ensures a seamless and trouble-free experience when setting up your new website.', 'xstore') ?>
                    </p>
                    <p>
                        <?php esc_html_e('It\'s crucial to exercise caution when using it, as it will erase data, customizations, images, and products. Be sure to back up any essential content before initiating a reset.', 'xstore'); ?>
                    </p>
                    <div class="text-center">
                        <p>
                            <span type="submit" class="et-button et-button-active full-width et-button-arrow et_open-remove-popup">
				                <?php esc_html_e('Go to Content Reset', 'xstore'); ?>
                            </span>
                        </p>
                        <span type="submit" id="et_skip-remove_content" class="et-button et-button-arrow">
                                <?php esc_html_e('Skip this step', 'xstore'); ?>
                            <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 32 32">
                              <g fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
                                <circle class="arrow-icon--circle" cx="16" cy="16" r="15.12"></circle>
                                <path class="arrow-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
                              </g>
                            </svg>
                        </span>
                    </div>
                </div>
		    <?php endif; ?>
	    <?php endif; ?>

        <?php // step child_theme ?>
        <?php if ( in_array('child_theme', $_POST['steps']) ): ?>
            <?php
                $theme = get_option('xstore_has_child') ? wp_get_theme(get_option('xstore_has_child') )->Name : 'Xstore child';
                $template = get_template();
            ?>
            <div class="et_popup-step et_step-child_theme text-left <?php echo esc_attr($classes['et_step-child_theme']); ?>">
                <br/>
                <h3 class="et_step-title text-center"><?php esc_html_e('Setup XStore Child Theme', 'xstore'); ?></h3>
                <p class="step-description">
                    <?php esc_html_e('Using a child theme is strongly advised. This ensures that the parent theme can be updated without affecting any custom source code modifications you\'ve made.', 'xstore') ?>
                </p>
                <form id="et_create-child_theme-form" action="" method="POST">
                    <div class="child-theme-input" style="margin-bottom: 20px;">
                         <label>
                            <?php esc_html_e('Child Theme Name', 'xstore'); ?>
                        </label>
                         <input type="text" name="theme_name" value="<?php echo esc_attr($theme); ?>">
                    </div>
                    <div class="child-theme-input" style="margin-bottom: 20px;">
                        <label>
                            <?php esc_html_e('Parent Theme Template', 'xstore'); ?>
                        </label>
                        <input type="text" name="theme_template" value="<?php echo esc_attr($template); ?>">
                    </div>

                    <div class="text-center">
                        <p>
                            <button type="submit" id="et_create-child_theme" class="et-button et-button-arrow">
                                <?php esc_html_e('Create & Use Child Theme', 'xstore'); ?>
                                <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 32 32">
                                  <g fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
                                    <circle class="arrow-icon--circle" cx="16" cy="16" r="15.12"></circle>
                                    <path class="arrow-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
                                  </g>
                                </svg>
                            </button>
                            <input type="hidden" name="nonce_etheme-create_child_theme" value="<?php echo wp_create_nonce( 'etheme-create_child_theme' ); ?>">
                        </p>
                        <span type="submit" id="et_skip-child_theme" class="et-button et-button-arrow">
                            <?php esc_html_e('Skip this step', 'xstore'); ?>
                            <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 32 32">
                              <g fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
                                <circle class="arrow-icon--circle" cx="16" cy="16" r="15.12"></circle>
                                <path class="arrow-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
                              </g>
                            </svg>
                        </span>
                    </div>
                </form>
                <p class="et-success et-message hidden">
                    <?php esc_html_e('Child Theme ', 'xstore'); ?>
                    <strong class="new-theme-title"></strong>
                    <?php esc_html_e('created and activated successfully! Folder is located in:', 'xstore'); ?>
                    <strong class="new-theme-path"></strong>
                </p>
                <p class="et-error et-message hidden">
                    <?php esc_html_e('Can not create or activate new child theme. Please contact our support.', 'xstore'); ?>
                </p>
            </div>
        <?php endif; ?>

        <?php // step engine ?>
        <?php if ( in_array('engine', $_POST['steps']) && $_POST['engine'] > 1 && $_POST['engine'] !='wpb' && $_POST['engine'] !='elementor' ): ?>
            <div class="et_popup-step et_step-engine <?php echo esc_attr($classes['et_step-engine']); ?>">
                <br/><h3 class="et_step-title text-center"><?php echo esc_html__('Preferred page builder', 'xstore'); ?></h3><br/>
                <div class="engine-selectors">
                    <input type="radio" id="elementor" name="engine" value="elementor">
                    <label class="engine-selector text-center active" for="elementor">
                        <svg height="50px" width="50px" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="_x31_09-elementor"><g><path d="M462.999,26.001H49c-12.731,0-22.998,10.268-22.998,23v413.998c0,12.732,10.267,23,22.998,23    h413.999c12.732,0,22.999-10.268,22.999-23V49.001C485.998,36.269,475.731,26.001,462.999,26.001" style="fill:#D63362;"/><rect height="204.329" style="fill:#FFFFFF;" width="40.865" x="153.836" y="153.836"/><rect height="40.866" style="fill:#FFFFFF;" width="122.7" x="235.566" y="317.299"/><rect height="40.865" style="fill:#FFFFFF;" width="122.7" x="235.566" y="235.566"/><rect height="40.865" style="fill:#FFFFFF;" width="122.7" x="235.566" y="153.733"/></g></g><g id="Layer_1"/></svg>
                        <span class="engine-title">Elementor</span>
                    </label>
                    <input type="radio" id="wpb" name="engine" value="wpb" >
                    <label class="engine-selector text-center" for="wpb">
                        <svg width="50px" height="50px" viewBox="0 0 66 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="#ffffff" fill-rule="evenodd">
                                    <path d="M51.3446356,9.04135214 C46.8606356,8.68235214 44.9736356,9.78835214 42.8356356,10.0803521 C45.0046356,11.2153521 47.9606356,12.1793521 51.5436356,11.9703521 C48.2436356,13.2663521 42.8866356,12.8233521 39.1886356,10.5643521 C38.2256356,9.97535214 37.2136356,9.04535214 36.4556356,8.30235214 C33.4586356,5.58335214 31.2466356,0.401352144 21.6826356,0.0183521443 C9.68663559,-0.456647856 0.464635589,8.34735214 0.0156355886,19.6453521 C-0.435364411,30.9433521 8.92563559,40.4883521 20.9226356,40.9633521 C21.0806356,40.9713521 21.2386356,40.9693521 21.3946356,40.9693521 C24.5316356,40.7853521 28.6646356,39.5333521 31.7776356,37.6143521 C30.1426356,39.9343521 24.0316356,42.3893521 20.8506356,43.1673521 C21.1696356,45.6943521 22.5216356,46.8693521 23.6306356,47.6643521 C26.0896356,49.4243521 29.0086356,46.9343521 35.7406356,47.0583521 C39.4866356,47.1273521 43.3506356,48.0593521 46.4746356,49.8083521 L49.7806356,38.2683521 C58.1826356,38.3983521 65.1806356,32.2053521 65.4966356,24.2503521 C65.8176356,16.1623521 59.9106356,9.72335214 51.3446356,9.04135214 L51.3446356,9.04135214 Z" id="Fill-41" fill="#0473aa"></path>
                                </g>
                            </svg>
                        <span class="engine-title">WPBakery</span>
                    </label>
                </div>
            </div>
        <?php endif; ?>

        <?php // step plugins ?>
        <?php if ( in_array('plugins', $_POST['steps']) ): ?>
            <?php
                $classes['et_step-reset'] = 'hidden';
                $classes['et_navigate-next'] = 'hidden';
                $classes['et_step-requirements'] = 'hidden';
                $plugins = new Plugins();// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                $plugins = $plugins->get_popup_plugin_list($_POST['version']);// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
             ?>
            <?php if ( count( $plugins ) ): ?>
                <div class="et_popup-step et_step-plugins hidden">
                <br/><h3 class="et_step-title text-center"><?php echo esc_html__('Required plugins', 'xstore'); ?></h3>
                <p><?php echo esc_html__('This demo requires some plugins to be installed.', 'xstore'); ?></p>
                <ul class="et_popup-import-plugins with-scroll">
                        <li class="flex justify-content-between align-items-center">
                            <span class="flex align-items-center"><input class="all-plugins" type="checkbox" checked>ALL PLUGINS</span>
                        </li>
                    <?php foreach ($plugins as $key => $value): ?>
                        <?php $li_class = ($value['slug'] == 'elementor' && $data_engine_default != 'elementor') ? 'et-mb-remove' : ''; ?>
                        <li class="et_popup-import-plugin flex justify-content-between align-items-center install-with-all selected-to-install move-right <?php echo esc_attr($li_class); ?>">
                            <?php
                            $notify_class = ' orange-color';
                            echo '<span class="flex align-items-center">';
                                echo '<input class="plugin-setup" type="checkbox" checked>';
                                if ( in_array($value['slug'], array('js_composer', 'et-core-plugin', 'elementor', 'woocommerce'))) {
                                    $disable_next = true;
                                    $notify_class = ' red-color';
                                }

                                if (strlen($value['name']) >= 27 ){
                                    echo substr( esc_html($value['name']), 0, - (strlen($value['name'])-25) ) . '...';
                                } else {
                                    echo esc_html($value['name']);
                                }
                                ?>

                                <span class="mtips mtips-top no-arrow">
                                    <span class="dashicons dashicons-warning <?php echo esc_attr($notify_class); ?>"></span>
                                    <span class="mt-mes"><?php echo esc_html__('Required', 'xstore'); ?></span>
                                </span>
                            </span>

                            <span
                                class="et_popup-import-plugin-btn et-animated-link"
                                data-slug="<?php echo esc_attr($value['slug']); ?>"
                                data-type="<?php echo esc_attr($value['btn_type']); ?>"
                                style="line-height: 1.4; cursor:default;">
                                <?php echo esc_html($value['btn_text']); ?>
                            </span>
                        </li>
                    <?php endforeach ?>
                </ul>
                <!-- <span class="et-button et-button-green install-selected-plugins hidden"></span> -->
                <span class="hidden et_plugin-nonce" data-plugin-nonce="<?php echo wp_create_nonce( 'envato_setup_nonce' ); ?>"></span>
                </div>
            <?php endif ?>
        <?php endif ?>

        <?php // step versions compare ?>
        <?php if (in_array('versions-compare', $_POST['steps']) ): ?>
            <?php
                if ( get_template_directory() !== get_stylesheet_directory() ) {
                    $theme = wp_get_theme( 'xstore' );
                } else {
                    $theme = wp_get_theme();
                }

                if (defined('ET_CORE_THEME_MIN_VERSION')){
                    $THEME_MIN_VERSION = ET_CORE_THEME_MIN_VERSION;
                } else {
                    $THEME_MIN_VERSION = 0;
                }
                $required = '';

                if (defined('ET_CORE_THEME_MIN_VERSION')){
                    if ( $theme->name == ('XStore') &&  version_compare( $theme->version, ET_CORE_THEME_MIN_VERSION, '<' ) ){
                        $required = 'required';
                    }
                }
            ?>
            <div class="et_popup-step et_step-versions-compare hidden <?php echo esc_attr($required); ?>">
                <br/><h3 class="et_step-title text-center"><?php echo esc_html__('Versions Compare','xstore'); ?></h3>

                <div class="et-message et-info et-theme-version-info" data-theme-min-version="<?php echo esc_attr($THEME_MIN_VERSION); ?>">
                    <?php echo esc_html($theme->name); ?> Core plugin requires the following theme: <a class="" href="https://xstore.8theme.com/update-history/" target="_blank"><strong>XStore v.{{{version}}}.</strong></a>
                    To continue - update your theme. Please watch the <a class="" href="https://www.youtube.com/watch?v=kPo0fiNY4to&list=PLMqMSqDgPNmCCyem_z9l2ZJ1owQUaFCE3&index=2" target="_blank">video</a>.
                </div>
            </div>
        <?php endif ?>

        <?php // step install ?>
        <?php if ( in_array('install', $_POST['steps']) ): ?>
            <div class="et_popup-step et_step-type text-left hidden">
                <br/><h3 class="et_step-title text-center"><?php echo esc_html__('Content Configuration', 'xstore'); ?></h3>
                <form class="et_install-demo-form with-scroll" action="">
                    <div class="et_recomended-setup">
                        <input type="checkbox" id="et_all" name="et_all" value="et_all" checked>
                        <label for="et_all"><?php echo esc_html__('FULL DEMO-SITE CONTENT', 'xstore'); ?></label>
                    </div>
	                <?php if (etheme_is_activated()) : ?>
                        <div class="et_hidden-setup hidden">
                            <input type="checkbox" id="patches" name="patches" value="patches" checked>
                            <label for="patches"><?php echo esc_html__('Base data', 'xstore'); ?></label>
                            <br>
                        </div>
	                <?php endif; ?>
                    <div class="et_manual-setup">
                        <?php if ( isset( $to_import['pages'] ) && ! empty( $to_import['pages'] ) ): ?>
                            <input type="checkbox" id="pages" name="pages" value="pages" checked>
                            <label for="pages"><?php echo esc_html__('Pages', 'xstore'); ?></label>
                            <br>
                            <div class="et_manual-setup-page">
                                <?php if ( isset( $to_import['widgets'] ) && ! empty( $to_import['widgets'] ) ): ?>
                                    <input type="checkbox" id="widgets" name="widgets" value="widgets" checked>
                                    <label for="widgets"><?php echo esc_html__('Widgets', 'xstore'); ?></label>
                                <br>
                                <?php endif; ?>
                                <?php if ( isset( $to_import['home_page'] ) && ! empty( $to_import['home_page'] ) ): ?>
                                    <input type="checkbox" id="home_page" name="home_page" value="home_page" checked>
                                    <label for="home_page"><?php echo esc_html__('Home Page', 'xstore'); ?></label>
                                <br>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( isset( $to_import['posts'] ) && ! empty( $to_import['posts'] ) ): ?>
                            <input type="checkbox" id="posts" name="posts" value="posts" checked>
                            <label for="posts"><?php echo esc_html__('Posts', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>
                        <?php if ( isset( $to_import['products'] ) && ! empty( $to_import['products'] ) ): ?>
                            <input type="checkbox" id="products" name="products" value="products" checked>
                            <label for="products"><?php echo esc_html__('Products', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>

                        <?php if ( isset( $to_import['static-blocks'] ) && ! empty( $to_import['static-blocks'] ) ): ?>
                            <input type="checkbox" id="static-blocks" name="static-blocks" value="static-blocks" checked>
                            <label for="static-blocks"><?php echo esc_html__('Static Blocks', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>

                        <?php if ( isset( $to_import['projects'] ) && ! empty( $to_import['projects'] ) ): ?>
                            <input type="checkbox" id="projects" name="projects" value="projects" checked>
                            <label for="projects"><?php echo esc_html__('Projects', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>
                        <?php if ( isset( $to_import['testimonials'] ) && ! empty( $to_import['testimonials'] ) ): ?>
                            <input type="checkbox" id="testimonials" name="testimonials" value="testimonials" checked>
                            <label for="testimonials"><?php echo esc_html__('Testimonials', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>
                        <?php if ( isset( $to_import['contact-forms'] ) && ! empty( $to_import['contact-forms'] ) ): ?>
                            <input type="checkbox" id="contact-forms" name="contact-forms" value="contact-forms" checked>
                            <label for="contact-forms"><?php echo esc_html__('Contact Forms', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>
                        <?php if ( isset( $to_import['mailchimp'] ) && ! empty( $to_import['mailchimp'] ) ): ?>
                            <input type="checkbox" id="mailchimp" name="mailchimp" value="mailchimp" checked>
                            <label for="mailchimp"><?php echo esc_html__('Mailchimp Sign-up Forms', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>

	                    <?php if ( isset( $to_import['mega-menus'] ) && ! empty( $to_import['mega-menus'] ) ): ?>
                            <input type="checkbox" id="mega-menus" name="elementor_headers" value="mega-menus" checked>
                            <label for="mega-menus"><?php echo esc_html__('Elementor Mega Menus', 'xstore'); ?></label>
                            <br class="elementor_sections-br">
	                    <?php endif; ?>

                        <?php if ( isset( $to_import['media'] ) && ! empty( $to_import['media'] ) ): ?>
                            <input type="checkbox" id="media" name="media" value="media" checked>
                            <label for="media"><?php echo esc_html__('Media', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>
                        <?php if ( isset( $to_import['grid-builder'] ) && ! empty( $to_import['grid-builder'] ) ): ?>
                            <input type="checkbox" id="grid-builder" name="grid-builder" value="grid-builder" checked>
                            <label for="grid-builder"><?php echo esc_html__('Grid builder', 'xstore'); ?></label>
                            <br class="grid-builder-br">
                        <?php endif; ?>
                        <?php if ( isset( $to_import['fonts'] ) && ! empty( $to_import['fonts'] ) ): ?>
                            <input type="checkbox" id="fonts" name="fonts" value="fonts" checked>
                            <label for="fonts"><?php echo esc_html__('Custom fonts', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>

                        <?php if ( isset( $to_import['options'] ) && ! empty( $to_import['options'] ) ): ?>
                            <input type="checkbox" id="options" name="options" value="options" checked>
                            <label for="options"><?php echo esc_html__('Theme Options', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>
                        <?php if ( isset( $to_import['products'] ) && ! empty( $to_import['products'] ) && isset( $to_import['variations'] ) && $to_import['variations']  ): ?>
                            <input style="display: none;" type="checkbox" id="variation_taxonomy" name="variation_taxonomy" value="variation_taxonomy" checked>
                            <label style="display: none;" for="variation_taxonomy"><?php echo esc_html__('Variations taxonomy', 'xstore'); ?></label>
                            <input style="display: none;" type="checkbox" id="variations_trems" name="variations_trems" value="variations_trems" checked>
                            <label style="display: none;" for="variations_trems"><?php echo esc_html__('Variations terms', 'xstore'); ?></label>
                            <input style="display: none;" type="checkbox" id="variation_products" name="variation_products" value="variation_products" checked>
                            <label style="display: none;" for="variation_products"><?php echo esc_html__('Products variations', 'xstore'); ?></label>
                        <?php endif; ?>
                        <?php if ( isset( $to_import['menu'] ) && ! empty( $to_import['menu'] ) ): ?>
                            <input type="checkbox" id="menu" name="menu" value="menu" checked>
                            <label for="menu"><?php echo esc_html__('Menu', 'xstore'); ?></label>
                        <?php endif; ?>

	                    <?php if ( isset( $to_import['etheme_slides'] ) && ! empty( $to_import['etheme_slides'] ) ): ?>
                            <br class="elementor_sections-br">
                            <input type="checkbox" id="etheme_slides" name="etheme_slides" value="etheme_slides" checked>
                            <label for="etheme_slides"><?php echo esc_html__('Etheme Slides', 'xstore'); ?></label>
	                    <?php endif; ?>

                        <?php if ( isset( $to_import['elementor_sections'] ) && ! empty( $to_import['elementor_sections'] ) ): ?>
                            <br class="elementor_sections-br">
                            <input type="checkbox" id="elementor_sections" name="elementor_sections" value="elementor_sections" checked>
                            <label for="elementor_sections"><?php echo esc_html__('Elementor sections', 'xstore'); ?></label>
                            <br class="elementor_sections-br">
                        <?php endif; ?>
	                    <?php if ( isset( $to_import['elementor_footers'] ) && ! empty( $to_import['elementor_footers'] ) ): ?>
                            <input type="checkbox" id="elementor_footers" name="elementor_footers" value="elementor_footers" checked>
                            <label for="elementor_footers"><?php echo esc_html__('Elementor footers', 'xstore'); ?></label>
                            <br class="elementor_sections-br">
	                    <?php endif; ?>
	                    <?php if ( isset( $to_import['elementor_headers'] ) && ! empty( $to_import['elementor_headers'] ) ): ?>
                            <input type="checkbox" id="elementor_headers" name="elementor_headers" value="elementor_headers" checked>
                            <label for="elementor_headers"><?php echo esc_html__('Elementor headers', 'xstore'); ?></label>
                            <br class="elementor_sections-br">
	                    <?php endif; ?>
	                    <?php if ( isset( $to_import['elementor_archives'] ) && ! empty( $to_import['elementor_archives'] ) ): ?>
                            <input type="checkbox" id="elementor_archives" name="elementor_archives" value="elementor_archives" checked>
                            <label for="elementor_archives"><?php echo esc_html__('Elementor product archives', 'xstore'); ?></label>
                            <br class="elementor_sections-br">
	                    <?php endif; ?>
	                    <?php if ( isset( $to_import['elementor_single_products'] ) && ! empty( $to_import['elementor_single_products'] ) ): ?>
                            <input type="checkbox" id="elementor_single_products" name="elementor_single_products" value="elementor_single_products" checked>
                            <label for="elementor_single_products"><?php echo esc_html__('Elementor single products', 'xstore'); ?></label>
                            <br class="elementor_sections-br">
	                    <?php endif; ?>
	                    <?php if ( isset( $to_import['elementor_post'] ) && ! empty( $to_import['elementor_post'] ) ): ?>
                            <input type="checkbox" id="elementor_post" name="elementor_post" value="elementor_post" checked>
                            <label for="elementor_post"><?php echo esc_html__('Elementor single post', 'xstore'); ?></label>
                            <br class="elementor_sections-br">
	                    <?php endif; ?>
	                    <?php if ( isset( $to_import['elementor_post_archive'] ) && ! empty( $to_import['elementor_post_archive'] ) ): ?>
                            <input type="checkbox" id="elementor_post_archive" name="elementor_post_archive" value="elementor_post_archive" checked>
                            <label for="elementor_post_archive"><?php echo esc_html__('Elementor post archive', 'xstore'); ?></label>
                            <br class="elementor_sections-br">
	                    <?php endif; ?>

	                    <?php if ( isset( $to_import['sales_boosters'] ) && ! empty( $to_import['sales_boosters'] ) ): ?>
                            <input type="checkbox" id="sales_boosters" name="sales_boosters" value="sales_boosters" checked>
                            <label for="sales_boosters"><?php echo esc_html__('Sales Boosters', 'xstore'); ?></label>
                            <br class="elementor_sections-br">
	                    <?php endif; ?>
                    </div>
                    <div class="et_hidden-setup hidden">
                        <?php if ( isset( $to_import['slider'] ) && ! empty( $to_import['slider'] ) ): ?>
                            <input type="checkbox" id="slider" name="slider" value="slider" checked>
                            <label for="slider"><?php echo esc_html__('Slider', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>
                        <?php if ( isset( $to_import['multiple_headers'] ) && ! empty( $to_import['multiple_headers'] ) ): ?>
                            <input type="checkbox" id="et_multiple_headers" name="et_multiple_headers" value="et_multiple_headers" checked>
                            <label for="et_multiple_headers"><?php echo esc_html__('Multiple headers', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>
                        <?php if ( isset( $to_import['multiple_conditions'] ) && ! empty( $to_import['multiple_conditions'] ) ): ?>
                            <input type="checkbox" id="et_multiple_conditions" name="et_multiple_conditions" value="et_multiple_conditions" checked>
                            <label for="et_multiple_conditions"><?php echo esc_html__('Headers conditions', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>
                        <?php if ( isset( $to_import['multiple_single_product'] ) && ! empty( $to_import['multiple_single_product'] ) ): ?>
                            <input type="checkbox" id="et_multiple_single_product" name="et_multiple_single_product" value="et_multiple_single_product" checked>
                            <label for="et_multiple_single_product"><?php echo esc_html__('Multiple single product', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>
                        <?php if ( isset( $to_import['multiple_single_product_conditions'] ) && ! empty( $to_import['multiple_single_product_conditions'] ) ): ?>
                            <input type="checkbox" id="et_multiple_single_product_conditions" name="et_multiple_single_product_conditions" value="et_multiple_single_product_conditions" checked>
                            <label for="et_multiple_single_product_conditions"><?php echo esc_html__('Single product conditions', 'xstore'); ?></label>
                            <br>
                        <?php endif; ?>
                        <input type="checkbox" id="default_woocommerce_pages" name="default_woocommerce_pages" value="default_woocommerce_pages" checked>
                        <label for="default_woocommerce_pages"><?php echo esc_html__('Default WooCommerce pages', 'xstore'); ?></label>
                        <br>
                        <input type="checkbox" id="version_info" name="version_info" value="version_info" checked>
                        <label for="version_info"><?php echo esc_html__('Version data', 'xstore'); ?></label>
                        <br>
                        <input type="checkbox" id="init_builders" name="init_builders" value="init_builders" checked>
                        <label for="init_builders"><?php echo esc_html__('Init builders', 'xstore'); ?></label>
                        <br>
                        <?php if ( isset( $to_import['elementor_globals'] ) && ! empty( $to_import['elementor_globals'] ) ): // not working by our code removes ?>
                            <input class="et-mb-remove" type="checkbox" id="elementor_globals" name="elementor_globals" value="elementor_globals" checked>
                            <label class="et-mb-remove" for="elementor_globals"><?php echo esc_html__('Elementor globals', 'xstore'); ?></label>
                            <br class="elementor_globals-br">
                        <?php endif; ?>
                        <input type="hidden" name="nonce_etheme_import-demo" value="<?php echo wp_create_nonce( 'etheme_import-demo' ); ?>">
                    </div>
                </form>
            </div>
        <?php endif ?>

        <?php // step processing ?>
        <?php if ( in_array('processing', $_POST['steps']) ): ?>
            <div class="et_popup-step et_step-processing hidden">
                <br/><h3 class="et_step-title text-center"><?php echo esc_html__('Importing: Please Wait', 'xstore'); ?></h3>
                <p><?php esc_html_e('The installation time may vary depending on your server connection speed, but it\'s typically just a few minutes. The most time-consuming part is the installation of media data.', 'xstore');?></p>
                <span class="et_progress-container">
                    <progress class="et_progress" max="100" value="0"></progress>
                     <span class="progress-label"></span>
                    <br/>
                </span>
                <br/>
                <div class="et_progress-notice text-center"></div>
            </div>
        <?php endif ?>

        <?php // step final ?>
        <?php if ( in_array('final', $_POST['steps']) ): ?>
            <div class="et_popup-step et_step-final hidden">
                <div class="et_all-success text-center hidden">
                    <br/><br/>
                    <img src="<?php echo ETHEME_BASE_URI . ETHEME_CODE .'assets/images/'; ?>success-icon.png" alt="installed icon" style="margin-bottom: -7px;"><br/><br/>
                    <h3 class="et_step-title text-center"><?php echo sprintf(esc_html__('%s Demo Successfully Installed!', 'xstore'), ucfirst( $version['title'] )); ?></h3><br/>
                </div>
                <div class="et_with-errors hidden">
                    <br/><br/>
                    <h3 class="et_step-title text-center"><?php echo sprintf(esc_html__('%s Demo Installed! However, We\'ve Encountered Some Errors:', 'xstore'), ucfirst( $version['title'] )); ?></h3><br/>
                    <ul class="et_errors-list with-scroll"></ul>
                    <p><?php esc_html_e('The most common errors occur due to low server requirements. We strongly recommend that you contact your hosting provider to verify and adjust the necessary server settings.', 'xstore'); ?></p>
                </div>

                <a class="et-button full-width no-loader et-preview-website et-button-arrow text-center" href="<?php echo esc_url( home_url() ); ?>" target="_blank">
                    <span class="text-holder"><?php esc_html_e( 'Preview Website', 'xstore' ); ?></span>
                    <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 32 32">
                        <g fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
                            <circle class="arrow-icon--circle" cx="16" cy="16" r="15.12"></circle>
                            <path class="arrow-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
                        </g>
                    </svg>
                </a><br/><br/>
            </div>
        <?php endif ?>

        <?php if(!isset($_POST['navigation']) || $_POST['navigation'] !== 'false' ) : ?>
            <div class="et_popup-import-navigation">
                <?php do_action('et_popup-import-navigation-start'); ?>
                <span class="et_navigate-next et-button et-button-arrow text-center <?php echo (!$connection) ? 'hidden': ''; ?>" <?php echo esc_attr($classes['et_navigate-next']); ?> data-text-install="<?php esc_attr_e('Install', 'xstore'); ?>" data-text-next="<?php esc_attr_e('Next step', 'xstore'); ?>">
                    <span class="text-holder"><?php echo esc_html__('Next step', 'xstore'); ?></span>
                    <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 32 32">
                      <g fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
                        <circle class="arrow-icon--circle" cx="16" cy="16" r="15.12"></circle>
                        <path class="arrow-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
                      </g>
                    </svg>
                    <span class="et-loader et-loader-percent">
                        <svg class="loader-circular" viewBox="25 25 50 50">
                            <circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
                        </svg>
                        <span class="loader-percent" data-percent="1">1%</span>
                    </span>
                </span>

                <span class="et_navigate-install et-button et-button-arrow text-center hidden" data-version="<?php echo esc_attr( $_POST['version'] ); ?>" data-engine-default="<?php echo esc_attr($data_engine_default); ?>">
                    <?php echo esc_html__('Install','xstore'); ?>
                    <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 32 32">
                        <g fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
                            <circle class="arrow-icon--circle" cx="16" cy="16" r="15.12"></circle>
                            <path class="arrow-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
                        </g>
                    </svg>
                </span>
                <?php do_action('et_popup-import-navigation-end'); ?>
            </div>
        <?php endif ?>

    <?php endif; ?>
</div>