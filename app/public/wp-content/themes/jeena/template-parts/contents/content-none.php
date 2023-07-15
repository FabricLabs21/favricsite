<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jeena
 */
?>

<div class="not-found-wrapper">
    <h3 class="not-found-title"><?php esc_html_e( 'Nothing Found', 'jeena' );?></h3>

    <div class="not-found-content">
        <?php if( is_home() && current_user_can( 'publish_posts' ) ) : ?>
            <p>
                <?php esc_html_e( 'Ready to publish your first post?.', 'jeena' ); ?>
                <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ) ?>">
                    <?php esc_html_e( 'Get started here', 'jeena' ); ?>
                </a>
            </p>
        <?php elseif( is_search() ) : ?>
            <p>
                <?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'jeena' ); ?>
            </p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p>
                <?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'jeena' ); ?>
            </p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</div>
