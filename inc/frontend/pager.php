<?php

/**
 * Functions for page and post paginations
 */


/**
 * Displays page-links for paginated posts (i.e. includes the <!--nextpage--> Quicktag one or more times). 
 */
function bootswatches_link_pages_link_filter($link, $i ){

    preg_match('/<a href="/', $link, $matches);
    if(empty($matches))
        return '<li class="disabled"><a>'.$link.'</a></li>';
    else
        return '<li>' . $link .'</li>';

}

add_filter( 'wp_link_pages_link', 'bootswatches_link_pages_link_filter', 10, 2 );





function bootswatches_get_the_posts_navigation( $args = array() ) {

    $navigation = '';

     // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
        $args = wp_parse_args( $args, array(
            'prev_text'          => __( 'Older posts', 'bootswatches' ),
            'next_text'          => __( 'Newer posts', 'bootswatches' ),
            'screen_reader_text' => __( 'Posts navigation', 'bootswatches' ),
        ) );

        $next_link = get_previous_posts_link( $args['next_text'] . ' <span aria-hidden="true">&raquo;</span>' );
        $prev_link = get_next_posts_link( '<span aria-hidden="true">&laquo;</span> ' . $args['prev_text'] );

        $navigation = '<ul class="pager">';

        if ( $prev_link ) {
            $navigation .= '<li class="previous">' . $prev_link . '</li>';
        }

        if ( $next_link ) {
            $navigation .= '<li class="next">' . $next_link . '</li>';
        }

        $navigation .= '</ul>';


    }

    return $navigation;
}


function bootswatches_the_posts_navigation( $args = array() ) {
    echo bootswatches_get_the_posts_navigation($args);  // WPCS: xss ok.
}



/**
 * Navigates between posts
 * @param  array  $args [description]
 * @return [type]       [description]
 */
function bootswatches_get_the_post_navigation( $args = array() ) {

    $navigation = '';

    $args = wp_parse_args( $args, array(
        'prev_text'          => '%title',
        'next_text'          => '%title',
        'in_same_term'       => false,
        'excluded_terms'     => '',
        'taxonomy'           => 'category',
        'screen_reader_text' => __( 'Post navigation', 'bootswatches' ),
    ) );


    $previous = get_previous_post_link(
        '<li class="previous">%link</li>',
        $args['prev_text'],
        $args['in_same_term'],
        $args['excluded_terms'],
        $args['taxonomy']
    );

    $next = get_next_post_link(
        '<li class="next">%link</li>',
        $args['next_text'],
        $args['in_same_term'],
        $args['excluded_terms'],
        $args['taxonomy']
    );

    $navigation .= '<ul class="pager cf">';
        $navigation .= $previous . $next;
    $navigation .= '</ul>';


    return $navigation;
}


function bootswatches_the_post_navigation( $args = array() ) {
    echo bootswatches_get_the_post_navigation( $args ); // WPCS: xss ok.
}



/**
 * Navigates between pages
 * @param  array  $args [description]
 * @return [type]       [description]
 */
function bootswatches_get_paginate_links($args = array()) {

    $args['type'] = 'array';
    $pages = paginate_links($args);
    if(empty($pages))
        return '';

    $output = '';

    $output .= '<nav aria-label="Page navigation">';
        $output .= '<ul class="pagination">';
            foreach($pages as $key=>$page) {
                $class = '';
                if(strpos($page, 'current') !== false)
                    $class = 'active';
                if(strpos($page, '&hellip;') !== false)
                    $class = "disabled";

                $output .= '<li class="'.$class.'">'.$page.'</li>';
            }
        $output .= '</ul>';
    $output .= '</nav>';

    return $output;
}


function bootswatches_paginate_links($args = array()) {
    echo bootswatches_get_paginate_links($args); // WPCS: xss ok.
}
