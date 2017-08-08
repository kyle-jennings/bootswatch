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


    <div class="post-content col-md-12">
    	<?php
    		if ( !is_single() ) :
                ?>

                <?php
                echo '<header class="post-header">';
        			the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

                    if ( 'page' !== get_post_type() ) : ?>
            		<div class="post-meta">
            			<?php bootswatch_posted_on(); ?>
            		</div><!-- .post-meta -->
            		<?php
            		endif;


                    $video = get_post_meta($post->ID, '_post_format_video', true);
                    echo bootswatch_get_the_video_markup($video);

                    bootswatch_entry_footer();
                echo '</header>';

            else:
                echo '<header class="post-header">';
                    the_title( '<h1 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );

                    if ( 'page' !== get_post_type() ) : ?>
                    <div class="post-meta">
                        <?php bootswatch_posted_on(); ?>
                    </div><!-- .post-meta -->
                    <?php
                    endif;

                    bootswatch_entry_footer();
                echo '</header>';
    		endif;
        ?>


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
            <?php
            wp_link_pages( array(
                'before' => '<nav aria-label="Page navigation"><ul class="pagination">',
                'after'  => '</ul></nav>',
            ) );
            ?>
        </div>

    	<footer class="entry-footer post-meta">
            <?php bootswatch_the_edit_post_link(); ?>
    	</footer><!-- .entry-footer -->
    </div>
</article><!-- #post-## -->
