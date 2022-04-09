<?php
/**
 * Plugin Name: Mailster Postal Server
 * Plugin URI: https://gurmehub.com/
 * Description: Uses Postal server to deliver emails for the Mailster Newsletter Plugin for WordPress.
 * Version: 1.1
 * Author: Gurmesoft
 * Author URI: https://gurmehub.com/
 * Text Domain: mailster-postal
 * Requires at least: 5.7
 * Requires PHP: 7.4
 * Tested up to: 5.9
 */

defined( 'ABSPATH' ) || exit;

define( 'MPS_PLUGIN_BASEFILE', __FILE__ );
define( 'MPS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'MPS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

require_once MPS_PLUGIN_DIR_PATH . 'includes/class-mps-loader.php';
MPS_Loader::instance();
