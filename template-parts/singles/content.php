<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bootswatches
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>

    <?php if (get_post_format()) : ?>
    <div class="post-content entry-content col-md-12">
        
        <?php
        if(class_exists('BootswatchesPostFormat')) {
            bootswatches_post_format_markup( $post, get_post_format() );
        }
        ?>

    </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php

        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. */
                    __('Continue reading %s <span class="meta-nav">&rarr;</span>', 'bootswatches'),
                    array('span' => array('class' => array()))
                ),
                the_title('<span class="screen-reader-text">"', '"</span>', false)
            )
        );

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'bootswatches'),
            'after'  => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php bootswatches_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
