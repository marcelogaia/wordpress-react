<?php
/**
 * The template for adding Custom Sidebars and Widgets
 *
 * @package Essential_Widgets
 */

// Load Archives Widget
include plugin_dir_path( __FILE__ ) . 'class-ew-archives.php';

// Load Authors Widget
include plugin_dir_path( __FILE__ ) . 'class-ew-authors.php';

// Load Categories Widget
include plugin_dir_path( __FILE__ ) . 'class-ew-categories.php';

// Load Menu Widget
include plugin_dir_path( __FILE__ ) . 'class-ew-menus.php';

// Load Pages Widget
include plugin_dir_path( __FILE__ ) . 'class-ew-pages.php';

// Load Posts Widget
include plugin_dir_path( __FILE__ ) . 'class-ew-posts.php';

// Load Tags Widget
include plugin_dir_path( __FILE__ ) . 'class-ew-tags.php';
