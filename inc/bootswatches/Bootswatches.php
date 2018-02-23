<?php

if( class_exists('Bootswatches'))
    return false;

class Bootswatches {

    public $name;
    public $theme;


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


    public $thumbnail_dir;
    public $thumbnail_uri;


    public function __construct($theme = null)
    {

        $this->name = $this->theme = $theme ? strtolower($theme): null;

        $bootswatches_dir = get_template_directory() . '/assets/frontend/css';
        $bootswatches_uri = get_template_directory_uri() . '/assets/frontend/css';

        // i jsut wanted to play around with something other than concatenation, which is probably faster
        $this->theme_dir = implode('/', array($bootswatches_dir, $this->theme));
        $this->theme_uri = implode('/', array($bootswatches_uri, $this->theme));
    }



    // Set the location of the pre-built CSS files as provided by the vendor
    public function setCSS()
    {
        $file = $this->theme_dir . '/' . $this->name . '.min.css';

        if( !is_readable($file))
            return false;

        $this->css_dir = $this->theme_dir . '/' . $this->name . '.min.css';
        $this->css_uri = $this->theme_uri . '/' . $this->name . '.min.css';

    }


    // get the filesystem path or the uri to the css file as specified
    public function getCSS($path = 'dir')
    {
        $path = 'css_'.$path;

        return $this->$path ? $this->$path : null;
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
