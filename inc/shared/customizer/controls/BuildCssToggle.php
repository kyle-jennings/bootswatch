<?php


if ( ! class_exists( 'WP_Customize_Control' ) )
    return null;

if( !class_exists('BuildCssToggle')) {

    class BuildCssToggle extends WP_Customize_Control
    {



        public function __construct($manager, $id, $args = array(), $options = array())
        {
            parent::__construct( $manager, $id, $args );
        }


        public function render_content()
        {
            $output = '';

            $output .= '<div id="build-css-toggle">';
                $output .= '<span class="label">CSS Building</span>';
                $output .= '<input class="js--css-build-toggle toggle" id="cb3" type="checkbox"/>';
                $output .= '<label class="toggle-btn" data-tg-on="Auto" data-tg-off="Manual" for="cb3"></label>';
                $output .= '<a class="button js--build-css" href="#">Build</a>';
            $output .= '</div>';

            echo $output;
        }

    }
    
}