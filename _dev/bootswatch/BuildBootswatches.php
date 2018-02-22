<?php

namespace bootswatch;

use bootswatch\BootSwatchThemes;


use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Exception;

class BuildBootswatches {

    use \bootswatch\paths;

    static public $Compiler;
    static public $instance;


    /**
     * Instantiate the class, and set the paths from the paths trait
     */
    public function __construct()
    {
        // set up the directory paths
        self::initPaths();

        // set up the scss paths
        $scss_paths = array(
            self::$twbs_bootstrap_dir, 
            self::$fontawesome_dir . '/scss',
            self::$modules_dir, 
        );

        // init the compiler
        self::$Compiler = new Compiler();
        self::$Compiler->setVariables( 
            array(
                'fa-font-path' => '../../fonts'
            ) 
        );
        self::$Compiler->setImportPaths($scss_paths);

        // if the assets/frontend/css directory does not exist, make it
        if( !file_exists( self::$assets_dir . '/css' ) ){
            error_log('creating ' . self::$assets_dir . '/css' . "\n");
            mkdir( self::$assets_dir . '/css', 755, true );
        }

    }


    /**
     * If the instance of this class has not been instantiated externally, 
     * then the constructor is never called, and thus the traits do not work.
     * @return [type] [description]
     */
    public static function getInstance()
    {
        if( self::$instance == null)
            self::$instance = new BuildBootswatches();

        return self::$instance;
    }


    /**
     * Rebuld the CSS, move the assets,
     * @return [type] [description]
     */
    static public function buildCss()
    {
        self::getInstance();


        self::moveFontAwesomeToAssets();
        self::buildBootstrapDefault();
        self::buildBootswatches();
    }


    /**
     * set up the "default" bootstrap src files
     * renames the "custom" folder ot "bootstrap" and then copies the bootstrap
     * thumbnail from teh admin-src folder to the new bootstrap folder
     */
    static public function buildBootstrapDefault()
    {

        error_log('Building Default Bootstrap');
        error_log("--------------------------\n");

        // collect the sources
        $files = array(
            self::$fontawesome_dir . '/scss/font-awesome.scss',
            self::$twbs_bootstrap_dir . '/_bootstrap.scss',
            self::$modules_manifest,
        );


        $sources = self::concatSources($files);

        self::compileCSS('bootstrap', $sources);


        // now move the thumbnail
        self::moveThumbnail(self::$src_dir . '/src/backend/img/' , 'bootstrap');

    }



    /**
     * Move the font awesome assets
     * @return [type] [description]
     */
    static public function moveFontAwesomeToAssets()
    {
        error_log('Moving Font Awesome');
        error_log("-------------------\n");

        $font_dir = self::$fontawesome_dir . '/fonts';
        $dst = self::$assets_dir .'/fonts';
        if(is_readable($font_dir)){

            self::copyDir(
                $font_dir,
                $dst
            );

        }

    }


    /**
     * Build the bootswatches
     */
    static public function buildBootswatches()
    {


        // set up the objects
        $BootSwatchThemes = new BootSwatchThemes();
        $BootSwatchThemes->setThemesAtts();
        $themes = $BootSwatchThemes->getThemes();
        foreach($themes as $name => $theme){

            if($name == 'bootstrap')
                continue;

            error_log('Building '. $name);
            error_log("-------------\n");

            // collect the sources
            $files = array(
                self::$fontawesome_dir . '/scss/font-awesome.scss',
                $theme->sass_variables,
                self::$twbs_bootstrap_dir . '/_bootstrap.scss',
                $theme->sass_bootswatch,
                self::$modules_manifest,
            );


            $sources = self::concatSources($files);

            if( ! self::compileCSS($name, $sources) )
                continue;
            self::moveThumbnail($theme->theme_dir . DIRECTORY_SEPARATOR , $name);
        }
    }


    /**
     * Concatenate the source files for compiling the CSS
     * @param  array  $files list of the files to concatenate
     * @return string        basically the manifest to build from
     */
    static public function concatSources(array $files = array() )
    {
        $sources = '';
        foreach($files as $file){

            if(!is_readable($file))
                continue;

            $sources .= file_get_contents($file);
        }
  
        return $sources;
    }




    /**
     * Compiles and minifies the SCSS into product ready files
     * @return boolean [description]
     */
    static public function compileCSS(string $name = null, string $sources = null)
    {
        if(!$name || !self::$Compiler || !$sources || empty($sources))
            return false;

        $css_dir = self::$assets_dir . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . $name;
        $css = '';

        // creates the scheme folder inside of assets/frontend/css/
        if( !file_exists( $css_dir ) ){
            error_log('creating ' . $css_dir . "\n");
            mkdir( $css_dir, 755, true );
        }



        // compile it
        self::runCompiler($name, $css_dir, $sources, 'Expanded');
        self::runCompiler($name, $css_dir, $sources, 'Crunched');

        return true;
    }


    /**
     * Runs the compiler in its various modes (minified and normal)
     * @param  string|null $name    name of the scheme
     * @param  string|null $css_dir file dest path to compile too
     * @param  string|null $sources the manifest to compile with
     * @param  string      $method  expanded or minified file?
     * @return void               
     */
    static public function runCompiler(string $name = null, string $css_dir = null, string $sources = null, string $method = 'Expanded')
    {

        if(!$name || !$css_dir || !$sources || empty($sources) || !$method)
            return false;
        error_log('--- Compiling CSS' . "\n");

        $suffix = ($method == 'Crunched') ? '.min' : '';
        $method = 'Leafo\ScssPhp\Formatter\\' . $method;
        $filename = $css_dir . DIRECTORY_SEPARATOR . $name . $suffix .'.css';


        try {
            self::$Compiler->setFormatter($method);
            $css = self::$Compiler->compile($sources);

            if( !file_put_contents( $filename, $css ) )
                self::examine('Unable to save CSS to file');

        } catch (\Exception $e) {
            self::examine('something went wrong compiling the ' . $name . ' theme');
        }

    }


    /**
     * Move the css, minified css, and thumbnail to the assets folder
     * @return [type] [description]
     */
    static public function moveThumbnail(string $src = null, string $name = null)
    {
        error_log('Moving thumbnail');
        error_log("----------------\n");

        $src = $src . DIRECTORY_SEPARATOR . 'thumbnail.png';
        $dst = self::$assets_dir . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'thumbnail.png';

        if( !file_exists($src) || !copy( $src, $dst) ){
            return;
        }
    }


    /**
     * Recursivly copy files (a directory) to a new directory
     * @param  [type] $src [description]
     * @param  [type] $dst [description]
     * @return [type]      [description]
     */
    static private function copyDir( $src, $dst ) {
        if( !defined('DS') ) 
            define( 'DS', DIRECTORY_SEPARATOR );

        $dir = opendir( $src );

        // make the destination folder if it doesnt exist
        if(!is_readable($dst)){
            mkdir( $dst, 0777, true );
        }

        while( false !== ( $file = readdir( $dir ) ) ) {
            if( $file != '.' && $file != '..' ) {
                if( is_dir( $src . DS . $file ) ) {
                    self::copyDir( $src . DS . $file, $dst . DS . $file );
                } else {
                    if(is_readable($src . DS . $file))
                        copy( $src . DS . $file, $dst . DS . $file );
                }
            }
        }
        closedir( $dir );
    }


}