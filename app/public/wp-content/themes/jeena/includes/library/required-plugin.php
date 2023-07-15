<?php
/**
 * Required Plugin for Jeena theme
 *
 * @package Jeena
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

add_action( 'tgmpa_register', 'jeena_register_required_plugins' );
function jeena_register_required_plugins() {
    $plugins = [
        [
            'name'     => esc_html__( 'Elementor Website Builder', 'jeena' ),
            'slug'     => 'elementor',
            'required' => true,
            'version'  => '3.0',
        ],
        [
            'name'     => esc_html__( 'Jeena Toolkit', 'jeena' ),
            'slug'     => 'jeena-toolkit',
            'source'   => JEENA_INCLUDES . '/library/plugins/jeena-toolkit.zip',
            'required' => true,
            'version'  => '1.0.1',
        ],
        [
            'name'     => esc_html__( 'MetForm', 'jeena' ),
            'slug'     => 'metform',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'WooCommerce', 'jeena' ),
            'slug'     => 'woocommerce',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'One Click Demo Import', 'jeena' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ],
    ];

    $config = [
        'default_path' => '',
        'menu'         => 'jeena_install_plugins',
        'has_notices'  => true,
        'dismissable'  => false,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    ];

    tgmpa( $plugins, $config );
}
