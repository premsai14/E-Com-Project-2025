<?php
/**
 * The main Kirki object
 *
 * @package     Kirki
 * @category    Core
 * @author      Ari Stathopoulos (@aristath)
 * @copyright   Copyright (c) 2020, David Vongries
 * @license     https://opensource.org/licenses/MIT
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Singleton class
 */
final class Kirki_Toolkit {
	/**
	 * Just define modules to avoid php 8.2.+ notices.
	 *
	 * @static
	 * @access protected
	 * @var null
	 */
	public $modules = null;

	/**
	 * Holds the one, true instance of this object.
	 *
	 * @static
	 * @access protected
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Access the single instance of this class.
	 *
	 * @static
	 * @access public
	 * @return object Kirki_Toolkit.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}


}
