<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bootswatches
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header">
		<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="post-meta">
			<?php bootswatches_post_header(); ?>
		</div><!-- .post-meta -->
		<?php endif; ?>
	</header><!-- .post-header -->

	<div class="post-summary">
		<?php the_excerpt(); ?>
	</div><!-- .post-summary -->

	<footer class="post-footer">
		<?php bootswatches_entry_footer(); ?>
	</footer><!-- .post-footer -->
</article><!-- #post-## -->
