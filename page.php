<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
    	while ( have_posts() ) : the_post();

    		get_template_part( 'template-parts/single/content', 'page' );


    	endwhile; // End of the loop.
    	?>
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
