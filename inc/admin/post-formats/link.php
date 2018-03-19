<?php

class PostFormatLink extends PostFormat {

    public static $format = 'link';


    // the markup
    public static function metaBoxHtml( $post )
    {
        wp_nonce_field( 'post_format_nonce_' . self::$format, 'post_format_nonce_' . self::$format );

        $value = self::metaBoxSavedValue( $post->ID, self::$format, null );

        $text = isset( $value['text'] ) ? $value['text'] : '';
        $url = isset( $value['url'] ) ? $value['url'] : '';
    ?>
        <p>
            <label>
                <?php echo __( 'URL', 'bootswatches' ); // WPCS: xss ok. ?><br />
                <textarea name="post_format_value[<?php echo esc_attr( self::$format ); ?>][url]"><?php echo esc_attr( $url ); ?></textarea>
            </label>
        </p>

        <p>
            <label>
                <?php echo __( 'Text', 'bootswatches' ); // WPCS: xss ok. ?><br />
                <input type="text" value="<?php echo esc_attr( $text ); ?>" 
                name="post_format_value[<?php echo esc_attr( self::$format ); ?>][text]"
                 placeholder="<?php echo esc_attr( __( 'click here', 'bootswatches' )); ?>"/>
            </label>
        </p>
        <?php
    }


}
