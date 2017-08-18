<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bootswatch
 */

global $post;

$right = ' col-md-8';

if( has_post_thumbnail() )
    $right = ' col-md-8';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf row'); ?> >

    <h2 class="post-title col-md-12">
    <?php

        $link_url = get_post_meta($post->ID, '_post_format_link_url', true);
        $link_text = get_post_meta($post->ID, '_post_format_link_text', true);

        if($link_url && $link_text) {
                echo '<i class="fa fa-link fa-sm"></i>';
                echo '<a href="'.$link_url.'" target="_blank" rel="follow">';
                    echo $link_text;
                echo '</a>';
            echo '';
        }else {
            the_title(
                '<a href="'
                . esc_url( get_permalink() ) . '" rel="bookmark">',
                '</a>'
            );
        }
     ?>
    </h2>


    <div class="col-md-4 post-col-left">


    <?php bootswatch_post_thumbnail($post); ?>

    <?php
    echo '<header class="post-header">';


        if ( 'page' !== get_post_type() ) : ?>
        <div class="post-meta">
            <?php

            echo bootswatch_get_the_date();
            echo bootswatch_get_the_author();

            echo bootswatch_get_the_comment_popup();
            echo bootswatch_get_categories_links();
            echo bootswatch_get_tags_links();
            ?>
        </div><!-- .post-meta -->

        <?php
        endif;


        // bootswatch_post_footer();
    echo '</header>';

    ?>
    </div> <!-- col-md-4-->

    <div class="<?php echo $right; ?>">

        <div class="post-content">
            <?php

                the_content( sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. */
                        __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'bootswatch' ),
                        array( 'span' => array( 'class' => array() ) )
                    ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                    )
                );

            ?>
        </div><!-- .post-meta -->

        <div class="post-meta">
            <?php bootswatch_the_edit_post_link(); ?>
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
