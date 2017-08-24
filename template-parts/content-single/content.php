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


    <div class="col-md-12 <?php #echo $right; ?>">
        <header class="post-header">



        </header>

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

        <?php echo bootswatch_get_entry_footer($post); // WPCS: xss ok. ?>


    </div>
</article><!-- #post-## -->
