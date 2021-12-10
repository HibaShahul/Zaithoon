<?php
/**
 * Featured Category Widgets.
 *
 * @package ExtendedNews
 */


if (!function_exists('extendednews_featured_category_widgets')) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function extendednews_featured_category_widgets()
    {
        // Recent Post widget.
        register_widget('ExtendedNews_Sidebar_Featured_Category_Widget');

    }

endif;
add_action('widgets_init', 'extendednews_featured_category_widgets');

// Recent Post widget
if (!class_exists('ExtendedNews_Sidebar_Featured_Category_Widget')) :

    /**
     * Recent Post.
     *
     * @since 1.0.0
     */
    class ExtendedNews_Sidebar_Featured_Category_Widget extends ExtendedNews_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'extendednews_featured_category_widget',
                'description' => esc_html__('Displays categories and posts.', 'extendednews'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title_1' => array(
                    'label' => esc_html__('Title 1:', 'extendednews'),
                    'type' => 'text',
                    'class' => 'widefat',
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
                ),
                'post_category_3' => array(
                    'label' => esc_html__('Select Category 3:', 'extendednews'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'extendednews'),
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

            parent::__construct('extendednews-featured-category-layout', esc_html__('ExtendedNews: Category Call to action Widget', 'extendednews'), $opts, array(), $fields);
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

            $column_number = isset($params['column_number']) ? $params['column_number'] : '';

            if ($column_number == '2') {
                $column_class = 6;
                $bg_class = 'data-bg-big';
            } else {
                $column_class = 4;
                $bg_class = 'data-bg-medium';
            } ?>

            <div class="theme-widgetarea">

                <div class="widget-wrapper">

                    <div class="widget-row">

                        <?php
                        for ($x = 1; $x <= 3; $x++) {

                            $section_category = isset($params['post_category_' . $x]) ? $params['post_category_' . $x] : '';

                            if ($section_category) {

                                $cat_name = get_the_category_by_ID($section_category);
                                $cat_link = get_category_link($section_category);
                                $twp_term_image = get_term_meta($section_category, 'twp-term-featured-image', true); ?>

                                <div class="widget-column widget-column-<?php echo $column_class; ?> widget-column-sm-12">
                                    <?php
                                    if (isset($params['title_' . $x]) && $params['title_' . $x]) {

                                        $cat_name = esc_html($params['title_' . $x]);

                                    } ?>

                                    <div class="post-thumb-categories">
                                        <div class="data-bg <?php echo $bg_class ?> thumb-overlay img-hover-slide"
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
                            }

                        } ?>

                    </div>
                </div>
            </div>

            <?php
            echo $args['after_widget'];

        }
    }
endif;