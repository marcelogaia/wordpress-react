<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0
 */

?>

<?php get_header(); ?>

	<?php photo_diary_site_layout( 'top' ); ?>

		<section class="site-error">

			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'photo-diary' )?></h1>
			</header><!-- .page-header -->

			<div class="entry-content">
				<p><?php esc_html_e( 'Probably it&rsquo;s just a typing mistake or the page has been renamed, that happens sometimes.', 'photo-diary' )?></p>
				<p><?php esc_html_e( 'Perhaps searching can help.', 'photo-diary' )?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->

		</section><!-- section .site-error -->

	<?php photo_diary_site_layout( 'bottom' ); ?>

<?php get_footer();
