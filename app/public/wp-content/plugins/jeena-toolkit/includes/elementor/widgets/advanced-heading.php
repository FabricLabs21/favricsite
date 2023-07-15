<?php
namespace jeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Advanced_Heading extends Widget_Base {

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
        return 'jeena-advanced-heading';
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
        return esc_html__( 'Advanced Heading', 'jeena-toolkit' );
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
        return 'eicon-heading webtend-logo';
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
        return ['jeena', 'toolkit', 'heading'];
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
            'section_content_heading',
            [
                'label' => esc_html__( 'Advanced Heading', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'subheading',
            [
                'label'       => esc_html__( 'Subheading', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your heading', 'jeena-toolkit' ),
                'default'     => esc_html__( 'Subheading Here', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'main_heading',
            [
                'label'       => esc_html__( 'Main Heading', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your main heading here', 'jeena-toolkit' ),
                'default'     => esc_html__( 'I am Advanced Heading', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'split_main_heading',
            [
                'label'     => esc_html__( 'Split Main Heading', 'jeena-toolkit' ),
                'separator' => 'before',
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'split_text',
            [
                'label'       => esc_html__( 'Split Text', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter your split text', 'jeena-toolkit' ),
                'default'     => esc_html__( 'Split Text', 'jeena-toolkit' ),
                'condition'   => [
                    'split_main_heading' => 'yes',
                ],
                'separator'   => 'after',
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_widget_style',
            [
                'label' => esc_html__( 'Wrapper', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-advanced-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-advanced-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .jeena-advanced-heading'             => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .jeena-advanced-heading .subheading' => 'justify-content: {{VALUE}};',
                ],
                'toggle'    => false,
            ]
        );

        $this->add_control(
            'heading_style',
            [
                'label'     => esc_html__( 'Style', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'none' => esc_html__( 'None', 'jeena-toolkit' ),
                    'line' => esc_html__( 'Line', 'jeena-toolkit' ),
                ],
                'separator' => 'before',
                'default'   => 'none',
            ]
        );

        $this->add_control(
            'heading_style_align',
            [
                'label'     => esc_html__( 'Style Position', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'both',
                'options'   => [
                    'before' => esc_html__( 'Before', 'jeena-toolkit' ),
                    'after'  => esc_html__( 'After', 'jeena-toolkit' ),
                    'both'   => esc_html__( 'After and Before', 'jeena-toolkit' ),
                    'bottom' => esc_html__( 'Bottom', 'jeena-toolkit' ),
                ],
                'condition' => [
                    'heading_style' => 'line',
                ],
            ]
        );

        $this->add_control(
            'heading_style_color',
            [
                'label'     => esc_html__( 'Style Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-advanced-heading .subheading .line' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'heading_style!' => 'none',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_style_width',
            [
                'label'     => esc_html__( 'Width', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-advanced-heading .subheading .line' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'heading_style!' => 'none',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_style_height',
            [
                'label'     => esc_html__( 'Height', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-advanced-heading .subheading .line' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'heading_style' => 'line',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_style_indent',
            [
                'label'     => esc_html__( 'Style Spacing', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'condition' => [
                    'heading_style!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-advanced-heading' => '--line-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__( 'Content', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'subheading_headline',
            [
                'label'     => esc_html__( 'Subheading', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'subheading!' => '',
                ],
            ]
        );

        $this->add_control(
            'subheading_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-advanced-heading .subheading' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'subheading!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'subheading_typography',
                'selector'  => '{{WRAPPER}} .jeena-advanced-heading .subheading',
                'condition' => [
                    'subheading!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'      => 'subheading_text_shadow',
                'selector'  => '{{WRAPPER}} .jeena-advanced-heading .subheading',
                'condition' => [
                    'subheading!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'subheading_space',
            [
                'label'     => esc_html__( 'Spacing', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .jeena-advanced-heading .subheading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'subheading!' => '',
                ],
            ]
        );

        $this->add_control(
            'main_heading_headline',
            [
                'label'     => esc_html__( 'Main Heading', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'main_heading!' => '',
                ],
            ]
        );

        $this->add_control(
            'main_heading_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-advanced-heading .main-heading' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'main_heading!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'main_heading_typography',
                'selector'  => '{{WRAPPER}} .jeena-advanced-heading .main-heading',
                'condition' => [
                    'main_heading!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'      => 'main_heading_text_shadow',
                'selector'  => '{{WRAPPER}} .jeena-advanced-heading .main-heading',
                'condition' => [
                    'main_heading!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'      => 'main_text_stroke',
                'selector'  => '{{WRAPPER}} .jeena-advanced-heading .main-heading',
                'condition' => [
                    'main_heading!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_main_split_text',
            [
                'label'     => esc_html__( 'Split Text', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'split_text_space',
            [
                'label'     => esc_html__( 'Split Space', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .jeena-advanced-heading .main-heading .split-text' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => '',
                ],
            ]
        );

        $this->add_control(
            'split_text_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-advanced-heading .main-heading .split-text' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
                ],
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'split_text_typography',
                'selector'  => '{{WRAPPER}} .jeena-advanced-heading .main-heading .split-text',
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'      => 'split_text_shadow',
                'selector'  => '{{WRAPPER}} .jeena-advanced-heading .main-heading .split-text',
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'      => 'split_text_stroke',
                'selector'  => '{{WRAPPER}} .jeena-advanced-heading .main-heading .split-text',
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => '',
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

        if ( empty( $settings['subheading'] ) && empty( $settings['main_heading'] ) ) {
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'jeena-advanced-heading' );

        if ( 'none' !== $settings['heading_style'] ) {
            $this->add_render_attribute( 'wrapper', [
                'class'           => 'line-style-' . $settings['heading_style_align'],
            ] );
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
            <?php if ( ! empty( $settings['subheading'] ) ): ?>
            <div class="subheading">
                <?php
                    $this->add_inline_editing_attributes( 'subheading', 'none' );

                    printf( '<span %1$s>%2$s</span>',
                        $this->get_render_attribute_string( 'subheading' ),
                        esc_html( $settings['subheading'] )
                    );

                    if ( 'line' === $settings['heading_style'] ) {
                        if ( 'before' === $settings['heading_style_align'] || 'both' === $settings['heading_style_align'] ) {
                            echo '<span class="line line-before"></span>';
                        }
                        if ( 'after' === $settings['heading_style_align'] || 'both' === $settings['heading_style_align'] ) {
                            echo '<span class="line line-after"></span>';
                        }
                        if ( 'bottom' === $settings['heading_style_align'] ) {
                            echo '<span class="line line-bottom"></span>';
                        }
                    }
                ?>
            </div>
            <?php endif; ?>
            <?php
                if ( ! empty( $settings['main_heading'] ) ) {
                    $this->add_render_attribute( 'main_heading', 'class', 'main-text' );
                    $this->add_inline_editing_attributes( 'main_heading', 'basic' );


                    if ( 'yes' == $settings['split_main_heading'] && ! empty( $settings['split_text'] ) ) {
                        $this->add_render_attribute( 'split_text', 'class', 'split-text' );
                        $this->add_inline_editing_attributes( 'split_text', 'none' );

                        printf( '<%1$s class="main-heading"><span %2$s>%3$s</span> <span %4$s>%5$s</span></%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'main_heading' ),
                            jt_kses_basic( $settings['main_heading'] ),
                            $this->get_render_attribute_string( 'split_text' ),
                            jt_kses_basic( $settings['split_text'] )
                        );
                    } else {
                        printf( '<%1$s class="main-heading"><span %2$s>%3$s</span></%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'main_heading' ),
                            jt_kses_basic( $settings['main_heading'] )
                        );
                    }
                }
            ?>
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
        <div class="jeena-advanced-heading line-style-{{{ settings.heading_style_align }}}">
            <# if ( settings.subheading ) { #>
                <# view.addInlineEditingAttributes( 'subheading', 'none' ); #>
                <div class="subheading">
                    <span {{{ view.getRenderAttributeString( 'subheading' ) }}}>{{{settings.subheading}}}</span>
                    <# if ( 'line' == settings.heading_style ) {
                        if ( 'before' == settings.heading_style_align || 'both' == settings.heading_style_align ) {
                            print( '<span class="line line-before"></span>' );
                        }
                        if ( 'after' == settings.heading_style_align || 'both' == settings.heading_style_align ) {
                            print( '<span class="line line-after"></span>' );
                        }
                        if ( 'bottom' == settings.heading_style_align ) {
                            print( '<span class="line line-bottom"></span>' );
                        }
                    } #>
                </div>
            <# } #>
            <# if ( settings.main_heading ) {
                view.addRenderAttribute( 'main_heading', 'class', 'main-text' );
                view.addInlineEditingAttributes( 'main_heading', 'none' ); #>

                <{{{settings.title_tag}}} class="main-heading">
                    <# if ( 'yes' == settings.split_main_heading && settings.split_text ) {
                        view.addRenderAttribute( 'split_text', 'class', 'split-text' );
                        view.addInlineEditingAttributes( 'split_text', 'none' ); #>
                        <span {{{ view.getRenderAttributeString( 'main_heading' ) }}}>{{{ settings.main_heading }}}</span>
                        <span {{{ view.getRenderAttributeString( 'split_text' ) }}}>{{{ settings.split_text }}}</span>
                    <# } else { #>
                        <span {{{ view.getRenderAttributeString( 'main_heading' ) }}}>{{{ settings.main_heading }}}</span>
                    <# } #>
                </{{{settings.title_tag}}}>
            <# } #>
        </div>
        <?php
    }
}