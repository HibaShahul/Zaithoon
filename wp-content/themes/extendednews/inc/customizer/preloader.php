<?php
/**
* Footer Settings.
*
* @package ExtendedNews
*/

$extendednews_default = extendednews_get_default_theme_options();


$wp_customize->add_section( 'preloader_section',
	array(
	'title'      => esc_html__( 'Preloader Setting', 'extendednews' ),
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	'priority'   => 5,
	)
);

$wp_customize->add_setting('ed_preloader',
    array(
        'default' => $extendednews_default['ed_preloader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_preloader',
    array(
        'label' => esc_html__('Enable Preloader', 'extendednews'),
        'section' => 'preloader_section',
        'type' => 'checkbox',
    )
);