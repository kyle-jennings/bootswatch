<?php
/**
 * The Builder class does 1 thing - it collects the paths for various src files to build
 *
 * These src files are passed on the leafo\compiler class which will actually build everything
 *
 * This class used to do the actual building, and removal of the preview file but no more.  That is
 * because the custom CSS building is being moved to its own plugin.
 */
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

    /**
     * Just set the paths
     * @param array $args [description]
     */
    public function __construct($args = array() ) {


        $this->template_dir = $template_dir = (function_exists('get_template_directory') )
            ? get_template_directory() : $this->get_template_directory();


        // destination
        $this->assets_dir = $this->template_dir . '/assets/frontend';

        // vendor stuff
        $this->vendor_dir = $template_dir . '/_dev/vendor';
        $this->fonts_dir = $template_dir . '/_dev/vendor/fortawesome/font-awesome/scss';
        $this->bootstrap_dir = $this->vendor_dir . '/twbs/bootstrap-sass/assets/stylesheets';

        // our custom SCSS modules
        $this->modules_dir = $template_dir . '/_dev/src/frontend/scss';
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


    /**
     * If this is run by composer - we do not know where the template directory is
     *
     * However, since this file is used in DEV only, we know exactly where it is
     * @return [type] [description]
     */
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
