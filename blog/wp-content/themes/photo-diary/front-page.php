<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will appear.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0
 */

?>
 
<?php get_header(); ?>

	<?php photo_diary_site_layout( 'top' ); ?>

		<?php
		// start loop.
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php if ( 'posts' == get_option( 'show_on_front' ) ) : ?>
	    
	    		<?php get_template_part( 'template-parts/content', get_post_format() );?>

	    	<?php else : ?>

	    		<?php get_template_part( 'template-parts/content', 'page' );?>

	    	<?php endif; ?>
	        
	    <?php endwhile;  ?>

	    <?php if ( 'posts' == get_option( 'show_on_front' ) ) {

	    	 // numeric pagination.
       		the_posts_pagination( array(
		    	'mid_size' => 2,
		    	'prev_text' => esc_html__( 'Back', 'photo-diary' ),
		    	'next_text' => esc_html__( 'Next Page', 'photo-diary' ),
		    	'screen_reader_text' => ' ',
		    	'before_page_number' => '',
			) );

    	}

    	?>

	    <?php else : ?>
	    
	    	<?php get_template_part( 'template-parts/content','none' );?>
	        
	    <?php endif; ?>

	<?php photo_diary_site_layout( 'bottom' ); ?>


<?php get_footer();
