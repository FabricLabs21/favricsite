<?php
namespace JeenaToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Image_List_Box extends Widget_Base {

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
        return 'jeena-Image-list-box';
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
        return esc_html__( 'Image List Box', 'jeena-toolkit' );
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
        return ['jeena', 'toolkit', 'list', 'image', 'box'];
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
            'general_section',
            [
                'label' => esc_html__( 'Image List Box', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'jeena-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Digital Marketing', 'jeena-toolkit' ),
            ]
        );

        $this->add_control(
            'box_image',
            [
                'type'    => Controls_Manager::MEDIA,
                'label'   => esc_html__( 'Image', 'jeena-toolkit' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_text',
            [
                'label'   => esc_html__( 'Text', 'jeena-toolkit' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Exciting Feature', 'jeena-toolkit' ),
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label'            => esc_html__( 'Icon', 'jeena-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'label_block'      => false,
                'skin'             => 'inline',
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'fas fa-angle-double-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'list_items',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'label'       => esc_html( 'List Items', 'jeena-toolkit' ),
                'default'     => [
                    [
                        'list_text'     => esc_html__( 'Paid Marketing', 'jeena-toolkit' ),
                        'selected_icon' => [
                            'value'   => 'fas fa-angle-double-right',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'list_text'     => esc_html__( 'CRO', 'jeena-toolkit' ),
                        'selected_icon' => [
                            'value'   => 'fas fa-angle-double-right',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'list_text'     => esc_html__( 'Content Marketing', 'jeena-toolkit' ),
                        'selected_icon' => [
                            'value'   => 'fas fa-angle-double-right',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'list_text'     => esc_html__( 'Email Marketing', 'jeena-toolkit' ),
                        'selected_icon' => [
                            'value'   => 'fas fa-angle-double-right',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'list_text'     => esc_html__( 'SMO', 'jeena-toolkit' ),
                        'selected_icon' => [
                            'value'   => 'fas fa-angle-double-right',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ list_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_box_control',
            [
                'label' => esc_html__( 'Box Control', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_list_padding',
            [
                'label'      => esc_html__( 'Padding', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-list-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_list_margin',
            [
                'label'      => esc_html__( 'Margin', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-list-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_list_bg',
            [
                'label'     => esc_html__( 'Background Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-list-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .jeena-image-list-box',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
			[
				'name' => 'image_list_border',
				'label' => esc_html__( 'Border', 'jeena-toolkit' ),
				'selector' => '{{WRAPPER}} .jeena-image-list-box',
			]
		);

        $this->add_responsive_control(
            'image_list_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'jeena-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-list-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .jeena-image-list-box' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .jeena-image-list-box ul li' => 'justify-content: {{VALUE}};',
                ],
                'toggle'    => false,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__( 'Image', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Width', 'jeena-toolkit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jeena-image-list-box .box-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_max_width',
			[
				'label' => esc_html__( 'Max Width', 'jeena-toolkit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jeena-image-list-box .box-image img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Height', 'jeena-toolkit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jeena-image-list-box .box-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'image_gap',
			[
				'label' => esc_html__( 'Spacing(Bottom)', 'jeena-toolkit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jeena-image-list-box .box-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'image_align',
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
                    '{{WRAPPER}} .jeena-image-list-box .box-image' => 'text-align: {{VALUE}};',
                ],
                'toggle'    => false,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_list',
            [
                'label' => esc_html__( 'Title', 'jeena-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'list_title_spacing',
            [
                'label'      => esc_html__( 'Spacing', 'jeena-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jeena-image-list-box .box-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'list_title_typography',
                'selector' => '{{WRAPPER}} .jeena-image-list-box .box-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'tile_text_shadow',
                'selector' => '{{WRAPPER}} .jeena-image-list-box .box-title',
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
                    '{{WRAPPER}} .jeena-image-list-box ul li:not(:last-of-type)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'check_list_color',
            [
                'label'     => esc_html__( 'Color', 'jeena-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jeena-image-list-box li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'check_list_typography',
                'selector' => '{{WRAPPER}} .jeena-image-list-box li',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'selector' => '{{WRAPPER}} .jeena-image-list-box li .list-text',
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
                    '{{WRAPPER}} .jeena-image-list-box ul li .list-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get Currency symbol
     *
     * @param $symbol_name
     * @return void
     */

    /**
     * Render the widget output on the frontend.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    public function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'box-title' );

        ?>
        <div class="jeena-image-list-box">
            <?php if ( $settings['box_image'] ) : ?>
            <div class="box-image">
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'box_image' )?>
            </div>
            <?php endif; ?>
            <?php if ( $settings['title'] ): ?>
            <h4 <?php echo $this->get_render_attribute_string( 'title' );?>>
                <?php echo jt_kses_basic( $settings['title'] ); ?>
            </h4>
            <?php endif;?>
            <?php if ( is_array( $settings['list_items'] ) ) : ?>
            <ul class="box-list-items">
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
            <?php endif;?>
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
            view.addInlineEditingAttributes( 'title', 'none' );
            view.addRenderAttribute( 'title', 'class', 'box-title' );
        #>
        <div class="jeena-image-list-box">
            <# if ( settings.box_image ) { #>
            <div class="box-image">
                <#
                var image = {
                    id: settings.box_image.id,
                    url: settings.box_image.url,
                    size: 'full',
                };
                var image_url = elementor.imagesManager.getImageUrl( image );
                #>
                <img src="{{{ image_url }}}" />
            </div>
            <# } #>
            <# if ( settings.title ) { #>
            <h4 {{{ view.getRenderAttributeString( 'title' ) }}}>
                {{{ settings.title }}}
            </h4>
            <# } #>
            <ul class="list-items">
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
        </div>
        <?php
    }
}