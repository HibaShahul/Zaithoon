<?php
if ( !class_exists('ExtendedNews_Dashboard_Notice') ):

    class ExtendedNews_Dashboard_Notice
    {
        function __construct()
        {	
            global $pagenow;

        	if( $this->extendednews_show_hide_notice() ){

	            if( is_multisite() ){

                  add_action( 'network_admin_notices',array( $this,'extendednews_admin_notiece' ) );

                } else {

                  add_action( 'admin_notices',array( $this,'extendednews_admin_notiece' ) );
                }
	        }
	        add_action( 'wp_ajax_extendednews_notice_dismiss', array( $this, 'extendednews_notice_dismiss' ) );
			add_action( 'switch_theme', array( $this, 'extendednews_notice_clear_cache' ) );
        
            if( isset( $_GET['page'] ) && $_GET['page'] == 'extendednews-about' ){

                add_action('in_admin_header', array( $this,'extendednews_hide_all_admin_notice' ),1000 );

            }
        }

        public function extendednews_hide_all_admin_notice(){

            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');

        }
        
        public static function extendednews_show_hide_notice( $status = false ){

            if( $status ){

                if( (class_exists( 'Booster_Extension_Class' ) ) || get_option('extendednews_admin_notice') ){

                    return false;

                }else{

                    return true;

                }

            }

            // Check If current Page 
            if ( isset( $_GET['page'] ) && $_GET['page'] == 'extendednews-about'  ) {
                return false;
            }

        	// Hide if dismiss notice
        	if( get_option('extendednews_admin_notice') ){
				return false;
			}
        	// Hide if all plugin active
        	if ( class_exists( 'Booster_Extension_Class' ) && class_exists( 'Themeinwp_Import_Companion' ) ) {
				return false;
			}
			// Hide On TGMPA pages
			if ( ! empty( $_GET['tgmpa-nonce'] ) ) {
				return false;
			}
			// Hide if user can't access
        	if ( current_user_can( 'manage_options' ) ) {
				return true;
			}
			
        }

        // Define Global Value
        public static function extendednews_admin_notiece(){

            ?>
           <div class="updated notice is-dismissible welcome-panel twp-extendednews-notice">

                <h3><?php esc_html_e('Quick Setup','extendednews'); ?></h3>

                <p><strong><?php esc_html_e('ExtendedNews is now installed and ready to use. Are you looking for a better experience to set up your site?','extendednews'); ?></strong></p>

                <small><?php esc_html_e("We've prepared a unique onboarding process through our",'extendednews'); ?> <a href="<?php echo esc_url( admin_url().'themes.php?page='.get_template().'-about') ?>"><?php esc_html_e('Getting started','extendednews'); ?></a> <?php esc_html_e("page. It helps you get started and configure your upcoming website with ease. Let's make it shine!",'extendednews'); ?></small>

                <p>
                    <a class="button button-primary twp-install-active" href="javascript:void(0)"><?php esc_html_e('Install and activate recommended plugins','extendednews'); ?></a>
                    <span class="quick-loader-wrapper"><span class="quick-loader"></span></span>

                    <a target="_blank" class="button button-primary" href="<?php echo esc_url( 'https://demo.themeinwp.com/extendednews/' ); ?>"><?php esc_html_e('View Demo','extendednews'); ?></a>
                    <a target="_blank" class="button button-primary button-primary-upgrade" href="<?php echo esc_url( 'https://www.themeinwp.com/theme/extendednews-pro/' ); ?>"><?php esc_html_e('Upgrade to Pro','extendednews'); ?></a>
                    <a class="btn-dismiss twp-custom-setup" href="javascript:void(0)"><?php esc_html_e('Dismiss this notice.','extendednews'); ?></a>

                </p>

            </div>

        <?php
        }

        public function extendednews_notice_dismiss(){

        	if ( isset( $_POST[ '_wpnonce' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ '_wpnonce' ] ) ), 'extendednews_ajax_nonce' ) ) {

	        	update_option('extendednews_admin_notice','hide');

	        }

            die();

        }

        public function extendednews_notice_clear_cache(){

        	update_option('extendednews_admin_notice','');

        }

    }
    new ExtendedNews_Dashboard_Notice();
endif;