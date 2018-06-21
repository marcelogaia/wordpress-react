<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0
 */

get_header(); ?>

	<?php photo_diary_site_layout( 'top' ); ?>

	<header class="page-header">
				<h2 class="page-title"><?php esc_html_e( 'Search result','photo-diary' ) ?> : <b><?php echo esc_html( $s ); ?></b></h2>
	</header><!-- .page-header -->

		<?php
			// start loop.
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		    
	    	<?php get_template_part( 'template-parts/content', 'search' );?>
		        
	    <?php endwhile; else : ?>
		    
	    	<?php get_template_part( 'template-parts/content','none' );?>
		        
	    <?php endif; ?>

	<?php photo_diary_site_layout( 'bottom' ); ?>	

<?php get_footer();
