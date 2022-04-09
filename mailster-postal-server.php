<?php
/**
 * Plugin Name: Mailster Postal Server
 * Plugin URI: https://gurmehub.com/
 * Description:
 * Version: 0.0.1
 * Author: Gurmesoft
 * Author URI: https://gurmehub.com/
 * Text Domain: mailster-postal
 * Domain Path: /languages/
 * Requires at least: 5.7
 * Requires PHP: 7.0
 */

defined( 'ABSPATH' ) || exit;

define( 'MPS_PLUGIN_BASEFILE', __FILE__ );
define( 'MPS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'MPS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'MPS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'MPS_PLUGIN_I18N_PATH', dirname( plugin_basename( __FILE__ ) ) . '/language' );

require_once MPS_PLUGIN_DIR_PATH . 'includes/class-mps-loader.php';

MPS_Loader::instance();
