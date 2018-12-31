<?php


/**
 * The Amendment functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bootswatches
 */

if (version_compare($GLOBALS['wp_version'], '4.6', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

// Define some constants.
define('BOOTSWATCHES_FULL_WIDTH', 'col-sm-12');
define('BOOTSWATCHES_FULL_WIDTH_MEDIUM_UP', 'col-md-12');
define('BOOTSWATCHES_FULL_WIDTH_LARGE_UP', 'col-ld-12');

// wide sidebar.
define('BOOTSWATCHES_TWO_THIRDS', 'col-md-8');
define('BOOTSWATCHES_ONE_THIRD', 'col-md-4');

// narrow sidebar.
define('BOOTSWATCHES_ONE_FOURTH', 'col-md-3');
define('BOOTSWATCHES_THREE_FOURTHS', 'col-md-9');
define('BOOTSWATCHES_ONE_HALF', 'col-md-6');


// misc.
define('BOOTSWATCHES_DEFAULT_TEMPLATE', 'default');
define('BOOTSWATCHES_FRONTEND_ASSETS_DIR', get_template_directory_uri() . '/assets/frontend/');

if(!defined('BOOTSWATCHES_POST_FORMATS')) {
    define('BOOTSWATCHES_POST_FORMATS', json_encode(
        array('audio', 'image', 'gallery', 'link', 'quote', 'status', 'video')
    ));
}

require_once get_template_directory() . '/inc/_inc.php';
