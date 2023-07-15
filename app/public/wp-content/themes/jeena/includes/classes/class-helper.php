<?php

namespace JeenaTheme\Classes;

defined( 'ABSPATH' ) || exit;

/**
 * Initial Helper functions for this theme.
 */
class Jeena_Helper {

    /**
     * Get Theme Options
     *
     * @param $option Required Option id
     * @param $default Optional set default value
     *
     * @return mixed
     */
    public static function get_option( $option, $default = null ) {
        $options = get_option( 'jeena_options' );
        return ( isset( $options[$option] ) ) ? $options[$option] : $default;
    }

    /**
     * Get a metaboxes
     *
     * @param $prefix_key Required Meta unique slug
     * @param $meta_key Required Meta slug
     * @param $default Optional Set default value
     * @param $id Optional Set post id
     *
     * @return mixed
     */
    public static function get_meta( $prefix_key, $meta_key, $default = null, $id = '' ) {
        if ( ! $id ) {
            $id = get_the_ID();
        }

        $meta_boxes = get_post_meta( $id, $prefix_key, true );
        return ( isset( $meta_boxes[$meta_key] ) ) ? $meta_boxes[$meta_key] : $default;
    }

    /**
     * Check if this Page created with elementor
     *
     * @return boolean
     */
    public static function is_elementor_page() {
        global $post;
        $is_elementor = false;

        if ( \class_exists( '\Elementor\Plugin' ) ) {
            $is_elementor = \Elementor\Plugin::$instance->documents->get( $post->ID )->is_built_with_elementor();
        }

        return $is_elementor;
    }

    /**
     * Get content layout
     *
     * @return string
     */
    public static function site_layout() {
        $layout = self::get_option( 'site_layout', 'full-width' );

        if ( is_page() ) {
            $page_layout = self::get_meta( 'jeena_page_meta', 'site_layout', 'default' );
            if ( 'default' !== $page_layout ) {
                $layout = $layout;
            }
        } elseif ( is_single() && 'jeena_portfolio' === get_post_type() ) {
            $portfolio_layout = self::get_meta( 'jeena_portfolio_meta', 'portfolio_details_layout', 'default' );

            if ( 'default' !== $portfolio_layout ) {
                $layout = $portfolio_layout;
            }
        } elseif ( is_single() && 'product' === get_post_type() ) {
            $product_layout = self::get_meta( 'jeena_product_meta', 'product_details_layout', 'default' );

            if ( 'default' !== $product_layout ) {
                $layout = $product_layout;
            }
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $post_layout = self::get_meta( 'jeena_post_meta', 'post_details_layout', 'default' );

            if ( 'default' !== $post_layout ) {
                $layout = $post_layout;
            }
        }

        return $layout;
    }

    /**
     * Get Content Sidebar
     *
     * @return string
     */
    public static function content_sidebar() {
        $sidebar = 'right-sidebar';

        if ( is_page() ) {
            $sidebar = 'no-sidebar';
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $sidebar      = self::get_option( 'blog_details_sidebar', 'right-sidebar' );
            $post_sidebar = self::get_meta( 'jeena_post_meta', 'post_details_sidebar', 'default' );

            if ( 'default' !== $post_sidebar ) {
                $sidebar = $post_sidebar;
            }
        } elseif ( ! is_page() ) {
            $sidebar = self::get_option( 'blog_archive_sidebar', 'right-sidebar' );
        }

        if ( ! is_active_sidebar( 'primary_sidebar' ) ) {
            $sidebar = 'no-sidebar';
        }

        return $sidebar;
    }

    /**
     * Container Classes
     *
     * @return string|string[] $classes Space-separated string or array of class.
     */
    public static function container() {
        $classes = ['container'];

        if ( is_page() ) {
            if ( self::is_elementor_page() ) {
                $classes[] = 'container-elementor';
            } else {
                $classes[] = 'container-gap';
            }
        } elseif ( is_single() && 'jeena_portfolio' == get_post_type() ) {
            if ( self::is_elementor_page() ) {
                $classes[] = 'container-elementor';
            } else {
                $classes[] = 'container-gap';
            }
        } elseif ( is_archive() && 'jeena_portfolio' == get_post_type() ) {
            $classes[] = 'container-gap no-sidebar';
        } elseif (  ( is_archive() || is_single() ) && 'product' == get_post_type() ) {
            $classes[] = 'container-gap no-sidebar';
        } else {
            $classes[] = 'container-gap';

            if ( 'left-sidebar' === self::content_sidebar() ) {
                $classes[] = 'have-sidebar left-sidebar';
            } elseif ( 'right-sidebar' === self::content_sidebar() ) {
                $classes[] = 'have-sidebar right-sidebar';
            } elseif ( 'no-sidebar' === self::content_sidebar() ) {
                $classes[] = 'no-sidebar';
            }
        }

        echo esc_attr( implode( ' ', $classes ) );
    }

    /**
     * Check Theme Default Header
     */
    public static function check_default_header() {
        $default_header = self::get_option( 'default_header', 'enabled' );

        if ( is_page() ) {
            $page_default_header = self::get_meta( 'jeena_page_meta', 'page_default_header', 'default' );

            if ( 'default' !== $page_default_header ) {
                $default_header = $page_default_header;
            }
        } elseif ( is_single() && 'jeena_portfolio' === get_post_type() ) {
            $portfolio_default_header = self::get_meta( 'jeena_portfolio_meta', 'portfolio_default_header', 'default' );

            if ( 'default' !== $portfolio_default_header ) {
                $default_header = $portfolio_default_header;
            }
        } elseif ( is_single() && 'product' === get_post_type() ) {
            $product_default_header = self::get_meta( 'jeena_product_meta', 'product_default_header', 'default' );

            if ( 'default' !== $product_default_header ) {
                $default_header = $product_default_header;
            }
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $post_default_header = self::get_meta( 'jeena_post_meta', 'post_default_header', 'default' );

            if ( 'default' !== $post_default_header ) {
                $default_header = $post_default_header;
            }
        }

        return $default_header;
    }

    /**
     * Check Default Footer
     *
     * @return void
     */
    public static function check_default_footer() {
        $default_footer = self::get_option( 'default_footer', 'enabled' );

        if ( is_page() ) {
            $page_default_footer = self::get_meta( 'jeena_page_meta', 'page_default_footer', 'default' );

            if ( 'default' !== $page_default_footer ) {
                $default_footer = $page_default_footer;
            }
        } elseif ( is_single() && 'jeena_portfolio' === get_post_type() ) {
            $portfolio_default_footer = self::get_meta( 'jeena_portfolio_meta', 'portfolio_default_footer', 'default' );

            if ( 'default' !== $portfolio_default_footer ) {
                $default_footer = $portfolio_default_footer;
            }
        } elseif ( is_single() && 'product' === get_post_type() ) {
            $product_default_footer = self::get_meta( 'jeena_product_meta', 'product_default_footer', 'default' );

            if ( 'default' !== $product_default_footer ) {
                $default_footer = $product_default_footer;
            }
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $post_default_footer = self::get_meta( 'jeena_post_meta', 'post_default_footer', 'default' );

            if ( 'default' !== $post_default_footer ) {
                $default_footer = $post_default_footer;
            }
        }

        return $default_footer;
    }

    /**
     * Check Transparent Header
     *
     * @return void
     */
    public static function transparent_header() {
        $transparent_header = self::get_option( 'transparent_header', 'disabled' );

        if ( is_page() ) {
            $page_transparent = self::get_meta( 'jeena_page_meta', 'page_transparent_header', 'default' );

            if ( 'default' !== $page_transparent ) {
                $transparent_header = $page_transparent;
            }
        } elseif ( is_single() && 'jeena_portfolio' === get_post_type() ) {
            $portfolio_transparent = self::get_meta( 'jeena_portfolio_meta', 'portfolio_transparent_header', 'default' );

            if ( 'default' !== $portfolio_transparent ) {
                $transparent_header = $portfolio_transparent;
            }
        } elseif ( is_single() && 'product' === get_post_type() ) {
            $product_transparent = self::get_meta( 'jeena_product_meta', 'product_transparent_header', 'default' );

            if ( 'default' !== $product_transparent ) {
                $transparent_header = $product_transparent;
            }
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $post_transparent = self::get_meta( 'jeena_post_meta', 'post_transparent_header', 'default' );

            if ( 'default' !== $post_transparent ) {
                $transparent_header = $post_transparent;
            }
        }

        return $transparent_header;
    }

    /**
     * Get theme Global Color
     *
     * @return array
     */
    public static function get_global_colors() {
        $colors = [];

        $primary_color   = self::get_option( 'primary_color', '' );
        $secondary_color = self::get_option( 'secondary_color', '' );
        $headline_color  = self::get_option( 'headline_color', '' );
        $body_color      = self::get_option( 'body_color', '' );
        $border_color    = self::get_option( 'border_color', '' );
        $dark_neutral    = self::get_option( 'dark_neutral', '' );
        $light_neutral   = self::get_option( 'light_neutral', '' );
        $white_color     = self::get_option( 'white_color', '' );

        $colors['jeena_primary'] = [
            'slug'  => 'jeena-primary-color',
            'title' => esc_html__( 'Jeena Primary Color', 'jeena' ),
            'value' => ! empty( $primary_color ) ? $primary_color : '#674df3',
        ];

        $colors['jeena_secondary'] = [
            'slug'  => 'jeena-secondary-color',
            'title' => esc_html__( 'Jeena Secondary Color', 'jeena' ),
            'value' => ! empty( $secondary_color ) ? $secondary_color : '#30f0b6',
        ];

        $colors['jeena_headline'] = [
            'slug'  => 'jeena-headline-color',
            'title' => esc_html__( 'Jeena Headline Color', 'jeena' ),
            'value' => ! empty( $headline_color ) ? $headline_color : '#1b1f2e',
        ];

        $colors['jeena_body'] = [
            'slug'  => 'jeena-body-color',
            'title' => esc_html__( 'Jeena Body Color', 'jeena' ),
            'value' => ! empty( $body_color ) ? $body_color : '#838694',
        ];

        $colors['jeena_border'] = [
            'slug'  => 'jeena-border-color',
            'title' => esc_html__( 'Jeena Border Color', 'jeena' ),
            'value' => ! empty( $border_color ) ? $border_color : '#e8e8ea',
        ];

        $colors['jeena_dark'] = [
            'slug'  => 'jeena-dark-color',
            'title' => esc_html__( 'Jeena Dark Color', 'jeena' ),
            'value' => ! empty( $dark_neutral ) ? $dark_neutral : '#1b1f2b',
        ];

        $colors['jeena_light'] = [
            'slug'  => 'jeena-light-color',
            'title' => esc_html__( 'Jeena light Color', 'jeena' ),
            'value' => ! empty( $light_neutral ) ? $light_neutral : '#f7f7f9',
        ];

        $colors['jeena_white'] = [
            'slug'  => 'jeena-white-color',
            'title' => esc_html__( 'Jeena White Color', 'jeena' ),
            'value' => ! empty( $white_color ) ? $white_color : '#ffffff',
        ];

        return $colors;
    }

    /**
     * Get Elementor content for display
     *
     * @param int $content_id
     */
    public static function get_elementor_content( $content_id ) {
        $content = '';
        if ( \class_exists( '\Elementor\Plugin' ) ) {
            $elementor_instance = \Elementor\Plugin::instance();
            $content            = $elementor_instance->frontend->get_builder_content_for_display( $content_id );
        }
        return $content;
    }

    /**
     * Undocumented function
     *
     * @param string $name Svg Icon Name
     * @return void
     */
    public static function render_svg_icon( $name ) {
        $icon_path = JEENA_PATH . "/assets/img/svg/{$name}.svg";

        if ( ! file_exists( $icon_path ) ) {
            return false;
        }

        ob_start();

        include $icon_path;

        $svg = ob_get_clean();

        return $svg;
    }
}