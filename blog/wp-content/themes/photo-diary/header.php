<?php
/**
 * The header template of all files
 *
 * This is the template that displays all of the <head> section and everything up until <section id="site-content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> > 
<head>
    <meta charset="<?php bloginfo( 'charset' );?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class();?>>
    <div class="info-bar">
        <div id="search" class="search">
            <span class="fa fa-search search-icon"></span>
        </div>
        <?php
            get_template_part( 'template-parts/social-media' );
        ?>
    </div><!-- .info-bar -->

    <div class="search-input">
            <?php get_search_form(); ?>
    </div><!-- .search-input -->


    <div class="search-overlay"></div>

    <?php
        get_template_part( 'template-parts/nav' );
    ?>

    <?php if ( is_single() && has_post_thumbnail() || is_page() && has_post_thumbnail() ) { ?>

    <header class="site-header bei-is-single" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>');">

    </header><!-- .site-header -->
    <?php } else { ?>

    <?php if ( get_header_image() ) : ?>
        <header class="site-header bei-get-image" style="background-image: url('<?php header_image(); ?>');"></header><!-- .site-header -->
    <?php endif; ?>
    
    <?php } ?>

    <?php if ( get_header_image() ) : ?>
        <section class="site-content"> 
    <?php else : ?>
        <section class="site-content without-header">
    <?php endif; ?>
