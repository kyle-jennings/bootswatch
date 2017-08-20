<?php
$files = array('Fields', 'Validations', 'Customizer',);
foreach($files as $file){
    $file = dirname(__FILE__) .'/customizer/'.$file.'.php';

    if(!is_readable($file))
        continue;

    require_once( $file );
}

$customizer = new Customizer();

add_action( 'customize_register', array($customizer, 'init') );
add_action( 'customize_controls_enqueue_scripts',  array($customizer,'enqueueScripts') );
// add_action( 'customize_preview_init', array($customizer,'enqueuePreviewScripts') );
