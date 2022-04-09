<?php
/**
 * This page contains WordPress hooks class.
 */

 /**
  * This class contains WordPress hooks
  */
class MPS_Wordpress_Hooks {

	public function __construct() {

		add_action( 'init', array( $this, 'init' ) );

	}

	public function init() {

		load_plugin_textdomain( 'mailster-postal' );

		if ( ! function_exists( 'mailster' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		} else {
			require_once MPS_PLUGIN_DIR_PATH . 'includes/class-mps-mailster-hooks.php';
			new MPS_Mailster_Hooks;
		}
	}

}
