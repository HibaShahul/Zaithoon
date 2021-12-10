<?php
/**
 * Header Layout 2
 *
 * @package ExtendedNews
 */

use extendednews\ExtendedNews_Walkernav;

$extendednews_default = extendednews_get_default_theme_options();
$extendednews_header_bg_size = get_theme_mod( 'extendednews_header_bg_size', $extendednews_default['extendednews_header_bg_size'] );
$ed_header_bg_fixed = get_theme_mod( 'ed_header_bg_fixed', $extendednews_default['ed_header_bg_fixed'] );
$ed_header_bg_overlay = get_theme_mod( 'ed_header_bg_overlay', $extendednews_default['ed_header_bg_overlay'] ); ?>

<header id="site-header" class="theme-header <?php if( $ed_header_bg_overlay ){ echo 'header-overlay-enabled'; } ?>" role="banner">
    
    <div class="header-navbar header-navbar-top <?php if( get_header_image() ){ if( $ed_header_bg_fixed ){ echo 'data-bg-fixed'; } ?> data-bg header-bg-<?php echo esc_attr( $extendednews_header_bg_size ); ?> <?php } ?> "  <?php if( get_header_image() ){ ?> data-background="<?php echo esc_url(get_header_image()); ?>" <?php } ?>>
        <div class="wrapper header-wrapper">
            <div class="header-item header-item-left">
                <div class="header-titles">
                    <?php
                    extendednews_site_logo();
                    extendednews_site_description();
                    ?>
                </div>
            </div>

            <div class="header-item header-item-right">
                <?php extendednews_header_ad(); ?>
            </div>
        </div>


    </div>
    <div class="header-navbar header-navbar-bottom">
        <div class="wrapper header-wrapper">
            <div class="header-item header-item-left">
                <?php if (is_active_sidebar('extendednews-offcanvas-widget')): ?>
                    <div id="widgets-nav" class="icon-sidr">
                        <a href="javascript:void(0)" id="hamburger-one">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="site-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'extendednews'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if( has_nav_menu('extendednews-primary-menu') ){

                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'extendednews-primary-menu',
                                        'walker' => new extendednews\ExtendedNews_Walkernav(),
                                    )
                                );

                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'walker' => new ExtendedNews_Walker_Page(),
                                    )
                                );

                            } ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="header-item header-item-right">
                <?php extendednews_search_offcanvas_icon_render(); ?>
                <?php
                $ed_header_trending_news = get_theme_mod('ed_header_trending_news', $extendednews_default['ed_header_trending_news']);
                if ($ed_header_trending_news) {
                    $ed_header_trending_posts_title = get_theme_mod('ed_header_trending_posts_title', $extendednews_default['ed_header_trending_posts_title']); ?>
                    <div class="topbar-trending">
                        <button type="button" class="navbar-control navbar-control-trending-news">
                                <span class="navbar-control-trigger" tabindex="-1">
                                    <span class="navbar-controller">
                                        <span class="navbar-control-icon">
                                            <?php extendednews_the_theme_svg('blaze'); ?>
                                        </span>
                                        <span class="navbar-control-label">
                                            <?php echo esc_html($ed_header_trending_posts_title); ?>
                                        </span>
                                    </span>
                                </span>
                        </button>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php extendednews_content_trending_news_render(); ?>
    </div>

</header>
