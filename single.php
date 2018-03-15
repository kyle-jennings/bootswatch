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

            $part = (get_post_format() == 'chat') ? 'chat' : get_post_format();
            $part = ($part !== 'chat' && get_post_format() ) ? 'post-format' : $part;
            get_template_part( 'template-parts/content-single/content', $part );

            $navigation_args = array(
                'prev_text' => '&laquo; Previous Post',
                'next_text' => 'Next Post &raquo;',
            );

            bootswatches_the_post_navigation($navigation_args);

    		// If comments are open or we have at least one comment, load up the comment template.
    		if ( comments_open() || get_comments_number() ) :
    			comments_template();
    		endif;

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
