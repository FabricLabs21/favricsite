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

class Team_Members extends Widget_Base {

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
        return 'jeena-team';
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
        return esc_html__( 'Team Members', 'jeena-toolkit' );
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
        return 'eicon-person webtend-logo';
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
        return ['jeena', 'toolkit', 'members', 'team', 'slider'];
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
            'section_content_member',
            [
                'label' => esc_html__( 'Team Members', 'jeena-toolkit' ),
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

        $repeater->start_controls_tabs( 'tab_member' );

        $repeater->start_controls_tab(
            'member_info_tab',
            [
                'label' => esc_html__( 'Information', 'jeena-toolkit' ),
            ]
        );

        $repeater->add_control(
            'photo',
            [
                'label'   => __( 'Photo', 'jeena-toolkit' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label'       => esc_html__( 'Name', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Member Name', 'jeena-toolkit' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'job_title',
            [
                'label'       => esc_html__( 'Job Title', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Job Title', 'jeena-toolkit' ),
                'label_block' => true,
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'member_social_tab',
            [
                'label' => __( 'Social Links', 'jeena-toolkit' ),
            ]
        );

        $repeater->add_control(
            'show_social_links',
            [
                'label'        => esc_html__( 'Show Links', 'jeena-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'jeena-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'jeena-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater->add_control(
            'facebook', [
                'label_block' => false,
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Facebook', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Add your Facebook address', 'jeena-toolkit' ),
                'input_type'  => 'url',
                'condition'   => [
                    'show_social_links' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'twitter', [
                'label_block' => false,
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Twitter', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Add your Twitter address', 'jeena-toolkit' ),
                'input_type'  => 'url',
                'condition'   => [
                    'show_social_links' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'linkedin', [
                'label_block' => false,
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'LinkedIn', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Add your LinkedIn address', 'jeena-toolkit' ),
                'input_type'  => 'url',
                'condition'   => [
                    'show_social_links' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'instagram', [
                'label_block' => false,
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Instagram', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Add your Instagram address', 'jeena-toolkit' ),
                'input_type'  => 'url',
                'condition'   => [
                    'show_social_links' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'website', [
                'label_block' => false,
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Website Address', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Add your profile link', 'jeena-toolkit' ),
                'input_type'  => 'url',
                'condition'   => [
                    'show_social_links' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'email', [
                'label_block' => false,
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Email', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Add your Email address', 'jeena-toolkit' ),
                'input_type'  => 'email',
                'condition'   => [
                    'show_social_links' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'github', [
                'label_block' => false,
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Github', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Add your Github address', 'jeena-toolkit' ),
                'input_type'  => 'url',
                'condition'   => [
                    'show_social_links' => 'yes',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'team_members',
            [
                'label'       => esc_html__( 'Members', 'jeena-toolkit' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'name'      => esc_html__( 'Johnathan P. Bailey', 'jeena-toolkit' ),
                        'job_title' => esc_html__( 'UX/UI Designer', 'jeena-toolkit' ),
                        'facebook'  => '#',
                        'twitter'   => '#',
                        'instagram' => '#',
                        'linkedin'  => '#',
                        'photo'     => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name'      => esc_html__( 'Mark M. Hughes', 'jeena-toolkit' ),
                        'job_title' => esc_html__( 'Web Developer', 'jeena-toolkit' ),
                        'facebook'  => '#',
                        'twitter'   => '#',
                        'instagram' => '#',
                        'linkedin'  => '#',
                        'photo'     => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name'      => esc_html__( 'Donald B. Mitchell', 'jeena-toolkit' ),
                        'job_title' => esc_html__( 'Software Engineer', 'jeena-toolkit' ),
                        'facebook'  => '#',
                        'twitter'   => '#',
                        'instagram' => '#',
                        'linkedin'  => '#',
                        'photo'     => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name'      => esc_html__( 'Bennie N. Bannister', 'jeena-toolkit' ),
                        'job_title' => esc_html__( 'Senior Consultant', 'jeena-toolkit' ),
                        'facebook'  => '#',
                        'twitter'   => '#',
                        'instagram' => '#',
                        'linkedin'  => '#',
                        'photo'     => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'jeena_110x110',
                'separator' => 'before',
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
                    '{{WRAPPER}} .jeena-team-members' => 'grid-template-columns: repeat( {{VALUE}}, 1fr );',
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
            'team_item_style',
            [
                'label' => esc_html__( 'Member Box', 'jeena-toolkit' ),
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
                    '{{WRAPPER}} .jeena-team-members' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .jeena-team-members' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'team_item_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-team-member' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'team_item_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-team-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member' => 'text-align: {{Value}};',
                ],
            ]
        );

        $this->add_control(
            'member_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'team_item_content_style',
            [
                'label' => esc_html__( 'Content', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'team_content_item_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-team-member .member-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'team_content_item_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-team-member .member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'item_border',
                'selector' => '{{WRAPPER}} .jeena-team-member .member-content',
            ]
        );

        $this->add_responsive_control(
            'item_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-team-member .member-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'team_item_tab' );

        $this->start_controls_tab(
            'team_item_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'item_normal_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member .member-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .jeena-team-member .member-content',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'team_item_hover',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'item_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member:hover .member-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member:hover .member-content' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_hover_shadow',
                'selector' => '{{WRAPPER}} .jeena-team-member:hover .member-content',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'thumbnail_style',
            [
                'label' => esc_html__( 'Thumbnail', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'member_thumb_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-team-member .member-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_width',
            [
                'label'      => esc_html__( 'Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-team-member .member-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_height',
            [
                'label'      => esc_html__( 'Height', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-team-member .member-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'thumbnail_border',
                'selector' => '{{WRAPPER}} .jeena-team-member .member-image',
            ]
        );

        $this->add_responsive_control(
            'thumbnail_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-team-member .member-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'thumbnail_shadow',
                'selector' => '{{WRAPPER}} .jeena-team-member .member-image',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'color_typography',
            [
                'label' => esc_html__( 'Color & Typography', 'jeena-toolkit' ),
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
                    '{{WRAPPER}} .jeena-team-member .member-content .member-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member .member-content .member-name:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .jeena-team-member .member-content .member-name',
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
                    '{{WRAPPER}} .jeena-team-member .member-content .job-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .jeena-team-member .member-content .job-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'social_typography',
            [
                'label' => esc_html__( 'Social Icons', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'social_align',
            [
                'label'     => esc_html__( 'Alignment', 'jeena-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start'   => [
                        'title' => esc_html__( 'Left', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end'  => [
                        'title' => esc_html__( 'Right', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member .social-links' => 'justify-content: {{Value}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
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
                    '{{WRAPPER}} .jeena-team-member .member-content .social-links a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_font_size',
            [
                'label'      => esc_html__( 'Icon Size', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-team-member .member-content .social-links a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_spacing',
            [
                'label'      => esc_html__( 'Divider Spacing', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-team-member .member-content .social-links' => 'padding-top: {{SIZE}}{{UNIT}}; margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border',
                'selector' => '{{WRAPPER}} .jeena-team-member .member-content .social-links a',
            ]
        );

        $this->start_controls_tabs( 'social_icon_tab' );

        $this->start_controls_tab(
            'social_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_normal_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member .member-content .social-links a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_normal_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member .member-content .social-links a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_divider_color',
            [
                'label'     => esc_html__( 'Divider Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member .member-content .social-links' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_item_hover',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member .member-content .social-links a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_bg_2',
            [
                'label'       => esc_html__( 'Background', 'jeena-toolkit' ),
                'description' => esc_html__( 'When the main div is hovered', 'jeena-toolkit' ),
                'type'        => Controls_Manager::COLOR,
                'selectors'   => [
                    '{{WRAPPER}} .jeena-team-member:hover .member-content .social-links a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member .member-content .social-links a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member .member-content .social-links a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_divider_color_hover',
            [
                'label'     => esc_html__( 'Divider Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-team-member:hover .member-content .social-links' => 'border-color: {{VALUE}};',
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
    public function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['team_members'] ) ) {
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'jeena-team-members' );

        if( 'slider' == $settings['layout'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'jeena-slider-wrapper' );
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <?php if( 'grid' == $settings['layout'] ) : ?>
                <?php
                foreach ( $settings['team_members'] as $index => $member ) {
                    $this->render_single_member( $index, $member );
                }
                ?>
            <?php elseif( 'slider' == $settings['layout'] ) : ?>
                <div class="jeena-slider-active">
                    <?php foreach ( $settings['team_members'] as $index => $member ) : ?>
                    <div class="jeena-slider-item">
                        <?php $this->render_single_member( $index, $member ); ?>
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
     * Render Team member
     *
     * @param int $index
     * @param array $member
     * @return void
     */
    public function render_single_member( $index, $member ) {
        $settings = $this->get_settings_for_display();

        if ( empty( $member['photo']['id'] && ! empty( $member['photo']['url'] ) ) ) {
            $image_url = $member['photo']['url'];
        } else {
            $image_url = Group_Control_Image_Size::get_attachment_image_src( $member['photo']['id'], 'thumbnail', $settings );
        }

        $name_key = $this->get_repeater_setting_key( 'name', 'team_members', $index );
        $this->add_render_attribute( $name_key, 'class', 'member-name' );
        $this->add_inline_editing_attributes( $name_key, 'none' );

        $job_title_key = $this->get_repeater_setting_key( 'job_title', 'team_members', $index );
        $this->add_render_attribute( $job_title_key, 'class', 'job-title' );
        $this->add_inline_editing_attributes( $job_title_key, 'none' );
        ?>
        <div class="jeena-team-member">
            <?php if ( $image_url ) : ?>
            <div class="member-image">
                <img src="<?php echo esc_url( $image_url ) ?>" alt="<?php echo esc_html( $member['name'] ) ?>">
            </div>
            <?php endif; ?>
            <div class="member-content">
                <h4 <?php echo $this->get_render_attribute_string( $name_key ) ?> >
                    <?php echo esc_html( $member['name'] ) ?>
                </h4>
                <p <?php echo $this->get_render_attribute_string( $job_title_key ) ?>>
                    <?php echo esc_html( $member['job_title'] ) ?>
                </p>
                <?php if ( 'yes' === $member['show_social_links'] ) : ?>
                <div class="social-links">
                    <?php
                        if ( !empty( $member['facebook'] ) ) {
                            printf('<a href="%1$s"><i class="fab fa-facebook-f"></i></a>',
                                esc_url( $member['facebook'] ),
                            );
                        }
                        if ( !empty( $member['twitter'] ) ) {
                            printf('<a href="%1$s"><i class="fab fa-twitter"></i></a>',
                                esc_url( $member['twitter'] ),
                            );
                        }
                        if ( !empty( $member['linkedin'] ) ) {
                            printf('<a href="%1$s"><i class="fab fa-linkedin-in"></i></a>',
                                esc_url( $member['linkedin'] ),
                            );
                        }
                        if ( !empty( $member['instagram'] ) ) {
                            printf('<a href="%1$s"><i class="fab fa-instagram"></i></a>',
                                esc_url( $member['instagram'] ),
                            );
                        }
                        if ( !empty( $member['website'] ) ) {
                            printf('<a href="%1$s"><i class="fas fa-globe"></i></a>',
                                esc_url( $member['website'] ),
                            );
                        }
                        if ( !empty( $member['email'] ) ) {
                            printf('<a href="%1$s"><i class="fas fa-envelope"></i></a>',
                                esc_url( $member['email'] ),
                            );
                        }
                        if ( !empty( $member['github'] ) ) {
                            printf('<a href="%1$s"><i class="fab fa-github"></i></a>',
                                esc_url( $member['github'] ),
                            );
                        }
                    ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}