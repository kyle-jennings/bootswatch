<?php
/**
 * The front page template file
 *
 * It is used to display the front page of the website.
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
            // inc/frontend/page-sortables.php
            bootswatches_page_sortables('frontpage_sortables_setting');
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
