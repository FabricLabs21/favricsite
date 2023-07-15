<?php

namespace JeenaToolkit\PostType;

/**
 * Portfolio CPT
 */
class Portfolio {

    /**
     * @var string
     *
     * Set post type params
     */
    private $type = 'jeena_portfolio';
    private $slug;
    private $name;
    private $singular_name;
    private $plural_name;

    /**
     * Portfolio constructor.
     *
     * When class is instantiated
     */
    public function __construct() {
        $this->name          = esc_html__( 'Portfolio', 'jeena-toolkit' );
        $this->singular_name = esc_html__( 'Portfolio', 'jeena-toolkit' );
        $this->plural_name   = esc_html__( 'Portfolio', 'jeena-toolkit' );

        $opt        = get_option( 'jeena_options' );
        $this->slug = ! empty( $opt['portfolio_slug'] ) ? strtolower( str_replace( ' ', '', $opt['portfolio_slug'] ) ) : 'portfolio';

        add_action( 'init', [$this, 'register_post_type'] );
        add_action( 'init', [$this, 'register_taxonomy_cat'] );

        // Register templates
        add_filter( 'single_template', [$this, 'get_single_template'] );
        add_filter( 'archive_template', [$this, 'get_archive_template'] );
    }

    /**
     * Register post type
     */
    public function register_post_type() {
        $labels = [
            'name'                  => $this->name,
            'singular_name'         => $this->singular_name,
            'add_new'               => sprintf( esc_html__( 'Add New %s', 'jeena-toolkit' ), $this->singular_name ),
            'add_new_item'          => sprintf( esc_html__( 'Add New %s', 'jeena-toolkit' ), $this->singular_name ),
            'edit_item'             => sprintf( esc_html__( 'Edit %s', 'jeena-toolkit' ), $this->singular_name ),
            'new_item'              => sprintf( esc_html__( 'New %s', 'jeena-toolkit' ), $this->singular_name ),
            'all_items'             => sprintf( esc_html__( 'All %s', 'jeena-toolkit' ), $this->plural_name ),
            'view_item'             => sprintf( esc_html__( 'View %s', 'jeena-toolkit' ), $this->name ),
            'search_items'          => sprintf( esc_html__( 'Search %s', 'jeena-toolkit' ), $this->name ),
            'not_found'             => sprintf( esc_html__( 'No %s found', 'jeena-toolkit' ), strtolower( $this->name ) ),
            'not_found_in_trash'    => sprintf( esc_html__( 'No %s found in Trash', 'jeena-toolkit' ), strtolower( $this->name ) ),
            'parent_item_colon'     => '',
            'menu_name'             => $this->name,
            'featured_image'        => sprintf( esc_html__( '%s Image ', 'jeena-toolkit' ), $this->singular_name ),
            'set_featured_image'    => sprintf( esc_html__( 'Set %s Image', 'jeena-toolkit' ), $this->singular_name ),
            'remove_featured_image' => esc_html__( 'Remove ', 'jeena-toolkit' ) . $this->singular_name . esc_html__( ' Image', 'jeena-toolkit' ),
            'use_featured_image'    => sprintf( esc_html__( 'Use as %s Image', 'jeena-toolkit' ), $this->singular_name ),
        ];

        $args = [
            'labels'        => $labels,
            'public'        => true,
            'show_ui'       => true,
            'show_in_menu'  => true,
            'query_var'     => true,
            'rewrite'       => ['slug' => $this->slug],
            'has_archive'   => true,
            'menu_position' => 12,
            'supports'      => [
                'title',
                'editor',
                'author',
                'thumbnail',
                'elementor',
                'page-attributes',
            ],
            'menu_icon'     => 'dashicons-images-alt2',
        ];

        register_post_type( $this->type, $args );
    }

    /**
     * Register taxonomy category
     */
    public function register_taxonomy_cat() {
        $category = 'category';

        $labels = [
            'name'              => sprintf( esc_html__( '%s Categories', 'jeena-toolkit' ), $this->name ),
            'menu_name'         => sprintf( esc_html__( '%s Categories', 'jeena-toolkit' ), $this->name ),
            'singular_name'     => sprintf( esc_html__( '%s Category', 'jeena-toolkit' ), $this->name ),
            'search_items'      => sprintf( esc_html__( 'Search %s Categories', 'jeena-toolkit' ), $this->name ),
            'all_items'         => sprintf( esc_html__( 'All %s Categories', 'jeena-toolkit' ), $this->name ),
            'parent_item'       => sprintf( esc_html__( 'Parent %s Category', 'jeena-toolkit' ), $this->name ),
            'parent_item_colon' => sprintf( esc_html__( 'Parent %s Category:', 'jeena-toolkit' ), $this->name ),
            'new_item_name'     => sprintf( esc_html__( 'New %s Category Name', 'jeena-toolkit' ), $this->name ),
            'add_new_item'      => sprintf( esc_html__( 'Add New %s Category', 'jeena-toolkit' ), $this->name ),
            'edit_item'         => sprintf( esc_html__( 'Edit %s Category', 'jeena-toolkit' ), $this->name ),
            'update_item'       => sprintf( esc_html__( 'Update %s Category', 'jeena-toolkit' ), $this->name ),
        ];

        $args = [
            'labels'            => $labels,
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => $this->slug . '-' . $category],
            'show_in_nav_menus' => false,
        ];

        register_taxonomy( $this->type . '_' . $category, [$this->type], $args );
    }

    /**
     * Single Page
     *
     * @param $single_template
     * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/single_template;
     */
    public function get_single_template( $single_template ) {
        global $post;

        if ( $post->post_type == $this->type ) {
            if ( file_exists( get_template_directory() . '/single-portfolio.php' ) ) {
                return $single_template;
            }

            $single_template = JT_INCLUDES . '/post-type/templates/single-portfolio.php';
        }

        return $single_template;
    }

    /**
     * Archive Page
     *
     * @param $archive_template
     * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/archive_template
     */
    public function get_archive_template( $archive_template ) {
        global $post;

        if ( is_post_type_archive( $this->type ) || ( is_archive() && ! empty( $post->post_type ) && $post->post_type == 'jeena_portfolio' ) ) {
            if ( file_exists( get_template_directory() . '/archive-portfolio.php' ) ) {
                return $archive_template;
            }

            $archive_template = JT_INCLUDES . '/post-type/templates/archive-portfolio.php';
        }

        return $archive_template;
    }

}

new Portfolio();