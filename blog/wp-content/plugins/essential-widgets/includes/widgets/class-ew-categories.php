<?php
/**
 * Custom Category Widget
 *
 * @package Essential_Widgets
 */


/**
 * Custom Category Widget
 */
class EW_Categories extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	function __construct() {

		$this->defaults = array(
			'title'              => esc_attr__( 'Categories', 'essential-widgets' ),
			'taxonomy'           => 'category',
			'style'              => 'list',
			'include'            => '',
			'exclude'            => '',
			'exclude_tree'       => '',
			'child_of'           => '',
			'current_category'   => '',
			'search'             => '',
			'hierarchical'       => true,
			'hide_empty'         => true,
			'order'              => 'ASC',
			'orderby'            => 'name',
			'depth'              => 0,
			'number'             => '',
			'feed'               => '',
			'feed_type'          => '',
			'feed_image'         => '',
			'use_desc_for_title' => false,
			'show_count'         => false,
		);

		$widget_ops = array(
			'classname'   => 'essential-widgets widget_categories ew-category ewcategory',
			'description' => esc_html__( 'Displays a list of categories', 'essential-widgets' ),
		);

		$control_ops = array(
			'id_base' => 'ew-category'
		);

		parent::__construct(
			'ew-category', // Base ID
			__( 'EW: Categories', 'essential-widgets' ), // Name
			$widget_ops,
			$control_ops
		);
	}

		function form($instance) {
		// Merge the user-selected arguments with the defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// <select> element options.
		$taxonomies = get_taxonomies( array( 'show_tagcloud' => true ), 'objects' );
		$terms      = get_terms( $instance['taxonomy'] );

		$style = array(
			'list' => esc_attr__( 'List', 'essential-widgets' ),
			'none' => esc_attr__( 'None', 'essential-widgets' )
		);

		$order = array(
			'ASC'  => esc_attr__( 'Ascending',  'essential-widgets' ),
			'DESC' => esc_attr__( 'Descending', 'essential-widgets' )
		);

		$orderby = array(
			'count'      => esc_attr__( 'Count',      'essential-widgets' ),
			'ID'         => esc_attr__( 'ID',         'essential-widgets' ),
			'name'       => esc_attr__( 'Name',       'essential-widgets' ),
			'slug'       => esc_attr__( 'Slug',       'essential-widgets' ),
			'term_group' => esc_attr__( 'Term Group', 'essential-widgets' )
		);

		$feed_type = array(
			''     => '',
			'atom' => esc_attr__( 'Atom',    'essential-widgets' ),
			'rdf'  => esc_attr__( 'RDF',     'essential-widgets' ),
			'rss'  => esc_attr__( 'RSS',     'essential-widgets' ),
			'rss2' => esc_attr__( 'RSS 2.0', 'essential-widgets' )
		); ?>

		<p>
			<label>
				<?php esc_html_e( 'Title:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php echo esc_attr( $this->defaults['title'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Taxonomy:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'taxonomy' ) ); ?>">

					<?php foreach ( $taxonomies as $taxonomy ) : ?>

						<option value="<?php echo esc_attr( $taxonomy->name ); ?>" <?php selected( $instance['taxonomy'], $taxonomy->name ); ?>><?php echo esc_html( $taxonomy->labels->singular_name ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Style:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">

					<?php foreach ( $style as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['style'], $option_value ); ?>><?php echo esc_html($option_label ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Order:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">

					<?php foreach ( $order as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['order'], $option_value ); ?>><?php echo esc_html($option_label ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Order By:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">

					<?php foreach ( $orderby as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['orderby'], $option_value ); ?>><?php echo esc_html($option_label ); ?></option>

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
				<?php esc_html_e( 'Child Of:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'child_of' ) ); ?>" value="<?php echo esc_attr( $instance['child_of'] ); ?>" placeholder="0" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Current Category:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'current_category' ) ); ?>" value="<?php echo esc_attr( $instance['current_category'] ); ?>" placeholder="0" />
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
				<?php esc_html_e( 'Feed Type:', 'essential-widgets' ); ?>

				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'feed_type' ) ); ?>">

					<?php foreach ( $feed_type as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['feed_type'], $option_value ); ?>><?php echo esc_html($option_label ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Feed Text:', 'essential-widgets' ); ?>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'feed' ) ); ?>" value="<?php echo esc_attr( $instance['feed'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Feed Image:', 'essential-widgets' ); ?>
				<input type="url" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'feed_image' ) ); ?>" value="<?php echo esc_attr( $instance['feed_image'] ); ?>" placeholder="<?php echo esc_attr( home_url( 'images/example.png' ) ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" <?php checked( $instance['hierarchical'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'hierarchical' ) ); ?>" />
				<?php esc_html_e( 'Hierarchical?', 'essential-widgets' ); ?>
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" <?php checked( $instance['use_desc_for_title'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'use_desc_for_title' ) ); ?>" />
				<?php esc_html_e( 'Show description on hover?', 'essential-widgets' ); ?>
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
				<input type="checkbox" <?php checked( $instance['hide_empty'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'hide_empty' ) ); ?>" />
				<?php esc_html_e( 'Hide empty?', 'essential-widgets' ); ?>
			</label>
		</p>

		</div><!-- .advanced-section -->

		<div style="clear:both;">&nbsp;</div>


		<?php
	}

	function update( $new_instance, $old_instance ) {

		// If new taxonomy is chosen, reset includes and excludes.
		if ( $new_instance['taxonomy'] !== $old_instance['taxonomy'] )
			$new_instance['include'] = $new_instance['exclude'] = '';

		// Sanitize key.
		$instance['taxonomy'] = sanitize_key( $new_instance['taxonomy'] );

		// Sanitize title.
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		// Strip tags.
		$instance['search'] = strip_tags( $new_instance['search']           );
		$instance['feed']   = strip_tags( $new_instance['feed']             );

		// Whitelist options.
		$order   = array( 'ASC', 'DESC' );
		$orderby = array( 'count', 'ID', 'name', 'slug', 'term_group' );
		$style   = array( 'list', 'none' );
		$feed_type = array( '', 'atom', 'rdf', 'rss', 'rss2' );

		$instance['order']     = in_array( $new_instance['order'],     $order )     ? $new_instance['order']     : 'ASC';
		$instance['orderby']   = in_array( $new_instance['orderby'],   $orderby )   ? $new_instance['orderby']   : 'name';
		$instance['style']     = in_array( $new_instance['style'],     $style )     ? $new_instance['style']     : 'list';
		$instance['feed_type'] = in_array( $new_instance['feed_type'], $feed_type ) ? $new_instance['feed_type'] : '';

		// Integers.
		$instance['number']           = intval( $new_instance['number']           );
		$instance['depth']            = absint( $new_instance['depth']            );
		$instance['child_of']         = absint( $new_instance['child_of']         );
		$instance['current_category'] = absint( $new_instance['current_category'] );

		// Only allow integers and commas.
		$instance['include']      = preg_replace( '/[^0-9,]/', '', $new_instance['include']      );
		$instance['exclude']      = preg_replace( '/[^0-9,]/', '', $new_instance['exclude']      );
		$instance['exclude_tree'] = preg_replace( '/[^0-9,]/', '', $new_instance['exclude_tree'] );

		// URLs.
		$instance['feed_image'] = esc_url_raw( $new_instance['feed_image'] );

		// Checkboxes.
		$instance['hierarchical']       = isset( $new_instance['hierarchical'] )       ? 1 : 0;
		$instance['use_desc_for_title'] = isset( $new_instance['use_desc_for_title'] ) ? 1 : 0;
		$instance['show_count']         = isset( $new_instance['show_count'] )         ? 1 : 0;
		$instance['hide_empty']         = isset( $new_instance['hide_empty'] )         ? 1 : 0;

		// Return sanitized options.
		return $instance;
	}

	function widget( $args, $instance ) {
		// Set the $args for wp_list_categories() to the $instance array.
		$instance = wp_parse_args( $instance, $this->defaults );

		// Set the $title_li and $echo arguments to false.
		$instance['title_li'] = false;
		$instance['echo']     = false;

		// Output the args's $before_widget wrapper.
		echo $args['before_widget'];

		// If a title was input by the user, display it.
		if ( ! empty( $instance['title'] ) )
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];

		// Get the categories list.
		$categories = str_replace( array( "\r", "\n", "\t" ), '', wp_list_categories( $instance ) );

		$categories = str_replace('</a> (', '</a> <span>(', $categories);
  		$categories = str_replace(')', ')</span>', $categories);

		// If 'list' is the user-selected style, wrap the categories in an unordered list.
		if ( 'list' == $instance['style'] )
			$categories = '<ul class="categories">' . $categories . '</ul><!-- .categories -->';

		// If no style is given, wrap in a <p> tag for formatting.
		else
			$categories = '<p class="categories style-none">' . $categories . '</p>';

		// Output the categories list.
		echo $categories;

		// Close the args's widget wrapper.
		echo $args['after_widget'];
	}
}// end Category_Widget class

/**
 * Intiate Category_Widget Class.
 *
 * @since 1.0.0
 */
function ew_categories_register() {
	register_widget( 'EW_Categories' );
}
add_action( 'widgets_init', 'ew_categories_register' );
