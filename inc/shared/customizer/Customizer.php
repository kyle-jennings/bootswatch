<?php


class Customizer {

    public $wp_customize;
    public $change_count = 0;

    public $files = array(
        'controls/Bootswatch_Label_Custom_Control.php',
        'controls/video.php',
        'controls/Bootswatch_Sortable_Control.php',
        'controls/ColorSchemeControl.php',
        'controls/Menu_Dropdown_Custom_Control.php',
        'controls/checkbox-group.php',
        'controls/AlphaColor.php',


        'settings/template-settings.php',
        'settings/identity.php',
        'settings/header.php',
        'settings/frontpage.php',
        'settings/widgetized.php',
        'settings/footer.php',
        'settings/404.php',
    );


    public $sections = array(
        'site'
        // 'navbar',
        // 'banner',
        // 'main',
        // 'sidebar',
        // 'widebar',
        // 'footer'
    );

    public $styles = array();

    private $validation;

    public function __construct() {

        $this->validation = new Validations();
    }

    /**
    * Remove some default settings from the customizer
    * @param  object $wp_customize
    */
    public function init($wp_customize){

        foreach($this->files as $file)
            require_once $file;

        $wp_customize->register_control_type( 'Bootswatch_Video_Control' );

        // loop through the section
        // foreach($this->sections as $section)
        //     $this->registerSectionStyles($section, $wp_customize);

    }


    public function unlockValidationTasks()
    {

        $transient = 'bootswatch--building-css';
        if( $saved !== false)
            delete_transient( $transient );

    }


    public function isValidationLocked()
    {


        $transient = 'bootswatch--building-css';
        $saved = get_transient( $transient );
        if( $saved === false) {
            set_transient( $transient, $option, 60 * 2 );
            error_log('new change');
            return true;
        }else {
            error_log('still building');
            return false;
        }

    }


    public function buildCSS($val = null)
    {
        if(!$val)
            return false;


        $themes = bootswatch_fetch_bootswatch_themes();
        $files = bootswatch_fetch_bootswatch_files($themes[$val]);
        $Variables = new \bootswatch\builder\Variables();
        $Variables->saveVarFile($files['scssVariables']);

        $Builder = new \bootswatch\builder\Builder($val);
        $Builder->build();

        if(strlen($Builder->css) <= 0)
         return false;

         // ok try to upload, if it's a success then huzzaah
        $Uploader = new \bootswatch\builder\Uploader($Builder->css, $val);
        $status = $Uploader->saveTmpFile('preview');

        if(!is_wp_error($status))
            return $val;

        // if the upload failed, we get an error, return false
        return $status;
    }


    public function registerSectionStyles($section, $wp_customize) {
        //
        // $label = ucfirst(str_replace('_', ' ',$section));
        // $panel = $section.'_settings';
        //
        // $wp_customize->add_panel( $panel, array(
        //     'title' => sprintf(__( '%s Styles', 'bootswatch' ), $label),
        //     'description' => '',
        //     'priority' => 30,
        // ) );
        //
        //
        // foreach($this->style_files as $name => $file) {
        //
        //     $section_name = $section. '_'.$name.'_styles';
        //     $label = ucfirst(str_replace('_',' ',$name));
        //
        //     $wp_customize->add_section( $section_name, array(
        //         'title' => sprintf( __('%s Styles', 'bootswatch'), $label ),
        //         'panel' => $panel
        //     ) );
        //
        //     include 'settings/section-styles/'. $file;
        // }

    }


    public function enqueueScripts() {

        wp_enqueue_script(
            'custom-customize',
            get_stylesheet_directory_uri() . '/inc/admin/assets/js/_bootswatch-customizer.js',
            null,
            '20170215',
            true
        );

        wp_localize_script(
            'custom-customize',
            'ajax_object',
            array('ajax_url' => admin_url('admin-ajax.php'))
        );
    }

    public function enqueuePreviewScripts()
    {

        wp_enqueue_script(
            'custom-customize-preview',
            get_stylesheet_directory_uri() . '/inc/admin/assets/js/_bootswatch-customizer-preview.js',
            array( 'customize-preview', 'jquery' )
        );

        wp_localize_script(
            'custom-customize-preview',
            'ajax_object',
            array('ajax_url' => admin_url('admin-ajax.php'))
        );
    }

    public function setPreviewStyle()
    {
        $output = '';

        $output .= '.bootswatch-loading {';
            $output .= 'opacity: 0.25; cursor: progress !important; -webkit-transition: opacity 0.5s; transition: opacity 0.5s;';
        $output .= '}';

        return $output;
    }


    private function activeCallback( $wp_customize, $name )
    {
        return 'yes' === $wp_customize->get_setting( $name . '_settings_active' )->value();
    }

    private function frontpageHeroPageActiveCallback($wp_customizer)
    {
         return 'page' === $wp_customize->get_setting( 'frontpage_hero_content_setting' )->value();
    }

    private function frontpageCalloutActiveCallback($wp_customizer)
    {
         return 'callout' === $wp_customize->get_setting( 'frontpage_hero_content_setting' )->value();
    }

    private function _404PageActiveCallback($wp_customize)
    {
        return 'page' == $wp_customize->get_setting( '_404_page_content_setting' )->value();
    }
}
