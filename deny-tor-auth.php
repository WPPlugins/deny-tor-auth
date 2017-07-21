<?php
/*
Plugin Name: Deny TOR Auth
Text Domain: deny_tor_auth
Description: Redirects TOR users from login page to main site.
Version: 1.1.2
Author: Florian Gaffron
Author URI: http://blocksatz-medien.de
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

require_once 'options-page.php';


if (!function_exists('add_action')) {
	die;
}

add_action('login_head','DenyTORAuth_check');

register_uninstall_hook(__FILE__,"uninstall_bsm_dta");

function uninstall_bsm_dta() {
	delete_option('bsm_dta_enabled');
	delete_option('bsm_dta_redirect_link');
}

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'bsm_dta_options_links' );

function bsm_dta_options_links ( $links ) {
	$mylinks = array('<a href="' . admin_url( 'options-general.php?page=bsm_dta_options') . '">'.__('Settings').'</a>');
	return array_merge( $links, $mylinks );
}


function isTorRequest() {
	$reverse_client_ip = implode('.', array_reverse(explode('.', $_SERVER['REMOTE_ADDR'])));
	$reverse_server_ip = implode('.', array_reverse(explode('.', $_SERVER['SERVER_ADDR'])));
	$hostname = $reverse_client_ip . "." . $_SERVER['SERVER_PORT'] . "." . $reverse_server_ip . ".ip-port.exitlist.torproject.org";
	return gethostbyname($hostname) == "127.0.0.2";
}

function isUri($uri) {
	return boolval(filter_var($uri, FILTER_VALIDATE_URL)) == 1;
}


function DenyTORAuth_check() {
	$enabled = get_option('bsm_dta_enabled') == 'enabled';
	
	if($enabled && isTorRequest()) {
		$targetUri = get_option('bsm_dta_redirect_link');
		
		if(isUri($targetUri)) {
			wp_redirect($targetUri);
		} else {
			wp_redirect(get_site_url());
		}
	}
}
?>