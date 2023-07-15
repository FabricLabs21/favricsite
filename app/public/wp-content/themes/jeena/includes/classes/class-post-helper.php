<?php
namespace JeenaTheme\Classes;

defined( 'ABSPATH' ) || exit;

/**
 * Post Helper Function
 */
class Jeena_Post_Helper {
    /**
     * Get Post Media
     *
     * @param int $idd
     * @return void
     */
    public static function render_media( $idd = '', $image_size = '', $class = '' ) {
        if ( ! has_post_thumbnail() ) {
            return;
        }

        if ( empty( $idd ) ) {
            $idd = get_the_ID();
        }

        $wrapper_class = ['entry-media'];

        if ( ! empty( $class ) ) {
            $wrapper_class[] = $class;
        };

        $size = 'jeena_850x565';
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ) ?>">
            <?php the_post_thumbnail( $size, ['alt' => wp_kses_post( get_the_title() )] ); ?>
        </div>
        <?php
    }

    /**
     * Get Post Meta
     *
     * @param int $idd
     * @return void
     */
    public static function post_archive_meta( $idd = '' ) {
        if ( empty( $idd ) ) {
            $idd = get_the_ID();
        }
        $author_id     = get_post_field( 'post_author', $idd );
        $post_author   = Jeena_Helper::get_option( 'archive_post_author', 'yes' );
        $post_date     = Jeena_Helper::get_option( 'archive_post_date', 'yes' );
        ?>
        <div class="post-author-date">
            <?php if ( 'yes' === $post_author ) : ?>
            <span class="author">
                <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ) ?>">
                    <?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ) ?>
                </a>
            </span>
            <?php endif; ?>
            <?php if ( 'yes' === $post_date ) : ?>
            <span class="date">
                <i class="far fa-calendar-alt"></i>
                <?php echo esc_html( get_the_date() ) ?>
            </span>
            <?php endif; ?>
        </div>
        <?php
    }

    public static function post_title_meta( $idd = '' ) {
        if ( empty( $idd ) ) {
            $idd = get_the_ID();
        }
        $author_id     = get_post_field( 'post_author', $idd );
        $post_author   = Jeena_Helper::get_option( 'archive_post_author', 'yes' );
        $post_date     = Jeena_Helper::get_option( 'archive_post_date', 'yes' );
        ?>
        <div class="post-title-meta">
            <?php if ( 'yes' === $post_date ) : ?>
            <span class="date">
                <i class="fal fa-calendar-alt"></i>
                <?php echo esc_html( get_the_date() ) ?>
            </span>
            <?php endif; ?>
            <?php if ( 'yes' === $post_author ) : ?>
            <span class="author">
                <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ) ?>">
                    <i class="fal fa-user-alt"></i>
                    <?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ) ?>
                </a>
            </span>
            <?php endif; ?>
            <?php if ( is_single() && 'post' === get_post_type() ) : ?>
                <?php if ( !post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                <span class="comments">
                    <a href="<?php echo esc_url( esc_url( get_comments_link() ) ) ?>">
                        <i class="fal fa-comments"></i>
                        <span><?php echo esc_html__( 'Comments ', 'jeena' ) ?></span>
                        <?php echo '(' . esc_html( get_comments_number() ) . ')'  ?>
                    </a>
                </span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Post Navigation
     *
     * @return void
     */
    public static function post_navigation() {
        global $post;
        if ( 'post' === get_post_type() ) {
            $prev = get_previous_post();
            $next = get_next_post();
            if ( ! empty( $prev ) || ! empty( $next ) ) :
            ?>
            <div class="entry-post-navigation">
                <?php if ( ! empty( $prev ) ) :
                    $prev_id = $prev->ID; ?>
                    <div class="prev-post">
                        <a href="<?php echo esc_url( get_permalink( $prev_id ) ) ?>">
                            <?php
                                echo wp_kses_post( wp_trim_words( get_the_title( $prev_id ), '8', '...' ) );
                            ?>
                        </a>
                        <span class="date">
                            <i class="far fa-calendar-alt"></i>
                            <?php echo esc_html( get_the_date() ) ?>
                        </span>
                    </div>
                <?php endif; if ( ! empty( $next ) ) :
                    $next_id = $next->ID; ?>
                    <div class="next-post">
                        <a href="<?php echo esc_url( get_permalink( $next_id ) ) ?>">
                            <?php
                                echo wp_kses_post( wp_trim_words( get_the_title( $next_id ), '8', '...' ) );
                            ?>
                        </a>
                        <span class="date">
                            <i class="far fa-calendar-alt"></i>
                            <?php echo esc_html( get_the_date() ) ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
            <?php
            endif;
        }
    }

    /**
     * Post Author Info
     *
     * @return void
     */
    public static function post_author_info() {
        global $post;
        $user_id = get_the_author_meta('ID');

        // Get author's display name - NB! changed display_name to first_name. Error in code.
        $display_name = get_the_author_meta( 'display_name', $post->post_author );

        // If display name is not available then use nickname as display name
        if ( empty( $display_name ) ) {
            $display_name = get_the_author_meta( 'nickname', $post->post_author );
        }

        $user_description   = get_the_author_meta( 'user_description', $post->post_author );
        $user_posts = get_author_posts_url( $user_id );
        $user_avatar = get_avatar( $user_id , 145 );

        $user_meta = get_user_meta( $user_id, 'jeena_user_meta', true );

        ?>
        <div class="entry-author-info">
            <div class="author-avatar">
                <?php echo wp_kses_post( $user_avatar ); ?>
            </div>
            <div class="author-desc">
                <h4 class="name">
                    <a href="<?php echo esc_url( $user_posts ) ?>"> <?php echo esc_html( $display_name ) ?> </a>
                </h4>
                <?php
                    echo wpautop( $user_description );

                    if( !empty( $user_meta['user_social_links'] ) ) : ?>
                    <ul class="user-links">
                        <?php foreach ( $user_meta['user_social_links'] as $item ) : ?>
                        <li>
                            <a href="<?php echo esc_url( $item['social_link'] ) ?>">
                                <i class="<?php echo esc_attr( $item['social_icon'] ) ?>"></i>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif;
                ?>
            </div>
        </div>
        <?php
    }

    /**
     * Pagination
     *
     * @param $query
     * @return void
     */
    public static function pagination( $query = false ) {
        if ( $query != false ) {
            $wp_query = $query;
        } else {
            global $paged, $wp_query;
        }

        if ( empty( $paged ) ) {
            $query_vars = $wp_query->query_vars;
            $paged      = isset( $query_vars['paged'] ) ? $query_vars['paged'] : 1;
        }

        $max_page = $wp_query->max_num_pages;

        // Exit if pagination not need
        if ( ! ( $max_page > 1 ) ) {
            return;
        }

        //return $output;
        $big = 999999999;

        $page_items = paginate_links( [
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'type'      => 'array',
            'current'   => max( 1, $paged ),
            'end_size'  => 1,
            'mid_size'  => 1,
            'total'     => $max_page,
            'prev_text' => '<i class="fas fa-angle-left"></i>',
            'next_text' => '<i class="fas fa-angle-right"></i>',
        ] );
        ?>
        <ul class="jeena-pagination">
            <?php foreach ( $page_items as $key => $value ) : ?>
                <li class="page"><?php echo wp_kses_post( $value ) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php
    }
}