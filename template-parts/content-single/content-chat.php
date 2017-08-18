<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bootswatch
 */

global $post;

$chat = get_post_meta($post->ID, '_post_format_chat', true);
$chat_location = $chat['location'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf row'); ?> >


    <div class="col-md-12 <?php #echo $right; ?>">
        <header class="post-header">
            <?php
                if($chat_location == 'header'){
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
                }
            ?>

        </header>

        <?php
            if($chat_location == 'before-content')
                echo bootswatch_get_chat_log($chat);
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

        <?php
            if($chat_location == 'after-content')
                echo bootswatch_get_chat_log($chat);
        ?>


        <?php echo bootswatch_get_entry_footer($post); ?>


    </div>
</article><!-- #post-## -->
