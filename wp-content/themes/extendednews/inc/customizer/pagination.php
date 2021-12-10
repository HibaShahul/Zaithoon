<?php
/**
 * Pagination Settings
 *
 * @package ExtendedNews
 */

$extendednews_default = extendednews_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'extendednews_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'extendednews' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'extendednews_pagination_layout',
	array(
	'default'           => $extendednews_default['extendednews_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'extendednews_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'extendednews' ),
	'section'     => 'extendednews_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','extendednews'),
		'numeric' => esc_html__('Numeric Method','extendednews'),
		'load-more' => esc_html__('Ajax Load More Button','extendednews'),
		'auto-load' => esc_html__('Ajax Auto Load','extendednews'),
	),
	)
);