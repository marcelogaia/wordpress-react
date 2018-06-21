<?php
/**
 * The Catch Instagram Feed Gallery Widget Helper of the plugin.
 *
 * @link       catchplugins.com
 * @since      1.0.0
 *
 * @package    Catch_Instagram_Feed_Gallery_Widget
 * @subpackage Catch_Instagram_Feed_Gallery_Widget/includes
 */

/**
 * The Catch Instagram Feed Gallery Widget Helper of the plugin.
 *
 * @package    Catch_Instagram_Feed_Gallery_Widget
 * @subpackage Catch_Instagram_Feed_Gallery_Widget/includes
 * @author     Catch Plugins <info@catchplugins.com>
 */
class Catch_Instagram_Feed_Gallery_Widget_Helper {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $public_url    The url to get feed from.
	 */
	private $url = 'https://api.instagram.com/v1/';

	/**
	 * Get Media and return in JSON format.
	 *
	 * @param string $type Account type.
	 *
	 * @param string $user Username.
	 *
	 * @param string $limit Count.
	 *
	 * @return json
	 */
	function get_media( $user = null, $limit = null ) {
		if ( isset( $_POST['pagination_link'] ) ) {
			$url = $_POST['pagination_link'];
		} else {
			$options = catch_instagram_feed_gallery_widget_get_options( 'catch_instagram_feed_gallery_widget_options' );
			$token   = $options['access_token'];
			$url     = $this->url . 'users/self/media/recent/?access_token=' . esc_html( $token ) . '&count=' . absint( $limit );
	    } // End if().
	    $json = self::get_remote_data_from_instagram_in_json( $url );
	    return $json;
	}

	/**
	 * Parse user media json
	 *
	 * @param string $url URL.
	 *
	 * @return json
	 */
	function get_remote_data_from_instagram_in_json( $url ) {
	    $content = wp_remote_get( $url, array(
	    	'timeout'     => 100,
	    	)
	    );

	    if ( isset( $content->errors ) ) {
	        $content = array(
	        	'meta' => array(
	        		'error_message' => $content->errors['http_request_failed']['0'],
	        		 ),
	        	);
	        return $content;
	    } else {
	    	if ( 'Invalid User' === $content['body'] ) {
	    		$json = array(
	    			'meta' => array(
	    				'error_message' => $content['body'],
	    				),
	    			);
	    	} else {
				$response = wp_remote_retrieve_body( $content );
				$json     = json_decode( $response, true );
	        }
	        return $json;
	    }
	}

	/**
	 * Convert json data to HTML
	 *
	 * @param  array $options Widget/Shortcode options.
	 */
	function display( $options ) {
	    $data = $this->get_media( $options['username'], $options['number'] );
	    $output = '';
		if ( ! $data ) {
			$output .= esc_html__( 'No Data', 'catch-instagram-feed-gallery-widget' );
			return $output;
		} elseif ( isset( $data['meta']['error_message'] ) ) {
			if ( isset( $data['meta']['error_type'] ) ) {
				$output .= esc_html__( 'Provide API access token / Username', 'catch-instagram-feed-gallery-widget' );
				return $output;
			} else {
				$output .= esc_html( $data['meta']['error_message'] );
				return $output;
			}
		} else {
	    	if ( ( isset( $options['title'] ) && ! empty( $options['title'] ) ) && ( isset( $options['element'] ) && 'shortcode' === $options['element'] ) ) {
	    		$output .= '<h2>' . esc_html( $options['title'] ) . '</h2>';
	    	}
	    	$grid_class = '';

	    	$catch_instagram_feed_gallery_widget_class = 'default';

	    	$output .= '<input type="hidden" name="catch-instagram-feed-gallery-widget-ajax-nonce" id="catch-instagram-feed-gallery-widget-ajax-nonce" value="' . esc_attr( wp_create_nonce( 'catch-instagram-feed-gallery-widget-ajax-nonce' ) ) . '" />';
	    	$output .= '<div class="catch-instagram-feed-gallery-widget-wrapper ' . esc_attr( $catch_instagram_feed_gallery_widget_class ) . '">';
			$output .= '<div class="catch-instagram-feed-gallery-widget-image-wrapper">';

			$key = 'data';
			$next_url = isset( $data['pagination']['next_url'] ) ? $data['pagination']['next_url'] : '';

			if ( 0 === count( $data[ $key ] ) ) {
				$output .= esc_html__( 'No data / Invalid Username / Private Account', 'catch-instagram-feed-gallery-widget' );
				return;
			}
			$output .= '<ul>';
			foreach ( $data[ $key ] as $src ) {
				$output .= '<li class="item">';
				$caption = $src['caption']['text'] ? $src['caption']['text'] : '';

				if ( 'video' === $src['type'] ) {
					if ( 'thumbnail' == $options['size'] ) {
						$options['size'] = 'low_resolution';
					}
					$output .= '<a class="pretty" href="' . esc_url( $src['link'] ) . '" target="_blank"><i class="overlay-icon dashicons dashicons-video-alt3"></i>
						    	<img class="cifgw" src="' . esc_url( $src['images'][ $options['size'] ]['url'] ) . '" alt="' . esc_attr( $caption ) . '" />
						    	<span class="cifgw-overlay"></span>
						    </a>';
				} else {

					$output .= '<a class="pretty" href="' . esc_url( $src['link'] ) . '" target="_blank">
					    	<img class="cifgw" src="' . esc_url( $src['images'][ $options['size'] ]['url'] ) . '" alt="' . esc_html( $caption ) . '" />
					    	<span class="cifgw-overlay"></span>
					    </a>';
				}
				$output .= '</li>';
			}
			$output .= '</ul>';
			if ( isset( $next_url ) && '' !== $next_url ) {
				$link = $next_url;
			}

			$output .= '</div>';

			$link = '//instagram.com/' . esc_html( $options['username'] );
			$output .= '<p class="instagram-button"><a class="button" href="' . esc_url( $link ) . '" target="_blank"> ' . esc_html__( 'View on Instagram', 'catch-instagram-feed-gallery-widget' ) . '</a></p>';
			$output .= '</div>';

	        // Return the HTML block.
	        return $output;
		} // End if().
	}

	/**
	 * Text transform to sentence case
	 *
	 * @param string $string Layout of the widget.
	 */
	function sentence_case( $string ) {
		$new_string = '';
	    $sentences = preg_split( '/([.?!]+)/', $string, -1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );
	    foreach ( $sentences as $key => $sentence ) {
	        $new_string .= ( $key & 1 ) == 0?
	            ucfirst( strtolower( trim( $sentence ) ) ) :
	            $sentence . ' ';
	    }
	    return trim( $new_string );
	}
}
