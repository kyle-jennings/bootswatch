<?php

if(!function_exists('bootswatches_get_post_format_markup')){

    function bootswatches_get_post_format_markup($post = null, $format = 'standard')
    {

        if(!class_exists('BootswatchesPostFormat')) {
            return;
        }    
        
        if (!$post) {
            global $post;
        }

        $value = bootswatches_get_post_format_value($post->ID, $format, null);
        $valid_pf = in_array( $format, json_decode( BOOTSWATCHES_POST_FORMATS ), true );
        
        if (!$format || $format == 'standard' || !$value || !$valid_pf) {
            return false;
        }

        $markup = null;
        switch ($format) {
            case 'aside':
                $markup = $value;
                break;
            case 'audio':
                $background = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'full') : '';
                $markup    .= bootswatches_get_the_audio_markup($value);
                break;
            case 'gallery':
                $markup = do_shortcode('[gallery ids="' . $value . '"]');
                break;
            case 'image':
                $markup = '<a href="' . esc_url_raw($value) . '">';
                $markup .= '<img class="post-featured-image entry-featured-image" src="' . esc_url_raw($value) . '">';
                $markup .= '</a>';
                break;
            case 'quote':
                $markup = bootswatches_get_quote_markup($value);
                break;
            case 'status':
                $markup = bootswatches_get_status_markup($value);
                break;
            case 'video':
                $markup = bootswatches_get_the_video_markup($value);
                break;
        }

        if (!$markup) {
            return '';
        }

        $output = '<div class="entry__post-format-header col-sm-12">';
        $output .= $markup;
        $output .='</div>';

        return $output;
    }



}

if(!function_exists('bootswatches_post_format_markup')) {

    function bootswatches_post_format_markup($post = null, $format = 'standard')
    {
        if (!$post) {
            global $post;
        }

        echo bootswatches_get_post_format_markup($post, $format); //WPCS: xss ok.
    }
}


/**
 * The markup for quotes, as created by the quote post format
 */
function bootswatches_get_quote_markup($quote = array())
{
    if (!is_array($quote) || !isset($quote['author']) || !isset($quote['body'])){
        return;
    }

    $output = '';
    $output .= '<blockquote>';

        $output .= '<p> ' . $quote['body'] . '</p>';
        
        if ($quote['author']) {
            $output .= '<cite> ' . $quote['author'] . '</cite>';
        }
        
    $output .= '</blockquote>';

    return $output;
}



/**
 * The markup for the chat logs - this isnt used yet as it requires some work
 */
function bootswatches_get_chat_log($chat = null)
{
    if (!$chat || empty($chat) || empty($chat['messages'])) {
        return;
    }

    $messages = $chat['messages'];
    $style = 'graphical';

    $output = '';
    $output .= '<ol class="chat-log">';

    foreach ($messages as $message) {
        $output .= '<li class="chat-log__message chat-log__author- ' . $message['authorID'] . '">';
            $output .= '<h6 class="chat-log__author"> ' . $message['displayName'] . '</h6>';
            $output .= '<p class="chat-log__text"> ' . $message['text'] . '</p>';
        $output .= '</li>';
    }
    $output .= '</ol>';

    return $output;
}



/**
 * The markup for the chat logs - this isnt used yet as it requires some work
 */
function bootswatches_get_status_markup($status = null)
{
    if (!$status || empty($status)) {
        return;
    }

    $output = '<p> ' . $status . '</p>';

    return $output;
}
