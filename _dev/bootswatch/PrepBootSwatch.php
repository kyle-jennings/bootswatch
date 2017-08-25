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
        self::moveFontAwesome();
        self::buildCSS();
    }

    static public function buildBootstrapDefault()
    {
        $root = dirname( dirname( __FILE__));
        $vendor = $root . '/vendor/thomaspark/bootswatch';

        $old = $vendor . '/custom';
        $new = $vendor . '/bootstrap';

        if(is_readable($old) && !is_readable($new)) {
            rename($old, $new);
        }

        $thumbnail = $root . '/_dev/admin-src/img/bootstrap.png';
        if( is_readable($thumbnail) )
            copy($thumbnail, $new . '/thumbnail.png');

    }

    static public function moveFontAwesome()
    {
        $Builder = new \bootswatch\builder\Builder();

        $font_dir = $Builder->template_dir . '/_dev/vendor/fortawesome/font-awesome/fonts';
        $dst = $Builder->template_dir .'/assets/fonts';
        if(is_readable($font_dir)){

            self::copy(
                $font_dir,
                $dst
            );

        }

    }

    static public function buildCSS()
    {

        $BootSwatchThemes = new \bootswatch\BootSwatchThemes();
        $BootSwatchThemes->setThemesAtts();



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

            $paths = array(
                'src' => $BootSwatch->theme_dir,
                'dst' => $Builder->assets_dir .'/css/'.$BootSwatch->name
            );
            // self::examine($paths);
            // copy the theme over to the assets dir
            self::copy(
                $paths['src'],
                $paths['dst']
            );


            // use this when building from the DB
            // $Compiler->setVariables(array('varname' => 'value'))
            // $Compiler->compile()
        }
    }


    static public function moveFiles()
    {
        self::moveFontAwesome();
        self::moveToAssets();
    }


    static public function rebuildCss()
    {
        self::buildCSS();
        self::moveFontAwesome();
        self::moveToAssets();
        self::moveDefaultThumbnail();
    }


    static public function moveDefaultThumbnail()
    {
        $Builder = new \bootswatch\builder\Builder();
        $file = 'thumbnail.png';
        $src = dirname(__FILE__) . '/' .$file;

        $dst = $Builder->assets_dir .'/css/bootstrap/'.$file;
        copy($src, $dst);
    }


    static private function copy( $src, $dst ) {
        if( !defined('DS') ) define( 'DS', DIRECTORY_SEPARATOR );

        $dir = opendir( $src );

        // make the destination folder if it doesnt exist
        if(!is_readable($dst)){
            mkdir( $dst, 0777, true );
        }

        while( false !== ( $file = readdir( $dir ) ) ) {
            if( $file != '.' && $file != '..' ) {
                if( is_dir( $src . DS . $file ) ) {
                    self::copy( $src . DS . $file, $dst . DS . $file );
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
