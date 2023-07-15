<?php
namespace JeenaToolkit\Helper;

use CSF;

defined( 'ABSPATH' ) || exit;

/**
 * Jeena Toolkit Helper
 */
class Jeena_Metaboxes {
    protected static $instance = null;

    private $post_prefix      = 'jeena_post_meta';
    private $page_prefix      = 'jeena_page_meta';
    private $user_prefix      = 'jeena_user_meta';
    private $portfolio_prefix = 'jeena_portfolio_meta';
    private $product_prefix   = 'jeena_product_meta';

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

        $this->post_metaboxes();
        $this->page_metaboxes();
        $this->portfolio_metaboxes();
        $this->user_metaboxes();
        $this->product_metaboxes();
    }

    /**
     * Post Meta
     *
     * @return void
     */
    public function post_metaboxes() {
        CSF::createMetabox( $this->post_prefix, [
            'title'        => esc_html__( 'Jeena Post Options', 'jeena-toolkit' ),
            'post_type'    => 'post',
            'show_restore' => true,
        ] );

        // Page Layout
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'Layout', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Post Layout', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'post_details_layout',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Layout', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Set the post layout.', 'jeena-toolkit' ),
                    'options'  => [
                        'default'    => esc_html__( 'Theme Default', 'jeena-toolkit' ),
                        'full-width' => esc_html__( 'Full Width', 'jeena-toolkit' ),
                        'boxed'      => esc_html__( 'Boxed', 'jeena-toolkit' ),
                    ],
                    'default'  => 'default',
                ],
                [
                    'id'       => 'blog_details_sidebar',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Sidebar', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Select Blog Archive Sidebar. Left sidebar or right sidebar or No sidebar', 'jeena-toolkit' ),
                    'options'  => [
                        'default'       => esc_html__( 'Theme Default', 'jeena-toolkit' ),
                        'left-sidebar'  => esc_html( 'Left Sidebar', 'jeena-toolkit' ),
                        'right-sidebar' => esc_html( 'Right Sidebar', 'jeena-toolkit' ),
                        'no-sidebar'    => esc_html( 'No Sidebar', 'jeena-toolkit' ),
                    ],
                    'default'  => 'right-sidebar',
                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__( 'Content Spacing', 'jeena-toolkit' ),
                    'show_units' => false,
                    'left'       => false,
                    'right'      => false,
                    'desc'       => esc_html__( 'Default top: 125px, bottom: 125px', 'jeena-toolkit' ),
                    'output'     => '.container-gap',
                ],
            ],
        ] );

        // Header
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'Header', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for post header then disable default header', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'post_default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Header', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post default header. Default comes form theme option', 'jeena-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default header. Set your post header form ', 'jeena-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'jeena-toolkit' ) . '</a>',
                    'dependency' => [
                        'post_default_header', '==', 'disabled',
                    ],
                ],
                [
                    'id'      => 'post_transparent_header',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Transparent Header', 'jeena-toolkit' ),
                    'desc'    => esc_html__( 'Set header to transparent background before scroll.', 'jeena-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default' => 'default',
                ],
            ],
        ] );

        // Page Title
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'Page Title', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'post_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Page Title', 'jeena-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'post_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Title Type', 'jeena-toolkit' ),
                    'options'    => [
                        'default' => esc_html__( 'Default', 'jeena-toolkit' ),
                        'custom'  => esc_html__( 'Custom', 'jeena-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['post_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'post_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Title', 'jeena-toolkit' ),
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['post_title_type', '==', 'custom'],
                    ],
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Customize Style', 'jeena-toolkit' ),
                    'options'    => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'    => 'no',
                    'dependency' => ['post_page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'jeena-toolkit' ),
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_bg',
                    'type'       => 'background',
                    'title'      => esc_html__( 'Background', 'jeena-toolkit' ),
                    'output'     => '.page-title-wrapper',
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'post_title_overly_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Overly Color', 'jeena-toolkit' ),
                    'output'      => '.page-title-wrapper::before',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'               => 'page_title_typo',
                    'type'             => 'typography',
                    'title'            => esc_html( 'Typography', 'jeena-toolkit' ),
                    'output'           => '.page-title-wrapper .page-title',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'               => 'page_breadcrumb_typo',
                    'type'             => 'typography',
                    'title'            => esc_html( 'Breadcrumb Typography', 'jeena-toolkit' ),
                    'output'           => '.page-title-wrapper .breadcrumb, .page-title-wrapper .breadcrumb a',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ] );

        // Footer
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'Footer', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for post footer then disable default footer', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'post_default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Footer', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post default footer. Default comes form theme option', 'jeena-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default footer. Set your post footer form ', 'jeena-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'jeena-toolkit' ) . '</a>',
                    'dependency' => [
                        'post_default_footer', '==', 'disabled',
                    ],
                ],
            ],
        ] );
    }

    /**
     * Page Meta
     *
     * @return void
     */
    public function page_metaboxes() {
        CSF::createMetabox( $this->page_prefix, [
            'title'        => esc_html__( 'Jeena Page Options', 'jeena-toolkit' ),
            'post_type'    => 'page',
            'show_restore' => true,
        ] );

        // Page Layout
        CSF::createSection( $this->page_prefix, [
            'title'  => esc_html__( 'Layout', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Layout', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'site_layout',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Layout', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Set the page layout.', 'jeena-toolkit' ),
                    'options'  => [
                        'default'    => esc_html__( 'Theme Default', 'jeena-toolkit' ),
                        'full-width' => esc_html__( 'Full Width', 'jeena-toolkit' ),
                        'boxed'      => esc_html__( 'Boxed', 'jeena-toolkit' ),
                    ],
                    'default'  => 'default',
                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__( 'Content Spacing', 'jeena-toolkit' ),
                    'show_units' => false,
                    'left'       => false,
                    'right'      => false,
                    'desc'       => esc_html__( 'Default top: 125px, bottom: 125px', 'jeena-toolkit' ),
                    'output'     => '.container-gap',
                ],
            ],
        ] );

        // Header
        CSF::createSection( $this->page_prefix, [
            'title'  => esc_html__( 'Header', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for page header then disable default header', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'page_default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Header', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable page default header. Default comes form theme option', 'jeena-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'  => 'default',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default header. Set your page header form ', 'jeena-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'jeena-toolkit' ) . '</a>',
                    'dependency' => [
                        'page_default_header', '==', 'disabled',
                    ],
                ],
                [
                    'id'      => 'page_transparent_header',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Transparent Header', 'jeena-toolkit' ),
                    'desc'    => esc_html__( 'Set header to transparent background before scroll.', 'jeena-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default' => 'default',
                ],
            ],
        ] );

        // Page Title
        CSF::createSection( $this->page_prefix, [
            'title'  => esc_html__( 'Page Title', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Page Title', 'jeena-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'page_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Title Type', 'jeena-toolkit' ),
                    'options'    => [
                        'default' => esc_html__( 'Default', 'jeena-toolkit' ),
                        'custom'  => esc_html__( 'Custom', 'jeena-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'page_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Title', 'jeena-toolkit' ),
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['page_title_type', '==', 'custom'],
                    ],
                ],
                [
                    'id'         => 'page_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Breadcrumb', 'jeena-toolkit' ),
                    'options'    => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Customize Style', 'jeena-toolkit' ),
                    'options'    => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'    => 'no',
                    'dependency' => ['page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'jeena-toolkit' ),
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_bg',
                    'type'       => 'background',
                    'title'      => esc_html__( 'Background', 'jeena-toolkit' ),
                    'output'     => '.page-title-wrapper',
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_overly_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Overly Color', 'jeena-toolkit' ),
                    'output'      => '.page-title-wrapper::before',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'               => 'page_title_typo',
                    'type'             => 'typography',
                    'title'            => esc_html( 'Typography', 'jeena-toolkit' ),
                    'output'           => '.page-title-wrapper .page-title',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'               => 'page_breadcrumb_typo',
                    'type'             => 'typography',
                    'title'            => esc_html( 'Breadcrumb Typography', 'jeena-toolkit' ),
                    'output'           => '.page-title-wrapper .breadcrumb, .page-title-wrapper .breadcrumb a',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ] );

        // Footer
        CSF::createSection( $this->page_prefix, [
            'title'  => esc_html__( 'Footer', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for page footer then disable default footer', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'page_default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Footer', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable page default footer. Default comes form theme option', 'jeena-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'  => 'default',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default footer. Set your page footer form ', 'jeena-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'jeena-toolkit' ) . '</a>',
                    'dependency' => [
                        'page_default_footer', '==', 'disabled',
                    ],
                ],
            ],
        ] );
    }

    /**
     * Portfolio Meta
     *
     * @return void
     */
    public function portfolio_metaboxes() {
        CSF::createMetabox( $this->portfolio_prefix, [
            'title'        => esc_html__( 'Jeena Portfolio Options', 'jeena-toolkit' ),
            'post_type'    => 'jeena_portfolio',
            'show_restore' => true,
        ] );

        // Layout
        CSF::createSection( $this->portfolio_prefix, [
            'title'  => esc_html__( 'Layout', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Post Layout', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'portfolio_details_layout',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Layout', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Set the post layout.', 'jeena-toolkit' ),
                    'options'  => [
                        'default'    => esc_html__( 'Theme Default', 'jeena-toolkit' ),
                        'full-width' => esc_html__( 'Full Width', 'jeena-toolkit' ),
                        'boxed'      => esc_html__( 'Boxed', 'jeena-toolkit' ),
                    ],
                    'default'  => 'default',
                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__( 'Content Spacing', 'jeena-toolkit' ),
                    'show_units' => false,
                    'left'       => false,
                    'right'      => false,
                    'desc'       => esc_html__( 'Default top: 125px, bottom: 125px', 'jeena-toolkit' ),
                    'output'     => '.container-gap',
                ],
            ],
        ] );

        // Header
        CSF::createSection( $this->portfolio_prefix, [
            'title'  => esc_html__( 'Header', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for post header then disable default header', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'portfolio_default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Header', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post default header. Default comes form theme option', 'jeena-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default header. Set your post header form ', 'jeena-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'jeena-toolkit' ) . '</a>',
                    'dependency' => [
                        'portfolio_default_header', '==', 'disabled',
                    ],
                ],
                [
                    'id'      => 'portfolio_transparent_header',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Transparent Header', 'jeena-toolkit' ),
                    'desc'    => esc_html__( 'Set header to transparent background before scroll.', 'jeena-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default' => 'default',
                ],
            ],
        ] );

        // Page Title
        CSF::createSection( $this->portfolio_prefix, [
            'title'  => esc_html__( 'Page Title', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'portfolio_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Page Title', 'jeena-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'portfolio_page_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Title Type', 'jeena-toolkit' ),
                    'options'    => [
                        'default' => esc_html__( 'Default', 'jeena-toolkit' ),
                        'custom'  => esc_html__( 'Custom', 'jeena-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['portfolio_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'portfolio_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Title', 'jeena-toolkit' ),
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['portfolio_page_title_type', '==', 'custom'],
                    ],
                ],
                [
                    'id'         => 'portfolio_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Breadcrumb', 'jeena-toolkit' ),
                    'options'    => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['portfolio_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Customize Style', 'jeena-toolkit' ),
                    'options'    => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'    => 'no',
                    'dependency' => ['portfolio_page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'jeena-toolkit' ),
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_bg',
                    'type'       => 'background',
                    'title'      => esc_html__( 'Background', 'jeena-toolkit' ),
                    'output'     => '.page-title-wrapper',
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'post_title_overly_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Overly Color', 'jeena-toolkit' ),
                    'output'      => '.page-title-wrapper::before',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'               => 'page_title_typo',
                    'type'             => 'typography',
                    'title'            => esc_html( 'Typography', 'jeena-toolkit' ),
                    'output'           => '.page-title-wrapper .page-title',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'               => 'page_breadcrumb_typo',
                    'type'             => 'typography',
                    'title'            => esc_html( 'Breadcrumb Typography', 'jeena-toolkit' ),
                    'output'           => '.page-title-wrapper .breadcrumb, .page-title-wrapper .breadcrumb a',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ] );

        // Footer
        CSF::createSection( $this->portfolio_prefix, [
            'title'  => esc_html__( 'Footer', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for post footer then disable default footer', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'portfolio_default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Footer', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post default footer. Default comes form theme option', 'jeena-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default footer. Set your post footer form ', 'jeena-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'jeena-toolkit' ) . '</a>',
                    'dependency' => [
                        'portfolio_default_footer', '==', 'disabled',
                    ],
                ],
            ],
        ] );
    }

    /**
     * User Meta
     *
     * @return void
     */
    public function user_metaboxes() {
        CSF::createProfileOptions( $this->user_prefix, [
            'data_type' => 'serialize',
        ] );

        CSF::createSection( $this->user_prefix, [
            'fields' => [
                [
                    'title' => esc_html__( 'Jeena Author Options', 'jeena-toolkit' ),
                    'type'  => 'heading',
                ],
                [
                    'id'           => 'user_social_links',
                    'type'         => 'repeater',
                    'title'        => esc_html__( 'User Social Links', 'jeena-toolkit' ),
                    'button_title' => esc_html__( 'Add New', 'jeena-toolkit' ),
                    'fields'       => [
                        [
                            'id'    => 'social_icon',
                            'type'  => 'icon',
                            'title' => esc_html__( 'Icon', 'jeena-toolkit' ),
                        ],
                        [
                            'id'    => 'social_link',
                            'type'  => 'text',
                            'title' => esc_html__( 'Link', 'jeena-toolkit' ),
                        ],
                    ],
                ],
            ],
        ] );
    }

    /**
     * Product Metaboxes
     */
    public function product_metaboxes() {
        CSF::createMetabox( $this->product_prefix, [
            'title'        => esc_html__( 'Jeena Product Options', 'jeena-toolkit' ),
            'post_type'    => 'product',
            'show_restore' => true,
        ] );

        // Layout
        CSF::createSection( $this->product_prefix, [
            'title'  => esc_html__( 'Layout', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Post Layout', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'product_details_layout',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Layout', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Set the post layout.', 'jeena-toolkit' ),
                    'options'  => [
                        'default'    => esc_html__( 'Theme Default', 'jeena-toolkit' ),
                        'full-width' => esc_html__( 'Full Width', 'jeena-toolkit' ),
                        'boxed'      => esc_html__( 'Boxed', 'jeena-toolkit' ),
                    ],
                    'default'  => 'default',
                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__( 'Content Spacing', 'jeena-toolkit' ),
                    'show_units' => false,
                    'left'       => false,
                    'right'      => false,
                    'desc'       => esc_html__( 'Default top: 125px, bottom: 125px', 'jeena-toolkit' ),
                    'output'     => '.container-gap',
                ],
            ],
        ] );

        // Header
        CSF::createSection( $this->product_prefix, [
            'title'  => esc_html__( 'Header', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for post header then disable default header', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'product_default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Header', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post default header. Default comes form theme option', 'jeena-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default header. Set your post header form ', 'jeena-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'jeena-toolkit' ) . '</a>',
                    'dependency' => [
                        'product_default_header', '==', 'disabled',
                    ],
                ],
                [
                    'id'      => 'product_transparent_header',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Transparent Header', 'jeena-toolkit' ),
                    'desc'    => esc_html__( 'Set header to transparent background before scroll.', 'jeena-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default' => 'default',
                ],
            ],
        ] );

        // Page Title
        CSF::createSection( $this->product_prefix, [
            'title'  => esc_html__( 'Page Title', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'jeena-toolkit' ),
                ],
                [
                    'id'      => 'product_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Page Title', 'jeena-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'product_page_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Title Type', 'jeena-toolkit' ),
                    'options'    => [
                        'default' => esc_html__( 'Default', 'jeena-toolkit' ),
                        'custom'  => esc_html__( 'Custom', 'jeena-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['product_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'product_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Title', 'jeena-toolkit' ),
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['product_page_title_type', '==', 'custom'],
                    ],
                    'default'    => esc_html__( 'Product Details', 'jeena-toolkit' ),
                ],
                [
                    'id'         => 'product_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Product Breadcrumb', 'jeena-toolkit' ),
                    'options'    => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['product_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_product_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Customize Style', 'jeena-toolkit' ),
                    'options'    => [
                        'yes' => esc_html__( 'Yes', 'jeena-toolkit' ),
                        'no'  => esc_html__( 'No', 'jeena-toolkit' ),
                    ],
                    'default'    => 'no',
                    'dependency' => ['product_page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'jeena-toolkit' ),
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_product_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'product_title_padding',
                    'type'        => 'spacing',
                    'title'       => esc_html__( 'Padding', 'jeena-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'padding',
                    'dependency'  => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_product_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'product_title_border',
                    'type'       => 'border',
                    'title'      => esc_html__( 'Border', 'jeena-toolkit' ),
                    'output'     => '.page-title-area',
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_product_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'product_title_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background Color', 'jeena-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_product_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'product_title_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Typography', 'jeena-toolkit' ),
                    'output'     => '.page-title-area .page-title',
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'product_breadcrumb_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Breadcrumb Typography', 'jeena-toolkit' ),
                    'output'     => '.page-title-area .breadcrumb, .page-title-area .breadcrumb a',
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ] );

        // Footer
        CSF::createSection( $this->product_prefix, [
            'title'  => esc_html__( 'Footer', 'jeena-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for post footer then disable default footer', 'jeena-toolkit' ),
                ],
                [
                    'id'       => 'product_default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Footer', 'jeena-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post default footer. Default comes form theme option', 'jeena-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'jeena-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'jeena-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'jeena-toolkit' ),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default footer. Set your post footer form ', 'jeena-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'jeena-toolkit' ) . '</a>',
                    'dependency' => [
                        'product_default_footer', '==', 'disabled',
                    ],
                ],
            ],
        ] );
    }
}

Jeena_Metaboxes::instance()->initialize();