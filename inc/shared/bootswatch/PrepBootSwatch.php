<?php

namespace bootswatch;
use bootswatch\builder;
use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Exception;

class PrepBootSwatch {


    public function __construct()
    {
        // $BootSwatch = new \bootswatch\builder\BootSwatch();
        // $Builder = new \bootswatch\builder\Builder();
        // $Compiler = new Compiler();
        // $Compiler->setFormatter('Leafo\ScssPhp\Formatter\Crunched');
        // $Compiler->setImportPaths($Builder->bootstrap_dir);
        //
        // $themes = $BootSwatch->themes;

    }

    static public function postInstall()
    {
        self::buildBootstrapDefault();
        self::moveFontAwesome();
        self::buildCSS();
    }

    static public function buildBootstrapDefault()
    {
        $root = dirname(dirname( dirname( dirname( __FILE__))));
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

        $font_dir = $Builder->template_dir . '/_dev/bower_components/font-awesome/fonts';
        $dst = $Builder->vendor_dir .'/thomaspark/bootswatch/fonts';
        if(is_readable($font_dir)){
            // examine($Builder);

            self::recurse_copy(
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
        // examine($Builder);
        $Compiler = new Compiler();

        $paths = array($Builder->bootstrap_dir, $Builder->modules_dir, $Builder->fonts_dir);
        $Compiler->setImportPaths($paths);
        // examine($Builder);

        // examine($Compiler->getParsedFiles());
        $themes = $BootSwatchThemes->getThemes();
        // $themes = array('bootstrap' => reset($themes));

        foreach($themes as $theme=>$BootSwatch){


            $sources = array(
                $BootSwatch->sass_variables,
                $Builder->bootstrap_dir . '/_bootstrap.scss',
                $BootSwatch->sass_bootswatch,
                $Builder->modules_manifest,
                $Builder->fonts_dir . '/font-awesome.scss',
            );

            // examine($BootSwatch);

            $file = '';
            foreach($sources as $source){
                if(!is_readable($source)){
                    continue;
                }
                $file .= file_get_contents($source);
            }


            // compile it
            $Compiler->setFormatter('Leafo\ScssPhp\Formatter\Expanded');
            $css = $Compiler->compile($file);
            file_put_contents($BootSwatch->theme_dir . '/bootswatch.css', $css);

            // now minify it!
            $Compiler->setFormatter('Leafo\ScssPhp\Formatter\Crunched');
            $css = $Compiler->compile($file);
            file_put_contents($BootSwatch->theme_dir . '/bootswatch.min.css', $css);


            // copy the theme over to the assets dir
            // self::recurse_copy(
            //     $BootSwatch->theme_dir,
            //     $Builder->assets_dir .'/'.$BootSwatch->name
            // );


            // use this when building from the DB
            // $Compiler->setVariables(array('varname' => 'value'))
            // $Compiler->compile()
        }


    }


    static private function recurse_copy( $src, $dst ) {
        if( !defined('DS') ) define( 'DS', DIRECTORY_SEPARATOR );


        $dir = opendir( $src );
        mkdir( dirname( $dst ) );

        while( false !== ( $file = readdir( $dir ) ) ) {
            if( $file != '.' && $file != '..' ) {
                if( is_dir( $src . DS . $file ) ) {
                    self::recurse_copy( $src . DS . $file, $dst . DS . $file );
                } else {
                    // examine($src . DS . $file);
                    if(is_readable($src . DS . $file))
                        copy( $src . DS . $file, $dst . DS . $file );
                }
            }
        }
        closedir( $dir );
    }

}
