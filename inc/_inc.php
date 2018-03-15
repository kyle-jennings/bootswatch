<?php


// these files contain functions used by both the admin section and frontend
$shared_files = array(
    'audio-markup',
    'custom-post-types',
    'extras',
    'functions',
    'jetpack',
    'register-sidebars',
    'set-default-settings',
    'template-list',
    'theme-support',
    'utils',
    'video-markup',
    'widgets',
);

foreach($shared_files as $file)
    require get_template_directory() . '/inc/shared/' . $file . '.php'; 


// include customizer
require get_template_directory() . '/inc/customizer/_init.php'; 

// load some bootstwatch specific things
require get_template_directory() . '/inc/bootswatches/Bootswatches.php'; 
require get_template_directory() . '/inc/bootswatches/BootswatchesThemes.php'; 


// only load these in the admin section
if (is_admin()) {
    $files = array(
        'ajax',
        'assets',
        'metabox-featured-post',
    );
    foreach($files as $file)
        require get_template_directory() . '/inc/admin/' . $file . '.php'; // WPCS: xss ok.
}


// only load these on the frontend
if( !is_admin() ){

    $files = array(
        'assets',
        'brand',
        'class-FeaturedPost',
        'comment-form',
        'excerpts',
        'filters',
        'functions',
        'galleries',
        'get-sidebar',
        'get-width-visibility',
        'hero/Hero',
        'hero/HeroBackground',
        'hero/HeroContent',
        'nav-settings',
        'page-sortables',
        'pager',
        'sticky-sidenav',
        'template-parts',
        'template-settings',
        'template-tags',
        'walkers/BootswatchesNavbarWalker',
        'walkers/BootswatchesFooterNavbarWalker',
        'walkers/BootswatchesSidenavWalker',
        'walkers/BootswatchesNavlistWalker',
        'walkers/BootswatchesCommentsWalker',
    );
    foreach($files as $file)
        require get_template_directory() . '/inc/frontend/' . $file . '.php';

}
