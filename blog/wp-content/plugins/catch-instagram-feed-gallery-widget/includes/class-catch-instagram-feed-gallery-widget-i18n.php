<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       catchplugins.com
 * @since      1.0.0
 *
 * @package    Catch_Instagram_Feed_Gallery_Widget
 * @subpackage Catch_Instagram_Feed_Gallery_Widget/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Catch_Instagram_Feed_Gallery_Widget
 * @subpackage Catch_Instagram_Feed_Gallery_Widget/includes
 * @author     Catch Plugins <info@catchplugins.com>
 */
class Catch_Instagram_Feed_Gallery_Widget_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'catch-instagram-feed-gallery-widget',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
