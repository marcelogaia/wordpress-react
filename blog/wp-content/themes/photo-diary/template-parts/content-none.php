<?php
/**
 * Default template if a post or page cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0
 */

?>

<section class="site-error">

	<header class="entry-header">
		<h1 class="entry-title"><?php esc_html_e( 'Oops! There is something wrong.', 'photo-diary' ); ?></h1>
	</header><!-- .entry-header -->
	
	<div class="entry-content">
		<h3><?php esc_html_e( 'It seems can&rsquo;t find what you&rsquo;re looking for.', 'photo-diary' ); ?></h3>
		<p><?php esc_html_e( 'Perhaps searching can help.', 'photo-diary' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .entry-content -->

</section><!-- section-## .site-page --> 
