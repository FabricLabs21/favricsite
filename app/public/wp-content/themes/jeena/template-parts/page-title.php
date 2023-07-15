<?php
/**
 * Template part for displaying page Title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jeena
 */

use JeenaTheme\Classes\Jeena_Breadcrumb;
use JeenaTheme\Classes\Jeena_Helper;
use JeenaTheme\Classes\Jeena_Helper as Helper;
use JeenaTheme\Classes\Jeena_Post_Helper;

if ( is_404() ) {
    return;
}

$active_title = Helper::get_option( 'site_page_title', 'enabled' );
$breadcrumb   = Helper::get_option( 'site_breadcrumb', 'enabled' );
$title        = '';
$custom_title = '';
$title_output = [];

if ( is_page() && ! is_home() ) {
    $page_title        = Helper::get_meta( 'jeena_page_meta', 'page_title', 'default' );
    $page_breadcrumb   = Helper::get_meta( 'jeena_page_meta', 'page_breadcrumb', 'default' );
    $page_title_type   = Helper::get_meta( 'jeena_page_meta', 'page_title_type', 'default' );
    $page_custom_title = Helper::get_meta( 'jeena_page_meta', 'page_custom_title', '' );

    if ( 'default' !== $page_title ) {
        $active_title = $page_title;
    }

    if ( 'custom' === $page_title_type && ! empty( $page_custom_title ) ) {
        $custom_title = $page_custom_title;
    }

    if ( 'default' !== $page_breadcrumb ) {
        $breadcrumb = $page_breadcrumb;
    }

} elseif ( is_single() && 'post' === get_post_type() ) {
    $post_page_title   = Helper::get_meta( 'jeena_post_meta', 'post_page_title', 'default' );
    $post_breadcrumb   = Helper::get_meta( 'jeena_post_meta', 'post_breadcrumb', 'default' );
    $post_title_type   = Helper::get_meta( 'jeena_post_meta', 'post_title_type', 'default' );
    $post_custom_title = Helper::get_meta( 'jeena_post_meta', 'post_custom_title', __( 'News Details', 'jeena' ) );

    if ( 'default' !== $post_page_title ) {
        $active_title = $post_page_title;
    }

    if ( 'custom' === $post_title_type && ! empty( $post_custom_title ) ) {
        $custom_title = $post_custom_title;
    }

    if ( 'default' !== $post_breadcrumb ) {
        $breadcrumb = $post_breadcrumb;
    }
} elseif ( is_single() && 'jeena_portfolio' === get_post_type() ) {
    $portfolio_page_title   = Helper::get_meta( 'jeena_portfolio_meta', 'portfolio_page_title', 'default' );
    $portfolio_breadcrumb   = Helper::get_meta( 'jeena_portfolio_meta', 'portfolio_breadcrumb', 'default' );
    $portfolio_title_type   = Helper::get_meta( 'jeena_portfolio_meta', 'portfolio_page_title_type', 'default' );
    $portfolio_custom_title = Helper::get_meta( 'jeena_portfolio_meta', 'portfolio_custom_title', __( 'Project Details', 'jeena' ) );

    if ( 'default' !== $portfolio_page_title ) {
        $active_title = $portfolio_page_title;
    }

    if ( 'custom' === $portfolio_title_type && ! empty( $portfolio_custom_title ) ) {
        $custom_title = $portfolio_custom_title;
    }

    if ( 'default' !== $portfolio_breadcrumb ) {
        $breadcrumb = $portfolio_breadcrumb;
    }
} elseif ( is_single() && 'product' === get_post_type() ) {
    $product_page_title   = Helper::get_meta( 'jeena_product_meta', 'product_page_title', 'default' );
    $product_breadcrumb   = Helper::get_meta( 'jeena_product_meta', 'product_breadcrumb', 'default' );
    $product_title_type   = Helper::get_meta( 'jeena_product_meta', 'product_page_title_type', 'default' );
    $product_custom_title = Helper::get_meta( 'jeena_product_meta', 'product_custom_title', '' );

    if ( 'default' !== $product_page_title ) {
        $active_title = $product_page_title;
    }

    if ( 'custom' === $product_title_type && ! empty( $product_custom_title ) ) {
        $custom_title = $product_custom_title;
    }

    if ( 'default' !== $product_breadcrumb ) {
        $breadcrumb = $product_breadcrumb;
    }
}

if ( is_home() ) {
    $title = Helper::get_option( 'blog_archive_title', __( 'Latest News', 'jeena' ) );
} elseif ( is_search() ) {
    $title = esc_html__( 'Search Results for: ', 'jeena' ) . get_search_query();
} elseif ( is_archive() ) {
    if ( class_exists( 'WooCommerce' ) && is_shop() ) {
        $shop_id = get_option( 'woocommerce_shop_page_id', '' );
        $title   = get_the_title( $shop_id );
    } elseif ( is_post_type_archive( 'jeena_portfolio' ) ) {
        $portfolio_title = Jeena_Helper::get_option( 'archive_page_title', __( 'Our Portfolio', 'jeena' ) );

        if ( 'jeena_portfolio' == get_post_type() && ! empty( $portfolio_title ) ) {
            $title = $portfolio_title;
        }
    } else {
        $title = strip_tags( get_the_archive_title() );
    }
} elseif ( ! empty( $custom_title ) ) {
    $title = esc_html( $custom_title );
} else {
    $title = wp_kses_post( get_the_title() );
}

if ( $title ) {
    $title_output[] = $title;
}

if ( 'enabled' !== $active_title ) {
    return;
}

$show_post_meta = Helper::get_option( 'blog_details_meta', 'yes' );

?>

<div class="page-title-wrapper">
    <div class="container">
        <div class="page-content-wrap">
            <h1 class="page-title">
                <?php echo implode( '', $title_output ); ?>
            </h1>
            <?php if ( is_single() && 'post' === get_post_type() && 'yes' === $show_post_meta ): ?>
            <?php Jeena_Post_Helper::post_title_meta();?>
            <?php elseif ( 'disabled' !== $breadcrumb ): ?>
                <div class="breadcrumb">
                    <?php Jeena_Breadcrumb::breadcrumb_init();?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>