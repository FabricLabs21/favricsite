<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jeena
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">
	<?php
        // You can start editing here -- including this comment!
        if ( have_comments() ): ?>

            <h4 class="comments-title">
                <?php
                    comments_number(
                        esc_html__( 'Comments (0)', 'jeena' ),
                        esc_html__( 'Comments (1)', 'jeena' ),
                        esc_html__( 'Comments (%)', 'jeena' )
                    );
                ?>
            </h4>
            <!-- Comment List -->
            <ul class="comment-list">
                <?php
                    wp_list_comments( [
                        'walker'      => new Jeena_Comment_Walker(),
                        'avatar_size' => 100,
                        'short_ping'  => true,
                    ] );
                ?>
            </ul>

            <?php
                the_comments_navigation();

                // If comments are closed and there are comments, let's leave a little note, shall we?
                if ( ! comments_open() ): ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'jeena' );?></p>
                <?php endif;
            ?>

        <?php endif;

        /**
         * Custom comments_args
         * @link https://developer.wordpress.org/reference/functions/comment_form/
         */
        $commenter = wp_get_current_commenter();

        $comments_args = [
            'title_reply_before' => wp_kses_post( '<h4 id="reply-title" class="comment-reply-title"><span>' ),
            'title_reply_after'  => wp_kses_post( '</span></h4>' ),
            'title_reply'        => esc_html__( 'Leave a Comment', 'jeena' ),
            'fields'             => apply_filters( 'comment_form_default_fields', [
                'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Full Name *', 'jeena' ) . '" required /></p>',
                'email'  => '<p class="comment-form-email"><input id="email" name="email" type="email" placeholder="' . esc_attr__( 'Email *', 'jeena' ) . '" required /></p>',
                'url'    => '<p class="comment-form-url"><input id="url" name="url" type="url" placeholder="' . esc_attr__( 'Website', 'jeena' ) . '" /></p>',
            ] ),
            'comment_field'      => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" placeholder="' . esc_attr__( 'Write Comment', 'jeena' ) . '" required></textarea></p>',
            'class_submit'       => 'submit-btn',
            'label_submit'       => esc_html__( 'Post Comment', 'jeena' ),
            'format'             => 'xhtml',
        ];

        comment_form( $comments_args );
    ?>
</div>
