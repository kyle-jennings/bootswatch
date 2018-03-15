<?php


/**
 * Displays the nav title as either an H1 or H2 depending on the page
 *
 * Is this proper SEO?  I dont think this is correct
 * @return [type] [description]
 */
function bootswatches_get_bootswatches_nav_title() {
    $output = '';
    $link = '<a href="' . esc_url( home_url( '/' ) ) . '"
        accesskey="1" title="Home" aria-label="Home"> '.get_bloginfo( 'name', 'display' ).'
    </a>';
    if ( is_front_page() ) :
        $output .= '<h1 class="site-title">' . $link . '</h1>';
    else :
        $output .= '<h2 class="site-title">' . $link . '</h2>';
    endif;

    return $output;
}


function bootswatches_nav_title() {
    echo bootswatches_get_bootswatches_nav_title(); // WPCS: xss ok.
}
