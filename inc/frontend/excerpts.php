<?php

/**
 * Custom Excerpt Length
 */
function bootswatch_continue_reading_link() {
    global $summary_settings;

    return ' <a href="'. esc_url( get_permalink() ) . '">' . __('Read More', 'bootswatch') .'</a>';
}


function bootswatch_excerpt_length() {
    global $summary_settings;

    return 55;
}

function bootswatch_auto_excerpt_more( $more ) {
    return bootswatch_continue_reading_link();
}

function bootswatch_custom_excerpt_more( $output ) {
    if ( has_excerpt() && !is_attachment() ) {
        $output .= bootswatch_continue_reading_link();
    }
    return $output;
}


// if(get_option('rss_use_excerpt', true) == true) {
    // $summary_settings = get_option('summary_settings', true);

    add_filter( 'excerpt_length', 'bootswatch_excerpt_length' );
    add_filter( 'excerpt_more', 'bootswatch_auto_excerpt_more' );
    add_filter( 'get_the_excerpt', 'bootswatch_custom_excerpt_more' );
// }
