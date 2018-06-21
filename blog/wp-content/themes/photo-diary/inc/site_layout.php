<?php
/**
 * Main Layout Template
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0
 */

/**
 * @param string
*/
function photo_diary_site_layout( $position ) {

    // Load layout below the loop.
    if ( 'top' == $position ) {
?>
        <div class="container">
        	<div class="row">
        		<?php if ( 'sidebar-right' == get_theme_mod( 'photo_diary_sidebar_position', 'sidebar-right' ) && ! is_page_template( 'page-templates/no-sidebar.php' ) ) : ?>
        			<div class="small-4 medium-6 large-8 columns">
        				<main class="site-main sidebar-right" role="main">
        		<?php else : ?>
        			<div class="small-4 medium-6 large-12 columns">
        				<main class="site-main">
        		<?php endif; ?> 

        <?php
        // Load layout after the loop.
        } elseif ( 'bottom' == $position ) {
        ?>

        </main> <!-- .site-main -->
                </div><!-- grid -->
            <?php
                // Load Sidebar if position = right.
                if ( 'sidebar-right' == get_theme_mod( 'photo_diary_sidebar_position', 'sidebar-right' ) && ! is_page_template( 'page-templates/no-sidebar.php' ) ) {
                    get_sidebar();
                }
            ?>
            </div><!-- row -->
        </div><!-- container -->

    <?php
        }
    ?>

<?php
}
