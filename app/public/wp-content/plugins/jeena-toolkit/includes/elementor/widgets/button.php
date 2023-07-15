<?php
namespace JeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Button extends Widget_Base {

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
        return 'jeena-button';
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
        return esc_html__( 'Button', 'jeena-toolkit' );
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
        return 'eicon-button webtend-logo';
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
        return ['jeena', 'toolkit', 'button', 'link'];
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
            'text',
            [
                'label'       => esc_html__( 'Text', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Click here', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Click here', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => esc_html__( 'Link', 'jeena-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'jeena-toolkit' ),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
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
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .jeena-button-wrapper' => 'text-align: {{Value}};',
                ],
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label'       => esc_html__( 'Icon', 'jeena-toolkit' ),
                'type'        => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin'        => 'inline',
                'label_block' => false,
                'default'          => [
                    'value'   => 'far fa-long-arrow-right',
                    'library' => 'fa-regular',
                ],
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label'     => esc_html__( 'Icon Position', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'right',
                'options'   => [
                    'left'  => esc_html__( 'Before', 'jeena-toolkit' ),
                    'right' => esc_html__( 'After', 'jeena-toolkit' ),
                ],
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_indent',
            [
                'label'     => esc_html__( 'Icon Spacing', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-button .icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jeena-button .icon-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_css_id',
            [
                'label'       => esc_html__( 'Button ID', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => '',
                'title'       => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'jeena-toolkit' ),
                'description' => sprintf(
                    /* translators: 1: Code open tag, 2: Code close tag. */
                    esc_html__( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows %1$sA-z 0-9%2$s & underscore chars without spaces.', 'jeena-toolkit' ),
                    '<code>',
                    '</code>'
                ),
                'separator'   => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Button', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-button-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_width',
            [
                'label'      => esc_html__( 'Width', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_content_align',
            [
                'label'     => esc_html__( 'Content Align', 'jeena-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'start'         => [
                        'title' => esc_html__( 'Left', 'jeena-toolkit' ),
                        'icon'  => 'eicon-justify-start-h',
                    ],
                    'center'        => [
                        'title' => esc_html__( 'Center', 'jeena-toolkit' ),
                        'icon'  => 'eicon-justify-center-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'jeena-toolkit' ),
                        'icon'  => 'eicon-justify-space-between-h',
                    ],
                    'end'           => [
                        'title' => esc_html__( 'Right', 'jeena-toolkit' ),
                        'icon'  => 'eicon-justify-end-h',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-button' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label'     => esc_html__( 'Hover Animation', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'hover-normal'     => esc_html__( 'Effect A', 'jeena-toolkit' ),
                    'hover-left'       => esc_html__( 'Effect B', 'jeena-toolkit' ),
                    'hover-right'      => esc_html__( 'Effect C', 'jeena-toolkit' ),
                    'hover-left-right' => esc_html__( 'Effect D', 'jeena-toolkit' ),
                    'hover-top'        => esc_html__( 'Effect E', 'jeena-toolkit' ),
                    'hover-bottom'     => esc_html__( 'Effect F', 'jeena-toolkit' ),
                    'hover-top-bottom' => esc_html__( 'Effect G', 'jeena-toolkit' ),
                ],
                'default'   => 'hover-normal',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .jeena-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'selector' => '{{WRAPPER}} .jeena-button',
            ]
        );

        $this->add_control(
            'border_radius',
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
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'selector' => '{{WRAPPER}} .jeena-button',
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
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_hover_shadow',
                'selector' => '{{WRAPPER}} .jeena-button:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'hover_box_shadow',
                'selector' => '{{WRAPPER}} .jeena-button:hover',
            ]
        );

        $this->add_control(
            'hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-button:hover ' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render button text.
     *
     * Render button widget text.
     *
     * @since 1.5.0
     * @access protected
     */
    protected function render_text() {
        $settings = $this->get_settings_for_display();

        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        if ( ! $is_new && empty( $settings['icon_align'] ) ) {
            $settings['icon_align'] = $this->get_settings( 'icon_align' );
        }

        $this->add_render_attribute( [
            'icon-align' => [
                'class' => [
                    'button-icon',
                    'icon-align-' . $settings['icon_align'],
                ],
            ],
            'text'       => [
                'class' => 'button-text',
            ],
        ] );

        $this->add_inline_editing_attributes( 'text', 'none' );

        if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ):
        ?>
        <span <?php $this->print_render_attribute_string( 'icon-align' );?>>
            <?php
                if ( $is_new || $migrated ) {
                    Icons_Manager::render_icon( $settings['selected_icon'], ['aria-hidden' => 'true'] );
                } else {
                    printf( '<i class="%1$s" aria-hidden="true"></i>',
                        esc_attr( $settings['icon'] )
                    );
                }
            ?>
        </span>
        <?php endif;?>
        <span <?php $this->print_render_attribute_string( 'text' );?>>
            <?php $this->print_unescaped_setting( 'text' );?>
        </span>
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

        $this->add_render_attribute( 'wrapper', 'class', 'jeena-button-wrapper' );

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'button', $settings['link'] );
        }

        $this->add_render_attribute( 'button', 'class', 'jeena-button' );

        if ( ! empty( $settings['button_css_id'] ) ) {
            $this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
        }

        if ( $settings['hover_animation'] ) {
            $this->add_render_attribute( 'button', 'class', $settings['hover_animation'] );
        }

        ?>
		<div <?php $this->print_render_attribute_string( 'wrapper' );?>>
			<a <?php $this->print_render_attribute_string( 'button' );?>>
				<?php $this->render_text();?>
			</a>
		</div>
		<?php
    }

    /**
     * Render button widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
    protected function content_template() {
        ?>
		<#
		view.addRenderAttribute( 'text', 'class', 'button-text' );
		view.addInlineEditingAttributes( 'text', 'none' );
		var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' );
		#>
		<div class="jeena-button-wrapper">
			<a id="{{ settings.button_css_id }}" class="jeena-button {{ settings.hover_animation }}" href="{{ settings.link.url }}">
                <# if ( settings.icon || settings.selected_icon.value ) { #>
                <span class="button-icon icon-align-{{ settings.icon_align }}">
                    <# if ( ( migrated || ! settings.icon ) && iconHTML.rendered ) { #>
                        {{{ iconHTML.value }}}
                    <# } else { #>
                        <i class="{{ settings.icon }}" aria-hidden="true"></i>
                    <# } #>
                </span>
                <# } #>
                <span {{{ view.getRenderAttributeString( 'text' ) }}}>
                    {{{ settings.text }}}
                </span>
			</a>
		</div>
		<?php
    }
}