<?php
namespace JeenaToolkit\TemplateBuilder;

defined( 'ABSPATH' ) || exit;

/**
 * Builder Admin Class
 *
 * @since 2.0.0
 */
class Template_Admin {

    /**
     * Constructor
     */
    public function __construct() {

        add_action( 'admin_menu', [$this, 'admin_menu'] );

        add_filter( 'manage_jeena_template_posts_columns', [$this, 'custom_columns'] );
        add_filter( 'manage_jeena_template_posts_custom_column', [$this, 'display_custom_columns'] );
    }

    /**
     * Register admin menu
     *
     * @return void
     */
    public function admin_menu() {
        add_menu_page(
            __( 'Template Builder', 'jeena-toolkit' ),
            __( 'Template Builder', 'jeena-toolkit' ),
            'manage_options',
            'edit.php?post_type=jeena_template',
            '',
            JT_THEME_ASSETS . '/img/webtend-logo.png',
            3
        );
    }

    /**
     * Add Custom Columns in admin view table
     *
     * @param [type] $columns
     * @return void
     */
    public function custom_columns( $columns ) {
        $columns['type'] = __( 'Type', 'jeena-toolkit' );
        $columns['info'] = __( 'Info', 'jeena-toolkit' );

        return $columns;
    }

    /**
     * Admin Custom Columns view table content
     *
     * @param [type] $name
     *
     * @return void
     */
    public function display_custom_columns( $name ) {
        global $post;

        switch ( $name ) {
        case 'type':
            echo ucwords( str_replace( '_', ' ', $this->get_template_type( $post->ID ) ) );
            break;
        case 'info':
            echo $this->get_item_info( $post->ID );
            break;
        }
    }

    /**
     * Get Template Type
     *
     * @param int $post_id
     *
     * @return string
     */
    public function get_template_type( $post_id ) {

        $meta = get_post_meta( $post_id, 'jeena_tb_settings', true );

        if ( isset( $meta['template_type'] ) ) {
            $template_type = $meta['template_type'];
        } else {
            $template_type = '';
        }

        return $template_type;
    }

    /**
     * Get Item Info to Display in admin table
     *
     * @param int $post_id
     *
     * @return void
     */
    public function get_item_info( $post_id ) {
        $type = $this->get_template_type( $post_id );
        $info = '';

        if ( $type == 'block' ) {
            $info = '<input class="wp-ui-text-highlight code widefat" type="text" onfocus="this.select();" readonly="readonly" value="[jeena-tb-block id=&quot;' . $post_id . '&quot;]">';
        } elseif ( $type === 'offcanvas' ) {
            $settings = get_post_meta( $post_id, 'jeena_tb_settings', true );
            $info .= '<b>' . esc_html( 'Width:', 'jeena-toolkit' ) . '</b> ' . $settings['offcanvas_width']['width'] . 'px';
        } else {
            $info = $this->get_pretty_condition( 'include', $post_id ) . '</br>' . $this->get_pretty_condition( 'exclude', $post_id );
        }

        return $info;
    }

    /**
     * Get pretty condition to display in admin table
     *
     * @param string $type
     * @param [type] $post_id
     *
     * @return void
     *
     */
    public function get_pretty_condition( $type, $post_id ) {
        $info    = null;
        $include = get_post_meta( $post_id, 'jeena_tb_' . $type, true );

        if ( is_array( $include ) ) {
            $lastKey = array_keys( $include );
            $lastKey = \end( $lastKey );
            $info .= '<b>' . ucfirst( $type ) . ': </b>';
            $index = 0;

            foreach ( $include as $rule ) {
                $index++;

                if ( $index != 1 ) {
                    $info .= ', ';
                }
                $info .= ucwords( str_replace( '_', ' ', $rule['rule'] ) );
            }
        }

        return $info;
    }
}

new Template_Admin();
