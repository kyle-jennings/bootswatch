<?php

namespace bootswatch\builder;


use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Exception;

// require_once(ABSPATH . "wp-admin" . '/includes/image.php');
// require_once(ABSPATH . "wp-admin" . '/includes/file.php');
// require_once(ABSPATH . "wp-admin" . '/includes/media.php');

class Builder {

    /**
     * are we building the preview CSS or the final, prod CSS?
     * @var boolean
     */
    public $target = false;

    /**
     * Compiler
     * @var [type]
     */
    public $compiler = null;
    public $css = '';


    /**
     * Location of the packagist vendor files
     * @var string
     */
    public $vendor_dir;


    /**
     * Location of the BootSwatch folder
     * @var string
     */
    public $bootstrap_dir;

    /**
     * Location of the font awesome dir
     */
     public $fonts_dir;

    /**
     * Location of our custom modules
     * @param array $args [description]
     */
    public $modules_dir;
    public $modules;

    public function __construct($args = array() ) {

        // extract(shortcode_atts(
        //     array(
        //         'variables' => null,
        //         'type' => 'custom',
        //         'target' => 'preview',
        //         'manifest' => null,
        //         'manifest_append' => null,
        //     ),
        //     $args
        // ));

        $this->template_dir = $template_dir = (function_exists('get_template_directory') )
            ? get_template_directory() : $this->get_template_directory();


        $this->assets_dir = $this->template_dir . '/assets';

        $this->vendor_dir = $template_dir . '/_dev/vendor';

        $this->fonts_dir = $template_dir . '/_dev/vendor/fortawesome/font-awesome/scss';
        $this->bootstrap_dir = $this->vendor_dir . '/twbs/bootstrap-sass/assets/stylesheets';

        $this->modules_dir = $template_dir . '/_dev/src/scss';
        $this->modules_manifest = $this->modules_dir . '/manifest.scss';




    }



    /**
     * Builds the CSS
     * @return [type] [description]
     */
    public function build() {


        $this->compiler->setImportPaths($this->bs_src);

        $file = file_get_contents($this->manifest->file );

        $this->css = $this->compiler->compile($file);


        unset($this->compiler);
        unset($this->manifest);
    }


    /**
     * Deletes the preview file
     * @param  string $target [description]
     * @return [type]         [description]
     */
    public function deletePreviewFile($target = 'preview')
    {
        $target_dir = $target.'_styles';
        $filename = ($target == 'site') ? 'site' : 'preview';
        $file = $this->$target_dir.'/'.$filename.'.css';

        if(is_readable($file))
            unlink($file);
    }


    private function get_template_directory()
    {
        return  dirname(dirname( dirname( dirname( __FILE__))));
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
