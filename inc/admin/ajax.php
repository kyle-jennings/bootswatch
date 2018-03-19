<?php


function bootswatches_ajax_video()
{
    if (isset($_POST['data'])) {
        $url = esc_url_raw(wp_unslash($_POST['data']));
    } else {
        wp_die();
    }

    bootswatches_the_video_markup($url);
    wp_die();
}
add_action('wp_ajax_bootswatches_video_shortcode', 'bootswatches_ajax_video');


function bootswatches_ajax_calculate_widget_width()
{

    
    if (!isset($_POST['data'])) {
        wp_die();
    }

    echo bootswatches_calculate_widget_width(wp_unslash(absint($_POST['data']))); // WPCS: xss ok.

    wp_die();
}

add_action('wp_ajax_bootswatches_calculate_widget_width', 'bootswatches_ajax_calculate_widget_width');
add_action('wp_ajax_nopriv_bootswatches_calculate_widget_width', 'bootswatches_ajax_calculate_widget_width');



/**
 * [bootswatches_postformat_shortcode description]
 * @return void       echo markup.
 */
function bootswatches_postformat_shortcode()
{
    error_log('shortcode');
    if (! isset($_POST['pfpSTR']) || empty($_POST['pfpSTR'])) {
        return;
    }

    $str = sanitize_text_field(wp_unslash($_POST['pfpSTR']));
    echo do_shortcode($str); // WPCS: xss ok.

    exit();
}

add_action('wp_ajax_bootswatches_postformat_shortcode', 'bootswatches_postformat_shortcode');


/**
 * Returns the OEMBED generated markup for media elements
 *
 * @param  string $url  the url of the asset (image, video ect).
 * @param  string $type the asset type (image, video ect).
 * @return void       echo markup.
 */
function bootswatches_postformat_oembed($url = null, $type = null)
{

    error_log('oembed');
    if ((! $url || ! $type) && (isset($_POST['pfpType']) && isset($_POST['pfpURL']))) {
        $type = sanitize_text_field(wp_unslash($_POST['pfpType']));
        $url = esc_url_raw(wp_unslash($_POST['pfpURL']));
    } else {
        $type = sanitize_text_field(wp_unslash($type));
        $url = esc_url_raw(wp_unslash($url));
    }


    $func = 'bootswatches_postformat_get_the_' . strtolower($type) . '_markup';
    
    echo call_user_func($func, $url); // WPCS: xss ok.

    exit();
}

add_action('wp_ajax_bootswatches_postformat_oembed', 'bootswatches_postformat_oembed');
