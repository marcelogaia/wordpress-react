<?php
/**
 * @link              catchplugins.com
 * @since             1.0
 * @package           Catch_Gallery
 *
 * @wordpress-plugin
 * Plugin Name: Catch Gallery
 * Plugin URI:  https://catchplugins.com/plugins/catch-gallery/
 * Description: Catch Gallery allows you to add three different types of layouts (in addition to the default layout provided by WordPress – Thumbnail Grid) for your galleries to stand out—Tiled Mosaic, Square Tiles, Circles.
 * Version:     1.0.1
 * Author:      Catch Plugins
 * Author URI:  catchplugins.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: catch-gallery
 * Tags:        catch-gallery, gallery, tiled gallery, image gallery, mosaic, carousel, lightbox, media, jetpack, jetpack lite
 * Domain Path: /languages
 */

/*
Copyright (C) 2018 Catch Plugins, (info@catchplugins.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

if ( ! defined( 'CATCH_GALLERY_VERSION' ) ) {
	define( 'CATCH_GALLERY_VERSION', '1.0.1' );
}

function catch_gallery_load_textdomain() {
  load_plugin_textdomain( 'catch-gallery', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'catch_gallery_load_textdomain' );


// Include admin part.
include( plugin_dir_path( __FILE__ ) . 'admin/admin.php' );

include( plugin_dir_path( __FILE__ ) . 'inc/functions.php' );

include( plugin_dir_path( __FILE__ ) . 'inc/tiled-gallery.php' );

include( plugin_dir_path( __FILE__ ) . 'inc/jetpack-carousel.php' );
