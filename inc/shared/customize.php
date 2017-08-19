<?php

use \bootswatch\customizer;

$customizer = new \bootswatch\customizer\Customizer();

add_action( 'customize_register', array($customizer, 'init') );
add_action( 'customize_controls_enqueue_scripts',  array($customizer,'enqueueScripts') );
// add_action( 'customize_preview_init', array($customizer,'enqueuePreviewScripts') );
