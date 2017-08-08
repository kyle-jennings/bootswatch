<?php
namespace bootswatch\builder;

class Manifest
{

    public function __construct()
    {
        // set directory
        $src_dir = dirname(__FILE__);
        $src_dir .= '/bootstrap/src';
        $this->src_dir = is_dir($src_dir) ? $src_dir : null;

        // set base bs filename

        $file = '';
        if( is_readable($this->src_dir. '/manifest.scss') )
            $file = $this->src_dir . '/manifest.scss';
        elseif( is_readable($this->src_dir .'/_bootstrap.scss') )
            $file = $this->src_dir . '/_bootstrap.scss';

        $this->file = is_readable($file) ? $file : null;
    }
    // finds the bootstrap scss file
    public function findManifestTemplate()
    {


    }


    public function setManifest()
    {

        $manifest_file = $this->src_dir . 'manifest.php';
        require_once($manifest_file);

    }


    public function saveManifestFile()
    {
        $file = $this->src_dir . 'src/manifest.scss';
        file_put_contents($file, $this->bootstrap_manifest);
    }

}
