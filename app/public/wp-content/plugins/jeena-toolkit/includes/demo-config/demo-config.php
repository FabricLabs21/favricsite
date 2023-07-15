<?php
namespace JeenaToolkit\DemoConfig;

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

class Jeena_Demo_Config {
    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        add_filter( 'ocdi/import_files', [$this, 'import_files'] );
        add_filter( 'ocdi/after_import', [$this, 'after_import_demo'] );
        add_filter( 'ocdi/register_plugins', [$this, 'register_plugins'] );
    }

    /**
     * Import Files
     */
    public function import_files() {
        return [
            [
                'import_file_name'             => esc_html__( 'Main Demo', 'jeena-toolkit' ),
                'local_import_file'            => JT_INCLUDES . '/demo-config/demo/content.xml',
                'local_import_widget_file'     => JT_INCLUDES . '/demo-config/demo/widgets.wie',
                'local_import_customizer_file' => JT_INCLUDES . '/demo-config/demo/customizer.dat',
                'import_notice'                => esc_html__( 'Works best on a new install of WordPress. Before you begin, make sure all the required plugins are install and activated. After you import this demo, you need to setup menu and front page. Read documentation for more information.', 'jeena-toolkit' ),
                'preview_url'                  => esc_url( 'https://demo.webtend.net/wp/jeena/' ),
            ],
        ];
    }

    /**
     * After Import Demo
     *
     * Do Stuff After Demo Import
     */
    public function after_import_demo() {
        $main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

        set_theme_mod( 'nav_menu_locations',
            [
                'primary_menu' => $main_menu->term_id,
            ]
        );

        $front_page_id = get_page_by_title( 'Home IT Company' );
        $blog_page_id  = get_page_by_title( 'Blog Standard' );

        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_global_image_lightbox', 'no' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );
    }

    /**
     * Register Plugins
     */
    public function register_plugins( $plugins ) {
        $theme_plugins = [
            [
                'name'        => esc_html__( 'Elementor Website Builder', 'jeena-toolkit' ),
                'slug'        => 'elementor',
                'required'    => true,
                'preselected' => true,
            ],
            [
                'name'        => esc_html__( 'Jeena Toolkit', 'jeena-toolkit' ),
                'slug'        => 'jeena-toolkit',
                'source'      => get_template_directory() . '/inc/plugins/jeena-toolkit.zip',
                'required'    => true,
                'version'     => '1.0.1',
                'preselected' => true,
            ],
            [
                'name'     => esc_html__( 'Contact Form 7', 'jeena-toolkit' ),
                'slug'     => 'contact-form-7',
                'required' => false,
            ],
            [
                'name'     => esc_html__( 'Breadcrumb NavXT', 'jeena-toolkit' ),
                'slug'     => 'breadcrumb-navxt',
                'required' => false,
            ],
            [
                'name'     => esc_html__( 'MC4WP: Mailchimp for WordPress', 'jeena-toolkit' ),
                'slug'     => 'mailchimp-for-wp',
                'required' => false,
            ],
        ];

        return array_merge( $plugins, $theme_plugins );
    }
}

Jeena_Demo_Config::instance()->initialize();