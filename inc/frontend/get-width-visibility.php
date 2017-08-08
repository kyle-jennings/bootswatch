<?php


// The main content visibility
function bootswatch_get_main_visibility($template, $sidebar_pos = 'none') {
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
function bootswatch_get_main_width($sidebar_position) {
    $sidebar_width = get_theme_mod('sidebar_size_setting', 'BOOTSWATCH_ONE_FOURTH');

    $sidebar_width = $sidebar_width ? constant($sidebar_width) : BOOTSWATCH_ONE_THIRD;
    $width = ($sidebar_width == BOOTSWATCH_ONE_THIRD) ? BOOTSWATCH_TWO_THIRDS : BOOTSWATCH_THREE_FOURTHS;

    return $width;
}
