<?php
namespace JeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Hotline extends Widget_Base {

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
        return 'jeena-hotline';
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
        return esc_html__( 'Hotline', 'jeena-toolkit' );
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
        return 'eicon-headphones webtend-logo';
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
        return ['jeena', 'toolkit', 'button', 'hotline', 'phone'];
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
            'title',
            [
                'label'       => esc_html__( 'Title', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Hotline', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Hotline', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'text',
            [
                'label'       => esc_html__( 'Text', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( '+000 (123) 456 88', 'jeena-toolkit' ),
                'placeholder' => esc_html__( '+000 000 0000', 'jeena-toolkit' ),
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

        $this->add_control(
            'selected_icon',
            [
                'label'            => esc_html__( 'Icon', 'jeena-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin'             => 'inline',
                'label_block'      => false,
                'default'          => [
                    'value'   => 'fas fa-phone',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => esc_html__( 'Icon', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_width_height',
            [
                'label'      => esc_html__( 'Size', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-hotline .hotline-icon' => 'height: {{SIZE}}{{UNIT}}; weight: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
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
                    '{{WRAPPER}} .jeena-hotline .hotline-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .jeena-hotline .hotline-icon'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .jeena-hotline .hotline-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label'     => esc_html__( 'Background', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .jeena-hotline .hotline-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border',
                'selector' => '{{WRAPPER}} .jeena-hotline .hotline-icon',
            ]
        );

        $this->add_control(
            'icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-hotline .hotline-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .jeena-hotline .hotline-icon',
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
                    '{{WRAPPER}} .jeena-hotline .hotline-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .jeena-hotline .hotline-title',
            ]
        );

        $this->add_control(
            'desc_heading',
            [
                'label'     => esc_html__( 'Link', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-hotline .hotline-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_link_color',
            [
                'label'     => esc_html__( 'Hover Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-hotline .hotline-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'link_typography',
                'selector' => '{{WRAPPER}} .jeena-hotline .hotline-link',
            ]
        );

        $this->add_responsive_control(
            'link_gap',
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
                    '{{WRAPPER}} .jeena-hotline .hotline-link' => 'margin-top: {{SIZE}}{{UNIT}};',
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
    protected function render() {
        $settings = $this->get_settings_for_display();

        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        ?>
		<div class="jeena-hotline">
            <?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ): ?>
            <div class="hotline-icon">
                <?php
                if ( $is_new || $migrated ) {
                    Icons_Manager::render_icon( $settings['selected_icon'], ['aria-hidden' => 'true'] );
                } else {
                    printf( '<i class="%1$s" aria-hidden="true"></i>',
                        esc_attr( $settings['icon'] )
                    );
                }
                ?>
            </div>
            <?php endif;?>
            <div class="content">
                <?php
                if( $settings['title'] ) {
                    $this->add_inline_editing_attributes( 'title', 'none' );
                    $this->add_render_attribute( 'title', 'class', 'hotline-title' );

                    printf( '<span %1$s>%2$s</span>',
                        $this->get_render_attribute_string( 'title' ),
                        esc_html( $settings['title'] )
                    );
                }
                if( $settings['text'] ) {
                    $this->add_inline_editing_attributes( 'text', 'none' );
                    $this->add_render_attribute( 'text', 'class', 'hotline-link' );
                    if ( ! empty( $settings['link']['url'] ) ) {
                        $this->add_link_attributes( 'text', $settings['link'] );
                    }

                    printf( '<a %1$s>%2$s</a>',
                        $this->get_render_attribute_string( 'text' ),
                        esc_html( $settings['text'] )
                    );
                }
                ?>
            </div>
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
        var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' );
        #>
        <div class="jeena-hotline">
            <# if ( settings.icon || settings.selected_icon.value ) { #>
            <div class="hotline-icon">
                <# if ( ( migrated || ! settings.icon ) && iconHTML.rendered ) { #>
                    {{{ iconHTML.value }}}
                <# } else { #>
                    <i class="{{ settings.icon }}" aria-hidden="true"></i>
                <# } #>
            </div>
            <# } #>
            <div class="content">
                <#
                    if ( settings.title ) {
                        view.addInlineEditingAttributes( 'title', 'none' );
                        view.addRenderAttribute( 'title', 'class', 'hotline-title' );
                        view.addRenderAttribute( 'title', 'href', '#' );
                        #>
                        <span {{{ view.getRenderAttributeString( 'title' ) }}}>
                            {{{ settings.title }}}
                        </span>
                        <#
                    }
                    if ( settings.text ) {
                        view.addInlineEditingAttributes( 'text', 'none' );
                        view.addRenderAttribute( 'text', 'class', 'hotline-link' );
                        #>
                        <a {{{ view.getRenderAttributeString( 'text' ) }}}>
                            {{{ settings.text }}}
                        </a>
                        <#
                    }
                #>
            </div>
		</div>
        <?php
    }
}