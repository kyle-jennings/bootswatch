<?php

namespace bootswatch;
use bootswatch\builder;
use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Exception;

class PrepBootSwatch {



    public function __construct()
    {


    }

    static public function postInstall()
    {
        self::buildBootstrapDefault();
        self::buildCSS();
        self::moveDefaultThumbnail();
        self::moveFontAwesome();
        self::moveToAssets();
    }


    /**
     * set up the "default" bootstrap src files
     * renames the "custom" folder ot "bootstrap" and then copies the bootstrap
     * thumbnail from teh admin-src folder to the new bootstrap folder
     */
    static public function buildBootstrapDefault()
    {
        $root = dirname( dirname( __FILE__) );
        $vendor = $root . '/vendor/thomaspark/bootswatch';

        $old = $vendor . '/custom';
        $new = $vendor . '/bootstrap';

        if(is_readable($old) && !is_readable($new)) {
            rename($old, $new);
        }

        $thumbnail = $root . '/src/backend/img/bootstrap.png';

        if( is_readable($thumbnail) )
            copy($thumbnail, $new . '/thumbnail.png');

    }


    /**
     * Move the font awesome assets
     * @return [type] [description]
     */
    static public function moveFontAwesome()
    {
        $Builder = new \bootswatch\builder\Builder();

        $font_dir = $Builder->template_dir . '/_dev/vendor/fortawesome/font-awesome/fonts';
        $dst = $Builder->template_dir .'/assets/fonts';
        if(is_readable($font_dir)){

            self::copyDir(
                $font_dir,
                $dst
            );

        }

    }

    /**
     * Compiles and minifies the SCSS into product ready files
     * @return [type] [description]
     */
    static public function buildCSS()
    {

        // set up the objects
        $BootSwatchThemes = new \bootswatch\BootSwatchThemes();
        $BootSwatchThemes->setThemesAtts();

        // set the src file paths
        $Builder = new \bootswatch\builder\Builder();
        $Compiler = new Compiler();
        $Compiler->setVariables(array('fa-font-path' => '../../fonts'));


        $paths = array($Builder->bootstrap_dir, $Builder->modules_dir, $Builder->fonts_dir);
        $Compiler->setImportPaths($paths);
        // examine($Builder);


        // examine($Compiler->getParsedFiles());
        $themes = $BootSwatchThemes->getThemes();
        // $themes = array('bootstrap' => reset($themes));

        foreach($themes as $theme=>$BootSwatch){


            $sources = array(
                $Builder->fonts_dir . '/font-awesome.scss',
                $BootSwatch->sass_variables,
                $Builder->bootstrap_dir . '/_bootstrap.scss',
                $BootSwatch->sass_bootswatch,
                $Builder->modules_manifest,
            );



            $file = '';
            foreach($sources as $source){
                if(!is_readable($source)){
                    continue;
                }
                $file .= file_get_contents($source);
            }

            // self::examine($file);

            // compile it
            $Compiler->setFormatter('Leafo\ScssPhp\Formatter\Expanded');
            $css = $Compiler->compile($file);
            file_put_contents($BootSwatch->theme_dir . '/bootswatch.css', $css);

            // now minify it!
            $Compiler->setFormatter('Leafo\ScssPhp\Formatter\Crunched');
            $css = $Compiler->compile($file);
            file_put_contents($BootSwatch->theme_dir . '/bootswatch.min.css', $css);


        }


    }


    /**
     * Move the css, minified css, and thumbnail to the assets folder
     * @return [type] [description]
     */
    static public function moveToAssets()
    {

        self::moveFontAwesome();

        $BootSwatchThemes = new \bootswatch\BootSwatchThemes();
        $BootSwatchThemes->setThemesAtts();

        $Builder = new \bootswatch\builder\Builder();
        // examine($Compiler->getParsedFiles());
        $themes = $BootSwatchThemes->getThemes();
        // $themes = array('bootstrap' => reset($themes));

        foreach($themes as $theme=>$BootSwatch){

            $files = array(
                'css' => 'bootswatch.css',
                'min' => 'bootswatch.min.css',
                'thumb' => 'thumbnail.png'
            );

            $src = $BootSwatch->theme_dir . DIRECTORY_SEPARATOR;
            $dst = $Builder->assets_dir . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . $BootSwatch->name . DIRECTORY_SEPARATOR;

            if(!is_readable($dst))
                mkdir($dst, 755, true);
            // copy the theme over to the assets dir
            foreach($files as $k => $v) {

                if( !is_readable($src . $v) )
                    continue;


                if( !copy( $src . $v, $dst . $v) )
                    continue;
            }

            // use this when building from the DB
            // $Compiler->setVariables(array('varname' => 'value'))
            // $Compiler->compile()
        }
    }


    /**
     * move all teh files
     * @return [type] [description]
     */
    static public function moveFiles()
    {
        self::moveFontAwesome();
        self::moveToAssets();
        self::moveDefaultThumbnail();

    }


    /**
     * Rebuld the CSS, move the assets,
     * @return [type] [description]
     */
    static public function rebuildCss()
    {
        self::buildCSS();
        self::moveFontAwesome();
        self::moveFiles();
    }


    /**
     * move the default thumbnail - may be repetitive 
     * @return [type] [description]
     */
    static public function moveDefaultThumbnail()
    {
        $Builder = new \bootswatch\builder\Builder();
        $file = 'thumbnail.png';
        $src = dirname(__FILE__) . '/' .$file;

        $dst = $Builder->assets_dir .'/css/bootstrap/'.$file;
        copy($src, $dst);
    }


    /**
     * Recursivly copy files (a directory) to a new directory
     * @param  [type] $src [description]
     * @param  [type] $dst [description]
     * @return [type]      [description]
     */
    static private function copyDir( $src, $dst ) {
        if( !defined('DS') ) define( 'DS', DIRECTORY_SEPARATOR );

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


    static public function examine($val = array(), $mode = null)
    {
        if( empty($val) && $mode != 'vardump' )
            return;
        echo "<pre>";
        print_r($val);
        die;
    }

}
