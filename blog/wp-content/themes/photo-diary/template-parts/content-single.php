<?php
/**
 * Template part for displaying posts in single.php
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
			<?php the_time( get_option( 'date_format' ) ); ?>
		</div>
		<a href="<?php the_permalink();?>"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></a>
		
		<?php if ( has_post_thumbnail() && 'hide-header-on-posts' == get_theme_mod( 'photo_diary_show_header_on_posts' ) ) { ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'photo-diary-standard-post' ); ?></a>
		<?php } ?>
		
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'photo-diary' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<p class="bypostauthor"><?php esc_html_e( 'written by', 'photo-diary' );?> <?php the_author();?> - <?php esc_html_e( 'Posted in', 'photo-diary' );?> <?php the_category( ', ', 'single' );?></p>
		<p class="bypostauthor"><?php the_tags(); ?></p>
	</footer><!-- .entry-footer -->

	<div class="post-pagination">
		<?php
			$prev_format = '<span class="prev">%link</span>';
			$prev_link = '&#10229; ' . __( 'Previous Post', 'photo-diary' );

			$next_format = '<span class="next">%link</span>';
			$next_link = __( 'Next Post', 'photo-diary' ) . ' &#10230;';

			previous_post_link( $prev_format, $prev_link );
			next_post_link( $next_format, $next_link );
		?>
	</div><!-- .post-pagination -->

	<?php comments_template();?>

</article><!-- #post-## .site-article-->
