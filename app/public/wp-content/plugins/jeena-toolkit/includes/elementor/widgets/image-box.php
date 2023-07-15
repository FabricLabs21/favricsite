<?php
namespace JeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Image_Box extends Widget_Base {

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
        return 'jeena-image-box';
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
        return esc_html__( 'Image Box', 'jeena-toolkit' );
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
        return 'eicon-image-box webtend-logo';
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
        return ['jeena', 'toolkit', 'image', 'icon', 'box', 'service'];
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
            'layout',
            [
                'label'   => esc_html__( 'Layout', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'layout-one'   => esc_html__( 'Layout One', 'jeena-toolkit' ),
                    'layout-two'   => esc_html__( 'Layout Two', 'jeena-toolkit' ),
                    'layout-three' => esc_html__( 'Layout Three', 'jeena-toolkit' ),
                ],
                'default' => 'layout-one',
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
                'default'     => 'h3',
                'toggle'      => false,
            ]
        );

        $this->add_control(
            'read_more',
            [
                'label'        => esc_html__( 'Read More Button', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label'        => esc_html__( 'Show Icon', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image',
            [
                'label' => esc_html__( 'Image', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => esc_html__( 'Select Image', 'jeena-toolkit' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'thumbnail',
                'default' => 'medium_large',
                'exclude' => [
                    'custom',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label'     => esc_html__( 'Icon Type', 'jeena-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'toggle'    => false,
                'default'   => 'icon',
                'options'   => [
                    'icon'  => [
                        'title' => esc_html__( 'Icon', 'jeena-toolkit' ),
                        'icon'  => 'fas fa-star',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'jeena-toolkit' ),
                        'icon'  => 'far fa-image',
                    ],
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label'            => esc_html__( 'Icon', 'jeena-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'selected_icon_f4',
                'default'          => [
                    'value'   => 'far fa-smile-wink',
                    'library' => 'fa-regular',
                ],
                'condition'        => [
                    'icon_type' => 'icon',
                    'show_icon' => 'yes',
                ],
                'label_block'      => true,
            ]
        );

        $this->add_control(
            'selected_image',
            [
                'label'       => esc_html__( 'Image Icon', 'jeena-toolkit' ),
                'type'        => Controls_Manager::MEDIA,
                'render_type' => 'template',
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'icon_type' => 'image',
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label'       => esc_html__( 'Title', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your box title', 'jeena-toolkit' ),
                'default'     => esc_html__( 'Web Design & Development', 'jeena-toolkit' ),
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
                'default'     => esc_html__( 'With over 20 years of experience and 850+ employees board for services', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Enter your description', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'box_index',
            [
                'label'   => esc_html__( 'Box Index', 'jeena-toolkit' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '01',
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
                'default'     => esc_html__( 'View Details', 'jeena-toolkit' ),
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
                    'value'   => 'far fa-long-arrow-right',
                    'library' => 'fa-regular',
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
            'section_style_image_box',
            [
                'label' => esc_html__( 'Image Box', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label'     => esc_html__( 'Alignment', 'jeena-toolkit' ),
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
                'toggle'    => false,
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_heading_heading',
            [
                'label'     => esc_html__( 'Content Area', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-box .box-content'                  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-image-box.layout-three .box-content-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-box .box-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'content_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-image-box .box-content',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-box .box-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'content_tab' );

        $this->start_controls_tab(
            'content_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'content_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box .box-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_shadow',
                'selector' => '{{WRAPPER}} .jeena-image-box .box-content',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_hover',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'content_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box:hover .box-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box:hover .box-content' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'content_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_hover_shadow',
                'selector' => '{{WRAPPER}} .jeena-image-box:hover .box-content',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image_style',
            [
                'label' => esc_html__( 'Image', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'      => esc_html__( 'Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-box .box-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'      => esc_html__( 'Height', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-box .box-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_popover_toggle',
            [
                'label'        => esc_html__( 'Object', 'textdomain' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => esc_html__( 'Default', 'textdomain' ),
                'label_on'     => esc_html__( 'Custom', 'textdomain' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'separator'    => 'before',
            ]
        );

        $this->start_popover();

        $this->add_control(
            'img_fit',
            [
                'label'     => esc_html__( 'Fit', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''           => esc_html__( 'Default', 'jeena-toolkit' ),
                    'cover'      => esc_html__( 'Cover', 'jeena-toolkit' ),
                    'fill'       => esc_html__( 'Fill', 'jeena-toolkit' ),
                    'contain'    => esc_html__( 'Contain', 'jeena-toolkit' ),
                    'none'       => esc_html__( 'None', 'jeena-toolkit' ),
                    'scale-down' => esc_html__( 'Scale Down', 'jeena-toolkit' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box .box-image img' => 'object-fit: {{VALUE}};',
                ],
                'condition' => [
                    'image_popover_toggle' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'img_position',
            [
                'label'     => esc_html__( 'Position', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''       => esc_html__( 'Default', 'jeena-toolkit' ),
                    'top'    => esc_html__( 'Top', 'jeena-toolkit' ),
                    'bottom' => esc_html__( 'Bottom', 'jeena-toolkit' ),
                    'left'   => esc_html__( 'left', 'jeena-toolkit' ),
                    'right'  => esc_html__( 'Right', 'jeena-toolkit' ),
                    'center' => esc_html__( 'Center', 'jeena-toolkit' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box .box-image img' => 'object-position: {{VALUE}};',
                ],
                'condition' => [
                    'image_popover_toggle' => 'yes',
                ],
            ]
        );

        $this->end_popover();

        $this->add_control(
            'overly_popover_toggle',
            [
                'label'        => esc_html__( 'Overly', 'textdomain' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => esc_html__( 'Default', 'textdomain' ),
                'label_on'     => esc_html__( 'Custom', 'textdomain' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->start_popover();

        $this->add_control(
            'image_overly_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box .box-image::before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'overly_popover_toggle' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
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
                    '{{WRAPPER}} .jeena-image-box:hover .box-image::before' => 'opacity: {{SIZE}};',
                ],
                'condition'  => [
                    'overly_popover_toggle' => 'yes',
                ],
            ]
        );

        $this->end_popover();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_desc',
            [
                'label' => esc_html__( 'Title/Description', 'jeena-toolkit' ),
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .jeena-image-box .title',
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
                    '{{WRAPPER}} .jeena-image-box .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'selector' => '{{WRAPPER}} .jeena-image-box .description',
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
                    '{{WRAPPER}} .jeena-image-box .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_index_heading',
            [
                'label'     => esc_html__( 'Box Index', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'index_typography',
                'selector' => '{{WRAPPER}} .jeena-image-box .box-index',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'     => 'index_stroke',
                'selector' => '{{WRAPPER}} .jeena-image-box .box-index',
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
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Description Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box .description' => 'color: {{VALUE}};',
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
            'title_hover_color',
            [
                'label'     => esc_html__( 'Title Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box:hover .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_hover_color',
            [
                'label'     => esc_html__( 'Description Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box:hover .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'index_hover_color',
            [
                'label'     => esc_html__( 'Index Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box .box-index' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
                ],
                'condition' => [
                    'layout' => 'layout-two',
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
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-box .read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jeena-image-box .read-more' => 'margin-top: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .jeena-image-box .read-more.icon-left i'    => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-image-box .read-more.icon-left svg'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-image-box .read-more.icon-right i'   => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-image-box .read-more.icon-right svg' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'read_more_typography',
                'selector' => '{{WRAPPER}} .jeena-image-box .read-more span',
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
                    '{{WRAPPER}} .jeena-image-box .read-more i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'read_more_border',
                'placeholder' => '0',
                'separator'   => 'before',
                'selector'    => '{{WRAPPER}} .jeena-image-box .read-more',
            ]
        );

        $this->add_responsive_control(
            'read_more_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-box .read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jeena-image-box .read-more'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .jeena-image-box .read-more svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box .read-more' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'read_more_shadow',
                'selector' => '{{WRAPPER}} .jeena-image-box .read-more',
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
                    '{{WRAPPER}} .jeena-image-box:hover .read-more'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .jeena-image-box:hover .read-more svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box:hover .read-more' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-box:hover .read-more' => 'border-color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .jeena-image-box:hover .read-more',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label'     => esc_html__( 'Icon', 'jeena-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_popover_toggle',
            [
                'label'     => esc_html__( 'Size', 'textdomain' ),
                'type'      => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'Default', 'textdomain' ),
                'label_on'  => esc_html__( 'Custom', 'textdomain' ),
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Width/Height', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-box .box-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_font_size',
            [
                'label'      => esc_html__( 'Font Size', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-box .box-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_icon_size',
            [
                'label'      => esc_html__( 'Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-box .box-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->end_popover();

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
                    '{{WRAPPER}} .jeena-image-box .box-icon' => 'margin-bottom: {{SIZE}}px;',
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
                    '{{WRAPPER}} .jeena-image-box .box-icon'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .jeena-image-box .box-icon svg *' => 'fill: {{VALUE}};',
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
                    '{{WRAPPER}} .jeena-image-box .box-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'icon_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-image-box .box-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-box .box-icon'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-image-box .box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .jeena-image-box .box-icon',
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
                    '{{WRAPPER}} .jeena-image-box:hover .box-icon'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .jeena-image-box:hover .box-icon svg *' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .jeena-image-box:hover .box-icon' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .jeena-image-box:hover .box-icon' => 'border-color: {{VALUE}};',
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
                    '{{WRAPPER}} .jeena-image-box:hover .box-icon'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-image-box:hover .box-icon mg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_hover_shadow',
                'selector' => '{{WRAPPER}} .jeena-image-box:hover .box-icon',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render Icon
     *
     * @return void
     */
    protected function render_icon() {
        $settings = $this->get_settings_for_display();

        $has_icon  = ! empty( $settings['selected_icon_f4'] );
        $has_image = ! empty( $settings['selected_image']['url'] );

        if ( $has_image && 'image' == $settings['icon_type'] ) {
            $this->add_render_attribute( 'image-icon', 'src', $settings['selected_image']['url'] );
            $this->add_render_attribute( 'image-icon', 'alt', $settings['title_text'] );
        }

        if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
            $has_icon = true;
        }

        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new   = empty( $settings['selected_icon_f4'] ) && Icons_Manager::is_migration_allowed();

        if ( $has_icon || $has_image ): ?>
        <div class="box-icon">
            <?php if ( $has_icon and 'icon' == $settings['icon_type'] ): ?>
                <?php if ( $is_new || $migrated ): ?>
                    <?php Icons_Manager::render_icon( $settings['selected_icon'], ['aria-hidden' => 'true'] );?>
                <?php else: ?>
                    <i class="<?php echo esc_attr( $settings['selected_icon_f4'] ) ?>"></i>
                <?php endif;?>
            <?php elseif ( $has_image and 'image' == $settings['icon_type'] ): ?>
                <img <?php echo $this->get_render_attribute_string( 'image-icon' ); ?>>
            <?php endif;?>
        </div>
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
    protected function render() {
        $settings = $this->get_settings_for_display();
        $wrapper_class = 'jeena-image-box ' . $settings['layout'];
        ?>
        <div class="<?php echo esc_attr( $wrapper_class ) ?>">
            <?php if ( $settings['image'] ) : ?>
            <div class="box-image">
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' )?>
            </div>
            <?php endif; ?>
            <div class="box-content">
                <?php
                    if ( 'yes' === $settings['show_icon'] ) {
                        $this->render_icon();
                    }
                    if ( ! empty( $settings['title_text'] ) ) {
                        $this->add_inline_editing_attributes( 'title_text', 'none' );
                        $this->add_render_attribute( 'title_text', 'class', 'title-text' );

                        if ( 'yes' == $settings['title_link'] && ! empty( $settings['title_link_url']['url'] ) ) {
                            $this->add_link_attributes( 'title_text', $settings['title_link_url'] );

                            printf( '<%1$s class="title"><a %2$s>%3$s</a></%1$s>',
                                jt_escape_tags( $settings['title_tag'], 'h4' ),
                                $this->get_render_attribute_string( 'title_text' ),
                                jt_kses_basic( $settings['title_text'] )
                            );
                        } else {
                            printf( '<%1$s class="title"><span %2$s>%3$s</span></%1$s>',
                                jt_escape_tags( $settings['title_tag'], 'h4' ),
                                $this->get_render_attribute_string( 'title_text' ),
                                wp_kses_post( $settings['title_text'] )
                            );
                        }
                    }

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
                    if ( ! empty( $settings['box_index'] ) ) {
                        printf( '<span class="box-index">%1$s</span>',
                            esc_html( $settings['box_index'] )
                        );
                    }
                ?>
            </div>
            <?php if ( 'layout-three' === $settings['layout'] ) : ?>
                <div class="box-content-two">
                    <?php
                        if ( 'yes' === $settings['show_icon'] ) {
                            $this->render_icon();
                        }
                        if ( ! empty( $settings['title_text'] ) ) {
                            printf( '<%1$s class="title"><span %2$s>%3$s</span></%1$s>',
                                jt_escape_tags( $settings['title_tag'], 'h4' ),
                                $this->get_render_attribute_string( 'title_text' ),
                                wp_kses_post( $settings['title_text'] )
                            );
                        }
                    ?>
                </div>
            <?php endif; ?>
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
            var wrapper_class = 'jeena-image-box ' + settings.layout;

            view.addInlineEditingAttributes( 'title_text', 'none' );
            view.addRenderAttribute( 'title_text', 'class', 'title-text' );

            if( 'yes' == settings.title_link && settings.title_link_url ) {
                view.addRenderAttribute( 'title_text', 'href', settings.title_link_url.url );

                var title_html = '<a ' + view.getRenderAttributeString( 'title_text' ) + '>' + settings.title_text + '</a>';
            } else {
                var title_html = '<span ' + view.getRenderAttributeString( 'title_text' ) + '>' + settings.title_text + '</span>';
            }
        #>
        <div class="{{{ wrapper_class }}}">
            <# if ( settings.image ) { #>
            <div class="box-image">
                <#
                var image = {
                    id: settings.image.id,
                    url: settings.image.url,
                    size: settings.thumbnail_size,
                };
                var image_url = elementor.imagesManager.getImageUrl( image );
                #>
                <img src="{{{ image_url }}}" />
            </div>
            <# } #>
            <div class="box-content">
                <# if ( 'yes' == settings.show_icon ) { #>
                <div class="box-icon">
                    <# if ( settings.selected_image.url && settings.icon_type == 'image' ) { #>
                        <img src="{{{settings.selected_image.url}}}" alt="{{{ settings.title_text }}}">
                    <# } else if ( settings.selected_icon.value  && settings.icon_type == 'icon' ) { #>
                        <# if ( iconHTML && iconHTML.rendered && ( ! settings.selected_icon_f4 || migrated ) ) { #>
                            {{{ iconHTML.value }}}
                        <# } else { #>
                            <i class="{{ settings.selected_icon_f4 }}" aria-hidden="true"></i>
                        <# } #>
                    <# } #>
                </div>
                <# } #>
                <# if ( settings.title_text ) { #>
                    <{{{settings.title_tag}}} class="title">
                        <# print( title_html ); #>
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
                <# if ( settings.box_index ) { #>
                    <span class="box-index">{{{ settings.box_index }}}</span>
                <# } #>
            </div>
            <# if ( 'layout-three' == settings.layout ) { #>
                <div class="box-content-two">
                <# if ( 'yes' == settings.show_icon ) { #>
                    <div class="box-icon">
                        <# if ( settings.selected_image.url && settings.icon_type == 'image' ) { #>
                            <img src="{{{settings.selected_image.url}}}" alt="{{{ settings.title_text }}}">
                        <# } else if ( settings.selected_icon.value  && settings.icon_type == 'icon' ) { #>
                            <# if ( iconHTML && iconHTML.rendered && ( ! settings.selected_icon_f4 || migrated ) ) { #>
                                {{{ iconHTML.value }}}
                            <# } else { #>
                                <i class="{{ settings.selected_icon_f4 }}" aria-hidden="true"></i>
                            <# } #>
                        <# } #>
                    </div>
                    <# } #>
                    <# if ( settings.title_text ) { #>
                        <{{{settings.title_tag}}} class="title">
                            <# print( title_html ); #>
                        </{{{settings.title_tag}}}>
                    <# } #>
                </div>
            <# } #>
        </div>
        <?php
    }
}