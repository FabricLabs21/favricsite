<?php
/**
 * Template Welcome
 *
 * Welcome Template for admin panel
 *
 * @package Jeena
 */

$allowed_html = [
    'a' => [
        'href'   => true,
        'target' => true,
    ],
];

?>

<div class="jeena-welcome-wrapper">
    <div class="jeena-welcome-title">
        <h1><?php esc_html_e( 'Welcome to', 'jeena' );?>
            <?php echo JEENA_NAME; ?>
        </h1>
        <span class="jeena-version-theme">
            <?php esc_html_e( 'Version - ', 'jeena' );?>
            <?php echo JEENA_VERSION; ?>
        </span>
        <span class="jeena-welcome-subtitle">
            <?php
                echo sprintf( esc_html__( '%s is already installed and ready to use! Let\'s build something impressive.', 'jeena' ), JEENA_NAME );
            ?>
        </span>
    </div>
    <div class="jeena-welcome-step-box">
        <div class="step-box-left">
            <div class="theme-screenshot">
                <img src="<?php echo esc_url( get_template_directory_uri() . "/screenshot.png" ); ?>">
            </div>
        </div>
        <div class="step-box-right">
            <h4 class="step-subtitle">
                <?php
                    echo sprintf(
                        wp_kses( __( 'Just complete the steps below and you will be able to use all functionalities of %s theme by <a href="%s" target="_blank">WebTend</a>', 'jeena' ), $allowed_html ),
                        JEENA_NAME,
                        esc_url( 'https://themeforest.net/user/webtend' )
                    );
                ?>
            </h4>
            <ul>
                <li>
                    <span class="step-title">
                        <?php esc_html_e( 'Step 1', 'jeena' );?>
                    </span>
                    <?php
                        echo sprintf(
                            wp_kses( __( 'Check <a href="%s">requirements</a> to avoid errors with your WordPress.', 'jeena' ), $allowed_html ),
                            esc_url( admin_url( 'admin.php?page=jeena_requirements' ) )
                        );
                    ?>
                </li>
                <li>
                    <span class="step-title">
                        <?php esc_html_e( 'Step 2', 'jeena' );?>
                    </span>
                    <?php esc_html_e( 'Install Required and recommended plugins.', 'jeena' );?>
                </li>
                <li>
                    <span class="step-title">
                        <?php esc_html_e( 'Step 3', 'jeena' );?>
                    </span>
                    <?php esc_html_e( 'Import demo content', 'jeena' );?>
                </li>
            </ul>
        </div>
    </div>
</div>