<?php
/**
 * Advertise
 *
 * @package ExtendedNews
 */
if (!function_exists('extendednews_main_banner')):
    function extendednews_main_banner($extendednews_home_section, $repeat_times)
    {
        $section_post_slide_cat = esc_html(isset($extendednews_home_section->section_post_slide_cat) ? $extendednews_home_section->section_post_slide_cat : '');
        $section_vertical_slide_category = esc_html(isset($extendednews_home_section->section_vertical_slide_category) ? $extendednews_home_section->section_vertical_slide_category : '');
        $slider_arrows = esc_html(isset($extendednews_home_section->ed_arrows_carousel) ? $extendednews_home_section->ed_arrows_carousel : '');
        $slider_dots = esc_html(isset($extendednews_home_section->ed_dots_carousel) ? $extendednews_home_section->ed_dots_carousel : '');
        $slider_autoplay = esc_html(isset($extendednews_home_section->ed_autoplay_carousel) ? $extendednews_home_section->ed_autoplay_carousel : '');
        $enable_wide_layout = esc_html(isset($extendednews_home_section->enable_wide_layout) ? $extendednews_home_section->enable_wide_layout : '');
        $home_section_title_1 = isset($extendednews_home_section->home_section_title_1) ? $extendednews_home_section->home_section_title_1 : '';
        $home_section_title_3 = isset($extendednews_home_section->home_section_title_3) ? $extendednews_home_section->home_section_title_3 : '';
        $class = 'wrapper';
        if ($enable_wide_layout == 'yes') {
            $class = 'wrapper-fluid';
        }
        if ($slider_arrows == 'yes' || $slider_arrows == '') {
            $arrow = 'true';
        } else {
            $arrow = 'false';
        }
        if ($slider_autoplay == 'yes' || $slider_autoplay == '') {
            $autoplay = 'true';
        } else {
            $autoplay = 'false';
        }
        if ($slider_dots == 'yes') {
            $dots = 'true';
        } else {
            $dots = 'false';
        }
        if (is_rtl()) {
            $rtl = 'true';
        } else {
            $rtl = 'false';
        }
        $banner_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_slide_cat)));
        $banner_query_3 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 12, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_vertical_slide_category))); ?>
        <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-main-banner">
            <div class="<?php echo $class; ?>">
                <div class="column-row">
                    <?php
                    if ($banner_query_1->have_posts()): ?>
                        <div class="column column-6 column-sm-12 mb-sm-15 column-order-1">
                            <?php if( $home_section_title_1 ){ ?>
                                    <header class="block-title-wrapper">
                                        <?php if( $home_section_title_1 ){ ?>
                                            <h2 class="block-title">
                                                <?php echo esc_html( $home_section_title_1 ); ?>
                                            </h2>
                                        
                                        <?php } ?>
                                        <?php if( $arrow == 'true' ){ ?>
                                            <div class="theme-heading-controls">
                                                <div class="title-controls">
                                                    <button type="button" class="slide-btn slide-btn-small slide-prev-lead">
                                                        <?php extendednews_the_theme_svg('chevron-left'); ?>
                                                    </button>
                                                    <button type="button" class="slide-btn slide-btn-small slide-next-lead">
                                                        <?php extendednews_the_theme_svg('chevron-right'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </header>
                            <?php } ?>
                            <div class="theme-slider-wrapper">
                                <div class="theme-main-slider-block"
                                     data-slick='{"arrows": <?php echo esc_attr($arrow); ?>,"autoplay": <?php echo esc_attr($autoplay); ?>, "dots": <?php echo esc_attr($dots); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>
                                    <?php
                                    while ($banner_query_1->have_posts()) {
                                        $banner_query_1->the_post();
                                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                        $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                                        <div class="theme-slider-item">
                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-bg post-thumb'); ?>>
                                                <div class="data-bg data-bg-xl-large thumb-overlay thumb-overlay-darker img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                                    <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                                    <div class="article-content article-content-overlay">
                                                        <div class="entry-meta">
                                                            <?php extendednews_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                        </div>
                                                        <h2 class="entry-title entry-title-big">
                                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                        </h2>
                                                        <div class="entry-content hidden-xs-element text-white entry-content-small">
                                                            <?php
                                                            if (has_excerpt()) {
                                                                the_excerpt();
                                                            } else {
                                                                echo '<p>';
                                                                echo esc_html( wp_trim_words( get_the_content(),25,'...' ) );
                                                                echo '</p>';
                                                            } ?>
                                                        </div>
                                                        <div class="entry-footer">
                                                            <div class="entry-meta">
                                                                <?php extendednews_posted_by(); ?>
                                                                <?php extendednews_post_view_count(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif;
                    if ($banner_query_3->have_posts()): ?>
                        <div class="column column-6 column-sm-6 column-xs-12 mb-sm-15 column-order-2 main-banner-vertical-nav">
                            <?php if( $home_section_title_3 ){ ?>
                                    <header class="block-title-wrapper">
                                        <?php if( $home_section_title_3 ){ ?>
                                            <h2 class="block-title">
                                                <?php echo esc_html( $home_section_title_3 ); ?>
                                            </h2>
                                        
                                        <?php } ?>
                                        <div class="theme-heading-controls">
                                            <div class="title-controls">
                                                <button type="button" class="slide-btn slide-btn-small slide-prev-lead">
                                                    <?php extendednews_the_theme_svg('chevron-up'); ?>
                                                </button>
                                                <button type="button" class="slide-btn slide-btn-small slide-next-lead">
                                                    <?php extendednews_the_theme_svg('chevron-down'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </header>
                            <?php } ?>
                            <div class="main-banner-vertical">
                                <?php
                                $post_count = 1;
                                while ($banner_query_3->have_posts()) {
                                    $banner_query_3->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                    $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                                    <div class="vertical-slide-list">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-bg'); ?>>
                                            <div class="column-row">
                                                <div class="column column-5 column-sm-4">
                                                    <div class="data-bg data-bg-small" data-background="<?php echo esc_url($featured_image); ?>">
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
                                                <div class="column column-<?php if ($featured_image) { ?>7<?php } else { ?>12<?php } ?> column-sm-8">
                                                    <div class="article-content">
                                                        <h3 class="entry-title entry-title-medium">
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
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <?php
                                    $post_count++;
                                } ?>
                            </div>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif; ?>
                </div>
            </div>
        </div>
    <?php }
endif; ?>