<?php
/**
 * Widget FUnctions.
 *
 * @package ExtendedNews
 */
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function extendednews_widgets_init(){

    $extendednews_default = extendednews_get_default_theme_options();

    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'extendednews'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'extendednews'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar( array(
        'name' => esc_html__('Offcanvas Widget', 'extendednews'),
        'id' => 'extendednews-offcanvas-widget',
        'description' => esc_html__('Add widgets here.', 'extendednews'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Header Advertisement One', 'extendednews'),
        'id' => 'extendednews-header-1',
        'description' => esc_html__('Add widgets here.', 'extendednews'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    $twp_extendednews_home_sections_1 = get_theme_mod('twp_extendednews_home_sections_1', json_encode($extendednews_default['twp_extendednews_home_sections_1']));
    $twp_extendednews_home_sections_1 = json_decode($twp_extendednews_home_sections_1);

    foreach( $twp_extendednews_home_sections_1 as $extendednews_home_section ){

        $home_section_type = isset( $extendednews_home_section->home_section_type ) ? $extendednews_home_section->home_section_type : '';

        switch( $home_section_type ){

            case 'home-widget-area':

                $ed_home_widget_area = isset( $extendednews_home_section->section_ed ) ? $extendednews_home_section->section_ed : '';

                if( $ed_home_widget_area == 'yes' ){

                    register_sidebar(array(
                        'name' => esc_html__('Homepage Main Widget Area', 'extendednews'),
                        'id' => 'extendednews-home-main-widget-area',
                        'description' => esc_html__('Add widgets here.', 'extendednews'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h2 class="block-title"><span>',
                        'after_title' => '</span></h2>',
                    ));

                    $enable_sidebar = isset( $extendednews_home_section->enable_sidebar ) ? $extendednews_home_section->enable_sidebar : '';

                    if( $enable_sidebar == 'yes' ){

                        register_sidebar(array(
                            'name' => esc_html__('Homepage Sidebar Widget Area', 'extendednews'),
                            'id' => 'extendednews-home-sidebar-widget-area',
                            'description' => esc_html__('Add widgets here.', 'extendednews'),
                            'before_widget' => '<div id="%1$s" class="widget %2$s">',
                            'after_widget' => '</div>',
                            'before_title' => '<h3 class="widget-title"><span>',
                            'after_title' => '</span></h3>',
                        ));

                    }

                }

                break;

            default:

                break;

        }

    }

    $extendednews_default = extendednews_get_default_theme_options();
    $footer_column_layout = absint(get_theme_mod('footer_column_layout', $extendednews_default['footer_column_layout']));

    for( $i = 0; $i < $footer_column_layout; $i++ ){

        if ($i == 0) {
            $count = esc_html__('One', 'extendednews');
        }
        if ($i == 1) {
            $count = esc_html__('Two', 'extendednews');
        }
        if ($i == 2) {
            $count = esc_html__('Three', 'extendednews');
        }

        register_sidebar(array(
            'name' => esc_html__('Footer Widget ', 'extendednews') . $count,
            'id' => 'extendednews-footer-widget-' . $i,
            'description' => esc_html__('Add widgets here.', 'extendednews'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));

    }

}

add_action('widgets_init', 'extendednews_widgets_init');
require get_template_directory() . '/inc/widgets/widget-base.php';
require get_template_directory() . '/inc/widgets/author.php';
require get_template_directory() . '/inc/widgets/category.php';
require get_template_directory() . '/inc/widgets/recent-post.php';
require get_template_directory() . '/inc/widgets/social-link.php';
require get_template_directory() . '/inc/widgets/tab-posts.php';
require get_template_directory() . '/inc/widgets/carousel.php';
require get_template_directory() . '/inc/widgets/slider.php';
require get_template_directory() . '/inc/widgets/cat-posts.php';
require get_template_directory() . '/inc/widgets/list-posts.php';
require get_template_directory() . '/inc/widgets/post-grid.php';
require get_template_directory() . '/inc/widgets/tiles.php';
require get_template_directory() . '/inc/widgets/featured-category.php';