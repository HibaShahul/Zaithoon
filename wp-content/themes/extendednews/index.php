<?php
/**
 *
 * Front Page
 *
 * @package ExtendedNews
 */

get_header();


    $extendednews_default = extendednews_get_default_theme_options();
    $twp_extendednews_home_sections_1 = get_theme_mod( 'twp_extendednews_home_sections_1', json_encode( $extendednews_default['twp_extendednews_home_sections_1'] ) );
    $paged_active = false;

    if ( !is_paged() ) {
        $paged_active = true;
    }

    $twp_extendednews_home_sections_1 = json_decode( $twp_extendednews_home_sections_1 );
    $repeat_times = 1;

    foreach ( $twp_extendednews_home_sections_1 as $extendednews_home_section ) {

        $home_section_type = isset( $extendednews_home_section->home_section_type ) ? $extendednews_home_section->home_section_type : '';

        switch ($home_section_type) {

            case 'banner-blocks-1':

                $ed_banner_blocks_1 = isset( $extendednews_home_section->section_ed ) ? $extendednews_home_section->section_ed : '';
                if ( $ed_banner_blocks_1 == 'yes' && $paged_active ) {
                    extendednews_banner_block_1_section( $extendednews_home_section, $repeat_times );
                }
            break;

            case 'main-banner':

                $ed_slider_blocks = isset( $extendednews_home_section->section_ed ) ? $extendednews_home_section->section_ed : '';
                if ( $ed_slider_blocks == 'yes' && $paged_active ) {
                    extendednews_main_banner( $extendednews_home_section, $repeat_times );
                }

            break;

            case 'slider-blocks':

                $ed_slider_blocks = isset( $extendednews_home_section->section_ed ) ? $extendednews_home_section->section_ed : '';
                if ( $ed_slider_blocks == 'yes' && $paged_active ) {
                    extendednews_slider_blocks( $extendednews_home_section, $repeat_times );
                }

            break;

            case 'latest-posts-blocks':

                $ed_latest_posts_blocks = isset( $extendednews_home_section->section_ed ) ? $extendednews_home_section->section_ed : '';
                if ( $ed_latest_posts_blocks == 'yes' ) {
                    extendednews_latest_blocks( $extendednews_home_section, $repeat_times );
                }

            break;

            case 'carousel-blocks':

                $ed_carousel_blocks = isset( $extendednews_home_section->section_ed ) ? $extendednews_home_section->section_ed : '';
                if ( $ed_carousel_blocks == 'yes' && $paged_active ) {
                    extendednews_carousel_posts( $extendednews_home_section, $repeat_times );
                }

            break;

            case 'tiles-blocks':

                $ed_tiles_block = isset( $extendednews_home_section->section_ed ) ? $extendednews_home_section->section_ed : '';
                if ( $ed_tiles_block == 'yes' && $paged_active ) {
                    extendednews_tiles_block_section( $extendednews_home_section, $repeat_times );
                }

            break;

            case 'advertise-blocks':

                $ed_advertise_blocks = isset( $extendednews_home_section->section_ed ) ? $extendednews_home_section->section_ed : '';
                if ( $ed_advertise_blocks == 'yes' && $paged_active ) {
                    extendednews_advertise_block( $extendednews_home_section, $repeat_times );
                }
                
            break;

            case 'home-widget-area':

                $ed_home_widget_area = isset( $extendednews_home_section->section_ed ) ? $extendednews_home_section->section_ed : '';
                if ( $ed_home_widget_area == 'yes' && $paged_active ) {
                    extendednews_case_home_widget_area_block( $extendednews_home_section, $repeat_times );
                }
                
            break;

            default:

            break;

        }

        $repeat_times++;
    }

get_footer();
