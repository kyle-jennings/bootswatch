<?php

/**
 * Custom Excerpt Length
 */
function bootswatches_continue_reading_link() {
    global $summary_settings;

    return ' <a href="'. esc_url( get_permalink() ) . '">' . __('Read More', 'bootswatches') .'</a>';
}


function bootswatches_excerpt_length() {
    global $summary_settings;

    return 55;
}

function bootswatches_auto_excerpt_more( $more ) {
    return bootswatches_continue_reading_link();
}

function bootswatches_custom_excerpt_more( $output ) {
    if ( has_excerpt() && !is_attachment() ) {
        $output .= bootswatches_continue_reading_link();
    }
    return $output;
}


// if(get_option('rss_use_excerpt', true) == true) {
    // $summary_settings = get_option('summary_settings', true);

    add_filter( 'excerpt_length', 'bootswatches_excerpt_length' );
    add_filter( 'excerpt_more', 'bootswatches_auto_excerpt_more' );
    add_filter( 'get_the_excerpt', 'bootswatches_custom_excerpt_more' );
// }
