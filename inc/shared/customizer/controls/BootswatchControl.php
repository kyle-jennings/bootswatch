<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return null;

if( !class_exists('BootswatchControl') ) {

    class BootswatchControl extends WP_Customize_Control
    {
        public $togglable = true;
    }
}
