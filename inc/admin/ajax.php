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
