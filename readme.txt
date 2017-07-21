=== Deny TOR Auth ===
Contributors: 8AFDE60F
Tags: login, security, tor, blocking, authentication
Requires at least: 3.0.1
Tested up to: 4.1.0
Stable tag: 1.1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Redirects TOR users from login page to main site.

== Description ==
If somebody connects to your login page using the TOR network as an anonymization network, this plugin will redirect
this user directly to the defined site URL or a custom URL. No login form will be shown or accessed. This reduces the 
possible misuse of the TOR network for brute force attacks. It is also possible to enable or disable the plugin via 
the settings page.

== Installation ==
Upload the plugin to your wordpress, activate it and enable it on the (sub) settings page (Deny Tor Auth Options).

== Frequently Asked Questions ==
Nothing yet.

== Screenshots ==
1. The option page

== Changelog ==
= 1.1.2 =
* Compatibility to Wordpress 4.1
= 1.1.1 =
* Added link to plugin settings in plugin view of wordpress
* Compatibility to Wordpress 4
= 1.1.0 =
* Added sub page in settings menu
* Added option to enable/disable plugin
* Added option to redirect to a custom page, default will be the site URL
* Uninstall removes saved options
= 1.0.0 =
* Initial upload