<?php
namespace JeenaToolkit\TemplateBuilder;

use CSF;

defined( 'ABSPATH' ) || exit;

class Template_Metaboxes {

    protected static $instance = null;
    private $prefix            = 'jeena_template_meta';

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

        $this->init_metaboxes();
    }

    public function init_metaboxes() {
        CSF::createMetabox( $this->prefix, [
            'title'        => esc_html__( 'Template Settings', 'jeena-toolkit' ),
            'post_type'    => 'jeena_template',
            'show_restore' => true,
            'theme'        => 'dark',
            'data_type'    => 'unserialize',
        ] );

        CSF::createSection( $this->prefix, [
            'fields' => [
                [
                    'id'     => 'jeena_tb_settings',
                    'type'   => 'fieldset',
                    'title'  => esc_html__( 'Common Settings', 'jeena-toolkit' ),
                    'fields' => [
                        [
                            'id'          => 'template_type',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Template Type', 'jeena-toolkit' ),
                            'placeholder' => esc_html__( 'Select Type', 'jeena-toolkit' ),
                            'options'     => [
                                'header'    => esc_html__( 'Header', 'jeena-toolkit' ),
                                'footer'    => esc_html__( 'Footer', 'jeena-toolkit' ),
                                'block'     => esc_html__( 'Block', 'jeena-toolkit' ),
                                'popup'     => esc_html__( 'Popup', 'jeena-toolkit' ),
                                'offcanvas' => esc_html__( 'OffCanvas', 'jeena-toolkit' ),
                            ],
                            'default'     => 'block',
                        ],
                        [
                            'id'         => 'popup_width',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Width', 'jeena-toolkit' ),
                            'subtitle'   => esc_html__( 'Select or type a value (PX)', 'jeena-toolkit' ),
                            'options'    => [
                                'full'   => esc_html__( 'Full', 'jeena-toolkit' ),
                                'custom' => esc_html__( 'Custom', 'jeena-toolkit' ),
                            ],
                            'default'    => 'custom',
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'set_popup_width',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Popup Width', 'jeena-toolkit' ),
                            'default'    => [
                                'width' => '820',
                            ],
                            'height'     => false,
                            'units'      => ['px'],
                            'show_units' => false,
                            'dependency' => ['template_type|popup_width', '==|==', 'popup|custom'],
                        ],
                        [
                            'id'         => 'popup_height',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Height', 'jeena-toolkit' ),
                            'subtitle'   => esc_html__( 'Set the popup max height.', 'jeena-toolkit' ),
                            'options'    => [
                                'fit_content' => esc_html__( 'Fit Content', 'jeena-toolkit' ),
                                'full'        => esc_html__( 'Full', 'jeena-toolkit' ),
                                'custom'      => esc_html__( 'Custom', 'jeena-toolkit' ),
                            ],
                            'default'    => 'fit_content',
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'set_popup_height',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Height', 'jeena-toolkit' ),
                            'default'    => [
                                'height' => '520',
                            ],
                            'width'      => false,
                            'units'      => ['px'],
                            'show_units' => false,
                            'dependency' => ['template_type|popup_height', '==|==', 'popup|custom'],
                        ],
                        [
                            'id'         => 'popup_position',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Position', 'jeena-toolkit' ),
                            'subtitle'   => esc_html__( 'Choose the popup position on page.', 'jeena-toolkit' ),
                            'options'    => [
                                'center-center' => esc_html__( 'Center Center', 'jeena-toolkit' ),
                                'center-left'   => esc_html__( 'Center Left', 'jeena-toolkit' ),
                                'center-right'  => esc_html__( 'Center Right', 'jeena-toolkit' ),
                                'bottom-center' => esc_html__( 'Bottom Center', 'jeena-toolkit' ),
                                'top-center'    => esc_html__( 'Top Center', 'jeena-toolkit' ),
                                'bottom-left'   => esc_html__( 'Bottom Left', 'jeena-toolkit' ),
                                'top-left'      => esc_html__( 'Top Left', 'jeena-toolkit' ),
                                'bottom-right'  => esc_html__( 'Bottom Right', 'jeena-toolkit' ),
                                'top-right'     => esc_html__( 'Top Right', 'jeena-toolkit' ),
                            ],
                            'default'    => 'center-center',
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'popup_overly_color',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Overly Color', 'jeena-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => 'rgba(0, 0, 0, 0.5)',
                        ],
                        [
                            'id'         => 'popup_close_color',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Close Color', 'jeena-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => '#fb2614',
                        ],
                        [
                            'id'         => 'popup_close_bg',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Close Color', 'jeena-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => '#ffffff',
                        ],
                        [
                            'id'         => 'popup_close_size',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Popup Close Size', 'jeena-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'units'      => ['px'],
                            'default'    => [
                                'width'  => '40',
                                'height' => '40',
                            ],
                            'show_units' => false,
                        ],
                        [
                            'id'         => 'popup_close_radius',
                            'type'       => 'number',
                            'title'      => esc_html__( 'Popup Close Radius', 'jeena-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'popup_delay',
                            'type'       => 'number',
                            'title'      => esc_html__( 'Popup Delay', 'jeena-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => 3,
                            'subtitle'   => esc_html__( 'Show when page is loaded (Second).', 'jeena-toolkit' ),
                        ],
                        [
                            'id'         => 'offcanvas_width',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Width', 'jeena-toolkit' ),
                            'height'     => false,
                            'units'      => ['px'],
                            'default'    => [
                                'width' => '420',
                            ],
                            'show_units' => false,
                            'dependency' => ['template_type', '==', 'offcanvas'],
                        ],
                    ],
                ],
                [
                    'id'           => 'jeena_tb_include',
                    'type'         => 'repeater',
                    'title'        => esc_html__( 'Display On', 'jeena-toolkit' ),
                    'subtitle'     => esc_html__( 'Select the locations where this item should be visible.', 'jeena-toolkit' ),
                    'button_title' => esc_html__( 'Add Display Rule', 'jeena-toolkit' ),
                    'dependency'   => ['template_type', 'any', 'header,footer,popup'],
                    'fields'       => [
                        [
                            'type'    => 'subheading',
                            'content' => esc_html__( 'Define Rule', 'jeena-toolkit' ),
                        ],
                        [
                            'id'      => 'rule',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Display on', 'jeena-toolkit' ),
                            'options' => [
                                'entire_website'     => esc_html__( 'Entire Website', 'jeena-toolkit' ),
                                'all_pages'          => esc_html__( 'All Pages', 'jeena-toolkit' ),
                                'front_page'         => esc_html__( 'Front Page', 'jeena-toolkit' ),
                                'post_page'          => esc_html__( 'Post Page', 'jeena-toolkit' ),
                                'post_details'       => esc_html__( 'Post Details', 'jeena-toolkit' ),
                                'all_archive'        => esc_html__( 'All Archive', 'jeena-toolkit' ),
                                'date_archive'       => esc_html__( 'Date Archive', 'jeena-toolkit' ),
                                'author_archive'     => esc_html__( 'Author Archive', 'jeena-toolkit' ),
                                'search_page'        => esc_html__( 'Search Page', 'jeena-toolkit' ),
                                '404_page'           => esc_html__( '404 Page', 'jeena-toolkit' ),
                                'specific_pages'     => esc_html__( 'Specific Pages', 'jeena-toolkit' ),
                                'specific_posts'     => esc_html__( 'Specific Posts', 'jeena-toolkit' ),
                                'shop_page'          => esc_html__( 'Shop Page', 'jeena-toolkit' ),
                                'product_details'    => esc_html__( 'Product Details', 'jeena-toolkit' ),
                                'specific_products'  => esc_html__( 'Specific Products', 'jeena-toolkit' ),
                                'portfolio_details'  => esc_html__( 'Portfolio Details', 'jeena-toolkit' ),
                                'specific_portfolio' => esc_html__( 'Specific Portfolio', 'jeena-toolkit' ),
                            ],
                        ],
                        [
                            'id'          => 'page_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Pages', 'jeena-toolkit' ),
                            'placeholder' => esc_html__( 'Select Pages', 'jeena-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'pages',
                            'dependency'  => ['rule', '==', 'specific_pages'],
                        ],
                        [
                            'id'          => 'posts_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Posts', 'jeena-toolkit' ),
                            'placeholder' => esc_html__( 'Select Posts', 'jeena-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'posts',
                            'dependency'  => ['rule', '==', 'specific_posts'],
                        ],
                        [
                            'id'          => 'product_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Products', 'jeena-toolkit' ),
                            'placeholder' => esc_html__( 'Select Products', 'jeena-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'post',
                            'query_args'  => [
                                'post_type' => 'product',
                            ],
                            'dependency'  => ['rule', '==', 'specific_products'],
                        ],
                        [
                            'id'          => 'portfolio_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Portfolio', 'jeena-toolkit' ),
                            'placeholder' => esc_html__( 'Select Portfolio', 'jeena-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'post',
                            'query_args'  => [
                                'post_type' => 'jeena_portfolio',
                            ],
                            'dependency'  => ['rule', '==', 'specific_portfolio'],
                        ],
                    ],
                ],
                [
                    'id'           => 'jeena_tb_exclude',
                    'type'         => 'repeater',
                    'title'        => esc_html__( 'Hide On', 'jeena-toolkit' ),
                    'subtitle'     => esc_html__( 'Select the locations where this item should be visible.', 'jeena-toolkit' ),
                    'button_title' => esc_html__( 'Add Hide Rule', 'jeena-toolkit' ),
                    'dependency'   => ['template_type', 'any', 'header,footer,popup'],
                    'fields'       => [
                        [
                            'type'    => 'subheading',
                            'content' => esc_html__( 'Hide Rule', 'jeena-toolkit' ),
                        ],
                        [
                            'id'      => 'rule',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Hide on', 'jeena-toolkit' ),
                            'options' => [
                                'entire_website'     => esc_html__( 'Entire Website', 'jeena-toolkit' ),
                                'all_pages'          => esc_html__( 'All Pages', 'jeena-toolkit' ),
                                'front_page'         => esc_html__( 'Front Page', 'jeena-toolkit' ),
                                'post_page'          => esc_html__( 'Post Page', 'jeena-toolkit' ),
                                'post_details'       => esc_html__( 'Post Details', 'jeena-toolkit' ),
                                'all_archive'        => esc_html__( 'All Archive', 'jeena-toolkit' ),
                                'date_archive'       => esc_html__( 'Date Archive', 'jeena-toolkit' ),
                                'author_archive'     => esc_html__( 'Author Archive', 'jeena-toolkit' ),
                                'search_page'        => esc_html__( 'Search Page', 'jeena-toolkit' ),
                                '404_page'           => esc_html__( '404 Page', 'jeena-toolkit' ),
                                'specific_pages'     => esc_html__( 'Specific Pages', 'jeena-toolkit' ),
                                'specific_posts'     => esc_html__( 'Specific Posts', 'jeena-toolkit' ),
                                'shop_page'          => esc_html__( 'Shop Page', 'jeena-toolkit' ),
                                'product_details'    => esc_html__( 'Product Details', 'jeena-toolkit' ),
                                'specific_products'  => esc_html__( 'Specific Products', 'jeena-toolkit' ),
                                'portfolio_details'  => esc_html__( 'Portfolio Details', 'jeena-toolkit' ),
                                'specific_portfolio' => esc_html__( 'Specific Portfolio', 'jeena-toolkit' ),
                            ],
                        ],
                        [
                            'id'          => 'page_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Pages', 'jeena-toolkit' ),
                            'placeholder' => esc_html__( 'Select Pages', 'jeena-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'pages',
                            'dependency'  => ['rule', '==', 'specific_pages'],
                        ],
                        [
                            'id'          => 'posts_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Posts', 'jeena-toolkit' ),
                            'placeholder' => esc_html__( 'Select Posts', 'jeena-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'posts',
                            'dependency'  => ['rule', '==', 'specific_posts'],
                        ],
                        [
                            'id'          => 'product_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Products', 'jeena-toolkit' ),
                            'placeholder' => esc_html__( 'Select Products', 'jeena-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'post',
                            'query_args'  => [
                                'post_type' => 'product',
                            ],
                            'dependency'  => ['rule', '==', 'specific_products'],
                        ],
                        [
                            'id'          => 'portfolio_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Portfolio', 'jeena-toolkit' ),
                            'placeholder' => esc_html__( 'Select Portfolio', 'jeena-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'post',
                            'query_args'  => [
                                'post_type' => 'jeena_portfolio',
                            ],
                            'dependency'  => ['rule', '==', 'specific_portfolio'],
                        ],
                    ],
                ],
            ],
        ] );
    }
}

Template_Metaboxes::instance()->initialize();