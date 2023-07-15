<?php
namespace JeenaToolkit\ElementorAddon\Templates;

use Elementor\Icons_Manager;
use WP_Query;

defined( 'ABSPATH' ) || exit;

/**
 * Portfolio Template
 */
class Portfolio_Template {
    /**
     * Render Template
     *
     * @param array $settings
     * @return void
     */
    public function render( $settings ) {
        $wrapper = 'jeena-portfolio-items';

        if( 'slider' == $settings['layout'] ) {
            $wrapper = 'jeena-portfolio-items jeena-slider-wrapper';
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
        $args = [
            'post_type'           => 'jeena_portfolio',
            'post_status'         => 'publish',
            'posts_per_page'      => $settings['post_limit'],
            'orderby'             => $settings['order_by'],
            'order'               => $settings['sort_order'],
            'ignore_sticky_posts' => 1,
        ];

        if ( 'categories' == $settings['post_from'] && $settings['cat_slugs'] ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'jeena_portfolio_category',
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
                self::render_portfolio_item( $settings );
            elseif( 'slider' == $settings['layout'] ) : ?>
                <div class="jeena-slider-item">
                    <?php self::render_portfolio_item( $settings ); ?>
                </div>
            <?php endif;
        endwhile;
        wp_reset_postdata();
    }

    /**
     * Render Render portfolio Item
     *
     * @param array $settings
     * @return void
     */
    public static function render_portfolio_item( $settings ) {
        $idd             = get_the_ID();
        $categories_list = get_the_term_list( $idd, 'jeena_portfolio_category', '', '', '' );

        if ( $settings['title_word'] ) {
            $the_title = wp_trim_words( get_the_title(), $settings['title_word'], '..' );
        } else {
            $the_title = get_the_title();
        }

        ?>
        <div class="portfolio-item style-<?php echo esc_attr( $settings['design'] ) ?>">
            <div class="portfolio-thumbnail">
                <?php echo get_the_post_thumbnail( $idd, $settings['post_thumbnail_size'] ) ?>
                <?php if ( 'normal' == $settings['design'] ) : ?>
                <a href="<?php echo esc_url( get_the_permalink() ) ?>" class="plus-icon"></a>
                <?php endif; ?>
            </div>
            <div class="portfolio-content">
                <?php if ( 'hover-content' == $settings['design'] ) : ?>
                <a href="<?php echo esc_url( get_the_permalink() ) ?>" class="plus-icon"></a>
                <?php endif; ?>

                <?php if ( 'yes' == $settings['show_category'] && ! is_wp_error( $categories_list ) ): ?>
                <div class="categories">
                    <?php echo $categories_list ?>
                </div>
                <?php endif;?>

                <h4 class="title">
                    <a href="<?php echo esc_url( get_the_permalink() ) ?>">
                        <?php echo esc_html( $the_title ) ?>
                    </a>
                    <?php if ( 'normal' === $settings['design'] ) : ?>
                    <a href="<?php echo esc_url( get_the_permalink() ) ?>" class="portfolio-link">
                        <i class="far fa-arrow-right"></i>
                    </a>
                    <?php endif; ?>
                </h4>
            </div>
            <?php if ( 'creative' === $settings['design'] ) : ?>
            <a href="<?php echo esc_url( get_the_permalink() ) ?>" class="portfolio-link">
                <i class="fal fa-long-arrow-right"></i>
            </a>
            <?php endif; ?>
        </div>
        <?php
    }
}