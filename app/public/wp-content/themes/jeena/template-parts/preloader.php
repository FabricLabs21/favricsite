<?php
/**
 * Template part for site preloader
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jeena
 */
use JeenaTheme\Classes\Jeena_Helper as Helper;
$preloader_text = strtoupper( Helper::get_option( 'preloader_text', __( 'Jeena', 'jeena' ) ) );
$loading_text = Helper::get_option( 'preloader_loading_text', __( 'Loading', 'jeena' ) );

if ( defined( 'ELEMENTOR_VERSION' ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
    echo '';
} else {
    ?>
    <div class="site-preloader" id="preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="text-loading">
                <?php
                    if ( ! empty( $preloader_text ) ) {
                        $preloader_text_arr = str_split( $preloader_text );

                        if ( is_array( $preloader_text_arr ) ) {
                            foreach ( $preloader_text_arr as $pt_ti ) {
                                ?>
                                <span data-text-preloader="<?php echo esc_attr($pt_ti) ?>" class="letters-loading">
                                    <?php echo esc_html($pt_ti) ?>
                                </span>
                                <?php
                            }
                        }
                    }
                ?>
            </div>
            <p class="loading-text"><?php echo esc_html( $loading_text ) ?></p>
        </div>
        <div class="preloader-layer layer-one">
            <div class="overly"></div>
        </div>
        <div class="preloader-layer layer-two">
            <div class="overly"></div>
        </div>
        <div class="preloader-layer layer-three">
            <div class="overly"></div>
        </div>
    </div>
    <?php
    }
?>