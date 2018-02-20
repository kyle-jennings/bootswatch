<?php

/**
 * All the setting sanitizations on a single page
 *
 * IIRC I put these all together because many of them are being reused by multiple settings
 */


/**
 * 404 page
 */
function bootswatch_404_page_select_sanitize($val) {
    $pages = get_posts(array('post_type' => 'page', 'posts_per_page' => -1, 'fields' => 'ids'));

    if( !in_array($val, $pages) && 'publish' == get_post_status( $val ) )
        return null;

    return $val;
}



function bootswatch_404_hero_content_sanitize($val) {
    $valids = array(
        'title',
        'page'
    );

    if( !in_array($val, $valids) )
        return null;

    return $val;
}



function bootswatch_404_content_sanitize($val) {
    $valids = array(
        'default',
        'page'
    );

    if( !in_array($val, $valids) )
        return null;

    return $val;
}


/**
 * Footer
 */
function bootswatch_footer_sortable_sanitize($val) {

    $valids = array(
        'return-to-top',
        'footer-menu',
        'widget-area-1',
        'widget-area-2',
    );

    $valid = true;
    $tmp_val = json_decode($val);
    foreach($tmp_val as $v){
        if( !in_array($v->name, $valids) ){
            // error_log($v->name)
            $valid = false;
        }
    }

    if(!$valid)
        return null;

    return $val;
}



/**
* frontpage
*/
function bootswatch_frontpage_hero_callout_sanitize($val) {
    $pages = get_posts(array('post_type' => 'page', 'posts_per_page' => -1, 'fields' => 'ids'));

    if( !in_array($val, $pages) && 'publish' == get_post_status( $val ) )
        return null;

    return $val;
}


function bootswatch_frontpage_sortable_sanitize($val) {
    $valids = array(
        'widget-area-1',
        'widget-area-2',
        'widget-area-3',
        'page-content',
    );

    $valid = true;
    $tmp_val = json_decode($val);
    foreach($tmp_val as $v){
        if( !in_array($v->name, $valids) )
            $valid = false;
    }

    if(!$valid)
        return null;

    return $val;
}


/**
 * global header settings
 */
function bootswatch_header_sortable_sanitize($val) {
    $valids = array(
        'navbar',
        'hero',
        'banner',
    );

    $valid = true;
    $tmp_val = json_decode($val);
    foreach($tmp_val as $v){
        if( !in_array($v->name, $valids) )
            $valid = false;
    }

    if(!$valid)
        return null;

    return $val;
}


/**
 * navbar
 */
function bootswatch_navbar_brand_sanitize($val) {
    $valids = array(
        'text',
        'logo'
    );

    if( !in_array($val, $valids) )
        return null;

    return $val;
}



function bootswatch_navbar_sticky_sanitize($val) {
    $valids = array(
        'no',
        'yes'
    );

    if( !in_array($val, $valids) )
        return null;

    return $val;
}


function bootswatch_navbar_color_setting_sanitize($val) {
    $valids = array(
        'light',
        'dark'
    );

    if( !in_array($val, $valids) )
        return null;

    return $val;
}


function bootswatch_navbar_search_setting_sanitize($val) {
    $valids = array(
        'none',
        'navbar'
    );

    if( !in_array($val, $valids) )
        return null;

    return $val;
}


function bootswatch_banner_visibility_sanitize($val) {
    $valids = array(
        'hide',
        'display'
    );

    if( !in_array($val, $valids) )
        return null;

    return $val;
}


/**
 * frontpage hero
 */
function bootswatch_frontpage_hero_content_sanitize($val) {

    $valids = array(
        'callout',
        'page',
        'title',
    );


    if( !in_array($val, $valids) )
        return null;

    return $val;
}


/**
 * identity
 */
function bootswatch_sidebar_width_sanitize($val) {
    $valids = array(
        'BOOTSWATCH_ONE_THIRD',
        'BOOTSWATCH_ONE_FOURTH',
    );

    if( !in_array($val, $valids) )
        $val = 'BOOTSWATCH_ONE_THIRD';

    return $val;
}


/**
 * hero
 */
function bootswatch_hero_image_sanitization( $val ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $val, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( ($file['ext'] || $val == null) ? $val : null );
}


/**
 * template settings
 */
function bootswatch_template_settings_active_sanitize($val) {
    $valids = array(
        'no',
        'yes'
    );

    if( !in_array($val, $valids) )
        return null;

    return $val;
}

/**
 * hero size
 */
function bootswatch_hero_size_sanitize($val) {
    $valids = array(
        'slim',
        'medium',
        'big',
        'xtra-big',
        'full',
    );

    if( !in_array($val, $valids) )
        return null;

    return $val;
}


function bootswatch_hero_position_sanitize($val) {
    $valids = array(
        'top',
        'center',
        'bottom'
    );

    if( !in_array($val, $valids) )
        return null;

    return $val;
}


/**
 * sidebar
 */
function bootswatch_sidebar_position_sanitize($val) {
    $valids = array(
        'none',
        'left',
        'right'
    );

    if( !in_array($val, $valids) )
        return null;

    return $val;
}

function bootswatch_sidebar_visibility_sanitize($val) {
    $valids = array(
        'always-visible',
        'hidden-medium-up',
        'hidden-large-up',
        'visible-medium-up',
        'visible-large-up',
    );

    if( !in_array($val, $valids) )
        return null;

    return $val;
}


function bootswatch_hide_layout_sanitize($val) {
    $valids = array(
        'banner',
        'navbar',
        'page-content',
        'footer',
    );

    $valid = true;
    $tmp_val = json_decode($val);
    foreach($tmp_val as $v){
        if( !in_array($v, $valids) )
            $valid = false;
    }

    if(!$valid)
        return null;

    return $val;
}




function bootswatch_sanitize_external_header_video( $value ) {
    return esc_url_raw( trim( $value ) );
}

function bootswatch_validate_external_header_video( $validity, $value ) {
    $video = esc_url_raw( $value );
    if ( $video ) {
        if ( ! preg_match( '#^https?://(?:www\.)?(?:youtube\.com/watch|youtu\.be/)#', $video ) ) {
            $validity->add( 'invalid_url', __( 'Please enter a valid YouTube URL.', 'bootswatch' ) );
        }
    }
    return $validity;
}


function bootswatch_validate_header_video( $validity, $value ) {
    $video = get_attached_file( absint( $value ) );
    if ( $video ) {
        $size = filesize( $video );
        if ( 8 < $size / pow( 1024, 2 ) ) { // Check whether the size is larger than 8MB.
            $validity->add( 'size_too_large',
                __( 'This video file is too large to use as a header video. Try a shorter video or optimize the compression settings and re-upload a file that is less than 8MB. Or, upload your video to YouTube and link it with the option below.', 'bootswatch' )
            );
        }
        if ( '.mp4' !== substr( $video, -4 ) && '.mov' !== substr( $video, -4 ) ) { // Check for .mp4 or .mov format, which (assuming h.264 encoding) are the only cross-browser-supported formats.
            $validity->add( 'invalid_file_type', sprintf(
                /* translators: 1: .mp4, 2: .mov */
                __( 'Only %1$s or %2$s files may be used for header video. Please convert your video file and try again, or, upload your video to YouTube and link it with the option below.', 'bootswatch' ),
                '<code>.mp4</code>',
                '<code>.mov</code>'
            ) );
        }
    }
    return $validity;
}



function bootswatch_sanitize_color( $color ) {
    if ( 'blank' === $color )
        return 'blank';

    $color = sanitize_hex_color_no_hash( $color );
    if ( empty( $color ) )
        $color = '#02bfe7'; //#112e51

    return $color;
}



function bootswatch_widgetized_sortable_sanitize($val) {
    $valids = array(
        'widget-area-1',
        'widget-area-2',
        'widget-area-3',
        'page-content',
    );

    $valid = true;
    $tmp_val = json_decode($val);
    foreach($tmp_val as $v){
        if( !in_array($v->name, $valids) )
            $valid = false;
    }

    if(!$valid)
        return null;

    return $val;
}


// maps the themes array and returns the css uri
function bootswatch_color_scheme_validate_map($theme){

    return $theme->css_uri;
}

 /**
 * Validate the color scheme setting
 * @param  [object] $valitity similar to wp_error
 * @param  string $val      the pre-saved value from the control
 * @return string           the value (or the error object)
 */
function bootswatch_color_scheme_validate($valitity, $val) {
    
    $themes = bootswatch_get_scheme_css();
    $themes = apply_filters('bootswatch_filter_themes', $themes);
    
    $valids = array_map( 'bootswatch_color_scheme_validate_map', $themes );
    
    if( !in_array($val, $valids) )
        return $validity->add( 'required', __( 'CSS not found', 'bootswatch' ) );

    return $val;
}


function bootswatch_color_scheme_sanitize($val) {

    if( !esc_url_raw($val) )
        return null;

    return $val;
}