<?php
namespace JeenaToolkit\ElementorAddon\Helper;

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use JeenaTheme\Classes\Jeena_Helper;

class Jeena_Extenders {
    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        add_action( 'elementor/element/section/section_layout/before_section_end', [$this, 'register_controls_section'], 10, 1 );
        add_action( 'elementor/element/section/section_advanced/after_section_end', [$this, 'register_controls_sticky'], 10, 1 );
        add_action( 'elementor/frontend/section/before_render', [$this, 'sticky_before_render'], 10, 1 );
        add_action( 'elementor/element/section/section_background_overlay/before_section_end', [$this, 'register_controls_overly'], 10, 1 );

        add_action( 'elementor/element/column/layout/before_section_end', [$this, 'register_controls_column'], 10, 1 );

        add_action( 'elementor/element/before_section_end', [$this, 'register_controls_effect'], 10, 3 );
        add_action( 'elementor/element/before_section_end', [$this, 'register_widget_order'], 10, 3 );

        add_action( 'rest_request_after_callbacks', [$this, 'elementor_add_theme_colors'], 999, 3 );
        add_filter( 'rest_request_after_callbacks', [$this, 'display_global_colors_front_end'], 999, 3 );
    }

    /**
     * Column Alignment
     *
     * @return void
     */
    public function register_controls_section( $section ) {
        $section->add_responsive_control(
            'column_align', [
                'label'     => esc_html__( 'Horizontal Align', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'separator' => 'before',
                'options'   => [
                    'flex-start' => esc_html__( 'Left', 'jeena-toolkit' ),
                    'center'     => esc_html__( 'Center', 'jeena-toolkit' ),
                    'flex-end'   => esc_html__( 'End', 'jeena-toolkit' ),
                ],
                'default'   => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .elementor-container' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $section->add_responsive_control(
            'overflow_x', [
                'label'     => esc_html__( 'Overflow X', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''        => esc_html__( 'Default', 'jeena-toolkit' ),
                    'visible' => esc_html__( 'Visible', 'jeena-toolkit' ),
                    'hidden'  => esc_html__( 'Hidden', 'jeena-toolkit' ),
                    'scroll'  => esc_html__( 'Scroll', 'jeena-toolkit' ),
                    'auto'    => esc_html__( 'Auto', 'jeena-toolkit' ),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'overflow-x: {{VALUE}};',
                ],
            ]
        );

        $section->add_responsive_control(
            'overflow_y', [
                'label'     => esc_html__( 'Overflow Y', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''        => esc_html__( 'Default', 'jeena-toolkit' ),
                    'visible' => esc_html__( 'Visible', 'jeena-toolkit' ),
                    'hidden'  => esc_html__( 'Hidden', 'jeena-toolkit' ),
                    'scroll'  => esc_html__( 'Scroll', 'jeena-toolkit' ),
                    'auto'    => esc_html__( 'Auto', 'jeena-toolkit' ),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'overflow-y: {{VALUE}};',
                ],
            ]
        );
    }

    /**
     * Sticky Section
     *
     * @return void
     */
    public function register_controls_sticky( $section ) {

        $section->start_controls_section(
            'section_sticky_controls',
            [
                'label' => esc_html__( 'Jeena Sticky', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'section_sticky_on',
            [
                'label'        => esc_html__( 'Enable Sticky', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'description'  => esc_html__( 'Set sticky options by enable this option.', 'jeena-toolkit' ),
            ]
        );

        $section->add_responsive_control(
            'section_sticky_offset',
            [
                'label'     => esc_html__( 'Offset', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}.jeena-sticky.jeena-sticky-active' => 'top: {{SIZE}}px;',
                ],
            ]
        );

        $section->add_control(
            'section_sticky_active_bg',
            [
                'label'     => esc_html__( 'Active Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.jeena-sticky.jeena-sticky-active' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_responsive_control(
            'section_sticky_active_padding',
            [
                'label'      => esc_html__( 'Active Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}}.jeena-sticky.jeena-sticky-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'     => esc_html__( 'Active Box Shadow', 'jeena-toolkit' ),
                'name'      => 'section_sticky_active_shadow',
                'selector'  => '{{WRAPPER}}.jeena-sticky.jeena-sticky-active',
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->end_controls_section();
    }

    /**
     * Sticky Before Render
     *
     * @param $section
     * @return void
     */
    public function sticky_before_render( $section ) {
        $settings = $section->get_settings_for_display();

        if ( ! empty( $settings['section_sticky_on'] ) == 'yes' ) {
            $section->add_render_attribute( '_wrapper', 'class', 'jeena-sticky' );
        }
    }

    /**
     * Background Overly Option
     *
     * @param $section
     * @return void
     */
    public function register_controls_overly( $section ) {
        $section->add_control(
            'section_overly_custom',
            [
                'label'        => esc_html__( 'Customize Overly Position', 'jeena-toolkit' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => esc_html__( 'Default', 'jeena-toolkit' ),
                'label_on'     => esc_html__( 'Custom', 'jeena-toolkit' ),
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $section->start_popover();

        $section->add_responsive_control(
            'section_overly_width',
            [
                'label'      => esc_html__( 'Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range'      => [
                    'px' => [
                        'min'  => 5,
                        'max'  => 1500,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'vw' => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'section_overly_custom' => 'yes',
                ],
            ]
        );

        $section->add_responsive_control(
            'section_overly_height',
            [
                'label'      => esc_html__( 'Height', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
                'range'      => [
                    'px' => [
                        'min'  => 5,
                        'max'  => 1500,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'section_overly_custom' => 'yes',
                ],
            ]
        );

        $section->add_responsive_control(
            'section_overly_position',
            [
                'label'        => esc_html__( 'Position', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    ''              => esc_html__( 'Default', 'jeena-toolkit' ),
                    'center-center' => esc_html__( 'Center Center', 'jeena-toolkit' ),
                    'center-left'   => esc_html__( 'Center Left', 'jeena-toolkit' ),
                    'center-right'  => esc_html__( 'Center Right', 'jeena-toolkit' ),
                    'top-center'    => esc_html__( 'Top Center', 'jeena-toolkit' ),
                    'top-left'      => esc_html__( 'Top Left', 'jeena-toolkit' ),
                    'top-right'     => esc_html__( 'Top Right', 'jeena-toolkit' ),
                    'bottom-center' => esc_html__( 'Bottom Center', 'jeena-toolkit' ),
                    'bottom-left'   => esc_html__( 'Bottom Left', 'jeena-toolkit' ),
                    'bottom-right'  => esc_html__( 'Bottom Right', 'jeena-toolkit' ),
                ],
                'default'      => '',
                'prefix_class' => 'jeena-overly-',
                'condition'    => [
                    'section_overly_custom' => 'yes',
                ],
            ]
        );

        $section->end_popover();
    }

    /**
     * Column Order Option
     *
     * @return void
     */
    public function register_controls_column( $column ) {
        $column->add_responsive_control(
            'jeena_column_order',
            [
                'label'          => __( 'Column Order', 'jeena-toolkit' ),
                'type'           => Controls_Manager::NUMBER,
                'style_transfer' => true,
                'separator'      => 'before',
                'selectors'      => [
                    '{{WRAPPER}}.elementor-column' => '-webkit-box-ordinal-group: calc({{VALUE}} + 1 ); -ms-flex-order:{{VALUE}}; order: {{VALUE}};',
                ],
                'description'    => sprintf(
                    __( 'Column ordering is a great addition for responsive design. You can learn more about CSS order property from %sMDN%s.', 'jeena-toolkit' ),
                    '<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Flexible_Box_Layout/Ordering_Flex_Items#The_order_property" target="_blank">',
                    '</a>'
                ),
            ]
        );
    }

    /**
     * Floating Effect
     *
     * @param [type] $widget
     * @param [type] $widget_id
     * @param array $args
     * @return void
     */
    public function register_controls_effect( $widget, $widget_id, $args = [] ) {
        static $widgets = [
            'section_effects',
        ];

        if ( ! in_array( $widget_id, $widgets ) ) {
            return;
        }

        $widget->add_control(
            'jeena_enable_float',
            [
                'label'              => esc_html__( 'Enable floating animation', 'jeena-toolkit' ),
                'description'        => esc_html__( 'Add a looping up-down animation.', 'jeena-toolkit' ),
                'type'               => Controls_Manager::SWITCHER,
                'separator'          => 'before',
                'default'            => '',
                'return_value'       => 'on',
                'prefix_class'       => 'jeena-floating-',
                'frontend_available' => false,
            ]
        );

        $widget->add_control(
            'jeena_floating_type',
            [
                'label'              => esc_html__( 'Effect Type', 'jeena-toolkit' ),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'none',
                'frontend_available' => false,
                'options'            => [
                    'none'      => esc_html__( 'Select Effect', 'jeena-toolkit' ),
                    'effect-1'  => esc_html__( 'Effect One', 'jeena-toolkit' ),
                    'effect-2'  => esc_html__( 'Effect Two', 'jeena-toolkit' ),
                    'effect-3'  => esc_html__( 'Effect Three', 'jeena-toolkit' ),
                    'effect-4'  => esc_html__( 'Effect Four', 'jeena-toolkit' ),
                    'effect-5'  => esc_html__( 'Effect Five', 'jeena-toolkit' ),
                    'effect-6'  => esc_html__( 'Effect Six', 'jeena-toolkit' ),
                    'effect-7'  => esc_html__( 'Effect Seven', 'jeena-toolkit' ),
                    'effect-8'  => esc_html__( 'Effect Eight', 'jeena-toolkit' ),
                    'effect-9'  => esc_html__( 'Effect Nine', 'jeena-toolkit' ),
                    'effect-10' => esc_html__( 'Effect Ten', 'jeena-toolkit' ),
                ],
                'condition'          => [
                    'jeena_enable_float' => 'on',
                ],
                'selectors'          => [
                    '{{WRAPPER}}.jeena-floating-on > *' => 'animation-name: {{VALUE}};',
                ],
            ]
        );

        $widget->add_control(
            'jeena_animation_duration',
            [
                'label'              => esc_html__( 'Animation Duration', 'jeena-toolkit' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 0.1,
                'max'                => 100,
                'default'            => 5,
                'frontend_available' => false,
                'condition'          => [
                    'jeena_enable_float' => 'on',
                ],
                'selectors'          => [
                    '{{WRAPPER}}.jeena-floating-on > *' => 'animation-duration: {{VALUE}}s;',
                ],
            ]
        );
    }

    /**
     * Widget Order Option
     *
     * @return void
     */
    public function register_widget_order( $widget, $widget_id, $args = [] ) {
        static $widgets = [
            '_section_style',
        ];

        if ( ! in_array( $widget_id, $widgets ) ) {
            return;
        }

        $widget->add_responsive_control(
            'jeena_widget_order',
            [
                'label'          => __( 'Widget Order', 'jeena-toolkit' ),
                'type'           => Controls_Manager::NUMBER,
                'style_transfer' => true,
                'separator'      => 'before',
                'selectors'      => [
                    '{{WRAPPER}}.elementor-element' => '-webkit-box-ordinal-group: calc({{VALUE}} + 1 ); -ms-flex-order:{{VALUE}}; order: {{VALUE}};',
                ],
                'description'    => sprintf(
                    __( 'Widget ordering is a great addition for responsive design. You can learn more about CSS order property from %sMDN%s.', 'jeena-toolkit' ),
                    '<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Flexible_Box_Layout/Ordering_Flex_Items#The_order_property" target="_blank">',
                    '</a>'
                ),
            ]
        );
    }

    /**
     * Display theme global colors to Elementor Global colors
     *
     * @since 3.7.0
     * @param object          $response rest request response.
     * @param array           $handler Route handler used for the request.
     * @param WP_REST_Request $request Request used to generate the response.
     * @return object
     */
    public function elementor_add_theme_colors( $response, $handler, $request ) {
        $route = $request->get_route();

        if ( '/elementor/v1/globals' != $route ) {
            return $response;
        }

        $data = $response->get_data();

        $theme_colors = Jeena_Helper::get_global_colors();

        foreach ( $theme_colors as $key => $color ) {
            $data['colors'][$key] = [
                'id'    => $key,
                'title' => $color['title'],
                'value' => $color['value'],
            ];
        }

        $response->set_data( $data );

        return $response;
    }

    /**
     * Display global colors on Elementor front end Page.
     *
     * @since 3.7.0
     * @param object          $response rest request response.
     * @param array           $handler Route handler used for the request.
     * @param WP_REST_Request $request Request used to generate the response.
     * @return object
     */
    public function display_global_colors_front_end( $response, $handler, $request ) {

        $route = $request->get_route();

        if ( 0 !== strpos( $route, '/elementor/v1/globals' ) ) {
            return $response;
        }

        $theme_colors = Jeena_Helper::get_global_colors();

        $rest_id = substr( $route, strrpos( $route, '/' ) + 1 );

        if ( ! in_array( $rest_id, array_keys( $theme_colors ), true ) ) {
            return $response;
        }

        $response = rest_ensure_response(
            [
                'id'    => esc_attr( $rest_id ),
                'title' => $theme_colors[$rest_id]['title'],
                'value' => $theme_colors[$rest_id]['value'],
            ]
        );

        return $response;
    }
}

Jeena_Extenders::instance()->initialize();
