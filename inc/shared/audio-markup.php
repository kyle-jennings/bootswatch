<?php


function bootswatch_get_the_audio_markup($url = null, $background = null) {
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


function bootswatch_the_audio_markup($url, $background = null) {
    echo bootswatch_get_the_audio_markup($url, $background); //WPCS: xss ok.
}



function bootswatch_enqueue_visualizer_script(){
    $file = get_template_directory() . '/_dev/src/js/audio-vis-2d.js';
    if(!is_readable($file))
        return false;
    $script = '';
    $script .= '<script>';
        $script .= file_get_contents($file);
        $script .= 'window.audioVis2D(".js--audio-player");';
    $script .= '</script>';

    echo $script; // WPCS: xss ok.
}
