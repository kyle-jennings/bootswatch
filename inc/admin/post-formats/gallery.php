<?php

class PostFormatGallery extends PostFormat
{

    public static $format = 'gallery';
    
    // the markup
    public static function metaBoxHtml($post)
    {
        wp_nonce_field('post_format_nonce_' . self::$format, 'post_format_nonce_' . self::$format);
        $value = self::metaBoxSavedValue($post->ID, self::$format, null);

    ?>
        <input class="post_format_value" type="hidden" 
        name="post_format_value[<?php echo esc_attr(self::$format); ?>]" 
        value="<?php echo esc_attr($value); ?>" />
        <p>
            <?php echo __('Select Images to add to your gallery here.', 'bootswatches');  // WPCS: xss ok. ?>
            <input type="button" value="<?php echo __('Manage Gallery', 'bootswatches');  // WPCS: xss ok. ?>" 
                id="post_format_gallery_add" />
            <a class="gallery_remove" href="#" ><?php echo __('Remove Gallery', 'bootswatches');  // WPCS: xss ok. ?></a>

        </p>
        <div class="pfp-shortcode-holder" id="post_format_gallery_list">
            <?php echo !empty($value) ? do_shortcode('[gallery link="none" ids="' . $value . '"]') : ''; ?>
        </div>
        <?php
    }
}
