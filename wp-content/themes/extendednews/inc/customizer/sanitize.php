<?php
/**
* Custom Functions.
*
* @package ExtendedNews
*/

if( !function_exists( 'extendednews_sanitize_layout_option' ) ) :

    // Sidebar Option Sanitize.
    function extendednews_sanitize_layout_option( $extendednews_input ){

        $extendednews_metabox_options = array( 'default','boxed','widerwidth' );
        if( in_array( $extendednews_input,$extendednews_metabox_options ) ){

            return $extendednews_input;

        }

        return;

    }

endif;

if( !function_exists( 'extendednews_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function extendednews_sanitize_sidebar_option( $extendednews_input ){

        $extendednews_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $extendednews_input,$extendednews_metabox_options ) ){

            return $extendednews_input;

        }

        return;

    }

endif;

if( !function_exists( 'extendednews_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function extendednews_sanitize_single_pagination_layout( $extendednews_input ){

        $extendednews_single_pagination = array( 'no-navigation','norma-navigation','ajax-next-post-load' );
        if( in_array( $extendednews_input,$extendednews_single_pagination ) ){

            return $extendednews_input;

        }

        return;

    }

endif;

if( !function_exists( 'extendednews_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function extendednews_sanitize_archive_layout( $extendednews_input ){

        $extendednews_archive_option = array( 'default','full','grid','masonry' );
        if( in_array( $extendednews_input,$extendednews_archive_option ) ){

            return $extendednews_input;

        }

        return;

    }

endif;

if( !function_exists( 'extendednews_sanitize_single_post_layout' ) ) :

    // Single Layout Option Sanitize.
    function extendednews_sanitize_single_post_layout( $extendednews_input ){

        $extendednews_single_layout = array( 'layout-1','layout-2' );
        if( in_array( $extendednews_input,$extendednews_single_layout ) ){

            return $extendednews_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'extendednews_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function extendednews_sanitize_checkbox( $extendednews_checked ) {

		return ( ( isset( $extendednews_checked ) && true === $extendednews_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'extendednews_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function extendednews_sanitize_select( $extendednews_input, $extendednews_setting ) {

        // Ensure input is a slug.
        $extendednews_input = sanitize_text_field( $extendednews_input );

        // Get list of choices from the control associated with the setting.
        $choices = $extendednews_setting->manager->get_control( $extendednews_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $extendednews_input, $choices ) ? $extendednews_input : $extendednews_setting->default );

    }

endif;

if ( ! function_exists( 'extendednews_sanitize_repeater' ) ) :
    
    /**
    * Sanitise Repeater Field
    */
    function extendednews_sanitize_repeater($input){
        $input_decoded = json_decode( $input, true );
        
        if(!empty($input_decoded)) {

            foreach ($input_decoded as $boxes => $box ){

                foreach ($box as $key => $value){

                    if( $key == 'section_ed' 
                        || $key == 'ed_tab' 
                        || $key == 'ed_arrows_carousel' 
                        || $key == 'ed_dots_carousel' 
                        || $key == 'ed_autoplay_carousel' 
                        || $key == 'ed_flip_column' 
                        || $key == 'ed_ribbon_bg'
                    ){

                        $input_decoded[$boxes][$key] = extendednews_sanitize_repeater_ed( $value );

                    }elseif( $key == 'home_section_type' ){

                        $input_decoded[$boxes][$key] = extendednews_sanitize_home_sections( $value );

                    }elseif( $key == 'ribbon_bg_color_schema' ){

                        $input_decoded[$boxes][$key] = extendednews_sanitize_ribbon_bg( $value );

                    }elseif( $key == 'category_color' ){

                        $input_decoded[$boxes][$key] = sanitize_hex_color( $value );

                    }elseif( $key == 'bg_image_size' ){

                        $input_decoded[$boxes][$key] =  extendednews_sanitize_bg_image_size( $value );

                    }elseif( $key == 'tiles_post_per_page' ){

                        $input_decoded[$boxes][$key] =  absint( $value );

                    }elseif( $key == 'advertise_image' || $key == 'advertise_link' ){

                         $input_decoded[$boxes][$key] = esc_url_raw( $value );

                    }elseif($key == 'section_category' || 
                            $key == 'section_post_slide_cat' || 
                            $key == 'section_category_1' || 
                            $key == 'section_category_2' || 
                            $key == 'section_category_3' || 
                            $key == 'section_category_4' || 
                            $key == 'category'
                        ){

                        $input_decoded[$boxes][$key] =  extendednews_sanitize_category( $value );

                    }else{

                        $input_decoded[$boxes][$key] = sanitize_text_field( $value );

                    }
                    
                }

            }
           
            return json_encode($input_decoded);

        }

        return $input;
    }
endif;

/** Sanitize Enable Disable Checkbox **/
function extendednews_sanitize_repeater_ed( $input ) {

    $valid_keys = array('yes','no');
    if ( in_array( $input , $valid_keys ) ) {
        return $input;
    }
    return '';

}

function extendednews_sanitize_home_sections( $input ) {

    $home_sections = array(

        'main-banner' => esc_html__('Slider & Vertical Slider','extendednews'),
        'banner-blocks-1' => esc_html__('Slider & Tab Block','extendednews'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','extendednews'),
        'slider-blocks' => esc_html__('Slider Block','extendednews'),
        'tiles-blocks' => esc_html__('Tiles Block','extendednews'),
        'advertise-blocks' => esc_html__('Advertise Block','extendednews'),
        'carousel-blocks' => esc_html__('Carousel Block','extendednews'),
        'home-widget-area' => esc_html__('Widgets Area Block','extendednews'),

    );
    if ( array_key_exists( $input , $home_sections ) ) {
        return $input;
    }
    return '';

}

/** Sanitize Category **/
function extendednews_sanitize_category( $input ) {

   $extendednews_post_category_list = extendednews_post_category_list();
    if ( array_key_exists( $input , $extendednews_post_category_list ) ) {
        return $input;
    }
    return '';

}

function extendednews_sanitize_bg_image_size( $input ) {

    $bg_image_size = array( 
                    'auto' => esc_html('Original','extendednews'),
                    'contain' => esc_html('Fit to Screen','extendednews'),
                    'cover' => esc_html('Fill Screen','extendednews'),
                );

    if ( array_key_exists( $input , $bg_image_size ) ) {
        return $input;
    }
    return '';

}

function extendednews_sanitize_ribbon_bg( $input ) {

    $ribbon_bg = array( 
                    '1' =>  array(
                                    'title' =>  esc_html__( 'Blue', 'extendednews' ),
                                    'color' =>  '#3061ff',
                                ),
                    '2' =>  array(
                                    'title' =>  esc_html__( 'Orange', 'extendednews' ),
                                    'color' =>  '#fa9000',
                                ),
                    '3' =>  array(
                                    'title' =>  esc_html__( 'Royal Blue', 'extendednews' ),
                                    'color' =>  '#00167a',
                                ),
                    '4' =>  array(
                                    'title' =>  esc_html__( 'Pink', 'extendednews' ),
                                    'color' =>  '#ff2d55',
                                ),
                );

    if ( array_key_exists( $input , $ribbon_bg ) ) {
        return $input;
    }
    return '';

}