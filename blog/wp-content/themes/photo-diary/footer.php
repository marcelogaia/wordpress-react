<?php
/**
 * The template for displaying the footer
 *
 * Close the .site-content div
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.0.8
 */

?>

</section> <!-- .site-content -->

<footer class="site-socket" role="contentinfo">
		<?php
			get_template_part('template-parts/footer-nav');
		?>
		<p>
			&copy; <?php echo esc_html( date_i18n( __( 'Y', 'photo-diary' ) ) ); ?> <?php bloginfo( 'name' );?> |
    		<?php echo photo_diary_footer_credit(); ?>
    	</p>
</footer> <!-- footer .site-socket -->

<?php wp_footer(); ?>
</body>
</html> 
