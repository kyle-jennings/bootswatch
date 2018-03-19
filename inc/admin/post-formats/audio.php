<?php

class PostFormatAudio extends PostFormat {

    public static $format = 'audio';


    // the markup
    public static function metaBoxHtml( $post )
    {
        wp_nonce_field( 'post_format_nonce_' . self::$format, 'post_format_nonce_' . self::$format );

        $value = self::metaBoxSavedValue( $post->ID, self::$format, null );
    ?>
        <div class="pfp-media-holder">
            <?php echo call_user_func( 'bootswatches_get_the_audio_markup', $value ); // WPCS: xss ok. ?> 
        </div>

        <a class="button pfp-js-media-library" data-media="audio"
            id="post_format_audio_select">
            <span class="dashicons dashicons-format-audio"></span>
            <?php echo esc_html( __('Select Audio', 'bootswatches' )); ?>
        </a>

        <span class="pfp-or-hr"> <?php echo __('or use an oembed url', 'bootswatches'); // WPCS: xss ok.?></span>

         <input class="post_format_value" 
            data-media="audio" 
            id="post_format_audio_value" 
            name="post_format_value[<?php echo esc_attr( self::$format ); ?>]" 
            type="url" 
            value="<?php echo esc_url_raw( $value ); ?>" 
        />

        <a class="pfp-js-remove-media" data-media="audio"
            href="#" > <?php echo __( 'Remove Audio', 'bootswatches' ); // WPCS: xss ok.?> </a>

        <?php
    }


}
