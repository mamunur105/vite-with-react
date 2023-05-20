<?php
/**
 * Fns Helpers class
 *
 * @package  TinySolutions\cptint
 */

namespace TinySolutions\cptint\Helpers;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Fns class
 */
class Fns {

	/**
	 * @param $plugin_file_path
	 *
	 * @return bool
	 */
	public static function is_plugins_installed( $plugin_file_path = null ) {
		$installed_plugins_list = get_plugins();

		return isset( $installed_plugins_list[ $plugin_file_path ] );
	}


	/**
	 * @return false|string
	 */
	public static function get_options() {
		$defaults = array(

		);
		$options  = get_option( 'cptint_settings' );
		return wp_parse_args( $options, $defaults );
	}


}
