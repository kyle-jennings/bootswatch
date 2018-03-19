<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bootswatches
 */
global $post;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf row'); ?> >


    <div class="post-content col-md-12">
        <?php

        if ('page' !== get_post_type()) : ?>
        <div class="post-meta">
        <?php
            echo bootswatches_get_the_date(); // WPCS: xss ok.
            echo bootswatches_get_the_author(); // WPCS: xss ok.
            echo bootswatches_get_the_comment_count_link(); // WPCS: xss ok.
        ?>
        </div><!-- .post-meta -->
        <?php
        endif;

        echo '</header>';

        ?>

        <div class="post-content">
        <?php
            the_content(sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. */
                    __('Continue reading %s <span class="meta-nav">&rarr;</span>', 'bootswatches'),
                    array('span' => array('class' => array()))
                ),
                the_title('<span class="screen-reader-text">"', '"</span>', false)
            ));
        ?>
        </div><!-- .post-meta -->


        <?php echo bootswatches_get_entry_footer($post); // WPCS: xss ok.?>


    </div>
</article><!-- #post-## -->
