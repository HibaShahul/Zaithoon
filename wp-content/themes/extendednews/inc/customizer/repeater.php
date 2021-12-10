<?php
/**
* Sections Repeater Options.
*
* @package ExtendedNews
*/

$extendednews_post_category_list = extendednews_post_category_list();
$extendednews_defaults = extendednews_get_default_theme_options();
$home_sections = array(

        'banner-blocks-1' => esc_html__('Slider & Tab Block','extendednews'),
        'main-banner' => esc_html__('Slider & Vertical Slider','extendednews'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','extendednews'),
        'slider-blocks' => esc_html__('Slider Block','extendednews'),
        'tiles-blocks' => esc_html__('Tiles Block','extendednews'),
        'advertise-blocks' => esc_html__('Advertise Block','extendednews'),
        'carousel-blocks' => esc_html__('Carousel Block','extendednews'),
        'home-widget-area' => esc_html__('Widgets Area Block','extendednews'),

    );

$extendednews_video_aspect_ratio = extendednews_video_aspect_ratio();
$extendednews_video_autoplay = extendednews_video_autoplay();

// Slider Section.
$wp_customize->add_section( 'home_sections_repeater',
	array(
	'title'      => esc_html__( 'Homepage Sections', 'extendednews' ),
	'priority'   => 150,
	'capability' => 'edit_theme_options',
	)
);


// Recommended Posts Enable Disable.
$wp_customize->add_setting( 'twp_extendednews_home_sections_1', array(
    'sanitize_callback' => 'extendednews_sanitize_repeater',
    'default' => json_encode( $extendednews_defaults['twp_extendednews_home_sections_1'] ),
    // 'transport'           => 'postMessage',
));

$wp_customize->add_control(  new ExtendedNews_Repeater_Controler( $wp_customize, 'twp_extendednews_home_sections_1', 
    array(
        'section' => 'home_sections_repeater',
        'settings' => 'twp_extendednews_home_sections_1',
        'extendednews_box_label' => esc_html__('New Section','extendednews'),
        'extendednews_box_add_control' => esc_html__('Add New Section','extendednews'),
        'extendednews_box_add_button' => false,
    ),
        array(
            'section_ed' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Section', 'extendednews' ),
                'class'       => 'home-section-ed'
            ),
            'home_section_type' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Section Type', 'extendednews' ),
                'options'     => $home_sections,
                'class'       => 'home-section-type'
            ),
            'home_section_title' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs carousel-blocks-fields tiles-blocks-fields'
            ),
            'section_slide_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Slider Post Category', 'extendednews' ),
                'options'     => $extendednews_post_category_list,
                'class'       => 'home-repeater-fields-hs'
            ),
            'section_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category', 'extendednews' ),
                'options'     => $extendednews_post_category_list,
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields carousel-blocks-fields slider-blocks-fields'
            ),
            'ed_wide_layout' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Wide Layout', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs'
            ),
             'tiles_post_per_page' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Posts Per Page', 'extendednews' ),
                'options'     => array( 
                    '5' => 5,
                    '10' => 10,
                ),
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields'
            ),
             'home_section_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Slider Area Title', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'section_post_slide_cat' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Slider Post Category', 'extendednews' ),
                'options'     => $extendednews_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            
            'advertise_image' => array(
                'type'        => 'upload',
                'label'       => esc_html__( 'Advertise Image', 'extendednews' ),
                'description' => esc_html__( 'Recommended Image Size is 970x250 PX.', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'advertise_link' => array(
                'type'        => 'link',
                'label'       => esc_html__( 'Advertise Image Link', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'enable_wide_layout' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Wide Layout', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields tiles-blocks-fields banner-blocks-1-fields slider-blocks-fields carousel-blocks-fields'
            ),
            'ed_arrows_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Arrows', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs carousel-blocks-fields banner-blocks-1-fields main-banner-fields'
            ),
            'ed_dots_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Dot', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs carousel-blocks-fields banner-blocks-1-fields main-banner-fields'
            ),
            'ed_autoplay_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Autoplay', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs carousel-blocks-fields slider-blocks-fields banner-blocks-1-fields main-banner-fields'
            ),
            'home_section_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Tab Area Title', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'home_section_title_3' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Vertical Slide Title', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),
            'ed_tab' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Tab', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs ed-tabs-ac banner-blocks-1-fields'
            ),
            'cat_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title One', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_1' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category One', 'extendednews' ),
                'options'     => $extendednews_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'cat_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Two', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_2' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Two', 'extendednews' ),
                'options'     => $extendednews_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'cat_title_3' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Three', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_3' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Three', 'extendednews' ),
                'options'     => $extendednews_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'section_category_4' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Four', 'extendednews' ),
                'options'     => $extendednews_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'section_vertical_slide_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Vertical Slider Post Category', 'extendednews' ),
                'options'     => $extendednews_post_category_list,
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),
            'section_video_ratio' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Video Aspect Ratio', 'extendednews' ),
                'options'     => $extendednews_video_aspect_ratio,
                'class'       => 'home-repeater-fields-hs latest-posts-blocks-fields'
            ),
            'section_video_autoplay' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Video Autoplay', 'extendednews' ),
                'options'     => $extendednews_video_autoplay,
                'class'       => 'home-repeater-fields-hs latest-posts-blocks-fields'
            ),
            'ed_flip_column' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Flip Column Right to Left', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'background_color' => array(
                'type'        => 'colorpicker',
                'label'       => esc_html__( 'Background Color', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields slider-blocks-fields'
            ),
            'background_image' => array(
                'type'        => 'upload',
                'label'       => esc_html__( 'Background Image', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'bg_image_size' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Background Image Size', 'extendednews' ),
                'options'     => array( 
                    'auto' => esc_html('Original','extendednews'),
                    'contain' => esc_html('Fit to Screen','extendednews'),
                    'cover' => esc_html('Fill Screen','extendednews'),
                ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'background_image_repeat' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Repeat Background Image', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'background_image_scroll' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Scroll with Page', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'enable_sidebar' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Sidebar', 'extendednews' ),
                'description'       => esc_html__( 'Please add widget into "Homepage Sidebar Widget Area" for sidebar content.', 'extendednews' ),
                'class'       => 'home-repeater-fields-hs home-widget-area-fields'
            ),
    )
));

// Info.
$wp_customize->add_setting(
    'extendednews_notiece_info',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new ExtendedNews_Info_Notiece_Control( 
        $wp_customize,
        'extendednews_notiece_info',
        array(
            'settings' => 'extendednews_notiece_info',
            'section'       => 'home_sections_repeater',
            'label'         => esc_html__( 'Info', 'extendednews' ),
        )
    )
);

$wp_customize->add_setting(
    'extendednews_premium_notiece',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new ExtendedNews_Premium_Notiece_Control( 
        $wp_customize,
        'extendednews_premium_notiece',
        array(
            'label'      => esc_html__( 'Home Page Blocks', 'extendednews' ),
            'settings' => 'extendednews_premium_notiece',
            'section'       => 'home_sections_repeater',
        )
    )
);