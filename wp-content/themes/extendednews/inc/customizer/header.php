<?php
/**
* Header Options.
*
* @package ExtendedNews
*/

$extendednews_default = extendednews_get_default_theme_options();
$extendednews_page_lists = extendednews_page_lists();
$extendednews_post_category_list = extendednews_post_category_list();

// Header Advertise Area Section.
$wp_customize->add_section( 'main_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'extendednews' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
	)
);

// Enable Disable Search.
$wp_customize->add_setting('ed_header_search',
    array(
        'default' => $extendednews_default['ed_header_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search',
    array(
        'label' => esc_html__('Enable Search', 'extendednews'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_ad',
    array(
        'default' => $extendednews_default['ed_header_ad'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ad',
    array(
        'label' => esc_html__('Enable Top Advertisement Area', 'extendednews'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('header_ad_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'header_ad_image',
        array(
            'label'      => esc_html__( 'Top Header AD Image', 'extendednews' ),
            'section'    => 'main_header_setting',
            'active_callback' => 'extendednews_header_ad_ac',
        )
    )
);

$wp_customize->add_setting('ed_header_link',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('ed_header_link',
    array(
        'label' => esc_html__('AD Image Link', 'extendednews'),
        'section' => 'main_header_setting',
        'type' => 'text',
        'active_callback' => 'extendednews_header_ad_ac',
    )
);

// Archive Layout.
$wp_customize->add_setting(
    'extendednews_header_bg_size',
    array(
        'default'           => $extendednews_default['extendednews_header_bg_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control('extendednews_header_bg_size',
        array(
            'type'       => 'select',
            'section'       => 'header_image',
            'label'         => esc_html__( 'Header BG Size', 'extendednews' ),
            'choices'       => array(
                '1'  => esc_html__( 'Small', 'extendednews' ),
                '2'  => esc_html__( 'Medium', 'extendednews' ),
                '3'  => esc_html__( 'Large', 'extendednews' ),
            )
        )
);

$wp_customize->add_setting('ed_header_bg_fixed',
    array(
        'default' => $extendednews_default['ed_header_bg_fixed'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_fixed',
    array(
        'label' => esc_html__('Enable Fixed BG', 'extendednews'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_bg_overlay',
    array(
        'default' => $extendednews_default['ed_header_bg_overlay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_overlay',
    array(
        'label' => esc_html__('Enable BG Overlay', 'extendednews'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'extendednews_tags_search',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new ExtendedNews_Separator(
        $wp_customize,
        'extendednews_tags_search',
        array(
            'settings'      => 'extendednews_tags_search',
            'section'       => 'main_header_setting',
            'label'         => esc_html__( 'Popup Search Settings', 'extendednews' ),
        )
    )
);

$wp_customize->add_setting('ed_header_search_recent_posts',
    array(
        'default' => $extendednews_default['ed_header_search_recent_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search_recent_posts',
    array(
        'label' => esc_html__('Enable Recent Posts on Search Area', 'extendednews'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting( 'recent_post_title_search',
    array(
    'default'           => $extendednews_default['recent_post_title_search'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'recent_post_title_search',
    array(
    'label'    => esc_html__( 'Related Posts Section Title', 'extendednews' ),
    'section'  => 'main_header_setting',
    'type'     => 'text',
    )
);
$wp_customize->add_setting('ed_header_search_top_category',
    array(
        'default' => $extendednews_default['ed_header_search_top_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search_top_category',
    array(
        'label' => esc_html__('Enable Top Category on Search Area', 'extendednews'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting( 'top_category_title_search',
    array(
    'default'           => $extendednews_default['top_category_title_search'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'top_category_title_search',
    array(
    'label'    => esc_html__( 'Top Category Section Title', 'extendednews' ),
    'section'  => 'main_header_setting',
    'type'     => 'text',
    )
);

// Ticker Section
$wp_customize->add_section( 'header_ticker_section',
    array(
    'title'      => esc_html__( 'Breaking News Ticker', 'extendednews' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting('ed_header_ticker_posts',
    array(
        'default' => $extendednews_default['ed_header_ticker_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ticker_posts',
    array(
        'label' => esc_html__('Enable Ticker Posts', 'extendednews'),
        'section' => 'header_ticker_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_ticker_posts_title',
    array(
    'default'           => $extendednews_default['ed_header_ticker_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_ticker_posts_title',
    array(
    'label'       => esc_html__( 'Ticker Section Title', 'extendednews' ),
    'section'     => 'header_ticker_section',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'extendednews_header_ticker_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'extendednews_sanitize_select',
    )
);
$wp_customize->add_control( 'extendednews_header_ticker_cat',
    array(
    'label'       => esc_html__( 'Ticker Posts Category', 'extendednews' ),
    'section'     => 'header_ticker_section',
    'type'        => 'select',
    'choices'     => $extendednews_post_category_list,
    )
);

$wp_customize->add_setting('ed_ticker_slider_autoplay',
    array(
        'default' => $extendednews_default['ed_ticker_slider_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_slider_autoplay',
    array(
        'label' => esc_html__('Enable Ticker Posts Autoplay', 'extendednews'),
        'section' => 'header_ticker_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_ticker_slider_wide_layout',
    array(
        'default' => $extendednews_default['ed_ticker_slider_wide_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_slider_wide_layout',
    array(
        'label' => esc_html__('Enable Ticker Wide Layout', 'extendednews'),
        'section' => 'header_ticker_section',
        'type' => 'checkbox',
    )
);

// Trending Tags Section
$wp_customize->add_section( 'header_tags_section',
    array(
    'title'      => esc_html__( 'Trending Bar Settings', 'extendednews' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);
$wp_customize->add_setting('ed_header_tags',
    array(
        'default' => $extendednews_default['ed_header_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_tags',
    array(
        'label' => esc_html__('Enable Trending Bar', 'extendednews'),
        'section' => 'header_tags_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_tags_wide_layout',
    array(
        'default' => $extendednews_default['ed_tags_wide_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_tags_wide_layout',
    array(
        'label' => esc_html__('Enable Wide Layout', 'extendednews'),
        'section' => 'header_tags_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_tags_title',
    array(
        'default' => $extendednews_default['ed_header_tags_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('ed_header_tags_title',
    array(
        'label' => esc_html__('Trending Bar Title', 'extendednews'),
        'section' => 'header_tags_section',
        'type' => 'text',
    )
);


$wp_customize->add_setting( 'select_tag_or_cat',
    array(
        'default'           => $extendednews_default['select_tag_or_cat'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_select',
    )
);
$wp_customize->add_control( 'select_tag_or_cat',
    array(
        'label'       => esc_html__( 'Choose Tags or Categories', 'extendednews' ),
        'section'     => 'header_tags_section',
        'type'        => 'select',
        'choices'     => array(
            'tags' => esc_html__( 'Tags', 'extendednews' ),
            'categories'    => esc_html__( 'Categories', 'extendednews' ),
        ),
    )
);


$wp_customize->add_setting('ed_header_tags_count',
    array(
        'default' => $extendednews_default['ed_header_tags_count'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control('ed_header_tags_count',
    array(
        'label' => esc_html__('Number of items', 'extendednews'),
        'section' => 'header_tags_section',
        'type' => 'number',
    )
);

// Trending News Section
$wp_customize->add_section( 'header_news_section',
    array(
    'title'      => esc_html__( 'Trending News Settings', 'extendednews' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting('ed_header_trending_news',
    array(
        'default' => $extendednews_default['ed_header_trending_news'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'extendednews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_trending_news',
    array(
        'label' => esc_html__('Enable Trending News', 'extendednews'),
        'section' => 'header_news_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_trending_posts_title',
    array(
    'default'           => $extendednews_default['ed_header_trending_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_trending_posts_title',
    array(
    'label'       => esc_html__( 'Trending News Title', 'extendednews' ),
    'section'     => 'header_news_section',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'extendednews_header_trending_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'extendednews_sanitize_select',
    )
);
$wp_customize->add_control( 'extendednews_header_trending_cat',
    array(
    'label'       => esc_html__( 'Trending News Posts Category', 'extendednews' ),
    'section'     => 'header_news_section',
    'type'        => 'select',
    'choices'     => $extendednews_post_category_list,
    )
);