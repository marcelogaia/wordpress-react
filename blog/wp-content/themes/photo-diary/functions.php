<?php
/**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0.9
 */
// var_dump(get_theme_mod('photo_diary_show_header_on_posts' ));
/**
 * Enqueue styles and scripts
 */
function photo_diary_scripts() {

	// normalize.css.
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' );

	// Google Fonts / Josefin Slab.
	wp_enqueue_style( 'photo_diary-google-fonts', 'https://fonts.googleapis.com/css?family=Josefin+Slab:300,400,600,700', false );

	// font-awesome.min.css.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );

	// style.css.
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// html5shiv.
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js', '', '', false );

	// Respond-JS.
	wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.js', '', '', false );

	// JS Theme Functions.
	wp_enqueue_script( 'jquery-photo_diary_theme_functions', get_template_directory_uri() . '/js/jquery-photo_diary_theme_functions.js', array( 'jquery' ), '', false );

	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}

};
add_action( 'wp_enqueue_scripts', 'photo_diary_scripts' );


function photo_diary_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'photo_diary_add_editor_styles' );




/**
 * Setup theme defauls and register support for various WordPress features.
 */
function photo_diary_theme_setup() {

	// Make Photo-Diary available for translation. Translations can be added to the /languages/ directory.
	load_theme_textdomain( 'photo-diary', get_template_directory() . '/languages' );

	// Register Navigations.
	register_nav_menu( 'nav_main', esc_html__( 'Main Navigation', 'photo-diary' ) );

	// Register Navigations.
	register_nav_menu('nav_footer', esc_html__('Footer Navigation', 'photo-diary'));

	// Set Title-Tag in Header.
	add_theme_support( 'title-tag' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 450,
		'height'      => 110,
		'flex-width'  => true,
	) );

	// Adding serval sizes for Post Thumbnails.
	add_image_size( 'photo-diary-header', 2000, 350, array( 'center', 'center' ) );
	add_image_size( 'photo-diary-standard-post', 950, 366, array( 'center', 'center' ) );
	add_image_size( 'photo-diary-featured-overlay', 950, 540, array( 'center', 'center' ) );
	add_image_size( 'photo-diary-full-content-width', 650, 325, array( 'center', 'center' ) );

	/**
	* The following will add a new image size option to the list of selectable sizes in the Media Library.
	*/
	function photo_diary_my_custom_sizes( $sizes ) {
	    return array_merge( $sizes, array(
	        'photo-diary-standard-post' => esc_html__( 'Standard Post', 'photo-diary' ),
	        'photo-diary-featured-overlay' => esc_html__( 'Featured Overlay', 'photo-diary' ),
	        'photo-diary-full-content-width' => esc_html__( 'Full Content Width', 'photo-diary' ),
	    ) );
	}
	add_filter( 'image_size_names_choose', 'photo_diary_my_custom_sizes' );

	// Custom Header.
	add_theme_support( 'custom-header', array(
		'width'                  => 2000,
		'height'                 => 530,
		'flex-height'            => false,
		'flex-width'             => true,
		'default-image' 		 => get_template_directory_uri() . '/img/photo-diary-default-header.jpg',
	) );

	// Register Default Header Image.
	register_default_headers( array(
    	'default-image' => array(
	        'url'           => get_template_directory_uri() . '/img/photo-diary-default-header.jpg',
	        'thumbnail_url' => get_template_directory_uri() . '/img/photo-diary-default-header.jpg',
	        'description'   => esc_html__( 'Default Header Image', 'photo-diary' ),
    	),
	) );

	// Add HTMl5 Mark-Up.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add Custom Background.
	add_theme_support( 'custom-background', array(
		'default-color' => 'fafafa',
	) );

	/**
	 * Footer Credit
	 */
	function photo_diary_footer_credit() {

		$credit = esc_html( get_theme_mod( 'photo_diary_footer_credit' ) );

		if ( empty( $credit ) ) {
			$credit = 'Powered by WordPress - Theme: Photo-Diary ' . esc_html__( 'by', 'photo-diary' ) . ' <a class="theme-author" rel="nofollow" target="_blank" href="https://www.sitko-designing.de">Sitko-Designing</a>';
		}
		else {
			$credit = esc_html( get_theme_mod( 'photo_diary_footer_credit' ) );
			$credit .= '<br>';
			$credit .= 'Theme: Photo-Diary ' . esc_html__( 'by', 'photo-diary' ) . ' <a class="theme-author" rel="nofollow" target="_blank" href="https://www.sitko-designing.de">Sitko-Designing</a>';
		}

		return $credit;
	}

}
add_action( 'after_setup_theme', 'photo_diary_theme_setup' );



/**
 * Register sidebars
*/
function photo_diary_sidebar_widget() {

	// Blog Sidebar.
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'photo-diary' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__( 'These widgets are displayed on the blog or posts', 'photo-diary' ),
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="blog-sidebar sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Page Sidebar.
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'photo-diary' ),
		'id'            => 'page-sidebar',
		'description'   => esc_html__( 'These widgets are displyes on pages', 'photo-diary' ),
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="page-sidebar sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'photo_diary_sidebar_widget' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function photo_diary_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'photo_diary_pingback_header' );


// Set Default Content width.
if ( ! isset( $content_width ) ) {
	$content_width = 1350;
}

/**
 * Set the excerept lenght
 */
function photo_diary_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 110;
}
add_filter( 'excerpt_length', 'photo_diary_excerpt_length', 999 );

/**
 * Set excerept since
 */
function photo_diary_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
    return '...';
}
add_filter( 'excerpt_more', 'photo_diary_excerpt_more' );

/**
 * Change Tag-Cloud font-size
 */
function photo_diary_set_tag_cloud_font_size( $args ) {
	$args['unit'] = 'rem';
    $args['smallest'] = .8;
    $args['largest'] = 1.25;
    return $args;
}
add_filter( 'widget_tag_cloud_args','photo_diary_set_tag_cloud_font_size' );


/**
* Load Layout Templates
*/
require_once( get_template_directory() . '/inc/site_layout.php' );

/**
* Load Customizer
*/
require_once( get_template_directory() . '/inc/customizer.php' );

/**
 * Added class to the body classes array, when in customizer is choosen the full header style.
 */
function photo_diary_body_class( $classes ) {

	if ( 'header-fullwidth' == get_theme_mod( 'photo_diary_headerstyle' ) ) {
		$classes[] = 'header-fullwidth';
	}

	if ( 'hide-header-on-posts' == get_theme_mod( 'photo_diary_show_header_on_posts' ) ) {
		$classes[] = 'hide-header-on-posts';
	}

	return $classes;

}
add_filter( 'body_class', 'photo_diary_body_class' );


/**
* Add Custom Customizer CSS
*/
function photo_diary_customize_css() {
    ?>
	<style type="text/css">

		<?php if ( '' != get_theme_mod( 'photo_diary_primary_color' ) ) { ?>
			a, .btn-primary, .deco-dash-wrapper:hover .btn-normal, .bypostauthor a:hover, .main-nav li:hover > a, 
			.info-bar .social-media a:hover, #comments .bypostauthor a, .wpcf7-form .wpcf7-submit, .nf-form-layout input[type=button], div.wpforms-container-full .wpforms-form button[type=submit]{
				color: <?php echo esc_html( get_theme_mod( 'photo_diary_primary_color' ) ); ?>;
			}
		<?php } ?>

		<?php if ( '' != get_theme_mod( 'photo_diary_primary_color' ) ) { ?>
			input[type=submit]:hover, .underline-primary, .entry-title:after, .deco-dash-wrapper:hover .deco-dash, mark, ::selection, .main-nav .current-menu-item:after, .entry-content hr, .searchform .search-submit:hover, .nf-form-layout input[type=button]:hover, div.wpforms-container-full .wpforms-form button[type=submit]:hover {
				background: <?php echo esc_html( get_theme_mod( 'photo_diary_primary_color' ) ); ?>;
			}
		<?php } ?>

		<?php if ( '' != get_theme_mod( 'photo_diary_primary_color' ) ) { ?>
			input:focus, textarea:focus, select:focus, option:focus, #comments .bypostauthor, .sticky {
				border-color: <?php echo esc_html( get_theme_mod( 'photo_diary_primary_color' ) ); ?>;
			}
		<?php } ?>

		<?php if ( '' != get_theme_mod( 'photo_diary_link_hover_color' ) ) { ?>
			a:hover{
				color: <?php echo esc_html( get_theme_mod( 'photo_diary_link_hover_color' ) ); ?>;
			}
		<?php } ?>
		
	</style>
    <?php
}
add_action( 'wp_head', 'photo_diary_customize_css' );
