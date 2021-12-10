<?php
/**
 * Tiles Post Widgets.
 *
 * @package ExtendedNews
 */
if ( !function_exists('extendednews_tiles_post_widgets') ) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function extendednews_tiles_post_widgets(){

        // Tiles Post widget.
        register_widget('ExtendedNews_Sidebar_Tiles_Posts_Widget');

    }

endif;

add_action('widgets_init', 'extendednews_tiles_post_widgets');

// Tiles Post widget
if ( !class_exists('ExtendedNews_Sidebar_Tiles_Posts_Widget') ) :

    /**
     * Tiles Post.
     *
     * @since 1.0.0
     */

    class ExtendedNews_Sidebar_Tiles_Posts_Widget extends ExtendedNews_Widget_Base{

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct(){

            $opts = array(
                'classname' => 'extendednews_tiles_post_widget',
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
                'default' => '4',
                'options' => array(
                    '2' => esc_html__( '2', 'extendednews' ),
                    '3' => esc_html__( '3', 'extendednews' ),
                    '4' => esc_html__( '4', 'extendednews' ),
                    ),
                    
                ),
            );

            parent::__construct( 'ExtendedNews-tiles-1-posts', esc_html__('ExtendedNews: Layout Tiles', 'extendednews'), $opts, array(), $fields );

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
                }else if( $column_number == '3' ){
                    $column_class = 4;
                }else{
                    $column_class = 3;
                }

                $home_section_title = isset( $params['title'] ) ? $params['title'] : '';

                if( empty( $home_section_title ) && $section_category ){

                    $home_section_title = get_the_category_by_ID( $section_category );

                }

                $home_section_be = $args['before_title'] . esc_html( $home_section_title ) . $args['after_title'];

                $tiles_post_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $post_number,'post__not_in' => get_option("sticky_posts"), 'cat' => esc_html( $section_category ) ) ); ?>

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
                            if( $tiles_post_query->have_posts() ):

                                while( $tiles_post_query->have_posts() ){
                                    $tiles_post_query->the_post();

                                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
                                    $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                                    <div class="widget-column widget-column-<?php echo $column_class; ?> widget-column-sm-6 widget-column-xs-12">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article post-thumb post-thumb-tiles' ); ?>>
                                            <div class="data-bg data-bg-medium thumb-overlay img-hover-slide" data-background="<?php echo esc_url( $featured_image ); ?>">

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
                                                    <h3 class="entry-title entry-title-small>
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="entry-meta">
                                                        <?php extendednews_posted_by(); ?>
                                                        <?php extendednews_post_view_count(); ?>
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