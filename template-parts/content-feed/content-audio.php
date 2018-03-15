<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bootswatches
 */
global $post;
add_action('wp_footer', 'bootswatches_enqueue_visualizer_script' );
$background = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'full') : '';
$audio = get_post_meta($post->ID, '_post_format_audio', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf row'); ?> >


    <header class="post-header col-md-12">
        <h2 class="post-title">
        <?php
            the_title( bootswatches_post_format_icon( get_post_format() )
            . '<a href="'
            . esc_url( get_permalink() ) . '" rel="bookmark">',
            '</a>' );
         ?>
        </h2>
    </header>


<?php

    if($audio) {
        echo '<div class="col-md-12">';
        echo bootswatches_get_the_audio_markup($audio, $background); // WPCS: xss ok.
        echo '</div>';

    }
 ?>

    <div class="col-md-4 post-col-left">

        <?php
        if ( 'page' !== get_post_type() ) : ?>
            <div class="post-meta">
                <?php

                echo bootswatches_get_the_date(); // WPCS: xss ok.
                echo bootswatches_get_the_author(); // WPCS: xss ok.

                echo bootswatches_get_the_comment_popup(); // WPCS: xss ok.
                echo bootswatches_get_categories_links(); // WPCS: xss ok.
                echo bootswatches_get_tags_links(); // WPCS: xss ok.
                ?>
            </div><!-- .post-meta -->

            <?php
        endif;
        ?>
    </div> <!-- col-md-4-->

    <div class="col-md-8">

        <div class="post-content">
            <?php

                the_content( sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. */
                        __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'bootswatches' ),
                        array( 'span' => array( 'class' => array() ) )
                    ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                    )
                );

            ?>
        </div><!-- .post-meta -->

        <div class="post-meta">
            <?php bootswatches_the_edit_post_link(); ?>
        </div>


        <footer class="post-footer post-meta">
            <?php
                wp_link_pages( array(
                    'before' => '<nav aria-label="Page navigation"><ul class="pagination">',
                    'after'  => '</ul></nav>',
                ) );

            ?>

        </footer><!-- .post-footer -->

    </div>
</article><!-- #post-## -->
