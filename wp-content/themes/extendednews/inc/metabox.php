<?php
/**
* Sidebar Metabox.
*
* @package ExtendedNews
*/
 
add_action( 'add_meta_boxes', 'extendednews_metabox' );

if( ! function_exists( 'extendednews_metabox' ) ):


    function  extendednews_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'extendednews' ),
            'extendednews_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'extendednews' ),
            'extendednews_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$extendednews_page_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'extendednews' ),
    'layout-2' => esc_html__( 'Banner Layout', 'extendednews' ),
);

$extendednews_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'extendednews' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'extendednews' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'extendednews' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'extendednews' ),
                ),
);

$extendednews_post_layout_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'extendednews' ),
    'layout-1' => esc_html__( 'Simple Layout', 'extendednews' ),
    'layout-2' => esc_html__( 'Banner Layout', 'extendednews' ),
);

$extendednews_header_overlay_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'extendednews' ),
    'enable-overlay' => esc_html__( 'Enable Header Overlay', 'extendednews' ),
);


/**
 * Callback function for post option.
*/
if( ! function_exists( 'extendednews_post_metafield_callback' ) ):
    
    function extendednews_post_metafield_callback() {
        global $post, $extendednews_post_sidebar_fields, $extendednews_post_layout_options,  $extendednews_page_layout_options, $extendednews_header_overlay_options;
        $post_type = get_post_type($post->ID);
        wp_nonce_field( basename( __FILE__ ), 'extendednews_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('General Settings', 'extendednews'); ?>

                        </a>
                    </li>

                    <li>
                        <a id="metabox-navbar-appearance" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'extendednews'); ?>

                        </a>
                    </li>

                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'extendednews'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','extendednews'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $extendednews_post_sidebar = esc_html( get_post_meta( $post->ID, 'extendednews_post_sidebar_option', true ) ); 
                            if( $extendednews_post_sidebar == '' ){ $extendednews_post_sidebar = 'global-sidebar'; }

                            foreach ( $extendednews_post_sidebar_fields as $extendednews_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="extendednews_post_sidebar_option" value="<?php echo esc_attr( $extendednews_post_sidebar_field['value'] ); ?>" <?php if( $extendednews_post_sidebar_field['value'] == $extendednews_post_sidebar ){ echo "checked='checked'";} if( empty( $extendednews_post_sidebar ) && $extendednews_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $extendednews_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <div id="metabox-navbar-appearance-content" class="metabox-content-wrap">

                    <?php if( $post_type == 'page' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','extendednews'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $extendednews_page_layout = esc_html( get_post_meta( $post->ID, 'extendednews_page_layout', true ) ); 
                                if( $extendednews_page_layout == '' ){ $extendednews_page_layout = 'layout-1'; }

                                foreach ( $extendednews_page_layout_options as $key => $extendednews_page_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="extendednews_page_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $extendednews_page_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $extendednews_page_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','extendednews'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <?php
                                $extendednews_ed_header_overlay = esc_attr( get_post_meta( $post->ID, 'extendednews_ed_header_overlay', true ) ); ?>

                                <input type="checkbox" id="extendednews-header-overlay" name="extendednews_ed_header_overlay" value="1" <?php if( $extendednews_ed_header_overlay ){ echo "checked='checked'";} ?>/>

                                <label for="extendednews-header-overlay"><?php esc_html_e( 'Enable Header Overlay','extendednews' ); ?></label>

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php if( $post_type == 'post' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','extendednews'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $extendednews_post_layout = esc_html( get_post_meta( $post->ID, 'extendednews_post_layout', true ) ); 
                                if( $extendednews_post_layout == '' ){ $extendednews_post_layout = 'global-layout'; }

                                foreach ( $extendednews_post_layout_options as $key => $extendednews_post_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="extendednews_post_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $extendednews_post_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $extendednews_post_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','extendednews'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $extendednews_header_overlay = esc_html( get_post_meta( $post->ID, 'extendednews_header_overlay', true ) ); 
                                if( $extendednews_header_overlay == '' ){ $extendednews_header_overlay = 'global-layout'; }

                                foreach ( $extendednews_header_overlay_options as $key => $extendednews_header_overlay_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="extendednews_header_overlay" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $extendednews_header_overlay ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $extendednews_header_overlay_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                    <?php endif; ?>

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Feature Image Setting','extendednews'); ?></h3>

                        <div class="metabox-opt-wrap theme-checkbox-wrap">

                            <?php
                            $extendednews_ed_feature_image = esc_html( get_post_meta( $post->ID, 'extendednews_ed_feature_image', true ) ); ?>

                            <input type="checkbox" id="extendednews-ed-feature-image" name="extendednews_ed_feature_image" value="1" <?php if( $extendednews_ed_feature_image ){ echo "checked='checked'";} ?>/>

                            <label for="extendednews-ed-feature-image"><?php esc_html_e( 'Disable Feature Image','extendednews' ); ?></label>


                        </div>

                    </div>

                     <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','extendednews'); ?></h3>

                        <?php $twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Navigation Type','extendednews' ); ?></b></label>

                            <select name="twp_disable_ajax_load_next_post">

                                <option <?php if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','extendednews'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','extendednews'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'norma-navigation' ){ echo 'selected'; } ?> value="norma-navigation"><?php esc_html_e('Next Previous Navigation','extendednews'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','extendednews'); ?></option>

                            </select>

                        </div>
                    </div>

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Video Aspect Ration Setting','extendednews'); ?></h3>

                        <?php $twp_aspect_ratio = esc_attr( get_post_meta($post->ID, 'twp_aspect_ratio', true) ); ?>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Video Aspect Ratio','extendednews' ); ?></b></label>

                            <select name="twp_aspect_ratio">

                                <option <?php if( $twp_aspect_ratio == '' || $twp_aspect_ratio == 'global' ){ echo 'selected'; } ?> value="global"><?php esc_html_e('Global','extendednews'); ?></option>

                                <option <?php if( $twp_aspect_ratio == '' || $twp_aspect_ratio == 'default' ){ echo 'selected'; } ?> value="default"><?php esc_html_e('Default','extendednews'); ?></option>

                                <option <?php if( $twp_aspect_ratio == 'square' ){ echo 'selected'; } ?> value="square"><?php esc_html_e('Square','extendednews'); ?></option>

                                <option <?php if( $twp_aspect_ratio == 'portrait' ){ echo 'selected'; } ?> value="portrait"><?php esc_html_e('Portrait','extendednews'); ?></option>

                                <option <?php if( $twp_aspect_ratio == 'landscape' ){ echo 'selected'; } ?> value="landscape"><?php esc_html_e('Landscape','extendednews'); ?></option>

                            </select>

                        </div>

                    </div>

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Video Autoplay','extendednews'); ?></h3>

                        <?php $twp_video_autoplay = esc_attr( get_post_meta($post->ID, 'twp_video_autoplay', true) ); ?>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Video Autoplay','extendednews' ); ?></b></label>

                            <select name="twp_video_autoplay">

                                <option <?php if( $twp_video_autoplay == '' || $twp_video_autoplay == 'global' ){ echo 'selected'; } ?> value="global"><?php esc_html_e('Global','extendednews'); ?></option>

                                <option <?php if( $twp_video_autoplay == 'autoplay-enable' ){ echo 'selected'; } ?> value="autoplay-enable"><?php esc_html_e('Enable Autoplay','extendednews'); ?></option>

                                <option <?php if( $twp_video_autoplay == 'autoplay-disable' ){ echo 'selected'; } ?> value="autoplay-disable"><?php esc_html_e('Disable Autoplay','extendednews'); ?></option>


                            </select>

                        </div>

                    </div>

                </div>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $extendednews_ed_post_views = esc_html( get_post_meta( $post->ID, 'extendednews_ed_post_views', true ) );
                    $extendednews_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'extendednews_ed_post_read_time', true ) );
                    $extendednews_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'extendednews_ed_post_like_dislike', true ) );
                    $extendednews_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'extendednews_ed_post_author_box', true ) );
                    $extendednews_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'extendednews_ed_post_social_share', true ) );
                    $extendednews_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'extendednews_ed_post_reaction', true ) );
                    $extendednews_ed_post_rating = esc_html( get_post_meta( $post->ID, 'extendednews_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','extendednews'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="extendednews-ed-post-views" name="extendednews_ed_post_views" value="1" <?php if( $extendednews_ed_post_views ){ echo "checked='checked'";} ?>/>
                                    <label for="extendednews-ed-post-views"><?php esc_html_e( 'Disable Post Views','extendednews' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="extendednews-ed-post-read-time" name="extendednews_ed_post_read_time" value="1" <?php if( $extendednews_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                    <label for="extendednews-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','extendednews' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="extendednews-ed-post-like-dislike" name="extendednews_ed_post_like_dislike" value="1" <?php if( $extendednews_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                    <label for="extendednews-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','extendednews' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="extendednews-ed-post-author-box" name="extendednews_ed_post_author_box" value="1" <?php if( $extendednews_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                    <label for="extendednews-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','extendednews' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="extendednews-ed-post-social-share" name="extendednews_ed_post_social_share" value="1" <?php if( $extendednews_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                    <label for="extendednews-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','extendednews' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="extendednews-ed-post-reaction" name="extendednews_ed_post_reaction" value="1" <?php if( $extendednews_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                    <label for="extendednews-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','extendednews' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="extendednews-ed-post-rating" name="extendednews_ed_post_rating" value="1" <?php if( $extendednews_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                    <label for="extendednews-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','extendednews' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'extendednews_save_post_meta' );

if( ! function_exists( 'extendednews_save_post_meta' ) ):

    function extendednews_save_post_meta( $post_id ) {

        global $post, $extendednews_post_sidebar_fields, $extendednews_post_layout_options, $extendednews_header_overlay_options,  $extendednews_page_layout_options;

        if ( !isset( $_POST[ 'extendednews_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['extendednews_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }


        foreach ( $extendednews_post_sidebar_fields as $extendednews_post_sidebar_field ) {  
            

                $old = esc_html( get_post_meta( $post_id, 'extendednews_post_sidebar_option', true ) ); 
                $new = isset( $_POST['extendednews_post_sidebar_option'] ) ? extendednews_sanitize_sidebar_option_meta( wp_unslash( $_POST['extendednews_post_sidebar_option'] ) ) : '';

                if ( $new && $new != $old ){

                    update_post_meta ( $post_id, 'extendednews_post_sidebar_option', $new );

                }elseif( '' == $new && $old ) {

                    delete_post_meta( $post_id,'extendednews_post_sidebar_option', $old );

                }

            
        }

        $twp_disable_ajax_load_next_post_old = esc_html( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 
        $twp_disable_ajax_load_next_post_new = isset( $_POST['twp_disable_ajax_load_next_post'] ) ? extendednews_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) ) : '';

        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }


        foreach ( $extendednews_post_layout_options as $extendednews_post_layout_option ) {  
            
            $extendednews_post_layout_old = esc_html( get_post_meta( $post_id, 'extendednews_post_layout', true ) ); 
            $extendednews_post_layout_new = isset( $_POST['extendednews_post_layout'] ) ? extendednews_sanitize_post_layout_option_meta( wp_unslash( $_POST['extendednews_post_layout'] ) ) : '';

            if ( $extendednews_post_layout_new && $extendednews_post_layout_new != $extendednews_post_layout_old ){

                update_post_meta ( $post_id, 'extendednews_post_layout', $extendednews_post_layout_new );

            }elseif( '' == $extendednews_post_layout_new && $extendednews_post_layout_old ) {

                delete_post_meta( $post_id,'extendednews_post_layout', $extendednews_post_layout_old );

            }
            
        }



        foreach ( $extendednews_header_overlay_options as $extendednews_header_overlay_option ) {  
            
            $extendednews_header_overlay_old = esc_html( get_post_meta( $post_id, 'extendednews_header_overlay', true ) ); 
            $extendednews_header_overlay_new = isset( $_POST['extendednews_header_overlay'] ) ? extendednews_sanitize_header_overlay_option_meta( wp_unslash( $_POST['extendednews_header_overlay'] ) ) : '';

            if ( $extendednews_header_overlay_new && $extendednews_header_overlay_new != $extendednews_header_overlay_old ){

                update_post_meta ( $post_id, 'extendednews_header_overlay', $extendednews_header_overlay_new );

            }elseif( '' == $extendednews_header_overlay_new && $extendednews_header_overlay_old ) {

                delete_post_meta( $post_id,'extendednews_header_overlay', $extendednews_header_overlay_old );

            }
            
        }



        $extendednews_ed_feature_image_old = esc_html( get_post_meta( $post_id, 'extendednews_ed_feature_image', true ) ); 
        $extendednews_ed_feature_image_new = isset( $_POST['extendednews_ed_feature_image'] ) ? absint( wp_unslash( $_POST['extendednews_ed_feature_image'] ) ) : '';

        if ( $extendednews_ed_feature_image_new && $extendednews_ed_feature_image_new != $extendednews_ed_feature_image_old ){

            update_post_meta ( $post_id, 'extendednews_ed_feature_image', $extendednews_ed_feature_image_new );

        }elseif( '' == $extendednews_ed_feature_image_new && $extendednews_ed_feature_image_old ) {

            delete_post_meta( $post_id,'extendednews_ed_feature_image', $extendednews_ed_feature_image_old );

        }



        $extendednews_ed_post_views_old = esc_html( get_post_meta( $post_id, 'extendednews_ed_post_views', true ) ); 
        $extendednews_ed_post_views_new = isset( $_POST['extendednews_ed_post_views'] ) ? absint( wp_unslash( $_POST['extendednews_ed_post_views'] ) ) : '';

        if ( $extendednews_ed_post_views_new && $extendednews_ed_post_views_new != $extendednews_ed_post_views_old ){

            update_post_meta ( $post_id, 'extendednews_ed_post_views', $extendednews_ed_post_views_new );

        }elseif( '' == $extendednews_ed_post_views_new && $extendednews_ed_post_views_old ) {

            delete_post_meta( $post_id,'extendednews_ed_post_views', $extendednews_ed_post_views_old );

        }



        $extendednews_ed_post_read_time_old = esc_html( get_post_meta( $post_id, 'extendednews_ed_post_read_time', true ) ); 
        $extendednews_ed_post_read_time_new = isset( $_POST['extendednews_ed_post_read_time'] ) ? absint( wp_unslash( $_POST['extendednews_ed_post_read_time'] ) ) : '';

        if ( $extendednews_ed_post_read_time_new && $extendednews_ed_post_read_time_new != $extendednews_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'extendednews_ed_post_read_time', $extendednews_ed_post_read_time_new );

        }elseif( '' == $extendednews_ed_post_read_time_new && $extendednews_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'extendednews_ed_post_read_time', $extendednews_ed_post_read_time_old );

        }



        $extendednews_ed_post_like_dislike_old = esc_html( get_post_meta( $post_id, 'extendednews_ed_post_like_dislike', true ) ); 
        $extendednews_ed_post_like_dislike_new = isset( $_POST['extendednews_ed_post_like_dislike'] ) ? absint( wp_unslash( $_POST['extendednews_ed_post_like_dislike'] ) ) : '';

        if ( $extendednews_ed_post_like_dislike_new && $extendednews_ed_post_like_dislike_new != $extendednews_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'extendednews_ed_post_like_dislike', $extendednews_ed_post_like_dislike_new );

        }elseif( '' == $extendednews_ed_post_like_dislike_new && $extendednews_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'extendednews_ed_post_like_dislike', $extendednews_ed_post_like_dislike_old );

        }



        $extendednews_ed_post_author_box_old = esc_html( get_post_meta( $post_id, 'extendednews_ed_post_author_box', true ) ); 
        $extendednews_ed_post_author_box_new = isset( $_POST['extendednews_ed_post_author_box'] ) ? absint( wp_unslash( $_POST['extendednews_ed_post_author_box'] ) ) : '';

        if ( $extendednews_ed_post_author_box_new && $extendednews_ed_post_author_box_new != $extendednews_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'extendednews_ed_post_author_box', $extendednews_ed_post_author_box_new );

        }elseif( '' == $extendednews_ed_post_author_box_new && $extendednews_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'extendednews_ed_post_author_box', $extendednews_ed_post_author_box_old );

        }



        $extendednews_ed_post_social_share_old = esc_html( get_post_meta( $post_id, 'extendednews_ed_post_social_share', true ) ); 
        $extendednews_ed_post_social_share_new = isset( $_POST['extendednews_ed_post_social_share'] ) ? absint( wp_unslash( $_POST['extendednews_ed_post_social_share'] ) ) : '';

        if ( $extendednews_ed_post_social_share_new && $extendednews_ed_post_social_share_new != $extendednews_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'extendednews_ed_post_social_share', $extendednews_ed_post_social_share_new );

        }elseif( '' == $extendednews_ed_post_social_share_new && $extendednews_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'extendednews_ed_post_social_share', $extendednews_ed_post_social_share_old );

        }



        $extendednews_ed_post_reaction_old = esc_html( get_post_meta( $post_id, 'extendednews_ed_post_reaction', true ) ); 
        $extendednews_ed_post_reaction_new = isset( $_POST['extendednews_ed_post_reaction'] ) ? absint( wp_unslash( $_POST['extendednews_ed_post_reaction'] ) ) : '';

        if ( $extendednews_ed_post_reaction_new && $extendednews_ed_post_reaction_new != $extendednews_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'extendednews_ed_post_reaction', $extendednews_ed_post_reaction_new );

        }elseif( '' == $extendednews_ed_post_reaction_new && $extendednews_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'extendednews_ed_post_reaction', $extendednews_ed_post_reaction_old );

        }



        $extendednews_ed_post_rating_old = esc_html( get_post_meta( $post_id, 'extendednews_ed_post_rating', true ) ); 
        $extendednews_ed_post_rating_new = isset( $_POST['extendednews_ed_post_rating'] ) ? absint( wp_unslash( $_POST['extendednews_ed_post_rating'] ) ) : '';

        if ( $extendednews_ed_post_rating_new && $extendednews_ed_post_rating_new != $extendednews_ed_post_rating_old ){

            update_post_meta ( $post_id, 'extendednews_ed_post_rating', $extendednews_ed_post_rating_new );

        }elseif( '' == $extendednews_ed_post_rating_new && $extendednews_ed_post_rating_old ) {

            delete_post_meta( $post_id,'extendednews_ed_post_rating', $extendednews_ed_post_rating_old );

        }

        foreach ( $extendednews_page_layout_options as $extendednews_post_layout_option ) {  
        
            $extendednews_page_layout_old = sanitize_text_field( get_post_meta( $post_id, 'extendednews_page_layout', true ) ); 
            $extendednews_page_layout_new = isset( $_POST['extendednews_page_layout'] ) ? extendednews_sanitize_post_layout_option_meta( wp_unslash( $_POST['extendednews_page_layout'] ) ) : '';

            if ( $extendednews_page_layout_new && $extendednews_page_layout_new != $extendednews_page_layout_old ){

                update_post_meta ( $post_id, 'extendednews_page_layout', $extendednews_page_layout_new );

            }elseif( '' == $extendednews_page_layout_new && $extendednews_page_layout_old ) {

                delete_post_meta( $post_id,'extendednews_page_layout', $extendednews_page_layout_old );

            }
            
        }

        $extendednews_ed_header_overlay_old = absint( get_post_meta( $post_id, 'extendednews_ed_header_overlay', true ) ); 
        $extendednews_ed_header_overlay_new = isset( $_POST['extendednews_ed_header_overlay'] ) ? absint( wp_unslash( $_POST['extendednews_ed_header_overlay'] ) ) : '';

        if ( $extendednews_ed_header_overlay_new && $extendednews_ed_header_overlay_new != $extendednews_ed_header_overlay_old ){

            update_post_meta ( $post_id, 'extendednews_ed_header_overlay', $extendednews_ed_header_overlay_new );

        }elseif( '' == $extendednews_ed_header_overlay_new && $extendednews_ed_header_overlay_old ) {

            delete_post_meta( $post_id,'extendednews_ed_header_overlay', $extendednews_ed_header_overlay_old );

        }

        $twp_aspect_ratio_old = esc_attr( get_post_meta( $post_id, 'twp_aspect_ratio', true ) );

        $twp_aspect_ratio_new = '';
        if( isset( $_POST['twp_aspect_ratio'] ) ){

            $twp_aspect_ratio_new = isset( $_POST['twp_aspect_ratio'] ) ? sanitize_text_field( wp_unslash( $_POST['twp_aspect_ratio'] ) ) : '';

        }

        if( $twp_aspect_ratio_new && $twp_aspect_ratio_new != $twp_aspect_ratio_old ){

            update_post_meta ( $post_id, 'twp_aspect_ratio', $twp_aspect_ratio_new );

        }elseif( '' == $twp_aspect_ratio_new && $twp_aspect_ratio_old ) {

            delete_post_meta( $post_id,'twp_aspect_ratio', $twp_aspect_ratio_old );

        }

        $twp_video_autoplay_old = esc_attr( get_post_meta( $post_id, 'twp_video_autoplay', true ) );

        $twp_video_autoplay_new = '';
        if( isset( $_POST['twp_video_autoplay'] ) ){

            $twp_video_autoplay_new = isset( $_POST['twp_video_autoplay'] ) ? sanitize_text_field( wp_unslash( $_POST['twp_video_autoplay'] ) ) : '';

        }

        if( $twp_video_autoplay_new && $twp_video_autoplay_new != $twp_video_autoplay_old ){

            update_post_meta ( $post_id, 'twp_video_autoplay', $twp_video_autoplay_new );

        }elseif( '' == $twp_video_autoplay_new && $twp_video_autoplay_old ) {

            delete_post_meta( $post_id,'twp_video_autoplay', $twp_video_autoplay_old );

        }
        
    }

endif;   