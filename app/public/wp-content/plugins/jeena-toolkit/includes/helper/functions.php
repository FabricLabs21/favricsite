<?php
/**
 * Helper functions
 *
 */
use JeenaTheme\Classes\Jeena_Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Retrieve the name of the highest priority template file that exists.
 *
 * @param string|array $template_names Template file(s) to search for, in order.
 * @param string       $origin_path    Template file(s) origin path. (../jeena-toolkit/elementor/widgets/)
 * @param string       $override_path  New template file(s) override path. (../jeena)
 *
 * @return string The template filename if one is located.
 */
function jt_get_locate_template( $template_names, $origin_path, $override_path ) {
    $files = [];
    $file  = '';

    foreach ( (array) $template_names as $template_name ) {
        if ( file_exists( get_stylesheet_directory() . $override_path . $template_name ) ) {
            $file = get_stylesheet_directory() . $override_path . $template_name;
        } elseif ( file_exists( get_template_directory() . $override_path . $template_name ) ) {
            $file = get_template_directory() . $override_path . $template_name;
        } elseif ( file_exists( realpath( __DIR__ . '/..' ) . $origin_path . $template_name ) ) {
            $file = realpath( __DIR__ . '/..' ) . $origin_path . $template_name;
        }
        array_push( $files, $file );
    }

    return $files;
}

/**
 * Get a list of Posts
 *
 * @param string $post_type
 * @return array
 */
function jt_select_post( $post_type = 'post' ) {
    $args = [
        'post_type'   => $post_type,
        'numberposts' => -1,
        'orderby'     => 'title',
        'order'       => 'ASC',
    ];

    $query_query = get_posts( $args );

    $posts = [];
    if ( $query_query ) {
        foreach ( $query_query as $query ) {
            $posts[$query->ID] = $query->post_title;
        }
    }

    return $posts;
}

/**
 * Get All Category For Query
 *
 * @param string $category
 * @return array
 */
function jt_select_category( $category = 'category' ) {
    $terms = get_terms( [
        'taxonomy'   => $category,
        'hide_empty' => true,
    ] );

    $options = [];

    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            $options[$term->slug] = $term->name;
        }
    }

    return $options;
}

/**
 * Get a list of all Contact Form 7
 *
 * @since 1.0.0
 * @return array
 */
function jt_select_cf7() {
    $forms_list = [];

    if ( function_exists( 'wpcf7' ) ) {
        $forms = get_posts( [
            'post_type'      => 'wpcf7_contact_form',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ] );

        if ( ! empty( $forms ) ) {
            $forms_list = wp_list_pluck( $forms, 'post_title', 'ID' );
        } else {
            $forms_list[0] = esc_html__( 'No Contact From found', 'jeena-toolkit' );
        }
    } else {
        $forms_list[0] = esc_html__( 'Please Install & Active Contact Contact Form 7', 'jeena-toolkit' );
    }

    return $forms_list;
}

/**
 * Get a list of all block builder block
 *
 * @param string $type
 * @return array
 */
function jt_select_builder_block( $type = 'block' ) {
    $items = [];
    $lists = ['0' => __( '--- Select Template ---', 'jeena-toolkit' )];

    $args = [
        'post_type'      => 'jeena_template',
        'posts_per_page' => -1,
    ];

    $posts = get_posts( $args );

    foreach ( $posts as $post ) {
        $meta = get_post_meta( $post->ID, 'jeena_tb_settings', true );

        if ( $type == $meta['template_type'] ) {
            $items[$post->ID] = $post->post_title;
        }
    }

    $lists = $lists + $items;

    return $lists;
}

/**
 * Get list of Elementor Template
 *
 * @return array
 */
function jt_select_elementor_template() {
    $args = [
        'post_type'   => 'elementor_library',
        'numberposts' => -1,
        'orderby'     => 'title',
        'order'       => 'ASC',
        'tax_query'   => [
            'relation' => 'OR',
            [
                'taxonomy' => 'elementor_library_type',
                'field'    => 'slug',
                'terms'    => 'section',
            ],
            [
                'taxonomy' => 'elementor_library_type',
                'field'    => 'slug',
                'terms'    => 'page',
            ],
        ],
    ];

    $query_query = get_posts( $args );

    $lists = ['0' => __( '--- Select Template ---', 'jeena-toolkit' )];
    $items = [];

    if ( $query_query ) {
        foreach ( $query_query as $query ) {
            $items[$query->ID] = $query->post_title;
        }
    }

    $lists = $lists + $items;

    return $lists;
}

/**
 * Social Share links
 */
function jt_post_share_links() {
    global $post;

    if ( ! isset( $post->ID ) ) {
        return;
    }

    $share_items = Jeena_Helper::get_option( 'social_share_item', [] );

    if ( array_key_exists( 'enabled', $share_items ) ) {
        $share = $share_items['enabled'];
    } else {
        $share = [];
    }

    $html = '';

    if ( array_key_exists( 'twitter', $share ) ) {
        $html .= '<li>
            <a target="_blank" href="' . esc_url( 'https://twitter.com/intent/tweet?text=' . get_the_title() . '&amp;url=' . get_permalink() ) . '">
                <i class="fab fa-twitter"></i>
            </a>
        </li>';
    }

    if ( array_key_exists( 'facebook', $share ) ) {
        $html .= '<li>
            <a target="_blank" href="' . esc_url( 'https://www.facebook.com/share.php?u=' . get_permalink() ) . '">
                <i class="fab fa-facebook-f"></i>
            </a>
        </li>';
    }

    if ( array_key_exists( 'pinterest', $share ) ) {
        $img_url = wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'full' );

        $html .= '<li>
            <a target="_blank" href="' . esc_url( 'https://pinterest.com/pin/create/button/?url=' . get_permalink() . '&media=' . $img_url ) . '">
                <i class="fab fa-pinterest-p"></i>
            </a>
        </li>';
    }

    if ( array_key_exists( 'linkedin', $share ) ) {
        $html .= '<li>
            <a target="_blank" href="' . esc_url( 'http://www.linkedin.com/shareArticle?mini=true&url=' . substr( urlencode( get_permalink() ), 0, 1024 ) ) . '&title=' . esc_attr( substr( urlencode( html_entity_decode( get_the_title() ) ), 0, 200 ) ) . '">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </li>';
    }

    if ( array_key_exists( 'reddit', $share ) ) {
        $html .= '<li>
            <a target="_blank" href="' . esc_url( 'https://reddit.com/submit?url=<URL>&amp;title=' . get_the_title() . '&amp;url=' . get_permalink() ) . '">
                <i class="fab fa-reddit-alien" aria-hidden="true"></i>
            </a>
        </li>';
    }

    if ( array_key_exists( 'whatsapp', $share ) ) {
        $html .= '<li>
            <a target="_blank" href="' . esc_url( 'https://wa.me/?text=' . get_the_title() ) . '">
                <i class="fab fa-whatsapp" aria-hidden="true"></i>
            </a>
        </li>';
    }

    if ( array_key_exists( 'telegram', $share ) ) {
        $html .= '<li>
                <a target="_blank" href="' . esc_url( 'https://telegram.me/share/url?url=<URL>&amp;text=' . get_the_title() . '&amp;url=' . get_permalink() ) . '">
                    <i class="fab fa-telegram-plane" aria-hidden="true"></i>
                </a>
        </li>';
    }

    echo '<ul>' . $html . '</ul>';
}

/**
 * Set posts per page for custom post types and taxonomies
 */
if ( ! function_exists( 'jt_cpt_per_page' ) ) {
    add_filter( 'pre_get_posts', 'jt_cpt_per_page' );

    function jt_cpt_per_page( $query ) {

        if ( $query->is_post_type_archive( 'jeena_portfolio' ) && ! is_admin() && $query->is_main_query() ) {
            $post_per_page = Jeena_Helper::get_option( 'portfolio_post_per_page', '9' );
            $query->set( 'posts_per_page', $post_per_page );
        }

        return $query;
    }
}

/**
 * Get a list of all the allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return array
 */
function jt_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'i'      => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'u'      => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        's'      => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'br'     => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'em'     => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'del'    => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'ins'    => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'sub'    => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'sup'    => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'code'   => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'mark'   => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'small'  => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'strike' => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'abbr'   => [
            'title' => [],
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'span'   => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'strong' => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
    ];

    return $allowed_html;
}

/**
 * Escaped title html tags
 *
 * @param string $tag input string of title tag
 * @return string $default default tag will be return during no matches
 */

function jt_escape_tags( $tag, $default = 'span' ) {

    $supports = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p'];

    if ( ! in_array( $tag, $supports, true ) ) {
        return $default;
    }

    return $tag;
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function jt_kses_basic( $string = '' ) {
    return wp_kses( $string, jt_get_allowed_html_tags( 'basic' ) );
}