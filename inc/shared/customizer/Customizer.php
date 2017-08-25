<?php


class Customizer {

    public $wp_customize;
    public $change_count = 0;

    public $files = array(
        'controls/Label.php',
        'controls/Video.php',
        'controls/Sortable.php',
        'controls/ColorScheme.php',
        'controls/MenuDropdown.php',
        'controls/CheckboxGroup.php',
        'controls/AlphaColor.php',


        'settings/identity.php',
        'settings/template-settings.php',
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

        // $wp_customize->register_control_type( 'Bootswatch_Video_Control' );

        // loop through the section
        // foreach($this->sections as $section)
        //     $this->registerSectionStyles($section, $wp_customize);

    }


    public function buildCSS($val = null)
    {
        if(!$val)
            return false;


        $themes = bootswatch_fetch_bootswatch_themes();
        $files = bootswatch_fetch_bootswatch_files($themes[$val]);
        $Variables = new Variables();
        $Variables->saveVarFile($files['scssVariables']);

        $Builder = new Builder($val);
        $Builder->build();

        if(strlen($Builder->css) <= 0)
         return false;

         // ok try to upload, if it's a success then huzzaah
        $Uploader = new Uploader($Builder->css, $val);
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


    public function toggleTemplateSettingsCallback()
    {
        return true;
    }


    // toggle section settings
    public function activeCallbackFilter($active, $control)
    {
        global $wp_customize;

        // first check the 1 offs (404 and dontpage setings), then check for the template toggles
        if($control->id == '_404_page_select_control')
            return 'page' == $wp_customize->get_setting( '_404_page_content_setting' )->value();
        elseif($control->id == 'frontpage_hero_callout_control')
            return 'callout' === $wp_customize->get_setting( 'frontpage_hero_content_setting' )->value();
        elseif($control->id == 'frontpage_hero_page_control')
            return 'page' === $wp_customize->get_setting( 'frontpage_hero_content_setting' )->value();
        elseif(strpos( $control->section, '_settings_section'))
            return $this->checkToggableSettings($active, $control, $wp_customize );

        return $active;

    }


    // the logic to toggle these things... god damn php 5.2 support!
    public function checkToggableSettings($active, $control, $wp_customize)
    {

        // set initial values
        $is_togglable = false;
        $is_section_setting = false;
        $check_against = '_settings_active';

        // get the setting to check against
        $check_against = $this->getSectionPrefix($control->section);
        if(!$check_against)
            return $active;

        // check to see if we are in teh correction section
        $is_section_setting = strpos( $control->section, '_settings_section');

        // check for the "toggable" attr
        if( is_array($control->input_attrs) && in_array('toggable', $control->input_attrs) )
            $is_togglable = true;

        if( $is_section_setting !== false && $is_togglable !== false && $check_against ) {

            if($wp_customize->get_setting( $check_against ))
                return 'yes' === $wp_customize->get_setting( $check_against )->value();

        }

        return $active;
    }


    public function getSectionPrefix($section = null)
    {
        if(!$section)
            return null;

        $find = '_';
        $section = explode($find, $section);

        // get the section mae
        $name = array_shift( $section );

        // in the case of _404, we need to shift again and add an _
        if(!$name)
            $name = '_'. array_shift( $section );

        $check_against = $name . '_settings_active';

        return $check_against;
    }

}
