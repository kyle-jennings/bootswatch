<?php

include dirname(__file__). '/vendor/autoload.php';

require_once dirname(__file__) . '/vendor/kyle-jennings/post-formats-plus/post-formats.php';


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
define('BOOTSWATCH_FULL_WIDTH' , 'col-sm-12');
// define('BOOTSWATCH_FULL_WIDTH_MEDIUM_UP' , 'full-medium-up');
// define('BOOTSWATCH_FULL_WIDTH_LARGE_UP' , 'full-large-up');

// wide sidebar
define('BOOTSWATCH_TWO_THIRDS' , 'col-sm-8');
define('BOOTSWATCH_ONE_THIRD' , 'col-sm-4');

// narrow sidebar
define('BOOTSWATCH_ONE_FOURTH' , 'col-sm-3');
define('BOOTSWATCH_THREE_FOURTHS' , 'col-sm-9');
define('BOOTSWATCH_ONE_HALF' , 'col-sm-6');

require_once get_template_directory() . '/inc/_inc.php';
