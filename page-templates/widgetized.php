<?php
/*
Template Name: Widgetized Page

This template is used to display 3 rows of widgets, allowing users to have a
modular and customizable page as opposed to just showing text.

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
    <?php bootswatch_page_sortables('widgetized_sortables_setting'); ?>
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
