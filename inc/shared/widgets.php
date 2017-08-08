<?php

/**
 * Our Modified widgets, these replace the default widgets with near identical ones.
 *
 * The only real differences are that these widgets have additonal options.
 * @package Bootswatch
 */


$bootswatch_widgets = array(
    'WP_Nav_Menu_Widget' => 'Bootswatch_Nav_Menu_Widget',
    'WP_Widget_Archives' => 'Bootswatch_Widget_Archives',
    'WP_Widget_Categories' => 'Bootswatch_Widget_Categories',
    'WP_Widget_Recent_Comments' => 'Bootswatch_Widget_Recent_Comments',
    'WP_Widget_Recent_Posts' => 'Bootswatch_Widget_Recent_Posts',
    'WP_Widget_Meta' => 'Bootswatch_Widget_Meta',
    'WP_Widget_Pages' => 'Bootswatch_Widget_Pages',
    'WP_Widget_Calendar' => 'Bootswatch_Widget_Calendar',
);

// include the widget files
foreach($bootswatch_widgets as $old=>$new)
    require get_template_directory() . '/inc/widgets/'.$new.'.php';


// Replaces some default widgets with ours.
// These widgets function exactly the same but have some additional options which
// simple change out the data is displayed, mostly by styling the lists / menus
function bootswatch_register_widgets() {
    global $bootswatch_widgets;

    unregister_widget( 'WP_Widget_Links' );

    foreach($bootswatch_widgets as $old=>$new){
        unregister_widget( $old );
        register_widget( $new );
    }
}
add_action( 'widgets_init', 'bootswatch_register_widgets' );
