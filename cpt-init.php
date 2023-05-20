<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Cpt int
 * Plugin URI:        https://wordpress.org/support/plugin/media-library-tools
 * Description:       Cpt int
 * Version:           0.0.1
 * Author:            Tiny Solutions
 * Author URI:        https://wptinysolutions.com/
 * Text Domain:       cptint
 * Domain Path:       /languages
 *
 * @package TinySolutions\WM
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Define media edit Constant.
 */
define( 'CPTWI_VERSION', '0.0.1' );
define( 'CPTWI_FILE', __FILE__ );
define( 'CPTWI_BASENAME', plugin_basename( CPTWI_FILE ) );
define( 'CPTWI_URL', plugins_url('', CPTWI_FILE ));
define( 'CPTWI_ABSPATH', dirname(CPTWI_FILE ) );

/**
 * App Init.
 */
require_once 'app/cptint.php';