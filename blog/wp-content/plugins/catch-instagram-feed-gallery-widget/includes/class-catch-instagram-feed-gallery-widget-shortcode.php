<?php
/**
 * The Catch Instagram Feed Gallery Widget Shortcode for the plugin.
 *
 * @link       catchplugins.com
 * @since      1.0.0
 *
 * @package    Catch_Instagram_Feed_Gallery_Widget
 * @subpackage Catch_Instagram_Feed_Gallery_Widget/includes
 */

/**
 * The Catch Instagram Feed Gallery Widget Shortcode for the plugin.
 *
 * @package    Catch_Instagram_Feed_Gallery_Widget
 * @subpackage Catch_Instagram_Feed_Gallery_Widget/includes
 * @author     Catch Plugins <info@catchplugins.com>
 */
class Catch_Instagram_Feed_Gallery_Widget_Shortcode {

	/**
	 * Our Catch Instagram Feed Gallery Widget shortcode.
	 * Constructor function
	 */
	function __construct() {
		add_shortcode( 'catch-instagram-feed-gallery-widget', array( $this, 'catch_instagram_feed_gallery_widget_shortcode' ) );
	}

	/**
	 * Our Catch Instagram Feed Gallery Widget shortcode.
	 * Prints Featured Content data styled to look good on *any* theme.
	 *
	 * @param  array $atts Widget attributes.
	 */
	static function catch_instagram_feed_gallery_widget_shortcode( $atts ) {
	    // Default attributes.
	    $atts = shortcode_atts( array(
			'title'     => esc_html__( 'Catch Instagram Feed Gallery & Widget', 'catch-instagram-feed-gallery-widget' ),
			'username'  => '',
			'type'      => 'users',
			'layout'    => 'default',
			'padding'	=> 0,
			'column'    => 'six-columns',
			'number'    => 6,
			'size'      => 'standard_resolution',
			'target'    => 0,
			'link_type' => 'link_site',
			'link_text' => esc_html__( 'View on Instagram', 'catch-instagram-feed-gallery-widget' ),
			'element'   => 'shortcode',
		), $atts, 'catch-instagram-feed-gallery-widget' );

	    // A little sanitization.
		$atts['columns']   = sanitize_text_field( $atts['title'] );

		$atts['username']  = sanitize_text_field( $atts['username'] );

		$atts['column']    = sanitize_key( $atts['column'] );

		$atts['number']    = catch_instagram_feed_gallery_widget_sanitize_number_range( $atts['number'] );

		$atts['size']      = sanitize_key( $atts['size'] );

		$atts['element']   = 'shortcode';

		$catch_instagram_feed_gallery_widget_helper = new Catch_Instagram_Feed_Gallery_Widget_Helper();
		return $catch_instagram_feed_gallery_widget_helper->display( $atts );
	}
}

/**
 * Function run_catch_instagram_feed_gallery_widget_shortcode.
 */
function run_catch_instagram_feed_gallery_widget_shortcode() {
	$shortcode = new Catch_Instagram_Feed_Gallery_Widget_Shortcode;
}
run_catch_instagram_feed_gallery_widget_shortcode();
