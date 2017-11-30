<?php
/**
 * Plugin Name:    Give - Donor List
 * Description:    Adds a give_donor_list shortcode for easy display of donors
 * Version:        1.0
 * Author:         Florian TIAR
 * Author URI:     https://wpstrategie.fr
 * License:        GNU General Public License v3 or later
 * License URI:    http://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain:    givedonorlist
 *
 */

// Defines Plugin directory for easy reference
define( 'GIVEDONORLIST_DIR', plugin_dir_path( __FILE__ ) );
define( 'GIVEDONORLIST_VIEWS_FOLDER_NAME', 'give_donorlist' );

function givedonorlist_plugin_init() {

	// If Give is NOT active
	if ( current_user_can( 'activate_plugins' ) && ! class_exists( 'Give' ) ) {

		add_action( 'admin_init', 'givedonorlist_deactivate' );

		// Deactivate GIVEDONOR
		function givedonorlist_deactivate() {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}

		// Throw an Alert to tell the Admin why it didn't activate
		function givedonorlist_admin_notice() {
			echo "<div class=\"error\"><p><strong>" . __( '"Give Donor List"</strong> requires the free <a href="https://wordpress.org/plugins/give" target="_blank">Give Donation Plugin</a> to function. Please activate Give before activating this plugin. For now, the plug-in has been <strong>deactivated</strong>.', 'ggfd' ) . "</p></div>";
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
		}

		// If Give IS Active, then we load everything up.
	} else {

		// Include/Execute necessary files
		include_once( GIVEDONORLIST_DIR . '/classes/givedonorlist-shortcodes.php' );

	}
}

// The initialization function
add_action( 'plugins_loaded', 'givedonorlist_plugin_init' );