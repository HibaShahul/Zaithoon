<?php
/**
 * Custom Functions.
 *
 * @package ExtendedNews
 */

if( !function_exists( 'extendednews_fonts_url' ) ) :

    //Google Fonts URL
    function extendednews_fonts_url(){

        $font_families = array(
            'Inter:wght@100;200;300;400;500;600;700;800;900',
            'Oswald:wght@200;300;400;500;600;700&display=swap',

        );

        $fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $font_families ),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2' );

        return esc_url_raw($fonts_url);
    }

endif;

if( !function_exists( 'extendednews_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function extendednews_sanitize_sidebar_option_meta( $input ){

        $metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'extendednews_page_lists' ) ) :

    // Page List.
    function extendednews_page_lists(){

        $page_lists = array();
        $page_lists[''] = esc_html__( '-- Select Page --','extendednews' );
        $pages = get_pages(
            array (
                'parent'  => 0, // replaces 'depth' => 1,
            )
        );
        foreach( $pages as $page ){

            $page_lists[$page->ID] = $page->post_title;

        }
        return $page_lists;
    }

endif;

if( !function_exists( 'extendednews_sanitize_post_layout_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function extendednews_sanitize_post_layout_option_meta( $input ){

        $metabox_options = array( 'global-layout','layout-1','layout-2' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

if( !function_exists( 'extendednews_sanitize_header_overlay_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function extendednews_sanitize_header_overlay_option_meta( $input ){

        $metabox_options = array( 'global-layout','enable-overlay' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

/**
 * ExtendedNews SVG Icon helper functions
 *
 * @package ExtendedNews
 * @since 1.0.0
 */
if ( ! function_exists( 'extendednews_the_theme_svg' ) ):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the ExtendedNews_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function extendednews_the_theme_svg( $svg_name, $return = false ) {

        if( $return ){

            return extendednews_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in extendednews_get_theme_svg();.

        }else{

            echo extendednews_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in extendednews_get_theme_svg();.
            
        }
    }

endif;

if ( ! function_exists( 'extendednews_get_theme_svg' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function extendednews_get_theme_svg( $svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            ExtendedNews_SVG_Icons::get_svg( $svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );
        if ( ! $svg ) {
            return false;
        }
        return $svg;

    }

endif;

if ( ! function_exists( 'extendednews_svg_escape' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function extendednews_svg_escape( $input ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if ( ! $svg ) {
            return false;
        }

        return $svg;

    }

endif;

if( !function_exists('extendednews_post_format_icon') ):

    // Post Format Icon.
    function extendednews_post_format_icon( $format ){

        if( $format == 'video' ){
            $icon = extendednews_get_theme_svg( 'video' );
        }elseif( $format == 'audio' ){
            $icon = extendednews_get_theme_svg( 'audio' );
        }elseif( $format == 'gallery' ){
            $icon = extendednews_get_theme_svg( 'gallery' );
        }elseif( $format == 'quote' ){
            $icon = extendednews_get_theme_svg( 'quote' );
        }elseif( $format == 'image' ){
            $icon = extendednews_get_theme_svg( 'image' );
        }else{
            $icon = '';
        }

        return $icon;
    }

endif;

if( !function_exists( 'extendednews_social_menu_icon' ) ) :

    function extendednews_social_menu_icon( $item_output, $item, $depth, $args ) {

        // Add Icon
        if ( isset( $args->theme_location ) && 'extendednews-social-menu' === $args->theme_location ) {

            $svg = ExtendedNews_SVG_Icons::get_theme_svg_name( $item->url );

            if ( empty( $svg ) ) {
                $svg = extendednews_the_theme_svg( 'link',$return = true );
            }

            $item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
        }

        return $item_output;
    }
    
endif;

add_filter( 'walker_nav_menu_start_el', 'extendednews_social_menu_icon', 10, 4 );

if ( ! function_exists( 'extendednews_sub_menu_toggle_button' ) ) :

    function extendednews_sub_menu_toggle_button( $args, $item, $depth ) {

        // Add sub menu toggles to the main menu with toggles
        if ( $args->theme_location == 'extendednews-primary-menu' && isset( $args->show_toggles ) ) {
            // Wrap the menu item link contents in a div, used for positioning
            $args->before = '<div class="submenu-wrapper">';
            $args->after  = '';
            // Add a toggle to items with children
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';
                // Add the sub menu toggle
                $args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . __( 'Show sub menu', 'extendednews' ) . '</span>' . extendednews_get_theme_svg( 'chevron-down' ) . '</span></button>';
            }
            // Close the wrapper
            $args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)
        } elseif ( $args->theme_location == 'extendednews-primary-menu' ) {
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                $args->before = '<div class="link-icon-wrapper">';
                $args->after  = extendednews_get_theme_svg( 'chevron-down' ) . '</div>';
            } else {
                $args->before = '';
                $args->after  = '';
            }
        }
        return $args;

    }

    add_filter( 'nav_menu_item_args', 'extendednews_sub_menu_toggle_button', 10, 3 );

endif;

if( !function_exists( 'extendednews_post_category_list' ) ) :

    // Post Category List.
    function extendednews_post_category_list( $select_cat = true ){

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if( $select_cat ){

            $post_cat_cat_array[''] = esc_html__( '-- Select Category --','extendednews' );

        }

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if( !function_exists('extendednews_sanitize_meta_pagination') ):

    /** Sanitize Enable Disable Checkbox **/
    function extendednews_sanitize_meta_pagination( $input ) {

        $valid_keys = array('global-layout','no-navigation','norma-navigation','ajax-next-post-load');
        if ( in_array( $input , $valid_keys ) ) {
            return $input;
        }
        return '';

    }

endif;

if( !function_exists('extendednews_disable_post_views') ):

    /** Disable Post Views **/
    function extendednews_disable_post_views() {

        add_filter('booster_extension_filter_views_ed', 'extendednews_disable_views_ed');

    }

endif;

if( !function_exists('extendednews_disable_views_ed') ):

    /** Disable Reaction **/
    function extendednews_disable_views_ed() {

        return false;

    }

endif;

if( !function_exists('extendednews_disable_post_read_time') ):

    /** Disable Read Time **/
    function extendednews_disable_post_read_time() {

        add_filter('booster_extension_filter_readtime_ed', 'extendednews_disable_read_time');

    }

endif;

if( !function_exists('extendednews_disable_read_time') ):

    /** Disable Reaction **/
    function extendednews_disable_read_time() {

        return false;

    }

endif;

if( !function_exists('extendednews_disable_post_like_dislike') ):

    /** Disable Like Dislike **/
    function extendednews_disable_post_like_dislike() {

        add_filter('booster_extension_filter_like_ed', 'extendednews_disable_like_ed');

    }

endif;

if( !function_exists('extendednews_disable_like_ed') ):

    /** Disable Reaction **/
    function extendednews_disable_like_ed() {

        return false;

    }

endif;

if( !function_exists('extendednews_disable_post_author_box') ):

    /** Disable Author Box **/
    function extendednews_disable_post_author_box() {

        add_filter('booster_extension_filter_ab_ed','extendednews_disable_ab_ed');

    }

endif;

if( !function_exists('extendednews_disable_ab_ed') ):

    /** Disable Reaction **/
    function extendednews_disable_ab_ed() {

        return false;

    }

endif;

add_filter('booster_extension_filter_ss_ed', 'extendednews_disable_social_share');

if( !function_exists('extendednews_disable_social_share') ):

    /** Disable Reaction **/
    function extendednews_disable_social_share() {

        return false;

    }

endif;

if( !function_exists('extendednews_disable_post_reaction') ):

    /** Disable Reaction **/
    function extendednews_disable_post_reaction() {

        add_filter('booster_extension_filter_reaction_ed', 'extendednews_disable_reaction_cb');

    }

endif;

if( !function_exists('extendednews_disable_reaction_cb') ):

    /** Disable Reaction **/
    function extendednews_disable_reaction_cb() {

        return false;

    }

endif;

if( !function_exists( 'extendednews_header_ad' ) ):

    function extendednews_header_ad(){

        $extendednews_default = extendednews_get_default_theme_options();
        $ed_header_ad = get_theme_mod( 'ed_header_ad',$extendednews_default['ed_header_ad'] );
        $header_ad_image = get_theme_mod( 'header_ad_image' );
        $ed_header_link = get_theme_mod( 'ed_header_link' );

        if( $ed_header_ad ){

            ?>
            <div class="header-extras header-extras-top">
                <div class="header-ava-area">
                    <div class="wrapper">
                        <?php if( $header_ad_image ){ ?>
                            <a target="_blank" href="<?php echo esc_url( $ed_header_link ); ?>">
                                <img src="<?php echo esc_url( $header_ad_image ); ?>" title="<?php esc_attr_e('Header AD Image','extendednews'); ?>" alt="<?php esc_attr_e('Header AD Image','extendednews'); ?>" />
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php

        }
    }

endif;

if( !function_exists('extendednews_post_floating_nav') ):

    function extendednews_post_floating_nav(){

        $extendednews_default = extendednews_get_default_theme_options();
        $ed_floating_next_previous_nav = get_theme_mod( 'ed_floating_next_previous_nav',$extendednews_default['ed_floating_next_previous_nav'] );

        if( 'post' === get_post_type() && $ed_floating_next_previous_nav ){

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if( isset( $prev_post->ID ) ){

                $prev_link = get_permalink( $prev_post->ID );?>

                <div class="floating-post-navigation floating-navigation-prev">
                    <?php if( get_the_post_thumbnail( $prev_post->ID,'medium' ) ){ ?>
                            <?php echo wp_kses_post( get_the_post_thumbnail( $prev_post->ID,'medium' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $prev_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous post', 'extendednews'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php }

            if( isset( $next_post->ID ) ){

                $next_link = get_permalink( $next_post->ID );?>

                <div class="floating-post-navigation floating-navigation-next">
                    <?php if( get_the_post_thumbnail( $next_post->ID,'medium' ) ){ ?>
                        <?php echo wp_kses_post( get_the_post_thumbnail( $next_post->ID,'medium' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $next_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next post', 'extendednews'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php
            }

        }

    }

endif;

add_action( 'extendednews_navigation_action','extendednews_post_floating_nav',10 );

if( !function_exists('extendednews_single_post_navigation') ):

    function extendednews_single_post_navigation(){

        $extendednews_default = extendednews_get_default_theme_options();
        $twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
        $extendednews_header_trending_page = get_theme_mod( 'extendednews_header_trending_page' );
        $extendednews_header_popular_page = get_theme_mod( 'extendednews_header_popular_page' );
        $extendednews_archive_layout = esc_attr( get_theme_mod( 'extendednews_archive_layout', $extendednews_default['extendednews_archive_layout'] ) );
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $extendednews_default['twp_navigation_type']);
        }

        if( $extendednews_header_trending_page != $current_id && $extendednews_header_popular_page != $current_id ){

            if( $twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

                if( $twp_navigation_type == 'norma-navigation' ){ ?>

                    <div class="navigation-wrapper">
                        <?php
                        // Previous/next post navigation.
                        the_post_navigation(array(
                            'prev_text' => '<span class="arrow" aria-hidden="true">' . extendednews_the_theme_svg('arrow-left',$return = true ) . '</span><span class="screen-reader-text">' . __('Previous post:', 'extendednews') . '</span><span class="post-title">%title</span>',
                            'next_text' => '<span class="arrow" aria-hidden="true">' . extendednews_the_theme_svg('arrow-right',$return = true ) . '</span><span class="screen-reader-text">' . __('Next post:', 'extendednews') . '</span><span class="post-title">%title</span>',
                        )); ?>
                    </div>
                    <?php

                }else{

                    $next_post = get_next_post();
                    if( isset( $next_post->ID ) ){

                        $next_post_id = $next_post->ID;
                        echo '<div loop-count="1" next-post="' . absint( $next_post_id ) . '" class="twp-single-infinity"></div>';

                    }
                }

            }

        }

    }

endif;

add_action( 'extendednews_navigation_action','extendednews_single_post_navigation',30 );


if( !function_exists('extendednews_header_banner') ):

    function extendednews_header_banner(){

        global $post;

        if( have_posts() ):

            while (have_posts()) :
                the_post();

                global $post;
                
            endwhile;
            wp_reset_postdata();

        endif;
        
        $extendednews_post_layout = '';
        $extendednews_default = extendednews_get_default_theme_options();

        if( is_singular() ){

            $extendednews_post_layout = esc_html( get_post_meta( $post->ID, 'extendednews_post_layout', true ) );
            if( $extendednews_post_layout == '' || $extendednews_post_layout == 'global-layout' ){
                
                $extendednews_post_layout = get_theme_mod( 'extendednews_single_post_layout',$extendednews_default['extendednews_archive_layout'] );
            }

        }

        if( isset( $post->ID ) ){

            $extendednews_page_layout = esc_html( get_post_meta( $post->ID, 'extendednews_page_layout', true ) );

        }

        if( $extendednews_post_layout == 'layout-2' && is_singular('post') ) {

            if ( have_posts() ) :

                while ( have_posts() ) :
                    the_post();

                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
                    $extendednews_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'extendednews_ed_feature_image', true ) );
                    ?>

                    <div class="single-featured-banner  <?php if( empty( $extendednews_ed_feature_image ) && isset( $featured_image[0] ) && $featured_image[0] ){ echo 'banner-has-image'; } ?>">

                        <div class="featured-banner-content">
                            <div class="wrapper">
                                <?php
                                if ( !is_404() && !is_home() && !is_front_page() ) {
                                    extendednews_breadcrumb();
                                } ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        <header class="entry-header">

                                            <div class="entry-meta">
                                                <?php
                                                extendednews_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false);
                                                ?>
                                            </div>

                                            <h1 class="entry-title entry-title-large">
                                                <?php the_title(); ?>
                                            </h1>
                                        </header>
                                        <div class="entry-meta">
                                            <?php
                                            extendednews_posted_by();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <?php if( empty( $extendednews_ed_feature_image ) && isset( $featured_image[0] ) && $featured_image[0] ){ ?>
                            <div class="featured-banner-media">
                                <div class="data-bg data-bg-fixed data-bg-banner" data-background="<?php echo esc_url( $featured_image[0] ); ?>"></div>
                            </div>
                        <?php } ?>

                    </div>

                <?php
                endwhile;

                wp_reset_postdata();

            endif;
               
        }

        if( is_singular('page') && $extendednews_page_layout == 'layout-2' ) {

            if ( have_posts() ) :

                while ( have_posts() ) :

                    the_post();

                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
                    
                    $extendednews_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'extendednews_ed_feature_image', true ) );
                    ?>

                    <div class="single-featured-banner  <?php if( empty( $extendednews_ed_feature_image ) && isset( $featured_image[0] ) && $featured_image[0] ){ echo 'banner-has-image'; } ?>">

                        <div class="featured-banner-content">
                            <div class="wrapper">
                                <?php
                                if ( !is_404() && !is_home() && !is_front_page() ) {
                                    extendednews_breadcrumb();
                                } ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        <header class="entry-header">

                                            <h1 class="entry-title entry-title-large">
                                                <?php the_title(); ?>
                                            </h1>
                                        </header>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <?php if( empty( $extendednews_ed_feature_image ) && isset( $featured_image[0] ) && $featured_image[0] ){ ?>
                            <div class="featured-banner-media">
                                <div class="data-bg data-bg-fixed data-bg-banner" data-background="<?php echo esc_url( $featured_image[0] ); ?>"></div>
                            </div>
                        <?php } ?>

                    </div>

                <?php
                endwhile;

                wp_reset_postdata();

            endif;
               
        }

    }

endif;

if ( ! function_exists( 'extendednews_header_toggle_search' ) ):

    /**
     * Header Search
     **/
    function extendednews_header_toggle_search() {

        $extendednews_default = extendednews_get_default_theme_options();
        $ed_header_search = get_theme_mod('ed_header_search', $extendednews_default['ed_header_search']);
        $ed_header_search_top_category = get_theme_mod( 'ed_header_search_top_category', $extendednews_default['ed_header_search_top_category'] );
        $ed_header_search_recent_posts = absint( get_theme_mod( 'ed_header_search_recent_posts',$extendednews_default['ed_header_search_recent_posts'] ) );
        if( $ed_header_search ){ ?>

            <div class="header-searchbar">
                <div class="header-searchbar-inner">
                    <div class="wrapper">
                        <div class="header-searchbar-panel">
                            <div class="header-searchbar-area">

                                <a class="skip-link-search-top" href="javascript:void(0)"></a>

                                <?php get_search_form(); ?>

                            </div>

                            <?php if( $ed_header_search_recent_posts || $ed_header_search_top_category ){ ?>

                                <div class="search-content-area">

                                    <?php if( $ed_header_search_recent_posts ){ ?>

                                        <div class="search-recent-posts">
                                            <?php extendednews_recent_posts_search(); ?>
                                        </div>

                                    <?php } ?>

                                    <?php if( $ed_header_search_top_category ){ ?>

                                        <div class="search-popular-categories">
                                            <?php extendednews_header_search_top_cat_content(); ?>
                                        </div>

                                    <?php } ?>

                                </div>

                            <?php } ?>

                            <button type="button" id="search-closer" class="close-popup">
                                <?php extendednews_the_theme_svg('cross'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }

    }

endif;

add_action( 'extendednews_before_footer_content_action','extendednews_header_toggle_search',10 );

if( !function_exists('extendednews_recent_posts_search') ):

    // Single Posts Related Posts.
    function extendednews_recent_posts_search(){

        $extendednews_default = extendednews_get_default_theme_options();
        $recent_posts_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 5,'post__not_in' => get_option("sticky_posts") ) );

        if( $recent_posts_query->have_posts() ): ?>

            <div class="theme-block related-search-posts">

                <div class="theme-block-heading">
                    <?php
                    $recent_post_title_search = esc_html( get_theme_mod( 'recent_post_title_search',$extendednews_default['recent_post_title_search'] ) );

                    if( $recent_post_title_search ){ ?>
                        <h2 class="theme-block-title">

                            <?php echo esc_html( $recent_post_title_search ); ?>

                        </h2>
                    <?php } ?>
                </div>

                <div class="theme-list-group recent-list-group">

                    <?php
                    while( $recent_posts_query->have_posts() ):
                        $recent_posts_query->the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('theme-list-article'); ?>>
                            <header class="entry-header">
                                <h3 class="entry-title entry-title-medium">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                            </header>
                        </article>

                    <?php 
                    endwhile;
                    wp_reset_postdata();
                    ?>

                </div>

            </div>

            <?php
            wp_reset_postdata();

        endif;

    }

endif;

if( !function_exists('extendednews_header_search_top_cat_content') ):

    function extendednews_header_search_top_cat_content(){

        $top_category = 4;

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $slug_counts = array();

        foreach( $post_cat_lists as $post_cat_list ){

            if( $post_cat_list->count >= 1 ){

                $slug_counts[] = array( 
                    'count'         => $post_cat_list->count,
                    'slug'          => $post_cat_list->slug,
                    'name'          => $post_cat_list->name,
                    'cat_ID'        => $post_cat_list->cat_ID,
                    'description'   => $post_cat_list->category_description, 
                );

            }

        }

        if( $slug_counts ){?>

            <div class="theme-block popular-search-categories">
                
                <div class="theme-block-heading">
                    <?php
                    $extendednews_default = extendednews_get_default_theme_options();
                    $top_category_title_search = esc_html( get_theme_mod( 'top_category_title_search',$extendednews_default['top_category_title_search'] ) );

                    if( $top_category_title_search ){ ?>
                        <h2 class="theme-block-title">

                            <?php echo esc_html( $top_category_title_search ); ?>

                        </h2>
                    <?php } ?>
                </div>

                <?php
                arsort( $slug_counts ); ?>

                <div class="theme-list-group categories-list-group">
                    <div class="column-row">

                        <?php
                        $i = 1;
                        foreach( $slug_counts as $key => $slug_count ){

                            if( $i > $top_category){ break; }
                            
                            $cat_link           = get_category_link( $slug_count['cat_ID'] );
                            $cat_name           = $slug_count['name'];
                            $twp_term_image = get_term_meta( $slug_count['cat_ID'], 'twp-term-featured-image', true ); ?>

                            <div class="column column-3 column-column-sm-12">
                                
                                <div class="post-thumb-categories">
                                    <div class="data-bg data-bg-medium thumb-overlay img-hover-slide"
                                         data-background="<?php echo esc_url($twp_term_image); ?>">
                                        <a class="img-link" href="<?php echo esc_url($cat_link); ?>"
                                           tabindex="0"></a>
                                        <div class="article-content article-content-overlay">
                                            <?php
                                            if ($cat_name) { ?>

                                                <h3 class="category-title">
                                                    <span><?php echo esc_html($cat_name); ?></span>
                                                </h3>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php
                            $i++;

                        } ?>

                    </div>
                </div>

            </div>
        <?php
        }

    }

endif;

if( !function_exists('extendednews_top_nav') ):

    function extendednews_top_nav(){

        $extendednews_default = extendednews_get_default_theme_options();
        $ed_top_header = get_theme_mod( 'ed_top_header', $extendednews_default['ed_top_header'] );
        $ed_top_header_date = get_theme_mod( 'ed_top_header_date', $extendednews_default['ed_top_header_date'] );

        if( $ed_top_header && ( has_nav_menu('extendednews-social-menu') || $ed_top_header_date ) ){ ?>

            <div id="site-topbar" class="theme-topbar">
                
                <?php extendednews_top_nav_render(); ?>

            </div>

        <?php
        }

    }

endif;

if( !function_exists('extendednews_top_nav_render') ):

    function extendednews_top_nav_render( $render = true ){

        ob_start();

        $extendednews_default = extendednews_get_default_theme_options();
        $ed_top_header = get_theme_mod( 'ed_top_header', $extendednews_default['ed_top_header'] );
        $ed_top_header_date = get_theme_mod( 'ed_top_header_date', $extendednews_default['ed_top_header_date'] );

        if( $ed_top_header && ( has_nav_menu('extendednews-social-menu') || $ed_top_header_date ) ){ ?>

            <div class="wrapper header-wrapper">
                <div class="header-item header-item-left">
                    <div class="topbar-controls">
                        <?php
                        if ($ed_top_header_date) { ?>
                            <div class="topbar-control">
                                <div class="top-nav-date">
                                    <span class="topbar-date-icon"><?php extendednews_the_theme_svg('calendar'); ?></span>
                                    <span class="topbar-date-label"><?php echo wp_kses_post(date(get_option('date_format'))); ?></span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="header-item header-item-right">


                    <?php
                    if (has_nav_menu('extendednews-social-menu')) { ?>

                        <div class="topbar-social-navigation">

                            <?php
                            wp_nav_menu(

                                array(
                                    'theme_location' => 'extendednews-social-menu',
                                    'link_before' => '<span class="screen-reader-text">',
                                    'link_after' => '</span>',
                                    'container' => 'div',
                                    'container_class' => 'extendednews-social-menu',
                                    'depth' => 1,
                                )

                            ); ?>

                        </div>

                    <?php } ?>
                </div>
            </div>

        <?php
        }

        $html = ob_get_contents();
        ob_get_clean();

        if( $render ){

            echo $html;

        }else{

            return $html;

        }

    }

endif;

if( !function_exists('extendednews_content_offcanvas') ):

    // Offcanvas Contents
    function extendednews_content_offcanvas(){

    $responsive_content = false;
    $extendednews_default = extendednews_get_default_theme_options();
    $ed_top_header = get_theme_mod( 'ed_top_header', $extendednews_default['ed_top_header'] );
    $ed_top_header_date = get_theme_mod( 'ed_top_header_date', $extendednews_default['ed_top_header_date'] );

    if( $ed_top_header && ( has_nav_menu('extendednews-social-menu') || $ed_top_header_date ) ){

        $responsive_content = true;

    }
     ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">

                <div class="close-offcanvas-menu">

                    <a class="skip-link-off-canvas" href="javascript:void(0)"></a>

                    <div class="offcanvas-close">

                        <?php if( $responsive_content ){ ?>
                            <div class="responsive-content-date"></div>
                        <?php } ?>

                        <button type="button" class="button-offcanvas-close">

                            <span class="offcanvas-close-label">
                                <?php echo esc_html__('Close', 'extendednews'); ?>
                            </span>

                            <span class="bars">
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </span>

                        </button>

                    </div>
                </div>

                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper">
                        <ul class="primary-menu theme-menu">

                            <?php
                            if( has_nav_menu('extendednews-primary-menu') ){

                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'extendednews-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );

                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new ExtendedNews_Walker_Page(),
                                    )
                                );

                            } ?>

                        </ul>
                    </nav>
                </div>

                <?php if (has_nav_menu('extendednews-social-menu')) { ?>

                    <div id="social-nav-offcanvas" class="offcanvas-item offcanvas-social-navigation">

                        <?php
                        wp_nav_menu(
                                array(
                                'theme_location' => 'extendednews-social-menu',
                                'link_before' => '<span class="screen-reader-text">',
                                'link_after' => '</span>',
                                'container' => 'div',
                                'container_class' => 'extendednews-social-menu',
                                'depth' => 1,
                            )
                        ); ?>

                    </div>

                <?php }

                if( $responsive_content ){ ?>
                    <div class="responsive-content-menu">

                    </div>
                <?php } ?>

                <a class="skip-link-offcanvas screen-reader-text" href="javascript:void(0)"></a>
                
            </div>
        </div>

    <?php
    }

endif;

add_action( 'extendednews_before_footer_content_action','extendednews_content_offcanvas',30 );

if( !function_exists('extendednews_content_trending_news_render') ):

    function extendednews_content_trending_news_render(){

        $extendednews_header_trending_cat = get_theme_mod('extendednews_header_trending_cat');
        $trending_news_query = new WP_Query(
            array(
                'post_type' => 'post',
                'posts_per_page' => 9,
                'post__not_in' => get_option("sticky_posts"),
                'category_name' => $extendednews_header_trending_cat,
            )
        );

        if( $trending_news_query->have_posts() ): ?>

            <div class="trending-news-main-wrap">
               <div class="wrapper">
                    <div class="column-row">

                        <a href="javascript:void(0)" class="extendednews-skip-link-start"></a>

                        <div class="column column-12">
                            <button type="button" id="trending-collapse">
                                <?php extendednews_the_theme_svg('cross'); ?>
                            </button>
                        </div>

                        <?php
                        $post_count = 1;
                        while( $trending_news_query->have_posts() ){
                            $trending_news_query->the_post();

                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                            <div class="column column-4 column-sm-6">

                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-bg mb-20'); ?>>
                                    <div class="column-row">

                                        <?php if( $featured_image ){ ?>

                                            <div class="column column-4">

                                                <div class="data-bg data-bg-thumbnail" data-background="<?php echo esc_url($featured_image); ?>">

                                                    <?php
                                                    $format = get_post_format(get_the_ID()) ?: 'standard';
                                                    $icon = extendednews_post_format_icon($format);
                                                    if (!empty($icon)) { ?>
                                                        <span class="top-right-icon"><?php echo extendednews_svg_escape($icon); ?></span>
                                                    <?php } ?>
                                                    <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>

                                                    <div class="trend-item">
                                                        <span class="number"> <?php echo $post_count; ?></span>
                                                    </div>
                                        
                                                </div>


                                            </div>

                                        <?php } ?>

                                        <div class="column column-<?php if ($featured_image) { ?>8<?php } else { ?>12<?php } ?>">
                                            <div class="article-content">

                                                <h3 class="entry-title entry-title-small">
                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </h3>

                                                <div class="entry-meta">
                                                    <?php extendednews_posted_on( $icon = true ); ?>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </article>
                            </div>
                            <?php
                            $post_count++;

                        } ?>

                        <a href="javascript:void(0)" class="extendednews-skip-link-end"></a>

                    </div>
               </div>
            </div>

            <?php
            wp_reset_postdata();

        endif;
    }

endif;

if( !function_exists('extendednews_footer_content_widget') ):

    function extendednews_footer_content_widget(){

        $extendednews_default = extendednews_get_default_theme_options();
        if (is_active_sidebar('extendednews-footer-widget-0') || 
            is_active_sidebar('extendednews-footer-widget-1') || 
            is_active_sidebar('extendednews-footer-widget-2')):
            $x = 1;
            $footer_sidebar = 0;
            do {
                if ($x == 3 && is_active_sidebar('extendednews-footer-widget-2')) {
                    $footer_sidebar++;
                }
                if ($x == 2 && is_active_sidebar('extendednews-footer-widget-1')) {
                    $footer_sidebar++;
                }
                if ($x == 1 && is_active_sidebar('extendednews-footer-widget-0')) {
                    $footer_sidebar++;
                }
                $x++;
            } while ($x <= 3);
            if ($footer_sidebar == 1) {
                $footer_sidebar_class = 12;
            } elseif ($footer_sidebar == 2) {
                $footer_sidebar_class = 6;
            } else {
                $footer_sidebar_class = 4;
            }
            $footer_column_layout = absint(get_theme_mod('footer_column_layout', $extendednews_default['footer_column_layout'])); ?>

            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="column-row">
                        <?php if (is_active_sidebar('extendednews-footer-widget-0')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('extendednews-footer-widget-0'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('extendednews-footer-widget-1')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('extendednews-footer-widget-1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('extendednews-footer-widget-2')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('extendednews-footer-widget-2'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        endif;

    }

endif;

add_action( 'extendednews_footer_content_action','extendednews_footer_content_widget',10 );

if( !function_exists('extendednews_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function extendednews_footer_content_info(){

        $extendednews_default = extendednews_get_default_theme_options(); ?>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-10">
                        <div class="footer-copyright">
                            <?php
                            $footer_copyright_text = wp_kses_post( get_theme_mod( 'footer_copyright_text', $extendednews_default['footer_copyright_text'] ) );
                            echo esc_html__('Copyright ', 'extendednews') . '&copy ' . absint(date('Y')) . ' <a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" ><span>' . esc_html( get_bloginfo( 'name', 'display' ) ) . '. </span></a> ' . esc_html( $footer_copyright_text );

                            echo '<br>';
                            echo esc_html__('Theme: ', 'extendednews') . 'ExtendedNews ' . esc_html__('By ', 'extendednews') . '<a href="' . esc_url('https://www.themeinwp.com/theme/extendednews') . '"  title="' . esc_attr__('Themeinwp', 'extendednews') . '" target="_blank" rel="author"><span>' . esc_html__('Themeinwp. ', 'extendednews') . '</span></a>';
                            echo esc_html__('Powered by ', 'extendednews') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'extendednews') . '" target="_blank"><span>' . esc_html__('WordPress.', 'extendednews') . '</span></a>';
                            
                            ?>
                        </div>
                    </div>

                    <?php extendednews_footer_go_to_top(); ?>

                </div>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'extendednews_footer_content_action','extendednews_footer_content_info',20 );


if( !function_exists('extendednews_footer_go_to_top') ):

    // Scroll to Top render content
    function extendednews_footer_go_to_top(){

        $extendednews_default = extendednews_get_default_theme_options();
        $ed_scroll_top_button = get_theme_mod( 'ed_scroll_top_button', $extendednews_default['ed_scroll_top_button'] );

        if( $ed_scroll_top_button ){
            
            ?>

            <div class="column column-2 hide-no-js">
                <button type="button" class="scroll-up">
                    <?php extendednews_the_theme_svg('arrow-up'); ?>
                </button>
            </div>

            <?php

        }

    }

endif;


if( !function_exists( 'extendednews_post_view_count' ) ):

    function extendednews_post_view_count(){

        $extendednews_default = extendednews_get_default_theme_options();
        $ed_post_views = get_theme_mod( 'ed_post_views', $extendednews_default['ed_post_views'] );
        $twp_be_settings = get_option('twp_be_options_settings');
        $twp_be_enable_post_visit_tracking = isset( $twp_be_settings[ 'twp_be_enable_post_visit_tracking' ] ) ? esc_html( $twp_be_settings[ 'twp_be_enable_post_visit_tracking' ] ) : '';
        if( $twp_be_enable_post_visit_tracking && class_exists( 'Booster_Extension_Class' ) ): ?>

            <div class="entry-meta-item entry-meta-views">
                <span class="entry-meta-icon views-icon">
                    <?php extendednews_the_theme_svg('viewer'); ?>
                </span>
                <a href="<?php the_permalink(); ?>">
                    <span class="post-view-count">
                       <?php
                       echo do_shortcode('[booster-extension-visit-count count_only="count" label="'.esc_html__('Views','extendednews').'"]');
                       ?>
                    </span>
                 </a>
            </div>
        
        <?php
        endif;
    }
endif;

if( !function_exists( 'extendednews_post_like_dislike' ) ):

    function extendednews_post_like_dislike(){

        $extendednews_ed_post_like_dislike = esc_html( get_post_meta( get_the_ID(), 'extendednews_ed_post_like_dislike', true ) );
        if( class_exists( 'Booster_Extension_Class' ) && !$extendednews_ed_post_like_dislike ): ?>

            <div class="entry-meta-item entry-meta-like-dislike">
                <?php echo do_shortcode('[booster-extension-like-dislike]'); ?>
            </div>
        
        <?php
        endif;
    }
endif;


add_action('wp_ajax_extendednews_tab_posts_callback', 'extendednews_tab_posts_callback');
add_action('wp_ajax_nopriv_extendednews_tab_posts_callback', 'extendednews_tab_posts_callback');

if( !function_exists( 'extendednews_tab_posts_callback' ) ):
    // Masonry Post Ajax Call Function.

    function extendednews_tab_posts_callback() {

        if(  isset( $_POST[ '_wpnonce' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ '_wpnonce' ] ) ), 'extendednews_ajax_nonce' ) && isset( $_POST['category'] ) && isset( $_POST['currencBlock'] ) && isset( $_POST['currencBlock'] ) ){

            $category = sanitize_text_field( wp_unslash( $_POST['category'] ) );

            $tab_post_query = new WP_Query( 
                array( 
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'post__not_in' => get_option("sticky_posts"),
                    'category_name' => esc_html( $category ),
                    'post_status' => 'publish'
                ) 
            );

            $tab_post_query_1 = new WP_Query( 
                array( 
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'post__not_in' => get_option("sticky_posts"),
                    'category_name' => esc_html( $category ),
                    'post_status' => 'publish'
                ) 
            );

            if( $tab_post_query ->have_posts() ): ?>

                    <div class="column-row">

                        <div class="column column-5 column-xs-12">

                        <?php
                        $post_count = 1;
                        while ($tab_post_query->have_posts()) {
                            $tab_post_query->the_post();

                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'extendednews-500-300');
                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article post-thumb post-thumb-tiles'); ?>>
                                <div class="data-bg data-bg-medium thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">

                                    <?php
                                    $format = get_post_format(get_the_ID()) ?: 'standard';
                                    $icon = extendednews_post_format_icon($format);
                                    if (!empty($icon)) { ?>
                                        <span class="top-right-icon">
                                            <?php echo extendednews_svg_escape($icon); ?>
                                        </span>
                                    <?php } ?>
                                    <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                    <div class="article-content article-content-overlay">
                                        <div class="entry-meta">
                                            <?php extendednews_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                        </div>
                                        <h3 class="entry-title entry-title-small">
                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                               title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="entry-meta">
                                            <?php extendednews_post_view_count(); ?>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <?php
                            if( $post_count == 2 ){ 
                                break;
                            }

                            $post_count++;

                        }
                        wp_reset_postdata(); ?>

                        </div>

                        <div class="column column-7 column-xs-12">
                            <div class="content-main">

                                <?php
                                $post_count = 1;
                                while ($tab_post_query_1->have_posts()) {
                                    $tab_post_query_1->the_post();

                                        if( $post_count != 1 && $post_count != 2 ){

                                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
                                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                                            <div class="content-list">
                                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article tab-news-article news-article-bg'); ?>>

                                                        <?php if ($featured_image) { ?>
                                                            <div class="data-bg thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">

                                                                <?php
                                                                $format = get_post_format(get_the_ID()) ?: 'standard';
                                                                $icon = extendednews_post_format_icon($format);
                                                                if (!empty($icon)) { ?>
                                                                    <span class="top-right-icon">
                                                                        <?php echo extendednews_svg_escape($icon); ?>
                                                                    </span>
                                                                <?php } ?>
                                                                <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                                                
                                                            </div>
                                                        <?php } ?>

                                                        <div class="article-content">
                                                            <h3 class="entry-title entry-title-small">
                                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                            <div class="entry-meta-wrapper">
                                                                <div class="entry-meta entry-meta-1">
                                                                    <?php extendednews_posted_on( $icon = true ); ?>
                                                                </div>
                                                                <div class="entry-meta">
                                                                    <?php extendednews_post_view_count(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </article>
                                            </div>

                                        <?php
                                        }

                                        $post_count++;

                                } ?>

                            </div>
                        </div>


                    </div>

                <?php
                wp_reset_postdata();

            endif;
        }

        wp_die();
    }

endif;

if( !function_exists( 'extendednews_header_ticker_posts' ) ):

    function extendednews_header_ticker_posts(){

        $extendednews_default = extendednews_get_default_theme_options();
        $ed_header_ticker_posts = get_theme_mod( 'ed_header_ticker_posts',$extendednews_default['ed_header_ticker_posts'] );
        $ed_header_ticker_posts_title = get_theme_mod( 'ed_header_ticker_posts_title',$extendednews_default['ed_header_ticker_posts_title'] );
        $extendednews_header_ticker_cat = get_theme_mod( 'extendednews_header_ticker_cat' );
        $slider_autoplay = get_theme_mod( 'ed_ticker_slider_autoplay',$extendednews_default['ed_ticker_slider_autoplay'] );
        $ticker_slider_wide_layout = get_theme_mod( 'ed_ticker_slider_wide_layout',$extendednews_default['ed_ticker_slider_wide_layout'] );
        
        $class = 'wrapper';

        if( $ticker_slider_wide_layout ){
            $class = 'wrapper-fluid';
        }

        if( $slider_autoplay ){
            $autoplay = 'true';
        }else{
            $autoplay = 'false';
        }
        
        if( is_rtl() ) {
            $rtl = 'true';
        }else{
            $rtl = 'false';
        }

        if( $ed_header_ticker_posts ){ ?>

            <div class="theme-ticker-area hide-no-js">
                <div class="<?php echo $class; ?>">
                    <div class="column-row column-row-collapse">

                        <?php if( $ed_header_ticker_posts_title ){ ?>
                            <div class="column column-2 column-sm-12 ticker-area-bg">
                                <div class="ticker-title">
                                    <span class="ticker-title-label"><?php echo esc_html( $ed_header_ticker_posts_title ); ?></span>

                                    <div class="ticker-controls">
                                        <div class="title-controls">
                                            <button type="button" class="slide-btn theme-aria-button slide-prev-ticker">
                                                <span class="btn__content" tabindex="-1">
                                                    <?php extendednews_the_theme_svg('chevron-left'); ?>
                                                </span>
                                            </button>

                                            <button type="button" class="slide-btn theme-aria-button ticker-control ticker-control-play">
                                                <span class="btn__content" tabindex="-1">
                                                    <?php extendednews_the_theme_svg('play'); ?>
                                                </span>
                                            </button>

                                            <button type="button" class="slide-btn theme-aria-button ticker-control ticker-control-pause pp-button-active">
                                                <span class="btn__content" tabindex="-1">
                                                    <?php extendednews_the_theme_svg('pause'); ?>
                                                </span>
                                            </button>

                                            <button type="button" class="slide-btn theme-aria-button slide-next-ticker">
                                                <span class="btn__content" tabindex="-1">
                                                    <?php extendednews_the_theme_svg('chevron-right'); ?>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        $ticker_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 10, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($extendednews_header_ticker_cat)));

                        if( $ticker_posts_query->have_posts() ): ?>
                            <div class="column column-10 column-sm-12">
                                <div class="ticker-content">
                                    <div class="ticker-slides"
                                         data-slick='{"autoplay": <?php echo esc_attr($autoplay); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>

                                        <?php
                                        while ($ticker_posts_query->have_posts()):
                                            $ticker_posts_query->the_post();

                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                                            <div class="ticker-item">
                                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article post-thumb post-thumb-ticker'); ?>>
                                                    <div class="data-bg data-bg-small thumb-overlay img-hover-slide"
                                                         data-background="<?php echo esc_url($featured_image); ?>">

                                                        <?php
                                                        $format = get_post_format(get_the_ID()) ?: 'standard';
                                                        $icon = extendednews_post_format_icon($format);
                                                        if (!empty($icon)) { ?>
                                                            <span class="top-right-icon">
                                                            <?php echo extendednews_svg_escape($icon); ?>
                                                        </span>
                                                        <?php } ?>
                                                        <a class="img-link" href="<?php the_permalink(); ?>"
                                                           tabindex="0"></a>
                                                        <div class="article-content article-content-overlay">

                                                            <h3 class="entry-title entry-title-small">
                                                                <a href="<?php the_permalink(); ?>" tabindex="0"
                                                                   rel="bookmark"
                                                                   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                            <div class="entry-meta-wrapper">
                                                                <div class="entry-meta entry-meta-1">
                                                                    <?php extendednews_posted_on( $icon = true ); ?>
                                                                </div>
                                                                <div class="entry-meta">
                                                                    <?php extendednews_post_view_count(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>

                                        <?php
                                        endwhile; ?>

                                    </div>


                                </div>
                            </div>
                            <?php 
                            wp_reset_postdata();
                        endif; ?>

                    </div>
                </div>
            </div>

        <?php
        }

    }

endif;


if( class_exists('WooCommerce') ){

    remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
    add_action('woocommerce_before_main_content','extendednews_woo_before_main_content',5);
    add_action('woocommerce_after_main_content','extendednews_woo_after_main_content',15);

}
if( !function_exists('extendednews_woo_before_main_content') ):

    function extendednews_woo_before_main_content(){

        echo '<div class="wrapper">';
        echo '<div class="column-row">';

    }

endif;

if( !function_exists('extendednews_woo_after_main_content') ):

    function extendednews_woo_after_main_content(){

        $extendednews_default = extendednews_get_default_theme_options();
        $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $extendednews_default['global_sidebar_layout'] ) );
        if( $sidebar != 'no-sidebar' ){

            get_sidebar();
            
        }

        echo '</div>';
        echo '</div>';

    }

endif;


if( !function_exists('extendednews_content_loading') ){

    function extendednews_content_loading(){ ?>

        <div class="content-loading-status">
            <div class="theme-ajax-loader"></div>
            <div class="screen-reader-text">
                <?php esc_html_e('Content Loading','extendednews'); ?>
            </div>
        </div>
    
    <?php
    }
}


function extendednews_hex2rgb( $colour,$opacity = 1 ) {

    if ( $colour[0] == '#' ) {
            $colour = substr( $colour, 1 );
    }
    if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
            return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return 'rgba('.$r.','.$g.','.$b.','.$opacity.')';

}

if( !function_exists( 'extendednews_top_tages' ) ):

    function extendednews_top_tages() {
        $extendednews_default = extendednews_get_default_theme_options();
        $ed_header_tags = get_theme_mod( 'ed_header_tags',$extendednews_default['ed_header_tags'] );
        $select_tag_or_cat = get_theme_mod( 'select_tag_or_cat',$extendednews_default['select_tag_or_cat'] );

        $latest_post_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 50, 'post__not_in' => get_option("sticky_posts") ) );
        $tag_lists = array();
        $post = get_post();
        $cats = get_the_category($post->ID );
        $cat_lists = array();

        if( $latest_post_query->have_posts() ):

            while( $latest_post_query->have_posts() ):
                $latest_post_query->the_post();
                if ($select_tag_or_cat == 'tags') {
                    $tags = get_the_tags( get_the_ID() );

                    if( $tags ){

                        foreach( $tags as $tag ){

                            if( !in_array($tag->term_id, $tag_lists) ){
                                
                                $tag_lists[ $tag->term_id ] = $tag->count;

                            }

                        }

                    }
                } else{
                    if ($cats){

                        foreach( $cats as $cat ){

                            if( !in_array($cat->term_id, $cat_lists) ){

                                $cat_lists[ $cat->term_id ] = $cat->count; ?>
                            <?php }

                        }
                    }
                }


            endwhile;

        endif;
        
        if( $ed_header_tags ){

            $ed_header_tags_title = get_theme_mod( 'ed_header_tags_title',$extendednews_default['ed_header_tags_title'] );
            $ed_header_tags_count = get_theme_mod( 'ed_header_tags_count',$extendednews_default['ed_header_tags_count'] );
            $ed_tags_wide_layout = get_theme_mod( 'ed_tags_wide_layout',$extendednews_default['ed_tags_wide_layout'] );
        
            $class = 'wrapper';

            if( $ed_tags_wide_layout ){
                $class = 'wrapper-fluid';
            }
            ?>
            <div class="theme-tags-area">
                <div class="<?php echo $class; ?>">
                    <div class="tags-area clear">
                        
                        <?php if( $ed_header_tags_title ){ ?>
                            <div class="tags-title">
                                <span><?php echo esc_html( $ed_header_tags_title ); ?></span>
                            </div>
                        <?php } ?>


                        <div class="tags-content">
                            <?php
                            if ($select_tag_or_cat == 'tags') {
                                if ($tag_lists) {
                                    arsort( $tag_lists);
                                    $count  = 1;
                                    foreach( $tag_lists as $key => $value ){


                                        $tag = get_tag($key); // <-- your tag ID
                                        ?>
                                        <a href="<?php echo esc_url(get_tag_link($key)); ?>" class="tags-title-label">
                                            <span><?php echo esc_html($tag->name); ?></span>
                                        </a>
                                        <?php

                                        if( $count == $ed_header_tags_count ){ break; }
                                        $count++;
                                    }
                                }
                            } else {
                                if ($cat_lists) {
                                    $count  = 1;
                                    arsort( $cat_lists);
                                    foreach( $cats as $cat ){ ?>
                                            <a href="<?php echo esc_url(get_category_link($cat)); ?>" class="tags-title-label">
                                                <span><?php echo esc_html($cat->name); ?></span>
                                            </a>
                                        <?php 
                                        if( $count == $ed_header_tags_count ){ break; }
                                        $count++;
                                    }
                                }
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }

    }

endif;


if( class_exists( 'Booster_Extension_Class' ) ){

    add_filter('booster_extemsion_content_after_filter','extendednews_after_content_pagination');

}

if( !function_exists('extendednews_after_content_pagination') ):

    function extendednews_after_content_pagination($after_content){

        $pagination_single = wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'extendednews' ),
                    'after'  => '</div>',
                    'echo' => false
                ) );

        $after_content =  $pagination_single.$after_content;

        return $after_content;

    }

endif;

if( ! function_exists( 'extendednews_iframe_escape' ) ):
    
    /** Escape Iframe **/
    function extendednews_iframe_escape( $input ){

        $all_tags = array(
            'iframe'=>array(
                'width'=>array(),
                'height'=>array(),
                'src'=>array(),
                'frameborder'=>array(),
                'allow'=>array(),
                'allowfullscreen'=>array(),
            ),
            'video'=>array(
                'width'=>array(),
                'height'=>array(),
                'src'=>array(),
                'style'=>array(),
                'controls'=>array(),
            )
        );

        return wp_kses($input,$all_tags);
        
    }

endif;

if( ! function_exists( 'extendednews_post_permalink' ) ):
    
    function extendednews_post_permalink(){
        ?><div class="entry-read-more"><a href="<?php the_permalink(); ?>" class="theme-button theme-button-filled theme-button-small"><?php esc_html_e('Read More','extendednews'); ?></a></div><?php
    }

endif;

if( !function_exists('extendednews_search_offcanvas_icon_render') ):

    function extendednews_search_offcanvas_icon_render(){

        $extendednews_default = extendednews_get_default_theme_options();
        $ed_header_trending_news = get_theme_mod('ed_header_trending_news', $extendednews_default['ed_header_trending_news']); ?>

        <div class="navbar-controls hide-no-js">
            <?php
            $ed_header_search = get_theme_mod('ed_header_search', $extendednews_default['ed_header_search']);
            if ($ed_header_search) { ?>
                <button type="button" class="navbar-control navbar-control-search">
                    <span class="navbar-control-trigger" tabindex="-1"><?php extendednews_the_theme_svg('search'); ?></span>
                </button>
            <?php } ?>

            <button type="button" class="navbar-control navbar-control-offcanvas">
                <span class="navbar-control-trigger" tabindex="-1"><?php extendednews_the_theme_svg('menu'); ?></span>
            </button>

        </div>

    <?php
    }

endif;



if( !function_exists('extendednews_video_aspect_ratio') ):

    function extendednews_video_aspect_ratio(){

        return $extendednews_video_aspect_ratio = array(
            'global' => esc_html__( 'Global', 'extendednews' ),
            'default' => esc_html__( 'Default', 'extendednews' ),
            'square' => esc_html__( 'Square', 'extendednews' ),
            'portrait' => esc_html__( 'Portrait', 'extendednews' ),
            'landscape' => esc_html__( 'Landscape', 'extendednews' ),
        );

    }

endif;

if( !function_exists('extendednews_video_autoplay') ):

    function extendednews_video_autoplay(){

        return $extendednews_video_autoplay = array(
            'global' => esc_html__( 'Global', 'extendednews' ),
            'autoplay-disable' => esc_html__( 'Disable Autoplay', 'extendednews' ),
            'autoplay-enable' => esc_html__( 'Enable Autoplay', 'extendednews' ),
            
        );

    }

endif;

add_filter('comment_form_defaults','extendednews_comment_title_callback');

if( !function_exists('extendednews_comment_title_callback') ):


    function extendednews_comment_title_callback($defaults){

        $defaults['title_reply_before'] = '<header class="block-title-wrapper"><h3 class="block-title">';
        $defaults['title_reply_after'] = '</h3></header>';
        return $defaults;

    }

endif;