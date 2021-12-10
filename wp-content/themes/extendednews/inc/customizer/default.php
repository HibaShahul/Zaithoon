<?php
/**
 * Default Values.
 *
 * @package ExtendedNews
 */

if (!function_exists('extendednews_get_default_theme_options')) :

    /**
     * Get default theme options
     *
     * @return array Default theme options.
     * @since 1.0.0
     *
     */
    function extendednews_get_default_theme_options(){

        $extendednews_defaults = array();

        $extendednews_defaults['twp_extendednews_home_sections_1'] = array(

            array(
                'home_section_type' => 'banner-blocks-1',
                'section_ed' => 'yes',
                'section_category_1' => '',
                'section_category_2' => '',
                'section_category_3' => '',
                'ed_flip_column' => 'no',
                'ed_tab' => 'no',
                'bg_image_size' => 'auto',
                'background_image_repeat' => 'yes',
                'background_image_scroll' => 'yes',
                'ed_arrows_carousel' => 'yes',
                'ed_dots_carousel' => 'no',
                'ed_autoplay_carousel' => 'yes',
                'home_section_title_1' => esc_html__('Block Title One','extendednews'),
                'home_section_title_2' => esc_html__('Block Title Tab','extendednews'),
                'background_color' => '#f6f5f2'
            ),

            array(
                'home_section_type' => 'tiles-blocks',
                'section_ed' => 'no',
                'section_category' => '',
                'tiles_post_per_page' => 5,
            ),

            array(
                'home_section_type' => 'main-banner',
                'section_ed' => 'no',
                'home_section_title' => '',
                'bg_image_size' => 'auto',
                'background_image_repeat' => 'yes',
                'background_image_scroll' => 'yes',
                'enable_wide_layout' => 'no',
                'ed_arrows_carousel' => 'yes',
                'ed_dots_carousel' => 'no',
                'ed_autoplay_carousel' => 'yes',
                'background_color' => '#f6f5f2'
            ),
            array(
                'home_section_type' => 'latest-posts-blocks',
                'section_ed' => 'yes',
                'section_video_ratio' => 'default',
                'section_video_autoplay' => 'autoplay-disable',
            ),
            array(
                'home_section_type' => 'slider-blocks',
                'section_ed' => 'no',
                'ed_autoplay_carousel' => 'yes',
                'enable_wide_layout' => 'yes',
                'background_color' => '#161617'
            ),
            array(
                'home_section_type' => 'advertise-blocks',
                'section_ed' => 'no',
                'advertise_image' => '',
                'advertise_link' => '',
            ),
            array(
                'home_section_type' => 'carousel-blocks',
                'section_ed' => 'no',
                'ed_arrows_carousel' => 'yes',
                'ed_dots_carousel' => 'no',
                'ed_autoplay_carousel' => 'yes',
                'home_section_title' => esc_html__('Block Title','extendednews'),
            ),
            array(
                'home_section_type' => 'home-widget-area',
                'section_ed' => 'yes',
                'sidebar_ed' => 'no',
            ),
        );

        // Options.
        $extendednews_defaults['global_sidebar_layout'] = 'right-sidebar';
        $extendednews_defaults['extendednews_archive_layout'] = 'grid';
        $extendednews_defaults['extendednews_pagination_layout'] = 'numeric';
        $extendednews_defaults['footer_column_layout'] = 3;
        $extendednews_defaults['footer_copyright_text'] = esc_html__('All rights reserved.', 'extendednews');
        $extendednews_defaults['ed_header_search'] = 1;
        $extendednews_defaults['ed_ticker_slider_autoplay'] = 0;
        $extendednews_defaults['ed_header_trending_news'] = 1;
        $extendednews_defaults['ed_header_trending_posts_title'] = esc_html__('Trending News', 'extendednews');
        $extendednews_defaults['ed_header_ad'] = 0;
        $extendednews_defaults['ed_header_ticker_posts'] = 1;
        $extendednews_defaults['ed_header_ticker_posts_title'] = esc_html__('Breaking News', 'extendednews');
        $extendednews_defaults['ed_image_content_inverse'] = 0;
        $extendednews_defaults['ed_related_post'] = 1;
        $extendednews_defaults['related_post_title'] = esc_html__('More Stories', 'extendednews');
        $extendednews_defaults['twp_navigation_type'] = 'norma-navigation';
        $extendednews_defaults['extendednews_single_post_layout'] = 'layout-1';
        $extendednews_defaults['ed_post_date'] = 1;
        $extendednews_defaults['ed_post_category'] = 1;
        $extendednews_defaults['ed_header_tags'] = 1;
        $extendednews_defaults['ed_post_tags'] = 1;
        $extendednews_defaults['ed_header_tags_title'] = esc_html__('Trending Tags', 'extendednews');
        $extendednews_defaults['ed_header_tags_count'] = 10;
        $extendednews_defaults['select_tag_or_cat'] = 'tags';
        $extendednews_defaults['ed_header_overlay'] = 0;
        $extendednews_defaults['ed_floating_next_previous_nav'] = 1;
        $extendednews_defaults['extendednews_header_bg_size'] = 1;
        $extendednews_defaults['ed_preloader'] = 1;
        $extendednews_defaults['ed_header_bg_fixed'] = 0;
        $extendednews_defaults['ed_header_bg_overlay'] = 1;
        $extendednews_defaults['post_date_format'] = 'default';
        $extendednews_defaults['ed_fullwidth_layout'] = 'default';
        $extendednews_defaults['ed_post_views'] = 0;
        $extendednews_defaults['ed_scroll_top_button'] = 1;

        $extendednews_defaults['ed_header_search_recent_posts']             = 1;
        $extendednews_defaults['ed_header_search_top_category']             = 1;
        $extendednews_defaults['recent_post_title_search']                 = esc_html__('Recent Post','extendednews');
        $extendednews_defaults['top_category_title_search']                 = esc_html__('Top Category','extendednews');

        $extendednews_defaults['ed_top_header']             = 0;
        $extendednews_defaults['ed_top_header_date']             = 0;
        $extendednews_defaults['ed_ticker_slider_wide_layout']             = 0;
        $extendednews_defaults['ed_tags_wide_layout']             = 0;

        $extendednews_defaults['ed_autoplay']             = 'autoplay-disable';
        $extendednews_defaults['post_video_aspect_ration']             = 'default';

        // Pass through filter.
        $extendednews_defaults = apply_filters('extendednews_filter_default_theme_options', $extendednews_defaults);

        return $extendednews_defaults;

    }

endif;
