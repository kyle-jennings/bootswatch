<?php

class PostFormatAside extends PostFormat
{

    public static $format = 'aside';


    // the markup
    public static function metaBoxHtml($post)
    {

        wp_nonce_field('post_format_nonce_' . self::$format, 'post_format_nonce_' . self::$format);

        $value = self::metaBoxSavedValue($post->ID, self::$format, null);
    ?>
        <p>
            <label>
                <?php esc_attr_e('Aside Body', 'bootswatches'); ?><br />
                <textarea name="post_format_aside"><?php echo esc_attr($value); ?></textarea>
            </label>
        </p>
        <?php
    }


}
