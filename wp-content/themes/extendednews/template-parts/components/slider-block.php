<?php
/**
* Slider Posts Function.
*
* @package ExtendedNews
*/

if ( !function_exists( 'extendednews_slider_blocks' ) ):

    function extendednews_slider_blocks( $extendednews_home_section,$repeat_times ){
        
        $section_category = esc_html( isset($extendednews_home_section->section_category) ? $extendednews_home_section->section_category : '');
        $slider_autoplay = esc_html( isset($extendednews_home_section->ed_autoplay_carousel) ? $extendednews_home_section->ed_autoplay_carousel : '');
        $enable_wide_layout = esc_html(isset($extendednews_home_section->enable_wide_layout) ? $extendednews_home_section->enable_wide_layout : '');

        $class = 'wrapper';

        if ($enable_wide_layout == 'yes') {
            $class = 'wrapper-fluid';
        }
        
        $carousel_post_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 5,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category ) ) );

        if ( $slider_autoplay == 'yes' ) {
            $autoplay = 'true';
        }else{
            $autoplay = 'false';
        }
        if( is_rtl() ) {
            $rtl = 'true';
        }else{
            $rtl = 'false';
        }

        if ( $carousel_post_query->have_posts() ): ?>

            <div id="theme-block-<?php echo esc_attr( $repeat_times ); ?>" class="theme-block theme-block-largespace theme-block-slider">
			    <div class="<?php echo $class; ?>">


	                <div class="theme-slider-main" data-slick='{"autoplay": <?php echo esc_attr( $autoplay ); ?>, "rtl": <?php echo esc_attr( $rtl ); ?>}'>

		                <?php while( $carousel_post_query->have_posts() ){ 
		                	$carousel_post_query->the_post();
		                	$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'extendednews-1600-700' );
                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

		                    <div class="theme-slider-item">
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('post-thumb post-thumb-slides'); ?>>
                                    <div class="data-bg data-bg-xl-large thumb-overlay thumb-overlay-darker img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                        <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                        <div class="article-content article-content-overlay">
                                            <div class="article-content-wrapper">

                                                <div class="entry-meta">
                                                    <?php extendednews_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>
                                                <h2 class="entry-title entry-title-large">
                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                                       title="<?php the_title_attribute(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h2>

                                                <div class="entry-content text-white entry-content-small hidden-xs-element">

                                                    <?php
                                                    if (has_excerpt()) {

                                                        the_excerpt();

                                                    } else {

                                                        echo '<p>';
                                                        echo esc_html(wp_trim_words(get_the_content(), 60, '...'));
                                                        echo '</p>';

                                                    } ?>

                                                </div>

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

                    <div class="slider-navigator">
                        <div class="theme-slider-navigator theme-carousel-space" data-slick='{"autoplay": <?php echo esc_attr($autoplay); ?>, "dots": false, "rtl": <?php echo esc_attr($rtl); ?>}'>

                            <?php while ($carousel_post_query->have_posts()) {
                                $carousel_post_query->the_post();
                                
                                $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'extendednews-1600-700' );
                                $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                                <div class="theme-slider-item">

                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article post-thumb post-thumb-ticker'); ?>>
                                        <div class="data-bg data-bg-medium thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">

                                            <div class="article-content article-content-overlay">

                                                <h3 class="entry-title entry-title-medium">
                                                    <?php the_title(); ?>
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
                                    </article>

                                </div>

                            <?php } ?>

                        </div>
                    </div>
			    </div>
			</div>

        <?php
        wp_reset_postdata();
        endif;

    }

endif;