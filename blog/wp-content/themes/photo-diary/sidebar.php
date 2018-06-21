<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0
 */

?>

<div class="small-4 medium-6 large-4 columns">
	<aside class="sidebar" role="complementary">
	<?php

	if ( ! is_page() ) {
		if ( is_active_sidebar( 'blog-sidebar' ) ) {
			dynamic_sidebar( 'blog-sidebar' );
		}
	} else {
		if ( is_active_sidebar( 'page-sidebar' ) ) {
			dynamic_sidebar( 'page-sidebar' );
		}
	}

	?>
	</aside><!-- .sidebar -->
</div>
