<?php
/**
 * Perfect Portfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Perfect_Portfolio
 */

//define theme version
if ( ! defined( 'PERFECT_PORTFOLIO_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();	
	define ( 'PERFECT_PORTFOLIO_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Standalone Functions.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Template Functions.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom functions for selective refresh.
 */
require get_template_directory() . '/inc/partials.php';

/**
 * Custom Controls
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Metabox
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Typography Functions
 */
require get_template_directory() . '/inc/typography.php';

/**
 * Raratheme companion Functions
 */
if( perfect_portfolio_is_rtc_activated() ) {
	require get_template_directory() . '/inc/rtc-filters.php';
}
/**
 * Dynamic Styles
 */
require get_template_directory() . '/css/style.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Add theme compatibility function for woocommerce if active
*/
if( perfect_portfolio_is_woocommerce_activated() ){
    require get_template_directory() . '/inc/woocommerce-functions.php';    
}