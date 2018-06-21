<?php
/**
 * Template part for displaying search results
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'site-article' ); ?>>

	<header class="entry-header">
		<div class="meta date">
			<?php the_time( 'j. F Y' );?>
		</div>
		<a href="<?php the_permalink();?>"><?php the_title( '<h2 class="entry-title">', '</h2>' ); ?></a>
		<?php
		if ( has_post_thumbnail() ) {
		?>
			<a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'photo-diary-standard-post' ); ?></a>
		<?php
	    }
	    ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
			the_excerpt();
		?>
		
	</div><!-- .entry-content -->

	<div class="entry-footer">
		<div class="deco-dash-wrapper">
			<div class="deco-dash"></div>
			<a class="btn btn-normal" href="<?php the_permalink();?>"><?php esc_html_e( 'Read more', 'photo-diary' );?></a>
		</div>
		<p class="bypostauthor"><?php esc_html_e( 'written by', 'photo-diary' );?> <?php the_author();?> - <?php esc_html_e( 'Posted in', 'photo-diary' );?> <?php the_category( ', ', 'single' );?></p>

	</div><!-- .entry-footer -->

</article><!-- #post-## .site-article -->
