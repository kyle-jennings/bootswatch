<?php

function bootswatches_get_navbar_brand()
{

    $brand = get_theme_mod('navbar_brand_setting', 'text');

    $output = '';
    if ($brand == 'logo') :
        $url = bootswatches_get_custom_logo();
    
        $img = $url
            ? '<img src="' . esc_url($url) . '" alt="' . get_bloginfo('name', 'display') . '">'
            : get_bloginfo('name', 'display');

        $output .= '<a class="navbar-brand navbar-brand-image" href="' . esc_url(home_url()) . '" >';
            $output .= $img;
        $output .= '</a>';
        
        return $output;
    else :
        $output .= '<a class="navbar-brand" href="' . esc_url(home_url()) . '" >' . get_bloginfo('name', 'display') . '</a>';
        
        return $output;
    endif;
}


function bootswatches_navbar_brand()
{
    echo bootswatches_get_navbar_brand(); // WPCS: xss ok.
}


function bootswatches_get_custom_logo($logo_id = null)
{

    $logo_id = get_theme_mod('custom_logo', null);
    if (!$logo_id) {
        return false;
    }
    
    $thumb_url_array = wp_get_attachment_image_src($logo_id, 'full', true);

    if (strpos(reset($thumb_url_array), 'wp-includes/images/media/default.png')) {
        return false;
    }

    return $thumb_url_array[0];
}
