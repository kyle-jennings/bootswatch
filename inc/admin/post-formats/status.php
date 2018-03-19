<?php

class PostFormatStatus extends PostFormat {

    public static $format = 'status';


    /**
     * [metaBoxHtml description]
     *
     * @param  wp_post $post the post object.
     * @return void       everythign is echoed.
     */
    public static function metaBoxHtml( $post )
    {
        
        wp_nonce_field( 'post_format_nonce_' . self::$format, 'post_format_nonce_' . self::$format );

        $value = self::metaBoxSavedValue( $post->ID, self::$format, null );
    ?>
        <p>
            <label>
                <?php echo __( 'Character Count', 'bootswatches' ); // WPCS: xss ok.?> 
                <span class="js--char-count"><?php echo esc_html( strlen( $value ) ); ?></span>
                <textarea class="js--post-format-status-textarea" 
                name="post_format_value[<?php echo esc_attr( self::$format ); ?>]"
                ><?php echo esc_attr( $value ); ?></textarea>
            </label>
        </p>
        <?php
    }


}
