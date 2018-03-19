<?php


// cleans strings from machine safe to human readable
function bootswatches_clean_string($string)
{
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
function bootswatches_content_width()
{
    $GLOBALS['content_width'] = apply_filters('bootswatches_content_width', 640);
}
add_action('after_setup_theme', 'bootswatches_content_width', 0);



function bootswatches_get_scheme_css()
{
    $themes = new BootswatchesThemes();
    $themes->setThemesAtts();
    $themes->removeDevStuff();
    $themes = $themes->getThemes();

    return $themes;
}



function bootswatches_get_post_format_value($post_id = null, $format = null, $default = null)
{
    
    if (! $post_id || ! $format) {
        return null;
    }

    $value = get_post_meta($post_id, '_post_format_value', true);
    $value = isset($value[ $format ]) ? $value[ $format ] : null;

    return $value;
}


function bootswatches_use_post_format_content($post = null, $format = 'standard', $exclude = array())
{
    
    $include = json_decode(POST_FORMATS);
    if (!in_array($format, $include, true)) {
        return false;
    }

    return bootswatches_get_post_format_value($post->ID, $format, null);
}