<?php
/**
 * Custom Tag Widget
 *
 * @package Essential_Widgets
 */


/**
 * Custom Tags Widget
 */
class EW_Tags extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	function __construct() {

		// Set up the defaults.
		$topic_count_text = _n_noop( '%s topic', '%s topics', 'essential-widgets' );

		// Set up the defaults.
		$this->defaults = array(
			'title'                      => esc_attr__( 'Tags', 'essential-widgets' ),
			'order'                      => 'ASC',
			'orderby'                    => 'name',
			'format'                     => 'flat',
			'include'                    => '',
			'exclude'                    => '',
			'unit'                       => 'pt',
			'smallest'                   => 8,
			'largest'                    => 22,
			'number'                     => 25,
			'separator'                  => ' ',
			'child_of'                   => '',
			'parent'                     => '',
			'taxonomy'                   => array( 'post_tag' ),
			'hide_empty'                 => 1,
			'show_count'                 => false,
			'pad_counts'                 => false,
			'search'                     => '',
			'name__like'                 => '',
			'single_text'                => $topic_count_text['singular'],
			'multiple_text'              => $topic_count_text['plural'],
			'topic_count_text_callback'  => '',
			'topic_count_scale_callback' => 'default_topic_count_scale',
		);

		$widget_ops = array(
			'classname'   => 'essential-widgets ew-tag ewtag',
			'description' => esc_html__( 'Displays a list of tags', 'essential-widgets' ),
		);

		$control_ops = array(
			'id_base' => 'ew-tag'
		);

		parent::__construct(
			'ew-tag', // Base ID
			__( 'EW: Tags', 'essential-widgets' ), // Name
			$widget_ops,
			$control_ops
		);
	}

	function form($instance) {
		// Merge the user-selected arguments with the defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// <select> element options.
		$taxonomies = get_taxonomies( array( 'show_tagcloud' => true ), 'objects' );

		$link = array(
			'view' => esc_attr__( 'View', 'essential-widgets' ),
			'edit' => esc_attr__( 'Edit', 'essential-widgets' )
		);

		$format = array(
			'flat'  => esc_attr__( 'Cloud', 'essential-widgets' ),
			'list'  => esc_attr__( 'List', 'essential-widgets' ),
			'round' => esc_attr__( 'Round Corners', 'essential-widgets' )
		);

		$order = array(
			'ASC'  => esc_attr__( 'Ascending',  'essential-widgets' ),
			'DESC' => esc_attr__( 'Descending', 'essential-widgets' ),
			'RAND' => esc_attr__( 'Random',     'essential-widgets' )
		);

		$orderby = array(
			'count' => esc_attr__( 'Count', 'essential-widgets' ),
			'name'  => esc_attr__( 'Name',  'essential-widgets' )
		);

		$unit = array(
			'pt' => 'pt',
			'px' => 'px',
			'em' => 'em',
			'%'  => '%'
		); ?>

		<p>
			<label>
				<?php esc_html_e( 'Title:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php echo esc_attr( $this->defaults['title'] ); ?>" />
			</label>
		</p>

		<?php esc_html_e( 'Taxonomy:', 'essential-widgets' ); ?>

		<div class="wp-tab-panel">
			<ul>

			<?php foreach ( $taxonomies as $taxonomy ) : ?>

				<li>
					<label>
						<input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'taxonomy' ) ); ?>[]" value="<?php echo esc_attr( $taxonomy->name ); ?>" <?php checked( in_array( $taxonomy->name, (array)$instance['taxonomy'] ) ); ?> />
						<?php echo esc_html( $taxonomy->labels->singular_name ); ?>
					</label>
				</li>
			<?php endforeach; ?>

			</ul>
		</div>

		<p>
			<label>
				<?php esc_html_e( 'Display as:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'format' ) ); ?>">

					<?php foreach ( $format as $option_value => $option_label ) : ?>

						<option value="<?php echo $option_value; ?>" <?php selected( $instance['format'], $option_value ); ?>><?php echo $option_label; ?></option>

					<?php endforeach; ?>

				</select>
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
				<?php esc_html_e( 'Number:', 'essential-widgets' ); ?>
				<input type="number" class="widefat" size="5" min="0" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>" placeholder="25" />
			</label>
		</p>

		<p class="button-primary more"><?php esc_html_e( 'More Options', 'essential-widgets' ); ?><i class="dashicons dashicons-arrow-down"></i></p>

		<div class="advanced-section">

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

		<p>
			<label>
				<?php esc_html_e( 'Largest:', 'essential-widgets' ); ?>
				<input type="number" class="widefat" size="5" min="1" name="<?php echo esc_attr( $this->get_field_name( 'largest' ) ); ?>" value="<?php echo esc_attr( $instance['largest'] ); ?>" placeholder="22" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Smallest:', 'essential-widgets' ); ?>
				<input type="number" class="widefat" size="5" min="1" name="<?php echo esc_attr( $this->get_field_name( 'smallest' ) ); ?>" value="<?php echo esc_attr( $instance['smallest'] ); ?>" placeholder="8" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Unit:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'unit' ) ); ?>">

					<?php foreach ( $unit as $option_value => $option_label ) : ?>

						<option value="<?php echo $option_value; ?>" <?php selected( $instance['unit'], $option_value ); ?>><?php echo $option_label; ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>
		<p>
			<label>
				<?php esc_html_e( 'Separator:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'separator' ) ); ?>" value="<?php echo esc_attr( $instance['separator'] ); ?>" placeholder="&thinsp;&ndash;&thinsp;" />
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
				<?php esc_html_e( 'Parent:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'parent' ) ); ?>" value="<?php echo esc_attr( $instance['parent'] ); ?>" placeholder="0" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Search:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'search' ) ); ?>" value="<?php echo esc_attr( $instance['search'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Name Like:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'name__like' ) ); ?>" value="<?php echo esc_attr( $instance['name__like'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Single Text:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'single_text' ) ); ?>" value="<?php echo esc_attr( $instance['single_text'] ); ?>" placeholder="<?php echo esc_attr( $this->defaults['single_text'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Multiple Text:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'multiple_text' ) ); ?>" value="<?php echo esc_attr( $instance['multiple_text'] ); ?>" placeholder="<?php echo esc_attr( $this->defaults['multiple_text'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Count Text Callback:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'topic_count_text_callback' ) ); ?>" value="<?php echo esc_attr( $instance['topic_count_text_callback'] ); ?>" placeholder="default_topic_count_text" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Count Scale Callback:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'topic_count_scale_callback' ) ); ?>" value="<?php echo esc_attr( $instance['topic_count_scale_callback'] ); ?>" placeholder="default_topic_count_scale" />
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" <?php checked( $instance['show_count'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'show_count' ) ); ?>" />
				<?php esc_html_e( 'Show count?', 'essential-widgets' ); ?>
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" <?php checked( $instance['pad_counts'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'pad_counts' ) ); ?>" />
				<?php esc_html_e( 'Pad counts?', 'essential-widgets' ); ?>
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" <?php checked( $instance['hide_empty'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'hide_empty' ) ); ?>" />
				<?php esc_html_e( 'Hide empty?', 'essential-widgets' ); ?>
			</label>
		</p>

		</div><!-- .advanced-section -->

		<div style="clear:both;">&nbsp;</div>
		<?php
	}

	function update( $new_instance, $old_instance ) {

		// Sanitize title.
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		// Strip tags.
		$instance['separator']     = strip_tags( $new_instance['separator']     );
		$instance['name__like']    = strip_tags( $new_instance['name__like']    );
		$instance['search']        = strip_tags( $new_instance['search']        );
		$instance['single_text']   = strip_tags( $new_instance['single_text']   );
		$instance['multiple_text'] = strip_tags( $new_instance['multiple_text'] );

		// Sanitize key.
		$instance['taxonomy'] = array_map( 'sanitize_key', $new_instance['taxonomy'] );

		// Whitelist options.
		$order   = array( 'ASC', 'DESC', 'RAND' );
		$orderby = array( 'count', 'name' );
		$format  = array( 'flat', 'list', 'round' );
		$unit    = array( 'pt', 'px', 'em', '%' );

		$instance['order']   = in_array( $new_instance['order'],   $order )   ? $new_instance['order']   : 'ASC';
		$instance['orderby'] = in_array( $new_instance['orderby'], $orderby ) ? $new_instance['orderby'] : 'name';
		$instance['format']  = in_array( $new_instance['format'],  $format )  ? $new_instance['format']  : 'view';
		$instance['unit']    = in_array( $new_instance['unit'],    $unit )    ? $new_instance['unit']    : 'pt';

		// Integers.
		$instance['number']   = intval( $new_instance['number']   );
		$instance['smallest'] = absint( $new_instance['smallest'] );
		$instance['largest']  = absint( $new_instance['largest']  );
		$instance['child_of'] = absint( $new_instance['child_of'] );
		$instance['parent']   = absint( $new_instance['parent']   );

		// Only allow integers and commas.
		$instance['include'] = preg_replace( '/[^0-9,]/', '', $new_instance['include'] );
		$instance['exclude'] = preg_replace( '/[^0-9,]/', '', $new_instance['exclude'] );

		// Check if function exists.
		$instance['topic_count_text_callback']  = empty( $new_instance['fallback_cb'] ) || function_exists( $new_instance['topic_count_text_callback'] )  ? $new_instance['topic_count_text_callback']  : 'default_topic_count_text';
		$instance['topic_count_scale_callback'] = empty( $new_instance['fallback_cb'] ) || function_exists( $new_instance['topic_count_scale_callback'] ) ? $new_instance['topic_count_scale_callback'] : 'default_topic_count_scale';

		// Checkboxes.
		$instance['show_count'] = isset( $new_instance['show_count'] ) ? 1 : 0;
		$instance['pad_counts'] = isset( $new_instance['pad_counts'] ) ? 1 : 0;
		$instance['hide_empty'] = isset( $new_instance['hide_empty'] ) ? 1 : 0;

		// Return sanitized options.
		return $instance;
	}

	function widget( $args, $instance ) {
		// Set the $instance for wp_tag_cloud() to the $instance array.
		$instance = wp_parse_args( $instance, $this->defaults );

		// Make sure empty callbacks aren't passed for custom functions.
		$instance['topic_count_text_callback']  = !empty( $instance['topic_count_text_callback']  ) ? $instance['topic_count_text_callback']  : '';
		$instance['topic_count_scale_callback'] = !empty( $instance['topic_count_scale_callback'] ) ? $instance['topic_count_scale_callback'] : 'default_topic_count_scale';

		// If the separator is empty, set it to the default new line.
		$instance['separator'] = !empty( $instance['separator'] ) ? $instance['separator'] : "\n";

		// Overwrite the echo argument.
		$instance['echo'] = false;

		// Output the sidebar's $before_widget wrapper.
		echo $args['before_widget'];

		// If a title was input by the user, display it.
		if ( ! empty( $instance['title'] ) )
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];


		// Get the tag cloud.
		$tags = str_replace( array( "\r", "\n", "\t" ), ' ', wp_tag_cloud( $instance ) );

		// If $format should be flat, wrap it in the <p> element.
		if ( 'flat' == $instance['format'] ) {
			$classes = array( 'term-cloud', 'tagcloud' );

			foreach ( (array)$instance['taxonomy'] as $tax )
				$classes[] = sanitize_html_class( "{$tax}-cloud" );

			$tags = '<div class="' . join( $classes, ' ' ) . '">' . $tags . '</div>';
		}

		else if ( 'round' == $instance['format'] ) {
			$classes = array( 'term-cloud', 'tagcloud', 'rounded-corners' ); // Added tagcloud default WP class.

			foreach ( (array)$instance['taxonomy'] as $tax )
				$classes[] = sanitize_html_class( "{$tax}-cloud" );

			$tags = '<div class="' . join( $classes, ' ' ) . '">' . $tags . '</div>';
		}

		// Output the tag cloud.
		echo $tags;

		// Close the sidebar's widget wrapper.
		echo $args['after_widget'];
	}
}// end Tag_Widget class

/**
 * Intiate Tag_Widget Class.
 *
 * @since 1.0.0
 */
function ew_tags_register() {
	register_widget( 'EW_Tags' );
}
add_action( 'widgets_init', 'ew_tags_register' );
