<?php
/**
 * Pages Widget
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
class EW_Pages_Widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	function __construct() {

		// Set up the defaults.
		$this->defaults = array(
			'title'        => esc_attr__( 'Pages', 'essential-widgets'),
			'post_type'    => 'page',
			'depth'        => 0,
			'number'       => '',
			'offset'       => '',
			'child_of'     => '',
			'include'      => '',
			'exclude'      => '',
			'exclude_tree' => '',
			'meta_key'     => '',
			'meta_value'   => '',
			'authors'      => '',
			'link_before'  => '',
			'link_after'   => '',
			'show_date'    => '',
			'hierarchical' => true,
			'sort_column'  => 'post_title',
			'sort_order'   => 'ASC',
			'date_format'  => get_option( 'date_format' )
		);

		$widget_ops = array(
			'classname'   => 'essential-widgets ew-pages ewpages',
			'description' => esc_html__( 'Displays a list of pages.', 'essential-widgets' ),
		);

		$control_ops = array(
			'id_base' => 'ew-pages',
		);

		parent::__construct(
			'ew-pages', // Base ID
			esc_html__( 'EW: Pages', 'essential-widgets' ), // Name
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

		$post_types = get_post_types(
			array(
				'public' => true,
				'hierarchical' => true,
			),
			'objects'
		);

		$sort_order = array(
			'ASC'  => esc_attr__( 'Ascending', 'essential-widgets' ),
			'DESC' => esc_attr__( 'Descending', 'essential-widgets' ),
		);

		$sort_column = array(
			'post_author'   => esc_attr__( 'Author', 'essential-widgets' ),
			'post_date'     => esc_attr__( 'Date', 'essential-widgets' ),
			'ID'            => esc_attr__( 'ID', 'essential-widgets' ),
			'menu_order'    => esc_attr__( 'Menu Order', 'essential-widgets' ),
			'post_modified' => esc_attr__( 'Modified', 'essential-widgets' ),
			'post_name'     => esc_attr__( 'Slug', 'essential-widgets' ),
			'post_title'    => esc_attr__( 'Title', 'essential-widgets' ),
		);

		$show_date = array(
			''         => esc_attr__( 'Select', 'essential-widgets' ),
			'created'  => esc_attr__( 'Created', 'essential-widgets' ),
			'modified' => esc_attr__( 'Modified', 'essential-widgets' ),
		);

		$meta_key = array_merge( array( '' ), (array) get_meta_keys() ); ?>

		<p>
			<label>
				<?php esc_html_e( 'Title:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  placeholder="<?php echo esc_attr( $this->defaults['title'] ); ?>" />
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

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'sort_order' ) ); ?>">

					<?php foreach ( $sort_order as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['sort_order'], $option_value ); ?>><?php echo esc_html($option_label ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Order By:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'sort_column' ) ); ?>">

					<?php foreach ( $sort_column as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['sort_column'], $option_value ); ?>><?php echo esc_html($option_label ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Depth:', 'essential-widgets' ); ?>
				<input type="number" class="widefat" size="5" min="0" name="<?php echo esc_attr( $this->get_field_name( 'depth' ) ); ?>" value="<?php echo esc_attr( $instance['depth'] ); ?>" placeholder="0" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Number:', 'essential-widgets' ); ?>
				<input type="number" class="widefat" size="5" min="0" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>" placeholder="0" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Offset:', 'essential-widgets' ); ?>
				<input type="number" class="widefat" size="5" min="0" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" value="<?php echo esc_attr( $instance['offset'] ); ?>" placeholder="0"  />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Child Of:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'child_of' ) ); ?>" value="<?php echo esc_attr( $instance['child_of'] ); ?>" placeholder="0" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Include:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'include' ) ); ?>" value="<?php echo esc_attr( $instance['include'] ); ?>" placeholder="1,2,3&hellip;" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Exclude:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>" value="<?php echo esc_attr( $instance['exclude'] ); ?>" placeholder="1,2,3&hellip;" />
			</label>
		</p>

		<p class="button-primary more"><?php esc_html_e( 'More Options', 'essential-widgets' ); ?><i class="dashicons dashicons-arrow-down"></i></p>

		<div class="advanced-section">

		<p>
			<label>
				<?php esc_html_e( 'Exclude Tree:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'exclude_tree' ) ); ?>" value="<?php echo esc_attr( $instance['exclude_tree'] ); ?>" placeholder="1,2,3&hellip;" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Meta Key:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'meta_key' ) ); ?>">

					<?php foreach ( $meta_key as $meta ) : ?>

						<option value="<?php echo esc_attr( $meta ); ?>" <?php selected( $instance['meta_key'], $meta ); ?>><?php echo esc_html( $meta ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Meta Value:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'meta_value' ) ); ?>" value="<?php echo esc_attr( $instance['meta_value'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Authors:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'authors' ) ); ?>" value="<?php echo esc_attr( $instance['authors'] ); ?>" placeholder="1,2,3&hellip;" />
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
				<?php esc_html_e( 'Show Date:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>">

					<?php foreach ( $show_date as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['show_date'], $option_value ); ?>><?php echo esc_html($option_label ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Date Format:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'date_format' ) ); ?>" value="<?php echo esc_attr( $instance['date_format'] ); ?>" placeholder="<?php echo esc_attr( get_option( 'date_format' ) ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" <?php checked( $instance['hierarchical'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'hierarchical' ) ); ?>" />
				<?php esc_html_e( 'Hierarchical?', 'essential-widgets'); ?>
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

		// Sanitize title.
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		// Strip tags.
		$instance['meta_key']    = strip_tags( $new_instance['meta_key']    );
		$instance['meta_value']  = strip_tags( $new_instance['meta_value']  );
		$instance['date_format'] = strip_tags( $new_instance['date_format'] );

		// Sanitize key.
		$instance['post_type'] = sanitize_key( $new_instance['post_type'] );

		// Whitelist options.
		$sort_order  = array( 'ASC', 'DESC' );
		$sort_column = array( 'post_author', 'post_date', 'ID', 'menu_order', 'post_modified', 'post_name', 'post_title' );
		$show_date   = array( '', 'created', 'modified' );

		$instance['sort_column'] = in_array( $new_instance['sort_column'], $sort_column ) ? $new_instance['sort_column'] : 'post_title';
		$instance['sort_order']  = in_array( $new_instance['sort_order'],  $sort_order  ) ? $new_instance['sort_order']  : 'ASC';
		$instance['show_date']   = in_array( $new_instance['show_date'],   $show_date   ) ? $new_instance['show_date']   : '';

		// Text boxes. Make sure user can use 'unfiltered_html'.
		$instance['link_before'] = current_user_can( 'unfiltered_html' ) ? $new_instance['link_before'] : wp_kses_post( $new_instance['link_before'] );
		$instance['link_after']  = current_user_can( 'unfiltered_html' ) ? $new_instance['link_after']  : wp_kses_post( $new_instance['link_after']  );

		// Integers.
		$instance['number']   = intval( $new_instance['number']   );
		$instance['depth']    = absint( $new_instance['depth']    );
		$instance['child_of'] = absint( $new_instance['child_of'] );
		$instance['offset']   = absint( $new_instance['offset']   );

		// Only allow integers and commas.
		$instance['include']      = preg_replace( '/[^0-9,]/', '', $new_instance['include']      );
		$instance['exclude']      = preg_replace( '/[^0-9,]/', '', $new_instance['exclude']      );
		$instance['exclude_tree'] = preg_replace( '/[^0-9,]/', '', $new_instance['exclude_tree'] );
		$instance['authors']      = preg_replace( '/[^0-9,]/', '', $new_instance['authors']      );

		// Checkboxes.
		$instance['hierarchical'] = isset( $new_instance['hierarchical'] ) ? 1 : 0;

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

		// Set the $args for wp_list_pages() to the $instance array.
		$instance = wp_parse_args( $instance, $this->defaults );

		// Set the $title_li and $echo to false.
		$instance['title_li'] = false;
		$instance['echo']     = false;

		// Output the args's $before_widget wrapper.
		echo $args['before_widget'];

		// If a title was input by the user, display it.
		if ( ! empty( $instance['title'] ) )
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];

		// Output the page list.
		echo '<ul class="pages">' . str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages( $instance ) ) . '</ul>';

		// Close the args's widget wrapper.
		echo $args['after_widget'];
	}
}

/**
 * Intiate About_Widget Class.
 *
 * @since 1.0.0
 */
function ew_pages_register() {
	register_widget( 'EW_Pages_Widget' );
}
add_action( 'widgets_init', 'ew_pages_register' );
