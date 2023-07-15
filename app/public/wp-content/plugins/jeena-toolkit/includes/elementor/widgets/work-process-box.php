<?php
namespace JeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Work_Process_Box extends Widget_Base {

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
        return 'jeena-work-process-box';
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
        return esc_html__( 'Work Process Box', 'jeena-toolkit' );
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
        return 'eicon-image-box webtend-logo';
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
        return ['jeena', 'toolkit', 'work', 'process', 'horizontal', 'step'];
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
            'section_work_process',
            [
                'label' => esc_html__( 'Process Box', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'design',
            [
                'label'   => esc_html__( 'Design', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'design-one' => esc_html__( 'Design One', 'jeena-toolkit' ),
                    'design-two' => esc_html__( 'Design Two', 'jeena-toolkit' ),
                ],
                'default' => 'design-one',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label'       => esc_html__( 'Title', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter title', 'jeena-toolkit' ),
                'default'     => esc_html__( 'Discover', 'jeena-toolkit' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__( 'Description', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Our design approach is to simplify. We embrace creating something.', 'jeena-toolkit' ),
                'placeholder' => esc_html__( 'Enter your description', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'process_counter',
            [
                'label'       => esc_html__( 'Process Counter', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => '01',
            ]
        );

        $this->add_control(
            'process_img',
            [
                'label'       => esc_html__( 'Image', 'jeena-toolkit' ),
                'type'        => Controls_Manager::MEDIA,
                'render_type' => 'template',
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'design' => 'design-two',
                ],
                'separator'   => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'large',
                'exclude'   => [
                    'custom',
                ],
                'condition' => [
                    'design' => 'design-two',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_process_box',
            [
                'label' => esc_html__( 'Wrapper', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'process_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-work-process-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'process_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-work-process-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'process_text_align',
            [
                'label'   => esc_html__( 'Alignment', 'jeena-toolkit' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left'  => [
                        'title' => esc_html__( 'Left', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'jeena-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'toggle'  => false,
                'default' => 'text-left',
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

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-work-process-box .process-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jeena-work-process-box .process-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'content_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-work-process-box .process-content',
            ]
        );

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-work-process-box .process-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'content_tab' );

        $this->start_controls_tab(
            'content_box_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'content_box_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box .process-content, {{WRAPPER}} .jeena-work-process-box .process-content::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .jeena-work-process-box .process-content',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_box_hover',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'content_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box:hover .process-content, {{WRAPPER}} .jeena-work-process-box:hover .process-content::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_hover_border',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box:hover .process-content' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'content_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'info_box_hover_shadow',
                'selector' => '{{WRAPPER}} .jeena-work-process-box:hover .process-content',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_counter_style',
            [
                'label' => esc_html__( 'Counter', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'counter_size',
            [
                'label'     => esc_html__( 'Size', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box .process-counter' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'counter_typography',
                'selector' => '{{WRAPPER}} .jeena-work-process-box .process-counter',
            ]
        );

        $this->add_responsive_control(
            'counter_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-work-process-box .process-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'counter_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-work-process-box .process-counter',
            ]
        );

        $this->add_responsive_control(
            'counter_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-work-process-box .process-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'counter_tabs' );

        $this->start_controls_tab(
            'counter_box_normal',
            [
                'label' => esc_html__( 'Normal', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'counter_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box .process-counter' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box .process-counter' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'counter_shadow',
                'selector' => '{{WRAPPER}} .jeena-work-process-box .process-counter',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'counter_hover',
            [
                'label' => esc_html__( 'Hover', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'counter_hover_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box:hover .process-counter' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box:hover .process-counter' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_hover_border',
            [
                'label'     => esc_html__( 'Border Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box:hover .process-counter' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'counter_hover_shadow',
                'selector' => '{{WRAPPER}} .jeena-work-process-box:hover .process-counter',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_color_typo',
            [
                'label' => esc_html__( 'Color & Typography', 'jeena-toolkit' ),
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
                    '{{WRAPPER}} .jeena-work-process-box .process-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box:hover .process-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .jeena-work-process-box .process-title',
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
            [
                'label'     => esc_html__( 'Spacing', 'jeena-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box .process-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'desc_heading',
            [
                'label'     => esc_html__( 'Description', 'jeena-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box .process-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box:hover .process-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'selector' => '{{WRAPPER}} .jeena-work-process-box .process-content p',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_image_section',
            [
                'label'     => esc_html__( 'Image', 'jeena-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design' => 'design-two',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-work-process-box .process-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'img_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .jeena-work-process-box .process-thumbnail img',
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-work-process-box .process-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'img_border_hover_color',
            [
                'label'     => esc_html__( 'Border Color(Hover)', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-work-process-box:hover .process-thumbnail img' => 'border-color: {{VALUE}};',
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
        $wrapper_class = 'jeena-work-process-box' . ' ' . $settings['design'] . ' ' . $settings['process_text_align'];
        ?>
        <div class="<?php echo esc_attr( $wrapper_class ) ?>">
            <?php if ( 'design-two' === $settings['design'] ) : ?>
            <div class="process-thumbnail">
                <?php echo Group_Control_Image_Size::print_attachment_image_html( $settings, 'thumbnail', 'process_img' )?>
                <?php
                    if ( $settings['process_counter'] ) {
                        echo '<div class="process-counter">'. esc_html( $settings['process_counter'] ) .'</div>';
                    }
                ?>
            </div>
            <?php else :
                if ( $settings['process_counter'] ) {
                    echo '<div class="process-counter">'. esc_html( $settings['process_counter'] ) .'</div>';
                }
            endif; ?>
            <div class="process-content">
                <?php
                    if ( ! empty( $settings['title_text'] ) ) {
                        $this->add_inline_editing_attributes( 'title_text', 'none' );
                        $this->add_render_attribute( 'title_text', 'class', 'process-title' );

                        printf( '<h4 %1$s>%2$s</h4>',
                            $this->get_render_attribute_string( 'title_text' ),
                            wp_kses_post( $settings['title_text'] )
                        );
                    }
                    if ( ! empty( $settings['description_text'] ) ) {
                        $this->add_inline_editing_attributes( 'description_text', 'none' );
                        $this->add_render_attribute( 'description_text', 'class', 'process-description' );

                        printf( '<p %1$s>%2$s</p>',
                            $this->get_render_attribute_string( 'description_text' ),
                            jt_kses_basic( $settings['description_text'] )
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
            var wrapper_class = 'jeena-work-process-box' + ' ' + settings.design + ' ' + settings.process_text_align;
        #>
        <div class="{{{ wrapper_class }}}">
            <# if ( 'design-two' == settings.design ) { #>
            <div class="process-thumbnail">
                <#
                    var image = {
                        id: settings.process_img.id,
                        url: settings.process_img.url,
                        size: settings.thumbnail_size,
                    };
                    var image_url = elementor.imagesManager.getImageUrl( image );
                #>
                <img src="{{{ image_url }}}" />

                <# if ( settings.process_counter ) { #>
                <div class="process-counter">{{{ settings.process_counter }}}</div>
                <# } #>
            </div>
            <# } else { #>
                <# if ( settings.process_counter ) { #>
                <div class="process-counter">{{{ settings.process_counter }}}</div>
                <# } #>
            <# } #>
            <div class="process-content">
                <#
                    if ( settings.title_text ) {
                            view.addInlineEditingAttributes( 'title_text', 'none' );
                            view.addRenderAttribute( 'title_text', 'class', 'process-title' );

                            var title_html = '<h4 ' + view.getRenderAttributeString( 'title_text' ) + '>' + settings.title_text + '</h4>';
                            print( title_html );
                    }

                    if ( settings.description_text ) {
                            view.addInlineEditingAttributes( 'description_text', 'none' );
                            view.addRenderAttribute( 'description_text', 'class', 'process-description' );

                            var title_html = '<p ' + view.getRenderAttributeString( 'description_text' ) + '>' + settings.description_text + '</p>';
                            print( title_html );
                    }
                #>
            </div>
        </div>
        <?php
    }
}