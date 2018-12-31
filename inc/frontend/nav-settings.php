<?php


/**
 * displays either a h1 or h2 tag for the title
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


// toggles the dark and light themes
function bootswatches_navbar_header_class() {
    $color = get_theme_mod('navbar_color_setting', 'light');
    $color = 'nav-header--'.$color;

    return $color;
}




/**
 * Navigate through pages of the feed
 */
function bootswatches_get_the_posts_navigation() {
    $args = array(
        'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2" title="older posts"></span>' . __('Older Posts', 'bootswatches'),
        'next_text' => __('Newer Posts', 'bootswatches') . ' <span class="dashicons dashicons-arrow-right-alt2" title="newer posts"></span>'
    );
    return get_the_posts_navigation($args);
}


function bootswatches_the_posts_navigation() {
    echo bootswatches_get_the_posts_navigation(); // WPCS: xss ok.
}