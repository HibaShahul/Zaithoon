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
$extendednews_post_layout = esc_html( get_post_meta( get_the_ID(), 'extendednews_post_layout', true ) );
$extendednews_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'extendednews_ed_feature_image', true ) );

if( is_page() ){

	$extendednews_post_layout = get_post_meta(get_the_ID(), 'extendednews_page_layout', true);
	
}
if( $extendednews_post_layout == '' || $extendednews_post_layout == 'global-layout' ){
    
    $extendednews_post_layout = get_theme_mod( 'extendednews_single_post_layout',$extendednews_default['extendednews_single_post_layout'] );

}
	
	extendednews_disable_post_views();
extendednews_disable_post_like_dislike();

$extendednews_ed_post_views = esc_html( get_post_meta( get_the_ID(), 'extendednews_ed_post_views', true ) );
$extendednews_ed_post_read_time = esc_html( get_post_meta( get_the_ID(), 'extendednews_ed_post_read_time', true ) );
$extendednews_ed_post_author_box = esc_html( get_post_meta( get_the_ID(), 'extendednews_ed_post_author_box', true ) );
$extendednews_ed_post_social_share = esc_html( get_post_meta( get_the_ID(), 'extendednews_ed_post_social_share', true ) );
$extendednews_ed_post_reaction = esc_html( get_post_meta( get_the_ID(), 'extendednews_ed_post_reaction', true ) );

if( $extendednews_ed_post_read_time ){ extendednews_disable_post_read_time(); }
if( $extendednews_ed_post_author_box ){ extendednews_disable_post_author_box(); }
if( $extendednews_ed_post_reaction ){ extendednews_disable_post_reaction(); }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

	<?php

	if( empty( $extendednews_ed_feature_image ) && $extendednews_post_layout != 'layout-2' ){ ?>

		<div class="post-thumbnail">

			<?php extendednews_post_thumbnail(); ?>
			
		</div>

	<?php
	}

	if ( is_singular() && $extendednews_post_layout != 'layout-2' ) { ?>

		<header class="entry-header">

			<?php
			if ( 'post' === get_post_type() ) { ?>

				<div class="entry-meta">

					<?php extendednews_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>

				</div>

			<?php  } ?>

			<h1 class="entry-title entry-title-large">

	            <?php the_title(); ?>

	        </h1>

		</header>

	<?php }

	if ( $extendednews_post_layout != 'layout-2' && is_single() && 'post' === get_post_type() ) { ?>

		<div class="entry-meta">

			<?php
			extendednews_posted_by();
			if( !$extendednews_ed_post_views ){ extendednews_post_view_count(); }
			?>

		</div>

	<?php  } ?>
	
	<div class="post-content-wrap">

		<?php if( is_singular() && empty( $extendednews_ed_post_social_share ) && class_exists( 'Booster_Extension_Class' ) && 'post' === get_post_type() ){ ?>

			<div class="post-content-share">
				<?php echo do_shortcode('[booster-extension-ss layout="layout-1" status="enable"]'); ?>
			</div>

		<?php } ?>

		<div class="post-content">

			<div class="entry-content">

				<?php

				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'extendednews' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				if( !class_exists('Booster_Extension_Class') || is_page() ):

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'extendednews'),
                        'after' => '</div>',
                    ));

                endif; ?>

			</div>

			<?php
			if ( is_singular() && 'post' === get_post_type() ) { ?>

				<div class="entry-footer">

                    <div class="entry-meta">
                         <?php extendednews_post_like_dislike(); ?>
                    </div>

                    <div class="entry-meta">
                        <?php extendednews_entry_footer( $cats = false, $tags = true, $edits = true ); ?>
                    </div>

				</div>

			<?php } ?>

		</div>

	</div>

</article>