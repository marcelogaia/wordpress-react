<?php
/**
 * The Catch Instagram Feed Gallery Widget Widget for the plugin.
 *
 * @link       catchplugins.com
 * @since      1.0.0
 *
 * @package    Catch_Instagram_Feed_Gallery_Widget
 * @subpackage Catch_Instagram_Feed_Gallery_Widget/includes
 */

/**
 * The Catch Instagram Feed Gallery Widget Widget for the plugin.
 *
 * @package    Catch_Instagram_Feed_Gallery_Widget
 * @subpackage Catch_Instagram_Feed_Gallery_Widget/includes
 * @author     Catch Plugins <info@catchplugins.com>
 */
class Catch_Instagram_Feed_Gallery_Widget_Widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Holds widget settings options, populated in constructor.
	 *
	 * @var array
	 */
	protected $options;

	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 1.0.0
	 */
	function __construct() {
		$this->defaults = array(
			'title'     => esc_html__( 'Catch Instagram Feed Gallery & Widget', 'catch-instagram-feed-gallery-widget' ),
			'type'      => 'users',
			'username'  => '',
			'number'    => 6,
			'padding'   => 0,
			'layout'    => 'default',
			'column'    => 'six-columns',
			'size'      => 'standard_resolution',
			'target'    => 0,
			'link_type' => 'link_site',
			'link_text' => esc_html__( 'View on Instagram', 'catch-instagram-feed-gallery-widget' ),
		);

		$widget_ops = array(
			'classname'   => 'catch-instagram-feed-gallery-widget',
			'description' => esc_html__( 'Displays your latest Instagram feed as Gallery and Widget', 'catch-instagram-feed-gallery-widget' ),
		);

		$control_ops = array(
			'id_base' => 'catch-instagram-feed-gallery-widget',
		);

		parent::__construct(
			'catch-instagram-feed-gallery-widget', // Base ID
			esc_html__( 'Catch Instagram Feed Gallery & Widget', 'catch-instagram-feed-gallery-widget' ), // Name.
			$widget_ops,
			$control_ops
		);
	}

	/**
	 * Widget Form. Create widget form.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Widget Instance.
	 */
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$options = catch_instagram_feed_gallery_widget_get_options( 'catch_instagram_feed_gallery_widget_options' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'catch-instagram-feed-gallery-widget' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat catch-instagram-feed-gallery-widget-title" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username', 'catch-instagram-feed-gallery-widget' ); ?>:</label>
			<input disabled="disabled" type="text" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" value="<?php echo esc_attr( $options['username'] ); ?>" class="widefat catch-instagram-feed-gallery-widget-username" />
		</p>
		<?php if ( ! $options['username'] ) : ?>
		<p class="description"><?php
			$url = admin_url('admin.php?page=catch_instagram_feed_gallery_widget');

			/* translators: 1. link start, 2. link end */
			printf( esc_html__( 'Please fetch access token %1$shere%2$s', 'catch-instagram-feed-gallery-widget' ),
				'<a href="' . esc_url( $url ) . '">',
				'</a>'
			);
		?></p>
		<?php endif; ?>

		<span class="show-more button"><?php esc_html_e( 'More Options', 'catch-instagram-feed-gallery-widget' ); ?><i class="dashicons dashicons-arrow-down"></i></span>
		<div class="more-options">
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos', 'catch-instagram-feed-gallery-widget' ); ?>:</label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo absint( $instance['number'] ); ?>" class="small-text catch-instagram-feed-gallery-widget-number" max="30" min="1" />
			</p>
			<p class="description"><?php esc_html_e( 'Max is 30.', 'catch-instagram-feed-gallery-widget' ); ?></p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Instagram Image Size', 'catch-instagram-feed-gallery-widget' ); ?>:</label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" class="widefat catch-instagram-feed-gallery-widget-size">
					<?php
						$image_size_choices = catch_instagram_feed_gallery_widget_image_size_option();

					foreach ( $image_size_choices as $key => $value ) {
						echo '<option value="' . esc_attr( $key ) . '" ' . selected( $key, $instance['size'], false ) . '>' . esc_attr( $value ) . '</option>';
					}
					?>
				</select>
			</p>
		</div>
		<?php

	}

	/**
	 * Widget Update. Save/Update widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance Widget New Instance.
	 * @param array $old_instance Widget Old Instance.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['username']  = sanitize_text_field( $new_instance['username'] );
		$instance['number']    = catch_instagram_feed_gallery_widget_sanitize_number_range( $new_instance['number'] );
		$instance['size']      = sanitize_key( $new_instance['size'] );

		return $instance;
	}

	/**
	 * Widget Form. Create widget form.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Arguments.
	 * @param array $instance Instance.
	 */
	function widget( $args, $instance ) {
		// Merge with defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $args['before_widget']; // WPCS: XSS ok, sanitization ok.

		// Set up the author bio.
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title']; // WPCS: XSS ok, sanitization ok.
		}
		$instance['element']     = 'widget';

		$options = catch_instagram_feed_gallery_widget_get_options( 'catch_instagram_feed_gallery_widget_options' );
		$username = $options['username'];

		if ( ! $instance['username'] ) {
			$instance['username'] = $username;
		}

		$catch_instagram_feed_gallery_widget_helper = new Catch_Instagram_Feed_Gallery_Widget_Helper();
		echo $catch_instagram_feed_gallery_widget_helper->display( $instance ); // WPCS: XSS ok, sanitization ok.

		echo $args['after_widget']; // WPCS: XSS ok, sanitization ok.
	}

}

/**
 * Intiate Catch_Instagram_Feed_Gallery_Widget_Widget Class.
 *
 * @since 1.0.0
 */
function catch_instagram_feed_gallery_widget_register_widget() {
	register_widget( 'Catch_Instagram_Feed_Gallery_Widget_Widget' );
}
add_action( 'widgets_init', 'catch_instagram_feed_gallery_widget_register_widget' );
