<?php
/**
 * List Post Widgets.
 *
 * @package ExtendedNews
 */
if ( !function_exists('extendednews_list_post_widgets') ) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function extendednews_list_post_widgets(){

        // List Post widget.
        register_widget('ExtendedNews_Sidebar_List_Posts_Widget');

    }

endif;

add_action('widgets_init', 'extendednews_list_post_widgets');

// List Post widget
if ( !class_exists('ExtendedNews_Sidebar_List_Posts_Widget') ) :

    /**
     * List Post.
     *
     * @since 1.0.0
     */

    class ExtendedNews_Sidebar_List_Posts_Widget extends ExtendedNews_Widget_Base{

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct(){

            $opts = array(
                'classname' => 'extendednews_list_post_widget',
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
                'post_number' => array(
                    'label' => esc_html__('Number of Posts:', 'extendednews'),
                    'type' => 'number',
                    'default' => 12,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 12,
                ),
                'column_number' => array(
                'label' => esc_html__('Number of Column:', 'extendednews'),
                'type' => 'select',
                'default' => '3',
                'options' => array(
                    '2' => esc_html__( '2', 'extendednews' ),
                    '3' => esc_html__( '3', 'extendednews' ),
                    ),
                    
                ),
            );

            parent::__construct( 'ExtendedNews-grid-2-posts', esc_html__('ExtendedNews: Layout List', 'extendednews'), $opts, array(), $fields );

        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */

        function widget( $args, $instance ){

            $params = $this->get_params( $instance );
            echo $args['before_widget'];
            
                $section_category = isset( $params['post_category'] ) ? $params['post_category'] : '';
                $post_number = isset( $params['post_number'] ) ? $params['post_number'] : '';
                $column_number = isset( $params['column_number'] ) ? $params['column_number'] : '';

                if( $column_number == '2' ){
                    $column_class = 6;
                }else{
                    $column_class = 4;
                }

                $home_section_title = isset( $params['title'] ) ? $params['title'] : '';

                if( empty( $home_section_title ) && $section_category ){

                    $home_section_title = get_the_category_by_ID( $section_category );

                }

                $home_section_be = $args['before_title'] . esc_html( $home_section_title ) . $args['after_title'];

                $list_post_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $post_number,'post__not_in' => get_option("sticky_posts"), 'cat' => esc_html( $section_category ) ) ); ?>

                <div class="theme-widgetarea">
                    <div class="widget-wrapper">

                        <?php if( $section_category || $home_section_title ){ ?>

                            <div class="column-row">
                                <div class="column column-12">
                                    <header class="block-title-wrapper">

                                        <?php if( $home_section_title ){ ?>

                                            <?php echo $home_section_be; ?>

                                        <?php } ?>

                                        <?php if( $section_category ){

                                            $cat_link = get_category_link( $section_category ); ?>

                                            <div class="theme-heading-controls">
                                                
                                                <a href="<?php echo esc_url($cat_link); ?>" class="view-all-link">
                                                    <span class="view-all-icon"><?php extendednews_the_theme_svg('plus'); ?></span>
                                                    <span class="view-all-label"><?php echo esc_html_e('View All', 'extendednews'); ?></span>
                                                </a>
                                                
                                            </div>

                                        <?php } ?>
                                        
                                    </header>
                                </div>
                            </div>

                        <?php } ?>

                        <div class="widget-row">

                            <?php
                            if( $list_post_query->have_posts() ):

                                while( $list_post_query->have_posts() ){
                                    $list_post_query->the_post();

                                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
                                    $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                                    <div class="widget-column widget-column-<?php echo $column_class; ?> widget-column-sm-6 widget-column-xs-12">
                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article news-article-bg mb-15' ); ?>>
                                                <div class="column-row">
                                                    <?php if( $featured_image ){ ?>
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

                                                    <div class="column column-<?php if(  $featured_image[0] ){ ?>8<?php }else{ ?>12<?php } ?>">
                                                        <div class="article-content">
                                                            <h3 class="entry-title entry-title-small">
                                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                            </h3>

                                                            <div class="entry-meta">
                                                                <?php extendednews_post_view_count(); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </article>
                                    </div>
                                    
                                <?php
                                }

                                wp_reset_postdata();

                            endif; ?>

                        </div>
                    </div>
                </div>

            <?php
            echo $args['after_widget'];

        }

    }
endif;