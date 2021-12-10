<?php
/**
* Related Posts Functions.
*
* @package ExtendedNews
*/
if( !function_exists('extendednews_related_posts') ):

	// Single Posts Related Posts.
	function extendednews_related_posts(){

        $extendednews_default = extendednews_get_default_theme_options();
        $extendednews_header_trending_page = get_theme_mod( 'extendednews_header_trending_page' );
        $extendednews_header_popular_page = get_theme_mod( 'extendednews_header_popular_page' );
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;

        if( $extendednews_header_trending_page != $current_id && $extendednews_header_popular_page != $current_id && is_single() && 'post' === get_post_type() ){

    		$cats = get_the_category( $post->ID );
    		$category = array();
            if( $cats ){
                foreach( $cats as $cat ){
                    $category[] = $cat->term_id; 
                }
            }

            $related_posts_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => array( $post->ID ), 'category__in' => $category ) );
    		$ed_related_post = absint( get_theme_mod( 'ed_related_post',$extendednews_default['ed_related_post'] ) );

    		if( $ed_related_post && $related_posts_query->have_posts() ): ?>

    			<div class="theme-block related-posts-area">

    	        	<?php $related_post_title = esc_html( get_theme_mod( 'related_post_title',$extendednews_default['related_post_title'] ) );
    	        	if( $related_post_title ){ ?>
                        <header class="block-title-wrapper">
                            <h3 class="block-title">
                                <?php echo esc_html( $related_post_title ); ?>
                            </h3>
                        </header>
    		        <?php } ?>

    	            <div class="content-main">

                        <?php while( $related_posts_query->have_posts() ):
                            $related_posts_query->the_post();

                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'extendednews-400-280' );
                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                            <div class="content-list">
                                <article class="news-article news-article-bg">
                                    <div class="column-row">
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="column column-5">
                                                <div class="post-thumbnail">
                                                    <div class="data-bg data-bg-medium" data-background="<?php echo esc_url($featured_image); ?>">

                                                        <?php
                                                        $format = get_post_format(get_the_ID()) ?: 'standard';
                                                        $icon = extendednews_post_format_icon($format);
                                                        if (!empty($icon)) { ?>
                                                            <span class="top-right-icon">
                                                            <?php echo extendednews_svg_escape($icon); ?>
                                                        </span>
                                                        <?php } ?>

                                                        <a href="<?php the_permalink(); ?>">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="column column-7">
                                            <div class="article-content">
                                                <header class="entry-header">
                                                    <h3 class="entry-title entry-title-medium">
                                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h3>
                                                </header>

                                                <div class="entry-content entry-content-muted entry-content-small">
                                                    <?php
                                                    if (has_excerpt()) {

                                                        the_excerpt();

                                                    } else {

                                                        echo '<p>';
                                                        echo esc_html( wp_trim_words( get_the_content(),20,'...' ) );
                                                        echo '</p>';

                                                    } ?>
                                                </div>

                                                <div class="entry-meta">
                                                    <?php extendednews_posted_by(); ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </article>
                            </div>
                        <?php endwhile; ?>

    	            </div>

    			</div>

    		<?php
    		wp_reset_postdata();
    		endif;

        }

	}

endif;
add_action( 'extendednews_navigation_action','extendednews_related_posts',20 );