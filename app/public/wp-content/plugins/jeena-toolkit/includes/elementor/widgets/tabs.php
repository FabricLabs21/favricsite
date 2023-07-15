<?php
namespace JeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Tabs extends Widget_Base {

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
        return 'jeena-tabs';
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
        return esc_html__( 'Tabs', 'jeena-toolkit' );
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
        return 'eicon-tabs webtend-logo';
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
        return ['jeena', 'toolkit', 'tabs', 'collapse'];
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
            'section_content_tabs',
            [
                'label' => esc_html__( 'Tabs', 'jeena-toolkit' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_icon',
            [
                'label'            => esc_html__( 'Icon', 'jeena-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'label_block'      => true,
                'fa4compatibility' => 'tab_icon_f4',
                'label_block'      => false,
                'skin'             => 'inline',
            ]
        );

        $repeater->add_control(
            'tab_title',
            [
                'label'       => esc_html__( 'Title', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tabs Title', 'jeena-toolkit' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content_type', [
                'label'   => esc_html__( 'Content Type', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'content'  => esc_html__( 'Content', 'jeena-toolkit' ),
                    'block'    => esc_html__( 'Builder Block', 'jeena-toolkit' ),
                    'template' => esc_html__( 'Elementor Templates', 'jeena-toolkit' ),
                ],
                'default' => 'content',
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label'      => esc_html__( 'Content', 'jeena-toolkit' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => esc_html__( 'Tabs Content', 'jeena-toolkit' ),
                'show_label' => true,
                'condition'  => [
                    'content_type' => 'content',
                ],
            ]
        );

        $repeater->add_control(
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

        $repeater->add_control(
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
            'tabs',
            [
                'label'       => esc_html__( 'Tabs Items', 'jeena-toolkit' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'tab_title'   => esc_html__( 'UX/UI Design', 'jeena-toolkit' ),
                        'tab_content' => esc_html__( 'We provide best UX/UI Design service at: The top US marketing company in the world! We design, develop and deliver real-time communications with our clients.', 'jeena-toolkit' ),
                        'tab_icon'    => [
                            'value'   => 'flaticon flaticon-creativity',
                            'library' => 'jeena-flaticon',
                        ],
                    ],
                    [
                        'tab_title'   => esc_html__( 'Apps Development', 'jeena-toolkit' ),
                        'tab_content' => esc_html__( 'We are one of the best app development service company. With hundreds of thousands developers, we develop games for smartphones, PCs/laptops as well tablets', 'jeena-toolkit' ),
                        'tab_icon'    => [
                            'value'   => 'flaticon flaticon-test',
                            'library' => 'jeena-flaticon',
                        ],
                    ],
                    [
                        'tab_title'   => esc_html__( 'Cyber Security', 'jeena-toolkit' ),
                        'tab_content' => esc_html__( 'We provide best UX/UI Design service at: The top US marketing company in the world! We design, develop and deliver real-time communications with our clients.', 'jeena-toolkit' ),
                        'tab_icon'    => [
                            'value'   => 'flaticon flaticon-cyber-security-1',
                            'library' => 'jeena-flaticon',
                        ],
                    ],
                    [
                        'tab_title'   => esc_html__( 'Tech Support', 'jeena-toolkit' ),
                        'tab_content' => esc_html__( 'We are one of the best app development service company. With hundreds of thousands developers, we develop games for smartphones, PCs/laptops as well tablets', 'jeena-toolkit' ),
                        'tab_icon'    => [
                            'value'   => 'flaticon flaticon-support',
                            'library' => 'jeena-flaticon',
                        ],
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tab_heading',
            [
                'label' => esc_html__( 'Tab Heading', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tab_heading_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-tabs .tabs-headings-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_heading_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-tabs .tabs-headings-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_item_heading',
            [
                'label'     => esc_html__( 'Tab Heading Item', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'heading_item_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-tabs .tab-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_item_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-tabs .tab-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'header_item_typography',
                'selector' => '{{WRAPPER}} .jeena-tabs .tab-heading .tab-heading-text',
            ]
        );

        $this->add_responsive_control(
            'heading_item_icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-tabs .tabs-headings-wrapper .tab-heading-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_item_icon_space',
            [
                'label'      => esc_html__( 'Icon Spacing', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-tabs .tabs-headings-wrapper .tab-heading-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tab_header_tabs' );

        $this->start_controls_tab(
            'header_normal_tab',
            ['label' => esc_html__( 'Normal', 'jeena-toolkit' )]
        );

        $this->add_control(
            'header_normal_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-tabs .tab-heading .tab-heading-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_normal_color',
            [
                'label'     => esc_html__( 'Icon Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-tabs .tab-heading .tab-heading-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-tabs .tab-heading:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_border_width',
            [
                'label'      => esc_html__( 'Border Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-tabs .tabs-headings-wrapper .tab-heading:before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'header_active_tab',
            ['label' => esc_html__( 'Active', 'jeena-toolkit' )]
        );

        $this->add_control(
            'hover_header_normal_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-tabs .tab-heading.active .tab-heading-text, {{WRAPPER}} .jeena-tabs .tab-heading:hover .tab-heading-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_icon_normal_color',
            [
                'label'     => esc_html__( 'Icon Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-tabs .tab-heading.active .tab-heading-icon, {{WRAPPER}} .jeena-tabs .tab-heading:hover .tab-heading-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_active_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-tabs .tab-heading:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_active_border_width',
            [
                'label'      => esc_html__( 'Border Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-tabs .tabs-headings-wrapper .tab-heading:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'tab_content',
            [
                'label' => esc_html__( 'Tab Content', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-tabs .tab-content-wrapper .content-inner' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .jeena-tabs .tab-content-wrapper .content-inner',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-tabs .tab-content-wrapper .content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jeena-tabs .tab-content-wrapper .content-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

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

        $dynamic_id = rand( 20, 999999 );

        $this->add_render_attribute( 'tabs', [
            'id'    => 'tabs-' . $dynamic_id,
            'class' => 'jeena-tabs',
        ] );

        if ( empty( $settings['tabs'] ) ) {
            return;
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( 'tabs' ); ?>>
            <div class="tabs-headings-wrapper">
                <?php foreach ( $settings['tabs'] as $index => $item ) :
                        $title_key     = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
                        $this->add_render_attribute( $title_key, [
                            'class'       => ['tab-heading'],
                            'data-target' => '#tab-content-' . $dynamic_id . $index . '',
                        ] );

                        $migrated = isset( $item['__fa4_migrated']['tab_icon'] );
                        $is_new   = empty( $item['tab_icon_f4'] ) && Icons_Manager::is_migration_allowed();

                        if ( '0' == $index ) {
                            $this->add_render_attribute( $title_key, 'class', 'active' );
                        }
                    ?>
                    <div <?php echo $this->get_render_attribute_string( $title_key ); ?>>
                        <span class="tab-heading-icon">
                            <?php
                                if ( $is_new || $migrated ) {
                                    Icons_Manager::render_icon( $item['tab_icon'], ['aria-hidden' => 'true'] );
                                } else {
                                    echo '<i class="'. esc_attr( $item['tab_icon_f4'] ) .'"></i>';
                                }
                            ?>
                        </span>
                        <span class="tab-heading-text">
                            <?php echo jt_kses_basic( $item['tab_title'] ) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="tab-content-wrapper">
                <?php foreach ( $settings['tabs'] as $index => $item ) :
                    $content_key   = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

                    $this->add_render_attribute( $content_key, [
                        'class' => 'tab-content',
                        'id'    => 'tab-content-' . $dynamic_id . $index . '',
                    ] );

                    if ( '0' == $index ) {
                        $this->add_render_attribute( $content_key, 'style', 'display:block;' );
                    } else {
                        $this->add_render_attribute( $content_key, 'style', 'display:none;' );
                    }
                    ?>
                    <div <?php echo $this->get_render_attribute_string( $content_key ) ?>>
                        <div class="content-inner">
                            <?php
                                if( 'template' === $item['content_type'] || 'block' === $item['content_type'] ) {
                                    if ( 'template' === $item['content_type'] ) {
                                        $t_id = $item['template_id'];
                                    } elseif ( 'block' === $item['content_type'] ) {
                                        $t_id = $item['block_id'];
                                    }

                                    echo Plugin::$instance->frontend->get_builder_content_for_display( $t_id, true );
                                } else {
                                    echo wp_kses_post( wpautop( $item['tab_content'] ) );
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                endforeach; ?>
            </div>
        </div>
        <?php
    }
}