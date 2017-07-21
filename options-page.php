<?php
// Options page stuff
function dta_menu_settings() {
	$dtaStatus  = get_option('bsm_dta_enabled') == 'enabled' ? 'checked' : '' ;
	$dtaLink    = get_option('bsm_dta_redirect_link');
	?>
	<div class="wrap">
	<h2>Deny Tor Auth Options</h2>

	<form method="post" action="/wp-admin/options.php">
		<?php settings_fields( 'bsm_dta_option' ); ?>
		<table class="form-table">
			<tr valign="top">
			<th scope="row">Enable Deny TOR Auth</span></th>
			<td><input type="checkbox" name="bsm_dta_enabled" value="enabled" <?php echo $dtaStatus; ?>/></td>
			</tr>
			<tr>
			<th scope="row">Redirect URL</span></th>
			<td><input type="text" name="bsm_dta_redirect_link" value="<?php echo $dtaLink; ?>" /></td>
			</tr>
			<p>Note: You have to use an absolute URL, not a relative! If you have entered an invalid URL, the plugin will automatically use the site URL (<?php echo htmlentities(get_site_url()); ?>) instead.</p>
		</table>
		
		<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>

	</form>
	</div>
<?php }

add_action('admin_menu', 'bsm_dta_create_menu');

// Add options page, register settings and add initial values
function bsm_dta_create_menu() {
        add_options_page( 'Deny Tor Auth Options Page', 'Deny Tor Auth', 'manage_options', 'bsm_dta_options', 'dta_menu_settings' );
		register_setting( 'bsm_dta_option', 'bsm_dta_enabled' );
		register_setting( 'bsm_dta_option', 'bsm_dta_redirect_link', 'bsm_dta_sanitize_url' );
		
		// Set default URL, if option got no value
		$link = get_option('bsm_dta_redirect_link');
		if(empty($link)) {
			update_option( 'bsm_dta_redirect_link', get_site_url() );
		}
}

// sanitize url
function bsm_dta_sanitize_url($url) {
	return esc_url( $url, array('http','https'));
}

?>