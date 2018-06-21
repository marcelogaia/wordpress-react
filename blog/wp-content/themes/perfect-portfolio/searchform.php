<?php
/**
 * The template for displaying search form.
 *
 * @package Perfect_Portfolio
 */
?>
<form class="search-form" role="search" method="get" action="<?php echo esc_url( home_url('/') ); ?>">
		<input type="search" name="s" class="search-field" placeholder="<?php esc_attr_e( 'Search','perfect-portfolio' ); ?>" value="<?php echo get_search_query(); ?>"/>
	<label for="submit-field">
		<span class="fa fa-search"></span>
		<input type="submit" id="submit-field" name="submit" value="" class="search-submit">
	</label>
</form>