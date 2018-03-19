<?php
/**
 * This file contains the function which produce html videos, and also has some
 * helper functions
 */


function bootswatches_get_the_video_markup($url = null)
{
    if (!$url) {
        return;
    }

    $settings = '';
    $filetypes = array('.mp4', '.mov', '.wmv', '.avi', '.mpg', '.ogv', '.3gp', '.3g2',);
    $type = bootswatches_get_video_type($url);

    $output = '';
    $video = '';
    $atts = '';

    if (in_array(substr($url, -4), $filetypes)) {
        $video .= '<video class="video" '.esc_attr($atts).' src="'.esc_attr($url).'" type="video/'.esc_attr($type).'" controls="controls">';
        $video .= '</video>';
    } elseif (wp_oembed_get($url)) {
        $video .= wp_oembed_get($url);
    }

    $output .= '<div class="video-screen">';
        $output .= $video;
    $output .= '</div>';


    return $output;
}


function bootswatches_the_video_markup($url)
{
    echo bootswatches_get_the_video_markup($url); //WPCS: xss ok.
}


function bootswatches_get_youtube_id($url)
{
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    
    if (isset($match[1])) {
        return $match[1];
    }

    return false;
}


function bootswatches_get_video_type($url)
{

    $filetypes = array('.mp4', '.mov', '.wmv', '.avi', '.mpg', '.ogv', '.3gp', '.3g2',);
    $type = null;
    if(in_array(substr($url, -4), $filetypes)) {
        $type = 'uploaded';
    } elseif (preg_match('#^https?://(?:www\.)?(?:youtube\.com/watch|youtu\.be/)#', $url)) {
        $type = 'youtube';
    } elseif(preg_match('#^https?://(.+\.)?vimeo\.com/.*#', $url)) {
        $type = 'vimeo';
    }

    return $type;
}
