<?php
/**
 * The sidebar containing the Primary widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jeena
 */

use JeenaTheme\Classes\Jeena_Helper as Helper;

if ( 'no-sidebar' === Helper::content_sidebar() || ! is_active_sidebar( 'primary_sidebar' ) ) {
    return;
}
?>

<div class="sidebar-area">
	<div class="primary-sidebar widget-area">
		<?php dynamic_sidebar( 'primary_sidebar' );?>
	</div>
</div>
