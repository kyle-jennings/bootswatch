<?php

function bootswatches_get_navbar_brand() {
    $logo_tag = 'em';
    $brand = get_theme_mod('navbar_brand_setting', 'text');

    $output = '';
    if( $brand == 'text' ):

        // $output .= '<'.$logo_tag.' class="navbar-brand">';
            $output .= '<a class="navbar-brand" href="'.get_home_url().'" >'.get_bloginfo( 'name', 'display' ).'</a>';
        // $output .= '</'.$logo_tag.'>';

    else:

        $url = esc_url(bootswatches_get_custom_logo());

        // $output .= '<'.$logo_tag.' class="navbar-brand navbar-brand--image">';
            $output .= '<a class="navbar-brand navbar-brand--image" href="'.get_home_url().'" >';

                $output .= $url
                    ? '<img src="'.$url.'" alt="'.get_bloginfo( 'name', 'display' ).'">'
                    : get_bloginfo( 'name', 'display' );

            $output .= '</a>';
        // $output .= '</'.$logo_tag.'>';

    endif;

    return $output;
}


function bootswatches_navbar_brand() {
    echo bootswatches_get_navbar_brand(); // WPCS: xss ok.
}


function bootswatches_get_custom_logo($logo_id = null){

    $logo_id = get_theme_mod('custom_logo', null);
    if(!$logo_id)
        return false;

    $thumb_id = get_post_thumbnail_id($logo_id);
    $thumb_url_array = wp_get_attachment_image_src($logo_id, 'full', true);

    if( strpos(reset($thumb_url_array), 'wp-includes/images/media/default.png') )
        return false;

    return $thumb_url_array[0];
}
