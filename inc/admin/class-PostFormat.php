<?php

class PostFormat
{
    
    public static $screens = array();
    public static $formats = array();
    public static $supported = array('audio', 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'video', 'status');

    public static function init($screens = array())
    {
        self::$screens = $screens;

        add_theme_support('post-formats', self::$supported);

        add_action('add_meta_boxes', array('PostFormat', 'registerMeta'));
        // creates the forms for each psot format type.
        foreach (self::$supported as $format) {
            // so long the class exists, add teh metabox and save meta code.
            if (class_exists('PostFormat' . ucfirst($format))) {
                $class_name = 'PostFormat' . ucfirst($format);
                $class      = new $class_name(self::$screens);
            }
        }

        add_action('save_post', array('PostFormat', 'save'));
        add_action('init', array('PostFormat', 'cptSupport'), 11);
        add_action('admin_enqueue_scripts', array('PostFormat', 'enqueue'));
        add_action('edit_form_after_title', array('PostFormat', 'displayMetaBoxes'));
    }


    /**
     * Registers all teh meta boxes with some gross double forloops!
     *
     * @return void
     */
    public static function registerMeta()
    {
        foreach (self::$screens as $screen) {
            foreach (self::$supported as $format) {
                $title = ucfirst($format);
                add_meta_box(
                    'post_formats_' . $format,
                    /* translators: one of the post format types*/
                    sprintf(__('%s ', 'benjamin'), esc_attr($title)),
                    array('PostFormat' . $title, 'metaBoxHtml'),
                    $screen,
                    'top',
                    'default'
                );
            }
        }
    }


    // displays the metaboxes.
    public static function displayMetaBoxes()
    {
        global $post, $wp_meta_boxes;

        do_meta_boxes(get_current_screen(), 'top', $post);
        unset($wp_meta_boxes[ get_post_type($post) ]['top']);
    }


    // add support for CPTs.
    public static function cptSupport()
    {
        foreach (self::$screens as $screen) {
            add_post_type_support($screen, 'post-formats');
            call_user_func('register_taxonomy_for_object_type', 'post_format', $screen);
        }
    }


    /**
     * Enqueue the JS scripts
     * @return [type] [description]
     */
    public static function enqueue()
    {
        global $typenow;

        if (in_array($typenow, self::$screens, true)) {
            $file  = get_template_directory_uri() . '/assets/backend/js/';
            $file .=  '_bootswatches-post-formats-min.js';

            wp_enqueue_script('post_formats_js', $file, array('jquery'), null, true);
        }
    }


    public static function save($post_id)
    {

        if (! isset($_POST['post_format_value'])
             || wp_is_post_autosave($post_id)
             || wp_is_post_revision($post_id)
             || ! isset($_POST['post_format'])
           ) {
            return;
        }

        $format = sanitize_text_field(wp_unslash($_POST['post_format']));

        // now that we have the format, check for the nonce
        if (! isset($_POST[ 'post_format_nonce_' . $format ])) {
            return;
        }

        
        $nonce = sanitize_key(wp_unslash($_POST[ 'post_format_nonce_' . $format ]));
        $is_valid_nonce = wp_verify_nonce($nonce, 'post_format_nonce_' . $format);

        if (! $is_valid_nonce) {
            return;
        }


        update_post_meta(
            $post_id,
            '_post_format_value',
            bootswatches_sanitize_text_or_array_field(wp_unslash($_POST['post_format_value']))
        );
    }

    public static function metaBoxSavedValue($post_id = null, $format = null, $default = null)
    {
        return bootswatches_get_post_format_value($post_id, $format, $default);
    }
}
