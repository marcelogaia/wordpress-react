<?php
/**
 * Menus Widget
 *
 * @package Essential_Widgets
 */


/**
 * Makes a custom Widget for Displaying About
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package Essential_Widgets
 */
class EW_Menus extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	function __construct() {

		$this->defaults = array(
			'title'           => esc_attr__( 'Navigation', 'essential-widgets' ),
			'menu'            => '',
			'container'       => 'div',
			'container_id'    => '',
			'container_class' => '',
			'menu_id'         => '',
			'menu_class'      => 'nav-menu',
			'depth'           => 0,
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'fallback_cb'     => 'wp_page_menu',
		);

		$widget_ops = array(
			'classname'   => 'essential-widgets ew-menus ewmenus widget_nav_menu',
			'description' => esc_html__( 'Displays a list of menus.', 'essential-widgets' ),
		);

		$control_ops = array(
			'id_base' => 'ew-menus',
		);

		parent::__construct(
			'ew-menus', // Base ID
			esc_html__( 'EW: Menus', 'essential-widgets' ), // Name
			$widget_ops,
			$control_ops
		);
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $instance
	 * @param  void
	 */
	public function form( $instance ) {

		// Merge the user-selected arguments with the defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$container = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) ); ?>

		<p>
			<label>
				<?php esc_html_e( 'Title:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php echo esc_attr( $this->defaults['title'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Menu:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'menu' ) ); ?>">
					<option value=""></option>

					<?php foreach ( wp_get_nav_menus() as $menu ) : ?>

						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $instance['menu'], $menu->term_id ); ?>><?php echo esc_html( $menu->name ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>
		<p>
			<label>
				<?php esc_html_e( 'Container:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'container' ) ); ?>">

					<?php foreach ( $container as $option ) : ?>

						<option value="<?php echo esc_attr( $option ); ?>" <?php selected( $instance['container'], $option ); ?>><?php echo esc_html( $option ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Container ID:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'container_id' ) ); ?>" value="<?php echo esc_attr( $instance['container_id'] ); ?>" placeholder="<?php echo esc_html__( 'example' ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Container Class:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'container_class' ) ); ?>" value="<?php echo esc_attr( $instance['container_class'] ); ?>" placeholder="<?php echo esc_html__( 'example' ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Menu ID:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'menu_id' ) ); ?>" value="<?php echo esc_attr( $instance['menu_id'] ); ?>" placeholder="<?php echo esc_html__( 'example' ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Menu Class:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'menu_class' ) ); ?>" value="<?php echo esc_attr( $instance['menu_class'] ); ?>" placeholder="<?php echo esc_html__( 'example' ); ?>" />
			</label>
		</p>

		<p class="button-primary more"><?php esc_html_e( 'More Options', 'essential-widgets' ); ?><i class="dashicons dashicons-arrow-down"></i></p>

		<div class="advanced-section">

		<p>
			<label>
				<?php esc_html_e( 'Depth:', 'essential-widgets' ); ?>
				<input type="number" class="widefat" size="5" min="0" name="<?php echo esc_attr( $this->get_field_name( 'depth' ) ); ?>" value="<?php echo esc_attr( $instance['depth'] ); ?>" placeholder="0" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Before:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'before' ) ); ?>" value="<?php echo esc_attr( $instance['before'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'After:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'after' ) ); ?>" value="<?php echo esc_attr( $instance['after'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Link Before:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'link_before' ) ); ?>" value="<?php echo esc_attr( $instance['link_before'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Link After:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'link_after' ) ); ?>" value="<?php echo esc_attr( $instance['link_after'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Fallback Callback Function:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'fallback_cb' ) ); ?>" value="<?php echo esc_attr( $instance['fallback_cb'] ); ?>" placeholder="wp_page_menu" />
			</label>
		</p>

		</div><!-- .advanced-section -->

		<div style="clear:both;">&nbsp;</div>
	<?php }

	/**
	 * update the particular instant
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Sanitize title.
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		// Strip tags.
		$instance['menu'] = strip_tags( $new_instance['menu']  );

		// Whitelist options.
		$container = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) );

		$instance['container'] = in_array( $new_instance['container'], $container ) ? $new_instance['container'] : 'div';

		// Integers.
		$instance['depth'] = absint( $new_instance['depth'] );

		// HTML class.
		$instance['container_id']    = sanitize_html_class( $new_instance['container_id']    );
		$instance['container_class'] = sanitize_html_class( $new_instance['container_class'] );
		$instance['menu_id']         = sanitize_html_class( $new_instance['menu_id']         );
		$instance['menu_class']      = sanitize_html_class( $new_instance['menu_class']      );

		// Text boxes. Make sure user can use 'unfiltered_html'.
		$instance['before']      = current_user_can( 'unfiltered_html' ) ? $new_instance['before']      : wp_kses_post( $new_instance['before']      );
		$instance['after']       = current_user_can( 'unfiltered_html' ) ? $new_instance['after']       : wp_kses_post( $new_instance['after']       );
		$instance['link_before'] = current_user_can( 'unfiltered_html' ) ? $new_instance['link_before'] : wp_kses_post( $new_instance['link_before'] );
		$instance['link_after']  = current_user_can( 'unfiltered_html' ) ? $new_instance['link_after']  : wp_kses_post( $new_instance['link_after']  );

		// Function name.
		$instance['fallback_cb'] = empty( $new_instance['fallback_cb'] ) || function_exists( $new_instance['fallback_cb'] ) ? $new_instance['fallback_cb'] : 'wp_page_menu';

		// Return sanitized options.
		return $instance;
	}

	/**
	 * Displays the Widget in the front-end.
	 *
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {

		// Set the $args for wp_nav_menu() to the $instance array.
		$instance = wp_parse_args( $instance, $this->defaults );

		// Overwrite the $echo argument and set it to false.
		$instance['echo'] = false;

		// Output the sidebar's $before_widget wrapper.
		echo $args['before_widget'];

		// If a title was input by the user, display it.
		if ( ! empty( $instance['title'] ) )
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];

		// Output the nav menu.
		echo str_replace( array( "\r", "\n", "\t" ), '', wp_nav_menu( $instance ) );

		// Close the sidebar's widget wrapper.
		echo $args['after_widget'];
	}
}

/**
 * Intiate Menu_Widget Class.
 *
 * @since 1.0.0
 */
function ew_menu_register() {
	register_widget( 'EW_Menus' );
}
add_action( 'widgets_init', 'ew_menu_register' );
