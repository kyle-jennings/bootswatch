<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return null;

class ColorSchemeControl extends WP_Customize_Control
{
    public $type = 'color-scheme';
    public $themes;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        parent::__construct( $manager, $id, $args );

    }


    /**
    * Render the content on the theme customizer page
    */
    public function render_content()
    {

    ?>
        <label>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>
        </label>
        <p class="description customize-control-description">
            <?php echo $this->description; ?>
        </p>
        <ul>
            <?php

                foreach($this->choices as $theme):
            ?>
            <li class="cf">
                <input type="radio" name="<?php echo $this->id; ?>"
                    <?php $this->link(); ?>
                    value="<?php echo $theme->name; ?>"
                    <?php selected($this->value(), $theme->name) ?>
                />
                <?php echo ucfirst($theme->name); ?>
                <img class="swatches" src="<?php echo $theme->thumbnail_uri; ?>" />

            </li>
        <?php endforeach; ?>

        </ul>
    <?php
    }
}
