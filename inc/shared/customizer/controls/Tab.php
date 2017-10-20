<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return null;

if ( ! class_exists( 'Tab' ) ) {

    class Tab extends WP_Customize_Control
    {
        public $type = 'tab';
        public $groups;

        public function __construct($manager, $id, $args = array(), $options = array())
        {

            parent::__construct( $manager, $id, $args );

        }


        /**
        * Render the content on the theme customizer page
        */
        public function render_content()
        {

            $data_settings = str_replace('_section', '', $this->section);
            $data_section = $this->section;

        ?>            
            <select class="js--tab-switch" name="<?php echo $this->setting->id; ?>" 
                data-section="<?php echo $data_section; ?>"
                data-settings="<?php echo $data_settings; ?>"
                <?php echo $this->get_link(); ?>
            >
            <?php echo $this->renderOptions('option'); ?>
            </select>

        <?php
        }
        

        private function renderOptions($type = 'checkbox')
        {

            $output = '';

            foreach($this->groups as $name => $group):

                $name = $group['name'];
                $label = ucwords($group['label']);
                $selected = selected($group['name'], $this->value(), false );
                $checked = checked($group['name'], $this->value(), false );
                
                if($type =='option'){
                    $output .= '<option data-group="'.$name.'" ';
                        $output .= 'value="'.$name.'" ';
                        $output .=  $selected .' ';
                    $output .= '>'. $label.'</option>';

                } else {
                    $output .= '<input type="radio" data-group="'.$name.'" ';
                        $output .= 'value="'.$name.'" ';
                        $output .=  $checked .' ';
                    $output .= '>';
                }

            endforeach;

            return $output;
        }



    }


}