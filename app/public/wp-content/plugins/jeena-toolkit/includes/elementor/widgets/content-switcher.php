<?php
namespace JeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Content_Switcher extends Widget_Base {

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
        return 'jeena-content-switcher';
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
        return esc_html__( 'Content Switcher', 'jeena-toolkit' );
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
        return 'eicon-code webtend-logo';
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
        return ['jeena', 'toolkit', 'content', 'switcher', 'pricing'];
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

        $this->start_controls_tabs( 'content_selection_tab' );

        $this->start_controls_tab(
            'content_one_tab',
            [
                'label' => esc_html__( 'Content One', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'Monthly', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'content_type',
            [
                'label'   => esc_html__( 'Type', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'plain_content' => esc_html__( 'Plain/ HTML Text', 'jeena-toolkit' ),
                    'block'         => esc_html__( 'Builder Block', 'jeena-toolkit' ),
                    'templates'     => esc_html__( 'Elementor Templates', 'jeena-toolkit' ),
                ],
                'default' => 'plain_content',
            ]
        );

        $this->add_control(
            'plain_content',
            [
                'label'     => esc_html__( 'Plain/ HTML Text', 'jeena-toolkit' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows'      => 10,
                'condition' => [
                    'content_type' => 'plain_content',
                ],
                'default'   => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'builder_block',
            [
                'label'     => esc_html__( 'Builder Block', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => jt_select_builder_block(),
                'default'   => '0',
                'condition' => [
                    'content_type' => 'block',
                ],
            ]
        );

        $this->add_control(
            'elementor_template',
            [
                'label'     => esc_html__( 'Elementor Template', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => jt_select_elementor_template(),
                'default'   => '0',
                'condition' => [
                    'content_type' => 'templates',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_two_tab',
            [
                'label' => esc_html__( 'Content Two', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'title_two',
            [
                'label'       => esc_html__( 'Title', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'Yearly', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'content_type_two',
            [
                'label'   => esc_html__( 'Type', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'plain_content' => esc_html__( 'Plain/ HTML Text', 'jeena-toolkit' ),
                    'block'         => esc_html__( 'Builder Block', 'jeena-toolkit' ),
                    'templates'     => esc_html__( 'Elementor Templates', 'jeena-toolkit' ),
                ],
                'default' => 'plain_content',
            ]
        );

        $this->add_control(
            'plain_content_two',
            [
                'label'     => esc_html__( 'Plain/ HTML Text', 'jeena-toolkit' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows'      => 10,
                'condition' => [
                    'content_type_two' => 'plain_content',
                ],
                'default'   => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'builder_block_two',
            [
                'label'     => esc_html__( 'Builder Block', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => jt_select_builder_block(),
                'default'   => '0',
                'condition' => [
                    'content_type_two' => 'block',
                ],
            ]
        );

        $this->add_control(
            'elementor_template_two',
            [
                'label'     => esc_html__( 'Elementor Template', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => jt_select_elementor_template(),
                'default'   => '0',
                'condition' => [
                    'content_type_two' => 'templates',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_switch_bar',
            [
                'label' => esc_html__( 'Switch Bar', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'switch_bar_alignment',
            [
                'label'       => esc_html__( 'Toggle Alignment', 'jeena-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
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
                'toggle'      => true,
                'selectors'   => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-btn-wrapper' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'switch_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'switch_heading',
            [
                'label'     => esc_html__( 'Switch', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'switch_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-btns' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'switch_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-btns .switch-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switch_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-btns' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'switch_border',
                'label'    => esc_html__( 'Border', 'jeena-toolkit' ),
                'selector' => '{{WRAPPER}} .jeena-content-switcher .switcher-btns',
            ]
        );

        $this->add_responsive_control(
            'switch_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-btns' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'switch_box_shadow',
                'selector' => '{{WRAPPER}} .jeena-content-switcher .switcher-btns',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'switch_control',
            [
                'label' => esc_html__( 'Switcher Control', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'switch_control_width',
            [
                'label'      => esc_html__( 'Switcher Width (px)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-content-switcher' => '--switcher-width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'switch_control_height',
            [
                'label'      => esc_html__( 'Switcher Height (px)', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-content-switcher' => '--switcher-height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'switcher_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-slider::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switcher_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-slider' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'switcher_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-slider'         => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .jeena-content-switcher .switcher-slider::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__( 'Content', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-content-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .jeena-content-switcher .switcher-content-container',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-content-container' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-content-container' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_alignment',
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
                    '{{WRAPPER}} .jeena-content-switcher .switcher-content-container' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'content_box',
                'label'    => esc_html__( 'Border', 'jeena-toolkit' ),
                'selector' => '{{WRAPPER}} .jeena-content-switcher .switcher-content-container',

            ]
        );
        $this->add_responsive_control(
            'content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-content-switcher .switcher-content-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'label'    => esc_html__( 'Box Shadow', 'jeena-toolkit' ),
                'selector' => '{{WRAPPER}} .jeena-content-switcher .switcher-content-container',

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
    protected function render() {
        $settings     = $this->get_settings_for_display();
        $primary_id   = rand( 10, 100 );
        $secondary_id = rand( 10, 100 );
        ?>
        <div class="jeena-content-switcher">
            <div class="switcher-btn-wrapper">
                <div class="switcher-btns">
                    <div class="switch-btn primary-switch active" data-content-id="<?php echo esc_attr( $primary_id ); ?>">
                        <?php echo esc_html( $settings['title'] ); ?>
                    </div>
                    <label class="switcher-input-label">
                        <input type="checkbox" class="switcher-checkbox">
                        <span class="switcher-slider"></span>
                    </label>
                    <div class="switch-btn secondary-switch" data-content-id="<?php echo esc_attr( $secondary_id ); ?>">
                        <?php echo esc_html( $settings['title_two'] ); ?>
                    </div>
                </div>
            </div>
			<div class="switcher-content-container">
                <div class="switcher-content-wrap primary-switch-content active">
                    <?php
                        if( 'template' === $settings['content_type'] || 'block' === $settings['content_type'] ) {
                            if ( 'template' === $settings['content_type'] ) {
                                $t_id = $settings['elementor_template'];
                            } elseif ( 'block' === $settings['content_type'] ) {
                                $t_id = $settings['builder_block'];
                            }

                            echo Plugin::$instance->frontend->get_builder_content_for_display( $t_id, true );
                        } else {
                            echo jt_kses_basic( $settings['plain_content'] );
                        }
                    ?>
                </div>
                <div class="switcher-content-wrap secondary-switch-content">
                    <?php
                        if( 'template' === $settings['content_type_two'] || 'block' === $settings['content_type_two'] ) {
                            if ( 'template' === $settings['content_type_two'] ) {
                                $t_id = $settings['elementor_template_two'];
                            } elseif ( 'block' === $settings['content_type_two'] ) {
                                $t_id = $settings['builder_block_two'];
                            }

                            echo Plugin::$instance->frontend->get_builder_content_for_display( $t_id, true );
                        } else {
                            echo jt_kses_basic( $settings['plain_content_two'] );
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}