<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bootswatch
 */

get_header();

/**
 * get all the settings needed for the the template layout
 *
 * returns:
 * $template
 * $main_width
 * $hide_content
 * $sidebar_position
 *
 */
extract( bootswatch_template_settings() );

if( !$hide_content ):
?>


<div class="section section--body">
    <div class="container">
        <div class="row">
    <?php
    if($sidebar_position == 'left'):
        bootswatch_get_sidebar($template, $sidebar_position);
    endif;
    ?>

  <div class="main-content <?php echo esc_attr($main_width); ?>">
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content/content', 'search' );

			endwhile;

			bootswatch_the_posts_navigation();

		else :

			get_template_part( 'template-parts/content/content', 'none' );

		endif; ?>
  </div>

  <?php
  if($sidebar_position == 'right'):
      bootswatch_get_sidebar($template, $sidebar_position);
  endif;
  ?>

</div><!-- /row -->
</div><!-- container -->
</div><!-- / section--body -->

<?php
endif;

get_footer();
