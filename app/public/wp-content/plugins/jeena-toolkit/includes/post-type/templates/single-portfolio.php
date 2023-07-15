<?php
/**
 * Template for Portfolio CPT single page
 *
 * @since 1.0.0
 */

use JeenaTheme\Classes\Jeena_Helper as Helper;

get_header();

?>

<div class="<?php Helper::container()?>">
	<div class="content-area">
		<?php the_content(); ?>
	</div>
</div>

<?php
get_footer();