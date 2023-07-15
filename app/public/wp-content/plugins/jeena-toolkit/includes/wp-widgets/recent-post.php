<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

if ( class_exists( 'CSF' ) ) {
    CSF::createWidget( 'jeena_recent_post_widget', [
        'title'       => esc_html__( '*Jeena Recent Post', 'jeena-toolkit' ),
        'classname'   => 'jeena-wp-recent-posts',
        'description' => esc_html__( 'Show Latest post', 'jeena-toolkit' ),
        'fields'      => [
            [
                'id'      => 'title',
                'type'    => 'text',
                'title'   => esc_html( 'Title', 'jeena-toolkit' ),
                'default' => esc_html__( 'Recent News', 'jeena-toolkit' ),
            ],
            [
                'id'      => 'post_count',
                'type'    => 'number',
                'title'   => esc_html( 'Number of Posts to Show', 'jeena-toolkit' ),
                'default' => 3,
            ],
            [
                'id'      => 'title_length',
                'type'    => 'number',
                'title'   => esc_html( 'Title Length', 'jeena-toolkit' ),
                'default' => 6,
            ],
        ],
    ] );

    function jeena_recent_post_widget( $args, $instance ) {
        $post_count   = ( ! empty( $instance['post_count'] ) ) ? absint( $instance['post_count'] ) : 3;
        $title_length = isset( $instance['title_length'] ) ? absint( $instance['title_length'] ) : 5;

        $query = new WP_Query( apply_filters( 'widget_posts_args', [
            'posts_per_page'      => $post_count,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
        ], $instance ) );

        if ( ! $query->have_posts() ) {
            return;
        }

        $allowed_html = [
            'div' => [
                'id'    => [],
                'class' => [],
            ],
            'h3'  => [
                'class' => [],
            ],
            'h4'  => [
                'class' => [],
            ],
            'h5'  => [
                'class' => [],
            ],
            'h6'  => [
                'class' => [],
            ],
        ];

        echo wp_kses( $args['before_widget'], $allowed_html );

        if ( ! empty( $instance['title'] ) ) {
            echo wp_kses( $args['before_title'], $allowed_html ) . apply_filters( 'widget_title', $instance['title'] ) . wp_kses( $args['after_title'], $allowed_html );
        }
        ?>
        <ul class="recent-post-loop">
            <?php while ( $query->have_posts() ): $query->the_post();
                if ( $title_length ) {
                    $post_title = wp_trim_words( get_the_title(), $title_length );
                } else {
                    $post_title = get_the_title();
                }
                ?>
                <li>
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="post-desc">
                        <h6 class="post-title">
                            <a href="<?php echo esc_url( get_the_permalink() ) ?>">
                                <?php echo esc_html( $post_title ) ?>
                            </a>
                        </h6>
                        <span class="time"><i class="far fa-calendar-alt"></i><?php echo esc_html( get_the_date() ) ?></span>
                    </div>
                </li>
            <?php endwhile;
            wp_reset_postdata();?>
        </ul>
        <?php echo wp_kses( $args['after_widget'], $allowed_html );
    }
}