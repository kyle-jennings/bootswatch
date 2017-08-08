<?php


// these files contain functions used by both the admin section and frontend
$shared_files = array(
    '/inc/shared/customize.php',
    '/inc/shared/functions.php',
    '/inc/shared/template-list.php',
    '/inc/shared/theme-support.php',
    '/inc/shared/extras.php',
    '/inc/shared/jetpack.php',
    '/inc/shared/register-sidebars.php',
    '/inc/shared/widgets.php',
    '/inc/shared/video-markup.php',
    '/inc/shared/set-default-settings.php',
);

foreach($shared_files as $file)
    require get_template_directory() . $file; // WPCS: xss ok.

// only load these in the admin section
if (is_admin()) {
    $files = array(
        '/inc/admin/ajax.php',
        '/inc/admin/assets.php',
        '/inc/admin/metabox-featured-post.php',
        // '/inc/admin/metabox-featured-video.php',
    );
    foreach($files as $file)
        require get_template_directory() . $file; // WPCS: xss ok.
}


// only load these on the frontend
if( !is_admin() ){

    $files = array(
        'assets.php',
        'filters.php',
        'comment-form.php',
        'excerpts.php',
        'template-tags.php',
        'class-FeaturedPost.php',
        'hero/Hero.php',
        'hero/HeroContent.php',
        'hero/HeroBackground.php',
        'template-parts.php',
        'template-settings.php',
        'get-sidebar.php',
        'sticky-sidenav.php',
        'page-sortables.php',
        'brand.php',
        'get-width-visibility.php',
        'nav-settings.php',
        'pager.php',
    );
    foreach($files as $file)
        require get_template_directory() . '/inc/frontend/' . $file;

    $walkers = array(
        'walkers/class-NavbarWalker.php',
        'walkers/class-FooterNavbarWalker.php',
        'walkers/class-SidenavWalker.php',
        'walkers/class-NavlistWalker.php',
        'walkers/class-CommentsWalker.php',
    );

    foreach($walkers as $file)
        require get_template_directory() . '/inc/frontend/' . $file;

}
