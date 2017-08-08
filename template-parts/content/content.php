<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bootswatch
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf row'); ?> >


    <div class="post-content col-md-12 <?php #echo $right; ?>">
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

                    $right = ' col-md-12';
                    if(has_post_thumbnail()):
                        $right = ' col-md-8';
                    ?>
                    <figure class="post-featured-image">
                        <?php the_post_thumbnail(); ?>
                    </figure>
                    <?php endif;

                    bootswatch_entry_footer();
                echo '</header>';

    		endif;
        ?>

    	<div class="post-meta">
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

                wp_link_pages( array(
                    'before' => '<nav aria-label="Page navigation"><ul class="pagination">',
                    'after'  => '</ul></nav>',
                ) );
    		?>
    	</div><!-- .post-meta -->

    	<footer class="entry-footer post-meta">
            <?php bootswatch_the_edit_post_link(); ?>
    	</footer><!-- .entry-footer -->
    </div>
</article><!-- #post-## -->
