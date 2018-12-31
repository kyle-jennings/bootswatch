<?php
function bootswatches_get_sticky_sidenav($id = 0){
    if($id == 0)
        return false;

    $anchors = bootswatches_sticky_sidenav_anchors($id);

    $output = '';

    $output .= '<aside class="sidenav sticky col-sm-12">';
        $output .= '<ul class="sidenav-list">';
        foreach($anchors as $anchor):
            $label = str_replace(array('-','_'),' ', $anchor);
            $output .= '<li>';
                $output .= '<a href="#'.esc_attr($anchor).'">'.$label.'</a>';
            $output .= '</li>';
        endforeach;
        $output .= '</ul>';
    $output .= '</aside>';

    return $output;
}

function bootswatches_sticky_sidenav($id = 0){
    if($id == 0)
        return false;

    echo bootswatches_get_sticky_sidenav($id); // WPCS: xss ok.
}


function bootswatches_sticky_sidenav_anchors($id) {
    $post_content = get_post($id);
    $content = $post_content->post_content;

    $pattern = '(id="([a-zA-z0-9\-]+)"+)';
    preg_match_all($pattern, $content, $matches);

    if( 2 == count($matches) > 1  )
        return $matches[1];
    else
        return false;


}
