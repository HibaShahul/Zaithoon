<?php
/**
 * Category Post Widgets.
 *
 * @package ExtendedNews
 */
if (!function_exists('extendednews_category_post_widgets')) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function extendednews_category_post_widgets()
    {

        // Category Post widget.
        register_widget('ExtendedNews_Sidebar_Category_Posts_Widget');

    }

endif;

add_action('widgets_init', 'extendednews_category_post_widgets');

// Category Post widget
if (!class_exists('ExtendedNews_Sidebar_Category_Posts_Widget')) :

    /**
     * Category Post.
     *
     * @since 1.0.0
     */

    class ExtendedNews_Sidebar_Category_Posts_Widget extends ExtendedNews_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {

            $opts = array(
                'classname' => 'extendednews_category_post_widget',
                'description' => esc_html__('Displays post form selected category specific for popular post in sidebars.', 'extendednews'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title_1' => array(
                    'label' => esc_html__('Title 1:', 'extendednews'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default' => esc_html__('Category 1', 'extendednews'),
                ),
                'post_category_1' => array(
                    'label' => esc_html__('Select Category 1:', 'extendednews'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'extendednews'),
                ),
                'title_2' => array(
                    'label' => esc_html__('Title 2:', 'extendednews'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default' => esc_html__('Category 2', 'extendednews'),
                ),
                'post_category_2' => array(
                    'label' => esc_html__('Select Category 2:', 'extendednews'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'extendednews'),
                ),
                'title_3' => array(
                    'label' => esc_html__('Title 3:', 'extendednews'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default' => esc_html__('Category 3', 'extendednews'),
                ),
                'post_category_3' => array(
                    'label' => esc_html__('Select Category 3:', 'extendednews'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'extendednews'),
                ),
                'post_number' => array(
                    'label' => esc_html__('Number of Posts:', 'extendednews'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 7,
                ),
                'column_number' => array(
                    'label' => esc_html__('Number of Column:', 'extendednews'),
                    'type' => 'select',
                    'default' => '3',
                    'options' => array(
                        '2' => esc_html__('2', 'extendednews'),
                        '3' => esc_html__('3', 'extendednews'),
                    ),

                ),
            );

            parent::__construct('ExtendedNews-category-posts', esc_html__('ExtendedNews: Layout Multiple Panel', 'extendednews'), $opts, array(), $fields);

        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         * @since 1.0.0
         *
         */

        function widget($args, $instance)
        {

            $params = $this->get_params($instance);
            echo $args['before_widget'];

            $post_number = isset($params['post_number']) ? $params['post_number'] : '';
            $column_number = isset($params['column_number']) ? $params['column_number'] : '';

            if ($column_number == '2') {
                $column_class = 6;
            } else {
                $column_class = 4;
            } ?>

            <div class="theme-widgetarea">

                <div class="widget-wrapper">

                    <div class="widget-row">

                        <?php
                        for ($x = 1; $x <= 3; $x++) {

                            $section_category = isset($params['post_category_' . $x]) ? $params['post_category_' . $x] : '';
                            $category_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $post_number, 'post__not_in' => get_option("sticky_posts"), 'cat' => esc_html($section_category)));

                            if ( $section_category && $category_post_query->have_posts() ): ?>

                                <div class="widget-column widget-column-<?php echo $column_class; ?> widget-column-sm-12">

                                    <?php

                                    $cat_name = get_the_category_by_ID($section_category);
                                    $cat_link = get_category_link($section_category);

                                    if( isset( $cat_name ) || $params['title_' . $x] ){ ?>

                                        <div class="column-row">
                                            <div class="column column-12">
                                                <header class="block-title-wrapper">

                                                    <?php
                                                    if( isset( $params['title_' . $x] ) && $params['title_' . $x] ){

                                                        echo $args['before_title'] . '<a href="' . esc_url($cat_link) . '">' . esc_html($params['title_' . $x]) . '</a>' . $args['after_title'];

                                                    }else{

                                                        echo $args['before_title'] . '<a href="' . esc_url($cat_link) . '">' . esc_html($cat_name) . '</a>' . $args['after_title'];

                                                    } ?>

                                                </header>
                                            </div>
                                        </div>
                                    <?php
                                    }

                                    $post_count = 1;
                                    while ($category_post_query->have_posts()) {
                                        $category_post_query->the_post();

                                        if ($post_count == 1) {

                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'extendednews-550-400');
                                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : '';
                                            ?>

                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-bg mb-15'); ?>>

                                                <?php if ($featured_image) { ?>

                                                    <div class="post-thumbnail">
                                                        <div class="img-hover-scale">

                                                            <?php
                                                            $format = get_post_format(get_the_ID()) ?: 'standard';
                                                            $icon = extendednews_post_format_icon($format);

                                                            if (!empty($icon)) { ?>
                                                                <span class="top-right-icon"><?php echo extendednews_svg_escape( $icon ); ?></span>
                                                            <?php } ?>

                                                            <a href="<?php the_permalink(); ?>" tabindex="0">
                                                                <img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url($featured_image); ?>">
                                                            </a>
                                                            <div class="article-content article-content-overlay">
                                                                <div class="entry-meta">
                                                                    <?php extendednews_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                <?php } ?>

                                                <div class="article-content article-content-1">


                                                    <h3 class="entry-title entry-title-medium">
                                                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                                    </h3>


                                                    <div class="entry-content entry-content-muted entry-content-small">

                                                        <?php
                                                        if( has_excerpt() ){

                                                            the_excerpt();

                                                        } else {

                                                            echo '<p>';
                                                            echo esc_html( wp_trim_words( get_the_content(),20,'...' ) );
                                                            echo '</p>';

                                                        } ?>

                                                    </div>

                                                    <div class="entry-meta">
                                                        <?php extendednews_posted_by(); ?>
                                                        <?php extendednews_post_view_count(); ?>
                                                    </div>

                                                </div>

                                            </article>

                                            <?php
                                        } else {

                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-bg mb-15'); ?>>
                                                <div class="column-row">

                                                    <?php if ($featured_image) { ?>

                                                        <div class="column column-4">
                                                            <div class="post-thumbnail">
                                                                <div class="img-hover-scale">
                                                                    <?php
                                                                    $format = get_post_format(get_the_ID()) ?: 'standard';
                                                                    $icon = extendednews_post_format_icon($format);
                                                                    if (!empty($icon)) { ?>
                                                                        <span class="top-right-icon"><?php echo extendednews_svg_escape( $icon ); ?></span>
                                                                    <?php } ?>

                                                                    <a href="<?php the_permalink(); ?>" tabindex="0">
                                                                        <img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url($featured_image); ?>">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>

                                                    <div class="column column-<?php if ($featured_image) { ?>8<?php } else { ?>12<?php } ?>">
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
                                                    </div>

                                                </div>
                                            </article>
                                            <?php
                                        }

                                        $post_count++;
                                    } ?>

                                </div>

                                <?php
                                wp_reset_postdata();

                            endif;

                        } ?>

                    </div>
                </div>
            </div>

            <?php
            echo $args['after_widget'];

        }

    }
endif;