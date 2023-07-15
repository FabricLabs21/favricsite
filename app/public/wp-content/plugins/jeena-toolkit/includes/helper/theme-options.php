<?php
namespace JeenaToolkit\Helper;

use CSF;
use JeenaTheme\Classes\Jeena_Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Jeena Toolkit Helper
 */
class Jeena_Theme_Options {
    protected static $instance = null;

    private $options_prefix = 'jeena_options';
    private $menu_slug      = 'jeena_options';
    private $template_builder_url;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        if ( ! class_exists( 'CSF' ) ) {
            return;
        }

        $this->template_builder_url = admin_url( 'edit.php?post_type=jeena_template' );

        $this->theme_options();
        $this->general_section();
        $this->header_section();
        $this->footer_section();
        $this->page_title_section();
        $this->blog_section();
        $this->error_section();
        $this->portfolio_section();
        $this->shop_section();
        $this->color_scheme_section();
        $this->typography_section();
        $this->custom_scrips_section();
        $this->backup_section();

        add_filter( 'csf_color_palette', [$this, 'custom_color_palette'] );
    }

    /**
     * Create Theme Option
     */
    public function theme_options() {
        CSF::createOptions( $this->options_prefix, [
            'menu_title'         => esc_html__( 'Theme Options', 'jeena-toolkit' ),
            'menu_slug'          => $this->menu_slug,
            'framework_title'    => esc_html__( 'Theme Options', 'jeena-toolkit' ),
            'show_in_customizer' => true,
            'menu_type'          => 'submenu',
            'menu_parent'        => 'jeena_dashboard',
        ] );
    }

    /**
     * General Option
     */
    public function general_section() {
        CSF::createSection( $this->options_prefix, [
            'id'    => 'general_options',
            'title' => esc_html__( 'General', 'jeena-toolkit' ),
        ] );

        /**
         * Site Layout
         */
        CSF::createSection( $this->options_prefix, [
            'parent' => 'general_options',
            'title'  => esc_html__( 'Layout', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Layout', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'site_layout',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Layout', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Set the website layout.', 'jeena-toolkit' ),
                    'options'  => [
                        'full-width' => esc_html__( 'Full Width', 'jeena-toolkit' ),
                        'boxed'      => esc_html__( 'Boxed', 'jeena-toolkit' ),
                    ],
                    'default'  => 'full-width',
                ],
                [
                    'id'         => 'boxed_width',
                    'type'       => 'dimensions',
                    'title'      => esc_html__( 'Boxed Container Width.', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Set the boxed outer container width.', 'jeena-toolkit' ),
                    'default'    => [
                        'width' => '1530',
                        'unit'  => 'px',
                    ],
                    'height'     => false,
                    'units'      => ['px'],
                    'dependency' => ['site_layout', '==', 'boxed'],
                ],
                [
                    'id'         => 'boxed_container_color',
                    'type'       => 'background',
                    'title'      => esc_html__( 'Boxed Background Color', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Set the boxed inner container background color.', 'jeena-toolkit' ),
                    'output'     => '.jeena-boxed-layout .jeena-body-content',
                    'dependency' => ['site_layout', '==', 'boxed'],
                ],
                [
                    'id'       => 'body_bg',
                    'type'     => 'background',
                    'title'    => esc_html__( 'Body Background', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Set the <body> background.', 'jeena-toolkit' ),
                    'output'   => 'body',
                ],
                [
                    'id'       => 'container_width',
                    'type'     => 'dimensions',
                    'title'    => esc_html__( 'Container Width.', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Set the container maximum width.', 'jeena-toolkit' ),
                    'default'  => [
                        'width' => '1320',
                        'unit'  => 'px',
                    ],
                    'height'   => false,
                    'units'    => ['px'],
                ],
                [
                    'id'       => 'site_border',
                    'type'     => 'switcher',
                    'title'    => esc_html__( 'Site Border', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Set a colored border around the website.', 'jeena-toolkit' ),
                    'default'  => false,
                ],
                [
                    'id'          => 'site_border_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Site Border Color', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Set the site border color.' ),
                    'output'      => '.jeena-site-border .jeena-body-content',
                    'output_mode' => 'border-color',
                    'dependency'  => ['site_border', '==', true],
                ],
                [
                    'id'          => 'site_border_width',
                    'type'        => 'number',
                    'title'       => esc_html__( 'Site Border Width.', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Set the site border width.', 'jeena-toolkit' ),
                    'unit'        => 'px',
                    'output'      => '.jeena-site-border .jeena-body-content',
                    'output_mode' => 'border-width',
                    'dependency'  => ['site_border', '==', true],
                ],
            ],
        ] );

        /**
         * Preloader
         */
        CSF::createSection( $this->options_prefix, [
            'parent' => 'general_options',
            'title'  => esc_html__( 'Preloader', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Preloader', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'site_preloader',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Site Preloader', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable site Preloader', 'jeena-toolkit' ),
                    'options'  => [
                        'enabled'  => esc_html__( 'Enabled', 'jeena-toolkit' ),
                        'Disabled' => esc_html__( 'Disabled', 'jeena-toolkit' ),
                    ],
                    'default'  => 'enabled',
                ],
                [
                    'id'         => 'preloader_text',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Preloader Text', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Site Preloader Main Text', 'jeena-toolkit' ),
                    'default'    => esc_html__( 'Jeena', 'jeena-toolkit' ),
                    'dependency' => ['site_preloader', '==', 'enabled'],
                ],
                [
                    'id'         => 'preloader_loading_text',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Loading Text', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Site Preloader small Text', 'jeena-toolkit' ),
                    'default'    => esc_html__( 'Loading', 'jeena-toolkit' ),
                    'dependency' => ['site_preloader', '==', 'enabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Preloader Styling', 'jeena-toolkit' ),
                    'dependency' => ['site_preloader', '==', 'enabled'],
                ],
                [
                    'id'          => 'preloader_background',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background Color', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Preloader background color', 'jeena-toolkit' ),
                    'output'      => '.site-preloader .preloader-layer .overly',
                    'output_mode' => 'background-color',
                    'dependency'  => ['site_preloader', '==', 'enabled'],
                ],
                [
                    'id'          => 'preloader_text_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Text Color', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Preloader text colors', 'jeena-toolkit' ),
                    'output'      => '.site-preloader .animation-preloader .loading-text, .site-preloader .animation-preloader .text-loading .letters-loading::before',
                    'output_mode' => 'color',
                    'dependency'  => ['site_preloader', '==', 'enabled'],
                ],
                [
                    'id'          => 'spinner_base_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Spinner Base Color', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Preloader spinner base color', 'jeena-toolkit' ),
                    'output'      => '.site-preloader .animation-preloader .spinner',
                    'output_mode' => 'border-color',
                    'dependency'  => ['site_preloader', '==', 'enabled'],
                ],
                [
                    'id'          => 'spinner_line_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Spinner Line Color', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Preloader spinner line color', 'jeena-toolkit' ),
                    'output'      => '.site-preloader .animation-preloader .spinner',
                    'output_mode' => 'border-top-color',
                    'dependency'  => ['site_preloader', '==', 'enabled'],
                ],
            ],
        ] );

        /**
         * Back to Top
         */
        CSF::createSection( $this->options_prefix, [
            'parent' => 'general_options',
            'title'  => esc_html__( 'Back to Top', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Back to Top', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'back_to_top',
                    'type'     => 'switcher',
                    'title'    => esc_html__( 'Back to Top', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Add a back to top button on bottom right corner.', 'jeena-toolkit' ),
                    'default'  => true,
                ],
                [
                    'id'       => 'back_to_top_mobile',
                    'type'     => 'switcher',
                    'title'    => esc_html__( 'Show on Mobile', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Show the back to top button on mobile devices..', 'jeena-toolkit' ),
                    'default'  => false,
                ],
                [
                    'id'          => 'back_to_top_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Icon Color', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Back to Top icon color' ),
                    'output'      => '.back-to-top i',
                    'output_mode' => 'color',
                    'dependency'  => ['back_to_top', '==', true],
                ],
                [
                    'id'          => 'back_to_top_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Icon Background', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Back to Top icon color' ),
                    'output'      => '.back-to-top i',
                    'output_mode' => 'background-color',
                    'dependency'  => ['back_to_top', '==', true],
                ],
                [
                    'id'          => 'back_top_area_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Wrapper Background', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Back to Top icon color' ),
                    'output'      => '.back-to-top',
                    'output_mode' => 'background-color',
                    'dependency'  => ['back_to_top', '==', true],
                ],
            ],
        ] );
    }

    /**
     * Header Options
     */
    public function header_section() {
        CSF::createSection( $this->options_prefix, [
            'id'    => 'header_options',
            'title' => esc_html__( 'Header', 'jeena-toolkit' ),
        ] );

        /**
         * Header Layout
         */
        CSF::createSection( $this->options_prefix, [
            'parent' => 'header_options',
            'title'  => esc_html__( 'General', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'General', 'jeena-toolkit' ),
                ],
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for site header then disable default theme header', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Header', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Theme default header', 'jeena-toolkit' ),
                    'options'  => [
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'  => 'enabled',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default theme header. Set your site header form ', 'jeena-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'jeena-toolkit' ) . '</a>',
                    'dependency' => [
                        'default_header', '==', 'disabled',
                    ],
                ],
                [
                    'id'         => 'header_breakpoint',
                    'type'       => 'number',
                    'title'      => esc_html__( 'Header Breakpoint', 'jeena-toolkit' ),
                    'default'    => 1200,
                    'subtile'    => esc_html__( 'Enter when the slide menu will appear', 'jeena-toolkit' ),
                    'dependency' => [
                        'default_header', '==', 'enabled',
                    ],
                ],
                [
                    'id'         => 'header_button',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Show Header Button', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Show a button to header right side', 'jeena-toolkit' ),
                    'options'    => [
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'    => 'enabled',
                    'dependency' => [
                        'default_header', '==', 'enabled',
                    ],
                ],
                [
                    'id'         => 'button_text',
                    'title'      => esc_html__( 'Button Text', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Text for Header Button.', 'jeena-toolkit' ),
                    'type'       => 'text',
                    'default'    => esc_html__( 'Get a Quote', 'jeena-toolkit' ),
                    'dependency' => [
                        ['default_header', '==', 'enabled'],
                        ['header_button', '==', 'enabled'],
                    ],
                ],
                [
                    'id'         => 'button_url',
                    'title'      => esc_html__( 'Button URL', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'URL for Header Button.', 'jeena-toolkit' ),
                    'type'       => 'text',
                    'default'    => '#',
                    'dependency' => [
                        ['default_header', '==', 'enabled'],
                        ['header_button', '==', 'enabled'],
                    ],
                ],
                [
                    'id'         => 'button_icon',
                    'title'      => esc_html__( 'Button Icon', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Icon for Header Button.', 'jeena-toolkit' ),
                    'type'       => 'icon',
                    'default'    => 'fa fa-long-arrow-right',
                    'dependency' => [
                        ['default_header', '==', 'enabled'],
                        ['header_button', '==', 'enabled'],
                    ],
                ],
                [
                    'id'       => 'transparent_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Transparent Header', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Set header to transparent background before scroll.', 'jeena-toolkit' ),
                    'options'  => [
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'  => 'disabled',
                ],
            ],
        ] );

        /**
         * Site Logo
         */
        CSF::createSection( $this->options_prefix, [
            'parent' => 'header_options',
            'title'  => esc_html__( 'Logo', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Header Logo', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'site_logo_type',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Site Logo Type', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Select site logo type', 'jeena-toolkit' ),
                    'options'  => [
                        'text'  => esc_html__( 'Text', 'jeena-toolkit' ),
                        'image' => esc_html__( 'Image', 'jeena-toolkit' ),
                    ],
                    'default'  => 'image',
                ],
                [
                    'id'         => 'site_text_logo',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Text logo', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Type logo text', 'jeena-toolkit' ),
                    'default'    => esc_html__( 'Jeena', 'jeena-toolkit' ),
                    'dependency' => ['site_logo_type', '==', 'text'],
                ],
                [
                    'id'         => 'site_image_logo',
                    'type'       => 'media',
                    'title'      => esc_html__( 'Image logo', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Upload OR Select image for site logo', 'jeena-toolkit' ),
                    'library'    => 'image',
                    'url'        => false,
                    'default'    => [
                        'url'       => JT_THEME_ASSETS . '/img/logo.png',
                        'thumbnail' => JT_THEME_ASSETS . '/img/logo.png',
                    ],
                    'dependency' => ['site_logo_type', '==', 'image'],
                ],
                [
                    'id'         => 'logo_dimension',
                    'type'       => 'dimensions',
                    'title'      => esc_html__( 'Logo Dimensions', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Site logo Dimensions', 'jeena-toolkit' ),
                    'output'     => '.default-header .jeena-site-logo img',
                    'dependency' => ['site_logo_type', '==', 'image'],
                ],
                [
                    'id'          => 'logo_max_width',
                    'type'        => 'number',
                    'unit'        => 'px',
                    'title'       => esc_html__( 'Max Width', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Logo wrapper max width', 'jeena-toolkit' ),
                    'output'      => '.default-header .jeena-site-logo',
                    'output_mode' => 'max-width',
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Mobile Panel Logo', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'panel_logo_type',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Panel Logo Type', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Select Logo type', 'jeena-toolkit' ),
                    'options'  => [
                        'text'  => esc_html__( 'Text', 'jeena-toolkit' ),
                        'image' => esc_html__( 'Image', 'jeena-toolkit' ),
                    ],
                    'default'  => 'image',
                ],
                [
                    'id'         => 'panel_text_logo',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Text logo', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Type logo text', 'jeena-toolkit' ),
                    'default'    => 'Jeena',
                    'dependency' => ['panel_logo_type', '==', 'text'],
                ],
                [
                    'id'         => 'panel_image_logo',
                    'type'       => 'media',
                    'title'      => esc_html__( 'Image logo', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Select OR Upload image', 'jeena-toolkit' ),
                    'library'    => 'image',
                    'url'        => false,
                    'default'    => [
                        'url'       => JT_THEME_ASSETS . '/img/logo.png',
                        'thumbnail' => JT_THEME_ASSETS . '/img/logo.png',
                    ],
                    'dependency' => ['panel_logo_type', '==', 'image'],
                ],
                [
                    'id'         => 'slide_panel_dimension',
                    'type'       => 'dimensions',
                    'title'      => esc_html__( 'Logo Dimensions', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Image logo Dimensions', 'jeena-toolkit' ),
                    'output'     => '.default-header .slide-panel-logo img',
                    'dependency' => ['panel_logo_type', '==', 'image'],
                ],
                [
                    'id'          => 'panel_logo_max_width',
                    'type'        => 'number',
                    'unit'        => 'px',
                    'title'       => esc_html__( 'Max Width', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Logo wrapper max width', 'jeena-toolkit' ),
                    'output'      => '.jeena-nav-menu .slide-panel-wrapper .slide-panel-logo',
                    'output_mode' => 'max-width',
                ],
            ],
        ] );

        /**
         * Styling
         */
        CSF::createSection( $this->options_prefix, [
            'parent' => 'header_options',
            'title'  => esc_html__( 'Styling', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Header Styling', 'jeena-toolkit' ),
                ],
                [
                    'id'               => 'header_bg',
                    'type'             => 'color',
                    'title'            => esc_html__( 'Header Background', 'jeena-toolkit' ),
                    'output'           => ['.site-header.default-header'],
                    'output_mode'      => 'background-color',
                    'output_important' => true,
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Menu Items', 'jeena-toolkit' ),
                ],
                [
                    'id'          => 'menu_item_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Menu Item Color', 'jeena-toolkit' ),
                    'desc'        => esc_html__( 'This is the menu item font color.', 'jeena-toolkit' ),
                    'output'      => ['.default-header .jeena-nav-menu .nav-menu-wrapper a, .jeena-transparent-header .default-header .nav-menu-wrapper ul.primary-menu > li > a'],
                    'output_mode' => 'color',
                ],
                [
                    'id'          => 'menu_item_hover_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Active/Hover Color', 'jeena-toolkit' ),
                    'desc'        => esc_html__( 'This is the menu item font color.', 'jeena-toolkit' ),
                    'output'      => ['.default-header .jeena-nav-menu .nav-menu-wrapper a:hover, .default-header .jeena-nav-menu .nav-menu-wrapper li.current_page_item > a'],
                    'output_mode' => 'color',
                ],
                [
                    'id'     => 'menu_typography',
                    'type'   => 'typography',
                    'title'  => esc_html__( 'Menu Typography', 'jeena-toolkit' ),
                    'color'  => false,
                    'output' => '.default-header .jeena-nav-menu .nav-menu-wrapper a',
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Submenu', 'jeena-toolkit' ),
                ],
                [
                    'id'          => 'submenu_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Submenu Background', 'jeena-toolkit' ),
                    'output'      => '.default-header .jeena-nav-menu .nav-menu-wrapper .sub-menu',
                    'output_mode' => 'background-color',
                ],
                [
                    'id'          => 'submenu_item_divider',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Divider', 'jeena-toolkit' ),
                    'output'      => '.default-header .jeena-nav-menu .nav-menu-wrapper .sub-menu li:not(:last-child)',
                    'output_mode' => 'border-color',
                ],
                [
                    'id'          => 'submenu_item_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Color', 'jeena-toolkit' ),
                    'output'      => '.default-header .jeena-nav-menu .nav-menu-wrapper .sub-menu a',
                    'output_mode' => 'color',
                ],
                [
                    'id'          => 'submenu_item_hover_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Hover Color', 'jeena-toolkit' ),
                    'output'      => '.default-header .jeena-nav-menu .nav-menu-wrapper .sub-menu a:hover',
                    'output_mode' => 'color',
                ],
                [
                    'id'     => 'submenu_typography',
                    'type'   => 'typography',
                    'title'  => esc_html__( 'Item Typography', 'jeena-toolkit' ),
                    'color'  => false,
                    'output' => '.default-header .jeena-nav-menu .nav-menu-wrapper .sub-menu a',
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Mobile Slide Panel', 'jeena-toolkit' ),
                ],
                [
                    'id'     => 'toggler_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Toggler Color', 'jeena-toolkit' ),
                    'output' => [
                        'border-color'     => '.default-header .jeena-nav-menu .navbar-toggler, .jeena-transparent-header .default-header .jeena-nav-menu .navbar-toggler',
                        'background-color' => '.default-header .jeena-nav-menu .navbar-toggler .line, .jeena-transparent-header .default-header .jeena-nav-menu .navbar-toggler .line',
                    ],
                ],
                [
                    'id'          => 'slide_panel_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background', 'jeena-toolkit' ),
                    'output'      => '.default-header .jeena-nav-menu .slide-panel-wrapper.show-panel .slide-panel-content',
                    'output_mode' => 'background-color',
                ],
                [
                    'id'          => 'panel_item_divider',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Divider', 'jeena-toolkit' ),
                    'output'      => ['.default-header .jeena-nav-menu .slide-panel-wrapper .slide-panel-menu a', '.default-header .jeena-nav-menu .slide-panel-wrapper ul.primary-menu, .default-header .jeena-nav-menu .slide-panel-wrapper .slide-panel-menu a .submenu-toggler'],
                    'output_mode' => 'border-color',
                ],
                [
                    'id'          => 'panel_item_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Color', 'jeena-toolkit' ),
                    'output'      => ['.default-header .jeena-nav-menu .slide-panel-wrapper .slide-panel-menu a', '.default-header .jeena-nav-menu .slide-panel-wrapper .slide-panel-close'],
                    'output_mode' => 'color',
                ],
                [
                    'id'          => 'panel_item_hover_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Hover Color', 'jeena-toolkit' ),
                    'output'      => '.default-header .jeena-nav-menu .slide-panel-wrapper .slide-panel-menu li.current_page_item > a',
                    'output_mode' => 'color',
                ],
                [
                    'id'     => 'panel_typography',
                    'type'   => 'typography',
                    'title'  => esc_html__( 'Item Typography', 'jeena-toolkit' ),
                    'color'  => false,
                    'output' => '.default-header .jeena-nav-menu .slide-panel-wrapper .slide-panel-menu a',
                ],
            ],
        ] );
    }

    /**
     * Footer Options
     */
    public function footer_section() {
        CSF::createSection( $this->options_prefix, [
            'id'    => 'footer_options',
            'title' => esc_html__( 'Footer', 'jeena-toolkit' ),
        ] );

        /**
         * Footer Layout
         */
        CSF::createSection( $this->options_prefix, [
            'parent' => 'footer_options',
            'title'  => esc_html__( 'General', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'General', 'jeena-toolkit' ),
                ],
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for site footer then disable default theme header', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Footer', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Theme default footer', 'jeena-toolkit' ),
                    'options'  => [
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'  => 'enabled',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default theme footer. Set your site footer form ', 'jeena-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'jeena-toolkit' ) . '</a>',
                    'dependency' => [
                        'default_footer', '==', 'disabled',
                    ],
                ],
            ],
        ] );

        /**
         * Footer Widgets
         */
        CSF::createSection( $this->options_prefix, [
            'parent' => 'footer_options',
            'title'  => esc_html__( 'Footer Widgets', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Footer Widgets', 'jeena-toolkit' ),
                ],
                [
                    'id'          => 'footer_background',
                    'type'        => 'background',
                    'title'       => esc_html__( 'Footer background', 'jeena-toolkit' ),
                    'output'      => '.site-footer .footer-widgets',
                    'output_mode' => 'background-color',
                ],
                [
                    'id'     => 'footer_text_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Text Color', 'jeena-toolkit' ),
                    'output' => [
                        '--text-color' => '.site-footer',
                    ],
                ],
                [
                    'id'     => 'footer_text_hover_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Hover Color', 'jeena-toolkit' ),
                    'output' => [
                        '--hover-text-color' => '.site-footer',
                    ],
                ],
                [
                    'id'               => 'footer_content_typography',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Content Typography', 'jeena-toolkit' ),
                    'color'            => false,
                    'line_height_unit' => 'em',
                    'preview'          => false,
                    'output'           => ['.site-footer .footer-widgets .widget'],
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Widget Title', 'jeena-toolkit' ),
                ],
                [
                    'id'               => 'footer_title_typography',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Title', 'jeena-toolkit' ),
                    'output'           => '.footer-widgets .widget .widget-title',
                    'color'            => false,
                    'line_height_unit' => 'em',
                    'preview'          => false,
                ],
                [
                    'id'     => 'footer_title_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Color', 'jeena-toolkit' ),
                    'output' => '.footer-widgets .widget .widget-title, .footer-widgets .widget.widget_rss a.rsswidget',
                ],
            ],
        ] );

        /**
         * Footer Widgets
         */
        CSF::createSection( $this->options_prefix, [
            'parent' => 'footer_options',
            'title'  => esc_html__( 'Footer Copyright', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Footer', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'copyright_text',
                    'type'    => 'textarea',
                    'title'   => esc_html__( 'Copyright Text', 'jeena-toolkit' ),
                    'default' => esc_html__( 'Copyright © 2023. All rights reserved.', 'jeena-toolkit' ),
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Style', 'jeena-toolkit' ),
                ],
                [
                    'id'          => 'copyright_color_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Copyright Background', 'jeena-toolkit' ),
                    'output'      => '.site-footer .footer-copyright',
                    'output_mode' => 'background-color',
                ],
                [
                    'id'     => 'copyright_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Copyright text color', 'jeena-toolkit' ),
                    'output' => '.site-footer .footer-copyright, .site-footer .footer-copyright a',
                ],
            ],
        ] );
    }

    /**
     * Page Title
     */
    public function page_title_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Page Title', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'site_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Site Page Title', 'jeena-toolkit' ),
                    'options' => [
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default' => 'enabled',
                ],
                [
                    'id'         => 'site_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Site Breadcrumb', 'jeena-toolkit' ),
                    'options'    => [
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'    => 'enabled',
                    'dependency' => ['site_page_title', '==', 'enabled'],
                ],
                [
                    'id'         => 'breadcrumb_home_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Breadcrumb Root Title', 'jeena-toolkit' ),
                    'default'    => esc_html__( 'Home', 'jeena-toolkit' ),
                    'dependency' => [
                        ['site_page_title', '==', 'enabled'],
                        ['site_breadcrumb', '==', 'enabled'],
                    ],
                ],
                [
                    'id'         => 'separator_icon',
                    'type'       => 'icon',
                    'title'      => esc_html__( 'Breadcrumb Separator icon', 'jeena-toolkit' ),
                    'default'    => 'fas fa-angle-right',
                    'dependency' => [
                        ['site_page_title', '==', 'enabled'],
                        ['site_breadcrumb', '==', 'enabled'],
                    ],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'jeena-toolkit' ),
                    'dependency' => ['site_page_title', '==', 'enabled'],
                ],
                [
                    'id'         => 'page_title_bg',
                    'type'       => 'background',
                    'title'      => esc_html__( 'Background', 'jeena-toolkit' ),
                    'output'     => '.page-title-wrapper',
                    'dependency' => ['site_page_title', '==', 'enabled'],
                ],
                [
                    'id'          => 'page_title_overly_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Overly Color', 'jeena-toolkit' ),
                    'output'      => '.page-title-wrapper::before',
                    'dependency'  => ['site_page_title', '==', 'enabled'],
                    'output_mode' => 'background-color',
                ],
                [
                    'id'         => 'page_title_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Typography', 'jeena-toolkit' ),
                    'output'     => '.page-title-wrapper .page-title',
                    'dependency' => ['site_page_title', '==', 'enabled'],
                ],
                [
                    'id'               => 'page_breadcrumb_typo',
                    'type'             => 'typography',
                    'line_height_unit' => 'em',
                    'title'            => esc_html( 'Breadcrumb Typography', 'jeena-toolkit' ),
                    'output'           => '.page-title-wrapper .breadcrumb, .page-title-wrapper .breadcrumb a',
                    'dependency'       => ['site_page_title', '==', 'enabled'],
                ],
            ],
        ] );
    }

    /**
     * Blog Options
     */
    public function blog_section() {
        CSF::createSection( $this->options_prefix, [
            'id'    => 'blog_options',
            'title' => esc_html__( 'Blog', 'jeena-toolkit' ),
        ] );

        /**
         * Blog Archive
         */
        CSF::createSection( $this->options_prefix, [
            'parent' => 'blog_options',
            'title'  => esc_html__( 'Blog Archive', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Blog Archive', 'jeena-toolkit' ),
                ],
                [
                    'id'          => 'blog_archive_title',
                    'type'        => 'text',
                    'title'       => esc_html__( 'Blog Archive Title', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Archive page title.', 'jeena-toolkit' ),
                    'placeholder' => esc_html__( 'Type title', 'jeena-toolkit' ),
                    'default'     => esc_html__( 'Latest News', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'blog_archive_sidebar',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Sidebar', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Select Blog Archive Sidebar. Left sidebar or right sidebar or No sidebar', 'jeena-toolkit' ),
                    'options'  => [
                        'left-sidebar'  => esc_html( 'Left Sidebar', 'jeena-toolkit' ),
                        'right-sidebar' => esc_html( 'Right Sidebar', 'jeena-toolkit' ),
                        'no-sidebar'    => esc_html( 'No Sidebar', 'jeena-toolkit' ),
                    ],
                    'default'  => 'right-sidebar',
                ],
                [
                    'id'       => 'archive_post_category',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Post Categories', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post categories on blog archive page', 'jeena-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'       => 'archive_post_author',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Post Author', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post author on blog archive page', 'jeena-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'       => 'archive_post_date',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Post Date', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post date on blog archive page', 'jeena-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'       => 'archive_post_excerpt',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Post Excerpt', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post Excerpt on Blog Archive page', 'jeena-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'         => 'post_excerpt_count',
                    'type'       => 'number',
                    'title'      => esc_html__( 'Excerpt Word Count', 'jeena-toolkit' ),
                    'subtitle'   => esc_html__( 'Set how many words you want to show in the post Excerpt', 'jeena-toolkit' ),
                    'default'    => 15,
                    'dependency' => [
                        'archive_post_excerpt', '==', 'yes',
                    ],
                ],
                [
                    'id'       => 'archive_post_button',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Read More Button', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post Read More Button on Blog Archive page', 'jeena-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'         => 'post_button_text',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Button Text', 'jeena-toolkit' ),
                    'default'    => esc_html__( 'Read More', 'jeena-toolkit' ),
                    'dependency' => [
                        'archive_post_button', '==', 'yes',
                    ],
                ],
            ],
        ] );

        /**
         * Blog Single
         */
        CSF::createSection( $this->options_prefix, [
            'parent' => 'blog_options',
            'title'  => esc_html__( 'Blog Single', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Blog single', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'blog_details_sidebar',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Sidebar', 'jeena-toolkit' ),
                    'options' => [
                        'left-sidebar'  => esc_html( 'Left Sidebar', 'jeena-toolkit' ),
                        'right-sidebar' => esc_html( 'Right Sidebar', 'jeena-toolkit' ),
                        'no-sidebar'    => esc_html( 'No Sidebar', 'jeena-toolkit' ),
                    ],
                    'default' => 'right-sidebar',
                    'desc'    => esc_html__( 'Select Blog Details Sidebar. Left sidebar or right sidebar or No sidebar', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'blog_details_meta',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Post Meta', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post meta on details page title area', 'jeena-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'       => 'blog_details_share',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Post Share Links', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post social share links.', 'jeena-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'  => 'no',
                ],
                [
                    'id'         => 'social_share_item',
                    'type'       => 'sorter',
                    'title'      => esc_html__( 'Social Share Links', 'jeena-toolkit' ),
                    'default'    => [
                        'enabled'  => [
                            'facebook'  => esc_html__( 'Facebook', 'jeena-toolkit' ),
                            'twitter'   => esc_html__( 'Twitter', 'jeena-toolkit' ),
                            'pinterest' => esc_html__( 'Pinterest', 'jeena-toolkit' ),
                            'linkedin'  => esc_html__( 'Linkedin', 'jeena-toolkit' ),
                        ],
                        'disabled' => [
                            'reddit'   => esc_html__( 'Reddit', 'jeena-toolkit' ),
                            'whatsapp' => esc_html__( 'Whatsapp', 'jeena-toolkit' ),
                            'telegram' => esc_html__( 'Telegram', 'jeena-toolkit' ),
                        ],
                    ],
                    'dependency' => [
                        'blog_details_share', '==', 'yes',
                    ],
                ],
                [
                    'id'       => 'blog_details_tag',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Related Tags', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable related tag on Blog Details page', 'jeena-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'       => 'blog_details_nav',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Post Navigation', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post navigation on Blog Details page', 'jeena-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'       => 'blog_author_info',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Post Author', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post author information box.', 'jeena-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'  => 'no',
                ],
            ],
        ] );
    }

    /**
     * Error Options
     */
    public function error_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( '404 Page', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( '404 Page', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'error_title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Sub Title', 'jeena-toolkit' ),
                    'default' => esc_html__( 'OPPS! This Pages Are Can’t Be Found.', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'error_subtitle',
                    'type'    => 'textarea',
                    'title'   => esc_html__( 'Error Page Note', 'jeena-toolkit' ),
                    'default' => esc_html__( 'The page you are looking for was moved, removed, renamed or might never existed.', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'error_button_text',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Error Button Text', 'jeena-toolkit' ),
                    'default' => esc_html__( 'Go to Home', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'error_logo',
                    'type'     => 'media',
                    'title'    => esc_html__( 'Logo', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Upload OR Select a logo for 404 page', 'jeena-toolkit' ),
                    'library'  => 'image',
                    'url'      => false,
                    'default'  => [
                        'url'       => JT_THEME_ASSETS . '/img/logo.png',
                        'thumbnail' => JT_THEME_ASSETS . '/img/logo.png',
                    ],
                ],
                [
                    'id'       => 'error_img',
                    'type'     => 'media',
                    'title'    => esc_html__( '404 Illustration', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Upload OR Select a illustration for 404 page', 'jeena-toolkit' ),
                    'library'  => 'image',
                    'url'      => false,
                    'default'  => [
                        'url'       => JT_THEME_ASSETS . '/img/404-img.png',
                        'thumbnail' => JT_THEME_ASSETS . '/img/404-img.png',
                    ],
                ],
            ],
        ] );
    }

    /**
     * Portfolio Options
     */
    public function portfolio_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Portfolio', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Portfolio', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'portfolio_style',
                    'title'    => esc_html__( 'Design', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Portfolio style', 'jeena-toolkit' ),
                    'type'     => 'select',
                    'default'  => 'normal',
                    'options'  => [
                        'normal'        => esc_html__( 'Normal Style', 'jeena-toolkit' ),
                        'hover-content' => esc_html__( 'Hover Content', 'jeena-toolkit' ),
                    ],
                ],
                [
                    'id'       => 'portfolio_post_per_page',
                    'type'     => 'number',
                    'title'    => esc_html__( 'Post Per Page', 'jeena-toolkit' ),
                    'default'  => 9,
                    'subtitle' => esc_html__( 'Number of posts to show per page', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'archive_content_title',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Content Title', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Archive page section title', 'jeena-toolkit' ),
                    'default'  => esc_html__( 'Let’s Insides About Recent Project Best Work Gallery', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'archive_content_desc',
                    'type'     => 'textarea',
                    'title'    => esc_html__( 'Content', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Archive page section descriptions', 'jeena-toolkit' ),
                    'default'  => esc_html__( 'A portfolio is a collection of investments held by an individual or organization. It can include a variety of assets such as stocks, bonds, real estate, and commodities.', 'jeena-toolkit' ),
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Page Title Area', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'archive_page_title',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Page Title', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Archive Page Title', 'jeena-toolkit' ),
                    'default'  => esc_html__( 'Our Portfolio', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'portfolio_parent_page',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Portfolio Parent Page', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Select a Parent page for portfolio. Default is Portfolio page', 'jeena-toolkit' ),
                    'options'  => [
                        'archive_page' => esc_html__( 'Archive Page', 'jeena-toolkit' ),
                        'custom_page'  => esc_html__( 'Custom Page.', 'jeena-toolkit' ),
                    ],
                    'default'  => 'archive_page',
                ],
                [
                    'id'          => 'portfolio_custom_page',
                    'type'        => 'select',
                    'title'       => esc_html__( 'Select Parent Page', 'jeena-toolkit' ),
                    'subtitle'    => esc_html__( 'Root page fot Portfolio', 'jeena-toolkit' ),
                    'placeholder' => esc_html__( 'Select a page', 'jeena-toolkit' ),
                    'options'     => 'pages',
                    'query_args'  => [
                        'posts_per_page' => -1,
                    ],
                    'dependency'  => [
                        'portfolio_parent_page', '==', 'custom_page',
                    ],
                ],
            ],
        ] );
    }

    /**
     * Shop Section
     */
    public function shop_section() {
        CSF::createSection( $this->options_prefix, [
            'id'     => 'shop_options',
            'title'  => esc_html__( 'Shop', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Shop', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'product_loop_columns',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Columns', 'jeena-toolkit' ),
                    'options' => [
                        '1' => esc_html__( 'One', 'jeena-toolkit' ),
                        '2' => esc_html__( 'Two', 'jeena-toolkit' ),
                        '3' => esc_html__( 'Three', 'jeena-toolkit' ),
                        '4' => esc_html__( 'Four', 'jeena-toolkit' ),
                        '5' => esc_html__( 'Five', 'jeena-toolkit' ),
                        '6' => esc_html__( 'Six', 'jeena-toolkit' ),
                    ],
                    'default' => '4',
                    'desc'    => esc_html__( 'How many column should be shown per row?', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'product_loop_per_page',
                    'type'    => 'number',
                    'title'   => esc_html__( 'Product Per page', 'jeena-toolkit' ),
                    'default' => 12,
                    'desc'    => esc_html__( 'How many products should be shown per page?', 'jeena-toolkit' ),
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Related Product', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'enable_related_product',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Related Product', 'jeena-toolkit' ),
                    'default' => true,
                ],

                [
                    'id'      => 'related_product_columns',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Columns', 'jeena-toolkit' ),
                    'options' => [
                        '1' => esc_html__( 'One', 'jeena-toolkit' ),
                        '2' => esc_html__( 'Two', 'jeena-toolkit' ),
                        '3' => esc_html__( 'Three', 'jeena-toolkit' ),
                        '4' => esc_html__( 'Four', 'jeena-toolkit' ),
                        '5' => esc_html__( 'Five', 'jeena-toolkit' ),
                        '6' => esc_html__( 'Six', 'jeena-toolkit' ),
                    ],
                    'default' => '4',
                    'desc'    => esc_html__( 'How many column should be shown per row?', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'related_product_per_page',
                    'type'    => 'number',
                    'title'   => esc_html__( 'Product Per page', 'jeena-toolkit' ),
                    'default' => 4,
                    'desc'    => esc_html__( 'How many products should be shown per page?', 'jeena-toolkit' ),
                ],
            ],
        ] );
    }

    /**
     * Color Options
     */
    public function color_scheme_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Color Scheme', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Color Scheme', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'primary_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Primary', 'jeena-toolkit' ),
                    'default'  => '#674df3',
                    'subtitle' => esc_html__( 'Your main brand color. Used by most elements throughout the website.', 'jeena-toolkit' ),
                    'desc'     => esc_html__( 'Default: #674df3', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'secondary_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Secondary', 'jeena-toolkit' ),
                    'default'  => '#30f0b6',
                    'subtitle' => esc_html__( 'Your secondary brand color. Used mainly as hover color or by secondary elements.', 'jeena-toolkit' ),
                    'desc'     => esc_html__( 'Default: #30f0b6', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'headline_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Headline', 'jeena-toolkit' ),
                    'default'  => '#1b1f2e',
                    'subtitle' => esc_html__( 'A dark, contrasting color, used by all headlines in your website.', 'jeena-toolkit' ),
                    'desc'     => esc_html__( 'Default: #1b1f2e', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'body_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Body', 'jeena-toolkit' ),
                    'default'  => '#838694',
                    'subtitle' => esc_html__( 'A neutral grey, easy to read color, used by all text elements.', 'jeena-toolkit' ),
                    'desc'     => esc_html__( 'Default: #838694', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'border_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Border', 'jeena-toolkit' ),
                    'default'  => '#e8e8ea',
                    'subtitle' => esc_html__( 'Generally used as common background colors for inputs etc.', 'jeena-toolkit' ),
                    'desc'     => esc_html__( 'Default: #e8e8ea', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'dark_neutral',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Dark Neutral', 'jeena-toolkit' ),
                    'default'  => '#1b1f2b',
                    'subtitle' => esc_html__( 'Generally used as background color for footer, copyright and dark sections.', 'jeena-toolkit' ),
                    'desc'     => esc_html__( 'Default: #1b1f2b', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'light_neutral',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Light Neutral', 'jeena-toolkit' ),
                    'default'  => '#f7f7f9',
                    'subtitle' => esc_html__( 'Generally used as background color for light, alternating sections.', 'jeena-toolkit' ),
                    'desc'     => esc_html__( 'Default: #f7f7f9', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'white_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'White', 'jeena-toolkit' ),
                    'default'  => '#ffffff',
                    'subtitle' => esc_html__( 'Generally used as background for white sections.', 'jeena-toolkit' ),
                    'desc'     => esc_html__( 'Default: #ffffff', 'jeena-toolkit' ),
                ],
            ],
        ] );
    }

    /**
     * Typography Options
     */
    public function typography_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Typography', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Typography', 'jeena-toolkit' ),
                ],
                [
                    'id'                 => 'primary_font',
                    'type'               => 'typography',
                    'title'              => esc_html__( 'Primary Font', 'jeena-toolkit' ),
                    'subtitle'           => esc_html__( 'The main font of your website. The most readable font, used by all text elements.', 'jeena-toolkit' ),
                    'font_weight'        => true,
                    'font_style'         => true,
                    'extra_styles'       => true,
                    'font_size'          => false,
                    'line_height'        => false,
                    'letter_spacing'     => false,
                    'text_align'         => false,
                    'text_transform'     => false,
                    'color'              => false,
                    'backup_font_family' => false,
                    'subset'             => true,
                    'preview'            => false,
                ],
                [
                    'id'                 => 'secondary_font',
                    'type'               => 'typography',
                    'title'              => esc_html__( 'Secondary Font', 'jeena-toolkit' ),
                    'subtitle'           => esc_html__( 'The secondary font of your website. Used by secondary headlines and smaller elements.', 'jeena-toolkit' ),
                    'font_weight'        => true,
                    'font_style'         => true,
                    'extra_styles'       => true,
                    'font_size'          => false,
                    'line_height'        => false,
                    'letter_spacing'     => false,
                    'text_align'         => false,
                    'text_transform'     => false,
                    'color'              => false,
                    'backup_font_family' => false,
                    'subset'             => true,
                    'preview'            => false,
                ],
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'For better performance, it\'s recommended you limit typography to two font families.', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'body_typo_types',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Body Typography', 'jeena-toolkit' ),
                    'options' => [
                        'default-font' => esc_html__( 'Default', 'jeena-toolkit' ),
                        'custom-font'  => esc_html__( 'Custom', 'jeena-toolkit' ),
                    ],
                    'default' => 'default-font',
                ],
                [
                    'id'               => 'body_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Body', 'jeena-toolkit' ),
                    'output'           => 'body',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'body_typo_types', '==', 'custom-font',
                    ],
                ],
                [
                    'id'      => 'heading_typo_type',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Heading Typography', 'jeena-toolkit' ),
                    'options' => [
                        'default-font' => esc_html__( 'Default', 'jeena-toolkit' ),
                        'custom-font'  => esc_html__( 'Custom', 'jeena-toolkit' ),
                    ],
                    'default' => 'default-font',
                ],
                [
                    'id'               => 'heading1_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 1', 'jeena-toolkit' ),
                    'output'           => 'h1',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading2_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 2', 'jeena-toolkit' ),
                    'output'           => 'h2',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading3_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 3', 'jeena-toolkit' ),
                    'output'           => 'h3',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading4_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 4', 'jeena-toolkit' ),
                    'output'           => 'h4',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading5_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 5', 'jeena-toolkit' ),
                    'output'           => 'h5',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading6_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 6', 'jeena-toolkit' ),
                    'output'           => 'h6',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
            ],
        ] );
    }

    /**
     * Custom Script Options
     */
    public function custom_scrips_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Custom Scripts', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Custom Scripts', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'custom_header_scripts',
                    'type'     => 'code_editor',
                    'title'    => esc_html__( 'Js Code(Head)', 'jeena-toolkit' ),
                    'settings' => [
                        'theme' => 'mbo',
                        'mode'  => 'javascript',
                    ],
                    'subtitle' => esc_html__( 'Add your custom js code here. Must Be type without script tag and valid code, It will insert the code to wp_head hook.
                    ', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'custom_footer_scripts',
                    'type'     => 'code_editor',
                    'title'    => esc_html__( 'Js Code(Footer)', 'jeena-toolkit' ),
                    'settings' => [
                        'theme' => 'mbo',
                        'mode'  => 'javascript',
                    ],
                    'subtitle' => esc_html__( 'Add your custom js code here. Must Be type without script tag and valid code, It will insert the code to wp_footer hook.
                    ', 'jeena-toolkit' ),
                ],
                [
                    'type'    => 'submessage',
                    'style'   => 'info',
                    'content' => esc_html__( 'You Can add also custom css in Appearance>Customize>Additional CSS', 'jeena-toolkit' ),
                ],
            ],
        ] );
    }

    /**
     * Backup Options
     */
    public function backup_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Backup', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Backup', 'jeena-toolkit' ),
                ],
                [
                    'type' => 'backup',
                ],
            ],
        ] );
    }

    public function custom_color_palette() {
        $colors = Jeena_Helper::get_global_colors();

        $new_color = [];

        foreach ( $colors as $color ) {
            array_push( $new_color, $color['value'] );
        }

        return $new_color;
    }
}

Jeena_Theme_Options::instance()->initialize();