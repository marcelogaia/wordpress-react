<?php
/**
 * Posts Widget
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
class EW_Posts extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	function __construct() {

		$this->defaults = array(
			'title'       => esc_attr__( 'Posts', 'essential-widgets' ),
			'post_type'   => array( 'post' ),
			'order'       => 'DESC',
			'orderby'     => 'date',
			'number'      => 10,
			'show_date'   => false,
			'show_author' => false
		);

		$widget_ops = array(
			'classname'   => 'essential-widgets ew-posts ewposts',
			'description' => esc_html__( 'Displays a list of posts.', 'essential-widgets' ),
		);

		$control_ops = array(
			'id_base' => 'ew-posts',
		);

		parent::__construct(
			'ew-posts', // Base ID
			esc_html__( 'EW: Posts', 'essential-widgets' ), // Name
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

		// <select> element options.
		$types = get_post_types( array( 'public' => true ), 'objects' );

		$order = array(
			'ASC'  => esc_attr__( 'Ascending', 'essential-widgets' ),
			'DESC' => esc_attr__( 'Descending', 'essential-widgets' )
		);

		$orderby = array(
			'author'        => esc_attr__( 'Author', 'essential-widgets' ),
			'name'          => esc_attr__( 'Slug', 'essential-widgets' ),
			'none'          => esc_attr__( 'None', 'essential-widgets' ),
			'type'          => esc_attr__( 'Type', 'essential-widgets' ),
			'date'          => esc_attr__( 'Date', 'essential-widgets' ),
			'ID'            => esc_attr__( 'ID', 'essential-widgets' ),
			'modified'      => esc_attr__( 'Date (Modified)', 'essential-widgets' ),
			'parent'        => esc_attr__( 'Parent', 'essential-widgets' ),
			'comment_count' => esc_attr__( 'Comment Count', 'essential-widgets' ),
			'menu_order'    => esc_attr__( 'Menu Order', 'essential-widgets' ),
			'title'         => esc_attr__( 'Title', 'essential-widgets' )
		); ?>

		<p>
			<label>
				<?php esc_html_e( 'Title:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php echo esc_attr( $this->defaults['title'] ); ?>" />
			</label>
		</p>

		<?php esc_html_e( 'Post Type:', 'essential-widgets' ); ?>

		<div class="wp-tab-panel">
			<ul>
			<?php foreach ( $types as $type ) : ?>

				<li>
					<label>
						<input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>[]" value="<?php echo esc_attr( $type->name ); ?>" <?php checked( in_array( $type->name, (array)$instance['post_type'] ) ); ?> />
						<?php echo esc_html( $type->labels->singular_name ); ?>
					</label>
				</li>

			<?php endforeach; ?>
			</ul>
		</div>

		<p>
			<label>
				<?php esc_html_e( 'Number:', 'essential-widgets' ); ?>
				<input type="number" min="1" size="3" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>" placeholder="<?php echo esc_attr( $this->defaults['number'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Order:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">

					<?php foreach ( $order as $option_value => $option_label ) : ?>

						<option value="<?php echo $option_value; ?>" <?php selected( $instance['order'], $option_value ); ?>><?php echo $option_label; ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Order By:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">

					<?php foreach ( $orderby as $option_value => $option_label ) : ?>

						<option value="<?php echo $option_value; ?>" <?php selected( $instance['orderby'], $option_value ); ?>><?php echo $option_label; ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" <?php checked( $instance['show_date'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
				<?php esc_html_e( 'Display post date?', 'essential-widgets' ); ?>
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" <?php checked( $instance['show_author'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'show_author' ) ); ?>" />
				<?php esc_html_e( 'Display post author?', 'essential-widgets' ); ?>
			</label>
		</p>
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

		// Sanitize key.
		$instance['post_type'] = array_map( 'sanitize_key', $new_instance['post_type'] );

		// Whitelist options.
		$order   = array( 'ASC', 'DESC' );
		$orderby = array( 'author', 'name', 'none', 'type', 'date', 'ID', 'modified', 'parent', 'comment_count', 'menu_order', 'title' );

		$instance['order']   = in_array( $new_instance['order'],   $order )   ? $new_instance['order']   : 'DESC';
		$instance['orderby'] = in_array( $new_instance['orderby'], $orderby ) ? $new_instance['orderby'] : 'date';

		// Integers.
		$instance['number']   = intval( $new_instance['number'] );

		// Checkboxes.
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? 1 : 0;
		$instance['show_author'] = isset( $new_instance['show_author'] ) ? 1 : 0;

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

		// Set the $args for wp_get_archives() to the $instance array.
		$instance = wp_parse_args( $instance, $this->defaults );

		$loop = new \WP_Query(
			array(
				'posts_per_page'      => $instance['number'],
				'post_type'           => $instance['post_type'],
				'order'               => $instance['order'],
				'orderby'             => $instance['orderby'],
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
			)
		);

		if ( $loop->have_posts() ) : ?>
			<?php echo $args['before_widget']; ?>

			<?php
				if ( ! empty( $instance['title'] ) )
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];
			?>

			<ul>

			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

				<li>
					<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>

					<?php if ( $instance['show_author'] ) : ?>
						<span class="post-author"><?php echo ' by ' . get_the_author(); ?></span>
					<?php endif; ?>

					<?php if ( $instance['show_date'] ) : ?>
						<span class="post-date"><?php echo get_the_date(); ?></span>
					<?php endif; ?>
				</li>

			<?php endwhile; ?>

			</ul>

			<?php echo $args['after_widget']; ?>

			<?php wp_reset_postdata();

		endif;
	}
}

/**
 * Intiate About_Widget Class.
 *
 * @since 1.0.0
 */
function ew_posts_register() {
	register_widget( 'EW_Posts' );
}
add_action( 'widgets_init', 'ew_posts_register' );
