<?php
/**
 * Custom Woocommerce shop page.
 */
use JeenaTheme\Classes\Jeena_Helper as Helper;

get_header();
?>

<div class="<?php Helper::container()?>">
    <div class="content-area">
        <?php woocommerce_content();?>
    </div>
</div>

<?php
get_footer();