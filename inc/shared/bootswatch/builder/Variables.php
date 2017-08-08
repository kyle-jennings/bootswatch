<?php
namespace bootswatch\builder;

class Variables {

    public $src_dir;

    public function __construct()
    {
        $this->src_dir = dirname(__FILE__) . '/bootstrap/src';

    }


    public function useDefaults()
    {
        $file = file_get_contents( $this->findDefaultFile() );
        $this->bootstrap_vars = $variables;
    }


    public function findDefaultFile()
    {
        $src = dirname(dirname(__FILE__));
        $file = $src . 'customizer/_variables.php';

        return $file;
    }


    public function buildVariables()
    {
        ob_start();
        // grab varibles form DB and spit them out
        $this->bootstrap_vars = ob_get_contents();
        ob_end_clean();
    }



    public function setVariables($variables = null)
    {
        $this->bootstrap_vars = $variables;
    }


    public function saveVarFile($variables = null)
    {
        $file = $this->src_dir . '/bootstrap/_variables.scss';
        $variables = $variables ? $variables : $this->bootstrap_vars;

        file_put_contents($file, $variables);

    }


    public function saveExtraFile($file = '_bootswatch', $variables = null)
    {
        if(!$variables)
            return false;
        $file = $this->src_dir . '/bootstrap/'.$file.'.scss';

        file_put_contents($file, $variables);

    }

}
