<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
	    
	    	<?php get_template_part( 'template-parts/content', get_post_format() );?>
	        
	    <?php endwhile; ?>

	    <?php
	    	// numeric pagination.
       		the_posts_pagination( array(
			    'mid_size' => 2,
			    'prev_text' => esc_html__( 'Back', 'photo-diary' ),
			    'next_text' => esc_html__( 'Next Page', 'photo-diary' ),
			    'screen_reader_text' => ' ',
			    'before_page_number' => '',
			) );
	   	?>

		<?php else : ?>
	    
	    	<?php get_template_part( 'template-parts/content','none' );?>
	        
	    <?php endif; ?>

	<?php photo_diary_site_layout( 'bottom' ); ?>
	
<?php get_footer();
