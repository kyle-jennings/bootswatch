<?php

if( class_exists('Bootswatch'))
    return false;

class Bootswatch {

    public $name;
    public $theme;
    /**
     * Location of the packagist vendor files
     * @var string
     */
    public $vendor_dir;
    public $vendor_uri;

    /**
     * Location of the BootSwatch folder
     * @var string
     */
    public $bootswatch_dir;
    public $bootswatch_uri;

    /**
     * The theme dir and URI, getting pretty redundant now
     * @var [type]
     */
    public $theme_dir;
    public $theme_uri;

    /**
     * Location of the BootSwatch css min
     * @var string
     */
    public $css_dir;
    public $css_uri;

    /**
     * Location of the sass files, this includes the variables and the bootswatch files
     *
     * unlike the CSS files, or the vendor folders we do not need the URI because
     * we are not using this files for anything other than the build process
     * @param [type] $theme [description]
     */
    public $sass_variables;
    public $sass_bootswatch;

    public $thumbnail = null;


    public function __construct($theme = null)
    {

        $template_dir = (function_exists('get_template_directory') )
            ? get_template_directory() : $this->get_template_directory();

        $template_uri = (function_exists('get_template_directory_uri') )
            ? get_template_directory_uri() : $this->get_template_directory_uri();

        // $this->vendor_dir = $template_dir . '/_dev/vendor';
        // $this->vendor_uri = $template_uri . '/_dev/vendor';
        //
        // $this->bootswatch_dir = $this->vendor_dir . '/thomaspark/bootswatch';
        // $this->bootswatch_uri = $this->vendor_uri . '/thomaspark/bootswatch';

        $this->bootswatch_dir = $template_dir . '/assets/css';
        $this->bootswatch_uri = $template_uri . '/assets/css';

        $this->setTheme($theme);
    }


    // the theme might not be set at initalization
    public function setTheme($theme = null) {
        $this->name = $this->theme = $theme ? strtolower($theme): null;

        // i jsut wanted to play around with something other than concatenation, which is probably faster
        $this->theme_dir = implode('/', array($this->bootswatch_dir, $this->theme));
        $this->theme_uri = implode('/', array($this->bootswatch_uri, $this->theme));

    }


    // check the ensure the minified CSS exists, if it does set the paths
    public function doesCSSExist()
    {

        $file = $this->theme_dir . '/bootstrap.min.css';

        if( !is_readable($file))
            return false;

        $this->setCSS();

        return true;
    }


    // Set the location of the pre-built CSS files as provided by the vendor
    public function setCSS()
    {

        $this->css_dir = $this->theme_dir . '/bootswatch.min.css';
        $this->css_uri = $this->theme_uri . '/bootswatch.min.css';

    }


    // get the filesystem path or the uri to the css file as specified
    public function getCSS($path = 'dir')
    {
        $path = 'css_'.$path;

        return $this->$path ? $this->$path : null;
    }


    // set the file system path of the SCSS files
    public function setSCSS(){
        $files = array('bootswatch', 'variables' );
        foreach($files as $filename) {
            $file = $this->theme_dir . '/_' . $filename .'.scss';
            if(!is_readable($file))
                return false;

            $prop = 'sass_' . $filename;
            $this->$prop = $file;
        }
    }


    public function setThumbnail() {
        $file = $this->theme_dir . '/thumbnail.png';


        if(is_readable($file)){
            $this->thumbnail_dir = $file;
            $this->thumbnail_uri =  $this->theme_uri . '/thumbnail.png';
        }
    }


    private function get_template_directory()
    {
        return dirname(dirname( dirname( dirname( __FILE__))));
    }

    private function get_template_directory_uri()
    {
        return null;
    }
}
