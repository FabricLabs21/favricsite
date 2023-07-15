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
$back_to_top = Helper::get_option( 'back_to_top', true );
$back_top_class = 'back-to-top'; ;

if ( Helper::get_option( 'back_to_top_mobile', false ) ) {
    $back_top_class = 'back-to-top show-on-mobile';
}

?>
    </main>
    <?php if( $back_to_top ) : ?>
    <a href="#" id="backToTop" class="<?php echo esc_attr( $back_top_class ) ?>">
        <i class="far fa-arrow-up"></i>
    </a>
    <?php endif; ?>
    <?php
        if (  class_exists( 'Jeena_Toolkit' ) ) {
            do_action( "jeena_builder_after_main" );
        }

        if( 'enabled' === Helper::check_default_footer() ) {
            get_template_part( 'template-parts/footer/footer', 'default' );
        }
    ?>
</div>

<?php wp_footer();?>

</body>
</html>
