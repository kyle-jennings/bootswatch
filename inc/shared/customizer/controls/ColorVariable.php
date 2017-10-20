<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return null;

if(!class_exists('ColorVariable')) {


    class ColorVariable extends WP_Customize_Control
    {

        public $type = 'ColorVariable';
        public $scss_name;
        public $show_opacity;
        public $variables;
        
        // the saved values
        public $saved;

        // the set controls
        public $control;
        public $value;
        public $percentage;
        public $variable;


        public function __construct($manager, $id, $args = array(), $options = array())
        {
            parent::__construct( $manager, $id, $args );
        }


        // determines which color mode to use for the
        private function colorControl() {
            $control = strpos($this->control, 'color-') !== false ? substr($this->control, 6) : 'hue' ;

            return $control;
        }


        // determines whether or not to display a field, based on the saved control
        private function display( $names = array()) {

            return in_array($this->control, $names) ? '' : 'hidden';
        }


        /**
        * Render the content on the theme customizer page
        */
        public function render_content(){}


        public function to_json() {

            parent::to_json();

        }



        public function content_template() {
        ?>

            <div class="field-group" id="{{ data.field_id }}" data-settingID="{{ data.settingID }}" >
        
                <label for="{{ data.settings['default'] }}-button">
                    <# if ( data.label ) { #>
                        <span class="customize-control-title">{{ data.label }}</span>
                    <# } #>
                    <# if ( data.description ) { #>
                        <span class="description customize-control-description">{{{ data.description }}}</span>
                    <# } #>
                </label>
                    

                <select class="js--field-group-tool field-group-tool" 
                    data-controlName="control" >
                    <# data.tools.forEach(function(e,i,a){#>
                        <option value="{{ e.name }}" {{ e.name == data.control ? 'selected' : ''}} > {{ e.label }} </option>
                    <# }); #>
                </select>


               <!-- the mini color thing -->
                <div class="minicolor-wrapper {{ data.display == 'color' ? '' : 'hidden' }}">
                    <input class="js--minicolors minicolors" 
                        data-value="{{ data.value }}" 
                        data-controlName="value"
                    >
                </div>
                
                <!-- The variables list -->
                <# 
                if (data.variables) {
                #>
                <select class="js--field-variable-ref field-variable-ref 
                {{ data.display == 'variable' ? '' : 'hidden' }}" 
                    data-controlName="variable" >
                <#
                    data.variables.forEach( function(e,i,a){
                    var name = e.name.replace('$','');
                #>
                    <option value="{{ name }}" data-group="{{ e.group }}"
                    {{ name == data.value ? 'selected' : '' }} 
                    >
                        {{ e.name }}
                    </option>
                <#
                    });
                #>

                </select>
                <#
                } 
                #>

                <!-- The range slider -->
                <input class="js--range-slider {{ data.display == 'range' ? '' : 'hidden' }}" 
                    type="range" list="tickmarks" 
                    min="0" max="100" value="{{ data.percentage }}" 
                    data-controlName="percentage"
                >

                <datalist id="tickmarks">
                  <option value="0" label="0%">
                  <option value="10">
                  <option value="20">
                  <option value="30">
                  <option value="40">
                  <option value="50" label="50%">
                  <option value="60">
                  <option value="70">
                  <option value="80">
                  <option value="90">
                  <option value="100" label="100%">
                </datalist>
            
                <!-- the input  -->
                <input class="js--color-input {{ data.display == 'manual' || data.display == 'range' ? '' : 'hidden' }}"
                    type="text" data-controlName="value" value="{{ data.value }}" />



            </div>

            <?php
        }

        
        // map the variable names
        private function getVariables()
        {
            $variables = array();
            foreach($this->variables as $group) {
                foreach($group['fields'] as $name=>$field) {
                    $variables[$name] = $field;
                }
            }

            return $variables;
        }


    }

}
