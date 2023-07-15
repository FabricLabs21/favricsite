<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jeena
 */

use JeenaTheme\Classes\Jeena_Helper as Helper;

?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <a href="https://api.whatsapp.com/send/?phone=56981381295&text=Hola%2C+necesito+hacer+una+consulta.&type=phone_number&app_absent=0" target="_blank" rel="noopener">
    <div style="z-index: 9999; position:fixed; bottom:30px; left:30px; width:60px; height:60px; background-color:#25d366; color:#fff; border-radius:50%; text-align:center; font-size:30px; line-height:60px;">
    <i class="fa fa-whatsapp"></i>
    </div>
</a>

	<?php wp_head();?>
</head>

<body <?php body_class();?>>
<?php wp_body_open();?>
<div id="jeena-page" class="jeena-body-content">
    <?php
        if ( 'enabled' === Helper::get_option( 'site_preloader', 'enabled' ) ) {
            get_template_part( 'template-parts/preloader' );
        }

        if (  class_exists( 'Jeena_Toolkit' ) ) {
            do_action( "jeena_builder_before_main" );
        }

        if( 'enabled' === Helper::check_default_header() ) {
            get_template_part( 'template-parts/header/header', 'default' );
        }
    ?>
    <main id="jeena-content" class="jeena-content-area">
        <?php get_template_part( 'template-parts/page-title' ); ?>