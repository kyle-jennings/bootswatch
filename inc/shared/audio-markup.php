<?php
/**
 * This file contains teh functions to pruduce the markup for the audio player which 
 * is used in various places
 */

function bootswatches_get_the_audio_markup($url = null, $background = null) {
    if(!$url)
        return;

    $settings = '';

    $output = '';
    $audio = '';
    $class= $background ? ' has-background ' : '';
    $background = $background ? 'style="background-image: url('.$background.');"' : '';
    $filetypes = array( '.mp3', '.m4a', '.ogg', '.wav');

    if( in_array( substr( $url, -4 ), $filetypes ) ) {

        $audio .= '<div class="audio-player js--audio-player '.$class.'" '.$background.'>';
            $audio .= '<canvas class="audio-player__visualizer"></canvas>';
            $audio .= '<audio class="audio-player__player" src="'.$url.'" controls="controls"></audio>';
        $audio .= '</div>';

    }elseif( wp_oembed_get($url) ) {

        $audio .= wp_oembed_get($url);

    }

    $output .= $audio;



    return $output;
}


function bootswatches_the_audio_markup($url, $background = null) {
    echo bootswatches_get_the_audio_markup($url, $background); //WPCS: xss ok.
}



function bootswatches_enqueue_visualizer_script(){
    $script = 'window.audioVis2D(".js--audio-player");';
    wp_enqueue_script('audio-vis-2d', get_template_directory_uri() . '/assets/frontend/js/audio-vis-2d.js', null, null, true);
    wp_add_inline_script('audio-vis-2d', $script, 'after');

}
