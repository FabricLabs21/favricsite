<?php
namespace JeenaTheme\Admin;

defined( 'ABSPATH' ) || exit;

/**
 * Load Theme Admin
 */
class Jeena_Admin_Panel {

    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        add_action( 'admin_menu', [$this, 'theme_dashboard_menu'] );
        add_action( 'admin_init', [$this, 'redirect_theme_dashboard'] );
    }

    /**
     * Add Dashboard Menu
     *
     * @return void
     */
    public function theme_dashboard_menu() {
        add_menu_page(
            JEENA_NAME,
            JEENA_NAME,
            'manage_options',
            'jeena_dashboard',
            [$this, 'render_welcome_template'],
            JEENA_ASSETS . '/img/webtend-logo.png',
            2
        );

        $submenu = [];

        $submenu[] = [
            esc_html__( 'Welcome', 'jeena' ),
            esc_html__( 'Welcome', 'jeena' ),
            'manage_options',
            'jeena_dashboard',
            [$this, 'render_welcome_template'],
        ];

        $submenu[] = [
            esc_html__( 'Requirements', 'jeena' ),
            esc_html__( 'Requirements', 'jeena' ),
            'edit_posts',
            'jeena_requirements',
            [$this, 'render_requirements'],
        ];

        if ( current_user_can( 'activate_plugins' ) ) {
            $submenu[] = [
                esc_html__( 'Required Plugins', 'jeena' ),
                esc_html__( 'Required Plugins', 'jeena' ),
                'edit_posts',
                'jeena_required_plugins',
                [$this, 'render_required_plugins'],
            ];
        }

        $submenu[] = [
            esc_html__( 'Help Center', 'jeena' ),
            esc_html__( 'Help Center', 'jeena' ),
            'edit_posts',
            'jeena_help_center',
            [$this, 'render_help_center'],
        ];

        $submenu = apply_filters( 'jeena_dashboard_submenu', [$submenu] );

        foreach ( $submenu[0] as $key => $value ) {
            add_submenu_page(
                'jeena_dashboard',
                $value[0],
                $value[1],
                $value[2],
                $value[3],
                $value[4]
            );
        }
    }

    /**
     * Render Heading
     *
     * @return void
     */
    public function render_heading() {
        global $submenu;

        $menu_items = '';

        if ( isset( $submenu['jeena_dashboard'] ) ) {
            $menu_items = $submenu['jeena_dashboard'];
        }

        if ( ! empty( $menu_items ) ): ?>
        <div class="wrap jeena-dashboard-header">
            <ul class="nav-tab-wrapper">
                <?php foreach ( $menu_items as $item ):
                    $class = isset( $_GET['page'] ) && $_GET['page'] == $item[2] ? ' nav-tab-active' : ''; ?>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=' . $item[2] . '' ) ); ?>" class="nav-tab <?php  echo esc_attr( $class ); ?>">
                        <?php echo esc_html($item[0]); ?>
                    </a>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif;
    }

    /**
     * Render Welcome Template
     *
     * @return void
     */
    public function render_welcome_template() {
        $this->render_heading();

        require_once JEENA_ADMIN . '/templates/welcome.php';
    }

    /**
     * Render Theme Requirements
     *
     * @return void
     */
    public function render_requirements() {
        $this->render_heading();

        require_once JEENA_ADMIN . '/templates/requirements.php';
    }

    /**
     * Render Required Plugins
     *
     * @return void
     */
    public function render_required_plugins() {
        $this->render_heading();

        require_once JEENA_ADMIN . '/templates/required-plugin.php';
    }


    /**
     * Render Help Template
     *
     * @return void
     */
    public function render_help_center() {
        $this->render_heading();

        require_once JEENA_ADMIN . '/templates/help-center.php';
    }

    /**
     * Redirect To Theme Dashboard
     *
     * @return void
     */
    public function redirect_theme_dashboard() {
        global $pagenow;

        if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' === $pagenow ) {
            wp_safe_redirect( esc_url( admin_url( 'admin.php?page=jeena_dashboard' ) ) );

            exit;
        }
    }

    public function let_to_num( $v ) {
        $l   = substr( $v, -1 );
        $ret = substr( $v, 0, -1 );
        switch ( strtoupper( $l ) ) {
        case 'P':$ret *= 1024;
        case 'T':$ret *= 1024;
        case 'G':$ret *= 1024;
        case 'M':$ret *= 1024;
        case 'K':$ret *= 1024;
            break;
        }

        return $ret;
    }

    public function memory_limit() {
        $limit = $this->let_to_num( WP_MEMORY_LIMIT );
        if ( function_exists( 'memory_get_usage' ) ) {
            $limit = max( $limit, $this->let_to_num( @ini_get( 'memory_limit' ) ) );
        }

        return $limit;
    }
}

Jeena_Admin_Panel::instance()->initialize();