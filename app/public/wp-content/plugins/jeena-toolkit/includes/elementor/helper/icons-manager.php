<?php
namespace JeenaToolkit\ElementorAddon\Helper;

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

class Icons_Manager {

    public function __construct() {
        add_filter( 'elementor/icons_manager/additional_tabs', [$this, 'add_icons_tab'] );
    }

    public function add_icons_tab( $tabs ) {
        $icon_css = get_template_directory_uri() . '/assets/fonts/flaticon.min.css';

        $tabs['jeena-flaticon'] = [
            'name'          => 'jeena-flaticon',
            'label'         => esc_html__( 'Jeena Icons', 'jeena-toolkit' ),
            'url'           => $icon_css,
            'prefix'        => 'flaticon-',
            'displayPrefix' => 'flaticon',
            'labelIcon'     => 'flaticon flaticon-creativity',
            'ver'           => '1.0',
            'icons'         => $this->icon_list(),
            'native'        => true,
        ];
        return $tabs;
    }

    /**
     * Get a list of happy icons
     *
     * @return array
     */
    public function icon_list() {
        $icon = [
            'networking',
            'coding',
            'coding-1',
            'logo',
            'seo',
            'seo-1',
            'target',
            'target-audience',
            'experience',
            'customer-experience',
            'medal',
            'quotation',
            'consulting',
            'project-management',
            'ui',
            'startup',
            'rocket',
            'trust',
            'technical-support',
            'wrench',
            'app-development',
            'costumer',
            'creativity',
            'test',
            'cyber-security',
            'cyber-security-1',
            'support',
            'phone',
            'social-media',
            'brainstorming',
            'trophy',
            'development',
            'pie-chart',
            'layers',
            'agile',
            'mission',
            'mission-1',
            'megaphone',
            'arrow',
            'technology',
        ];

        return $icon;
    }
}

new Icons_Manager();