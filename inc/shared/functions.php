<?php

// determines whether or not the site is a dot gov or dot mill
function bootswatches_is_dot_gov() {
    $domain = isset($_SERVER['SERVER_NAME']) ? esc_url_raw(wp_unslash($_SERVER['SERVER_NAME'])) : null;

    if(!$domain)
        return false;

    $parts = explode('.', $domain);
    $len = count($parts);
    $tld = $parts[$len-1];
    $is_dot_gov = false;

    $domains = array('gov', 'mil');

    if( in_array($tld, $domains)
        || (defined('BOOTSWATCHES_FORCE_BANNER') && BOOTSWATCHES_FORCE_BANNER == true)
    ){
        $is_dot_gov = true;
    }

    return $is_dot_gov;
}


// cleans strings from machine safe to human readable
function bootswatches_clean_string($string){
    $find = array('-','_');
    $replace = ' ';
    $string = str_replace($find, $replace, $string);
    $string = ucwords($string);
    return $string;
}



/**
* Set the content width in pixels, based on the theme's design and stylesheet.
*
* Priority 0 to make it available to lower priority callbacks.
*
* @global int $content_width
*/
function bootswatches_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'bootswatches_content_width', 640 );
}
add_action( 'after_setup_theme', 'bootswatches_content_width', 0 );



function bootswatches_get_scheme_css()
{
    $themes = new BootswatchesThemes();
    $themes->setThemesAtts();
    $themes->removeDevStuff();
    $themes = $themes->getThemes();

    return $themes;
}