<?php
/**
 * Plugin Name: Postal Server Integration For Mailster
 * Plugin URI: https://gurmehub.com/product/postal-server-integration-for-mailster/
 * Description: Uses Postal server to deliver emails for the Mailster Newsletter Plugin for WordPress.
 * Version: 1.5
 * Author: Gurmesoft
 * Author URI: https://gurmehub.com/
 * Text Domain: mailster-postal
 * Requires at least: 5.7
 * Requires PHP: 7.4
 * Tested up to: 5.9
 * License: GPLv2
 */

defined( 'ABSPATH' ) || exit;

define( 'MPS_PLUGIN_BASEFILE', __FILE__ );
define( 'MPS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'MPS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

require_once MPS_PLUGIN_DIR_PATH . 'includes/class-mps-loader.php';
MPS_Loader::instance();
