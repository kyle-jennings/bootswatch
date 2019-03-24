<?php

namespace bootswatch;

use bootswatch\Themes;
use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Exception;

class Build
{

    use \bootswatch\paths;

    public static $Compiler;
    public static $Instance;


    /**
     * Instantiate the class, and set the paths from the paths trait
     */
    public function __construct()
    {
        // set up the directory paths
        self::initPaths();
        self::$Compiler = new Compiler();
        self::$Compiler->setVariables(
            array(
                'fa-font-path' => '../../fonts'
            )
        );
        self::makeDir(self::$dst_dir);
    }


    /**
     * If the instance of this class has not been instantiated externally,
     * then the constructor is never called, and thus the traits do not work.
     * @return [type] [description]
     */
    public static function getInstance()
    {
        if (self::$Instance == null) {
            self::$Instance = new Build();
        }

        return self::$Instance;
    }

    /**
     * Builds a bare bones basic bootstrap
     */
    public static function buildTest()
    {

        self::getInstance();
        self::$Compiler->setImportPaths(
            array(
                self::$bootstrap_dir,
            )
        );

        $result = false;
        $sources = array(
            self::$bootstrap_dir . '/_bootstrap.scss',
        );
        $sources = self::concatSources($sources);
        $result  = self::compileCSS($sources);

        if ($result) {
            $file = self::buildFilePath('naked');
            self::saveCSSFile($result, $file);
            self::moveThumbnail(self::$src_dir . '/src/backend/img/', 'bootstrap');
            self::moveFontAwesomeToAssets();
        }
    }


    /**
     * set up the "default" bootstrap src files
     * renames the "custom" folder ot "bootstrap" and then copies the bootstrap
     * thumbnail from teh admin-src folder to the new bootstrap folder
     */
    public static function buildDefault()
    {

        error_log('Building Default Bootstrap');
        error_log("--------------------------\n");
        $name = 'bootstrap';
        self::getInstance();
        self::$Compiler->setImportPaths(
            array(
                self::$fontawesome_scss_dir,
                self::$bootstrap_dir,
                self::$custom_dir,
            )
        );

        $result = false;
        // collect the sources
        $sources = array(
            self::$fontawesome_scss_dir . '/font-awesome.scss',
            self::$bootstrap_dir . '/_bootstrap.scss',
            self::$custom_dir . '/_variables.scss',
            self::$custom_dir . '/manifest.scss',
            self::$custom_dir . '/browser-variables.scss',
        );

        $sources = self::concatSources($sources);
        $result  = self::compileCSS($sources);

        if ($result) {
            $file = self::buildFilePath($name);
            self::saveCSSFile($result, $file);
            self::moveThumbnail(self::$src_dir . '/src/backend/img/', 'bootstrap');
            self::moveFontAwesomeToAssets();
        } else {
            return false;
        }


        $result  = self::minifyCSS($sources);

        if ($result) {
            $file = self::buildFilePath($name, '.min');
            self::saveCSSFile($result, $file);
            self::moveThumbnail(self::$src_dir . '/src/backend/img/', 'bootstrap');
        }

        return $result;
    }


    /**
     * Build the bootswatch themes
     */
    public static function buildAll()
    {

        self::getInstance();
        self::$Compiler->setImportPaths(
            array(
                self::$fontawesome_scss_dir,
                self::$bootstrap_dir,
                self::$custom_dir,
            )
        );


        $result = false;
        $BootSwatchThemes = new Themes();
        $BootSwatchThemes->setThemesAtts();
        $themes = $BootSwatchThemes->getThemes();
        unset($themes['bootstrap']);
        
        // loop through each Bootswatch theme and build the CSS.
        foreach ($themes as $name => $theme) {

            error_log('Building '. $name);
            error_log("-------------\n");

            // collect the sources
            $sources = array(
                self::$fontawesome_scss_dir . '/font-awesome.scss',
                $theme->sass_variables,
                self::$bootstrap_dir . '/_bootstrap.scss',
                $theme->sass_bootswatch,
                self::$custom_dir . '/_variables.scss',
                self::$custom_manifest,
                self::$custom_dir . '/browser-variables.scss'
            );

            $sources = self::concatSources($sources);
            $result  = self::compileCSS($sources);

            if ($result) {
                $file = self::buildFilePath($name);
                self::saveCSSFile($result, $file);
                self::moveThumbnail(self::$src_dir . '/src/backend/img/', 'bootstrap');
            }

            $result  = self::minifyCSS($sources);

            if ($result) {
                $file = self::buildFilePath($name, '.min');
                self::saveCSSFile($result, $file);
                self::moveThumbnail(self::$src_dir . '/src/backend/img/', 'bootstrap');
            }
        }


        if($result) {
            self::moveFontAwesomeToAssets();
        }
    }


    /**
     * Move the font awesome assets
     */
    public static function moveFontAwesomeToAssets()
    {
        error_log('Moving Font Awesome');
        error_log("-------------------\n");

        $font_dir = self::$fontawesome_dir . '/fonts';
        $dst = self::$dst_dir .'/fonts';
        if (is_readable($font_dir)) {
            error_log('cp ' . $font_dir . ' to ' . $dst);
            self::copyDir(
                $font_dir,
                $dst
            );
        }
    }


    /**
     * Concatenate the source files for compiling the CSS
     * @param  array  $sources list of the files to concatenate
     * @return string        basically the manifest to build from
     */
    public static function concatSources(array $sources = array())
    {
        $file = '';
        foreach ($sources as $source) {
            if (!is_readable($source)) {
                continue;
            }

            $file .= file_get_contents($source);
        }
  
        return $file;
    }


    /**
     * Runs the compiler in its various modes (minified and normal)
     * @param  string|null $sources the manifest to compile with
     * @param  string      $method  expanded or minified file?
     * @return void
     */
    public static function compileCSS(string $sources = null)
    {
        $result = false;
        try {
            error_log('Compiling CSS');
            error_log("----------------\n");
            $result = self::$Compiler->compile($sources);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return false;
        }

        return $result;
    }


    /**
     * Runs the compiler in its various modes (minified and normal)
     * @param  string|null $sources the manifest to compile with
     * @param  string      $method  expanded or minified file?
     * @return void
     */
    public static function minifyCSS(string $sources = null)
    {
        error_log('Minifying CSS' . "\n");
        error_log("----------------\n");
        $result = false;
        $method = 'Leafo\ScssPhp\Formatter\Crunched';
        self::$Compiler->setFormatter($method);

        try {
            $result = self::$Compiler->compile($sources);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return false;
        }

        return $result;
    }

    /**
     * save the compiled CSS to a file
     * @param  string|null $css     compiled css
     * @param  string|null $name    name of the scheme
     * @param  string|null $dst_path file dest path to compile too
     * @return void
     */
    public static function saveCSSFile($css, $file)
    {

        $path = pathinfo($file);
        self::makeDir($path['dirname']);
        try {
            error_log('saving contents');
            if (!file_put_contents($file, $css)) {
                error_log('Unable to save CSS to file');
                $result = true;
            } else {
                $result = false;
            }
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result = false;
        }

        return $result;
    }


    /**
     * Move the css, minified css, and thumbnail to the assets folder
     * @return [type] [description]
     */
    public static function moveThumbnail(string $src = null, string $name = null)
    {
        error_log('Moving thumbnail');
        error_log("----------------\n");

        $src = $src . DIRECTORY_SEPARATOR . 'thumbnail.png';
        $dst = self::$dst_dir . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'thumbnail.png';

        if (!file_exists($src) || !copy($src, $dst)) {
            return;
        }
    }


    /**
     * If a directory doesnt exist then create it.
     *
     * @param  string $path path to directory
     *
     * @return void
     */
    public static function makeDir(string $path = '')
    {
      // creates the scheme folder inside of assets/frontend/css/
        if (!file_exists($path)) {
            error_log('creating ' . $path . "\n");
        	error_log("----------------\n");
            mkdir($path, 0755, true);
        }
    }


    /**
     * Build the file path to the CSS file which is to be created
     *
     * @param  string $name   name of hte file
     * @param  string $suffix add to the filename, ie .min
     *
     * @return string         path to the file
     */
    public static function buildFilePath($name, $suffix = '')
    {
        return self::$dst_dir . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . $name . $suffix .'.css';
    }


    /**
     * Build the file path's direcotry to the CSS file which is to be created
     *
     * @param  string $name   name of the directory
     *
     * @return string         path to the dir
     */
    public static function buildFileDirPath($name)
    {
        return self::$dst_dir . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . $name;
    }


    /**
     * Recursivly copy files (a directory) to a new directory
     * @param  [type] $src [description]
     * @param  [type] $dst [description]
     * @return [type]      [description]
     */
    private static function copyDir($src, $dst)
    {
        if (!defined('DS')) {
            define('DS', DIRECTORY_SEPARATOR);
        }

        $dir = opendir($src);

        self::makeDir($dst);

        while (false !== ($file = readdir($dir))) {
            if ($file != '.' && $file != '..') {
                if (is_dir($src . DS . $file)) {
                    self::copyDir($src . DS . $file, $dst . DS . $file);
                } else {
                    if (is_readable($src . DS . $file)) {
                        error_log('copying: '. $src . DS . $file . ' ->'  . $dst . DS . $file);
                        copy($src . DS . $file, $dst . DS . $file);
                    }
                }
            }
        }
        closedir($dir);
    }
}
