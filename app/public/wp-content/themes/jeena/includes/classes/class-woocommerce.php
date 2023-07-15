<?php

namespace JeenaTheme\Classes;

defined( 'ABSPATH' ) || exit;

/**
 * Initial setup for this theme
 */
class Jeena_Woocommerce {
    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {

        add_action( 'after_setup_theme', [$this, 'setup'] );
        add_filter( 'body_class', [$this, 'body_class'] );
        add_filter( 'woocommerce_show_page_title', [$this, 'hide_page_title'] );

        $this->product_loop_hooks();
        $this->product_details_hooks();

        $related_product = Jeena_Helper::get_option( 'enable_related_product', true );

        if ( ! $related_product ) {
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
        }
    }

    /**
     * WooCommerce setup.
     *
     * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
     * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
     * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
     *
     * @return void
     */
    public function setup() {
        add_theme_support( 'woocommerce' );
        // add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-slider' );
    }

    /**
     * Add 'woocommerce-active' class to the body tag.
     *
     * @param  array $classes CSS classes applied to the body tag.
     * @return array $classes modified to include 'woocommerce-active' class.
     */
    public function body_class( $classes ) {
        $classes[] = 'woocommerce-active';

        return $classes;
    }

    /**
     * Removes the "shop" title on the main shop page
     *
     * @return false
     */
    public function hide_page_title() {
        return false;
    }

    /**
     * All Product Loop hooks
     *
     * @return void
     */
    public function product_loop_hooks() {
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

        remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

        add_filter( 'loop_shop_columns', [$this, 'loop_columns'], 999 );
        add_filter( 'loop_shop_per_page', [$this, 'product_per_page'], 30 );

        add_action( 'woocommerce_before_shop_loop', [$this, 'loop_top_markup'], 2 );
        add_filter( 'woocommerce_after_shop_loop_item', [$this, 'product_loop'], 10 );

        add_filter( 'woocommerce_pagination_args', [$this, 'pagination_args'], 10, 1 );
    }

    /**
     * Product Details Hooks
     *
     * @return void
     */
    public function product_details_hooks() {
        add_action( 'woocommerce_before_single_product_summary', [$this, 'single_summer_start'], 0 );
        add_action( 'woocommerce_after_single_product_summary', [$this, 'single_summer_end'], 5 );

        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

        add_action( 'woocommerce_single_product_summary', [$this, 'single_product_price'], 10 );
        add_action( 'woocommerce_single_product_summary', [$this, 'single_product_rating'], 15 );
        add_action( 'woocommerce_single_product_summary', [$this, 'single_product_meta'], 20 );
        add_action( 'woocommerce_single_product_summary', [$this, 'single_product_sharing'], 20 );

        add_filter( 'woocommerce_output_related_products_args', [$this, 'related_products_args'], 20 );

        add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function ( $size ) {
            $size['width']  = 150;
            $size['height'] = 150;
            $size['crop']   = 1;
            return $size;
        } );
    }

    /**
     * Change number or products per row to 3
     */
    public function loop_columns() {
        $product_row_columns = Jeena_Helper::get_option( 'product_loop_columns', 4);

        return $product_row_columns;
    }

    /**
     * Product Per Page
     *
     * @return void
     */
    function product_per_page() {
        $product_per_page = Jeena_Helper::get_option( 'product_loop_per_page', 12 );

        return $product_per_page;
    }

    /**
     * Loop Top Markup
     *
     * @return void
     */
    public function loop_top_markup() {
        ?>
        <div class="woocommerce-loop-top">
            <div class="woocommerce-result">
                <?php woocommerce_result_count();?>
            </div>
            <div class="woocommerce-ordering">
                <?php woocommerce_catalog_ordering();?>
            </div>
        </div>
        <?php
    }

    /**
     * Html Markup For Product Loop
     */
    public function product_loop() {
        ?>
        <div class="woocommerce-product-inner">
            <div class="product-thumbnail">
                <?php woocommerce_template_loop_product_thumbnail();?>
                <?php woocommerce_show_product_sale_flash();?>
                <div class="cart-button">
                    <?php woocommerce_template_loop_add_to_cart();?>
                </div>
            </div>
            <div class="product-content">
                <?php woocommerce_template_loop_rating();?>
                <h4 class="product-title">
                    <a href="<?php the_permalink();?>" ><?php the_title();?></a>
                </h4>
                <?php woocommerce_template_loop_price();?>
            </div>
        </div>
        <?php
    }

    /**
     * Pagination Args
     */
    public function pagination_args( $array ) {
        $html_prev          = '<i class="fas fa-angle-left"></i>';
        $html_next          = '<i class="fas fa-angle-right"></i>';
        $array['end_size']  = 1;
        $array['mid_size']  = 1;
        $array['prev_text'] = $html_prev;
        $array['next_text'] = $html_next;
        $array['type']      = 'plain';
        return $array;
    }

    /**
     * Summary Wrapper
     */
    public function single_summer_start() {
        echo '<div class="woocommerce-summary-wrap">';
    }

    public function single_summer_end() {
        echo '</div>';
    }

    public function single_product_price() {
        woocommerce_template_single_price();
    }

    public function single_product_rating() {
        woocommerce_template_single_rating();
    }

    public function single_product_meta() {
        woocommerce_template_single_meta();
    }

    public function single_product_sharing() {
        woocommerce_template_single_sharing();
    }

    /**
     * Related Product Args
     *
     * @return void
     */
    public function related_products_args( $args ) {
        $post_col      = Jeena_Helper::get_option( 'related_product_columns', 4 );
        $post_per_page = Jeena_Helper::get_option( 'related_product_per_page', 4 );

        $args['posts_per_page'] = $post_per_page;
        $args['columns']        = $post_col;
        return $args;
    }
}

/**
 * Run Class
 */
Jeena_Woocommerce::instance()->initialize();