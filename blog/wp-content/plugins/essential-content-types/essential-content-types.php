<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://catchplugins.com
 * @since             1.0.0
 * @package           Essential_Content_Types
 *
 * @wordpress-plugin
 * Plugin Name:       Essential Content Types
 * Plugin URI:        https://catchplugins.com/plugins/essential-content-types/
 * Description:       Essential Content Types allows you to feature the impressive content through different content/post types on your website just the way you want it. These content/post types are missed by the themes in WordPress Theme Directory as the feature falls more towards the plugins’ territory.
 * Version:           1.2
 * Author:            Catch Plugins
 * Author URI:        https://catchplugins.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       essential-content-types
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-essential-content-types-activator.php
 */
function activate_essential_content_types() {
	$required = 'essential-content-types-pro/essential-content-types-pro.php';
	if ( is_plugin_active( $required ) ) {
		$message = esc_html__( 'Sorry, Pro plugin is already active. No need to activate Free version. %1$s&laquo; Return to Plugins%2$s.', 'essential-content-types' );
		$message = sprintf( $message, '<br><a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">', '</a>' );
		wp_die( $message );
	}
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-essential-content-types-activator.php';
	Essential_Content_Types_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-essential-content-types-deactivator.php
 */
function deactivate_essential_content_types() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-essential-content-types-deactivator.php';
	Essential_Content_Types_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_essential_content_types' );
register_deactivation_hook( __FILE__, 'deactivate_essential_content_types' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-essential-content-types.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_essential_content_types() {

	$plugin = new Essential_Content_Types();
	$plugin->run();

}
run_essential_content_types();
