<?php
namespace JeenaTheme\Classes;

defined( 'ABSPATH' ) || exit;

/**
 * Load Theme Assets
 */
class Jeena_Assets {

    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        add_action( 'wp_enqueue_scripts', [$this, 'register_scripts'] );
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_styles'] );
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
        add_action( 'wp_enqueue_scripts', [$this, 'global_root_css'] );

        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin_styles'] );

        add_action( 'wp_head', [$this, 'custom_header_scripts'] );
        add_action( 'wp_footer', [$this, 'custom_footer_scripts'] );
    }

    /**
     * Load Google Font
     *
     * @return string
     */
    public function google_font_url() {
        $fonts_url     = '';
        $font_families = [];
        $subsets       = 'latin';

        $primary_font   = Jeena_Helper::get_option( 'primary_font', ['font-family' => ''] );
        $secondary_font = Jeena_Helper::get_option( 'secondary_font', ['font-family' => ''] );

        if ( '' == $primary_font || is_array( $primary_font ) && ! $primary_font['font-family'] ) {
            if ( 'off' !== _x( 'on', 'Roboto', 'jeena' ) ) {
                $font_families[] = 'Roboto:300i,300,400i,400,500i,500,600,700,800';
            }
        }

        if ( '' == $primary_font || is_array( $secondary_font ) && ! $secondary_font['font-family'] ) {
            if ( 'off' !== _x( 'on', 'Poppins', 'jeena' ) ) {
                $font_families[] = 'Poppins:300i,300,400i,400,500i,500,600,700,800';
            }
        }

        if ( $font_families ) {
            $fonts_url = add_query_arg( [
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( $subsets ),
            ], 'https://fonts.googleapis.com/css' );
        }

        return esc_url_raw( $fonts_url );
    }

    /**
     * Register Scripts
     */
    public function register_scripts() {
        wp_register_style( 'magnific-popup', JEENA_ASSETS . '/css/magnific-popup.min.css', [], '1.1.0' );
        wp_register_style( 'slick', JEENA_ASSETS . '/css/slick.min.css', [], '1.8.1' );

        wp_register_script( 'magnific-popup', JEENA_ASSETS . '/js/magnific-popup.min.js', ['jquery'], '1.1.0', true );
        wp_register_script( 'slick', JEENA_ASSETS . '/js/slick.min.js', ['jquery'], '1.8.1', true );
    }

    /**
     * Enqueue Theme Style
     *
     * @return void
     */
    public function enqueue_styles() {
        wp_enqueue_style( 'jeena-fonts', $this->google_font_url(), [], null );
        wp_enqueue_style( 'fontawesome', JEENA_ASSETS . '/fonts/font-awesome.min.css', [], '5.14' );
        wp_enqueue_style( 'animation', JEENA_ASSETS . '/css/animations.min.css', [], '1.0.1' );
        wp_enqueue_style( 'jeena-theme', JEENA_ASSETS . '/css/theme.min.css', [], JEENA_VERSION );
        wp_enqueue_style( 'jeena-style', get_stylesheet_uri(), [], JEENA_VERSION );
    }

    /**
     * Inline CSS
     *
     * @return void
     */
    public function global_root_css() {
        $primary_font    = Jeena_Helper::get_option( 'primary_font', ['font-family' => ''] );
        $secondary_font  = Jeena_Helper::get_option( 'secondary_font', ['font-family' => ''] );
        $container_width = Jeena_Helper::get_option( 'container_width', [] );
        $boxed_width     = Jeena_Helper::get_option( 'boxed_width', [] );

        $inline_css = [];

        if ( is_array( $primary_font ) && $primary_font['font-family'] ) {
            $inline_css[] = '--jeena-primary-font: ' . $primary_font['font-family'];
        } else {
            $inline_css[] = '--jeena-primary-font: Roboto';
        }

        if ( is_array( $primary_font ) && $secondary_font['font-family'] ) {
            $inline_css[] = '--jeena-secondary-font: ' . $secondary_font['font-family'];
        } else {
            $inline_css[] = '--jeena-secondary-font: Poppins';
        }

        if ( ! empty( $container_width ) ) {
            $inline_css[] = '--jeena-container-width: ' . $container_width['width'] . 'px';
        } else {
            $inline_css[] = '--jeena-container-width: 1320px';
        }

        if ( ! empty( $boxed_width ) ) {
            $inline_css[] = '--jeena-boxed-width: ' . $boxed_width['width'] . 'px';
        } else {
            $inline_css[] = '--jeena-boxed-width: 1530px';
        }

        $colors = Jeena_Helper::get_global_colors();

        foreach ( $colors as $key => $color ) {
            $inline_css[] = '--' . $color['slug'] . ':' . $color['value'];
        }

        if ( did_action( 'elementor/loaded' ) ) {
            foreach ( $colors as $key => $color ) {
                $inline_css[] = '--e-global-color-' . $key . ':' . $color['value'];
            }
        }

        $output = '
        :root {
            ' . esc_attr( implode( '; ', $inline_css ) ) . '
        }
        ';

        wp_add_inline_style( 'jeena-theme', $output );
    }

    /**
     * Enqueue Theme Scripts
     *
     * @return void
     */
    public function enqueue_scripts() {
        wp_enqueue_script( 'jeena-theme', JEENA_ASSETS . '/js/theme.min.js', ['jquery'], JEENA_VERSION, true );

        wp_localize_script(
            'jeena-theme',
            'jeenaLocalize', [
                'ajax_url' => admin_url( 'admin-ajax.php' ),
            ]
        );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    /**
     * Admin CSS
     */
    public function enqueue_admin_styles() {
        wp_enqueue_style( 'jeena-admin', JEENA_ASSETS . '/css/admin.css', [], JEENA_VERSION, 'all' );
    }

    /**
     * Custom Header Scripts
     */
    public function custom_header_scripts() {
        if ( '' !== Jeena_Helper::get_option( 'custom_header_scripts' ) ): ?>
        <script>
            <?php echo Jeena_Helper::get_option( 'custom_header_scripts' ); ?>
        </script>
        <?php endif;
    }

    /**
     * Custom Scripts
     */
    public function custom_footer_scripts() {
        if ( '' !== Jeena_Helper::get_option( 'custom_footer_scripts' ) ): ?>
        <script>
            <?php echo Jeena_Helper::get_option( 'custom_footer_scripts' ); ?>
        </script>
        <?php endif;
    }
}

Jeena_Assets::instance()->initialize();