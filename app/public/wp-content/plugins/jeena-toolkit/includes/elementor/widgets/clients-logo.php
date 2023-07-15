<?php
namespace jeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Clients_Logo extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jeena-clients-logo';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Client\'s Logo', 'jeena-toolkit' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-carousel webtend-logo';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['jeena_elements'];
    }

    /**
     * Retrieve the list of Scripts the widget depended on.
     *
     * Used to set Scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget Scripts dependencies.
     */
    public function get_script_depends() {
        return ['slick'];
    }

    /**
     * Retrieve the list of Style the widget depended on.
     *
     * Used to set style dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget style dependencies.
     */
    public function get_style_depends() {
        return ['slick'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['jeena', 'toolkit', 'logo', 'carousel', 'brand', ' client', 'slider'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'section_logo_carousel',
            [
                'label' => esc_html__( 'Client\'s Logo', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => esc_html__( 'Layout', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid'   => esc_html__( 'Grid', 'jeena-toolkit' ),
                    'slider' => esc_html__( 'Slider', 'jeena-toolkit' ),
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'logo',
            [
                'type'    => Controls_Manager::MEDIA,
                'label'   => esc_html__( 'Image', 'jeena-toolkit' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'url',
            [
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'label'       => esc_html__( 'URL', 'jeena-toolkit' ),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'clients_logo',
            [
                'label'   => esc_html__( 'Items', 'jeena-toolkit' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'logo' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'url'  => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'logo' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'url'  => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'logo' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'url'  => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'logo' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'url'  => [
                            'url' => '#',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'                => esc_html__( 'Grid Column', 'jeena-toolkit' ),
                'type'                 => Controls_Manager::SELECT,
                'options'              => [
                    ''  => esc_html__( 'Default', 'jeena-toolkit' ),
                    '1' => esc_html__( '1 column', 'jeena-toolkit' ),
                    '2' => esc_html__( '2 column', 'jeena-toolkit' ),
                    '3' => esc_html__( '3 column', 'jeena-toolkit' ),
                    '4' => esc_html__( '4 column', 'jeena-toolkit' ),
                    '5' => esc_html__( '5 column', 'jeena-toolkit' ),
                    '6' => esc_html__( '6 column', 'jeena-toolkit' ),
                ],
                'default'              => '',
                'tablet_extra_default' => '',
                'tablet_default'       => '',
                'mobile_default'       => '',
                'condition'            => [
                    'layout' => 'grid',
                ],
                'selectors'            => [
                    '{{WRAPPER}} .jeena-clients-logo' => 'grid-template-columns: repeat( {{VALUE}}, 1fr );',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_additional_options',
            [
                'label'     => esc_html__( 'Carousel Options', 'jeena-toolkit' ),
                'condition' => [
                    'layout' => 'slider',
                ],
            ]
        );

        $slides_per_view = range( 1, 5 );
        $slides_per_view = array_combine( $slides_per_view, $slides_per_view );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'type'                 => Controls_Manager::SELECT,
                'label'                => esc_html__( 'Slides Per View', 'jeena-toolkit' ),
                'options'              => $slides_per_view,
                'widescreen_default'   => 4,
                'default'              => 4,
                'laptop_default'       => 4,
                'tablet_extra_default' => 3,
                'tablet_default'       => 2,
                'mobile_extra_default' => 2,
                'mobile_default'       => 2,
                'frontend_available'   => true,
            ]
        );

        $this->add_responsive_control(
            'slides_to_scroll',
            [
                'type'                 => Controls_Manager::SELECT,
                'label'                => esc_html__( 'Slides to Scroll', 'jeena-toolkit' ),
                'description'          => esc_html__( 'Set how many slides are scrolled per swipe.', 'jeena-toolkit' ),
                'options'              => $slides_per_view,
                'widescreen_default'   => 1,
                'default'              => 1,
                'laptop_default'       => 1,
                'tablet_extra_default' => 1,
                'tablet_default'       => 1,
                'mobile_extra_default' => 1,
                'mobile_default'       => 1,
                'frontend_available'   => true,
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'type'               => Controls_Manager::SWITCHER,
                'label'              => esc_html__( 'Arrows?', 'jeena-toolkit' ),
                'default'            => '',
                'label_off'          => esc_html__( 'Hide', 'jeena-toolkit' ),
                'label_on'           => esc_html__( 'Show', 'jeena-toolkit' ),
                'frontend_available' => true,
                'separator'          => 'before',
            ]
        );

        $this->add_control(
            'arrow_prev',
            [
                'label'       => esc_html__( 'Previous Icon', 'jeena-toolkit' ),
                'label_block' => false,
                'type'        => Controls_Manager::ICONS,
                'skin'        => 'inline',
                'default'     => [
                    'value'   => 'fas fa-angle-left',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_next',
            [
                'label'       => esc_html__( 'Next Icon', 'jeena-toolkit' ),
                'label_block' => false,
                'type'        => Controls_Manager::ICONS,
                'skin'        => 'inline',
                'default'     => [
                    'value'   => 'fas fa-angle-right',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'type'               => Controls_Manager::SWITCHER,
                'label'              => esc_html__( 'Dots?', 'jeena-toolkit' ),
                'default'            => '',
                'label_off'          => esc_html__( 'Hide', 'jeena-toolkit' ),
                'label_on'           => esc_html__( 'Show', 'jeena-toolkit' ),
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'speed',
            [
                'label'              => esc_html__( 'Animation Speed', 'jeena-toolkit' ),
                'type'               => Controls_Manager::NUMBER,
                'default'            => 500,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'              => esc_html__( 'Autoplay?', 'jeena-toolkit' ),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'              => esc_html__( 'Autoplay Speed', 'jeena-toolkit' ),
                'type'               => Controls_Manager::NUMBER,
                'default'            => 5000,
                'condition'          => [
                    'autoplay' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'              => esc_html__( 'Infinite Loop?', 'jeena-toolkit' ),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'              => esc_html__( 'Pause on Hover?', 'jeena-toolkit' ),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => '',
                'condition'          => [
                    'autoplay' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'center_mode',
            [
                'label'              => esc_html__( 'Center Mode?', 'jeena-toolkit' ),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => '',
                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            'center_padding',
            [
                'label'                => esc_html__( 'Center Padding', 'jeena-toolkit' ),
                'type'                 => Controls_Manager::SLIDER,
                'size_units'           => ['px', '%'],
                'range'                => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'              => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'widescreen_default'   => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'laptop_default'       => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'tablet_extra_default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'tablet_default'       => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'mobile_extra_default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'mobile_default'       => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'condition'            => [
                    'center_mode' => 'yes',
                ],
                'frontend_available'   => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_item_style-section',
            [
                'label' => esc_html__( 'Logo Wrap', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label'      => esc_html__( 'Column Gap', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-clients-logo' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label'      => esc_html__( 'Row Gap', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-clients-logo' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_carousel_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_carousel_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'box_item_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-clients-logo .logo-wrap',
            ]
        );

        $this->add_control(
            'box_item_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'carousel_item_tab' );

        $this->start_controls_tab( 'carousel_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'elementor' ),
            ]
        );

        $this->add_control(
            'logo_carousel_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_item_shadow',
                'selector' => '{{WRAPPER}} .jeena-clients-logo .logo-wrap',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'carousel_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'elementor' ),
            ]
        );

        $this->add_control(
            'logo_hover_carousel_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'logo_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_item_hover_shadow',
                'selector' => '{{WRAPPER}} .jeena-clients-logo .logo-wrap:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs( 'carousel_item_tab' );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_style_section',
            [
                'label' => esc_html__( 'Logo Image', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'img_width',
            [
                'label'      => esc_html__( 'Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'vw'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_max_width',
            [
                'label'      => esc_html__( 'Max Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'vw'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_height',
            [
                'label'      => esc_html__( 'Height', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_img_fit',
            [
                'label'     => esc_html__( 'Object Fit', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''        => esc_html__( 'Default', 'jeena-toolkit' ),
                    'fill'    => esc_html__( 'Fill', 'jeena-toolkit' ),
                    'cover'   => esc_html__( 'Cover', 'jeena-toolkit' ),
                    'contain' => esc_html__( 'Contain', 'jeena-toolkit' ),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'img_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-clients-logo .logo-wrap img',
            ]
        );

        $this->add_control(
            'img_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'img_item_tab' );

        $this->start_controls_tab( 'img_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'elementor' ),
            ]
        );

        $this->add_control(
            'img_opacity',
            [
                'label'     => esc_html__( 'Opacity', 'elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'img_shadow',
                'selector' => '{{WRAPPER}} .jeena-clients-logo .logo-wrap img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'img_hover_tab',
            [
                'label' => esc_html__( 'Normal', 'elementor' ),
            ]
        );

        $this->add_control(
            'img_hover_opacity',
            [
                'label'     => esc_html__( 'Opacity', 'elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'img_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-clients-logo .logo-wrap:hover img' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'img-hover_shadow',
                'selector' => '{{WRAPPER}} .jeena-clients-logo .logo-wrap:hover img',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_navigation_arrow_style',
            [
                'label'     => esc_html__( 'Navigation: Arrow', 'jeena-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout'      => 'slider',
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_position_toggle',
            [
                'label'        => esc_html__( 'Position', 'jeena-toolkit' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => esc_html__( 'None', 'jeena-toolkit' ),
                'label_on'     => esc_html__( 'Custom', 'jeena-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_control(
            'arrow_position',
            [
                'label'       => esc_html__( ' Position', 'jeena-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'position-default' => [
                        'title' => esc_html__( 'Normal', 'jeena-toolkit' ),
                        'icon'  => 'eicon-justify-space-between-h',
                    ],
                    'same-position-h'  => [
                        'title' => esc_html__( 'Sync Horizontal', 'jeena-toolkit' ),
                        'icon'  => 'eicon-align-stretch-h',
                    ],
                    'same-position-v'  => [
                        'title' => esc_html__( 'Sync Vertical', 'jeena-toolkit' ),
                        'icon'  => 'eicon-align-stretch-v',
                    ],
                ],
                'default'     => 'position-default',
                'condition'   => [
                    'arrow_position_toggle' => 'yes',
                ],
                'toggle'      => false,
            ]
        );

        $this->add_responsive_control(
            'arrow_position_x',
            [
                'label'      => esc_html__( 'Horizontal', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => -500,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-slider-arrows' => '--arrow-h-p: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'arrow_position_toggle' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_position_y',
            [
                'label'      => esc_html__( 'Vertical', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => -500,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-slider-arrows' => '--arrow-v-p: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'arrow_position_toggle' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_spacing',
            [
                'label'      => esc_html__( 'Space Between (px)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition'  => [
                    'arrow_position_toggle' => 'yes',
                    'arrow_position!'       => 'position-default',
                ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-slider-arrows' => '--arrow-space: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_transform_x',
            [
                'label'      => esc_html__( 'Transform X', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],

                'range'      => [
                    'px' => [
                        'min' => -500,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-slider-arrows' => '--transform-x: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'arrow_position_toggle' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_transform_y',
            [
                'label'      => esc_html__( 'Transform Y', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],

                'range'      => [
                    'px' => [
                        'min' => -500,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-slider-arrows' => '--transform-y: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'arrow_position_toggle' => 'yes',
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'arrow_size',
            [
                'label'      => esc_html__( 'Size (px)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-slider-arrows' => '--arrow-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_icon_size',
            [
                'label'      => esc_html__( 'Icon Size (px)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 2,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-slider-arrows .slick-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'arrow_border',
                'selector' => '{{WRAPPER}} .jeena-slider-arrows .slick-arrow',
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-slider-arrows .slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_arrow' );

        $this->start_controls_tab(
            'tab_arrow_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-slider-arrows .slick-arrow' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-slider-arrows .slick-arrow' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_arrow_hover',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-slider-arrows .slick-arrow:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-slider-arrows .slick-arrow:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'arrow_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-slider-arrows .slick-arrow:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagination_dots_style',
            [
                'label'     => esc_html__( 'Navigation: Dots', 'jeena-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout'    => 'slider',
                    'show_dots' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_position_y',
            [
                'label'      => esc_html__( 'Vertical Position (px)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => -400,
                        'max' => 400,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-slider-wrapper .jeena-slider-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_spacing',
            [
                'label'      => esc_html__( 'Spacing (px)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-slider-wrapper .jeena-slider-dots' => '--dots-space: calc({{SIZE}}{{UNIT}} / 2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_size',
            [
                'label'      => esc_html__( 'Size (px)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-slider-wrapper .jeena-slider-dots' => '--dots-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_align',
            [
                'label'       => esc_html__( 'Alignment', 'jeena-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'jeena-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'jeena-toolkit' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'jeena-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'toggle'      => false,
                'default'     => 'center',
            ]
        );

        $this->start_controls_tabs( 'tabs_dots' );

        $this->start_controls_tab(
            'tab_dots_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'dots_nav_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-slider-dots .slick-dots li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dots_hover',
            [
                'label' => esc_html__( 'Hover/Active', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'dots_nav_hover_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-slider-dots .slick-dots li:hover, {{WRAPPER}} .jeena-slider-dots .slick-dots li.slick-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    public function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['clients_logo'] ) ) {
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'jeena-clients-logo' );

        if( 'slider' == $settings['layout'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'jeena-slider-wrapper' );
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <?php if( 'grid' == $settings['layout'] ) : ?>
                <?php
                foreach ( $settings['clients_logo'] as $index => $item ) {
                    $this->render_single_item( $index, $item );
                }
                ?>
            <?php elseif( 'slider' == $settings['layout'] ) : ?>
                <div class="jeena-slider-active">
                    <?php foreach ( $settings['clients_logo'] as $index => $item ) : ?>
                    <div class="jeena-slider-item">
                        <?php $this->render_single_item( $index, $item ); ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php if ( 'yes' === $settings['show_arrows'] ): ?>
                <div class="jeena-slider-arrows <?php echo esc_attr( $settings['arrow_position'] ) ?>">
                    <div class="arrow-prev" role="button">
                        <?php Icons_Manager::render_icon( $settings['arrow_prev'], ['aria-hidden' => 'true'] );?>
                    </div>
                    <div class="arrow-next" role="button">
                        <?php Icons_Manager::render_icon( $settings['arrow_next'], ['aria-hidden' => 'true'] );?>
                    </div>
                </div>
                <?php endif;?>

                <?php if ( 'yes' === $settings['show_dots'] ): ?>
                <div class="jeena-slider-dots dots-<?php echo esc_attr( $settings['dots_nav_align'] ) ?>"></div>
                <?php endif;?>

            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render single item
     *
     * @param array $item
     * @return void
     */
    protected function render_single_item( $index, $item ) {
        ?>
        <div class="logo-wrap">
            <?php
            if ( $item['logo']['url'] || $item['logo']['id'] ) {
                echo Group_Control_Image_Size::get_attachment_image_html( $item, 'large', 'logo' );
            }
            if ( $item['url']['url'] ) {
                $url_key = $this->get_repeater_setting_key( 'url', 'full', $index );

                $this->add_link_attributes( $url_key, $item['url'] );
                $this->add_render_attribute( $url_key, 'class', 'item-url' );

                printf( '<a %1$s></a>',
                    $this->get_render_attribute_string( $url_key )
                );
            }
            ?>
        </div>
        <?php
    }
}