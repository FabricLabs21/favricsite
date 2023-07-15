<?php
namespace JeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Info_Box extends Widget_Base {

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
        return 'jeena-info-box';
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
        return esc_html__( 'Info Box', 'jeena-toolkit' );
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
        return 'eicon-info-box webtend-logo';
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
        return ['jeena', 'toolkit', 'info', 'image', 'icon', 'box'];
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
            'section_content_additional',
            [
                'label' => esc_html__( 'Additional Options', 'jeena-toolkit' ),
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
                'default'     => 'h4',
                'toggle'      => false,
            ]
        );

        $this->add_control(
            'read_more',
            [
                'label'        => esc_html__( 'Read More Button', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'badge',
            [
                'label'        => esc_html__( 'Badge', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'wrapper_link',
            [
                'label'        => esc_html( 'Wrapper Link', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
                'description'  => esc_html( 'Be aware! When Wrapper Link activated then title link and read more link will not work', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'wrapper_link_url',
            [
                'label'       => esc_html( 'Wrapper Link URL', 'jeena-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'condition'   => [
                    'wrapper_link' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_heading',
            [
                'label' => esc_html__( 'Info Box', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label'   => esc_html__( 'Icon Type', 'jeena-toolkit' ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'default' => 'icon',
                'options' => [
                    'icon'  => [
                        'title' => esc_html__( 'Icon', 'jeena-toolkit' ),
                        'icon'  => 'fas fa-star',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'jeena-toolkit' ),
                        'icon'  => 'far fa-image',
                    ],
                ],
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label'            => esc_html__( 'Icon', 'jeena-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'far fa-paper-plane',
                    'library' => 'fa-regular',
                ],
                'condition'        => [
                    'icon_type' => 'icon',
                ],
                'label_block'      => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label'       => esc_html__( 'Image Icon', 'jeena-toolkit' ),
                'type'        => Controls_Manager::MEDIA,
                'render_type' => 'template',
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label'       => esc_html__( 'Title', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your box title', 'jeena-toolkit' ),
                'default'     => esc_html__( 'Awards Winning Company', 'jeena-toolkit' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_link',
            [
                'label'        => esc_html__( 'Title Link', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'title_link_url',
            [
                'label'       => esc_html__( 'Title Link URL', 'jeena-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'condition'   => [
                    'title_link' => 'yes',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__( 'Description', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'With over 20 years of experience, we work to provide better service to our customers.', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Enter your description', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'      => esc_html__( 'Icon Position', 'jeena-toolkit' ),
                'type'       => Controls_Manager::CHOOSE,
                'separator'  => 'before',
                'default'    => 'top',
                'options'    => [
                    'left'  => [
                        'title' => esc_html__( 'Left', 'jeena-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'top'   => [
                        'title' => esc_html__( 'Top', 'jeena-toolkit' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'jeena-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'    => 'top',
                'toggle'     => false,
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'selected_icon[value]',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                        [
                            'name'     => 'image[url]',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'icon_inline',
            [
                'label'     => esc_html__( 'Icon Inline', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'icon_position' => ['left', 'right'],
                ],
            ]
        );

        $this->add_control(
            'icon_vertical_alignment',
            [
                'label'     => esc_html__( 'Icon Vertical Alignment', 'jeena-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'jeena-toolkit' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Middle', 'jeena-toolkit' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__( 'Bottom', 'jeena-toolkit' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => false,
                'condition' => [
                    'icon_position' => ['left', 'right'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box'            => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .jeena-info-box .box-title' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label'   => esc_html__( 'Alignment', 'jeena-toolkit' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left'   => [
                        'title' => esc_html__( 'Left', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'text-right'  => [
                        'title' => esc_html__( 'Right', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'toggle'      => false,
                'default' => 'text-left',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_read_more',
            [
                'label'     => esc_html( 'Read More', 'jeena-toolkit' ),
                'condition' => [
                    'read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label'       => esc_html__( 'Text', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Read More', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Read More', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'read_more_link',
            [
                'label'       => esc_html__( 'Link to', 'jeena-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'jeena-toolkit' ),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'read_more_icon',
            [
                'label'            => esc_html__( 'Icon', 'jeena-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fas fa-long-arrow-right',
                    'library' => 'fa-solid',
                ],
                'fa4compatibility' => 'read_more_icon_f4',
            ]
        );

        $this->add_control(
            'read_more_icon_align',
            [
                'label'     => esc_html__( 'Icon Position', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'right',
                'options'   => [
                    'left'  => esc_html__( 'Left', 'jeena-toolkit' ),
                    'right' => esc_html__( 'Right', 'jeena-toolkit' ),
                ],
                'condition' => [
                    'read_more_icon[value]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_badge',
            [
                'label'     => esc_html__( 'Badge', 'jeena-toolkit' ),
                'condition' => [
                    'badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label'       => esc_html__( 'Badge Text', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'POPULAR', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Type Badge Title', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'badge_position',
            [
                'label'   => esc_html__( 'Position', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top-right',
                'options' => [
                    'top-right'    => esc_html__( 'Top Right', 'jeena-toolkit' ),
                    'top-left'     => esc_html__( 'Top Left', 'jeena-toolkit' ),
                    'bottom-right' => esc_html__( 'Bottom Right', 'jeena-toolkit' ),
                    'bottom-left'  => esc_html__( 'Bottom Left', 'jeena-toolkit' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_horizontal_offset',
            [
                'label'     => esc_html__( 'Horizontal Offset', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box' => '--badge-h-offset: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_vertical_offset',
            [
                'label'     => esc_html__( 'Vertical Offset', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box ' => '--badge-v-offset: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_rotate',
            [
                'label'     => esc_html__( 'Rotate', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box ' => '--badge-rotate: {{SIZE}}deg;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_info_box',
            [
                'label' => esc_html__( 'Info Box', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'info_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'info_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-info-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'info_box_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-info-box',
            ]
        );

        $this->add_responsive_control(
            'info_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-info-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'info_box_tab' );

        $this->start_controls_tab(
            'info_box_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'info_box_bg',
                'selector' => '{{WRAPPER}} .jeena-info-box',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'info_box_shadow',
                'selector' => '{{WRAPPER}} .jeena-info-box',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'info_box_hover',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'info_box_hover_bg',
                'selector' => '{{WRAPPER}} .jeena-info-box::before',
            ]
        );

        $this->add_control(
            'info_box_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'info_box_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'info_box_hover_shadow',
                'selector' => '{{WRAPPER}} .jeena-info-box:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label'      => esc_html__( 'Icon/Image', 'jeena-toolkit' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'selected_icon[value]',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                        [
                            'name'     => 'image[url]',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-info-box .box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'icon_typography',
                'selector'  => '{{WRAPPER}} .jeena-info-box .box-icon',
                'condition' => [
                    'icon_type!' => 'image',
                ],
                'label'     => esc_html__( 'Icon Size', 'jeena-toolkit' ),
                'exclude'   => [
                    'font_family',
                    'letter_spacing',
                    'word_spacing',
                    'font_style',
                    'text_transform',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_img_width',
            [
                'label'      => esc_html__( 'Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'vh', 'vw'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-info-box .box-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_img_height',
            [
                'label'      => esc_html__( 'Height', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'vh', 'vw'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-info-box .box-icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label'     => esc_html__( 'Spacing', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box ' => '--icon-space: {{SIZE}}px;',
                ],
            ]
        );

        $this->start_controls_tabs( 'icon_tabs' );

        $this->start_controls_tab(
            'icon_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .box-icon'       => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon_background',
            [
                'label'     => esc_html__( 'Icon Background', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .box-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'icon_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-info-box .box-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-info-box .box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-info-box .box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .jeena-info-box .box-icon',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box:hover .box-icon'       => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_bg',
            [
                'label'     => esc_html__( 'Icon Background', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box:hover .box-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box:hover .box-icon' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_border_border!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_hover_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .jeena-info-box:hover .box-icon'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-info-box:hover .box-icon mg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_hover_shadow',
                'selector' => '{{WRAPPER}} .jeena-info-box:hover .box-icon',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'tabs-content_style' );

        $this->start_controls_tab(
            'tab_content_style_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
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
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .jeena-info-box .box-title',
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
            [
                'label'     => esc_html__( 'Spacing', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'desc_heading',
            [
                'label'     => esc_html__( 'Description', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'selector' => '{{WRAPPER}} .jeena-info-box .description',
            ]
        );

        $this->add_responsive_control(
            'desc_bottom_space',
            [
                'label'     => esc_html__( 'Spacing', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_content_style_hover',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'title_hover_heading',
            [
                'label' => esc_html__( 'Title', 'jeena-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box:hover .box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_hover_heading',
            [
                'label'     => esc_html__( 'Description', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'desc_hover_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box:hover .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_read_more',
            [
                'label'     => esc_html__( 'Read More', 'jeena-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'read_more' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_padding',
            [
                'label'      => __( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-info-box .read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_top_space',
            [
                'label'     => esc_html__( 'Spacing', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .read-more' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_space',
            [
                'label'     => esc_html__( 'Icon Spacing', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .read-more.icon-left i'    => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-info-box .read-more.icon-left svg'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-info-box .read-more.icon-right i'   => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-info-box .read-more.icon-right svg' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'read_more_typography',
                'selector' => '{{WRAPPER}} .jeena-info-box .read-more span',
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .read-more i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-info-box .read-more svg' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_read_more_style' );

        $this->start_controls_tab(
            'tab_read_more_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'read_more_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .read-more'     => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .read-more' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'read_more_border',
                'placeholder' => '0',
                'separator'   => 'before',
                'selector'    => '{{WRAPPER}} .jeena-info-box .read-more',
            ]
        );

        $this->add_responsive_control(
            'read_more_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .jeena-info-box .read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'read_more_shadow',
                'selector' => '{{WRAPPER}} .jeena-info-box .read-more',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_read_more_hover',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'read_more_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box:hover .read-more'     => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box:hover .read-more' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box:hover .read-more' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'read_more_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'read_more_hover_shadow',
                'selector' => '{{WRAPPER}} .jeena-info-box:hover .read-more',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_badge',
            [
                'label'     => esc_html__( 'Badge', 'jeena-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'badge_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .box-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-info-box .box-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'badge_border',
                'placeholder' => '0',
                'separator'   => 'before',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-info-box .box-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .jeena-info-box .box-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'badge_shadow',
                'selector' => '{{WRAPPER}} .jeena-info-box .box-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-info-box .box-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typography',
                'selector' => '{{WRAPPER}} .jeena-info-box .box-badge',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Icon
     *
     * @return void
     */
    protected function render_icon( $icon_inline = false ) {
        $settings = $this->get_settings_for_display();

        $has_icon = ! empty( $settings['icon'] );
        $has_image = ! empty( $settings['image']['url'] );

        if ( $has_icon && 'icon' == $settings['icon_type'] ) {
            $this->add_render_attribute( 'font-icon', 'class', $settings['selected_icon'] );
            $this->add_render_attribute( 'font-icon', 'aria-hidden', 'true' );
        } elseif ( $has_image && 'image' == $settings['icon_type'] ) {
            $this->add_render_attribute( 'image-icon', 'src', $settings['image']['url'] );
            $this->add_render_attribute( 'image-icon', 'alt', $settings['title_text'] );
        }

        if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
            $has_icon = true;
        }

        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        if ( $icon_inline ) {
            $wrapper_tag = 'span';
        } else {
            $wrapper_tag = 'div';
        }

        if ( $has_icon || $has_image ): ?>
        <<?php echo jt_escape_tags( $wrapper_tag ) ?> class="box-icon">
            <?php if ( $has_icon and 'icon' == $settings['icon_type'] ): ?>
                <?php if ( $is_new || $migrated ): ?>
                    <?php Icons_Manager::render_icon( $settings['selected_icon'], ['aria-hidden' => 'true'] );?>
                <?php else: ?>
                    <i <?php echo $this->get_render_attribute_string( 'font-icon' ); ?>></i>
                <?php endif;?>
            <?php elseif ( $has_image and 'image' == $settings['icon_type'] ): ?>
                <img <?php echo $this->get_render_attribute_string( 'image-icon' ); ?>>
            <?php endif;?>
        </<?php echo jt_escape_tags( $wrapper_tag ) ?>>
        <?php endif;
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
        $wrapper_class = 'jeena-info-box ' . $settings['text_align'] . ' icon-' . $settings['icon_position'];
        ?>
        <div class="<?php echo esc_attr( $wrapper_class ) ?>">
            <?php if ( 'yes' !== $settings['icon_inline'] ) {
                $this->render_icon();
            }?>
            <div class="box-content">
                <?php if ( ! empty( $settings['title_text'] ) ) : ?>
                    <<?php echo jt_escape_tags( $settings['title_tag'], 'h4' ) ?> class="box-title">
                        <?php
                            if ( 'yes' === $settings['icon_inline'] && 'top' !== $settings['icon_position'] ) {
                                $this->render_icon( true );
                            }
                            if ( ! empty( $settings['title_text'] ) ) {
                                $this->add_inline_editing_attributes( 'title_text', 'none' );
                                $this->add_render_attribute( 'title_text', 'class', 'title-text' );

                                if ( 'yes' == $settings['title_link'] && ! empty( $settings['title_link_url']['url'] ) ) {
                                    $this->add_link_attributes( 'title_text', $settings['title_link_url'] );

                                    printf( '<a %1$s>%2$s</a>',
                                        $this->get_render_attribute_string( 'title_text' ),
                                        jt_kses_basic( $settings['title_text'] )
                                    );
                                } else {
                                    printf( '<span %1$s>%2$s</span>',
                                        $this->get_render_attribute_string( 'title_text' ),
                                        wp_kses_post( $settings['title_text'] )
                                    );
                                }
                            }
                        ?>
                    </<?php echo jt_escape_tags( $settings['title_tag'], 'h4' ) ?>>
                <?php endif; ?>
                <?php
                    if ( ! empty( $settings['description_text'] ) ) {
                        $this->add_render_attribute( 'description_text', 'class', 'description' );
                        $this->add_inline_editing_attributes( 'description_text', 'basic' );

                        printf( '<p %1$s>%2$s</p>',
                            $this->get_render_attribute_string( 'description_text' ),
                            jt_kses_basic( $settings['description_text'] )
                        );
                    }

                    if ( 'yes' === $settings['read_more'] && $settings['read_more_link']['url'] ) :
                        $this->add_render_attribute( 'read_more', 'class', 'read-more' );
                        $this->add_render_attribute( 'read_more', 'class', 'icon-' . $settings['read_more_icon_align'] );
                        $this->add_inline_editing_attributes( 'read_more_text', 'none' );

                        if ( ! empty( $settings['read_more_link']['url'] ) ) {
                            $this->add_link_attributes( 'read_more', $settings['read_more_link'] );
                        }

                        $read_more_migrated  = isset( $settings['__fa4_migrated']['read_more_icon'] );
                        $read_more_is_new    = empty( $settings['read_more_icon_f4'] ) && Icons_Manager::is_migration_allowed();
                        ?>
                        <a <?php echo $this->get_render_attribute_string( 'read_more' ); ?>>
                            <span <?php echo $this->get_render_attribute_string( 'read_more_text' ) ?>><?php echo esc_html( $settings['read_more_text'] ); ?></span>
                            <?php
                                if ( $read_more_is_new || $read_more_migrated  ) {
                                    Icons_Manager::render_icon( $settings['read_more_icon'], ['aria-hidden' => 'true'] );
                                } else {
                                    echo '<i class=" '. esc_attr( $settings['read_more_icon_f4'] ) .' "></i>';
                                }
                            ?>
                        </a>
                        <?php
                    endif;
                ?>
            </div>
            <?php if ( 'yes' === $settings['badge'] && '' != $settings['badge_text'] ) : ?>
            <div class="box-badge badge-<?php echo esc_attr( $settings['badge_position'] ); ?>">
                <?php echo esc_html( $settings['badge_text'] ); ?>
            </div>
            <?php endif; ?>
            <?php
                if ( ! Plugin::$instance->editor->is_edit_mode() && 'yes' === $settings['wrapper_link'] ) {
                    $this->add_render_attribute( 'wrapper_link', 'class', 'box-wrapper-link' );
                    $this->add_link_attributes( 'wrapper_link', $settings['wrapper_link_url'] );

                    printf( '<a %1$s></a>',
                        $this->get_render_attribute_string( 'wrapper_link' )
                    );
                }
            ?>
        </div>
        <?php
    }

    /**
     * Render heading widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );
            var migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' );
            var wrapper_class = 'jeena-info-box ' + settings.text_align + ' icon-' + settings.icon_position;
        #>
        <div class="{{{ wrapper_class }}}">
            <# if ( 'top' == settings.icon_position || 'yes' != settings.icon_inline ) { #>
                <# if (( settings.image.url && settings.icon_type == 'image' ) || ( settings.icon  && settings.icon_type == 'icon' ) || ( settings.selected_icon.value  && settings.icon_type == 'icon' )) { #>
                <div class="box-icon">
                    <# if ( settings.image.url && settings.icon_type == 'image' ) { #>
                        <img src="{{{settings.image.url}}}" alt="{{{ settings.title_text }}}">
                    <# } else if ( settings.selected_icon.value  && settings.icon_type == 'icon' ) { #>
                        <# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
                            {{{ iconHTML.value }}}
                        <# } else { #>
                            <i class="{{ settings.icon }}" aria-hidden="true"></i>
                        <# } #>
                    <# } #>
                </div>
                <# } #>
            <# } #>
            <div class="box-content">
                <# if ( settings.title_text ) { #>
                    <{{{settings.title_tag}}} class="box-title">
                        <# if ( 'yes' == settings.icon_inline && 'top' != settings.icon_position ) { #>
                            <# if (( settings.image.url && settings.icon_type == 'image' ) || ( settings.icon  && settings.icon_type == 'icon' ) || ( settings.selected_icon.value  && settings.icon_type == 'icon' )) { #>
                            <span class="box-icon">
                                <# if ( settings.image.url && settings.icon_type == 'image' ) { #>
                                    <img src="{{{settings.image.url}}}" alt="{{{ settings.title_text }}}">
                                <# } else if ( settings.selected_icon.value  && settings.icon_type == 'icon' ) { #>
                                    <# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
                                        {{{ iconHTML.value }}}
                                    <# } else { #>
                                        <i class="{{ settings.icon }}" aria-hidden="true"></i>
                                    <# } #>
                                <# } #>
                            </span>
                            <# } #>
                        <# } #>
                        <#
                            view.addInlineEditingAttributes( 'title_text', 'none' );
                            view.addRenderAttribute( 'title_text', 'class', 'title-text' );

                            if( 'yes' == settings.title_link && settings.title_link_url ) {
                                view.addRenderAttribute( 'title_text', 'href', settings.title_link_url.url );

                                var title_html = '<a ' + view.getRenderAttributeString( 'title_text' ) + '>' + settings.title_text + '</a>';
                                print( title_html );
                            } else {
                                var title_html = '<span ' + view.getRenderAttributeString( 'title_text' ) + '>' + settings.title_text + '</span>';
                                print( title_html );
                            }
                        #>
                    </{{{settings.title_tag}}}>
                <# } #>
                <# if ( settings.description_text ) {
                    view.addRenderAttribute( 'description_text', 'class', 'description' );
                    view.addInlineEditingAttributes( 'description_text', 'basic' ); #>
                    <p {{{ view.getRenderAttributeString('description_text') }}}>
                        {{{ settings.description_text }}}
                    </p>
                <# } #>
                <# if ( 'yes' == settings['read_more'] && settings.read_more_link.url ) {
                    view.addRenderAttribute( 'read_more', 'class', 'read-more' );
                    view.addRenderAttribute( 'read_more', 'class', 'icon-' + settings.read_more_icon_align );
                    view.addRenderAttribute( 'read_more', 'href', settings.read_more_link.url );
                    view.addInlineEditingAttributes( 'read_more_text', 'none' );

                    var iconHTMLMore = elementor.helpers.renderIcon( view, settings.read_more_icon, { 'aria-hidden': true }, 'i' , 'object' );
                    var migratedMore = elementor.helpers.isIconMigrated( settings, 'read_more_icon' ); #>
                    <a {{{ view.getRenderAttributeString('read_more') }}}>
                        <span {{{ view.getRenderAttributeString('read_more_text') }}}>{{{ settings.read_more_text }}}</span>
                        <# if ( iconHTMLMore && iconHTMLMore.rendered && ( ! settings.read_more_icon_f4 || migratedMore ) ) { #>
                            {{{ iconHTMLMore.value }}}
                        <# } else { #>
                            <i class="{{ settings.read_more_icon_f4 }}" aria-hidden="true"></i>
                        <# } #>
                    </a>
                <# } #>
            </div>
            <# if ( 'yes' === settings.badge && settings.badge_text != '' ) { #>
            <div class="box-badge badge-{{{settings.badge_position}}}">
                {{{settings.badge_text}}}
            </div>
            <# } #>
        </div>
        <?php
    }
}