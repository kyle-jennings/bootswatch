<?php

/**
 * The file contains the functions which gather all available templates.
 *
 * This tempalte list is used to populate the customizer settings and widgets ares
 *
 * @package Benjamin
 */

function bootswatches_get_template_info($name = null) {

    if(!$name)
        return;

    $templates = bootswatches_the_template_list();
    return $templates[$name];
}


function bootswatches_the_template_list($use_widget_areas = false, $add_default = false) {


    $desc_warning = '<p>The layout settings and widgets on this template are not available
    unless the template is activated in the customizer.</p>';


    $templates = array(
        'archive' => array(
            'label' => 'Feed/Archive',
            'description' => __('<p>This is your feed, or archive page. This page shows your recent new, archived, filtered posts ect.',
            'bootswatch'),
            /* translators: the page template name. */
            'widget_description' => sprintf( __('These widgets appear on %s
            in the sidebar located on the right or left of the page.', 'bootswatch'), 'the home (the archive/feed) page')
        ),

        'frontpage' => array(
            'label' => 'Front Page',
            /* translators: 1: site url. */
            /* translators: 2: warning about activating the widget areas. */
            'description' => sprintf( __('<p>The frontpage is the located at %1$s
            and the content area is made of 4 sortable areas. You can also set
            the content in the page header.</p> %2$s ',
            'bootswatch'), site_url(), $desc_warning),
            /* translators: the page template name. */
            'widget_description' => sprintf( __('These widgets appear on %s
            in the sidebar located on the right or left of the page.', 'bootswatch'), 'the frontpage' )
        ),

        'single' => array(
            'label' => 'Single Post',
            /* translators:  warning about activating the widget areas. */
            'description' => sprintf( __('<p>The "single post" is what you see when viewing
            a single blog post, or single custom post type.</p> %s', 'bootswatch'), $desc_warning),
            /* translators: the page template name. */
            'widget_description' => sprintf( __('These widgets appear on %s
            in the sidebar located on the right or left of the page.', 'bootswatch'), 'single posts' )
        ),

        'page' => array(
            'label' => 'Single Page',
            /* translators:  warning about activating the widget areas. */
            'description' => sprintf( __('<p>The "single page" is what you see when viewing
            a page.</p> %s.', 'bootswatch'), $desc_warning),
            /* translators: the page template name. */
            'widget_description' => sprintf( __('These widgets appear on %s
            in the sidebar located on the right or left of the page.', 'bootswatch'), 'single pages' )
        ),

        'widgetized' => array(
            'label' => 'Widgetized Page',
            /* translators:  warning about activating the widget areas. */
            'description' =>  sprintf(__('<p>This is a special page template,
            the content area is made of 4 sortable areas.</p> %s ', 'bootswatch'), $desc_warning),
            /* translators: the page template name. */
            'widget_description' => sprintf( __('These widgets appear on %s
            in the sidebar located on the right or left of the page.', 'bootswatch'), 'the widgetizted page')
        ),
        'template-1' => array(
            'label' => 'Page Template 1',
            /* translators:  warning about activating the widget areas. */
            'description' => sprintf(__('<p>This is just an extra page template, use this
            if you want to style an individual page differently then your
            standard pages.</p> %s', 'bootswatch'), $desc_warning),
            /* translators: the page template name. */
            'widget_description' => sprintf( __('These widgets appear on %s
            in the sidebar located on the right or left of the page.', 'bootswatch'), 'page template 1')
        ),
        'template-2' => array(
            'label' => 'Page Template 2',
            /* translators:  warning about activating the widget areas. */
            'description' => sprintf(__('<p>This is just an extra page template, use this
            if you want to style an individual page differently then your
            standard pages.</p> %s', 'bootswatch'), $desc_warning),
            /* translators: the page template name. */
            'widget_description' => sprintf( __('These widgets appear on %s
            in the sidebar located on the right or left of the page.', 'bootswatch'), 'page template 2')
        ),
        'template-3' => array(
            'label' => 'Page Template 3',
            /* translators:  warning about activating the widget areas. */
            'description' => sprintf(__('<p>This is just an extra page template, use this
            if you want to style an individual page differently then your
            standard pages.</p> %s', 'bootswatch'), $desc_warning),
            /* translators: the page template name. */
            'widget_description' => sprintf( __('These widgets appear on %s
            in the sidebar located on the right or left of the page.', 'bootswatch'), 'page template 3')
        ),
        'template-4' => array(
            'label' => 'Page Template 4',
            /* translators:  warning about activating the widget areas. */
            'description' => sprintf(__('<p>This is just an extra page template, use this
            if you want to style an individual page differently then your
            standard pages.</p> %s', 'bootswatch'), $desc_warning),
            /* translators: the page template name. */
            'widget_description' => sprintf( __('These widgets appear on %s
            in the sidebar located on the right or left of the page.', 'bootswatch'), 'page template 4')
        ),
        '_404' => array(
            'label' => '404 Page',
            /* translators:  warning about activating the widget areas. */
            'description' => sprintf(__('<p>This page is what user\'s see when they attempt
            to view an invalid page URL. Both the page and header content are
            configurable.</p> %s ', 'bootswatch'), $desc_warning),
            /* translators: the page template name. */
            'widget_description' => sprintf( __('These widgets appear on %s
            in the sidebar located on the right or left of the page.', 'bootswatch'), 'the 404 page')
        ),
    );

    $cpts = bootswatches_get_cpts();

    $templates = $templates + $cpts;

    $widget_areas = array(
        'banner-widget-area' => array(
            'label' => __('Banner Widgets', 'bootswatch'),
            'widget_description' => __('The banner is made up widget areas and are
            optionally used.  The banner is expandable only if widgets have been set.', 'bootswatch')
        ),

        'frontpage-widget-area-1' => array(
            'label' => __('Frontpage Widget Area 1', 'bootswatch'),
            'widget_description' => __('The frontpage content is made up of sortable,
            horizontal widget areas.  This is one of those areas and is
            optionally used.', 'bootswatch')
        ),
        'frontpage-widget-area-2' => array(
            'label' => __('Frontpage Widget Area 2', 'bootswatch'),
            'widget_description' => __('The frontpage content is made up of sortable,
            horizontal widget areas.  This is one of those areas and is
            optionally used.', 'bootswatch')
        ),
        'frontpage-widget-area-3' => array(
            'label' => __('Frontpage Widget Area 3', 'bootswatch'),
            'widget_description' => __('The frontpage content is made up of sortable,
            horizontal widget areas.  This is one of those areas and is
            optionally used.', 'bootswatch')
        ),
        'widgetized-widget-area-1' => array(
            'label' => __('Widgetized Page Area 1', 'bootswatch'),
            'widget_description' => __('The Widgetized page content is made up of
            sortable, horizontal widget areas.  This is one of those areas and
            is optionally used.', 'bootswatch')
        ),
        'widgetized-widget-area-2' => array(
            'label' => __('Widgetized Page Area 2', 'bootswatch'),
            'widget_description' => __('The Widgetized page content is made up of
            sortable, horizontal widget areas.  This is one of those areas and
            is optionally used.', 'bootswatch')
        ),
        'widgetized-widget-area-3' => array(
            'label' => __('Widgetized Page Area 3', 'bootswatch'),
            'widget_description' => __('The Widgetized page is full sortable, horizontal
            widget areas.  This is one of those areas and is optionally used.',
            'bootswatch')
        ),
        'footer-widget-area-1' => array(
            'label' => __('Footer Widget Area 1', 'bootswatch'),
            'widget_description' => __('The footer area is sortable and contains two
            optional widget areas.  To use these widgets, remember to setup the
            footer in the customizer.', 'bootswatch')
        ),
        'footer-widget-area-2' => array(
            'label' => __('Footer Widget Area 2', 'bootswatch'),
            'widget_description' => __('The footer area is sortable and contains two
            optional widget areas.  To use these widgets, remember to setup the
            footer in the customizer.', 'bootswatch')
        ),
    );

    if( $use_widget_areas == true )
        $templates = $templates + $widget_areas;


    if($add_default == true){
        $templates = array(DEFAULT_TEMPLATE => array(
            'label' => 'Default Layout Settings',
            'description' => __('<p>These settings are the default settings used on every page unless the other
            templates\' settings been activated.</p>',
            'bootswatch'),
            /* translators: the page template name. */
            'widget_description' => sprintf( __('These widgets appear on %s
            in the sidebar located on the right or left of the page.', 'bootswatch'), 'the home (the archive/feed) page')
        )) + $templates;
    }

    return $templates;
}
