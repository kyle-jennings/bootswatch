<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
    	while ( have_posts() ) : the_post();

            $part = (get_post_format() == 'chat') ? 'chat' : get_post_format();
            get_template_part( 'template-parts/content-single/content', $part );

            $navigation_args = array(
                'prev_text' => '&laquo; Previous Post',
                'next_text' => 'Next Post &raquo;',
            );

            bootswatch_the_post_navigation($navigation_args);

    		// If comments are open or we have at least one comment, load up the comment template.
    		if ( comments_open() || get_comments_number() ) :
    			comments_template();
    		endif;

    	endwhile; // End of the loop.
    	?>
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
