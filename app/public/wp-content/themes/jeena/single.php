<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Jeena
 */

use JeenaTheme\Classes\Jeena_Helper as Helper;

get_header();
?>
<div class="<?php Helper::container()?>">
    <div class="content-area">
        <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();

            get_template_part( 'template-parts/contents/content', 'single' );

            endwhile; endif;
        ?>
    </div>
    <?php get_sidebar(); ?>
</div>
<?php
get_footer();