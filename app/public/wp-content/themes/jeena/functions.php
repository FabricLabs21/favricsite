<?php
/**
 * Jeena functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Jeena
 */

/**
 * Define constant
 */
$theme = wp_get_theme();

define( 'JEENA_NAME', $theme['Name'] );
define( 'JEENA_VERSION', $theme['Version'] );
define( 'JEENA_PATH', untrailingslashit( get_template_directory() ) );
define( 'JEENA_URI', untrailingslashit( get_template_directory_uri() ) );
define( 'JEENA_ASSETS', untrailingslashit( get_template_directory_uri() ) . '/assets' );
define( 'JEENA_INCLUDES', JEENA_PATH . '/includes' );
define( 'JEENA_CLASSES', JEENA_PATH . '/includes/classes' );
define( 'JEENA_ADMIN', JEENA_PATH . '/includes/admin' );
define( 'JEENA_IS_RTL', is_rtl() ? true : false );

/**
 * Load theme files
 */
require_once JEENA_CLASSES . '/class-setup.php';
require_once JEENA_CLASSES . '/class-helper.php';
require_once JEENA_CLASSES . '/class-assets.php';
require_once JEENA_CLASSES . '/class-post-helper.php';
require_once JEENA_CLASSES . '/class-comment-walker.php';
require_once JEENA_CLASSES . '/class-breadcrumb.php';
require_once JEENA_ADMIN . '/class-admin-panel.php';
require_once JEENA_INCLUDES . '/library/class-tgm-plugin-activation.php';
require_once JEENA_INCLUDES . '/library/required-plugin.php';

if ( class_exists( 'Woocommerce' ) ) {
    require_once JEENA_CLASSES . '/class-woocommerce.php';
}