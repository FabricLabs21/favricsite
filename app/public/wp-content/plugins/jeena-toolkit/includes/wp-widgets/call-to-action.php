<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

if ( class_exists( 'CSF' ) ) {
    CSF::createWidget( 'jeena_wp_cta_widget', [
        'title'       => esc_html__( '*Jeena CTA', 'jeena-toolkit' ),
        'classname'   => 'jeena-wp-cta',
        'description' => esc_html__( 'Call to Action', 'jeena-toolkit' ),
        'fields'      => [
            [
                'id'      => 'title',
                'type'    => 'text',
                'title'   => esc_html( 'Title', 'jeena-toolkit' ),
                'default' => esc_html__( 'Build Awesome Website/Template', 'jeena-toolkit' ),
            ],
            [
                'id'      => 'button_text',
                'type'    => 'text',
                'title'   => esc_html( 'Button Text', 'jeena-toolkit' ),
                'default' => esc_html( 'Contact Us', 'jeena-toolkit' ),
            ],
            [
                'id'      => 'button_url',
                'type'    => 'text',
                'title'   => esc_html( 'Button URL', 'jeena-toolkit' ),
                'default' => esc_html( '#', 'jeena-toolkit' ),
            ],
        ],
    ] );

    function jeena_wp_cta_widget( $args, $instance ) {

        $allowed_html = [
            'div' => [
                'id'    => [],
                'class' => [],
            ],
            'h3'  => [
                'class' => [],
            ],
            'h4'  => [
                'class' => [],
            ],
            'h5'  => [
                'class' => [],
            ],
            'h6'  => [
                'class' => [],
            ],
        ];

        echo wp_kses( $args['before_widget'], $allowed_html );

        if ( ! empty( $instance['title'] ) ) {
            echo wp_kses( $args['before_title'], $allowed_html ) . apply_filters( 'widget_title', $instance['title'] ) . wp_kses( $args['after_title'], $allowed_html );
        }
        ?>
        <a href="<?php esc_url( $instance['button_url'] )?>" class="jeena-button hover-normal">
            <span class="button-icon icon-align-right">
                <i class="far fa-angle-double-right"></i>
            </span>
            <span class="button-text"><?php echo esc_html( $instance['button_text'] ) ?></span>
        </a>
        <?php echo wp_kses( $args['after_widget'], $allowed_html );
    }
}