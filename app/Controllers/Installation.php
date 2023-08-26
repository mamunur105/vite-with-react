<?php
/**
 * Installation File
 *
 * @package TinySolutions\WM
 */

namespace TinySolutions\cptint\Controllers;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
/**
 * Installer Class
 */
class Installation {

	/**
	 * Do stuff after activate the plugin
	 *
	 * @return void
	 */
	public static function activate() {
		if ( ! get_option( 'cptint_plugin_version' ) ) {
			$options             = get_option( 'cptint_settings', array() );
			$get_activation_time = strtotime( 'now' );

			update_option( 'cptint_settings', $options );
			update_option( 'cptint_plugin_version', CPTWI_VERSION );
			update_option( 'cptint_plugin_activation_time', $get_activation_time );
		}
	}

	/**
	 * @return void
	 */
	public static function deactivation() {
	}

}
