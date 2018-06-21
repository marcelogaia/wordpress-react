<?php
/**
 * Template for displaying the standard search forms
 *
 * @link on -> https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0
 */

?>

<form method="get" class="searchform pos-relative" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input type="search" placeholder="<?php esc_html_e( ' Looking for', 'photo-diary' );?>..." name="s">
	<button type="submit" class="search-submit">
		<i class="fa fa-search"></i>
	</button>
</form><!-- form .searchform -->
