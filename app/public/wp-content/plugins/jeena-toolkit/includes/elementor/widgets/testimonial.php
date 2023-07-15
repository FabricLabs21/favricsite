<?php
namespace JeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Testimonial extends Widget_Base {

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
        return 'jeena-testimonial';
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
        return esc_html__( 'Testimonial', 'jeena-toolkit' );
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
        return 'eicon-testimonial-carousel webtend-logo';
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
        return ['jeena', 'toolkit', 'testimonial', 'carousel', 'slider'];
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
            'section_testimonial',
            [
                'label' => esc_html__( 'Testimonial', 'jeena-toolkit' ),
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
            'title',
            [
                'label'       => esc_html__( 'Title', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Simple Title', 'jeena-toolkit' ),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'       => esc_html__( 'Content', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => '6',
                'placeholder' => esc_html__( 'Enter Content', 'jeena-toolkit' ),
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label'       => esc_html__( 'Name', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter Name', 'jeena-toolkit' ),
            ]
        );

        $repeater->add_control(
            'position',
            [
                'label'       => esc_html__( 'Position', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter Position', 'jeena-toolkit' ),
            ]
        );

        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__( 'Rating', 'jeena-toolkit' ),
                'type'  => Controls_Manager::NUMBER,
                'min'   => 0,
                'max'   => 10,
                'step'  => 0.1,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label'   => esc_html__( 'Image', 'jeena-toolkit' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'testimonial_items',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'label'       => esc_html__( 'Items', 'jeena-toolkit' ),
                'title_field' => '{{{ name }}}',
                'default'     => [
                    [
                        'title'       => esc_html__( 'Excellent Works', 'jeena-toolkit' ),
                        'description' => esc_html__( 'Sed ut perspiciatis unde omnis iste natus voluptatem accus antiume dolorem queauy antium totam aperiam eaque quaey abillosa inventore veritatis etuarchite.', 'jeena-toolkit' ),
                        'name'        => esc_html__( 'Andrew D.Bricker', 'jeena-toolkit' ),
                        'position'    => esc_html__( 'CEO & Founder', 'jeena-toolkit' ),
                        'rating'      => '4.5',
                        'image'       => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'title'       => esc_html__( 'Excellent Works', 'jeena-toolkit' ),
                        'description' => esc_html__( 'On the other hand denounce righteous indignations and dislike men who beguiled and demoralized by the charms of pleasure moment blinded foresee.', 'jeena-toolkit' ),
                        'name'        => esc_html__( 'Jose T.McMichael', 'jeena-toolkit' ),
                        'position'    => esc_html__( 'Senior Manager', 'jeena-toolkit' ),
                        'rating'      => '4.5',
                        'image'       => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'show_quote_icon',
            [
                'type'      => Controls_Manager::SWITCHER,
                'label'     => esc_html__( 'Show Quote Icon?', 'jeena-toolkit' ),
                'default'   => 'yes',
                'label_off' => esc_html__( 'Hide', 'jeena-toolkit' ),
                'label_on'  => esc_html__( 'Show', 'jeena-toolkit' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'quote_icon',
            [
                'type'      => Controls_Manager::ICONS,
                'label'     => esc_html__( 'Quote Icon', 'jeena-toolkit' ),
                'default'   => [
                    'value'   => 'flaticon flaticon-quotation',
                    'library' => 'jeena-flaticon',
                ],
                'condition' => [
                    'show_quote_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image_position',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Image Position', 'jeena-toolkit' ),
                'options' => [
                    'image-top'   => esc_html__( 'Top', 'jeena-toolkit' ),
                    'image-left'  => esc_html__( 'Left', 'jeena-toolkit' ),
                    'image-right' => esc_html__( 'Right', 'jeena-toolkit' ),
                ],
                'default' => 'image-left',
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
                ],
                'default'              => '',
                'tablet_extra_default' => '',
                'tablet_default'       => '',
                'mobile_default'       => '',
                'condition'            => [
                    'layout' => 'grid',
                ],
                'selectors'            => [
                    '{{WRAPPER}} .jeena-testimonial' => 'grid-template-columns: repeat( {{VALUE}}, 1fr );',
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
                'widescreen_default'   => 2,
                'default'              => 2,
                'laptop_default'       => 2,
                'tablet_extra_default' => 1,
                'tablet_default'       => 1,
                'mobile_extra_default' => 1,
                'mobile_default'       => 1,
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
            'section_testimonial_style',
            [
                'label' => esc_html__( 'Items', 'jeena-toolkit' ),
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
                    '{{WRAPPER}} .jeena-testimonial' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .jeena-testimonial' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'box_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .testimonial-item',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .testimonial-item',
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
            'desc_heading',
            [
                'label' => esc_html__( 'Description', 'jeena-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-item .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'selector' => '{{WRAPPER}} .testimonial-item .description',
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label'     => esc_html__( 'Title', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-item .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .testimonial-item .title',
            ]
        );

        $this->add_control(
            'rating_heading',
            [
                'label'     => esc_html__( 'Rating', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'rating_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .star-rating i::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rating_color_not_active',
            [
                'label'     => esc_html__( 'Color (Not Active)', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .star-rating i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rating_size',
            [
                'label'      => esc_html__( 'Icon size', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .star-rating i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_author_style',
            [
                'label' => esc_html__( 'Author Info', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_heading',
            [
                'label' => esc_html__( 'Name', 'jeena-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author-info .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .author-info .name',
            ]
        );

        $this->add_control(
            'position_heading',
            [
                'label'     => esc_html__( 'Position', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'position_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author-info .position' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'position_typography',
                'selector' => '{{WRAPPER}} .author-info .position',
            ]
        );

        $this->add_responsive_control(
            'position_gap',
            [
                'label'      => esc_html__( 'Gap(Top)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .author-info .position' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'photo_heading',
            [
                'label'     => esc_html__( 'Photo', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'photo_size',
            [
                'label'      => esc_html__( 'Size', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-item .image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'photo_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .testimonial-item .image img',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'photo_shadow',
                'selector' => '{{WRAPPER}} .testimonial-item .image img',
            ]
        );

        $this->add_control(
            'quote_heading',
            [
                'label'     => esc_html__( 'Quote Icon', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'quote_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author-info .icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'quote_size',
            [
                'label'      => esc_html__( 'Quote Size', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .author-info .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_navigation_arrow_style',
            [
                'label'     => esc_html__( 'Navigation: Arrows', 'jeena-toolkit' ),
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
     * Print the actual stars and calculate their filling.
     *
     * Rating type is float to allow stars-count to be a fraction.
     * Floored-rating type is int, to represent the rounded-down stars count.
     * In the `for` loop, the index type is float to allow comparing with the rating value.
     *
     * @since 2.3.0
     * @access protected
     */
    protected function render_stars( $rating ) {
        $rating         = (float) $rating;
        $floored_rating = floor( $rating );
        $icon           = '&#xE934;';

        $stars_html = '';

        for ( $stars = 1.0; $stars <= 5; $stars++ ) {
            if ( $stars <= $floored_rating ) {
                $stars_html .= '<i class="star-full">' . $icon . '</i>';
            } elseif ( $floored_rating + 1 === $stars && $rating !== $floored_rating ) {
                $stars_html .= '<i class="star-' . ( $rating - $floored_rating ) * 10 . '">' . $icon . '</i>';
            } else {
                $stars_html .= '<i class="star-empty">' . $icon . '</i>';
            }
        }

        return $stars_html;
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

        if ( empty( $settings['testimonial_items'] ) ) {
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'jeena-testimonial' );

        if( 'slider' == $settings['layout'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'jeena-slider-wrapper' );
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <?php if( 'grid' == $settings['layout'] ) : ?>
                <?php
                foreach ( $settings['testimonial_items'] as $index => $item ) {
                    $this->render_single_item( $index, $item );
                }
                ?>
            <?php elseif( 'slider' == $settings['layout'] ) : ?>
            <div class="jeena-slider-active">
                <?php foreach ( $settings['testimonial_items'] as $index => $item ): ?>
                <div class="jeena-slider-item">
                    <?php $this->render_single_item( $index, $item ); ?>
                </div>
                <?php endforeach;?>
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
        $settings = $this->get_settings_for_display();
        ?>
        <div class="testimonial-item <?php echo $settings['image_position'] ?>">
            <?php if ( $item['image']['url'] || $item['image']['id'] ) : ?>
            <div class="image">
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $item, 'full', 'image' )?>
            </div>
            <?php endif; ?>
            <div class="content">
                <div class="title-rating">
                    <?php
                    if( $item['title'] ) {
                        $title_key = $this->get_repeater_setting_key( 'title', 'testimonial_items', $index );
                        $this->add_inline_editing_attributes( $title_key, 'none' );
                        $this->add_render_attribute( $title_key, 'class', 'title' );

                        printf( '<h4 %1$s>%2$s</h4>',
                            $this->get_render_attribute_string( $title_key ),
                            esc_html( $item['title'] )
                        );
                    }
                    if( $item['rating'] ) {
                        printf( '<div class="star-rating">%1$s</div>',
                            $this->render_stars( $item['rating'] )
                        );
                    }
                    ?>
                </div>
                <?php
                if( $item['description'] ) {
                    $desc_key = $this->get_repeater_setting_key( 'description', 'testimonial_items', $index );
                    $this->add_inline_editing_attributes( $desc_key, 'basic' );
                    $this->add_render_attribute( $desc_key, 'class', 'description' );

                    printf( '<p %1$s>%2$s</p>',
                        $this->get_render_attribute_string( $desc_key ),
                        jt_kses_basic( $item['description'] )
                    );
                }
                ?>
                <div class="author-info">
                    <?php if ( 'yes' == $settings['show_quote_icon'] && $settings['quote_icon'] ) : ?>
                    <div class="icon">
                        <?php Icons_Manager::render_icon( $settings['quote_icon'], ['aria-hidden' => 'true'] ) ?>
                    </div>
                    <?php endif; ?>
                    <div class="name-wrap">
                        <?php
                        if( $item['name'] ) {
                            $name_key = $this->get_repeater_setting_key( 'name', 'testimonial_items', $index );
                            $this->add_inline_editing_attributes( $name_key, 'none' );
                            $this->add_render_attribute( $name_key, 'class', 'name' );

                            printf( '<h4 %1$s>%2$s</h4>',
                                $this->get_render_attribute_string( $name_key ),
                                esc_html( $item['name'] )
                            );
                        }
                        if( $item['position'] ) {
                            $position_key = $this->get_repeater_setting_key( 'position', 'testimonial_items', $index );
                            $this->add_inline_editing_attributes( $position_key, 'none' );
                            $this->add_render_attribute( $position_key, 'class', 'position' );

                            printf( '<span %1$s>%2$s</span>',
                                $this->get_render_attribute_string( $position_key ),
                                esc_html( $item['position'] )
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}