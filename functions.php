<?php

if(!function_exists('examine')){

    function examine($val, $mode = null){
        if( empty($val) && $mode != 'vardump' )
            return;
        echo "<pre>";
        print_r($val);
        die;
    }

}



if ( version_compare( $GLOBALS['wp_version'], '4.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

// Define some constants
define('BOOTSWATCHES_FULL_WIDTH' , 'col-sm-12');
// define('BOOTSWATCHES_FULL_WIDTH_MEDIUM_UP' , 'full-medium-up');
// define('BOOTSWATCHES_FULL_WIDTH_LARGE_UP' , 'full-large-up');

// wide sidebar
define('BOOTSWATCHES_TWO_THIRDS' , 'col-sm-8');
define('BOOTSWATCHES_ONE_THIRD' , 'col-sm-4');

// narrow sidebar
define('BOOTSWATCHES_ONE_FOURTH' , 'col-sm-3');
define('BOOTSWATCHES_THREE_FOURTHS' , 'col-sm-9');
define('BOOTSWATCHES_ONE_HALF' , 'col-sm-6');

// misc
define('DEFAULT_TEMPLATE', 'default');

require_once get_template_directory() . '/inc/_inc.php';
