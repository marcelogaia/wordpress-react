<?php
/**
 *
 * Implement Theme Customizer additions and adjustments.
 *
 * @package Photo Diary
 * @since Photo Diary 1.0
 * @version 1.1
 */

/**
 * Register custom functions for the customer
 */
function photo_diary_customize_register( $wp_customize ) {

    // Remove the "Site Title Color" Field.
    $wp_customize->add_control( 'header_textcolor' )->theme_support = false;

     // Add a New Section - Allgemein.
    $wp_customize->add_section( 'photo_diary_general', array(
        'title'    => esc_html__( 'General', 'photo-diary' ),
        'description' => '',
        'priority' => 1,
    ) ) ;

    // Custom Sidebar position.
    $wp_customize->add_setting( 'photo_diary_sidebar_position', array(
        'default'        => 'sidebar-right',
        'sanitize_callback' => 'photo_diary_sanitize_sidebar_position',
    ));

    $wp_customize->add_control( 'photo_diary_sidebar_position', array(
        'label'             => esc_html__( 'Sidebar position', 'photo-diary' ),
        'section'           => 'photo_diary_general',
        'priority'          => 1,
        'type'              => 'select',
        'choices'           => array(
            'sidebar-right'     => esc_html__( 'sidebar right', 'photo-diary' ),
            'no-sidebar'      => esc_html__( 'no sidebar', 'photo-diary' ),
        ),
    ));

    // Custom Footer Credit.
    $wp_customize->add_setting( 'photo_diary_footer_credit', array(
        'default'        => '',
        'sanitize_callback' => 'sanitize_text_field',

    ));

    $wp_customize->add_control( 'photo_diary_footer_credit', array(
        'label'             => esc_html__( 'Footer Credit', 'photo-diary' ),
        'section'           => 'photo_diary_general',
        'priority'          => 2,
        'type'              => 'text',
    ));

    // Custom Header Style.
    $wp_customize->add_setting( 'photo_diary_headerstyle', array(
        'default'        => 'header-fullwidth',
        'sanitize_callback' => 'photo_diary_sanitize_headerstyle',

    ));

    $wp_customize->add_control( 'photo_diary_headerstyle', array(
        'label'      		=> esc_html__( 'Headerstyle', 'photo-diary' ),
        'description' 		=> esc_html__( 'Choose your Headerstyle', 'photo-diary' ),
        'section'    		=> 'header_image',
        'priority'      	=> 10,
        'type'          	=> 'select',
    	'choices' 			=> array(
        	'header-fullwidth' 	=> esc_html__( 'full-width', 'photo-diary' ),
    	),
    ));

    // Show header on posts.
    $wp_customize->add_setting('photo_diary_show_header_on_posts', array(
        'default' => 'show-header-on-posts',
        'sanitize_callback' => 'photo_diary_sanitize_show_header_on_posts',

    ));

    $wp_customize->add_control('photo_diary_show_header_on_posts', array(
        'label' => esc_html__( 'Show header on posts?', 'photo-diary' ),
        'section' => 'header_image',
        'priority' => 10,
        'type' => 'radio',
        'choices' => array(
            'show-header-on-posts' => esc_html__( 'Yes', 'photo-diary' ),
            'hide-header-on-posts' => esc_html__( 'No', 'photo-diary' ),
        ),
    ));

     // Custom Primary Color.
    $wp_customize->add_setting( 'photo_diary_primary_color', array(
        'default'        => '#f44336',
        'sanitize_callback' => 'sanitize_hex_color',

    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'photo_diary_primary_color', array(
        'label'      => esc_html__( 'Primary Color', 'photo-diary' ),
        'section'    => 'colors',
        'settings'   => 'photo_diary_primary_color',
    ) ) );

     // Custom Link Hover Color.
    $wp_customize->add_setting( 'photo_diary_link_hover_color', array(
        'default'        => '#fbb4af',
        'sanitize_callback' => 'sanitize_hex_color',

    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'photo_diary_link_hover_color', array(
        'label'      => 'Link Hover Color',
        'section'    => 'colors',
        'settings'   => 'photo_diary_link_hover_color',
    ) ) );

     // Add a New Section - Social Media.
    $wp_customize->add_section( 'photo_diary_social_media', array(
        'title'    => esc_html__( 'Social-Media', 'photo-diary' ),
        'description' => esc_html__( 'Here you can add your social media profiles', 'photo-diary' ),
        'priority' => 40,
    ));

        // Facebook.
        $wp_customize->add_setting( 'photo_diary_social_media_facebook', array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'photo_diary_social_media_facebook', array(
            'label'             => 'Facebook',
            'section'           => 'photo_diary_social_media',
            'priority'          => 1,
            'type'              => 'url',
        ));

        // Twitter.
        $wp_customize->add_setting( 'photo_diary_social_media_twitter', array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'photo_diary_social_media_twitter', array(
            'label'             => 'Twitter',
            'section'           => 'photo_diary_social_media',
            'priority'          => 2,
            'type'              => 'url',
        ));

        // Instagram.
        $wp_customize->add_setting( 'photo_diary_social_media_instagram', array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'photo_diary_social_media_instagram', array(
            'label'             => 'Instagram',
            'section'           => 'photo_diary_social_media',
            'priority'          => 3,
            'type'              => 'url',
        ));

        // Youtube.
        $wp_customize->add_setting( 'photo_diary_social_media_youtube', array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'photo_diary_social_media_youtube', array(
            'label'             => 'Youtube',
            'section'           => 'photo_diary_social_media',
            'priority'          => 4,
            'type'              => 'url',
        ));

        // LinkedIn.
        $wp_customize->add_setting( 'photo_diary_social_media_linkedin', array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'photo_diary_social_media_linkedin', array(
            'label'             => 'LinkedIn',
            'section'           => 'photo_diary_social_media',
            'priority'          => 5,
            'type'              => 'url',
        ));

        // Xing.
        $wp_customize->add_setting( 'photo_diary_social_media_xing', array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'photo_diary_social_media_xing', array(
            'label'             => 'Xing',
            'section'           => 'photo_diary_social_media',
            'priority'          => 6,
            'type'              => 'url',
        ));

        // Behance.
        $wp_customize->add_setting( 'photo_diary_social_media_behance', array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'photo_diary_social_media_behance', array(
            'label'             => 'Behance',
            'section'           => 'photo_diary_social_media',
            'priority'          => 7,
            'type'              => 'url',
        ));

        // 500px.
        $wp_customize->add_setting( 'photo_diary_social_media_500px', array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'photo_diary_social_media_500px', array(
            'label'             => '500px',
            'section'           => 'photo_diary_social_media',
            'priority'          => 8,
            'type'              => 'url',
        ));

        // Flickr.
        $wp_customize->add_setting( 'photo_diary_social_media_flickr', array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'photo_diary_social_media_flickr', array(
            'label'             => 'Flickr',
            'section'           => 'photo_diary_social_media',
            'priority'          => 9,
            'type'              => 'url',
        ));

        // Dribbble.
        $wp_customize->add_setting( 'photo_diary_social_media_dribbble', array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'photo_diary_social_media_dribbble', array(
            'label'             => 'Dribbble',
            'section'           => 'photo_diary_social_media',
            'priority'          => 10,
            'type'              => 'url',
        ));

        // Pinterest.
        $wp_customize->add_setting( 'photo_diary_social_media_pinterest', array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'photo_diary_social_media_pinterest', array(
            'label'             => 'Pinterest',
            'section'           => 'photo_diary_social_media',
            'priority'          => 11,
            'type'              => 'url',
        ));

}
add_action( 'customize_register', 'photo_diary_customize_register' );




/**
 * Sanitize Custom Headerstyle
 */
function photo_diary_sanitize_headerstyle( $photo_diary_headerstyle ) {
	if ( ! in_array( $photo_diary_headerstyle, array( 'header-fullwidth' ) ) ) {
		$photo_diary_headerstyle = 'header-fullwidth';
	}
	return $photo_diary_headerstyle;
}

/**
 * Show posts on header
 */
function photo_diary_sanitize_show_header_on_posts($photo_diary_show_header_on_posts)
{
    if ( ! in_array( $photo_diary_show_header_on_posts, array( 'hide-header-on-posts' ) ) ) {
        $photo_diary_show_header_on_posts = 'show-header-on-posts';
    }
    return $photo_diary_show_header_on_posts;
}



/**
 * Sanitize Custom Sidebar Position
 */
function photo_diary_sanitize_sidebar_position( $photo_diary_sidebar_position ) {
    if ( ! in_array( $photo_diary_sidebar_position, array( 'sidebar-right', 'no-sidebar' ) ) ) {
        $photo_diary_sidebar_position = 'no-sidebar';
    }
    return $photo_diary_sidebar_position;
}

