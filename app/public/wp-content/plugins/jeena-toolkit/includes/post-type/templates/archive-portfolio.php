<?php
/**
 * Portfolio Archive Template
 */

use JeenaTheme\Classes\Jeena_Helper as Helper;
use JeenaTheme\Classes\Jeena_Post_Helper;
use JeenaToolkit\ElementorAddon\Templates\Portfolio_Template;

get_header();

$settings = [
    'layout'              => 'grid',
    'design'              => Helper::get_option( 'portfolio_style', 'normal'),
    'title_word'          => '',
    'show_category'       => 'no',
    'post_thumbnail_size' => 'large'
];

$title = Helper::get_option( 'archive_content_title', '' );
$desc  = Helper::get_option( 'archive_content_desc', '' );

?>
<div class="<?php Helper::container()?>">
    <div class="content-area">
        <div class="portfolio-archive-content">
            <?php if ( ! empty ( $title ) && ! empty ( $desc ) ) ?>
            <div class="jeena-advanced-heading">
                <?php if ( ! empty ( $title ) ) : ?>
                <h3 class="main-heading">
                    <?php echo jt_kses_basic( $title ) ?>
                </h3>
                <?php endif; ?>
                <?php if ( ! empty ( $desc ) ) : ?>
                <p>
                    <?php echo jt_kses_basic( $desc ) ?>
                </p>
                <?php endif; ?>
            </div>
            <?php if ( have_posts() ): ?>
                <div class="jeena-portfolio-items">
                    <?php
                        while ( have_posts() ): the_post();
                        Portfolio_Template::render_portfolio_item( $settings );
                        endwhile;
                    ?>
                </div>
                <?php Jeena_Post_Helper::pagination(); ?>
            <?php else : ?>
                <?php get_template_part( 'template-parts/contents/content', 'none' ); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
get_footer();
