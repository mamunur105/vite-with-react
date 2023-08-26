<?php
/**
 * Dependencies File
 *
 * @package TinySolutions\WM
 */

namespace TinySolutions\cptint\Controllers;

use TinySolutions\cptint\Traits\SingletonTrait;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Dependencies
 */
class Dependencies {

	/**
	 * Singleton
	 */
	use SingletonTrait;

	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Resource name for the REST API
	 *
	 * @var array
	 */
	private $missing = array();

	/**
	 * All OK Flag
	 *
	 * @var bool
	 */
	private $all_ok = true;

	/**
	 * Check PHP Version
	 *
	 * @return bool
	 */
	public function check() {

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'minimum_php_version' ) );
			$this->all_ok = false;
		}

		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		if ( ! function_exists( 'wp_create_nonce' ) ) {
			include_once ABSPATH . 'wp-includes/pluggable.php';
		}

		return $this->all_ok;
	}

	/**
	 * Admin Notice For Required PHP Version
	 */
	public function minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'cptint' ),
			'<strong>' . esc_html__( 'Custom Post Type Woocommerce Integration', 'cptint' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'cptint' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}


}
