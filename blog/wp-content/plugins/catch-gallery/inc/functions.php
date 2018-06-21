<?php

/**
 * Renders extra controls in the Gallery Settings section of the new media UI.
 */
class Catch_Gallery_Settings {
	function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	function admin_init() {
		/**
		 * Filter the available gallery types.
		 *
		 * @module shortcodes, tiled-gallery
		 *
		 * @since 2.5.1
		 *
		 * @param array $value Array of the default thumbnail grid gallery type. Default array contains one key, ‘default’.
		 *
		 */
		$this->gallery_types = apply_filters( 'jetpack_gallery_types', array( 'default' => __( 'Thumbnail Grid', 'jetpack' ) ) );

		// Enqueue the media UI only if needed.
		if ( count( $this->gallery_types ) > 1 ) {
			add_action( 'wp_enqueue_media', array( $this, 'wp_enqueue_media' ) );
			add_action( 'print_media_templates', array( $this, 'print_media_templates' ) );
		}
		// Add Slideshow and Galleries functionality to core's media gallery widget.
		add_filter( 'widget_media_gallery_instance_schema', array( $this, 'core_media_widget_compat' ) );
	}

	/**
	 * Updates the schema of the core gallery widget so we can save the
	 * fields that we add to Gallery Widgets, like `type` and `conditions`
	 *
	 * @param $schema The current schema for the core gallery widget
	 *
	 * @return array  the updated schema
	 */
	public function core_media_widget_compat( $schema ) {
		$schema['type'] = array(
			'type' => 'string',
			'enum' => array_keys( $this->gallery_types ),
			'description' => __( 'Type of gallery.', 'jetpack' ),
			'default' => 'default',
		);
		return $schema;
	}

	/**
	 * Registers/enqueues the gallery settings admin js.
	 */
	function wp_enqueue_media() {
		if ( ! wp_script_is( 'jetpack-gallery-settings', 'registered' ) ) {
			/**
			 * This only happens if we're not in Jetpack, but on WPCOM instead.
			 * This is the correct path for WPCOM.
			 */
			wp_register_script( 'jetpack-gallery-settings', plugin_dir_url( __FILE__ ) . '../js/gallery-settings.js', array( 'media-views' ), '20180514' );
		}

		wp_enqueue_script( 'jetpack-gallery-settings' );
	}

	/**
	 * Outputs a view template which can be used with wp.media.template
	 */
	function print_media_templates() {
		$default_gallery_type = apply_filters( 'jetpack_default_gallery_type', 'default' );

		?>
		<script type="text/html" id="tmpl-jetpack-gallery-settings">
			<label class="setting">
				<span><?php esc_html_e( 'Type', 'catch-gallery' ); ?></span>
				<select class="type" name="type" data-setting="type">
					<?php foreach ( $this->gallery_types as $value => $caption ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $default_gallery_type ); ?>><?php echo esc_html( $caption ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		</script>
		<?php
	}
}
new Catch_Gallery_Settings;

if ( ! function_exists( 'catch_gallery_default_options' ) ) :
	/**
	 * Return array of default options
	 *
	 * @since     1.0
	 * @return    array    default options.
	 */
	function catch_gallery_default_options( $option = null ) {
		$default_options['carousel_enable']           = 1;
		$default_options['carousel_background_color'] = 'black';
		$default_options['carousel_display_exif']     = 1;
		$default_options['comments_display']          = 1;
		$default_options['fullsize_display']          = 1;

		if ( null == $option ) {
			return apply_filters( 'catch_gallery_options', $default_options );
		} else {
			return $default_options[ $option ];
		}
	}
endif; // catch_gallery_default_options

if ( ! function_exists( 'catch_gallery_get_options' ) ) :
	/**
	 * Returns saved options
	 * @return array options
	 */
	function catch_gallery_get_options() {
		$defaults = catch_gallery_default_options();
		$options  = get_option( 'catch_gallery_options', $defaults );

		return $options;
	}
endif; // catch_gallery_get_options