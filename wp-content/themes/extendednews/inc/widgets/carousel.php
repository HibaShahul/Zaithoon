<?php
/**
 * Carousel Post Widgets.
 *
 * @package ExtendedNews
 */
if ( !function_exists('extendednews_carousel_post_widgets') ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function extendednews_carousel_post_widgets(){
        // Carousel Post widget.
        register_widget('ExtendedNews_Sidebar_Carousel_Posts_Widget');
    }
endif;
add_action('widgets_init', 'extendednews_carousel_post_widgets');
// Carousel Post widget
if ( !class_exists('ExtendedNews_Sidebar_Carousel_Posts_Widget') ) :
    /**
     * Carousel Post.
     *
     * @since 1.0.0
     */
    class ExtendedNews_Sidebar_Carousel_Posts_Widget extends ExtendedNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'extendednews_carousel_post_widget',
                'description' => esc_html__('Displays post form selected category specific for popular post in sidebars.', 'extendednews'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'extendednews'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => esc_html__('Select Category:', 'extendednews'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'extendednews'),
                ),
                'slider_arrow' => array(
                    'label' => esc_html__('Slider Arrows:', 'extendednews'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'slider_dots' => array(
                    'label' => esc_html__('Slider Dots:', 'extendednews'),
                    'type' => 'checkbox',
                    'default' => false,
                ),
                'slider_autoplay' => array(
                    'label' => esc_html__('Slider Autoplay:', 'extendednews'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'post_number' => array(
                    'label' => esc_html__('Number of Posts:', 'extendednews'),
                    'type' => 'number',
                    'default' => 12,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 12,
                ),
                'slide_to_show' => array(
                    'label' => esc_html__('Slide to Show', 'extendednews'),
                    'type' => 'number',
                    'default' => 3,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 5,
                ),
            );
            parent::__construct( 'ExtendedNews-carousel-posts', esc_html__('ExtendedNews: Carousel Widget', 'extendednews'), $opts, array(), $fields );
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget( $args, $instance )
        {
            $params = $this->get_params( $instance );
            echo $args['before_widget'];
            
                $section_category = isset( $params['post_category'] ) ? $params['post_category'] : '';
                $slider_arrows = isset( $params['slider_arrow'] ) ? $params['slider_arrow'] : '';
                $slider_dots = isset( $params['slider_dots'] ) ? $params['slider_dots'] : '';
                $slider_autoplay = isset( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
                $slide_to_show = isset( $params['slide_to_show'] ) ? $params['slide_to_show'] : '3';
                $post_number = isset( $params['post_number'] ) ? $params['post_number'] : '';
                
                $home_section_title = $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];

                $carousel_post_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $post_number,'post__not_in' => get_option("sticky_posts"), 'cat' => esc_html( $section_category ) ) );

                if ( $slider_autoplay == 'yes' ) {
                    $autoplay = 'true';
                }else{
                    $autoplay = 'false';
                }
                if( $slider_dots == 'yes' ) {
                    $dots = 'true';
                }else {
                    $dots = 'false';
                }
                if( is_rtl() ) {
                    $rtl = 'true';
                }else{
                    $rtl = 'false';
                }

                if ( $carousel_post_query->have_posts() ): ?>

                    <div class="theme-block theme-block-widgetarea">

                        <?php if( $slider_arrows || isset( $params['title'] ) && $params['title'] ){ ?>

                            <div class="column-row">
                                <div class="column column-12">
                                    <header class="block-title-wrapper">

                                        <?php if (isset($params['title']) && $params['title']) { ?>

                                            <?php echo $home_section_title; ?>

                                        <?php } ?>

                                        <?php if ($slider_arrows) { ?>
                                            <div class="theme-heading-controls">
                                                <div class="title-controls">
                                                    <button type="button" class="slide-btn slide-btn-small slide-prev-1">
                                                        <?php extendednews_the_theme_svg('chevron-left'); ?>
                                                    </button>

                                                    <button type="button" class="slide-btn slide-btn-small slide-next-1">
                                                        <?php extendednews_the_theme_svg('chevron-right'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        
                                    </header>
                                </div>
                            </div>

                        <?php } ?>

                        <div class="theme-carousel-sliderwidget theme-carousel-space" data-slick='{"autoplay": <?php echo esc_attr( $autoplay ); ?>, "dots": <?php echo esc_attr( $dots ); ?>, "rtl": <?php echo esc_attr( $rtl ); ?>, "slidesToShow": <?php echo esc_attr( $slide_to_show ); ?>}'>

                                    <?php while( $carousel_post_query->have_posts() ){ 
                                        $carousel_post_query->the_post();
                                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'extendednews-400-500' );
                                        $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                                        <div class="theme-carousel-item">
                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article post-thumb post-thumb-slides' ); ?>>
                                                <div class="data-bg data-bg-big thumb-overlay img-hover-slide" data-background="<?php echo esc_url( $featured_image ); ?>">

                                                    <?php
                                                    $format = get_post_format( get_the_ID() ) ? : 'standard';
                                                    $icon = extendednews_post_format_icon( $format );
                                                    if( !empty( $icon ) ){ ?>

                                                        <span class="top-right-icon">
                                                            <?php echo extendednews_svg_escape( $icon ); ?>
                                                        </span>

                                                    <?php } ?>

                                                    <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>

                                                    <div class="article-content article-content-overlay">

                                                        <div class="entry-meta">
                                                            <?php extendednews_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                                        </div>

                                                        <h3 class="entry-title entry-title-medium">
                                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                        </h3>

                                                        <div class="entry-meta">
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
                endif;

                wp_reset_postdata();
            
            echo $args['after_widget'];

        }
    }
endif;