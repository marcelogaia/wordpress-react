<?php
/**
 * Adds Catch Instagram Feed Gallery Widget button to TinyMCE editor
 *
 * @link       catchplugins.com
 * @since      1.0.0
 *
 * @package    Catch_Instagram_Feed_Gallery_Widget
 * @subpackage Catch_Instagram_Feed_Gallery_Widget/includes
 */

/**
 * The Catch Instagram Feed Gallery Widget button to TinyMCE editor
 *
 * @package    Catch_Instagram_Feed_Gallery_Widget
 * @subpackage Catch_Instagram_Feed_Gallery_Widget/includes
 * @author     Catch Plugins <info@catchplugins.com>
 */
class Catch_Instagram_Feed_Gallery_Widget_Add_Editor_Button {

	/**
	 * Sets up thickbox and button
	 */
	public function __construct() {
		add_action( 'admin_footer', array( $this, 'thickbox_display' ) );
		add_action( 'media_buttons', array( $this, 'add_editor_button' ), 15 );
	}

	/**
	 * Add button to editor
	 */
	public function add_editor_button() {
	    global $pagenow;

	    $page_post_array = array( 'post-new.php', 'post.php' );

	    // Only run in post/page creation and edit screens.
	    if ( ! in_array( $pagenow, $page_post_array, true ) ) {
	        return;
	    }
	    add_thickbox();
	    echo '
	    <style>
	        #add-catch-instagram-feed-gallery-widget-shortcode:before {
	            vertical-align: middle;
	        }
	    </style>
	    <a href="#TB_inline?&inlineId=display-catch-instagram-feed-gallery-widget-shortcode&width=753&height=auto" id="add-catch-instagram-feed-gallery-widget-shortcode" class="thickbox button" title="' .
	            esc_attr__( 'Add Catch Instagarm Feed Gallery & Widget Shortcodes', 'catch-instagram-feed-gallery-widget' ) . '"><img src="' . esc_url( plugin_dir_url( __FILE__ ) . '../admin/images/catch-instagram-feed-gallery-widget.svg' ) . '" /></a>';
	}

	/**
	 * Adds Thickbox content to admin footer on page/post add and edit pages(includes CPT)
	 */
	public function thickbox_display() {
	    ?>
	    <script type="text/javascript">
	        jQuery(document).ready(function($){
	        	var prev_code;
	            if( undefined !== $('div#wp-content-editor-container textarea').val() ) {
	                prev_code = $('div#wp-content-editor-container textarea').val().match(/\[(catch-instagram-feed-gallery-widget.*)\]/);
	            }

				if ( undefined !== $('div#wp-content-editor-container textarea').val() ) {
					code = $('div#wp-content-editor-container textarea').val().match(/\[(catch-instagram-feed-gallery-widget.*)\]/);
					if( null != code ) {
						$('#catch_instargarm_insert_shortcode').html('Update Shortcode');
		                shortcode = '<' + code[1] + '>';
		                $(shortcode).each(function() {
		                    $.each(this.attributes, function(){
			                    // this.attributes is not a plain object, but an array
			                    // of attribute nodes, which contain both the name and value
		                        // Getting previous values
		                        // Type Select
		                        if ( 'size' === this.name ) {
		                            $('#catch_instagram_feed_gallery_widget_shortcode_size option[value='+this.value+']').attr('selected','selected');
		                        }
		                        // Type Text
		                        else {
		                        	$("input[name='"+this.name+"'").val(this.value);
		                        }
		                    });
		                });
		            }
				}
	            $('#catch-instagram-feed-gallery-widget-shortcode-form').on('submit', function(e){
	            	if( undefined !== $('div#wp-content-editor-container textarea').val() ) {
		                prev_code = $('div#wp-content-editor-container textarea').val().match(/\[(catch-instagram-feed-gallery-widget.*)\]/);
		            }
	                e.preventDefault();
	                var submit = true;
	                var shortcode = '';
	                var values = $('#catch-instagram-feed-gallery-widget-shortcode-wrapper :input');
	                var content_type;
	                $.each(values, function(k,v){
	                    if( 'checkbox' == v.type ) {
	                        shortcode += ' ' + v.name + '=' + '"' + v.checked + '"';
	                    }
	                    else {
	                        if ( 'username' == v.name ) {
	                        	// Do nothing by default it shows self's instagram feed
	                        }else if( 'title' === v.name ) {
		                		if( '' ==! v.value ) {
		                			shortcode += v.name + '=' + '"' + v.value + '" ';
			                	}else {
			                		shortcode += v.name + '="" ';
			                	}
		                	}else {
	                            if ( '' !== v.value ) {
	                                shortcode += ' ' + v.name + '=' + '"' + v.value + '"';
	                            }
	                        }
	                    }
	                });
	                if ( '' != shortcode && submit ) {
	                    shortcode = '[catch-instagram-feed-gallery-widget ' + shortcode + ']';
	                    if( undefined !== $('div#wp-content-editor-container textarea').val() && null != prev_code ) {

	                        if(!tinyMCE.activeEditor)jQuery('.wp-editor-wrap .switch-tmce').trigger('click');

	                        var content = tinyMCE.activeEditor.getContent();


	                        var new_content = content.replace(prev_code[0], '');

		                    tinyMCE.activeEditor.setContent(new_content);
		                    //tinymce.activeEditor.execCommand('mceInsertContent', false, new_content);
	                    }
	                    //return false;
	                    window.send_to_editor( shortcode );
	                    tb_remove();
	                }
	                else {
	                	return false;
	                }
	            });

	        });
	    </script>

	    <div id="display-catch-instagram-feed-gallery-widget-shortcode" style="display: none;">
	        <form id="catch-instagram-feed-gallery-widget-shortcode-form">
	        <div id="catch-instagram-feed-gallery-widget-shortcode-wrapper" class="catch-instagram-feed-gallery-widget-shortcode-wrapper" style="margin: 0 auto; width: 500px;">
	        	<?php $options = catch_instagram_feed_gallery_widget_get_options( 'catch_instagram_feed_gallery_widget_options' ); ?>

	            <p>
	                <label for="catch_instagram_feed_gallery_widget_shortcode_title"><?php esc_html_e( 'Title', 'catch-instagram-feed-gallery-widget' ); ?>:</label>
	                <input type="text" id="catch_instagram_feed_gallery_widget_shortcode_title" name="title" class="widefat catch-instagram-feed-gallery-widget-title" value="Catch Instagram Feed Gallery & Widget" />
	            </p>

	            <p>
	                <label for="catch_instagram_feed_gallery_widget_shortcode_username"><?php esc_html_e( 'Instagram Username', 'catch-instagram-feed-gallery-widget' ); ?>:</label>
	                <input type="text" id="catch_instagram_feed_gallery_widget_shortcode_username" name="username" class="widefat catch-instagram-feed-gallery-widget-username" value="<?php echo $options['username']; ?>" disabled="disabled" />
	            </p>
	            <span class="show-more button"><?php esc_html_e( 'More Options', 'catch-instagram-feed-gallery-widget' ); ?><i class="dashicons dashicons-arrow-down"></i></span>
				<div class="more-options">

	            <p>
	                <label for="catch_instagram_feed_gallery_widget_shortcode_number"><?php esc_html_e( 'Number of items', 'catch-instagram-feed-gallery-widget' ); ?>:</label>
	                <input type="number" id="catch_instagram_feed_gallery_widget_shortcode_number" name="number" class="small-text catch-instagram-feed-gallery-widget-number" max="30" min="1" value="6" />
	            </p>
	            <p class="description"><?php esc_html_e( 'Max is 30.', 'catch-instagram-feed-gallery-widget' ); ?></p>

	            <p>
	                <label for="catch_instagram_feed_gallery_widget_shortcode_size"><?php esc_html_e( 'Instagram Image Size', 'catch-instagram-feed-gallery-widget' ); ?>:</label>
	                <select id="catch_instagram_feed_gallery_widget_shortcode_size" name="size" class="widefat catch-instagram-feed-gallery-widget-size">
	                    <?php
	                        $image_size_choices = catch_instagram_feed_gallery_widget_image_size_option();

	                    foreach ( $image_size_choices as $key => $value ) {
	                        echo '<option value="' . esc_attr( $key ) . '" ' . selected( $key, 'standard_resolution', false ) . '>' . esc_attr( $value ) . '</option>';
	                    }
	                    ?>
	                </select>
	            </p>

	            </div>
	        </div>
	        <p style="margin: 0 auto; width: 500px;">
	            <button id="catch_instargarm_insert_shortcode" class="button button-primary button-large"><?php esc_html_e( 'Insert Shortcode', 'catch-instagram-feed-gallery-widget' ); ?></button>
	        </p>
	        </form>
	    </div>
	    <?php
	}
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_add_catch_instagram_feed_gallery_widget_editor_button_extension() {
	$catch_instagram_feed_gallery_widget_add_editor_button = new Catch_Instagram_Feed_Gallery_Widget_Add_Editor_Button;
}
run_add_catch_instagram_feed_gallery_widget_editor_button_extension();
