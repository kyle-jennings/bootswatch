<?php


class Validations {

    /**
     * ----------------------------------------------------------------------------
     * Sanitization settings
     * ----------------------------------------------------------------------------
     */

     function sanitize_select($val) {

         return sanitize_key($val);
     }


     function validate_select( $input, $setting ){

        //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
        $input = sanitize_key($input);

        //get the list of possible select options
        $choices = $setting->manager->get_control( $setting->id )->choices;
        //return input if valid or return default option
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

    }

    function _404_page_select_sanitize($val) {
        $pages = get_posts(array('post_type' => 'page', 'posts_per_page' => -1, 'fields' => 'ids'));

        if( !in_array($val, $pages) && 'publish' == get_post_status( $val ) )
            return null;

        return $val;
    }


    function _404_content_sanitize($val) {
        $valids = array(
            'default',
            'page'
        );

        if( !in_array($val, $valids) )
            return null;

        return $val;
    }


    function hero_image_sanitization( $val ) {
    	/*
    	 * Array of valid image file types.
    	 *
    	 * The array includes image mime types that are included in wp_get_mime_types()
    	 */
        $mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png',
            'bmp'          => 'image/bmp',
            'tif|tiff'     => 'image/tiff',
            'ico'          => 'image/x-icon'
        );
    	// Return an array with file extension and mime_type.
        $file = wp_check_filetype( $val, $mimes );
    	// If $image has a valid mime_type, return it; otherwise, return the default.
        return ( ($file['ext'] || $val == null) ? $val : null );
    }


    function template_settings_active_sanitize($val) {
        $valids = array(
            'no',
            'yes'
        );

        if( !in_array($val, $valids) )
            return null;

        return $val;
    }

    function hero_size_sanitize($val) {
        $valids = array(
            'slim',
            'medium',
            'big',
            'full',
        );

        if( !in_array($val, $valids) )
            return null;

        return $val;
    }


    function hero_position_sanitize($val) {
        $valids = array(
            'top',
            'center',
            'bottom'
        );

        if( !in_array($val, $valids) )
            return null;

        return $val;
    }

    function sidebar_position_sanitize($val) {
        $valids = array(
            'none',
            'left',
            'right'
        );

        if( !in_array($val, $valids) )
            return null;

        return $val;
    }

    function sidebar_visibility_sanitize($val) {
        $valids = array(
            'always-visible',
            'hidden-md hidden-lg',
            'hidden-lg',
            'visible-md-block visible-lg-block',
            'visible-lg',
        );

        if( !in_array($val, $valids) )
            return null;

        return $val;
    }


    function hide_layout_sanitize($val) {
        $valids = array(
            'banner',
            'navbar',
            'page-content',
            'footer',
        );

        $valid = true;
        $tmp_val = json_decode($val);
        foreach($tmp_val as $v){
            if( !in_array($v, $valids) )
                $valid = false;
        }

        if(!$valid)
            return null;

        return $val;
    }




    function sanitize_external_header_video( $value ) {
        return esc_url_raw( trim( $value ) );
    }

    function validate_external_header_video( $validity, $value ) {
        $video = esc_url_raw( $value );
        if ( $video ) {
            if ( ! preg_match( '#^https?://(?:www\.)?(?:youtube\.com/watch|youtu\.be/)#', $video ) ) {
                $validity->add( 'invalid_url', __( 'Please enter a valid YouTube URL.', 'bootswatch' ) );
            }
        }
        return $validity;
    }


    function validate_header_video( $validity, $value ) {
        $video = get_attached_file( absint( $value ) );
        if ( $video ) {
            $size = filesize( $video );
            if ( 8 < $size / pow( 1024, 2 ) ) { // Check whether the size is larger than 8MB.
                $validity->add( 'size_too_large',
                    __( 'This video file is too large to use as a header video. Try a shorter video or optimize the compression settings and re-upload a file that is less than 8MB. Or, upload your video to YouTube and link it with the option below.', 'bootswatch' )
                );
            }
            if ( '.mp4' !== substr( $video, -4 ) && '.mov' !== substr( $video, -4 ) ) { // Check for .mp4 or .mov format, which (assuming h.264 encoding) are the only cross-browser-supported formats.
                $validity->add( 'invalid_file_type', sprintf(
                    /* translators: 1: .mp4, 2: .mov */
                    __( 'Only %1$s or %2$s files may be used for header video. Please convert your video file and try again, or, upload your video to YouTube and link it with the option below.', 'bootswatch' ),
                    '<code>.mp4</code>',
                    '<code>.mov</code>'
                ) );
            }
        }
        return $validity;
    }



    function sanitize_color( $color ) {
        if ( 'blank' === $color )
            return 'blank';

        $color = sanitize_hex_color_no_hash( $color );
        if ( empty( $color ) )
            $color = '#02bfe7'; //#112e51

        return $color;
    }



    function footer_sortable_sanitize($val) {

        $valids = array(
                'return-to-top',
                'footer-menu',
                'widget-area-1',
                'widget-area-2',
        );

        $valid = true;
        $tmp_val = json_decode($val);
        foreach($tmp_val as $v){
            if( !in_array($v->name, $valids) ){
                // error_log($v->name)
                $valid = false;
            }
        }

        if(!$valid)
            return null;

        return $val;
    }



    function frontpage_hero_callout_sanitize($val) {
        $pages = get_posts(array('post_type' => 'page', 'posts_per_page' => -1, 'fields' => 'ids'));

        if( !in_array($val, $pages) && 'publish' == get_post_status( $val ) )
            return null;

        return $val;
    }


    function frontpage_sortable_sanitize($val) {
        $valids = array(
            'widget-area-1',
            'widget-area-2',
            'widget-area-3',
            'page-content',
        );

        $valid = true;
        $tmp_val = json_decode($val);
        foreach($tmp_val as $v){
            if( !in_array($v->name, $valids) )
                $valid = false;
        }

        if(!$valid)
            return null;

        return $val;
    }


    function frontpage_hero_content_sanitize($val) {

        $valids = array(
            'callout',
            'page',
            'title',
        );


        if( !in_array($val, $valids) )
            return null;

        return $val;
    }




    function header_sortable_sanitize($val) {
        $valids = array(
            'navbar',
            'hero',
            'banner',
        );

        $valid = true;
        $tmp_val = json_decode($val);
        foreach($tmp_val as $v){
            if( !in_array($v->name, $valids) )
                $valid = false;
        }

        if(!$valid)
            return null;

        return $val;
    }


    function navbar_brand_sanitize($val) {
        $valids = array(
            'text',
            'logo'
        );

        if( !in_array($val, $valids) )
            return null;

        return $val;
    }



    function navbar_sticky_sanitize($val) {
        $valids = array(
            'no',
            'yes'
        );

        if( !in_array($val, $valids) )
            return null;

        return $val;
    }


    function navbar_color_setting_sanitize($val) {
        $valids = array(
            'light',
            'dark'
        );

        if( !in_array($val, $valids) )
            return null;

        return $val;
    }


    function navbar_search_setting_sanitize($val) {
        $valids = array(
            'none',
            'navbar'
        );

        if( !in_array($val, $valids) )
            return null;

        return $val;
    }




    function sidebar_width_sanitize($val) {
        $valids = array(
            'BOOTSWATCH_ONE_THIRD',
            'BOOTSWATCH_ONE_FOURTH',
        );

        if( !in_array($val, $valids) )
            $val = 'BOOTSWATCH_ONE_THIRD';

        return $val;
    }


    function color_scheme_sanitize($valitity, $val) {
        $themes = new BootswatchThemes();
        $themes->setThemesAtts();
        $themes = $themes->getThemes();


        $valids = array_map( $this->color_scheme_sanitize_map($theme), $themes );

        if( !in_array($val, $valids) )
            return $validity->add( 'required', __( 'Invalid value', 'bootswatch' ) );


        return $val;
    }

    function color_scheme_sanitize_map($theme){
        return $theme->name;
    }


    function widgetized_sortable_sanitize($val) {
        $valids = array(
            'widget-area-1',
            'widget-area-2',
            'widget-area-3',
            'page-content',
        );

        $valid = true;
        $tmp_val = json_decode($val);
        foreach($tmp_val as $v){
            if( !in_array($v->name, $valids) )
                $valid = false;
        }

        if(!$valid)
            return null;

        return $val;
    }

    function banner_visibility_sanitize($val)
    {
        $valids = array(
            'hide',
            'display'
        );

        if( !in_array($val, $valids) )
            return null;

        return $val;
    }

}
