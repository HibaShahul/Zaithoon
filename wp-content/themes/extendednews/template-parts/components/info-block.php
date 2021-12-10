<?php
/**
 * Banner Blocks One
 *
 * @package ExtendedNews
 */
if (!function_exists('extendednews_banner_block_1_section')):
    function extendednews_banner_block_1_section($extendednews_home_section, $repeat_times)
    {
        $section_post_slide_cat = esc_html(isset($extendednews_home_section->section_post_slide_cat) ? $extendednews_home_section->section_post_slide_cat : '');
        
        $section_category_1 = esc_html(isset($extendednews_home_section->section_category_1) ? $extendednews_home_section->section_category_1 : '');
        $section_category_2 = esc_html(isset($extendednews_home_section->section_category_2) ? $extendednews_home_section->section_category_2 : '');
        $section_category_3 = esc_html(isset($extendednews_home_section->section_category_3) ? $extendednews_home_section->section_category_3 : '');
        $section_category_4 = esc_html(isset($extendednews_home_section->section_category_4) ? $extendednews_home_section->section_category_4 : '');
        
        $enable_wide_layout = esc_html(isset($extendednews_home_section->enable_wide_layout) ? $extendednews_home_section->enable_wide_layout : '');

        $class = 'wrapper';

        if ($enable_wide_layout == 'yes') {
            $class = 'wrapper-fluid';
        }

        $ed_tab = esc_html(isset($extendednews_home_section->ed_tab) ? $extendednews_home_section->ed_tab : '');
        $ed_flip_column = esc_html(isset($extendednews_home_section->ed_flip_column) ? $extendednews_home_section->ed_flip_column : '');
        $home_section_title_1 = esc_html(isset($extendednews_home_section->home_section_title_1) ? $extendednews_home_section->home_section_title_1 : '');
        $home_section_title_2 = esc_html(isset($extendednews_home_section->home_section_title_2) ? $extendednews_home_section->home_section_title_2 : '');
        $banner_post_slide_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_slide_cat)));
        $slider_arrows = esc_html(isset($extendednews_home_section->ed_arrows_carousel) ? $extendednews_home_section->ed_arrows_carousel : '');
        $slider_dots = esc_html(isset($extendednews_home_section->ed_dots_carousel) ? $extendednews_home_section->ed_dots_carousel : '');
        $slider_autoplay = esc_html(isset($extendednews_home_section->ed_autoplay_carousel) ? $extendednews_home_section->ed_autoplay_carousel : '');
        
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
        if ($ed_tab == 'yes' && ($section_category_1 || $section_category_2 || $section_category_3 || $section_category_4)) {
            $cat_array = array();
            if ($section_category_1) {
                $cat_array[] = $section_category_1;
            }
            if ($section_category_2) {
                $cat_array[] = $section_category_2;
            }
            if ($section_category_3) {
                $cat_array[] = $section_category_3;
            }
            if ($section_category_4) {
                $cat_array[] = $section_category_4;
            }
            $banner_query_all = new WP_Query(
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'post__not_in' => get_option("sticky_posts"),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => $cat_array,
                        ),
                    ),
                )
            );
        } else {
            $banner_query_all = new WP_Query(
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 5,
                    'post__not_in' => get_option("sticky_posts"),
                    'category_name' => esc_html($section_category_1)
                )
            );
        }
        ?>
        <div id="theme-block-<?php echo esc_attr($repeat_times); ?>"
             repeat-time="<?php echo esc_attr('repeat-time-' . $repeat_times); ?>"
             id="theme-block-<?php echo esc_attr($repeat_times); ?>"
             class="theme-block theme-block-elements theme-block-navtabs <?php echo esc_attr('repeat-time-' . $repeat_times);
             if (empty($home_section_title_1)) {
                 echo ' no-title-slide';
             }
             if (empty($home_section_title_2)) {
                 echo ' no-title-tab';
             } ?>">
            <div class="<?php echo $class; ?>">
                <div class="column-row">
                    <?php if ($banner_post_slide_query->have_posts()): ?>
                        <div class="column column-5 column-sm-12 column-xs-12 <?php if ($ed_flip_column != 'yes') { ?>column-order-1<?php } else { ?>column-order-2<?php } ?>">
                            <?php if ($home_section_title_1) { ?>
                                <header class="block-title-wrapper">
                                    <h2 class="block-title">
                                        <?php echo esc_html($home_section_title_1); ?>
                                    </h2>

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
                            <div class="theme-slider-block" data-slick='{"arrows": <?php echo esc_attr($arrow); ?>,"autoplay": <?php echo esc_attr($autoplay); ?>, "dots": <?php echo esc_attr($dots); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>
                                <?php
                                while ($banner_post_slide_query->have_posts()) {
                                    $banner_post_slide_query->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                    $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                                    <div class="theme-slider-item">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-bg post-thumb'); ?>>
                                            <div class="data-bg data-bg-large thumb-overlay thumb-overlay-darker img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                                <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                                <div class="article-content article-content-overlay">
                                                    <div class="entry-meta">
                                                        <?php extendednews_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                    </div>
                                                    <h2 class="entry-title entry-title-big">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h2>

                                                    <div class="entry-content hidden-xs-element text-white entry-content-small">
                                                        <?php
                                                        if (has_excerpt()) {
                                                            the_excerpt();
                                                        } else {
                                                            echo '<p>';
                                                            echo esc_html( wp_trim_words( get_the_content(),10,'...' ) );
                                                            echo '</p>';
                                                        } ?>
                                                    </div>

                                                    <div class="entry-meta">
                                                        <?php extendednews_posted_by(); ?>
                                                        <?php extendednews_post_view_count(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif; ?>
                    <div class="column column-7 column-sm-12 column-xs-12 <?php if ($ed_flip_column != 'yes') { ?>column-order-2<?php } else { ?>column-order-1<?php } ?>">
                        <?php if ($home_section_title_2 || ($ed_tab == 'yes' && ($section_category_1 || $section_category_2 || $section_category_3 || $section_category_4))) { ?>
                            <header class="block-title-wrapper">
                                <?php if ($home_section_title_2) { ?>
                                    <h2 class="block-title">
                                        <?php echo esc_html($home_section_title_2); ?>
                                    </h2>
                                <?php }
                                if ($ed_tab == 'yes' && ($section_category_1 || $section_category_2 || $section_category_3 || $section_category_4)) { ?>
                                <div class="theme-heading-controls">
                                    <div class="tab-posts hide-no-js">
                                        <a cat-data="all" class="active-tab"
                                           href="javascript:void(0)"><?php esc_html_e('All', 'extendednews'); ?></a>
                                        <?php
                                        if ($section_category_1 && $ed_tab == 'yes') {
                                            $catObj = get_category_by_slug($section_category_1);
                                            if (isset($catObj->name) && $catObj->name) { ?>
                                                <a cat-data="<?php echo esc_attr($section_category_1); ?>" href="javascript:void(0)">
                                                    <?php echo esc_html($catObj->name); ?>
                                                </a>
                                            <?php }
                                        }
                                        if ($section_category_2 && $ed_tab == 'yes') {
                                            $catObj = get_category_by_slug($section_category_2);
                                            if (isset($catObj->name) && $catObj->name) { ?>
                                                <a cat-data="<?php echo esc_attr($section_category_2); ?>" href="javascript:void(0)">
                                                    <?php echo esc_html($catObj->name); ?>
                                                </a>
                                            <?php }
                                        }
                                        if ($section_category_3 && $ed_tab == 'yes') {
                                            $catObj = get_category_by_slug($section_category_3);
                                            if (isset($catObj->name) && $catObj->name) { ?>
                                                <a cat-data="<?php echo esc_attr($section_category_3); ?>" href="javascript:void(0)">
                                                    <?php echo esc_html($catObj->name); ?>
                                                </a>
                                            <?php }
                                        }
                                        if ($section_category_4 && $ed_tab == 'yes') {
                                            $catObj = get_category_by_slug($section_category_4);
                                            if (isset($catObj->name) && $catObj->name) { ?>
                                                <a cat-data="<?php echo esc_attr($section_category_4); ?>" href="javascript:void(0)">
                                                    <?php echo esc_html($catObj->name); ?>
                                                </a>
                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </header>
                        <?php }
                        if ($banner_query_all->have_posts()): ?>
                            <div class="tab-contents tab-content-all content-loaded content-active">
                                <div class="column-row">
                                    <div class="column column-5 column-xs-12">
                                        <?php
                                        $post_count = 1;
                                        while ($banner_query_all->have_posts()) {
                                            $banner_query_all->the_post();
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
                                                            <?php extendednews_posted_by(); ?>
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
                                        } ?>
                                    </div>
                                    <div class="column column-7 column-xs-12">
                                        <div class="content-main">
                                            <?php
                                            while ($banner_query_all->have_posts()) {
                                                $banner_query_all->the_post();
                                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
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
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            wp_reset_postdata();
                        endif; ?>
                        <?php if ($ed_tab == 'yes' && $section_category_1) { ?>
                            <div data-cat="<?php echo esc_attr($section_category_1); ?>" class="tab-contents tab-content-<?php echo esc_attr($section_category_1); ?>">
                                <?php extendednews_content_loading(); ?>
                            </div>
                        <?php } ?>
                        <?php if ($ed_tab == 'yes' && $section_category_2) { ?>
                            <div data-cat="<?php echo esc_attr($section_category_2); ?>" class="tab-contents tab-content-<?php echo esc_attr($section_category_2); ?>">
                                <?php extendednews_content_loading(); ?>
                            </div>
                        <?php } ?>
                        <?php if ($ed_tab == 'yes' && $section_category_3) { ?>
                            <div data-cat="<?php echo esc_attr($section_category_3); ?>" class="tab-contents tab-content-<?php echo esc_attr($section_category_3); ?>">
                                <?php extendednews_content_loading(); ?>
                            </div>
                        <?php } ?>
                        <?php if ($ed_tab == 'yes' && $section_category_4) { ?>
                            <div data-cat="<?php echo esc_attr($section_category_4); ?>" class="tab-contents tab-content-<?php echo esc_attr($section_category_4); ?>">
                                <?php extendednews_content_loading(); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
endif;
