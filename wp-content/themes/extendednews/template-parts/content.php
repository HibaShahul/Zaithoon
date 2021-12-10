<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ExtendedNews
 * @since 1.0.0
 */

$extendednews_default = extendednews_get_default_theme_options();
$extendednews_archive_layout = esc_attr( get_theme_mod( 'extendednews_archive_layout',$extendednews_default['extendednews_archive_layout'] ) );
$global_sidebar_layout = esc_attr( get_theme_mod( 'global_sidebar_layout',$extendednews_default['global_sidebar_layout'] ) );

if(  $extendednews_archive_layout == 'default' ){
	
	$image_size = 'extendednews-400-280';
	
}elseif( $extendednews_archive_layout == 'masonry' ){

    $image_size = 'medium_large';

}elseif( $extendednews_archive_layout == 'grid' ){
    
    $image_size = 'extendednews-500-300';
    
}else{

	if( $global_sidebar_layout == 'no-sidebar' ){
		$image_size = 'full';
	}else{
		$image_size = 'large';
	}
	
} ?>

<div class="theme-article-area">
    <article id="post-<?php the_ID(); ?>" <?php post_class('news-article news-article-bg'); ?>>

        <?php if( has_post_thumbnail() ){ ?>

            <div class="post-thumbnail">
                <?php
                $format = get_post_format(get_the_ID()) ?: 'standard';
                $icon = extendednews_post_format_icon($format);

                if (!empty($icon)) { ?>
                    <span class="top-right-icon"><?php echo extendednews_svg_escape( $icon ); ?></span>
                <?php } ?>
                
                <?php extendednews_post_thumbnail( $image_size ); ?>

            </div>

        <?php } ?>

        <div class="post-content">

            <header class="entry-header">

                <?php
                if ( !is_search() && 'post' === get_post_type() ) { ?>

                    <div class="entry-meta">

                        <?php extendednews_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>

                    </div>

                <?php  } ?>
                <h2 class="entry-title">

                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>

                </h2>

            </header>



            <div class="entry-content entry-content-muted entry-content-small">
                <?php
                if( has_excerpt() ){

                    the_excerpt();

                }else{

                    echo '<p>';
                    echo esc_html( wp_trim_words( get_the_content(),25,'...' ) );
                    echo '</p>';

                } ?>

            </div>

            <?php if( !is_search() ){ ?>


            <div class="entry-footer">
                <div class="entry-meta">
                    <?php extendednews_posted_by(); ?>
                </div>

                <?php extendednews_post_permalink(); ?>

            </div>

            <?php } ?>

        </div>

    </article>
</div>