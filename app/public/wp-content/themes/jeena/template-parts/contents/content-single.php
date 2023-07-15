<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jeena
 */

use JeenaTheme\Classes\Jeena_Helper as Helper;
use JeenaTheme\Classes\Jeena_Post_Helper;

$show_post_share   = Helper::get_option( 'blog_details_share', 'no' );
$show_tag          = Helper::get_option( 'blog_details_tag', 'yes' );
$show_nav          = Helper::get_option( 'blog_details_nav', 'yes' );
$author_info       = Helper::get_option( 'blog_author_info', 'no' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry-post-details clearfix'); ?>>
    <?php
        Jeena_Post_Helper::render_media();
    ?>
    <div class="entry-content clearfix">
        <?php
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'jeena') . '</span>',
                'after' => '</div>',
            ));
        ?>
    </div>
    <?php if ( ( 'yes' === $show_tag && has_tag() ) || 'yes' === $show_post_share ) : ?>
    <div class="entry-tags-share">
        <?php if ( 'yes' === $show_tag && has_tag() ) : ?>
        <div class="related-tags-wrap">
            <?php
                echo '<h6>'. esc_html__( 'Tags', 'jeena' ) .':</h6>';
                the_tags('<div class="tags-list">', '', '</div>');
            ?>
        </div>
        <?php endif; ?>
        <?php if ( function_exists( 'jt_post_share_links' ) && 'yes' === $show_post_share ) : ?>
        <div class="post-share-wrap">
            <?php
                echo '<h6>'. esc_html__( 'Share', 'jeena' ) .':</h6>';
                jt_post_share_links();
            ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php
        if ( 'yes' === $author_info ) {
            Jeena_Post_Helper::post_author_info();
        }

        if ( 'yes' === $show_nav ) {
            Jeena_Post_Helper::post_navigation();
        }

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
    ?>
</article>