<?php

namespace bootswatch\builder;

class Uploader {

    public $contents;
    public $tmpdir = 'tmp';
    public function __construct($contents = null, $themename = null)
    {
        if(!$contents || strlen($contents) <= 0)
        return false;

        $this->themename = $themename ? $themename : null;
        $this->contents = $contents;


    }


    /**
    * Saves the compiled CSS to a file in either the admin section or the public Section
    * the admin section file is used for the preview window
    *
    * The public section file is used to render the site and should be minimized
    */
    public function saveTmpFile($target = 'site') {


        $this->filename = $filename = $this->themename ?
        'bootswatch-'.$this->themename.'--'.$target.'.css'
        : 'bootswatch--'.$target.'.css' ;


        $uploads_dir = wp_upload_dir();
        $uploads_dir = $uploads_dir['basedir'];

        $uploads_dir .= '/'.$this->tmpdir;
        $file = $uploads_dir . '/' . $filename;

        // if no file was passed in. return with error
        if (strlen($filename) <= 0)
        return -1;

        // create teh bootswatch folder if it doesnt exist
        if (!file_exists($uploads_dir))
        mkdir($uploads_dir, 0777, true);

        // try to open the file (create it if it doesnt exist)
        $file = fopen($file,"w");

        if ($file == false)
        return -2;

        // write the file contents
        fwrite($file, $this->contents);
        fclose($file);


        // now we need to upload it WordPress's way (usefull when using things like offload S3)
        return $this->attemptUpload($filename, $uploads_dir);


    }



    function attemptUpload($filename, $uploads_dir)
    {
        $current_user = wp_get_current_user();
        $id = $current_user->ID;

        $url = wp_upload_dir();
        $url = $url['baseurl'] . '/'.$this->tmpdir.'/' . $filename;
        $path = $uploads_dir .'/' . $filename;

        $status = $this->upload($url, $id, $path);

        // if the upload was a success, update the path to the CSS
        if( !is_wp_error($status) ){

            if(file_exists($path))
                unlink($path);

            $oldfile = get_option('css-url', true);
            wp_delete_attachment( $oldfile['id'], true );
            update_option('css-url', $status, 'true');

            return $status['src'];
        }else{
            return $status;
        }

        return false;
    }



    function upload( $file = null, $post_id = 0, $path = null ) {
        if ( empty( $file ) )
            return new \WP_Error( 'image_sideload_failed', __( 'Invalid URL', 'bootswatch' ) );

        // We only want css files, reject everything else
        preg_match( '/[^\?]+\.(css)\b/i', $file, $matches );
        if ( ! $matches ) {
            return new \WP_Error( 'image_sideload_failed', __( 'This is not the correct type of file, just what are you trying to do?', 'bootswatch' ) );
        }

        // $tmp_file = download_url( $file );

        $file_array = array( //array to mimic $_FILES
            'name' => basename(basename($file)), //isolates and outputs the file name from its absolute path
            'type' => wp_check_filetype($file), // get mime type of image file
            'tmp_name' => $path, //this field passes the actual path to the image
            'error' => 0, //normally, this is used to store an error, should the upload fail. but since this isnt actually an instance of $_FILES we can default it to zero here
        );

        // If error storing temporarily, return the error.
        if ( is_wp_error( $file_array['tmp_name'] ) ) {
            return $file_array['tmp_name'];
        }

        $overrides = array(
    		'test_form' => false,
            'test_size' => false
    	);

        // Do the validation and storage stuff.
        update_option( 'uploads_use_yearmonth_folders', false );
        $id = media_handle_sideload( $file_array, 0, 'bootswatch-style' );
        // $file = wp_handle_upload( $file_array, $overrides, 'bootswatch' );
        // $id = $this->setAttachment($file);
        update_option( 'uploads_use_yearmonth_folders', true );


        // If error storing permanently, unlink.
        if ( is_wp_error( $id ) ) {
            // @unlink($path);
            return $id;
        }else{
            $old_css_file = get_option('css-url', true);
            unlink($old_css_file);
        }


        $src = wp_get_attachment_url( $id );

        if( empty( $src ) ){
            wp_delete_attachment( $id, true );
            return new \WP_Error( 'image_sideload_failed', 'Incorrect path' );
        }

        return array(
            'src' => $src,
            'id' => $id
        );

    }


    public function setAttachment($file)
    {
        if ( isset($file['error']) )
            return new \WP_Error( 'upload_error', $file['error'] );

        $url = $file['url'];
        $type = $file['type'];
        $file = $file['file'];
        $title = preg_replace('/\.[^.]+$/', '', basename($file));

        if ( isset( $desc ) )
            $title = $desc;

        // Construct the attachment array.
        $attachment = array(
            'post_mime_type' => $type,
            'guid' => $url,
            'post_parent' => $post_id,
            'post_title' => 'bootswatch-styles',
            'post_content' => 'bootswatch-styles',
        );

        // This should never be set as it would then overwrite an existing attachment.
        unset( $attachment['ID'] );

        // Save the attachment metadata
        return wp_insert_attachment($attachment, $file, $post_id);
    }

    public function isCorrectPath($src = null)
    {
        if(!$src)
            return false;

        // check to see if a date exists in the path
        $pattern = '([\/_0-9a-zA-Z-.:\/]+\/[0-9]{4}\/[0-9]{2}\/)';
        preg_match($pattern, $src, $has_date);

        // check to see if the /bootswatch/ dir is in there
        $pattern = '([\/_0-9a-zA-Z-.:\/]+\/[bootswatch]+\/)';
        preg_match($pattern, $src, $bootswatch_dir);

        // if we dont find a match on the first pattern, but we find the second,
        // then all is well
        if(empty($has_date) && !empty($bootswatch_dir))
            return true;

        return false;
    }


    public function error()
    {
        ?>
        <div class="update-nag notice">
            <p>
                <?php echo $this->status->get_error_message(); // WPCS: xss ok. ?>
            </p>
        </div>
        <?php
    }
}
