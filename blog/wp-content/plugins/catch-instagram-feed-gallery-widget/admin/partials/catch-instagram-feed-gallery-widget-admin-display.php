<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       catchplugins.com
 * @since      1.0.0
 *
 * @package    Catch_Instagram_Feed_Gallery_Widget
 * @subpackage Catch_Instagram_Feed_Gallery_Widget/admin/partials
 */

?>
<?php
	$username = '';
	$catch_instagram_feed_gallery_widget_page = admin_url( 'admin.php?page=catch_instagram_feed_gallery_widget' );
	$catch_instagram_feed_gallery_widget_page_redirect = $catch_instagram_feed_gallery_widget_page . '&response_type=token';
?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Instagram Feed Gallery and Widget', 'catch-instagram-feed-gallery-widget' ); ?></h1>

	<?php if ( ! get_option( 'catch_instagram_feed_gallery_widget_dismiss' ) ) : ?>

		<div id="welcome-panel" class="welcome-panel">
			<a class="welcome-panel-close button dismiss" href="<?php echo esc_url( menu_page_url( 'catch-instagram-feed-gallery-widget', false ) ); ?>"><?php esc_html_e( 'Dismiss', 'catch-instagram-feed-gallery-widget' ); ?></a>

			<div class="welcome-panel-content">
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h3><img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . '../images/catch-instagram-feed-gallery-widget.svg' ); ?>" /><?php esc_html_e( 'Welcome to Instagram Feed Gallery and Widget Settings', 'catch-instagram-feed-gallery-widget' ); ?></h3>

						<p><?php esc_html_e( 'Instagram Feed Gallery & Widget Plugin adds the posts from your Instagram account that you want to showcase on your website.', 'catch-instagram-feed-gallery-widget' ); ?></p>

						<p><?php esc_html_e( 'You can add Instagram Feed as Gallery or Widget on your website. Simply either drag-and-drop the plugin in the widget area or you can add a shortcode from your WordPress dashboard if you want to place a copy of your Instagram feed directly onto your post/page.', 'catch-instagram-feed-gallery-widget' ); ?></p>
					</div>
				</div>
			</div>
		</div>

	<?php endif; // End if(). ?>

	<div class="catchp-content-wrapper">
		<div class="catchp_widget_settings">
			<form id="catch-instagram-feed-gallery-widget-main" method="post" action="options.php">

				<h2 class="nav-tab-wrapper">
					<a class="nav-tab nav-tab-active" id="dashboard-tab" href="#dashboard"><?php esc_html_e( 'Dashboard', 'catch-instagram-feed-gallery-widget' ); ?></a>
					<a class="nav-tab" id="features-tab" href="#features"><?php esc_html_e( 'Features', 'catch-instagram-feed-gallery-widget' ); ?></a>
					<a class="nav-tab" id="premium-extensions-tab" href="#premium-extensions"><?php esc_html_e( 'Compare Table', 'catch-instagram-feed-gallery-widget' ); ?></a>
				</h2>

				<div id="dashboard" class="wpcatchtab  nosave active">

					<div id="public-usage" class="content-wrapper">
						<div class="header">
							<h3><?php esc_html_e( 'Add Instagram Feed as Gallery or Widget', 'catch-instagram-feed-gallery-widget' ); ?></h3>

						</div><!-- .header -->
						<div class="content">
							<div class="as-widget">
								<p><strong><?php esc_html_e( '1. Add using Widget via our Instagram Widget', 'catch-instagram-feed-gallery-widget' ); ?></strong></p>
								<p><a class="button" href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>"><?php esc_html_e( 'Go to Widgets', 'catch-instagram-feed-gallery-widget' ); ?></a></p>
							</div><!-- .as-widget -->
							<div class="as-shortcode">
								<p><strong><?php esc_html_e( '2. Add using Shortcode in Page/Post ', 'catch-instagram-feed-gallery-widget' ); ?></strong></p>
								<div class="shortcode-option-container">
									<div>
										<p><?php esc_html_e( 'Add in New:', 'catch-instagram-feed-gallery-widget' ); ?></p>
										<a class="button" href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>"><?php esc_html_e( 'Post' ); ?></a> / <a class="button" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=page' ) ); ?>"><?php esc_html_e( 'Page' ); ?></a>
									</div>
									<div>
										<p><?php esc_html_e( 'Add in Existing:', 'catch-instagram-feed-gallery-widget' ); ?></p><a class="button" href="<?php echo esc_url( admin_url( 'edit.php' ) ); ?>"><?php esc_html_e( 'Post' ); ?></a> / <a class="button" href="<?php echo esc_url( admin_url( 'edit.php?post_type=page' ) ); ?>"><?php esc_html_e( 'Page' ); ?></a>
									</div>
								</div><!-- .shortcode-option-container -->
							</div><!-- .as-shortcode -->
						</div><!-- .content -->
					</div><!-- #public-usage.content-wrapper -->


					<?php settings_fields( 'catch-instagram-feed-gallery-widget-group' );
					$catch_instagram_feed_gallery_widget_options = catch_instagram_feed_gallery_widget_get_options( 'catch_instagram_feed_gallery_widget_options' );
					if ( isset( $_GET['access_token'] ) ) {
					    $access_token = sanitize_text_field( wp_unslash( $_GET['access_token'] ) );
					} elseif ( isset( $catch_instagram_feed_gallery_widget_options['access_token'] ) && ( '' !== $catch_instagram_feed_gallery_widget_options['access_token'] ) ) {
					    $access_token = $catch_instagram_feed_gallery_widget_options['access_token'];
					} else {
					    $access_token = '';
					}
					?>

					<?php
					if ( isset( $access_token ) && '' !== $access_token ) {
						$re_data = Catch_Instagram_Feed_Gallery_Widget_Admin::update_data( $access_token );

					}

					if ( isset( $catch_instagram_feed_gallery_widget_options['username'] ) && ! empty( $catch_instagram_feed_gallery_widget_options['username'] ) ) {
						$username = $catch_instagram_feed_gallery_widget_options['username'];
					}

					if ( isset( $_GET['q'] ) && 'form-reset' === $_GET['q'] ) {
						if( delete_option( 'catch_instagram_feed_gallery_widget_options' ) ){
							$re_data['message'] = esc_html__( 'Options reset successfully.', 'catch-instagram-feed-gallery-widget' );
							$re_data['type'] = 'notice-success';
						}else{
							$re_data['message'] = esc_html__( 'Reset failed, please try again', 'catch-instagram-feed-gallery-widget' );
							$re_data['type'] = 'notice-error';
						}
					}
					?>

				    <div id="access-token" class="content-wrapper">
					    <div class="header">
					    	<h2><?php esc_html_e( 'Get Access Token', 'catch-instagram-feed-gallery-widget' ); ?></h2>

					    </div><!-- .header -->
					    <div class="content">
					    	<p class="info wp-ui-highlight"><span class="dashicons dashicons-info"></span> <?php esc_html_e( 'You can show instagram feed from any Private instagram accounts by providing the Access Token. This section allows you to set API parameters.', 'catch-instagram-feed-gallery-widget' ); ?></p>
					    	<?php $options = get_option( 'catch_instagram_feed_gallery_widget_options' );
					    		$username = isset( $options['username'] ) ? $options['username'] : '' ;
					    		$user_id = isset( $options['user_id'] ) ? $options['user_id'] : '' ;
					    		$access_token = isset( $options['access_token'] ) ? $options['access_token'] : '' ;
					    	if ( $username && $access_token ) : ?>
						    	<p>You are logged in as <strong><?php echo esc_html( $username ); ?></strong></p>
						    	<p>and your access token is</p>
						    	<p><strong class="dont-break-out"><?php echo esc_html( $access_token ); ?></strong></p>
					    	<?php endif; ?>
					    	<?php if ( '' === $username || '' === $access_token ) : ?>
					    		<a class="button button-large get-token" href="https://api.instagram.com/oauth/authorize/?client_id=54da896cf80343ecb0e356ac5479d9ec&scope=basic+public_content&redirect_uri=http://api.web-dorado.com/instagram/?return_url=<?php echo esc_attr( $catch_instagram_feed_gallery_widget_page_redirect );?>"><?php esc_html_e( 'Get Access Token', 'catch-instagram-feed-gallery-widget' ) ?></a>
					    	<?php else : ?>

					    		<a class="button button-large reset-token" id="catch-instagram-feed-gallery-widget-reset" href="<?php echo esc_attr( $catch_instagram_feed_gallery_widget_page ) . '&q=form-reset'; ?>"><?php esc_html_e( 'Reset Access Token', 'catch-instagram-feed-gallery-widget' ) ?></a>
					    	<?php endif; ?>
					    	<?php if( isset( $_GET['q'] ) || isset( $_GET['access_token'] ) ): ?>
						    	<div class="notice <?php echo esc_attr( $re_data['type'] ); ?>">
								    <p><?php echo esc_html( $re_data['message'] ); ?></p>
								</div>
							<?php endif; ?>
						</div><!-- .content -->
				    </div><!-- #access-token.content-wrapper -->

					<div id="go-premium" class="content-wrapper col-2">

						<div class="header">
							<h2><?php esc_html_e( 'Go Premium!', 'catch-instagram-feed-gallery-widget' ); ?></h2>
						</div> <!-- .Header -->

						<div class="content">
							<button type="button" class="button dismiss">
								<span class="screen-reader-text"><?php esc_html_e( 'Dismiss this item.', 'catch-instagram-feed-gallery-widget' ); ?></span>
								<span class="dashicons dashicons-no-alt"></span>
							</button>
							<ul class="catchp-lists">
								<li><strong><?php esc_html_e( 'Show feeds by Hashtag', 'catch-instagram-feed-gallery-widget' ); ?></strong></li>
								<li><strong><?php esc_html_e( 'Layout Options: Option to choose from 1. Masonry layout 2. Grid layout 3. Round layout', 'catch-instagram-feed-gallery-widget' ); ?></strong></li>
								<li><strong><?php esc_html_e( 'Column Options (2 to 8 columns)', 'catch-instagram-feed-gallery-widget' ); ?></strong></li>
								<li><strong><?php esc_html_e( 'Load More option', 'catch-instagram-feed-gallery-widget' ); ?></strong></li>
								<li><strong><?php esc_html_e( 'Lightbox', 'catch-instagram-feed-gallery-widget' ); ?></strong></li>
								<li><strong><?php esc_html_e( 'Link to image in instagram', 'catch-instagram-feed-gallery-widget' ); ?></strong></li>
								<li><strong><?php esc_html_e( 'Hide Load more', 'catch-instagram-feed-gallery-widget' ); ?></strong></li>
								<li><strong><?php esc_html_e( 'Editable load more', 'catch-instagram-feed-gallery-widget' ); ?></strong></li>
								<li><strong><?php esc_html_e( 'Padding in-between', 'catch-instagram-feed-gallery-widget' ); ?></strong></li>
								<li><strong><?php esc_html_e( 'Likes &amp; Comments count', 'catch-instagram-feed-gallery-widget' ); ?></strong></li>
								<li><strong><?php esc_html_e( 'Catch Instagram Feed Gallery Widget Shortcode Generator button in Post/Page', 'catch-instagram-feed-gallery-widget' ); ?>
								</strong></li>
								<li><strong><?php esc_html_e( 'Toggle link to instagram post', 'catch-instagram-feed-gallery-widget' ); ?></strong></li>
							</ul>

							<a href="https://catchplugins.com/plugins/catch-instagram-feed-gallery-widget-pro/" target="_blank"><?php esc_html_e( 'Find out why you should upgrade to Instagram Feed Gallery and Widget Premium »', 'catch-instagram-feed-gallery-widget' ); ?></a>
						</div> <!-- .Content -->
					</div> <!-- #go-premium -->

					<div id="pro-screenshot" class="content-wrapper col-4">

						<div class="header">
							<h2><?php esc_html_e( 'Pro Screenshot', 'catch-instagram-feed-gallery-widget' ); ?></h2>
						</div> <!-- .Header -->

						<div class="content">
							<ul class="catchp-lists">
								<li><img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . '../images/screenshot-1.jpg' ); ?>"></li>
								<li><img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . '../images/screenshot-2.jpg' ); ?>"></li>
								<li><img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . '../images/screenshot-3.jpg' ); ?>"></li>
								<li><img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . '../images/screenshot-4.jpg' ); ?>"></li>
							</ul>
						</div> <!-- .Content -->
					</div> <!-- #pro-screenshot -->

					<div id="request-queries" class="content-wrapper">
						<div class="content">
							<?php

							echo '<span class="dashicons dashicons-editor-help"></span>' .
							sprintf(
								wp_kses( __( 'If you have any request queries, please visit <a href="%s" target="_blank">this link</a>.', 'catch-instagram-feed-gallery-widget' ), array(
										'a' => array(
											'href' => array(),
											'target' => array(),
										),
									)
								),
								'https://catchplugins.com/contact-us/'
							);
							?>
						</div>
					</div> <!-- .request-queries -->

				</div><!-- .dashboard -->

				<div id="features" class="wpcatchtab save">
					<div class="content-wrapper col-3">
						<div class="header">
							<h3><?php esc_html_e( 'Features', 'catch-instagram-feed-gallery-widget' ); ?></h3>

						</div><!-- .header -->
						<div class="content">
							<ul class="catchp-lists">
								<li>
									<strong><?php esc_html_e( 'Masonry', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'Catch Instagram Feed Gallery &amp; Widget Pro allows you to showcase your Instagram feed in Masonry layout. It’s a type of grid layout that easily supports items of variable size. So, you don’t have to worry if your Instagram images’ sizes vary from one another, the masonry layout in our Catch Instagram Feed Gallery &amp; Widget plugin will show your images in an elegant way, without showing the unnecessary gaps.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Lightbox', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'Catch Instagram Feed Gallery &amp; Widget Pro supports Lightbox by default. If you click on any of the image or video, then you will get the nice piece of Lightbox overlay. In this overlay window, you can watch the video, and navigate to other images on Instagram.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Round Thumbnail', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'Round Thumbnail layout will showcase the thumbnails of your Instagram photos in a round format. With the round thumbnail enabled in Catch Instagram Feed Gallery &amp; Widget Pro plugin, your Instagram feed’s thumbnails will be displayed in a very stylish and playful manner.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Grid Thumbnail', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'Your Instagram feed’s thumbnails will be shown in a grid layout in this mode. Grids are known for keeping your content organized. In the same way here, the grid thumbnail will keep your Instagram feed well-organized and display them in a clean and effective way.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Likes and Comments Count', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'Catch Instagram Feed Gallery &amp; Widget Pro allows you to display the number of likes and comments on your Instagram feed. When you hover your mouse cursor over a specific Instagram post, it will show the number of likes and comments on the respective image.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Multiple Instagram Feeds with no Limitations', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'You have the freedom to showcase multiple Instagram feeds and that too without any limitations. Displaying the multiple Instagram feeds have never been so convenient.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Super Simple to Set Up', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'It is super easy to set up. Even the beginners can set it up easily and also, you do not need to have any coding knowledge. Just install, activate, customize it your way and enjoy the plugin.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Responsive Design', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'One of the key features of our plugins is that your website will magically respond and adapt to different screen sizes delivering an optimized design for iPhones, iPads, and other mobile devices. No longer will you need to zoom and scroll around when browsing on your mobile phone.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Incredible Support', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'We have a great line of support team and support documentation. You do not need to worry about how to use the plugins we provide, just refer to our Tech Support Forum. Further, if you need to do advanced customization to your website, you can always hire our theme customizer!', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Display by Tags', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'You can choose to showcase the content using the tags of any public account. The option is an alternative option to display the content if you don’t have the username ID of any specific public account.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Image Sizes', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'You can choose the size of the images you want to display. You can either choose to display the thumbnail, small, or large size of the images.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Padding In-between Options', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'You have the freedom to place padding in-between your images. Enabling it will create a fine gap in-between your images and display them more neatly and elegantly.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Widgets', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'Multitude of widget options provide you with the option to choose the widgets that you want to display. You can have full control over each widget’s visibility and appearance. You can assign different contents on your sidebars, footer and any sidebar widgets.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Shortcodes', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'With Shortcodes, you have the option to use the powerful shortcode options to style multiple contents in completely different ways.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Number of Posts', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'You have the option to choose the number of posts you want to display on your website. Pick the number of posts that suits the best on your website.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Editable Load More', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'The Load More button is editable. It means you can always edit the text on “Load More” option. Add your own customized text on the Load More button and make your content more playful.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Load More Option', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'Load More—the name says it all. You have the option to display a button that will enable you to view the entire gallery on your website.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Column Option', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'Column Option allows you to choose from multiple column options. Several options are available for all column types in general to edit the default behavior.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>

								<li>
									<strong><?php esc_html_e( 'Layout Option', 'catch-instagram-feed-gallery-widget' ); ?></strong>
									<p><?php esc_html_e( 'Layout Option gives you the freedom to choose how you want to display your content. With multiple layout options, spice up the look of your website and make it more happening.', 'catch-instagram-feed-gallery-widget' ); ?></p>
								</li>
							</ul>
							<a href="https://catchplugins.com/plugins/catch-instagram-feed-gallery-widget-pro/" target="_blank"><?php esc_html_e( 'Upgrade to Instagram Feed Gallery and Widget Premium »', 'catch-instagram-feed-gallery-widget' ); ?></a>
						</div><!-- .content -->
					</div><!-- content-wrapper -->
				</div> <!-- Featured -->

				<div id="premium-extensions" class="wpcatchtab  save">

					<div class="about-text">
						<h2><?php esc_html_e( 'Get Instagram Feed Gallery and Widget Pro -', 'catch-instagram-feed-gallery-widget' ); ?> <a href="https://catchplugins.com/plugins/catch-instagram-feed-gallery-widget-pro/" target="_blank"><?php esc_html_e( 'Get It Here!', 'catch-instagram-feed-gallery-widget' ); ?></a></h2>
						<p><?php esc_html_e( 'You are currently using the free version of Instagram Feed Gallery and Widget.', 'catch-instagram-feed-gallery-widget' ); ?><br />
<a href="https://catchplugins.com/plugins/" target="_blank"><?php esc_html_e( 'If you have purchased from catchplugins.com, then follow this link to the installation instructions (particularly step 1).', 'catch-instagram-feed-gallery-widget' ); ?></a></p>
					</div>

					<div class="content-wrapper">
						<div class="header">
							<h3><?php esc_html_e( 'Premium/Extensions', 'catch-instagram-feed-gallery-widget' ); ?></h3>

						</div><!-- .header -->
						<div class="content">

							<table class="widefat fixed striped posts">
								<thead>
									<tr>
										<th id="title" class="manage-column column-title column-primary"><?php esc_html_e( 'Features', 'catch-instagram-feed-gallery-widget' ); ?></th>
										<th id="free" class="manage-column column-free"><?php esc_html_e( 'Free', 'catch-instagram-feed-gallery-widget' ); ?></th>
										<th id="pro" class="manage-column column-pro"><?php esc_html_e( 'Pro', 'catch-instagram-feed-gallery-widget' ); ?></th>
									</tr>
								</thead>

								<tbody id="the-list" class="ui-sortable">
									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Responsive Design', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-green">&#10003;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Super Easy Setup', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-green">&#10003;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Lightweight', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-green">&#10003;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Multiple Instagram Feeds', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-green">&#10003;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Display By Username', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-green">&#10003;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Number of posts', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-green">&#10003;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Select image sizes', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-green">&#10003;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'View on Instagram link', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-green">&#10003;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Shortcode', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-green">&#10003;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Widgets', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-green">&#10003;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Display By Tags', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-red">&#215;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Layout Options', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-red">&#215;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Column Option', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-red">&#215;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Load More Option', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-red">&#215;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Lightbox', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-red">&#215;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Link to Post Option', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-red">&#215;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Hide Load More', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-red">&#215;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Editable load more/view on instagram text', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-red">&#215;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Padding in-between', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-red">&#215;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Likes &amp; Comments count', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-red">&#215;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>

									<tr class="iedit author-self level-0 type-post status-publish format-standard hentry">
										<td>
											<strong><?php esc_html_e( 'Ads-free Dashboard', 'catch-instagram-feed-gallery-widget' ); ?></strong>
										</td>
										<td class="column column-free"><div class="table-icons icon-red">&#215;</div></td>
										<td class="column column-pro"><div class="table-icons icon-green">&#10003;</div></td>
									</tr>
								</tbody>

							</table>

						</div><!-- .content -->
					</div><!-- content-wrapper -->
				</div>

			</form><!-- #catch-instagram-feed-gallery-widget-main -->

		</div><!-- .catchp_widget_settings -->


		<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . '/partials/sidebar.php'; ?>
	</div> <!-- .catchp-content-wrapper -->

	<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . '/partials/footer.php'; ?>
</div><!-- .wrap -->
