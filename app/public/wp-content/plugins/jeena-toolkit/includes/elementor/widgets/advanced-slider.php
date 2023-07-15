<?php
namespace jeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Advanced_Slider extends Widget_Base {

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
        return 'jeena-advanced-slider';
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
        return esc_html__( 'Advanced Slider', 'jeena-toolkit' );
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
        return 'eicon-post-slider webtend-logo';
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
        return ['slick', 'magnific-popup'];
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
        return ['slick', 'magnific-popup'];
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
        return ['jeena', 'toolkit', 'advanced', 'slider', 'carousel'];
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
            'section_slides',
            [
                'label' => esc_html__( 'Slides', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $slides = new Repeater();

        $slides->add_control(
            'content_type',
            [
                'label'   => esc_html__( 'Content Type', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'content',
                'options' => [
                    'content'  => esc_html__( 'Content', 'jeena-toolkit' ),
                    'block'    => esc_html__( 'Builder Block', 'jeena-toolkit' ),
                    'template' => esc_html__( 'Elementor Templates', 'jeena-toolkit' ),
                ],
            ]
        );

        $slides->start_controls_tabs(
            'slide_content_tabs'
        );

        $slides->start_controls_tab(
            'slide_content_tabs_content',
            [
                'label'     => esc_html__( 'Content', 'jeena-toolkit' ),
                'condition' => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->add_control(
            'subtitle',
            [
                'label'       => esc_html__( 'Subtitle', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( 'Type your sub title here', 'jeena-toolkit' ),
                'condition'   => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'jeena-toolkit' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Type your title here', 'jeena-toolkit' ),
                'condition'   => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->add_control(
            'description',
            [
                'label'       => esc_html__( 'Description', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__( 'Type your description here', 'jeena-toolkit' ),
                'condition'   => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->add_control(
            'button_text',
            [
                'label'     => esc_html__( 'Button Text', 'jeena-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Get Started', 'jeena-toolkit' ),
                'condition' => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->add_control(
            'button_link',
            [
                'label'       => esc_html__( 'Button Link', 'jeena-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'jeena-toolkit' ),
                'default'     => [
                    'url' => '#',
                ],
                'condition'   => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->add_control(
            'button_icon',
            [
                'label'            => esc_html__( 'Icon', 'jeena-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin'             => 'inline',
                'label_block'      => false,
                'default'          => [
                    'value'   => 'far fa-long-arrow-right',
                    'library' => 'fa-regular',
                ],
                'condition'        => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->add_control(
            'video_button_text',
            [
                'label'     => esc_html__( 'Video Button Text', 'jeena-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'How IT Works', 'jeena-toolkit' ),
                'condition' => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->add_control(
            'video_button_link',
            [
                'label'       => esc_html__( 'Video Link', 'jeena-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'jeena-toolkit' ),
                'default'     => [
                    'url' => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
                ],
                'condition'   => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->add_control(
            'video_button_icon',
            [
                'label'            => esc_html__( 'Icon', 'jeena-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'video_icon_f4',
                'skin'             => 'inline',
                'label_block'      => false,
                'default'          => [
                    'value'   => 'fas fa-play',
                    'library' => 'fa-solid',
                ],
                'condition'        => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->end_controls_tab();

        $slides->start_controls_tab(
            'slide_background_tabs',
            [
                'label'     => esc_html__( 'Background', 'jeena-toolkit' ),
                'condition' => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'slider_background',
                'label'          => esc_html__( 'Background', 'jeena-toolkit' ),
                'types'          => ['classic', 'gradient'],
                'selector'       => '{{WRAPPER}} {{CURRENT_ITEM}} .slider-item-bg',
                'separator'      => 'before',
                'style_transfer' => true,
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'image'      => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'color'      => [
                        'default' => '#1b1f2b',
                    ],
                ],
                'condition'      => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->add_control(
            'overly_color',
            [
                'label'     => esc_html__( 'Overly Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slider-bg-overly' => 'background: {{VALUE}};',
                ],
            ]
        );

        $slides->add_responsive_control(
            'overly_opacity',
            [
                'label'      => esc_html__( 'Opacity', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slider-bg-overly' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $slides->end_controls_tab();

        $slides->start_controls_tab(
            'slide_content_tabs_style',
            [
                'label'     => esc_html__( 'Style', 'jeena-toolkit' ),
                'condition' => [
                    'content_type' => 'content',
                ],
            ]
        );

        $slides->add_control(
            'slide_content_custom',
            [
                'label'        => esc_html__( 'Custom', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'jeena-toolkit' ),
                'label_off'    => esc_html__( 'No', 'jeena-toolkit' ),
                'return_value' => 'yes',
                'description'  => esc_html__( 'Set custom style that will only affect this specific slide.', 'jeena-toolkit' ),
                'default'      => 'no',
            ]
        );

        $slides->add_responsive_control(
            'single_slider_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.jeena-slider-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'content_type'         => 'content',
                    'slide_content_custom' => 'yes',
                ],
            ]
        );

        $slides->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'slide_content_background',
                'label'          => esc_html__( 'Background', 'jeena-toolkit' ),
                'types'          => ['classic', 'gradient'],
                'selector'       => '{{WRAPPER}} {{CURRENT_ITEM}} .slider-content',
                'separator'      => 'before',
                'style_transfer' => true,
                'condition'      => [
                    'content_type'         => 'content',
                    'slide_content_custom' => 'yes',
                ],
            ]
        );

        $slides->add_control(
            'slide_text_align',
            [
                'label'     => esc_html__( 'Text Align', 'jeena-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slider-content' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'content_type'         => 'content',
                    'slide_content_custom' => 'yes',
                ],
            ]
        );

        $slides->add_control(
            'slide_content_color',
            [
                'label'     => esc_html__( 'Content Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slider-subtitle, {{WRAPPER}} {{CURRENT_ITEM}} .slider-title, {{WRAPPER}} {{CURRENT_ITEM}} .slider-desc' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slider-subtitle::before'                                                                                => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'content_type'         => 'content',
                    'slide_content_custom' => 'yes',
                ],
            ]
        );

        $slides->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'slide_content_border',
                'label'     => esc_html__( 'Border', 'jeena-toolkit' ),
                'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .slider-content',
                'condition' => [
                    'content_type'         => 'content',
                    'slide_content_custom' => 'yes',
                ],
            ]
        );

        $slides->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'single_content_shadow',
                'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .slider-content',
                'condition' => [
                    'content_type'         => 'content',
                    'slide_content_custom' => 'yes',
                ],
            ]
        );

        $slides->end_controls_tab();

        $slides->end_controls_tabs();

        $slides->add_control(
            'block_id',
            [
                'label'     => esc_html__( 'Select Block', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => jt_select_builder_block(),
                'condition' => [
                    'content_type' => 'block',
                ],
                'default'   => '0',
            ]
        );

        $slides->add_control(
            'template_id',
            [
                'label'     => esc_html__( 'Select Template', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => jt_select_elementor_template(),
                'condition' => [
                    'content_type' => 'template',
                ],
                'default'   => '0',
            ]
        );

        $this->add_control(
            'slides',
            [
                'label'   => esc_html__( 'Items', 'jeena-toolkit' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $slides->get_controls(),
                'default' => [
                    [
                        'content_type'                 => 'content',
                        'subtitle'                     => esc_html__( 'IT Service Company', 'jeena-toolkit' ),
                        'title'                        => esc_html__( 'We’re Digital IT Services Agency', 'jeena-toolkit' ),
                        'slider_background_background' => 'classic',
                        'slider_background_color'      => '#1b1f2b',
                        'slider_background_image'      => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'button_text'                  => esc_html__( 'Get started', 'jeena-toolkit' ),
                        'button_link'                  => ['url' => '#'],
                        'button_icon'                  => [
                            'value'   => 'far fa-long-arrow-right',
                            'library' => 'fa-regular',
                        ],
                    ],
                    [
                        'content_type'                 => 'content',
                        'subtitle'                     => esc_html__( 'IT Service Company', 'jeena-toolkit' ),
                        'title'                        => esc_html__( 'We’re Digital IT Services Agency', 'jeena-toolkit' ),
                        'slider_background_background' => 'classic',
                        'slider_background_color'      => '#1b1f2b',
                        'slider_background_image'      => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'button_text'                  => esc_html__( 'Get started', 'jeena-toolkit' ),
                        'button_link'                  => ['url' => '#'],
                        'button_icon'                  => [
                            'value'   => 'far fa-long-arrow-right',
                            'library' => 'fa-regular',
                        ],
                        'video_button_text'            => esc_html__( 'How it works', 'jeena-toolkit' ),
                        'video_button_link'            => ['url' => '#'],
                        'video_button_icon'            => [
                            'value'   => 'fas fa-play',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'slides_style_control_separator',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'       => esc_html__( 'HTML Tag', 'jeena-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'h1' => [
                        'title' => esc_html__( 'H1', 'jeena-toolkit' ),
                        'icon'  => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => esc_html__( 'H2', 'jeena-toolkit' ),
                        'icon'  => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => esc_html__( 'H3', 'jeena-toolkit' ),
                        'icon'  => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => esc_html__( 'H4', 'jeena-toolkit' ),
                        'icon'  => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => esc_html__( 'H5', 'jeena-toolkit' ),
                        'icon'  => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => esc_html__( 'H6', 'jeena-toolkit' ),
                        'icon'  => 'eicon-editor-h6',
                    ],
                ],
                'default'     => 'h1',
                'toggle'      => false,
            ]
        );

        $this->add_control(
            'effect',
            [
                'label'              => esc_html__( 'Fade Effect', 'jeena-toolkit' ),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'yes',
                'frontend_available' => true,
                'separator'          => 'before',
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
            'content_animation',
            [
                'label'     => esc_html__( 'Animation', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    ''                     => esc_html__( 'None', 'jeena-toolkit' ),
                    'slider-animate-left'  => esc_html__( 'Fade in Left', 'jeena-toolkit' ),
                    'slider-animate-right' => esc_html__( 'Fade in Right', 'jeena-toolkit' ),
                    'slider-animate-up'    => esc_html__( 'Fade in Up', 'jeena-toolkit' ),
                    'slider-animate-down'  => esc_html__( 'Fade in Down', 'jeena-toolkit' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-active .slider-content > *' => 'animation-name: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_item_style',
            [
                'label' => esc_html__( 'Slider Item', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'slider_container_width',
            [
                'label'      => esc_html__( 'Container Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
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
                    'em' => [
                        'min'  => 0.1,
                        'max'  => 15,
                        'step' => 0.1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-content-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-advanced-slider .jeena-slider-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_bg_width',
            [
                'label'      => esc_html__( 'Background Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
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
                    'em' => [
                        'min'  => 0.1,
                        'max'  => 15,
                        'step' => 0.1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-item-bg' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slider_bg_position',
            [
                'label'     => esc_html__( 'Horizontal Align', 'jeena-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'bg-left' => [
                        'title' => esc_html__( 'Left', 'jeena-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'bg-right'   => [
                        'title' => esc_html__( 'Right', 'jeena-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__( 'Content Area', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'slider_width',
            [
                'label'      => esc_html__( 'Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
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
                    'em' => [
                        'min'  => 0.1,
                        'max'  => 15,
                        'step' => 0.1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_content_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slide_content_horizontal_align',
            [
                'label'     => esc_html__( 'Horizontal Align', 'jeena-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'jeena-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Center', 'jeena-toolkit' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__( 'Right', 'jeena-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-content-wrapper' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'slide_content_text_align',
            [
                'label'     => esc_html__( 'Text Align', 'jeena-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'start'  => [
                        'title' => esc_html__( 'Left', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'end'    => [
                        'title' => esc_html__( 'Right', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-content'                        => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .slider-content .slider-button-wrapper' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'content_border',
                'placeholder' => '0',
                'separator'   => 'before',
                'selector'    => '{{WRAPPER}} .slider-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .slider-content',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => esc_html__( 'Title', 'jeena-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-content .slider-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'selector' => '{{WRAPPER}} .slider-content .slider-title',
            ]
        );

        $this->add_control(
            'subtitle_heading',
            [
                'label'     => esc_html__( 'Subtitle', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label'     => esc_html__( 'Bottom Spacing (px)', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .slider-content .slider-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-content .slider-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typo',
                'selector' => '{{WRAPPER}} .slider-content .slider-subtitle',
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-content .slider-subtitle::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_heading',
            [
                'label'     => esc_html__( 'Description', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label'      => esc_html__( 'Top Spacing (px)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-content .slider-desc' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-content .slider-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typo',
                'selector' => '{{WRAPPER}} .slider-content .slider-desc',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Buttons', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_spacing',
            [
                'label'      => esc_html__( 'Top Spacing (px)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-content .slider-button-wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_text_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_typography',
                'selector' => '{{WRAPPER}} .jeena-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border',
                'selector' => '{{WRAPPER}} .jeena-button',
            ]
        );

        $this->add_control(
            'btn_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .jeena-button'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .jeena-button svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .jeena-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .jeena-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .jeena-button:hover'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .jeena-button:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .jeena-button:before, {{WRAPPER}} .jeena-button:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_hover_box_shadow',
                'selector' => '{{WRAPPER}} .jeena-button:hover',
            ]
        );

        $this->add_control(
            'btn_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'btn_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'video_btn_heading',
            [
                'label'     => 'Video Button',
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'video_btn_gap',
            [
                'label'     => esc_html__( 'Gap', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .video-button' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'video_btn_typography',
                'selector' => '{{WRAPPER}} .video-button .button-text',
            ]
        );

        $this->add_responsive_control(
            'video_icon_size',
            [
                'label'     => esc_html__( 'Play Icon Size', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .video-button .play-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_icon_font_size',
            [
                'label'     => esc_html__( 'Font Size', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .video-button .play-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_video_button_style' );

        $this->start_controls_tab(
            'tab_video_button_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'video_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-button .button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'play_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-button .play-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'play_icon_icon_bg',
            [
                'label'     => esc_html__( 'Icon Background', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-button .play-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_video_button_hover',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'video_text_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-button:hover .button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'play_icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-button:hover .play-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'play_icon_icon_hover_bg',
            [
                'label'     => esc_html__( 'Icon Background', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-button:hover .play-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_navigation_arrow_style',
            [
                'label'     => esc_html__( 'Navigation: Arrows', 'jeena-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
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
     * Render Single Slider Item
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function slider_content( $slide, $title_tag ) {
        ?>
        <div class="slider-item-bg">
            <div class="slider-bg-overly"></div>
        </div>
        <div class="slider-content-wrapper">
            <div class="slider-content">
                <?php
                    if ( ! empty( $slide['subtitle'] ) ) {
                        $this->add_render_attribute( 'subtitle', 'class', 'slider-subtitle' );

                        printf( '<span %1$s>%2$s</span>',
                            $this->get_render_attribute_string( 'subtitle' ),
                            esc_html( $slide['subtitle'] )
                        );
                    }
                    if ( ! empty( $slide['title'] ) ) {
                        $this->add_render_attribute( 'title', 'class', 'slider-title' );

                        printf( '<%1$s %2$s>%3$s</%1$s>',
                            jt_escape_tags( $title_tag, 'h2' ),
                            $this->get_render_attribute_string( 'title' ),
                            jt_kses_basic( $slide['title'] )
                        );
                    }
                    if ( ! empty( $slide['description'] ) ) {
                        $this->add_render_attribute( 'description', 'class', 'slider-desc' );

                        printf( '<p %1$s>%2$s</p>',
                            $this->get_render_attribute_string( 'description' ),
                            jt_kses_basic( $slide['description'] )
                        );
                    }
                ?>
                <div class="slider-button-wrapper">
                    <?php if ( ! empty( $slide['button_link']['url'] ) ) :
                        $this->add_link_attributes( 'button', $slide['button_link'] );
                        $this->add_render_attribute( 'button', 'class', 'jeena-button hover-normal' );

                        $migrated = isset( $slide['__fa4_migrated']['button_icon'] );
                        $is_new   = empty( $slide['icon'] ) && Icons_Manager::is_migration_allowed();
                    ?>
                    <a <?php $this->print_render_attribute_string( 'button' );?>>
                        <?php if ( ! empty( $slide['icon'] ) || ! empty( $slide['button_icon']['value'] ) ): ?>
                        <span class="button-icon icon-align-right">
                            <?php
                                if ( $is_new || $migrated ) {
                                    Icons_Manager::render_icon( $slide['button_icon'], ['aria-hidden' => 'true'] );
                                } else {
                                    printf( '<i class="%1$s" aria-hidden="true"></i>',
                                        esc_attr( $slide['icon'] )
                                    );
                                }
                            ?>
                        </span>
                        <?php endif; ?>
                        <?php if ( ! empty( $slide['button_text'] ) ): ?>
                        <span class="button-text"><?php echo esc_html( $slide['button_text'] ) ?></span>
                        <?php endif; ?>
                    </a>
                    <?php endif; ?>
                    <?php if ( ! empty( $slide['video_button_link']['url'] ) ) : ?>
                    <a href="<?php echo esc_url( $slide['video_button_link']['url'] ) ?>" class="video-button popup-video">
                        <?php if ( ! empty( $slide['video_icon_f4'] ) || ! empty( $slide['video_button_icon']['value'] ) ): ?>
                        <span class="play-icon">
                            <?php
                                $migrated_video = isset( $slide['__fa4_migrated']['video_button_icon'] );
                                $is_new_video   = empty( $slide['video_icon_f4'] ) && Icons_Manager::is_migration_allowed();

                                if ( $migrated_video || $is_new_video ) {
                                    Icons_Manager::render_icon( $slide['video_button_icon'], ['aria-hidden' => 'true'] );
                                } else {
                                    printf( '<i class="%1$s" aria-hidden="true"></i>',
                                        esc_attr( $slide['video_icon_f4'] )
                                    );
                                }
                            ?>
                        </span>
                        <?php endif; ?>
                        <?php if ( ! empty( $slide['video_button_text'] ) ): ?>
                        <span class="button-text"><?php echo esc_html( $slide['video_button_text'] ) ?></span>
                        <?php endif; ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
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
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['slides'] ) ) {
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'jeena-advanced-slider jeena-slider-wrapper');

        if ( $settings['slider_bg_position'] ) {
            $this->add_render_attribute('wrapper', 'class', $settings['slider_bg_position'] );
        }

        ?>

        <div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
            <div class="jeena-slider-active">
                <?php foreach( $settings['slides'] as $index => $slide ) : ?>
                <div class="jeena-slider-item elementor-repeater-item-<?php echo $slide['_id']; ?>">
                    <?php
                        if( 'template' === $slide['content_type'] || 'block' === $slide['content_type'] ) {
                            if ( 'template' === $slide['content_type'] ) {
                                $t_id = $slide['template_id'];
                            } elseif ( 'block' === $slide['content_type'] ) {
                                $t_id = $slide['block_id'];
                            }

                            echo Plugin::$instance->frontend->get_builder_content_for_display( $t_id, true );
                        } else {
                            $this->slider_content( $slide, $settings['title_tag'] );
                        }
                    ?>
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
        </div>
        <?php
    }
}