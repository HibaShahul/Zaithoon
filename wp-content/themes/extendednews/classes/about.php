<?php

/**
 * ExtendedNews About Page
 * @package ExtendedNews
 *
*/

if( !class_exists('ExtendedNews_About_page') ):

	class ExtendedNews_About_page{

		function __construct(){

			add_action('admin_menu', array($this, 'extendednews_backend_menu'),999);

		}

		// Add Backend Menu
        function extendednews_backend_menu(){

            add_theme_page(esc_html__( 'ExtendedNews Options','extendednews' ), esc_html__( 'ExtendedNews Options','extendednews' ), 'activate_plugins', 'extendednews-about', array($this, 'extendednews_main_page'));

        }

        // Settings Form
        function extendednews_main_page(){

            require get_template_directory() . '/classes/about-render.php';

        }

	}

	new ExtendedNews_About_page();

endif;