<?php
/**
 * Displays the Social Media Icons in the info-bar on top
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0.9
 */

?>

<div class="social-media">

    <?php if ( '' != get_theme_mod( 'photo_diary_social_media_facebook', '' ) ) : ?>
    <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'photo_diary_social_media_facebook' ) ); ?>" title="Facebook"><span class="fa fa-facebook"></span></a>
    <?php endif; ?>

    <?php if ( '' != get_theme_mod( 'photo_diary_social_media_twitter', '' ) ) : ?>
    <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'photo_diary_social_media_twitter' ) ); ?>" title="Twitter"><span class="fa fa-twitter"></span></a>
    <?php endif; ?>

    <?php if ( '' != get_theme_mod( 'photo_diary_social_media_instagram', '' ) ) : ?>
    <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'photo_diary_social_media_instagram' ) ); ?>" title="Instagram"><span class="fa fa-instagram"></span></a>
    <?php endif; ?>

    <?php if ( '' != get_theme_mod( 'photo_diary_social_media_youtube', '' ) ) : ?>
    <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'photo_diary_social_media_youtube' ) ); ?>" title="Youtube"><span class="fa fa-youtube"></span></a>
    <?php endif; ?>

    <?php if ( '' != get_theme_mod( 'photo_diary_social_media_linkedin', '' ) ) : ?>
    <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'photo_diary_social_media_linkedin' ) ); ?>" title="LinkedIn"><span class="fa fa-linkedin"></span></a>
    <?php endif; ?>

    <?php if ( '' != get_theme_mod( 'photo_diary_social_media_xing', '' ) ) : ?>
    <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'photo_diary_social_media_xing' ) ); ?>" title="Xing"><span class="fa fa-xing"></span></a>
    <?php endif; ?>

    <?php if ( '' != get_theme_mod( 'photo_diary_social_media_behance', '' ) ) : ?>
    <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'photo_diary_social_media_behance' ) ); ?>" title="Behance"><span class="fa fa-behance"></span></a>
    <?php endif; ?>

    <?php if ( '' != get_theme_mod( 'photo_diary_social_media_500px', '' ) ) : ?>
    <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'photo_diary_social_media_500px' ) ); ?>" title="500px"><span class="fa fa-500px"></span></a>
    <?php endif; ?>

    <?php if ( '' != get_theme_mod( 'photo_diary_social_media_flickr', '' ) ) : ?>
    <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'photo_diary_social_media_flickr' ) ); ?>" title="Flickr"><span class="fa fa-flickr"></span></a>
    <?php endif; ?>

    <?php if ( '' != get_theme_mod( 'photo_diary_social_media_dribbble', '' ) ) : ?>
    <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'photo_diary_social_media_dribbble' ) ); ?>" title="Dribbble"><span class="fa fa-dribbble"></span></a>
    <?php endif; ?>

    <?php if ( '' != get_theme_mod( 'photo_diary_social_media_pinterest', '' ) ) : ?>
    <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'photo_diary_social_media_pinterest' ) ); ?>" title="Pinterest"><span class="fa fa-pinterest-p"></span></a>
    <?php endif; ?>

</div><!-- .social-media -->
