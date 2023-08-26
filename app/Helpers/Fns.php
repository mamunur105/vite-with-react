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
	 * Check if a plugin is installed.
	 *
	 * @param string $plugin_file_path Plugin path.
	 *
	 * @return bool
	 */
	public static function is_plugins_installed( $plugin_file_path = null ) {
		$installed_plugins_list = get_plugins();

		return isset( $installed_plugins_list[ $plugin_file_path ] );
	}



	/**
	 * Retrieve the options from database
	 *
	 * @return false|string
	 */
	public static function get_options() {
		$defaults = array();
		$options  = get_option( 'cptint_settings' );
		return wp_parse_args( $options, $defaults );
	}


}
