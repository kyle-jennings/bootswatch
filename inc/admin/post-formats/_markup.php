<?php

function bootswatches_postformat_get_the_audio_markup( $url = null ) {
    return bootswatches_get_the_audio_markup( $url );
}


function bootswatches_postformat_get_the_video_markup( $url = null ) {
    if(!$url)
        return;

    $settings = '';
    $filetypes = array( '.mp4', '.mov', '.wmv', '.avi', '.mpg', '.ogv', '.3gp', '.3g2',);

    $output = '';
    $video = '';
    $atts = '';

    if( in_array( substr( $url, -4 ), $filetypes )  ){

        $video .= '<video class="video" '.esc_attr($atts).' src="'.esc_attr($url).'" type="video/'.esc_attr($type).'" controls="controls">';
        $video .= '</video>';

    }elseif( wp_oembed_get($url) ) {

        $video .= wp_oembed_get($url);

    }

    $output .= '<div class="video-screen">';
        $output .= $video;
    $output .= '</div>';


    return $output;
}




function bootswatches_postformat_get_the_image_markup($url = null) {
    if(!$url)
        return;

    $settings = '';

    $output = '';
    $image = '';

    $filetypes = array( '.jpg', '.jpeg', '.png', '.gif', '.ico');

    if( in_array( substr( $url, -4 ), $filetypes ) ) {

        $image .= '<img src="'.$url.'" />';

    }elseif( wp_oembed_get($url) ) {

        $image .= wp_oembed_get($url);

    }

    $output .= $image;



    return $output;
}
