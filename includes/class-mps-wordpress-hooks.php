<?php
/**
 * This page contains WordPress hooks class.
 */

/**
 * This class contains WordPress hooks
 */
class MPS_WordPress_Hooks {

	/**
	 * MPS_WordPress_Hooks __construct function
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * init hook callback function
	 *
	 * @return void
	 */
	public function init() {
		load_plugin_textdomain( 'mailster-postal' );
		if ( ! function_exists( 'mailster' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		} else {
			require_once MPS_PLUGIN_DIR_PATH . 'includes/class-mps-mailster-hooks.php';
			new MPS_Mailster_Hooks();
		}
	}

	/**
	 * admin_notice hook callback function
	 *
	 * @return void
	 */
	public function admin_notice() {
		?>
		<div id="message" class="error">
			<p>
				<strong>Postal integration for Mailster</strong> requires the <a href="https://mailster.co/?utm_campaign=wporg&utm_source=postal+integration+for+mailster&utm_medium=plugin">Mailster Newsletter Plugin</a>.
			</p>
		</div>
		<?php
	}

}
