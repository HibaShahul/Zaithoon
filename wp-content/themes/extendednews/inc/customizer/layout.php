<?php
/**
* Layouts Settings.
*
* @package ExtendedNews
*/

$extendednews_default = extendednews_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'layout_setting',
	array(
	'title'      => esc_html__( 'Archive Settings', 'extendednews' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting( 'ed_fullwidth_layout',
    array(
    'default'           => $extendednews_default['ed_fullwidth_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'extendednews_sanitize_layout_option',
    )
);
$wp_customize->add_control( 'ed_fullwidth_layout',
    array(
    'label'       => esc_html__( 'Enable Wider Width Layout', 'extendednews' ),
    'section'     => 'layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'default' => esc_html__( 'Default Layout', 'extendednews' ),
        'boxed'  => esc_html__( 'Boxed Layout', 'extendednews' ),
        'widerwidth'    => esc_html__( 'Wider Width Layout', 'extendednews' ),
        ),
    )
);


$wp_customize->add_setting( 'global_sidebar_layout',
	array(
	'default'           => $extendednews_default['global_sidebar_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'extendednews_sanitize_sidebar_option',
	)
);
$wp_customize->add_control( 'global_sidebar_layout',
	array(
	'label'       => esc_html__( 'Global Sidebar Layout', 'extendednews' ),
	'section'     => 'layout_setting',
	'type'        => 'select',
	'choices'     => array(
		'right-sidebar' => esc_html__( 'Right Sidebar', 'extendednews' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'extendednews' ),
		'no-sidebar'    => esc_html__( 'No Sidebar', 'extendednews' ),
	    ),
	)
);

// Archive Layout.
$wp_customize->add_setting(
    'extendednews_archive_layout',
    array(
        'default' 			=> $extendednews_default['extendednews_archive_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_archive_layout'
    )
);
$wp_customize->add_control(
    new ExtendedNews_Custom_Radio_Image_Control(
        $wp_customize,
        'extendednews_archive_layout',
        array(
            'settings'      => 'extendednews_archive_layout',
            'section'       => 'layout_setting',
            'label'         => esc_html__( 'Archive Layout', 'extendednews' ),
            'choices'       => array(
            	'default'  => get_template_directory_uri() . '/assets/images/Layout-style-1.png',
                'full'  => get_template_directory_uri() . '/assets/images/Layout-style-2.png',
                'grid'  => get_template_directory_uri() . '/assets/images/Layout-style-3.png',
                'masonry'  => get_template_directory_uri() . '/assets/images/Layout-style-4.png',
            )
        )
    )
);


$wp_customize->add_setting('ed_image_content_inverse',
    array(
        'default' => $extendednews_default['ed_image_content_inverse'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_image_content_inverse',
    array(
        'label' => esc_html__('Inverse Image with Content', 'extendednews'),
        'section' => 'layout_setting',
        'type' => 'checkbox',
        'active_callback' => 'extendednews_header_archive_layout_ac',
    )
);

