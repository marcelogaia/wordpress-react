<?php

/**
 * Fired during plugin activation
 *
 * @link       https://catchplugins.com
 * @since      1.0.0
 *
 * @package    Essential_Content_Types
 * @subpackage Essential_Content_Types/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Essential_Content_Types
 * @subpackage Essential_Content_Types/includes
 * @author     Catch Plugins <info@catchplugins.com>
 */
class Essential_Content_Types_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
                array( 'Jetpack_Portfolio', 'activation_post_type_support' );

                $options = array(
                	'ect_portfolio',
                	'ect_testimonial',
                	'ect_featured_content',
                        'ect_service',
                        'ect_food_menu',
                );

                $value = array( 'status' => 1 );

                foreach ( $options as $option ) {
                	update_option( $option, $value );
                }
	}

}
