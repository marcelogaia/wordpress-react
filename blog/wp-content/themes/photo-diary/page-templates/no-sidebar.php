<?php
/**
 * Template Name: No Sidebar
 *
 * Description: A page template for a No-Sidebar Page
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0
 */

get_header(); ?>

	<?php photo_diary_site_layout( 'top' ); ?>

		<?php
			// start loop.
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	    
	    	<?php get_template_part( 'template-parts/content', 'page' );?>
	        
	    <?php endwhile; else : ?>
	    
	    	<?php get_template_part( 'template-parts/content','none' );?>
		        
	    <?php endif; ?>

	<?php photo_diary_site_layout( 'bottom' ); ?>

<?php get_footer();
