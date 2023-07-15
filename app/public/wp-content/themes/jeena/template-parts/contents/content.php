<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jeena
 */

use JeenaTheme\Classes\Jeena_Helper as Helper;
use JeenaTheme\Classes\Jeena_Post_Helper;

$show_category = Helper::get_option( 'archive_post_category', 'yes' );
$post_author   = Helper::get_option( 'archive_post_author', 'yes' );
$post_date     = Helper::get_option( 'archive_post_date', 'yes' );
$show_excerpt  = Helper::get_option( 'archive_post_excerpt', 'yes' );
$excerpt_count = Helper::get_option( 'post_excerpt_count', 15 );
$show_button   = Helper::get_option( 'archive_post_button', 'yes' );
$button_text   = Helper::get_option( 'post_button_text', __( 'Read More', 'jeena' ) );

?>

<article id="post-<?php the_ID();?>" <?php post_class( 'entry-post clearfix' );?>>
    <?php Jeena_Post_Helper::render_media(); ?>
    <div class="entry-summary">
        <?php
            if ( 'yes' === $show_category ) {
                echo get_the_category_list();
            }

            the_title( '<h4 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );

            if ( 'yes' === $show_excerpt ) {
                if ( has_excerpt() ) {
                    echo wpautop( wp_trim_words( get_the_excerpt(), $excerpt_count, '...' ) );
                } else {
                    echo wpautop( wp_trim_words( get_the_content(), $excerpt_count, '...' ) );
                }
            }

            if ( 'product' !== get_post_type() && ( 'yes' === $post_author || 'yes' === $post_date ) ) {
                Jeena_Post_Helper::post_archive_meta();
            }

            if ( 'yes' === $show_button && ! empty( $button_text ) ) {
                echo '<span class="line"></span>';

                if ( 'product' === get_post_type() ) {
                    echo '<a class="read-more" href="' . esc_url( get_permalink() ) . '"><span>' . esc_html__( 'View Product', 'jeena' ) . '</span> <i class="far fa-long-arrow-right"></i></a>';
                } else {
                    echo '<a class="read-more" href="' . esc_url( get_permalink() ) . '"><span>' . esc_html( $button_text ) . '</span> <i class="far fa-long-arrow-right"></i></a>';
                }
            }
        ?>
    </div>
</article>