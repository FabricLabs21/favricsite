<?php
namespace JeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Plugin;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Offcanvas extends Widget_Base {

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
        return 'jeena-offcanvas';
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
        return esc_html__( 'Offcanvas', 'jeena-toolkit' );
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
        return 'eicon-apps webtend-logo';
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
        return ['jeena', 'toolkit', 'header', 'footer', 'nav', 'menu'];
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
            'template_id',
            [
                'label'   => esc_html__( 'Select Template', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => jt_select_builder_block( 'offcanvas' ),
                'default'   => '0',
            ]
        );

        $this->add_control(
            'toggle_align',
            [
                'label'   => esc_html__( 'Toggle Alignment', 'jeena-toolkit' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
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
                'default' => 'right',
                'toggle'  => false,
            ]
        );

        $this->add_control(
            'canvas_position',
            [
                'label'   => esc_html__( 'Canvas Position', 'jeena-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'left'  => esc_html__( 'Left', 'jeena-toolkit' ),
                    'right' => esc_html__( 'Right', 'jeena-toolkit' ),
                ],
                'default' => 'right',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style',
            [
                'label' => esc_html__( 'Toggle', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toggle_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-offcanvas .offcanvas-toggle span' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-offcanvas .offcanvas-toggle:hover span' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'close_style',
            [
                'label' => esc_html__( 'Close', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'close_width_height',
            [
                'label'      => esc_html__( 'Size', 'jeena-toolkit' ),
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
                    '{{WRAPPER}} .jeena-offcanvas .offcanvas-close' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'close_bg',
            [
                'label'     => esc_html__( 'Background', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-offcanvas .offcanvas-close' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'close_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-offcanvas .offcanvas-close' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'canvas_style',
            [
                'label' => esc_html__( 'Canvas', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overly_color',
            [
                'label'     => esc_html__( 'Overly Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-offcanvas-wrapper .offcanvas-overly' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'canvas_width',
            [
                'label'       => esc_html__( 'Width', 'jeena-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => 100,
                'max'         => 2000,
                'selectors'   => [
                    '{{WRAPPER}} .jeena-offcanvas-wrapper .offcanvas-container' => 'width: {{VALUE}}px;',
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

        if ( ! $settings['template_id'] ) {
            return;
        }

        $this->add_render_attribute( 'toggle', [
            'class' => 'offcanvas-toggle toggle-' . esc_attr( $settings['toggle_align'] ),
        ] );

        ?>
        <div class="jeena-offcanvas">
            <div <?php echo $this->get_render_attribute_string( 'toggle' ); ?>>
                <div class="toggle-inner">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="jeena-offcanvas-wrapper offcanvas-<?php echo esc_attr( $settings['canvas_position'] ) ?>">
                <div class="offcanvas-overly"></div>
                <div class="offcanvas-container">
                    <div class="offcanvas-close"><i class="fal fa-times"></i></div>
                    <?php echo Plugin::$instance->frontend->get_builder_content_for_display( $settings['template_id'], true ); ?>
                </div>
            </div>
        </div>
        <?php
    }
}