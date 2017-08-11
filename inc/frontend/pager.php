<?php


function bootswatch_link_pages_link_filter($link, $i ){

    preg_match('/<a href="/', $link, $matches);
    if(empty($matches))
        return '<li class="disabled"><a>'.$link.'</a></li>';
    else
        return '<li>' . $link .'</li>';

}

add_filter( 'wp_link_pages_link', 'bootswatch_link_pages_link_filter', 10, 2 );

function bootswatch_get_the_posts_navigation( $args = array() ) {

    $navigation = '';

     // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
        $args = wp_parse_args( $args, array(
            'prev_text'          => __( 'Older posts' ),
            'next_text'          => __( 'Newer posts' ),
            'screen_reader_text' => __( 'Posts navigation' ),
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


function bootswatch_the_posts_navigation( $args = array() ) {
    echo bootswatch_get_the_posts_navigation( $args);
}


function bootswatch_get_the_post_navigation( $args = array() ) {

    $navigation = '';

    $args = wp_parse_args( $args, array(
        'prev_text'          => '%title',
        'next_text'          => '%title',
        'in_same_term'       => false,
        'excluded_terms'     => '',
        'taxonomy'           => 'category',
        'screen_reader_text' => __( 'Post navigation' ),
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


function bootswatch_the_post_navigation( $args = array() ) {
    echo bootswatch_get_the_post_navigation( $args );
}


function bootswatch_get_paginate_links($args = array()) {

    $args['type'] = 'array';
    $pages = paginate_links($args);


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


function bootswatch_paginate_links($args = array()) {
    echo bootswatch_get_paginate_links($args);
}
