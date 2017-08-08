<?php
/*
Template Name: Sidenav Page

This template is used to display a sidenav for l o n g content

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
        bootswatch_sticky_sidenav($post->ID);
    endif;
    ?>
    <div class="main-content col-md-8">
    	<?php
    	while ( have_posts() ) : the_post();

    		get_template_part( 'template-parts/content/content', 'page' );

    		bootswatch_the_posts_navigation();

    		// If comments are open or we have at least one comment, load up the comment template.
    		if ( comments_open() || get_comments_number() ) :
    			comments_template();
    		endif;

    	endwhile; // End of the loop.
    	?>
    </div>
    <?php
    if($sidebar_position == 'right'):
        bootswatch_sticky_sidenav($post->ID);
    endif;
    ?>

</div><!-- /row -->
</div><!-- container -->
</div><!-- / section--body -->

<?php
endif;
get_footer();
