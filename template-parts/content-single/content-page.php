<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bootswatches
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-meta">
		<?php
			the_content();

            // next page
            wp_link_pages( array(
                'before' => '<nav aria-label="Page navigation"><ul class="pagination">',
                'after'  => '</ul></nav>',
            ) );
		?>
	</div><!-- .post-meta -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="post-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'bootswatches' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .post-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
