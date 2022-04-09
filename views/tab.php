<?php
/**
 * This page contains Postal method tab view
 */

?>
<table class="form-table">
<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Postal domain server', 'mailster-postal' ); ?></th>
		<td>
			<input type="text" name="mailster_options[postal_domain]" value="<?php echo esc_attr( mailster_option( 'postal_domain' ) ); ?>" class="regular-text">
			<p class="description"><?php _e( 'https://postal.yourdomain.com', 'mailster-postal' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Postal api key', 'mailster-postal' ); ?></th>
		<td>
			<input type="text" name="mailster_options[postal_api_key]" value="<?php echo esc_attr( mailster_option( 'postal_api_key' ) ); ?>" class="regular-text">
			<p class="description"></p>
		</td>
	</tr>
</table>
