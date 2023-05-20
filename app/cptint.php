<?php
/**
 * Main initialization class.
 *
 * @package TinySolutions\cptint
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
require_once __DIR__ . './../vendor/autoload.php';

use TinySolutions\cptint\Traits\SingletonTrait;
use TinySolutions\cptint\Controllers\Installation;
use TinySolutions\cptint\Controllers\Dependencies;
use TinySolutions\cptint\Controllers\AssetsController;
use TinySolutions\cptint\Controllers\Hooks\FilterHooks;
use TinySolutions\cptint\Controllers\Hooks\ActionHooks;
use TinySolutions\cptint\Controllers\Admin\AdminMenu;
use TinySolutions\cptint\Controllers\Admin\Api;
use TinySolutions\cptint\Controllers\Admin\RegisterPostAndTax;
use TinySolutions\cptint\Controllers\Admin\Review;

if ( ! class_exists( Cptint::class ) ) {
	/**
	 * Main initialization class.
	 */
	final class Cptint {

		/**
		 * Nonce id
		 *
		 * @var string
		 */
		public $nonceId = 'cptint_wpnonce';

		/**
		 * Post Type.
		 *
		 * @var string
		 */
//		public $current_theme;
        /**
         * Post Type.
         *
         * @var string
         */
        public $category = 'cptint_category';
		/**
		 * Singleton
		 */
		use SingletonTrait;

		/**
		 * Class Constructor
		 */
		private function __construct() {

			// $this->current_theme = wp_get_theme()->get( 'TextDomain' );

			add_action( 'init', [ $this, 'language' ] );
			add_action( 'plugins_loaded', [ $this, 'init' ], 100 );
			// Register Plugin Active Hook.
			register_activation_hook( CPTWI_FILE, [ Installation::class, 'activate' ] );
			// Register Plugin Deactivate Hook.
			register_deactivation_hook( CPTWI_FILE, [ Installation::class, 'deactivation' ] );

        }

		/**
		 * Assets url generate with given assets file
		 *
		 * @param string $file File.
		 *
		 * @return string
		 */
		public function get_assets_uri( $file ) {
			$file = ltrim( $file, '/' );
			return trailingslashit( CPTWI_URL . '/assets' ) . $file;
		}

		/**
		 * Get the template path.
		 *
		 * @return string
		 */
		public function get_template_path() {
			return apply_filters( 'cptint_template_path', 'templates/' );
		}

		/**
		 * Get the plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( CPTWI_FILE ) );
		}

		/**
		 * Load Text Domain
		 */
		public function language() {
			load_plugin_textdomain( 'cptint', false, CPTWI_ABSPATH . '/languages/' );
		}

		/**
		 * Init
		 *
		 * @return void
		 */
		public function init() {
			if ( ! Dependencies::instance()->check() ) {
				return;
			}

			do_action( 'cptint/before_loaded' );

            Review::instance();
			// Include File.
            AssetsController::instance();
            AdminMenu::instance();
            FilterHooks::init_hooks();
			ActionHooks::init_hooks();
            Api::instance();

			do_action( 'cptint/after_loaded' );
		}

		/**
		 * Checks if Pro version installed
		 *
		 * @return boolean
		 */
		public function has_pro() {
			return function_exists( 'cptintp' );
		}

		/**
		 * PRO Version URL.
		 *
		 * @return string
		 */
		public function pro_version_link() {
			return '#';
		}
	}

	/**
	 * @return Cptint
	 */
	function cptint() {
		return Cptint::instance();
	}

	cptint();
}
