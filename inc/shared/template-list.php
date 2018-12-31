<?php

/**
 * The file contains the functions which gather all available templates.
 *
 * This tempalte list is used to populate the customizer settings and widgets ares
 *
 * @package Bootswatches
 */

function bootswatches_get_template_info($name = null)
{

    if (!$name) {
        return;
    }

    $templates = bootswatches_the_template_list();
    return $templates[$name];
}


function bootswatches_the_template_list($use_widget_areas = false, $add_default = false)
{


    $desc_warning =  __('The layout settings and widgets on this template are not available
    unless the template is activated in the customizer.', 'bootswatches');


    $templates = array(
        'archive' => array(
            'label' => __('Feed/Archive', 'bootswatches'),
            'description' => '' . __(
                'This is your feed, or archive page. This page shows your recent new, archived, filtered posts ect.',
                'bootswatches'
            ),
            'widget_description' => sprintf(
                /* translators: the page template name. */
                __(
                    'These widgets appear on %s in the sidebar located on the right or left of the page.',
                    'bootswatches'
                ),
                'the home (the archive/feed) page'
            )
        ),

        'frontpage' => array(
            'label' => __('Front Page', 'bootswatches'),
            'description' => sprintf(
                /* translators: 1: site url. */
                /* translators: 2: warning about activating the widget areas. */
                __(
                    'The frontpage is the located at %1$s and the content area is made of 4 sortable areas. You can also set the content in the page header. %2$s ',
                    'bootswatches'
                ),
                site_url(),
                $desc_warning
            ),
            'widget_description' => sprintf(
                /* translators: the page template name. */
                __(
                    'These widgets appear on %s in the sidebar located on the right or left of the page.',
                    'bootswatches'
                ),
                'the frontpage'
            )
        ),

        'single' => array(
            'label' => __('Single Post', 'bootswatches'),
            'description' => sprintf(
                /* translators:  warning about activating the widget areas. */
                __(
                    'The "single post" is what you see when viewing
            a single blog post, or single custom post type. %s',
                    'bootswatches'
                ),
                $desc_warning
            ),
            'widget_description' => sprintf(
                /* translators: the page template name. */
                __(
                    'These widgets appear on %s in the sidebar located on the right or left of the page.',
                    'bootswatches'
                ),
                'single posts'
            )
        ),

        'page' => array(
            'label' => __('Single Page', 'bootswatches'),
            'description' => sprintf(
                /* translators:  warning about activating the widget areas. */
                __(
                    'The "single page" is what you see when viewing a page. %s.',
                    'bootswatches'
                ),
                $desc_warning
            ),
            'widget_description' => sprintf(
                /* translators: the page template name. */
                __(
                    'These widgets appear on %s in the sidebar located on the right or left of the page.',
                    'bootswatches'
                ),
                'single pages'
            )
        ),

        'widgetized' => array(
            'label' => __('Widgetized Page', 'bootswatches'),
            'description' =>  sprintf(
                /* translators:  warning about activating the widget areas. */
                __(
                    'This is a special page template, the content area is made of 4 sortable areas. %s ',
                    'bootswatches'
                ),
                $desc_warning
            ),
            'widget_description' => sprintf(
                /* translators: the page template name. */
                __(
                    'These widgets appear on %s in the sidebar located on the right or left of the page.',
                    'bootswatches'
                ),
                'the widgetizted page'
            )
        ),
        'template-1' => array(
            'label' => __('Page Template 1', 'bootswatches'),
            'description' => sprintf(
                /* translators:  warning about activating the widget areas. */
                __(
                    'This is just an extra page template, use this if you want to style an individual page differently then your standard pages. %s',
                    'bootswatches'
                ),
                $desc_warning
            ),
            'widget_description' => sprintf(
                /* translators: the page template name. */
                __(
                    'These widgets appear on %s in the sidebar located on the right or left of the page.',
                    'bootswatches'
                ),
                'page template 1'
            )
        ),
        'template-2' => array(
            'label' => __('Page Template 2', 'bootswatches'),
            'description' => sprintf(
                /* translators:  warning about activating the widget areas. */
                __(
                    'This is just an extra page template, use this if you want to style an individual page differently then your standard pages. %s',
                    'bootswatches'
                ),
                $desc_warning
            ),
            'widget_description' => sprintf(
                /* translators: the page template name. */
                __(
                    'These widgets appear on %s in the sidebar located on the right or left of the page.',
                    'bootswatches'
                ),
                'page template 2'
            )
        ),
        'template-3' => array(
            'label' => __('Page Template 3', 'bootswatches'),
            /* translators:  warning about activating the widget areas. */
            'description' => sprintf(__('This is just an extra page template, use this
            if you want to style an individual page differently then your
            standard pages. %s', 'bootswatches'), $desc_warning),
            'widget_description' => sprintf(
                /* translators: the page template name. */
                __(
                    'These widgets appear on %s in the sidebar located on the right or left of the page.',
                    'bootswatches'
                ),
                'page template 3'
            )
        ),
        'template-4' => array(
            'label' => __('Page Template 4', 'bootswatches'),
            'description' => sprintf(
                /* translators:  warning about activating the widget areas. */
                __(
                    'This is just an extra page template, use this if you want to style an individual page differently then your standard pages. %s',
                    'bootswatches'
                ),
                $desc_warning
            ),
            'widget_description' => sprintf(
                /* translators: the page template name. */
                __(
                    'These widgets appear on %s in the sidebar located on the right or left of the page.',
                    'bootswatches'
                ),
                'page template 4'
            )
        ),
        '_404' => array(
            'label' => __('404 Page', 'bootswatches'),
            'description' => sprintf(
                /* translators:  warning about activating the widget areas. */
                __(
                    'This page is what user\'s see when they attempt to view an invalid page URL. Both the page and header content are configurable. %s ',
                    'bootswatches'
                ),
                $desc_warning
            ),
            'widget_description' => sprintf(
                /* translators: the page template name. */
                __(
                    'These widgets appear on %s in the sidebar located on the right or left of the page.',
                    'bootswatches'
                ),
                'the 404 page'
            )
        ),
    );

    $cpts = bootswatches_get_cpts();

    $templates = $templates + $cpts;

    $widget_areas = array(
        'banner-widget-area' => array(
            'label' => __('Banner Widgets', 'bootswatches'),
            'widget_description' => __(
                'The banner is made up widget areas and are optionally used.  The banner is expandable only if widgets have been set.',
                'bootswatches'
            )
        ),

        'frontpage-widget-area-1' => array(
            'label' => __('Frontpage Widget Area 1', 'bootswatches'),
            'widget_description' => __(
                'The frontpage content is made up of sortable, horizontal widget areas.  This is one of those areas and is optionally used.',
                'bootswatches'
            )
        ),
        'frontpage-widget-area-2' => array(
            'label' => __('Frontpage Widget Area 2', 'bootswatches'),
            'widget_description' => __(
                'The frontpage content is made up of sortable, horizontal widget areas.  This is one of those areas and is optionally used.',
                'bootswatches'
            )
        ),
        'frontpage-widget-area-3' => array(
            'label' => __('Frontpage Widget Area 3', 'bootswatches'),
            'widget_description' => __(
                'The frontpage content is made up of sortable, horizontal widget areas.  This is one of those areas and is optionally used.',
                'bootswatches'
            )
        ),
        'widgetized-widget-area-1' => array(
            'label' => __('Widgetized Page Area 1', 'bootswatches'),
            'widget_description' => __(
                'The Widgetized page content is made up of sortable, horizontal widget areas.  This is one of those areas and is optionally used.',
                'bootswatches'
            )
        ),
        'widgetized-widget-area-2' => array(
            'label' => __('Widgetized Page Area 2', 'bootswatches'),
            'widget_description' => __(
                'The Widgetized page content is made up of sortable, horizontal widget areas.  This is one of those areas and is optionally used.',
                'bootswatches'
            )
        ),
        'widgetized-widget-area-3' => array(
            'label' => __('Widgetized Page Area 3', 'bootswatches'),
            'widget_description' => __(
                'The Widgetized page is full sortable, horizontal widget areas.  This is one of those areas and is optionally used.',
                'bootswatches'
            )
        ),
        'footer-widget-area-1' => array(
            'label' => __('Footer Widget Area 1', 'bootswatches'),
            'widget_description' => __(
                'The footer area is sortable and contains two optional widget areas.  To use these widgets, remember to setup the footer in the customizer.',
                'bootswatches'
            )
        ),
        'footer-widget-area-2' => array(
            'label' => __('Footer Widget Area 2', 'bootswatches'),
            'widget_description' => __(
                'The footer area is sortable and contains two optional widget areas.  To use these widgets, remember to setup the footer in the customizer.',
                'bootswatches'
            )
        ),
    );

    if ($use_widget_areas == true) {
        $templates = $templates + $widget_areas;
    }


    if ($add_default == true) {
        $templates = array(BOOTSWATCHES_DEFAULT_TEMPLATE => array(
            'label' => __('Default Layout Settings', 'bootswatches'),
            'description' => __(
                'These settings are the default settings used on every page unless the other templates\' settings been activated.',
                'bootswatches'
            ),
            'widget_description' => sprintf(
                /* translators: the page template name. */
                __(
                    'These widgets appear on %s in the sidebar located on the right or left of the page.',
                    'bootswatches'
                ),
                'the home (the archive/feed) page'
            )
        )) + $templates;
    }

    return $templates;
}
