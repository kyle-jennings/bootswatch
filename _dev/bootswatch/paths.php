<?php

namespace bootswatches;

trait paths {
    
    static public $template_dir;

    static public $src_dir;
    static public $assets_dir;
    
    static public $fontawesome_dir;
    static public $twbs_bootstrap_dir;
    static public $custom_dir;
    static public $bootswatches_dir;

    static public $custom_manifest;


    static public function initPaths()
    {

        self::$template_dir = $tmp = function_exists('get_template_directory')
            ? get_template_directory() : self::get_template_directory(); 
            
        // Source
        self::$src_dir = self::$template_dir . '/_dev';
        // destination
        self::$assets_dir = self::$template_dir . '/assets/frontend';


        // directories - used for compiling (the paths are needed)
        self::$fontawesome_dir = self::$src_dir . '/vendor/fortawesome/font-awesome';
        self::$twbs_bootstrap_dir = self::$src_dir . '/vendor/twbs/bootstrap-sass/assets/stylesheets';
        self::$custom_dir = self::$src_dir . '/src/frontend/scss';
        self::$bootswatches_dir = self::$src_dir . '/vendor/thomaspark/bootswatch';

        // our custom SCSS modules
        self::$custom_manifest = self::$custom_dir . '/manifest.scss';



    }


    /**
     * If this is run by composer - we do not know where the template directory is
     *
     * However, since this file is used in DEV only, we know exactly where it is
     * @return [type] [description]
     */
    static private function get_template_directory()
    {
        
        $theme_root = dirname(dirname( dirname( __FILE__) ) );
        return $theme_root;
    }


    static public function examine($val = array(), $mode = null)
    {
        if( empty($val) && $mode != 'vardump' )
            return;
        echo "<pre>";
        print_r($val);
        echo "</pre>\n";
        die;
    }
}