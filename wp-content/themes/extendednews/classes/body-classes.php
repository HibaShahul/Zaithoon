<?php
/**
* Body Classes.
*
* @package ExtendedNews
*/
 
 if (!function_exists('extendednews_body_classes')) :

    function extendednews_body_classes($classes) {

        $extendednews_default = extendednews_get_default_theme_options();
        global $post;

        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if ( !is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }
        
        if ( is_active_sidebar( 'sidebar-1' ) ) {

            $global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$extendednews_default['global_sidebar_layout'] ) );

            if( is_single() || is_page() ){

                $extendednews_post_sidebar = esc_html( get_post_meta( $post->ID, 'extendednews_post_sidebar_option', true ) );

                if( $extendednews_post_sidebar == 'global-sidebar' || empty( $extendednews_post_sidebar ) ){

                    if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                        
                        $classes[] = 'no-sidebar';

                    }else{

                        $classes[] = esc_attr( $global_sidebar_layout );

                    }

                }else{

                    if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                        
                        $classes[] = 'no-sidebar';

                    }else{

                        $classes[] = esc_attr( $extendednews_post_sidebar );

                    }
                }
                
            }elseif( is_404() ){

                $classes[] = 'no-sidebar';

            }else{
                
                $classes[] = esc_attr( $global_sidebar_layout );
            }

        }

        if( is_page() ){

            $extendednews_header_trending_page = get_theme_mod( 'extendednews_header_trending_page' );
            $extendednews_header_popular_page = get_theme_mod( 'extendednews_header_popular_page' );

            if( $extendednews_header_trending_page == $post->ID || $extendednews_header_popular_page == $post->ID ){

                $extendednews_archive_layout = get_theme_mod( 'extendednews_archive_layout',$extendednews_default['extendednews_archive_layout'] );
                $ed_image_content_inverse = get_theme_mod( 'ed_image_content_inverse',$extendednews_default['ed_image_content_inverse'] );
                if( $extendednews_archive_layout == 'default' && $ed_image_content_inverse ){

                    $classes[] = 'twp-archive-alternative';

                }

                $classes[] = 'twp-archive-'.esc_attr( $extendednews_archive_layout );
                
            }

        }

        if( is_singular('post') ){

            $extendednews_post_layout = esc_html( get_post_meta( $post->ID, 'extendednews_post_layout', true ) );

            if( $extendednews_post_layout == '' || $extendednews_post_layout == 'global-layout' ){
                
                $extendednews_post_layout = get_theme_mod( 'extendednews_single_post_layout',$extendednews_default['extendednews_archive_layout'] );

            }

            $classes[] = 'twp-single-'.esc_attr( $extendednews_post_layout );

            if( $extendednews_post_layout == 'layout-2' ){
                
                $extendednews_header_overlay = esc_html( get_post_meta( $post->ID, 'extendednews_header_overlay', true ) );

                if( $extendednews_header_overlay == '' || $extendednews_header_overlay == 'global-layout' ){

                    $extendednews_post_layout2 = get_theme_mod( 'extendednews_single_post_layout',$extendednews_default['extendednews_archive_layout'] );

                    if( $extendednews_post_layout2 == 'layout-2' ){

                        $ed_header_overlay = esc_html( get_post_meta( $post->ID, 'ed_header_overlay', true ) );
                        if( $ed_header_overlay == '' || $ed_header_overlay == 'global-layout' ){
                            
                            $ed_header_overlay = get_theme_mod( 'ed_header_overlay',$extendednews_default['ed_header_overlay'] );
                        }

                    }else{

                        $ed_header_overlay = false;

                    }

                }else{

                    $ed_header_overlay = true;

                }
                if( $ed_header_overlay ){

                    $classes[] = 'twp-single-header-overlay';

                }

            }

        }

        if( is_singular('page') ){

            $extendednews_page_layout = get_post_meta( $post->ID, 'extendednews_page_layout', true );

            if( $extendednews_page_layout == ''  ){
                
                $extendednews_page_layout = 'layout-1';

            }

            $classes[] = 'theme-single-'.esc_attr( $extendednews_page_layout );

            if( $extendednews_page_layout == 'layout-2' ){
                
                $extendednews_ed_header_overlay = get_post_meta( $post->ID, 'extendednews_ed_header_overlay', true );
                if( $extendednews_ed_header_overlay ){
                    $classes[] = 'theme-single-header-overlay';
                }

            }

        }

        if( is_archive() || is_home() || is_search() ){

            $extendednews_archive_layout = get_theme_mod( 'extendednews_archive_layout',$extendednews_default['extendednews_archive_layout'] );
            $ed_image_content_inverse = get_theme_mod( 'ed_image_content_inverse',$extendednews_default['ed_image_content_inverse'] );
            if( $extendednews_archive_layout == 'default' && $ed_image_content_inverse ){

                $classes[] = 'twp-archive-alternative';

            }

            $classes[] = 'twp-archive-'.esc_attr( $extendednews_archive_layout );
            
        }

        if( is_singular('post') ){

            $extendednews_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'extendednews_ed_post_reaction', true ) );
            if( $extendednews_ed_post_reaction ){
                $classes[] = 'hide-comment-rating';
            }

        }

        $ed_fullwidth_layout = get_theme_mod( 'ed_fullwidth_layout',$extendednews_default['ed_fullwidth_layout'] );

        if( $ed_fullwidth_layout != 'default' && !empty( $ed_fullwidth_layout ) ){
            $classes[] = 'theme-'.esc_attr( $ed_fullwidth_layout ).'-layout';
        }

        return $classes;
    }

endif;

add_filter('body_class', 'extendednews_body_classes');