<?php
/**
 * Custom Author Widget
 *
 * @package Essential_Widgets
 */


/**
 * Custom Author Widget
 */
class EW_Authors extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	function __construct() {

		// Set up the defaults.
		$topic_count_text = _n_noop( '%s topic', '%s topics', 'essential-widgets' );

		// Set up defaults.
		$this->defaults = array(
			'title'         => esc_attr__( 'Authors', 'essential-widgets' ),
			'order'         => 'ASC',
			'orderby'       => 'display_name',
			'number'        => '',
			'include'       => '',
			'exclude'       => '',
			'optioncount'   => false,
			'exclude_admin' => false,
			'show_fullname' => true,
			'hide_empty'    => true,
			'style'         => 'list',
			'html'          => true,
			'feed'          => '',
			'feed_type'     => '',
			'feed_image'    => ''
		);

		$widget_ops = array(
			'classname'   => 'essential-widgets ew-author ewauthor',
			'description' => esc_html__( 'Displays a list of author', 'essential-widgets' ),
		);

		$control_ops = array(
			'id_base' => 'ew-author'
		);

		parent::__construct(
			'ew-author', // Base ID
			__( 'EW: Authors', 'essential-widgets' ), // Name
			$widget_ops,
			$control_ops
		);
	}

	function form($instance) {
		// Merge the user-selected arguments with the defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$order = array(
			'ASC'  => esc_attr__( 'Ascending',  'essential-widgets' ),
			'DESC' => esc_attr__( 'Descending', 'essential-widgets' )
		);

		$orderby = array(
			'display_name' => esc_attr__( 'Display Name', 'essential-widgets' ),
			'email'        => esc_attr__( 'Email',        'essential-widgets' ),
			'ID'           => esc_attr__( 'ID',           'essential-widgets' ),
			'nicename'     => esc_attr__( 'Nice Name',    'essential-widgets' ),
			'post_count'   => esc_attr__( 'Post Count',   'essential-widgets' ),
			'registered'   => esc_attr__( 'Registered',   'essential-widgets' ),
			'url'          => esc_attr__( 'URL',          'essential-widgets' ),
			'user_login'   => esc_attr__( 'Login',        'essential-widgets' )
		);

		$style = array(
			'list' => esc_attr__( 'List', 'essential-widgets'),
			'none' => esc_attr__( 'Plain', 'essential-widgets' )
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
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php echo esc_attr( $this->defaults['title'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Order:', 'essential-widgets' ); ?>

				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php esc_attr( $this->get_field_name( 'order' ) ); ?>">

					<?php foreach ( $order as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['order'], $option_value ); ?>><?php echo esc_html($option_label ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Order By:', 'essential-widgets' ); ?>

				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">

					<?php foreach ( $orderby as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['orderby'], $option_value ); ?>><?php echo esc_html($option_label ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Number:', 'essential-widgets' ); ?>
				<input type="number" class="widefat code" size="5" min="0" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>" placeholder="0" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Display as:', 'essential-widgets' ); ?>

				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">

					<?php foreach ( $style as $option_value => $option_label ) : ?>

						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['style'], $option_value ); ?>><?php echo esc_html($option_label ); ?></option>

					<?php endforeach; ?>

				</select>
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Include:', 'essential-widgets' ); ?>
				<input type="text" class="widefat code" name="<?php echo esc_attr( $this->get_field_name( 'include' ) ); ?>" value="<?php echo esc_attr( $instance['include'] ); ?>" placeholder="1,2,3&hellip;" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Exclude:', 'essential-widgets' ); ?>
				<input type="text" class="widefat code" name="<?php echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>" value="<?php echo esc_attr( $instance['exclude'] ); ?>" placeholder="1,2,3&hellip;" />
			</label>
		</p>

		<p class="button-primary more"><?php esc_html_e( 'More Options', 'essential-widgets' ); ?><i class="dashicons dashicons-arrow-down"></i></p>

		<div class="advanced-section">

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
				<input type="text" class="widefat code" name="<?php echo esc_attr( $this->get_field_name( 'feed' ) ); ?>" value="<?php echo esc_attr( $instance['feed'] ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php esc_html_e( 'Feed Image:', 'essential-widgets' ); ?>
				<input type="url" class="widefat code" name="<?php echo esc_attr( $this->get_field_name( 'feed_image' ) ); ?>" value="<?php echo esc_attr( $instance['feed_image'] ); ?>" placeholder="<?php echo esc_attr( home_url( 'images/example.png' ) ); ?>" />
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" <?php checked( $instance['html'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'html' ) ); ?>" />
				<?php esc_html_e( 'HTML?', 'essential-widgets' ); ?>
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" <?php checked( $instance['optioncount'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'optioncount' ) ); ?>" />
				<?php esc_html_e( 'Show post count?', 'essential-widgets' ); ?>
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" <?php checked( $instance['exclude_admin'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'exclude_admin' ) ); ?>" />
				<?php esc_html_e( 'Exclude admin?', 'essential-widgets' ); ?>
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" <?php checked( $instance['show_fullname'], true ); ?> name="<?php echo esc_attr( $this->get_field_name( 'show_fullname' ) ); ?>" />
				<?php esc_html_e( 'Show full name?', 'essential-widgets' ); ?>
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
		$instance['feed']  = strip_tags( $new_instance['feed']  );

		// Whitelist options.
		$order     = array( 'ASC', 'DESC' );
		$orderby   = array( 'display_name', 'email', 'ID', 'nicename', 'post_count', 'registered', 'url', 'user_login' );
		$style     = array( 'list', 'none' );
		$feed_type = array( '', 'atom', 'rdf', 'rss', 'rss2' );

		$instance['order']     = in_array( $new_instance['order'], $order )     ? $new_instance['order']   : 'ASC';
		$instance['orderby']   = in_array( $new_instance['orderby'], $orderby ) ? $new_instance['orderby'] : 'display_name';
		$instance['style']     = in_array( $new_instance['style'], $style )     ? $new_instance['style']   : 'list';
		$instance['feed_type'] = in_array( $new_instance['feed_type'], $feed_type ) ? $new_instance['feed_type'] : '';

		// Integers.
		$instance['number'] = intval( $new_instance['number'] );

		// Only allow integers and commas.
		$instance['include'] = preg_replace( '/[^0-9,]/', '', $new_instance['include'] );
		$instance['exclude'] = preg_replace( '/[^0-9,]/', '', $new_instance['exclude'] );

		// URLs.
		$instance['feed_image'] = esc_url_raw( $new_instance['feed_image'] );

		// Checkboxes.
		$instance['html']          = isset( $new_instance['html'] )          ? 1 : 0;
		$instance['optioncount']   = isset( $new_instance['optioncount'] )   ? 1 : 0;
		$instance['exclude_admin'] = isset( $new_instance['exclude_admin'] ) ? 1 : 0;
		$instance['show_fullname'] = isset( $new_instance['show_fullname'] ) ? 1 : 0;
		$instance['hide_empty']    = isset( $new_instance['hide_empty'] )    ? 1 : 0;

		// Return sanitized options.
		return $instance;
	}

	function widget( $args, $instance ) {
		// Set the $args for wp_list_authors() to the $instance array.
		$instance = wp_parse_args( $instance, $this->defaults );

		// instance the $echo argument and set it to false.
		$instance['echo'] = false;

		// Output the args's $before_widget wrapper.
		echo $args['before_widget'];

		// If a title was input by the user, display it.
		if ( ! empty( $instance['title'] ) )
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];

		// Get the authors list.
		$authors = str_replace( array( "\r", "\n", "\t" ), '', wp_list_authors( $instance ) );

		$authors = str_replace('</a> (', '</a> <span>(', $authors);
	  	$authors = str_replace(')', ')</span>', $authors);

		// If 'list' is the style and the output should be HTML, wrap the authors in a <ul>.
		if ( 'list' == $instance['style'] && $instance['html'] )
			$authors = '<ul class="authors">' . $authors . '</ul><!-- .xoxo .authors -->';

		// If 'none' is the style and the output should be HTML, wrap the authors in a <p>.
		elseif ( 'none' == $instance['style'] && $instance['html'] )
			$authors = '<p class="authors">' . $authors . '</p><!-- .authors -->';

		// Display the authors list.
		echo $authors;

		// Close the args's widget wrapper.
		echo $args['after_widget'];
	}
}// end Author_Widget class

/**
 * Intiate Author_Widget Class.
 *
 * @since 1.0.0
 */
function ew_authors_register() {
	register_widget( 'EW_Authors' );
}
add_action( 'widgets_init', 'ew_authors_register' );
