<?php
/**
* Top Header Options.
*
* @package ExtendedNews
*/

$extendednews_default = extendednews_get_default_theme_options();

$wp_customize->add_section( 'top_header_setting',
	array(
	'title'      => esc_html__( 'Top Header Settings', 'extendednews' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_top_header',
    array(
        'default' => $extendednews_default['ed_top_header'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_top_header',
    array(
        'label' => esc_html__('Enable Top Header', 'extendednews'),
        'section' => 'top_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_top_header_date',
    array(
        'default' => $extendednews_default['ed_top_header_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_top_header_date',
    array(
        'label' => esc_html__('Enable Current Date', 'extendednews'),
        'section' => 'top_header_setting',
        'type' => 'checkbox',
    )
);