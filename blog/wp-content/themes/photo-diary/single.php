<?php
/**
 * Default template for single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
	    
	    	<?php get_template_part( 'template-parts/content', 'single' );?>
	        
	    <?php endwhile; ?>

	    <?php else : ?>
	    
	    	<?php get_template_part( 'template-parts/content','none' );?>
		        
	    <?php endif; ?>

	<?php photo_diary_site_layout( 'bottom' ); ?>

<?php get_footer();
