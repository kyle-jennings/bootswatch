<?php


// The main content visibility
function bootswatches_get_main_visibility($template, $sidebar_pos = 'none', $sidebar_size = 'BOOTSWATCHES_ONE_FOURTH') {
    $sidebar_vis = get_theme_mod($template . '_sidebar_visibility_setting', 'always-visible');

    $visibility = null;
    if($sidebar_vis == 'hidden-md hidden-lg') {
        $visibility = 'main-content-full-medium-up';
    }elseif($sidebar_vis == 'hidden-lg') {
        $visibility = 'main-content-full-large-up';
    }elseif($sidebar_vis == 'visible-lg') {
        $visibility = 'main-content-full-medium-only';
    }

    return $visibility;
}


// the main content width
function bootswatches_get_main_width($sidebar_position = 'none', $sidebar_size = 'BOOTSWATCHES_ONE_FOURTH') {

    $sidebar_size = $sidebar_size ? constant($sidebar_size) : BOOTSWATCHES_ONE_THIRD;
    $width = ($sidebar_size == BOOTSWATCHES_ONE_THIRD) ? BOOTSWATCHES_TWO_THIRDS : BOOTSWATCHES_THREE_FOURTHS;

    return $width;
}
