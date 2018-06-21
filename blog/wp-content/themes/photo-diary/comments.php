<?php
/**
 * Template to show Comments
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0.9
 */

?> 

<?php

/*
 *
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */

if ( post_password_required() || ! comments_open() ) {
    return;
}
?>
<div class="deco-dash-wrapper">
    <div class="deco-dash"></div>
    <span class="btn btn-normal"><?php esc_html_e( 'Comments', 'photo-diary' ); ?></span>
</div>

<div id="comments" class="comments-area">
<?php if ( have_comments() ) : ?>
    <h2 class="comments-title">
        <?php
        $comment_count = get_comments_number();
        if ( 1 === $comment_count ) {
            printf(
                /* translators: 1: title. */
                esc_html_e( 'One thought on &ldquo;%1$s&rdquo;', 'photo-diary' ),
                '<span>' . get_the_title() . '</span>'
            );
        } else {
            printf( // WPCS: XSS OK.
                /* translators: 1: comment count number, 2: title. */
                esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'photo-diary' ) ),
                number_format_i18n( $comment_count ),
                '<span>' . get_the_title() . '</span>'
            );
        }
        ?>
    </h2><!-- .comments-title -->
<ol class="comment-list">
    <?php
        wp_list_comments( array(
            'style'       => 'ol',
            'short_ping'  => true,
            'avatar_size' => 40,
        ) );
    ?>
</ol><!-- .comment-list -->

<!-- comments pagination -->
<?php
// Are there comments to navigate through?
if ( get_comment_pages_count() >= 1 || get_option( 'page_comments' ) ) :

the_comments_navigation( array(
    'prev_text' => esc_html__( '&larr; Older Comments', 'photo-diary' ),
    'next_text' => esc_html__( 'Newer Comments &rarr;', 'photo-diary' ),
    'screen_reader_text' => esc_html__( 'Comment navigation', 'photo-diary' ),
) );
endif;
?>

<?php if ( ! comments_open() && get_comments_number() ) : ?>
<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'photo-diary' ); ?></p>
<?php endif; ?>


<!-- comments end -->
<?php endif; // have_comments(). ?>

<?php
$args = array(
	'class_submit' => 'btn btn-primary',
	);
?>

<?php comment_form( $args ); ?>
 
</div><!-- #comments -->
