<?php
/**
 * This page contains loader class.
 */


 /**
  * This class contains main methods
  */
class MPS_Loader {

	public static function instance() {
		require_once MPS_PLUGIN_DIR_PATH . 'includes/class-mps-wordpress-hooks.php';

		return array(
			new MPS_Wordpress_Hooks(),
		);
	}

}
