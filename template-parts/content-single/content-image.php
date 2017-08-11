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


    <div class="post-content col-md-12 <?php #echo $right; ?>">
    	<?php
        echo '<header class="post-header">';
            the_title( '<h1 class="post-title">','</h1>' );

            if ( 'page' !== get_post_type() ) : ?>
            <div class="post-meta">
                <?php

                echo bootswatch_get_the_date();
                echo bootswatch_get_the_author();

                echo bootswatch_get_the_comment_count_link();

                ?>
            </div><!-- .post-meta -->
            <?php
            endif;

        echo '</header>';
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

        <?php echo bootswatch_get_entry_footer($post); ?>


    </div>
</article><!-- #post-## -->
