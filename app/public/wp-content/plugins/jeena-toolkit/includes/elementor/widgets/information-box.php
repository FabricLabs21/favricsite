<?php
namespace JeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Information_Box extends Widget_Base {

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
        return 'jeena-information-box';
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
        return esc_html__( 'Information\'s Box', 'jeena-toolkit' );
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
        return 'eicon-text-field webtend-logo';
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
        return ['jeena', 'toolkit', 'list', 'portfolio', 'information', 'box'];
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
            'section_information_list',
            [
                'label' => esc_html__( 'information\'s Box', 'jeena-toolkit' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'info_title',
            [
                'label'       => esc_html__( 'Info Title', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter Title', 'jeena-toolkit' ),
            ]
        );

        $repeater->add_control(
            'info_desc',
            [
                'label'       => esc_html__( 'Info Description', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter Description', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'info_items',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'label'       => esc_html__( 'information\'s', 'jeena-toolkit' ),
                'default'     => [
                    [
                        'info_title'     => esc_html__( 'Client Name', 'jeena-toolkit' ),
                        'info_desc'     => esc_html__( 'Michael R. Robinson', 'jeena-toolkit' ),
                    ],
                    [
                        'info_title'     => esc_html__( 'Project Type', 'jeena-toolkit' ),
                        'info_desc'     => esc_html__( 'IT Solutions', 'jeena-toolkit' ),
                    ],
                    [
                        'info_title'     => esc_html__( 'Start DATE', 'jeena-toolkit' ),
                        'info_desc'     => esc_html__( 'March 25, 2022', 'jeena-toolkit' ),
                    ],
                    [
                        'info_title'     => esc_html__( 'Location', 'jeena-toolkit' ),
                        'info_desc'     => esc_html__( '33 Main Street, USA', 'jeena-toolkit' ),
                    ],
                    [
                        'info_title'     => esc_html__( 'Project Durations', 'jeena-toolkit' ),
                        'info_desc'     => esc_html__( '2 Month 6 Days', 'jeena-toolkit' ),
                    ],
                ],
                'title_field' => '{{{ info_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_list',
            [
                'label' => esc_html__( 'Box', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-information-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jeena-information-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'box_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-information-box',
            ]
        );

        $this->add_responsive_control(
            'border_width',
            [
                'label'     => esc_html__( 'Border Width', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-information-box, {{WRAPPER}} .jeena-information-box::before' => 'border-width: {{SIZE}}px;',
                    '{{WRAPPER}} .jeena-information-box::before' => 'height: calc( {{SIZE}}px + 10px );',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-information-box, {{WRAPPER}} .jeena-information-box::before' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_text',
            [
                'label' => esc_html__( 'Content', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => esc_html__( 'Title', 'jeena-toolkit' ),
                'type' => Controls_Manager::HEADING
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-information-box .info-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .jeena-information-box .info-title',
            ]
        );

        $this->add_control(
            'desc_heading',
            [
                'label' => esc_html__( 'Description', 'jeena-toolkit' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-information-box .info-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'selector' => '{{WRAPPER}} .jeena-information-box .info-desc',
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

        if ( empty( $settings['info_items'] ) ) {
            return;
        }
    ?>
    <div class="jeena-information-box">
        <ul>
        <?php foreach( $settings['info_items'] as $index => $item ) :
            $title_key = $this->get_repeater_setting_key( 'info_title', 'info_items', $index );
            $this->add_inline_editing_attributes( $title_key, 'none' );
            $this->add_render_attribute( $title_key, 'class', 'info-title' );

            $desc_key = $this->get_repeater_setting_key( 'info_desc', 'info_items', $index );
            $this->add_inline_editing_attributes( $desc_key, 'none' );
            $this->add_render_attribute( $desc_key, 'class', 'info-desc' );?>
            <li>
                <span <?php echo $this->get_render_attribute_string( $title_key ) ?>>
                    <?php echo esc_html( $item['info_title'] ) ?>
                </span>
                <span <?php echo $this->get_render_attribute_string( $desc_key ) ?>>
                    <?php echo esc_html( $item['info_desc'] ) ?>
                </span>
            </li>
        <?php endforeach; ?>
        </ul>
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
        <div class="jeena-information-box">
            <ul>
            <# _.each( settings.info_items, function( item, index ) {
                var title_key = view.getRepeaterSettingKey( 'info_title', 'info_items', index );
                view.addInlineEditingAttributes( title_key, 'none' );
                view.addRenderAttribute( title_key, 'class', 'info-title' );
                var desc_key = view.getRepeaterSettingKey( 'info_desc', 'info_items', index );
                view.addInlineEditingAttributes( desc_key, 'none' );
                view.addRenderAttribute( desc_key, 'class', 'info-desc' ); #>
                    <li>
                        <span {{{ view.getRenderAttributeString( title_key ) }}}>
                            {{{ item.info_title }}}
                        </span>
                        <span {{{ view.getRenderAttributeString( desc_key ) }}}>
                            {{{ item.info_desc }}}
                        </span>
                    </li>
                <# }); #>
            </ul>
        </ul>
        <?php
    }
}