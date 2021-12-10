<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ExtendedNews
 * @since 1.0.0
 */
get_header();

$current_id = '';
if( have_posts() ):
    while (have_posts()) :
    the_post();
        $current_id  = get_the_ID();
    endwhile;
    wp_reset_postdata();
endif;
    
    $extendednews_default = extendednews_get_default_theme_options();
    $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $extendednews_default['global_sidebar_layout'] ) );
    $extendednews_post_sidebar = esc_attr( get_post_meta( $current_id, 'extendednews_post_sidebar_option', true ) );
    $twp_navigation_type = esc_attr( get_post_meta( $current_id, 'twp_disable_ajax_load_next_post', true ) );
    $extendednews_header_trending_page = get_theme_mod( 'extendednews_header_trending_page' );
    $extendednews_header_popular_page = get_theme_mod( 'extendednews_header_popular_page' );
    $extendednews_archive_layout = esc_attr( get_theme_mod( 'extendednews_archive_layout', $extendednews_default['extendednews_archive_layout'] ) );
    $article_wrap_class = '';
    $single_layout_class = ' single-layout-default';

    if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
        $twp_navigation_type = get_theme_mod('twp_navigation_type', $extendednews_default['twp_navigation_type']);
    }

    if( $extendednews_post_sidebar == 'global-sidebar' || empty( $extendednews_post_sidebar ) ){
        $sidebar = $sidebar;
    }else{
        $sidebar = $extendednews_post_sidebar;
    }
    $extendednews_post_layout = esc_attr( get_post_meta( $current_id, 'extendednews_post_layout', true ) );
    if( $extendednews_post_layout == '' || $extendednews_post_layout == 'global-layout' ){
        
        $extendednews_post_layout = get_theme_mod( 'extendednews_single_post_layout',$extendednews_default['extendednews_archive_layout'] );
    }
    if( $extendednews_post_layout == 'layout-2' ){
        $single_layout_class = ' single-layout-banner';
    }
    if( $extendednews_header_trending_page == $current_id || $extendednews_header_popular_page == $current_id ){
        $article_wrap_class = 'archive-layout-' . esc_attr($extendednews_archive_layout);
        $single_layout_class = '';
    }
    $extendednews_header_trending_page = get_theme_mod( 'extendednews_header_trending_page' );
    $extendednews_header_popular_page = get_theme_mod( 'extendednews_header_popular_page' );
    if( $extendednews_header_trending_page == get_the_ID() || $extendednews_header_popular_page == get_the_ID() ){

        $breadcrumb = true;

    }
    $extendednews_ed_post_rating = esc_html( get_post_meta( $post->ID, 'extendednews_ed_post_rating', true ) ); ?>

    <div class="singular-main-block">
        <div class="wrapper">
            <div class="column-row">

                <div id="primary" class="content-area">
                    <main id="main" class="site-main <?php if( $extendednews_ed_post_rating ){ echo 'extendednews-no-comment'; } ?>" role="main">

                        <?php
                        if( !is_home() && !is_front_page() && ( isset( $breadcrumb ) || $extendednews_post_layout != 'layout-2' ) ) {
                            extendednews_breadcrumb();
                        }

                        if( have_posts() ): ?>

                            <div class="article-wraper single-layout <?php echo esc_attr($article_wrap_class.$single_layout_class); ?>">

                                <?php while (have_posts()) :
                                    the_post();

                                    get_template_part('template-parts/content', 'single');

                                    /**
                                     *  Output comments wrapper if it's a post, or if comments are open,
                                     * or if there's a comment number – and check for password.
                                    **/
                                    if ( $extendednews_header_trending_page != $current_id && $extendednews_header_popular_page != $current_id ) {

                                        if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && !post_password_required() ) { ?>

                                            <div class="comments-wrapper">
                                                <?php comments_template(); ?>
                                            </div>

                                        <?php
                                        }
                                    }

                                endwhile; ?>

                            </div>

                        <?php
                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;

                        /**
                         * Navigation
                         * 
                         * @hooked extendednews_post_floating_nav - 10
                         * @hooked extendednews_related_posts - 20  
                         * @hooked extendednews_single_post_navigation - 30  
                        */

                        do_action('extendednews_navigation_action'); ?>

                    </main><!-- #main -->
                </div>

                <?php
                if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                    $sidebar_status = false;
                }else{
                    $sidebar_status = true;
                }
                if ( $sidebar != 'no-sidebar' && $sidebar_status ) {
                    get_sidebar();
                } ?>

            </div>
        </div>
    </div>

<?php
get_footer();
