<?php
/**
 * ExtendedNews Customizer Active Callback Functions
 *
 * @package ExtendedNews
 */

function extendednews_header_archive_layout_ac( $control ){

    $extendednews_archive_layout = $control->manager->get_setting( 'extendednews_archive_layout' )->value();
    if( $extendednews_archive_layout == 'default' ){

        return true;
        
    }
    
    return false;
}

function extendednews_overlay_layout_ac( $control ){

    $extendednews_single_post_layout = $control->manager->get_setting( 'extendednews_single_post_layout' )->value();
    if( $extendednews_single_post_layout == 'layout-2' ){

        return true;
        
    }
    
    return false;
}

function extendednews_header_ad_ac( $control ){

    $ed_header_ad = $control->manager->get_setting( 'ed_header_ad' )->value();
    if( $ed_header_ad ){

        return true;
        
    }
    
    return false;
}