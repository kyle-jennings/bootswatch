<?php


function bootswatches_ajax_video() {
    if(isset($_POST['data'])) {
        $url = esc_url_raw( wp_unslash( $_POST['data'] ) );
    }
    else
        wp_die();

    bootswatches_the_video_markup($url);
    wp_die();
}
add_action('wp_ajax_bootswatches_video_shortcode', 'bootswatches_ajax_video');


function bootswatches_ajax_calculate_widget_width() {

    
    if( !isset($_POST['data']))
        wp_die();

    echo bootswatches_calculate_widget_width( wp_unslash(absint($_POST['data'])) ); // WPCS: xss ok.

    wp_die();
}

add_action('wp_ajax_bootswatches_calculate_widget_width' ,'bootswatches_ajax_calculate_widget_width');
add_action('wp_ajax_nopriv_bootswatches_calculate_widget_width' ,'bootswatches_ajax_calculate_widget_width');