<?php
/**
 * Custom Archive Widget
 *
 * @package Essential_Widgets
 */


/**
 * Custom Archive Widget
 */
class EW_Archives extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	function __construct() {

		// Set up defaults.
		$this->defaults = array(
			'title'           => esc_attr__( 'Archives', 'essential-widgets' ),
			'limit'           => 10,
			'type'            => 'monthly',
			'post_type'       => 'post',
			'order'           => 'DESC',
			'format'          => 'html',
			'before'          => '',
			'after'           => '',
			'show_post_count' => false,
		);

		$widget_ops = array(
			'classname'   => 'essential-widgets widget_archive ew-archive ewarchive',
			'description' => esc_html__( 'Displays a list of categories', 'essential-widgets' ),
		);

		$control_ops = array(
			'id_base' => 'ew-archive',
		);

		parent::__construct(
			'ew-archive', // Base ID
			__( 'EW: Archives', 'essential-widgets' ), // Name
			$widget_ops,
			$control_ops
		);
	}

	function form($instance) {
		// Merge the user-selected arguments with the defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// Get post types.
		$post_types = get_post_types( array( 'name' => 'post' ), 'objects' );
		$post_types = array_merge( $post_types, get_post_types( array( 'publicly_queryable' => true, '_builtin' => false ), 'objects' ) );

		// Create an array of archive types.
		$type = array(
			'alpha'      => esc_attr__( 'Alphabetical', 'essential-widgets' ),
			'daily'      => esc_attr__( 'Daily',        'essential-widgets' ),
			'monthly'    => esc_attr__( 'Monthly',      'essential-widgets' ),
			'postbypost' => esc_attr__( 'Post By Post', 'essential-widgets' ),
			'weekly'     => esc_attr__( 'Weekly',       'essential-widgets' ),
			'yearly'     => esc_attr__( 'Yearly',       'essential-widgets' )
		);

		// Create an array of order options.
		$order = array(
			'ASC'  => esc_attr__( 'Ascending',  'essential-widgets' ),
			'DESC' => esc_attr__( 'Descending', 'essential-widgets' )
		);

		// Create an array of archive formats.
		$format = array(
			'custom' => esc_attr__( 'Plain', 'essential-widgets' ),
			'html'   => esc_attr__( 'List',   'essential-widgets' ),
			'option' => esc_attr__( 'Dropdown', 'essential-widgets' )
		); ?>

		<p>
			<label>
				<?php esc_html_e( 'Title:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php echo esc_attr( $this->defaults['title'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Limit:', 'essential-widgets' ); ?></label>
				<input type="number" class="widefat" size="5" min="0" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" value="<?php echo esc_attr( $instance['limit'] ); ?>" placeholder="10" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Type:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>">

					<?php foreach ( $type as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['type'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Post Type:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>">

					<?php foreach ( $post_types as $post_type ) : ?>

						<option value="<?php echo esc_attr( $post_type->name ); ?>" <?php selected( $instance['post_type'], $post_type->name ); ?>><?php echo esc_html( $post_type->labels->singular_name ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Order:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">

					<?php foreach ( $order as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['order'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Display as:', 'essential-widgets' ); ?></label>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'format' ) ); ?>">

					<?php foreach ( $format as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['format'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>

					<?php endforeach; ?>

				</select>
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
				<input type="checkbox" <?php checked( $instance['show_post_count'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'show_post_count' ) ); ?>" />
				<?php esc_html_e( 'Show post count?', 'essential-widgets' ); ?>
			</label>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {

		// Sanitize title.
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		// Sanitize key.
		$instance['post_type'] = sanitize_key( $new_instance['post_type'] );

		// Whitelist options.
		$type   = array( 'alpha', 'daily', 'monthly', 'postbypost', 'weekly', 'yearly' );
		$order  = array( 'ASC', 'DESC' );
		$format = array( 'custom', 'html', 'option' );

		$instance['type']   = in_array( $new_instance['type'], $type )     ? $new_instance['type']   : 'monthly';
		$instance['order']  = in_array( $new_instance['order'], $order )   ? $new_instance['order']  : 'DESC';
		$instance['format'] = in_array( $new_instance['format'], $format ) ? $new_instance['format'] : 'html';

		// Integers.
		$instance['limit'] = intval( $new_instance['limit'] );
		$instance['limit'] = 0 === $instance['limit'] ? '' : $instance['limit'];

		// Text boxes. Make sure user can use 'unfiltered_html'.
		$instance['before'] = current_user_can( 'unfiltered_html' ) ? $new_instance['before'] : wp_kses_post( $new_instance['before'] );
		$instance['after']  = current_user_can( 'unfiltered_html' ) ? $new_instance['after']  : wp_kses_post( $new_instance['after']  );

		// Checkboxes.
		$instance['show_post_count'] = isset( $new_instance['show_post_count'] ) ? 1 : 0;

		// Return sanitized options.
		return $instance;
	}

	function widget( $args, $instance ) {
		// Set the $args for wp_get_archives() to the $instance array.
		$instance = wp_parse_args( $instance, $this->defaults );

		// Overwrite the $echo argument and set it to false.
		$instance['echo'] = false;

		// Output the sidebar's $before_widget wrapper.
		echo $args['before_widget'];

		// If a title was input by the user, display it.
		if ( ! empty( $instance['title'] ) )
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];

		// Get the archives list.
		$archives = str_replace( array( "\r", "\n", "\t" ), '', wp_get_archives( $instance ) );

		$archives = str_replace('</a>&nbsp;(', '</a> <span>(', $archives);
	  	$archives = str_replace(')', ')</span>', $archives);

		// If the archives should be shown in a <select> drop-down.
		if ( 'option' == $instance['format'] ) {

			// Create a title for the drop-down based on the archive type.
			if ( 'yearly' == $instance['type'] )
				$option_title = esc_html__( 'Select Year', 'essential-widgets' );

			elseif ( 'monthly' == $instance['type'] )
				$option_title = esc_html__( 'Select Month', 'essential-widgets' );

			elseif ( 'weekly' == $instance['type'] )
				$option_title = esc_html__( 'Select Week', 'essential-widgets' );

			elseif ( 'daily' == $instance['type'] )
				$option_title = esc_html__( 'Select Day', 'essential-widgets' );

			elseif ( 'postbypost' == $instance['type'] || 'alpha' == $instance['type'] )
				$option_title = esc_html__( 'Select Post', 'essential-widgets' );

			// Output the <select> element and each <option>.
			echo '<p><select name="archive-dropdown" onchange=\'document.location.href=this.options[this.selectedIndex].value;\'>';
				echo '<option value="">' . $option_title . '</option>';
				echo $archives;
			echo '</select></p>';
		}

		// If the format should be an unordered list.
		elseif ( 'html' == $instance['format'] ) {
			echo '<ul class="ew-archives">' . $archives . '</ul><!-- .xoxo .archives -->';
		}

		// All other formats.
		else {
			echo $archives;
		}

		// Close the sidebar's widget wrapper.
		echo $args['after_widget'];
	}
}// end Archive_Widget class

/**
 * Intiate Archive_Widget Class.
 *
 * @since 1.0.0
 */
function ew_archives_register() {
	register_widget( 'EW_Archives' );
}
add_action( 'widgets_init', 'ew_archives_register' );
