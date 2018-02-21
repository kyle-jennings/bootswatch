<?php


function bootswatch_ajax_video() {
    if(isset($_POST['data'])) {
        $url = esc_url_raw( wp_unslash( $_POST['data'] ) );
    }
    else
        wp_die();

    bootswatch_the_video_markup($url);
    wp_die();
}
add_action('wp_ajax_bootswatch_video_shortcode', 'bootswatch_ajax_video');


function bootswatch_ajax_calculate_widget_width() {

    
    if( !isset($_POST['data']))
        wp_die();

    echo bootswatch_calculate_widget_width( wp_unslash(absint($_POST['data'])) ); // WPCS: xss ok.

    wp_die();
}

add_action('wp_ajax_bootswatch_calculate_widget_width' ,'bootswatch_ajax_calculate_widget_width');
add_action('wp_ajax_nopriv_bootswatch_calculate_widget_width' ,'bootswatch_ajax_calculate_widget_width');