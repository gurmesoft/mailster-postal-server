<?php
/**
 * This page contains loader class.
 */


 /**
  * This class contains main methods
  */
class MPS_Loader {

	/**
	* Initialize the plugin tracker
	*
	* @return void
	*/
	public static function appsero_tracker() {

		if ( ! class_exists( 'Appsero\Client' ) ) {
			require_once MPS_PLUGIN_DIR_PATH . 'vendor/appsero/src/Client.php';
		}

		$client = new Appsero\Client( 'cd2af907-d5ca-4bb0-9fa0-26de218704a8', 'Postal Server Integration For Mailster', MPS_PLUGIN_BASEFILE );

		// Active insights
		$client->insights()->init();
	}

	/**
	* Initialize the plugin instance loader
	*
	* @return void
	*/
	public static function instance() {
		require_once MPS_PLUGIN_DIR_PATH . 'vendor/autoload.php';
		require_once MPS_PLUGIN_DIR_PATH . 'includes/class-mps-wordpress-hooks.php';

		self::appsero_tracker();

		return array(
			new MPS_Wordpress_Hooks(),
		);
	}

}
