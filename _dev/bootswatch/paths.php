<?php

namespace bootswatch;

trait paths {
    

        $this->template_dir = $template_dir = (function_exists('get_template_directory') )
            ? get_template_directory() : $this->get_template_directory();


        // destination
        $this->assets_dir = $this->template_dir . '/assets/frontend';

        // vendor stuff
        $this->vendor_dir = $template_dir . '/_dev/vendor';
        $this->fonts_dir = $template_dir . '/_dev/vendor/fortawesome/font-awesome/scss';
        $this->bootstrap_dir = $this->vendor_dir . '/twbs/bootstrap-sass/assets/stylesheets';

        // our custom SCSS modules
        $this->modules_dir = $template_dir . '/_dev/src/frontend/scss';
        $this->modules_manifest = $this->modules_dir . '/manifest.scss';
}