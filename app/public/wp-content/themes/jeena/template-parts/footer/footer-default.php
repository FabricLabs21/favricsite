<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jeena
 */

use JeenaTheme\Classes\Jeena_Helper as Helper;

$copyright = Helper::get_option( 'copyright_text', __( 'Copyright © 2023. All rights reserved.', 'jeena' ) );

?>

<footer class="site-footer default-footer">
    <?php if ( is_active_sidebar( 'footer_widgets' ) ): ?>
    <div class="footer-widgets">
        <div class="container">
            <div class="footer-widget-wrap">
                <?php dynamic_sidebar( 'footer_widgets' );?>
            </div>
        </div>
    </div>
    <?php endif;?>
    <div class="footer-copyright">
        <div class="container">
            <p>
                <?php echo esc_html( $copyright ) ?>
            </p>
        </div>
    </div>
</footer>