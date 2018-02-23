<?php

if( class_exists('BootswatchesThemes'))
    return false;

class BootswatchesThemes {

    /**
     * The bootswatches themes
     * @var array
     */
    private $theme_list = array(
        'bootstrap',
        'cerulean',
        'cosmo',
        'cyborg',
        'darkly',
        'flatly',
        'journal',
        'lumen',
        'paper',
        'readable',
        'sandstone',
        'simplex',
        'slate',
        'spacelab',
        'superhero',
        'united',
        'yeti'
    );

    private $themes = array(
        'bootstrap' => null,
        'cerulean' => null,
        'cosmo' => null,
        'cyborg' => null,
        'darkly' => null,
        'flatly' => null,
        'journal' => null,
        'lumen' => null,
        'paper' => null,
        'readable' => null,
        'sandstone' => null,
        'simplex' => null,
        'slate' => null,
        'spacelab' => null,
        'superhero' => null,
        'united' => null,
        'yeti' => null,
    );


    public function __construct()
    {

    }


    public function getThemeList()
    {
        return $this->theme_list;
    }


    public function setThemesAtts()
    {

        foreach($this->theme_list as $theme){
            $BootSwatch = new Bootswatches($theme);

            $BootSwatch->setCSS();
            $BootSwatch->setThumbnail();
            $this->themes[$theme] = $BootSwatch;
        }
    }


    public function getThemes()
    {
        return $this->themes;
    }


    public function getSingleTheme($theme = null)
    {
        if(!$theme)
            return false;

        return $this->themes[$theme];
    }


    public function removeDevStuff()
    {
        $useless = array(
            'vendor_dir',
            'vendor_uri',
            'sass_variables',
            'sass_bootswatch',
            'theme_dir',
            'theme_uri',
            'bootswatches_dir',
            'bootswatches_uri',
            'thumbnail'
        );

        foreach($this->themes as &$theme){
            foreach($useless as $v){
                unset($theme->$v);
            }
        }

    }
}
