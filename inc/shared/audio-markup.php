<?php


function bootswatch_get_the_audio_markup($url = null) {
    if(!$url)
        return;

    $settings = '';

    $output = '';
    $audio = '';

    $filetypes = array( '.mp3', '.m4a', '.ogg', '.wav');

    if( in_array( substr( $url, -4 ), $filetypes ) ) {

        $audio .= '<div class="audio-player js--audio-player">';
            $audio .= '<canvas class="audio-player__visualizer" ></canvas>';
            $audio .= '<audio class="audio-player__player" src="'.$url.'" controls="controls"></audio>';
        $audio .= '</div>';

    }elseif( wp_oembed_get($url) ) {

        $audio .= wp_oembed_get($url);

    }

    $output .= $audio;



    return $output;
}


function bootswatch_the_audio_markup($url) {
    echo bootswatch_get_the_audio_markup($url); //WPCS: xss ok.
}
