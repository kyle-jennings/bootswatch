<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bootswatch
 */
global $post;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf row'); ?> >


    <header class="post-header col-md-12">
        <h2 class="post-title">
        <?php
            the_title( bootswatch_post_format_icon( get_post_format() )
            . '<a href="'
            . esc_url( get_permalink() ) . '" rel="bookmark">',
            '</a>' );
         ?>
        </h2>
    </header>


<?php
    $gallery = get_post_meta($post->ID, '_post_format_gallery', true);
    echo '<div class="col-md-12">';
    bootswatch_carousel_markup($gallery);
    echo '</div>';
 ?>

    <!-- The left column of the post,  -->
    <div class="col-md-4 post-col-left">

        <?php
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
        ?>
    </div> <!-- col-md-4-->

    <div class="col-md-8">

        <!-- The post content -->
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
        </div>

        <!-- The edit link -->
        <div class="post-meta">
            <?php bootswatch_the_edit_post_link(); ?>
        </div>


        <!-- The footer, just contains the pager links -->
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
