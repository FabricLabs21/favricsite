<?php
namespace JeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use JeenaToolkit\ElementorAddon\Templates\Posts_Template;

defined( 'ABSPATH' ) || exit;

class Posts extends Widget_Base {

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
        return 'jeena-posts';
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
        return esc_html__( 'Posts', 'jeena-toolkit' );
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
        return 'eicon-posts-grid webtend-logo';
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
        return ['jeena', 'toolkit', 'post', 'blog', 'grid', 'slider'];
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
            'widget_content',
            [
                'label' => esc_html__( 'General', 'jeena-toolkit' ),
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

        $this->add_control(
            'design',
            [
                'label'   => esc_html__( 'Design', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'post-normal',
                'options' => [
                    'post-normal'   => esc_html__( 'Post Normal', 'jeena-toolkit' ),
                    'post-creative' => esc_html__( 'Post Creative', 'jeena-toolkit' ),
                    'post-boxed'    => esc_html__( 'Post Boxed', 'jeena-toolkit' ),
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'       => esc_html__( 'HTML Tag', 'jeena-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
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
            'title_word',
            [
                'label'   => esc_html__( 'Title Length', 'jeena-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label'        => esc_html__( 'Show Excerpt?', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'jeena-toolkit' ),
                'label_off'    => esc_html__( 'No', 'jeena-toolkit' ),
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'excerpt_count',
            [
                'label'     => esc_html__( 'Excerpt Word', 'jeena-toolkit' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 12,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_read_more',
            [
                'label'        => esc_html__( 'Show Read More', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => esc_html__( 'Yes', 'jeena-toolkit' ),
                'label_off'    => esc_html__( 'No', 'jeena-toolkit' ),
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label'     => esc_html__( 'Read More Text', 'jeena-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Read More', 'jeena-toolkit' ),
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_more_icon',
            [
                'label'       => esc_html__( 'Read More Icon', 'jeena-toolkit' ),
                'label_block' => false,
                'type'        => Controls_Manager::ICONS,
                'skin'        => 'inline',
                'default'     => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_thumbnail',
            [
                'label'        => esc_html__( 'Show Thumbnail?', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'jeena-toolkit' ),
                'label_off'    => esc_html__( 'No', 'jeena-toolkit' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'post_thumbnail',
                'default'   => 'large',
                'exclude'   => [
                    'custom',
                ],
                'condition' => [
                    'show_thumbnail' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label'        => esc_html__( 'Show Category Badge?', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'jeena-toolkit' ),
                'label_off'    => esc_html__( 'No', 'jeena-toolkit' ),
                'default'      => '',
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'active_meta',
            [
                'label'       => esc_html__( 'Active Meta', 'jeena-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'default'     => ['author', 'date', 'Comments'],
                'options'     => [
                    'author'   => esc_html__( 'Author', 'jeena-toolkit' ),
                    'date'     => esc_html__( 'Date', 'jeena-toolkit' ),
                    'comments' => esc_html__( 'Comments', 'jeena-toolkit' ),
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
                ],
                'default'              => '',
                'tablet_extra_default' => '',
                'tablet_default'       => '',
                'mobile_default'       => '',
                'condition'            => [
                    'layout' => 'grid',
                ],
                'separator'            => 'before',
                'selectors'            => [
                    '{{WRAPPER}} .jeena-post-boxes' => 'grid-template-columns: repeat( {{VALUE}}, 1fr );',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'query_content',
            [
                'label' => esc_html__( 'Query', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'post_from', [
                'label'   => esc_html__( 'Portfolio From', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'all'           => esc_html__( 'All Posts', 'jeena-toolkit' ),
                    'categories'    => esc_html__( 'Categories', 'jeena-toolkit' ),
                    'specific-post' => esc_html__( 'Specific Posts', 'jeena-toolkit' ),
                ],
                'default' => 'all',
            ]
        );

        $this->add_control(
            'post_ids',
            [
                'label'       => esc_html__( 'Select Posts', 'jeena-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => jt_select_post(),
                'multiple'    => true,
                'label_block' => true,
                'condition'   => [
                    'post_from' => 'specific-post',
                ],
            ]
        );

        $this->add_control(
            'cat_slugs',
            [
                'label'       => esc_html__( 'Select Categories', 'jeena-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => jt_select_category(),
                'multiple'    => true,
                'label_block' => true,
                'condition'   => [
                    'post_from' => 'categories',
                ],
            ]
        );

        $this->add_control(
            'post_limit', [
                'label'   => esc_html__( 'Limit Item', 'jeena-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
                'min'     => 1,
            ]
        );

        $this->add_control(
            'order_by', [
                'label'   => esc_html__( 'Order By', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ID'     => esc_html__( 'ID', 'jeena-toolkit' ),
                    'author' => esc_html__( 'Author', 'jeena-toolkit' ),
                    'title'  => esc_html__( 'Title', 'jeena-toolkit' ),
                    'date'   => esc_html__( 'Date', 'jeena-toolkit' ),
                    'rand'   => esc_html__( 'Random', 'jeena-toolkit' ),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'sort_order', [
                'label'   => esc_html__( 'Sort Order', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => esc_html__( 'Ascending', 'jeena-toolkit' ),
                    'DESC' => esc_html__( 'Descending', 'jeena-toolkit' ),
                ],
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'        => esc_html__( 'Show Pagination', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => esc_html__( 'Yes', 'jeena-toolkit' ),
                'label_off'    => esc_html__( 'No', 'jeena-toolkit' ),
                'return_value' => 'yes',
                'condition'    => [
                    'layout' => 'grid',
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
                'widescreen_default'   => 3,
                'default'              => 3,
                'laptop_default'       => 3,
                'tablet_extra_default' => 2,
                'tablet_default'       => 2,
                'mobile_extra_default' => 2,
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
            'post_style',
            [
                'label' => esc_html__( 'Post Box', 'jeena-toolkit' ),
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
                    '{{WRAPPER}} .jeena-post-boxes' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .jeena-post-boxes' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-post-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-post-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'post_box_shadow',
                'selector' => '{{WRAPPER}} .jeena-post-box',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'post_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-post-box',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__( 'Content', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-post-box .post-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-post-box .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .jeena-post-box .post-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'content_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-post-box .post-content',
            ]
        );

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-post-box .post-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'divider_heading', [
                'label'     => esc_html( 'Divider', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .content-footer' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_gap',
            [
                'label'      => esc_html__( 'Gap', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-post-box .content-footer' => 'margin-top: {{SIZE}}{{UNIT}}; padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image_style',
            [
                'label' => esc_html__( 'Thumbnail', 'jeena-toolkit' ),
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
                    '{{WRAPPER}} .jeena-post-box .post-thumbnail' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .jeena-post-box .post-thumbnail' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_popover_toggle',
            [
                'label'        => esc_html__( 'Object', 'jeena-toolkit' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => esc_html__( 'Default', 'jeena-toolkit' ),
                'label_on'     => esc_html__( 'Custom', 'jeena-toolkit' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_control(
            'img_fit',
            [
                'label'     => esc_html__( 'Fit', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'cover'      => esc_html__( 'Cover', 'jeena-toolkit' ),
                    'fill'       => esc_html__( 'Fill', 'jeena-toolkit' ),
                    'contain'    => esc_html__( 'Contain', 'jeena-toolkit' ),
                    'none'       => esc_html__( 'None', 'jeena-toolkit' ),
                    'scale-down' => esc_html__( 'Scale Down', 'jeena-toolkit' ),
                ],
                'condition' => [
                    'image_popover_toggle' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-thumbnail img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'img_position',
            [
                'label'     => esc_html__( 'Position', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'top'    => esc_html__( 'Top', 'jeena-toolkit' ),
                    'bottom' => esc_html__( 'Bottom', 'jeena-toolkit' ),
                    'left'   => esc_html__( 'left', 'jeena-toolkit' ),
                    'right'  => esc_html__( 'Right', 'jeena-toolkit' ),
                    'center' => esc_html__( 'Center', 'jeena-toolkit' ),
                ],
                'condition' => [
                    'image_popover_toggle' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-thumbnail img' => 'object-position: {{VALUE}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'thumbnail_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-post-box .post-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-post-box .post-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_excerpt_meta',
            [
                'label' => esc_html__( 'Title/Excerpt/Meta/Read', 'jeena-toolkit' ),
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
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .jeena-post-box .post-title',

            ]
        );

        $this->add_responsive_control(
            'title_gap',
            [
                'label'      => esc_html__( 'Gap(Bottom)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-post-box .post-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'meta_heading',
            [
                'label'     => esc_html__( 'Post Meta', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'active_meta',
                            'operator' => '==',
                            'value'    => 'comments',
                        ],
                        [
                            'name'     => 'active_meta',
                            'operator' => '==',
                            'value'    => 'date',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-date-comment'                  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .post-date-comment > span:not(:first-child)::before' => 'background-color: {{VALUE}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'active_meta',
                            'operator' => '==',
                            'value'    => 'comments',
                        ],
                        [
                            'name'     => 'active_meta',
                            'operator' => '==',
                            'value'    => 'date',
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'meta_typography',
                'selector'  => '.jeena-post-box .post-date-comment',
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'active_meta',
                            'operator' => '==',
                            'value'    => 'comments',
                        ],
                        [
                            'name'     => 'active_meta',
                            'operator' => '==',
                            'value'    => 'date',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_gap',
            [
                'label'      => esc_html__( 'Gap(Bottom)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-post-box .post-date-comment' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'active_meta',
                            'operator' => '==',
                            'value'    => 'comments',
                        ],
                        [
                            'name'     => 'active_meta',
                            'operator' => '==',
                            'value'    => 'date',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'excerpt_heading',
            [
                'label'     => esc_html__( 'Excerpt', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-content p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'excerpt_typography',
                'selector'  => '{{WRAPPER}} .jeena-post-box .post-content p',
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'excerpt_gap',
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
                    '{{WRAPPER}} .jeena-post-box .post-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_heading',
            [
                'label'     => esc_html__( 'Read More', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .read-more' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__( 'Color(Hover)', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .read-more:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'button_typography',
                'selector'  => '{{WRAPPER}} .jeena-post-box .read-more',
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_author',
            [
                'label'     => esc_html__( 'Post Author', 'jeena-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'active_meta' => 'author',
                ],
            ]
        );

        $this->add_control(
            'author_position',
            [
                'label'   => esc_html__( 'Author Position', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'after-title' => esc_html__( 'After Title', 'jeena-toolkit' ),
                    'at-footer'   => esc_html__( 'At Footer', 'jeena-toolkit' ),
                ],
                'default' => 'at-footer',
            ]
        );

        $this->add_control(
            'author_photo',
            [
                'label'        => esc_html__( 'Author Photo?', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'jeena-toolkit' ),
                'label_off'    => esc_html__( 'No', 'jeena-toolkit' ),
                'default'      => '',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'author_note',
            [
                'label'       => esc_html__( 'Author Note', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'By', 'jeena-toolkit' ),
            ]
        );

        $this->add_responsive_control(
            'author_gap',
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
                    '{{WRAPPER}} .jeena-post-box .post-author' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'author_position' => 'after-title',
                ],
            ]
        );

        $this->add_control(
            'author_name_heading',
            [
                'label'     => esc_html__( 'Name', 'jeena-heading' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'author_name_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-author .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'author_name_type',
                'selector' => '{{WRAPPER}} .jeena-post-box .post-author .name',
            ]
        );

        $this->add_control(
            'author_note_heading',
            [
                'label'     => esc_html__( 'Note', 'jeena-heading' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'author_note!' => '',
                ],
            ]
        );

        $this->add_control(
            'author_note_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-author .note' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'author_note!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'author_note_type',
                'selector'  => '{{WRAPPER}} .jeena-post-box .post-author .note',
                'condition' => [
                    'author_note!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_categories',
            [
                'label'     => esc_html__( 'Post categories', 'jeena-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_category' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'post_categories_type',
                'selector' => '{{WRAPPER}} .jeena-post-box .post-categories a',
            ]
        );

        $this->start_controls_tabs( 'post_categories_tabs' );

        $this->start_controls_tab(
            'categories_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'categories_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-categories a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'categories_bg',
            [
                'label'     => esc_html__( 'Background', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-categories a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'categories_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'categories_hover_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-categories a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'categories_hover_bg',
            [
                'label'     => esc_html__( 'Background', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-post-box .post-categories a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagination_style',
            [
                'label'     => esc_html__( 'Pagination', 'jeena-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_pagination' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_gap',
            [
                'label'      => esc_html__( 'Gap', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_size',
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
                    '{{WRAPPER}} .jeena-pagination .page-numbers' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Text Size', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-pagination .page-numbers' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_pagination_style' );

        $this->start_controls_tab(
            'tab_pagination_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-pagination .page-numbers' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-pagination .page-numbers' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_bg',
            [
                'label'     => esc_html__( 'Background', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-pagination .page-numbers' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_pagination_hover',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );
        $this->add_control(
            'hover_pagination_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-pagination .page-numbers:hover, {{WRAPPER}} .jeena-pagination .page-numbers.current' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_pagination_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-pagination .page-numbers:hover, {{WRAPPER}} .jeena-pagination .page-numbers.current' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_pagination_bg',
            [
                'label'     => esc_html__( 'Background', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-pagination .page-numbers:hover, {{WRAPPER}} .jeena-pagination .page-numbers.current' => 'background-color: {{VALUE}};',
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
    protected function render() {
        $settings = $this->get_settings_for_display();

        $template = new Posts_Template();
        $template->render( $settings );
    }
}