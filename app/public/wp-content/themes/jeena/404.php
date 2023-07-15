<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Jeena
 */

use JeenaTheme\Classes\Jeena_Helper as Helper;

wp_head();

$error_title    = Helper::get_option( 'error_title', __( 'OPPS! This Pages Are Can’t Be Found', 'jeena' ) );
$error_subtitle = Helper::get_option( 'error_subtitle', __( 'The page you are looking for was moved, removed, renamed or might never existed.', 'jeena' ) );
$button_text    = Helper::get_option( 'error_button_text', __( 'Go to Home', 'jeena' ) );

$error_img  = Helper::get_option( 'error_img', ['url' => JEENA_ASSETS . '/img/404-img.png'] );
$error_logo = Helper::get_option( 'error_logo', ['url' => JEENA_ASSETS . '/img/logo.png'] );

?>
<div class="container">
    <div class="error-content-area">
        <?php if ( ! empty ( $error_logo['url'] ) ) : ?>
        <div class="error-logo">
            <img src="<?php echo esc_url( $error_logo['url'] ) ?>">
        </div>
        <?php endif; ?>
        <?php if ( ! empty ( $error_img['url'] ) ) : ?>
        <div class="error-illustration">
            <img src="<?php echo esc_url( $error_img['url'] ) ?>">
        </div>
        <?php endif; ?>
        <div class="error-content">
            <?php if ( $error_title ): ?>
            <h2 class="error-title"><?php echo esc_html( $error_title ) ?></h2>
            <?php endif;?>
            <?php if ( $error_subtitle ): ?>
            <p class="error-subtitle"><?php echo esc_html( $error_subtitle ) ?></p>
            <?php endif;?>
            <a class="jeena-button hover-normal" href="<?php echo esc_url( home_url( '/' ) ) ?>">
                <span class="button-icon icon-align-right"><i class="fas fa-long-arrow-right"></i></span>
                <span class="button-text"><?php echo esc_html( $button_text ) ?></span>
            </a>
        </div>
    </div>
</div>
<?php
wp_footer();