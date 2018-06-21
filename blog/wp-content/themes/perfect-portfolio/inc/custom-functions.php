<?php
/**
 * Perfect Portfolio Custom functions and definitions
 *
 * @package Perfect_Portfolio
 */

if ( ! function_exists( 'perfect_portfolio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function perfect_portfolio_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Perfect Portfolio, use a find and replace
	 * to change 'perfect-portfolio' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'perfect-portfolio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'perfect-portfolio' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'perfect_portfolio_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array( 'header-text' => array( 'site-title', 'site-description' ) ) );
 
    /**
     * Add Custom Images sizes.
    */    
    add_image_size( 'perfect-portfolio-schema', 600, 60 );    
    add_image_size( 'perfect-portfolio-article', 367, 252, true );
    add_image_size( 'perfect-portfolio-blog', 768, 726, true );
    add_image_size( 'perfect-portfolio-fullwidth', 1400, 700, true );
    add_image_size( 'perfect-portfolio-with-sidebar', 749, 516, true );
    add_image_size( 'perfect-portfolio-square', 800, 800, true );
    
    
    /** Starter Content */
    $starter_content = array(
        // Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array( 
                'home', 
                'blog',
                'portfolios' => array(
                    'post_type'  => 'page',
                    'post_title' => 'Portfolios',
                    'template'   => 'templates/portfolio.php',
                ),
        ),
		
        // Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
        
        // Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'primary' => array(
				'name' => __( 'Primary', 'perfect-portfolio' ),
				'items' => array(
					'page_home',
					'page_blog',
                    'page_portfolios'=> array(
                        'type'      => 'post_type',
                        'object'    => 'page',
                        'object_id' => '{{portfolios}}',
                    ),
				)
			)
		),
    );
    
    $starter_content = apply_filters( 'perfect_portfolio_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
    
    // Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );
}
endif;
add_action( 'after_setup_theme', 'perfect_portfolio_setup' );

if( ! function_exists( 'perfect_portfolio_content_width' ) ) :
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function perfect_portfolio_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'perfect_portfolio_content_width', 750 );
}
endif;
add_action( 'after_setup_theme', 'perfect_portfolio_content_width', 0 );

if( ! function_exists( 'perfect_portfolio_template_redirect_content_width' ) ) :
/**
* Adjust content_width value according to template.
*
* @return void
*/
function perfect_portfolio_template_redirect_content_width(){
	$sidebar = perfect_portfolio_sidebar();
    if( $sidebar ){	   
        $GLOBALS['content_width'] = 750;        
	}else{
        if( is_singular() ){
            if( perfect_portfolio_sidebar( true ) === 'full-width centered' ){
                $GLOBALS['content_width'] = 770;
            }else{
                $GLOBALS['content_width'] = 1400;                
            } 
        }else{
            $GLOBALS['content_width'] = 1400;
        }
    }
}
endif;
add_action( 'template_redirect', 'perfect_portfolio_template_redirect_content_width' );

if( ! function_exists( 'perfect_portfolio_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function perfect_portfolio_scripts(){
	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
        
    wp_enqueue_style( 'font-awesome', get_template_directory_uri(). '/css' . $build . '/font-awesome' . $suffix . '.css', array(), '4.7' );

    wp_enqueue_style( 'owl-theme-default', get_template_directory_uri(). '/css' . $build . '/owl.theme.default' . $suffix . '.css', array(), '2.2.1' );

    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css' . $build . '/owl.carousel' . $suffix . '.css', array(), '2.2.1' );

    wp_enqueue_style( 'perfect-portfolio-google-fonts', perfect_portfolio_fonts_url(), array(), null );

    wp_enqueue_style( 'perfect-scrollbar', get_template_directory_uri(). '/css'. $build .'/perfect-scrollbar'. $suffix .'.css', array(), '1.3.0' );
    
    wp_enqueue_style( 'perfect-portfolio-style', get_stylesheet_uri(), array(), PERFECT_PORTFOLIO_THEME_VERSION );

    if( perfect_portfolio_is_woocommerce_activated() ) {
        wp_enqueue_style( 'perfect-portfolio-woocommerce-style', get_template_directory_uri(). '/css' . $build . '/woocommerce-style' . $suffix . '.css', array( 'perfect-portfolio-style' ), PERFECT_PORTFOLIO_THEME_VERSION );
    }

    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array( 'jquery' ), '2.2.1', true );

    wp_enqueue_script( 'perfect-scrollbar', get_template_directory_uri() . '/js'. $build .'/perfect-scrollbar'. $suffix .'.js', array('jquery'), '1.3.0', true );

    wp_enqueue_script( 'isotope-pkgd', get_template_directory_uri() . '/js' . $build . '/isotope.pkgd' . $suffix . '.js', array( 'jquery' ), '3.0.5', true );

    wp_enqueue_script( 'imagesloaded-pkgd', get_template_directory_uri() . '/js' . $build . '/imagesloaded.pkgd' . $suffix . '.js', array( 'jquery' ), '4.1.4', true );

	wp_enqueue_script( 'perfect-portfolio-custom', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array( 'jquery' ), PERFECT_PORTFOLIO_THEME_VERSION, true );
    
    $array = array( 
        'rtl'       => is_rtl(),
        'ajax_url'  => admin_url( 'admin-ajax.php' ),
    );
    
    wp_localize_script( 'perfect-portfolio-custom', 'perfect_portfolio_data', $array );
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'perfect_portfolio_scripts' );

if( ! function_exists( 'perfect_portfolio_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function perfect_portfolio_admin_scripts(){
    wp_enqueue_style( 'perfect-portfolio-admin', get_template_directory_uri() . '/inc/css/admin.css', '', PERFECT_PORTFOLIO_THEME_VERSION );
}
endif; 
add_action( 'admin_enqueue_scripts', 'perfect_portfolio_admin_scripts' );

if( ! function_exists( 'perfect_portfolio_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function perfect_portfolio_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}
    
    $classes[] = perfect_portfolio_sidebar( true );

    if( is_front_page() ) {
        $classes[] = 'centered-content';
    }
    
	return $classes;
}
endif;
add_filter( 'body_class', 'perfect_portfolio_body_classes' );

if( ! function_exists( 'perfect_portfolio_post_classes' ) ) :
/**
 * Add custom classes to the array of post classes.
*/
function perfect_portfolio_post_classes( $classes ){

    $blog_page_layout = get_theme_mod( 'blog_page_layout', 'with-masonry-description grid' );

    if( ( is_home() ) && $blog_page_layout == 'with-masonry-description grid' ){
        $classes[] = 'grid-sizer';
    }
    
    return $classes;
}
endif;
add_filter( 'post_class', 'perfect_portfolio_post_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function perfect_portfolio_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'perfect_portfolio_pingback_header' );

if( ! function_exists( 'perfect_portfolio_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
*/
function perfect_portfolio_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );    
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><input id="author" name="author" placeholder="' . esc_attr__( 'Name*', 'perfect-portfolio' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'perfect-portfolio' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'perfect-portfolio' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'perfect_portfolio_change_comment_form_default_fields' );

if( ! function_exists( 'perfect_portfolio_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
*/
function perfect_portfolio_change_comment_form_defaults( $fields ){ 
    $comment_field = $fields['comment'];
    $fields['comment'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="40" rows="8" required="required" placeholder="' . esc_attr__( 'Comment','perfect-portfolio' ) . '"></textarea></p>';;
    
    return $fields;    
}
endif;
add_filter( 'comment_form_fields', 'perfect_portfolio_change_comment_form_defaults' );

if ( ! function_exists( 'perfect_portfolio_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function perfect_portfolio_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}

endif;
add_filter( 'excerpt_more', 'perfect_portfolio_excerpt_more' );

if ( ! function_exists( 'perfect_portfolio_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function perfect_portfolio_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'excerpt_length', 55 );
    return is_admin() ? $length : absint( $excerpt_length );    
}
endif;
add_filter( 'excerpt_length', 'perfect_portfolio_excerpt_length', 999 );

if( ! function_exists( 'perfect_portfolio_single_post_schema' ) ) :
/**
 * Single Post Schema
 *
 * @return string
 */
function perfect_portfolio_single_post_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'perfect-portfolio-schema' );
        $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $excerpt     = perfect_portfolio_escape_text_tags( $post->post_excerpt );
        $content     = $excerpt === "" ? mb_substr( perfect_portfolio_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
        $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

        $args = array(
            "@context"  => "http://schema.org",
            "@type"     => $schema_type,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id"   => get_permalink( $post->ID )
            ),
            "headline"  => get_the_title( $post->ID ),
            "image"     => array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            ),
            "datePublished" => get_the_time( DATE_ISO8601, $post->ID ),
            "dateModified"  => get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ),
            "author"        => array(
                "@type"     => "Person",
                "name"      => perfect_portfolio_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
            ),
            "publisher" => array(
                "@type"       => "Organization",
                "name"        => get_bloginfo( 'name' ),
                "description" => get_bloginfo( 'description' ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            ),
            "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
        );

        if ( has_post_thumbnail( $post->ID ) ) :
            $args['image'] = array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            );
        endif;

        if ( ! empty( $custom_logo_id ) ) :
            $args['publisher'] = array(
                "@type"       => "Organization",
                "name"        => get_bloginfo( 'name' ),
                "description" => get_bloginfo( 'description' ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            );
        endif;

        echo '<script type="application/ld+json">' , PHP_EOL;
        if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
            echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) , PHP_EOL;
        } else {
            echo wp_json_encode( $args ) , PHP_EOL;
        }
        echo '</script>' , PHP_EOL;
    }
}
endif;
add_action( 'wp_head', 'perfect_portfolio_single_post_schema' );

if( ! function_exists( 'perfect_portfolio_get_comment_author_link' ) ) :
/**
 * Filter to modify comment author link
 * @link https://developer.wordpress.org/reference/functions/get_comment_author_link/
 */
function perfect_portfolio_get_comment_author_link( $return, $author, $comment_ID ){
    $comment = get_comment( $comment_ID );
    $url     = get_comment_author_url( $comment );
    $author  = get_comment_author( $comment );
 
    if ( empty( $url ) || 'http://' == $url )
        $return = '<span itemprop="name">'. esc_html( $author ) .'</span>';
    else
        $return = '<span itemprop="name"><a href=' . esc_url( $url ) . ' rel="external nofollow" class="url" itemprop="url">' . esc_html( $author ) . '</a></span>';

    return $return;
}
endif;
add_filter( 'get_comment_author_link', 'perfect_portfolio_get_comment_author_link', 10, 3 );