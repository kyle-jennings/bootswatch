<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

/**
 * the 404 settings
 *
 * returns:
 * $content
 * $pid
 * $header_page
 *
 */
extract( bootswatch_get_404_settings() );

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

            if($content == 'page' && $pid):

                $page = get_page($pid);
                $content = apply_filters('the_content', $page->post_content);
                echo $content; // WPCS: xss ok.

            else :
                echo '<p>' . esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'bootswatch' ) . '</p>';

                get_search_form();

                echo '<br>';
                echo '<br>';
                echo '<br>';

    			the_widget( 'Bootswatch_Widget_Pages', array('title'=>'Pages') );
            endif;
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
