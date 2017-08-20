<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return null;

class BootswatchAlphaColor extends WP_Customize_Control
{

    public $type = 'alpha_color';
    public $palette;
    public $show_opacity;

    public function __construct($manager, $id, $args = array(), $options = array())
    {

        parent::__construct( $manager, $id, $args );
    }


    public function enqueue() {
        wp_enqueue_script(
			'alpha-color-picker',
			get_stylesheet_directory_uri() . '/inc/admin/assets/js/_bootswatch-customizer-min.js',
			array( 'jquery', 'wp-color-picker' ),
			'1.0.0',
			true
		);
		wp_enqueue_style(
			'alpha-color-picker',
			get_stylesheet_directory_uri() . '/inc/admin/assets/css/bootswatch-admin.min.css',
			array( 'wp-color-picker' ),
			'1.0.0'
		);
    }

    public function render_field() {

        // Process the palette
        if ( is_array( $this->palette ) ) {
            $palette = implode( '|', $this->palette );
        } else {
            // Default to true.
            $palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
        }
        // Support passing show_opacity as string or boolean. Default to true.
        $show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
        // Begin the output. ?>
        <label>
            <?php // Output the label and description if they were passed in.
            if ( isset( $this->label ) && '' !== $this->label ) {
                echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
            }
            if ( isset( $this->description ) && '' !== $this->description ) {
                echo '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
            } ?>

            <input class="alpha-color-control"
            type="text" data-show-opacity="<?php echo esc_attr($show_opacity); ?>"
            data-palette="<?php echo esc_attr( $palette ); ?>"
            data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>"
            <?php $this->link(); ?>
            />
        </label>
        <?php
    }

    /**
    * Render the content on the theme customizer page
    */
    public function render_content()
    {
        echo $this->render_field(); // WPCS: xss ok.
    }

}
