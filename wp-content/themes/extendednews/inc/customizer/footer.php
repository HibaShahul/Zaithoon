<?php
/**
* Footer Settings.
*
* @package ExtendedNews
*/

$extendednews_default = extendednews_get_default_theme_options();
$extendednews_post_category_list = extendednews_post_category_list();

$wp_customize->add_section( 'footer_settings',
	array(
	'title'      => esc_html__( 'Footer Settings', 'extendednews' ),
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	'priority'  => 95,
	)
);


$wp_customize->add_setting( 'footer_column_layout',
	array(
	'default'           => $extendednews_default['footer_column_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( 'footer_column_layout',
	array(
	'label'       => esc_html__( 'Top Footer Column Layout', 'extendednews' ),
	'section'     => 'footer_settings',
	'type'        => 'select',
	'choices'               => array(
		'1' => esc_html__( 'One Column', 'extendednews' ),
		'2' => esc_html__( 'Two Column', 'extendednews' ),
		'3' => esc_html__( 'Three Column', 'extendednews' ),
	    ),
	)
);

$wp_customize->add_setting( 'footer_copyright_text',
	array(
	'default'           => $extendednews_default['footer_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'footer_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'extendednews' ),
	'section'  => 'footer_settings',
	'type'     => 'text',
	)
);

$wp_customize->add_setting('ed_scroll_top_button',
    array(
        'default' => $extendednews_default['ed_scroll_top_button'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_scroll_top_button',
    array(
        'label' => esc_html__('Enable Scroll to Top Button', 'extendednews'),
        'section' => 'footer_settings',
        'type' => 'checkbox',
    )
);