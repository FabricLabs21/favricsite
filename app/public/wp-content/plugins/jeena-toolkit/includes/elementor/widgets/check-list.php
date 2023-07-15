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

class Check_List extends Widget_Base {

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
        return 'jeena-check-list';
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
        return esc_html__( 'Check List', 'jeena-toolkit' );
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
        return 'eicon-bullet-list webtend-logo';
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
        return ['jeena', 'toolkit', 'list', 'check', 'icon'];
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
            'section_check_list',
            [
                'label' => esc_html__( 'Check List', 'jeena-toolkit' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_text',
            [
                'label'       => esc_html__( 'Text', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter list text', 'jeena-toolkit' ),
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label'            => esc_html__( 'Icon', 'jeena-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'list_items',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'label'       => esc_html__( 'Items', 'jeena-toolkit' ),
                'default'     => [
                    [
                        'list_text'     => esc_html__( 'Comprehensive UI/UX Assessment', 'jeena-toolkit' ),
                        'selected_icon' => [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'list_text'     => esc_html__( 'Deep Contextual Research and 360° Planning', 'jeena-toolkit' ),
                        'selected_icon' => [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'list_text'     => esc_html__( 'Wireframing & Prototyping', 'jeena-toolkit' ),
                        'selected_icon' => [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ list_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_list',
            [
                'label' => esc_html__( 'List', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'check_list_spacing',
            [
                'label'      => esc_html__( 'Spacing Between', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-check-list li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label'     => esc_html__( 'Alignment', 'jeena-toolkit' ),
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
                'default'   => 'start',
                'selectors' => [
                    '{{WRAPPER}} .jeena-check-list li' => 'justify-content: {{VALUE}};',
                ],
                'toggle'    => false,
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'   => esc_html__( 'Alignment', 'jeena-toolkit' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'  => [
                        'title' => esc_html__( 'Left', 'jeena-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'jeena-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'toggle'  => false,
                'default' => 'left',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => esc_html__( 'Icon', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'check_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-check-list li .list-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_background',
            [
                'label'     => esc_html__( 'Icon Background', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-check-list li .list-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'check_icon_spacing',
            [
                'label'      => esc_html__( 'Icon Spacing', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-check-list' => '--icon-space: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Size', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-check-list li .list-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .jeena-check-list li .list-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'icon_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-check-list li .list-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-check-list li .list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_text',
            [
                'label' => esc_html__( 'Text', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'check_list_color',
            [
                'label'     => esc_html__( 'Text Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-check-list li .list-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'check_list_typography',
                'selector' => '{{WRAPPER}} .jeena-check-list li .list-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'selector' => '{{WRAPPER}} .jeena-check-list li .list-text',
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

        if ( empty( $settings['list_items'] ) ) {
            return;
        }
    ?>
    <ul class="jeena-check-list icon-<?php echo esc_attr( $settings['icon_position'] ) ?>">
        <?php foreach( $settings['list_items'] as $index => $item ) :
            $list_text_key = $this->get_repeater_setting_key( 'list_text', 'list_items', $index );
            $this->add_inline_editing_attributes( $list_text_key, 'none' );
            $this->add_render_attribute( $list_text_key, 'class', 'list-text' );

            $migrated = isset( $item['__fa4_migrated']['selected_icon'] );
            $is_new   = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed(); ?>
            <li>
                <?php if ( $item['selected_icon'] || $item['icon'] ) ?>
                <span class="list-icon">
                    <?php
                        if ( $is_new || $migrated ) {
                            Icons_Manager::render_icon( $item['selected_icon'] );
                        } else {
                            echo '<i class="'. esc_attr( $item['icon'] ) .'"></i>';
                        }
                    ?>
                </span>
                <span <?php echo $this->get_render_attribute_string( $list_text_key ) ?>>
                    <?php echo esc_html( $item['list_text'] ) ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
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
        <ul class="jeena-check-list icon-{{{ settings.icon_position }}}">
            <# _.each( settings.list_items, function( item, index ) {
                var text_key = view.getRepeaterSettingKey( 'list_text', 'list_items', index );
                view.addInlineEditingAttributes( text_key, 'none' );
                view.addRenderAttribute( text_key, 'class', 'list-text' ); #>
                <li>
                    <# if ( item.icon || item.selected_icon.value ) { #>
                    <span class="list-icon">
                        <#
                            var iconHTML = elementor.helpers.renderIcon( view, item.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ),
                            iconMigrated = elementor.helpers.isIconMigrated( item, 'selected_icon' );

                            if ( iconHTML && iconHTML.rendered && ( ! settings.icon || iconMigrated ) ) { #>
                                {{{ iconHTML.value }}}
                            <# } else { #>
                                <i class="{{ item.icon }}" aria-hidden="true"></i>
                            <# }
                        #>
                    </span>
                    <# } #>
                    <span {{{ view.getRenderAttributeString( text_key ) }}}>
                        {{{ item.list_text }}}
                    </span>
                </li>
            <# }); #>
        </ul>
        <?php
    }
}