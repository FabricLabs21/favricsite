<?php
namespace JeenaToolkit\ElementorAddon\Templates;

use Elementor\Icons_Manager;
use JeenaTheme\Classes\Jeena_Post_Helper;
use WP_Query;

defined( 'ABSPATH' ) || exit;

/**
 * Portfolio Template
 */
class Posts_Template {
    /**
     * Render Template
     *
     * @param array $settings
     * @return void
     */
    public function render( $settings ) {
        $wrapper = 'jeena-post-boxes ' . $settings['design'];

        if( 'slider' == $settings['layout'] ) {
            $wrapper = 'jeena-post-boxes jeena-slider-wrapper ' . $settings['design'];
        }
        ?>
        <div class="<?php echo esc_attr( $wrapper ); ?>">
            <?php if( 'grid' == $settings['layout'] ) : ?>
                <?php $this->render_loop( $settings );?>
            <?php elseif( 'slider' == $settings['layout'] ) : ?>
                <div class="jeena-slider-active">
                    <?php $this->render_loop( $settings );?>
                </div>

                <?php if ( 'yes' === $settings['show_arrows'] ): ?>
                <div class="jeena-slider-arrows <?php echo esc_attr( $settings['arrow_position'] ) ?>">
                    <div class="arrow-prev" role="button">
                        <?php Icons_Manager::render_icon( $settings['arrow_prev'], ['aria-hidden' => 'true'] );?>
                    </div>
                    <div class="arrow-next" role="button">
                        <?php Icons_Manager::render_icon( $settings['arrow_next'], ['aria-hidden' => 'true'] );?>
                    </div>
                </div>
                <?php endif;?>

                <?php if ( 'yes' === $settings['show_dots'] ): ?>
                <div class="jeena-slider-dots dots-<?php echo esc_attr( $settings['dots_nav_align'] ) ?>"></div>
                <?php endif;?>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render Loop
     *
     * @param array $settings
     * @return void
     */
    public function render_loop( $settings ) {
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $args = [
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => $settings['post_limit'],
            'orderby'             => $settings['order_by'],
            'order'               => $settings['sort_order'],
            'ignore_sticky_posts' => 1,
            'paged'               => $paged
        ];

        if ( 'categories' == $settings['post_from'] && $settings['cat_slugs'] ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => $settings['cat_slugs'],
                ],
            ];
        }

        if ( 'specific-post' == $settings['post_from'] && $settings['post_ids'] ) {
            $args['post__in'] = $settings['post_ids'];
        }

        $wp_query = new WP_Query( $args );

        while ( $wp_query->have_posts() ): $wp_query->the_post();
            if ( 'grid' == $settings['layout'] ) :
                self::render_post_item( $settings );
            elseif( 'slider' == $settings['layout'] ) : ?>
                <div class="jeena-slider-item">
                    <?php self::render_post_item( $settings ); ?>
                </div>
            <?php endif;
        endwhile;
        wp_reset_postdata();

        if ( 'yes' === $settings['show_pagination'] ) {
            Jeena_Post_Helper::pagination( $wp_query );
        }
    }

    /**
     * Render Render portfolio Item
     *
     * @param array $settings
     * @return void
     */
    public static function render_post_item( $settings ) {
        $idd             = get_the_ID();
        $categories_list = get_the_term_list( $idd, 'category', '<div class="post-categories">', '', '</div>' );

        if ( $settings['title_word'] ) {
            $the_title = wp_trim_words( get_the_title(), $settings['title_word'], '..' );
        } else {
            $the_title = get_the_title();
        }

        $excerpt_count = $settings['excerpt_count'];
        $active_meta   = $settings['active_meta'];
        ?>
        <div class="jeena-post-box">
            <?php if ( has_post_thumbnail() && 'yes' === $settings['show_thumbnail'] ): ?>
            <div class="post-thumbnail">
                <?php
                echo get_the_post_thumbnail( $idd, $settings['post_thumbnail_size'] );
                if ( 'yes' === $settings['show_category'] ) {
                    echo $categories_list;
                }
                ?>
            </div>
            <?php endif;?>
            <div class="post-content">
                <?php self::render_date_comments( $active_meta );?>
                <<?php echo jt_escape_tags( $settings['title_tag'], 'h4' ); ?> class="post-title">
                    <a href="<?php echo get_the_permalink() ?>">
                        <?php echo $the_title; ?>
                    </a>
                </<?php echo jt_escape_tags( $settings['title_tag'], 'h4' ); ?>>
                <?php
                    if ( 'after-title' === $settings['author_position'] ) {
                        self::render_post_author( $active_meta, $settings['author_photo'], $settings['author_note']  );
                    }
                    if ( 'yes' === $settings['show_excerpt'] ) {
                        if ( has_excerpt() ) {
                            echo wpautop( wp_trim_words( get_the_excerpt(), $excerpt_count, '...' ) );
                        } else {
                            echo wpautop( wp_trim_words( get_the_content(), $excerpt_count, '...' ) );
                        }
                    }
                ?>
                <?php if ( ( ! in_array( 'author', $active_meta ) && 'at-footer' === $settings['author_position'] ) || ( 'yes' === $settings['show_read_more'] && ! empty( $settings['read_more_text'] ) )  ) : ?>
                <div class="content-footer">
                    <?php
                    if ( 'at-footer' === $settings['author_position'] ) {
                        self::render_post_author( $active_meta, $settings['author_photo'], $settings['author_note'] );
                    }
                    if ( 'yes' === $settings['show_read_more'] && ! empty( $settings['read_more_text'] ) ): ?>
                    <a href="<?php echo esc_url( get_permalink() ) ?>" class="read-more">
                        <?php
                        echo esc_html( $settings['read_more_text'] );
                        Icons_Manager::render_icon( $settings['read_more_icon'], ['aria-hidden' => 'true'] );
                        ?>
                    </a>
                    <?php endif;?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render Post Date & Comments
     *
     * @param array $active_meta
     * @return void
     */
    public static function render_date_comments( $active_meta ) {
        if ( ! in_array( 'date', $active_meta ) && ! in_array( 'comments', $active_meta ) ) {
            return;
        }
        ?>
        <div class="post-date-comment">
            <?php if ( in_array( 'date', $active_meta ) ): ?>
            <span class="post-date">
                <i class="far fa-calendar-alt"></i>
                <?php echo esc_html( get_the_date() ) ?>
            </span>
            <?php endif;?>
            <?php if ( in_array( 'comments', $active_meta ) && ( !post_password_required() && ( comments_open() || get_comments_number() ) ) ): ?>
            <span class="post-comments">
                <i class="far fa-comments"></i>
                <span><?php echo esc_html__( 'Comments ', 'jeena-toolkit' ) ?> </span>
                <?php echo '(' . esc_html( get_comments_number() ) . ')'  ?>
            </span>
            <?php endif;?>
        </div>
        <?php
    }

    /**
     * Render Post author
     *
     * @param array $active_meta
     * @param string $note
     * @param string $photo
     * @return void
     */
    public static function render_post_author( $active_meta, $photo, $note = "" ) {
        if ( ! in_array( 'author', $active_meta ) ) {
            return;
        }
        $author_id   = get_post_field( 'post_author', get_the_ID() );
        $user_avatar = get_avatar( $author_id, 40 );
        ?>
        <div class="post-author">
            <?php if ( 'yes' === $photo ): ?>
            <span class="photo"><?php echo $user_avatar ?></span>
            <?php endif;?>
            <?php if ( $note ): ?>
            <span class="note"><?php echo esc_html( $note ); ?></span>
            <?php endif;?>
            <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ) ?>" class="name">
                <?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ) ?>
            </a>
        </div>
        <?php
    }
}