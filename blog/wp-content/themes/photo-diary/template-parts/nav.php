<?php
/**
 * Displays the Main Navigation
 *
 * @link https://developer.wordpress.org/reference/functions/wp_nav_menu/
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0.9
 */

?>

<div class="nav-bar">
	<div class="fluid-container">

        <div class="site-logo">

             <a href="<?php echo esc_url( home_url() ); ?>">
                <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) :
                    the_custom_logo();
                 else : ?>
            <span class="display"><?php bloginfo( 'name' );?></span>
            <span class="description"><?php bloginfo( 'description' );?></span>
            <hr class="underline-primary">
                <?php endif; ?>
            </a>

        </div><!-- .site-logo -->

        <button class="main-nav-icon main-nav-icon-X">
            <span></span>
        </button>

        <nav class="main-nav" role="navigation">
        	<?php
            $args = array(
                'theme_location' => 'nav_main',
                'depth' => 3,
                'container' => '',
                'fallback_cb' => 'wp_page_menu',
            );
			wp_nav_menu( $args );
			?>
        </nav><!-- .main-nav -->

	</div>
</div><!-- .nav-bar -->
