<?php

/**
 * Displays the Footer Navigation
 *
 * @link https://developer.wordpress.org/reference/functions/wp_nav_menu/
 *
 * @package Photo Diary
 * @since Photo Diary 1.1.1
 * @version 1.1.1
 */

?>

<div id="footer-nav" class="fluid-container">
    <nav class="footer-nav" role="navigation">
        <?php
    $args = array(
        'theme_location' => 'nav_footer',
        'depth' => 1,
        'container' => '',
        'fallback_cb' => null,
    );
    wp_nav_menu($args);
    ?>
    </nav><!-- .footer-nav -->
</div><!-- #footer-nav .fluid-container -->
