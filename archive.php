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
 * @package Bootswatches
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
extract( bootswatches_template_settings() );

if( !$hide_content ):
?>


<div class="section section--body">
    <div class="container">
        <div class="row">
    <?php
    if($sidebar_position == 'left'):
        bootswatches_get_sidebar($template, $sidebar_position, $sidebar_size);
    endif;
    ?>

  <div class="main-content <?php echo esc_attr($main_width); ?>">
		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();


                if( !has_post_thumbnail() && !get_post_format()){
                    $part = 'vertical';
                }

                get_template_part( 'template-parts/feed/content', get_post_format() );

			endwhile;

            // pagination though the archive
            bootswatches_paginate_links();

		else :

			get_template_part( 'template-parts/feed/content', 'none' );

		endif; ?>
  </div>

  <?php
  if($sidebar_position == 'right'):
      bootswatches_get_sidebar($template, $sidebar_position, $sidebar_size);
  endif;
  ?>

</div><!-- /row -->
</div><!-- container -->
</div><!-- / section--body -->

<?php
endif;
get_footer();
