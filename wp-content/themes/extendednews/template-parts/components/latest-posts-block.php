<?php
/**
 * Latest Posts
 *
 * @package ExtendedNews
 */
if( !function_exists('extendednews_latest_blocks') ):
    
    function extendednews_latest_blocks($extendednews_home_section, $repeat_times){

        global $post;
        $extendednews_default = extendednews_get_default_theme_options();
        $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $extendednews_default['global_sidebar_layout'] ) );
        

        if( is_single() || is_page() ){

            $extendednews_post_sidebar = esc_attr( get_post_meta( $post->ID, 'extendednews_post_sidebar_option', true ) );
            if( $extendednews_post_sidebar == 'global-sidebar' || empty( $extendednews_post_sidebar ) ){

                $sidebar = $sidebar;
            }else{
                $sidebar = $extendednews_post_sidebar;
            }

        }

        $extendednews_archive_layout = esc_attr( get_theme_mod( 'extendednews_archive_layout', $extendednews_default['extendednews_archive_layout'] ) ); ?>

        <div id="theme-block-<?php echo esc_attr( $repeat_times ); ?>" class="theme-block theme-block-archive">
            <div class="wrapper">
                <div class="column-row">

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            
                            <?php
                            if( !is_front_page() ) {
                                extendednews_breadcrumb();
                            }

                            if( have_posts() ): ?>

                                <div class="article-wraper archive-layout <?php echo 'archive-layout-' . esc_attr( $extendednews_archive_layout ); ?>">
                                    <?php while (have_posts()) :
                                        the_post();

                                        if( !is_page() ){

                                            if( get_post_format() == 'video' ){

                                                $video_autoplay = esc_attr( get_post_meta(get_the_ID(), 'twp_video_autoplay', true) );
                                                if( $video_autoplay == '' || $video_autoplay == 'global' ){

                                                    $video_autoplay = isset($extendednews_home_section->section_video_autoplay) ? $extendednews_home_section->section_video_autoplay : '';
                                                    if( $video_autoplay == '' || $video_autoplay == 'global' ){
                                                        $video_autoplay = get_theme_mod( 'ed_autoplay', $extendednews_default['ed_autoplay'] );
                                                    }

                                                }

                                                $ratio_value = get_post_meta( get_the_ID(), 'twp_aspect_ratio', true );
                                                if( $ratio_value == '' || $ratio_value == 'global' ){
                                                    
                                                    $ratio_value = isset( $extendednews_home_section->section_video_ratio ) ? $extendednews_home_section->section_video_ratio : '';

                                                    if( $ratio_value == '' || $ratio_value == 'global' ){
                                                        $ratio_value = get_theme_mod( 'post_video_aspect_ration', $extendednews_default['post_video_aspect_ration'] );
                                                    }

                                                }

                                                extendednews_video_content_render( $class1 = 'post', $class2 = 'video-id', $class3 = 'video-main-wraper', $ratio_value, $video_autoplay );
                                                
                                            }else{

                                                get_template_part( 'template-parts/content', get_post_format() );

                                            }
                                            
                                        }else{
                                            get_template_part('template-parts/content', 'single');
                                        }


                                    endwhile; ?>
                                </div>

                                <?php if( !is_page() ): do_action('extendednews_archive_pagination'); endif;

                            else :

                                get_template_part('template-parts/content', 'none');

                            endif; ?>
                        </main><!-- #main -->
                    </div>

                    <?php if( $sidebar != 'no-sidebar' ){

                        get_sidebar();
                        
                    } ?>

                </div>
            </div>
        </div>

    <?php
    }
    
endif;
