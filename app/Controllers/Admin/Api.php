<?php
/**
 * Main API Class File
 *
 * @package TinySolutions\WM
 */

namespace TinySolutions\cptint\Controllers\Admin;

use TinySolutions\cptint\Helpers\Fns;
use TinySolutions\cptint\Traits\SingletonTrait;
use WP_Error;

/**
 * API class
 */
class Api {

	/**
	 * Singleton
	 */
	use SingletonTrait;

	/**
	 * Namespace for the REST API
	 *
	 * @var string
	 */
	private $namespace;

	/**
	 * Resource name for the REST API
	 *
	 * @var string
	 */
	private $resource_name;

	/**
	 * Construct
	 */
	private function __construct() {
		$this->namespace     = 'TinySolutions/cptint/v1';
		$this->resource_name = '/cptint';
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * Register our routes.
	 *
	 * @return void
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			$this->resource_name . '/getoptions',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_options' ),
				'permission_callback' => array( $this, 'login_permission_callback' ),
			)
		);
		register_rest_route(
			$this->namespace,
			$this->resource_name . '/updateoptins',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'update_option' ),
				'permission_callback' => array( $this, 'login_permission_callback' ),
			)
		);
	}

	/**
	 * Handle permission
	 *
	 * @return true
	 */
	public function login_permission_callback() {
		return current_user_can( 'manage_options' );
	}

	/**
	 * Update options
	 *
	 * @param object $request_data obtain all object.
	 *
	 * @return false|string
	 */
	public function update_option( $request_data ) {

		$result = array(
			'updated' => false,
			'message' => esc_html__( 'Update failed. Maybe change not found. ', 'cptint-media-tools' ),
		);

		$parameters   = $request_data->get_params();
		$cptint_media = get_option( 'cptint_settings', array() );
		$options      = update_option( 'cptint_settings', $cptint_media );
		return $result;
	}

	/**
	 * Retrieve Options
	 *
	 * @return false|string
	 */
	public function get_options() {
		return wp_json_encode( Fns::get_options() );
	}

}




