<?php

namespace bootswatch;

trait paths {
    
    static public $template_dir;

    static public $src_dir;
    static public $vendor_dir;
    static public $dst_dir;
    
    static public $fontawesome_dir;
    static public $fontawesome_scss_dir;
    static public $bootstrap_dir;
    static public $bootstrap_imports;
    static public $custom_dir;
    static public $bootswatch_dir;

    static public $custom_manifest;

    static public $bootstrap = [];

    static public function initPaths()
    {
        $tmp                        = function_exists('get_template_directory');
        self::$template_dir         = $tmp ? get_template_directory() : self::get_template_directory();
        self::$dst_dir              = self::$template_dir . '/assets/frontend';
        self::$src_dir              = self::$template_dir . '/_dev';
        self::$vendor_dir           = self::$template_dir . '/_dev/vendor';
        self::$fontawesome_dir      = self::$vendor_dir . '/fortawesome/font-awesome';
        self::$fontawesome_scss_dir = self::$vendor_dir . '/fortawesome/font-awesome/scss';
        self::$bootstrap_dir        = self::$vendor_dir . '/twbs/bootstrap-sass/assets/stylesheets';
        self::$bootstrap_imports    = self::$vendor_dir . '/twbs/bootstrap-sass/assets/stylesheets/bootstrap';
        self::$bootswatch_dir       = self::$vendor_dir . '/thomaspark/bootswatch';
        self::$custom_dir           = self::$src_dir . '/src/frontend/scss';
        
        self::$custom_manifest      = self::$custom_dir . '/manifest.scss';

        self::$bootstrap            = [
            'dir'       => self::$bootstrap_dir,
            'imports'   => self::$bootstrap_imports,
            'mainifest' => self::$bootstrap_dir . '/_bootstrap.scss',
        ];
    }


    /**
     * If this is run by composer - we do not know where the template directory is
     *
     * However, since this file is used in DEV only, we know exactly where it is
     * @return [type] [description]
     */
    static private function get_template_directory()
    {
        $theme_root = dirname(dirname(dirname(__FILE__)));
        return $theme_root;
    }


    static public function examine($val = array(), $mode = null)
    {
        if (empty($val) && $mode != 'vardump'){
            return;
        }
        echo "<pre>";
        print_r($val);
        echo "</pre>\n";
        die;
    }
}
