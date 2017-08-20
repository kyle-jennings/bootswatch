<?php

namespace bootswatch\customizer;

class Fields{
    public $wp_customize;
    public $setting;
    public $section;
    public $label;
    public $desc;
    public $args
    public $callback;

    public function __construct(&$wp_customize, $setting, $section, $label = '', $desc = '', $args = array(), $callback = null)
    {
        $this->wp_customize = $wp_customize;
        $this->setting = $setting;
        $this->section = $section;
        $this->label = $label;
        $this->desc = $desc;
        $this->arg = $args
        $this->callback = $callback;
    }


    public function rangeSlider(&$wp_customize, $setting, $section, $label = '', $desc = '', $callback = null)
    {
        $args = array(
            // translators: range slider field description
            'description' => sprintf( __(' %s', 'bootswatch'), $desc ),
            // translators: range slider field label
            'label' => sprintf( __(' %s', 'bootswatch'), $label ),
            'type' => 'label',
            'section' => $section,
            'settings' => $setting,
        );

        if($callback)
            $args['active_callback'] = $callback;

    }



    public function label(&$wp_customize, $setting, $section, $label = '', $desc = '', $callback = null) {

        $args = array(
            // translators: range slider field description
            'description' => sprintf( __(' %s', 'bootswatch'), $desc ),
            // translators: range slider field label
            'label' => sprintf( __(' %s', 'bootswatch'), $label ),
            'type' => 'label',
            'section' => $section,
            'settings' => $setting,
        );

        if($callback)
            $args['active_callback'] = $callback;

        $wp_customize->add_setting(
            $setting,
            array(
                'default' => 'none',
                'sanitize_callback' => 'wp_filter_nohtml_kses',
            )
        );

        $wp_customize->add_control(
            new Bootswatch_Label_Custom_Control(
                $wp_customize,
                $setting . '_control',
                $args
            )
        );
    }


    public function color(&$wp_customize, $setting, $section, $label = '', $desc = '', $callback = null)
    {
        $args = array(
            // translators: range slider field description
            'description' => sprintf( __(' %s', 'bootswatch'), $desc ),
            // translators: range slider field label
            'label' => sprintf( __(' %s', 'bootswatch'), $label ),
            'section' => $section,
            'settings' => $setting,
            'show_opacity' => true,
        );

        if($callback)
            $args['active_callback'] = $callback;

        // The color
        $wp_customize->add_setting(
            $setting,
            array(
                'default' => '',
                'sanitize_callback' => 'wp_filter_nohtml_kses',
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $setting . '_control',
                $args
            )
        );
    }


    public function alphaColor(&$wp_customize, $setting, $section, $label = '', $desc = '', $callback = null)
    {
        $args = array(
            // translators: range slider field description
            'description' => sprintf( __(' %s', 'bootswatch'), $desc ),
            // translators: range slider field label
            'label' => sprintf( __(' %s', 'bootswatch'), $label ),
            'section' => $section,
            'settings' => $setting,
            'show_opacity' => true,
        );

        if($callback)
            $args['active_callback'] = $callback;

        // The color
        $wp_customize->add_setting(
            $setting,
            array(
                'default' => '',
                'sanitize_callback' => 'wp_filter_nohtml_kses',
            )
        );

        $wp_customize->add_control(
            new BootswatchAlphaColor(
                $wp_customize,
                $setting . '_control',
                $args
            )
        );
    }

}
