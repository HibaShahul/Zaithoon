<?php
/**
* Posts Settings.
*
* @package ExtendedNews
*/

$extendednews_default = extendednews_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'posts_settings',
	array(
	'title'      => esc_html__( 'Article Meta Settings', 'extendednews' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_post_date',
    array(
        'default' => $extendednews_default['ed_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'extendednews'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_category',
    array(
        'default' => $extendednews_default['ed_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'extendednews'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_tags',
    array(
        'default' => $extendednews_default['ed_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'extendednews'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_views',
    array(
        'default' => $extendednews_default['ed_post_views'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_views',
    array(
        'label' => esc_html__('Enable Posts Views', 'extendednews'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);


// Enable Disable Post.
$wp_customize->add_setting('post_date_format',
    array(
        'default' => $extendednews_default['post_date_format'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_select',
    )
);
$wp_customize->add_control('post_date_format',
    array(
        'label' => esc_html__('Posted Date Format', 'extendednews'),
        'section' => 'posts_settings',
        'type' => 'select',
        'choices'               => array(
            'default' => esc_html__( 'Apply Default Format', 'extendednews' ),
            'time-ago' => esc_html__( 'Apply Time Age Format', 'extendednews' ),
            ),
        )
);

// Enable Disable Post.
$wp_customize->add_setting('post_video_aspect_ration',
    array(
        'default' => $extendednews_default['post_video_aspect_ration'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_select',
    )
);
$wp_customize->add_control('post_video_aspect_ration',
    array(
        'label' => esc_html__('Global Video Aspect Ratio', 'extendednews'),
        'section' => 'posts_settings',
        'type' => 'select',
        'choices'               => array(
            'default' => esc_html__( 'Default', 'extendednews' ),
            'square' => esc_html__( 'Square', 'extendednews' ),
            'portrait' => esc_html__( 'Portrait', 'extendednews' ),
            'landscape' => esc_html__( 'Landscape', 'extendednews' ),
            ),
        )
);


$wp_customize->add_setting('ed_autoplay',
    array(
        'default' => $extendednews_default['ed_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_select',
    )
);
$wp_customize->add_control('ed_autoplay',
    array(
        'label' => esc_html__('Global Video Autoplay', 'extendednews'),
        'section' => 'posts_settings',
        'type' => 'select',
        'choices'               => array(
            'autoplay-enable' => esc_html__( 'Autoplay Enable', 'extendednews' ),
            'autoplay-disable' => esc_html__( 'Autoplay Disable', 'extendednews' ),
            ),
        )
);