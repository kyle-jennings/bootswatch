<?php

'$bootstrap-sass-asset-helper' => array(
    'default' => 'false'
),
//
// Variables
// --------------------------------------------------


//== Colors
//
//## Gray and brand colors for use across Bootstrap.

'$gray-base' => array(
    'type'=> 'color',
    'default' => '#000'
),
'$gray-darker' => array(
    'type'=> 'color',
    'default' => 'lighten($gray-base, 13.5%) // #222'
),
'$gray-dark' => array(
    'type'=> 'color',
    'default' => 'lighten($gray-base, 20%)   // #333'
),
'$gray' => array(
    'type'=> 'color',
    'default' => 'lighten($gray-base, 33.5%) // #555'
),
'$gray-light' => array(
    'type'=> 'color',
    'default' => 'lighten($gray-base, 46.7%) // #777'
),
'$gray-lighter' => array(
    'type'=> 'color',
    'default' => 'lighten($gray-base, 93.5%) // #eee'
),

'$brand-primary' => array(
    'type'=> 'color',
    'default' => 'darken(#428bca, 6.5%) // #337ab7'
),
'$brand-success' => array(
    'type'=> 'color',
    'default' => '#5cb85c'
),
'$brand-info' => array(
    'type'=> 'color',
    'default' => '#5bc0de'
),
'$brand-warning' => array(
    'type'=> 'color',
    'default' => '#f0ad4e'
),
'$brand-danger' => array(
    'type'=> 'color',
    'default' => '#d9534f'
),


//== Scaffolding
//
//## Settings for some of the most global styles.

//** Background color for `<body>`.
'$body-bg' => array(
    'type'=> 'color',
    'default' => '#fff'
),
//** Global text color on `<body>`.
'$text-color' => array(
    'type'=> 'color',
    'default' => '$gray-dark'
),

//** Global textual link color.
'$link-color' => array(
    'type'=> 'color',
    'default' => '$brand-primary'
),
//** Link hover color set via `darken()` function.
'$link-hover-color' => array(
    'type'=> 'color',
    'default' => 'darken($link-color, 15%)'
),
//** Link hover decoration.
'$link-hover-decoration' => array(
    'type'=> 'select',
    'choices' => array('underline solid', 'underline dashed', 'underline wavy', 'underline dotted', 'highlight', 'none'),
    'default' => 'underline solid'
),


//== Typography
//
//## Font, line-height, and color for body text, headings, and more.

'$font-family-sans-serif' => array(
    'default' => '"Helvetica Neue", Helvetica, Arial, sans-serif'
),
'$font-family-serif' => array(
    'default' => 'Georgia, "Times New Roman", Times, serif'
),
//** Default monospace fonts for `<code>`, `<kbd>`, and `<pre>`.
'$font-family-monospace' => array(
    'default' => 'Menlo, Monaco, Consolas, "Courier New", monospace'
),
'$font-family-base' => array(
    'default' => '$font-family-sans-serif'
),

'$font-size-base' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '14px'
),
'$font-size-large' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => 'ceil(($font-size-base * 1.25)) // ~18px'
),
'$font-size-small' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => 'ceil(($font-size-base * 0.85)) // ~12px'
),

'$font-size-h1' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => 'floor(($font-size-base * 2.6)) // ~36px'
),
'$font-size-h2' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => 'floor(($font-size-base * 2.15)) // ~30px'
),
'$font-size-h3' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => 'ceil(($font-size-base * 1.7)) // ~24px'
),
'$font-size-h4' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => 'ceil(($font-size-base * 1.25)) // ~18px'
),
'$font-size-h5' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$font-size-base'
),
'$font-size-h6' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => 'ceil(($font-size-base * 0.85)) // ~12px'
),

//** Unit-less `line-height` for use in components like buttons.
'$line-height-base' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '1.428571429'  // 20/14
),
//** Computed "line-height" (`font-size` * `line-height`) for use with `margin`, `padding`, etc.
'$line-height-computed' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => 'floor(($font-size-base * $line-height-base))' // ~20px
),

//** By default, this inherits from the `<body>`.
'$headings-font-family' => array(
    'default' => 'inherit'
),
'$headings-font-weight' => array(
    'type' => 'select',
    'choice' => array(
        '100' => '100',
        '200' => '200',
        '300' => '300',
        '400' => '400 (normal)',
        '500' => '500',
        '600' => '600',
        '700' => '700 (bold)',
        '800' => '800',
        '900' => '900',
    ),
    'default' => '500'
),
'$headings-line-height' => array(
    'type' => 'range',
    'default' => '1.1'
),
'$headings-color' => array(
    'type' => 'color',
    'default' => 'inherit'
),


//== Iconography
//
//## Specify custom location and filename of the included Glyphicons icon font. Useful for those including Bootstrap via Bower.

//** Load fonts from this directory.

// [converter] If $bootstrap-sass-asset-helper if used, provide path relative to the assets load path.
// [converter] This is because some asset helpers, such as Sprockets, do not work with file-relative paths.
'$icon-font-path' => array(
    'default' => 'if($bootstrap-sass-asset-helper, "bootstrap/", "../fonts/bootstrap/")'
),

//** File name for all font files.
'$icon-font-name' => array(
    'default' => '"glyphicons-halflings-regular"'
),
//** Element ID within SVG icon file.
'$icon-font-svg-id' => array(
    'default' => '"glyphicons_halflingsregular"'
),


//== Components
//
//## Define common padding and border radius sizes and more. Values based on 14px text and 1.428 line-height (~20px to start).

'$padding-base-vertical' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '6px'
),
'$padding-base-horizontal' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '12px'
),

'$padding-large-vertical' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '10px'
),
'$padding-large-horizontal' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '16px'
),

'$padding-small-vertical' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '5px'
),
'$padding-small-horizontal' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '10px'
),

'$padding-xs-vertical' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '1px'
),
'$padding-xs-horizontal' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '5px'
),

'$line-height-large' => array(
    'type' => 'range',
    'steps' => '0.2',
    'default' => '1.3333333'  // extra decimals for Win 8.1 Chrome
),
'$line-height-small' => array(
    'type' => 'range',
    'steps' => '0.2',
    'default' => '1.5'
),

'$border-radius-base' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '4px'
),
'$border-radius-large' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '6px'
),
'$border-radius-small' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '3px'
),

//** Global color for active items (e.g., navs or dropdowns).
'$component-active-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
//** Global background color for active items (e.g., navs or dropdowns).
'$component-active-bg' => array(
    'type' => 'color',
    'default' => '$brand-primary'
),

//** Width of the `border` for generating carets that indicate dropdowns.
'$caret-width-base' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '4px'
),
//** Carets increase slightly in size for larger components.
'$caret-width-large' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '5px'
),


//== Tables
//
//## Customizes the `.table` component with basic values, each used across all table variations.

//** Padding for `<th>`s and `<td>`s.
'$table-cell-padding' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '8px'
),
//** Padding for cells in `.table-condensed`.
'$table-condensed-cell-padding' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '5px'
),

//** Default background color used for all tables.
'$table-bg' => array(
    'type' => 'color',
    'default' => 'transparent'
),
//** Background color used for `.table-striped`.
'$table-bg-accent' => array(
    'type' => 'color',
    'default' => '#f9f9f9'
),
//** Background color used for `.table-hover`.
'$table-bg-hover' => array(
    'type' => 'color',
    'default' => '#f5f5f5'
),
'$table-bg-active' => array(
    'type' => 'color',
    'default' => '$table-bg-hover'
),

//** Border color for table and cell borders.
'$table-border-color' => array(
    'type' => 'color',
    'default' => '#ddd'
),


//== Buttons
//
//## For each of Bootstrap's buttons, define text, background and border color.

'$btn-font-weight' => array(
    'type' => 'select',
    'choice' => array(
        '100' => '100',
        '200' => '200',
        '300' => '300',
        '400' => '400 (normal)',
        '500' => '500',
        '600' => '600',
        '700' => '700 (bold)',
        '800' => '800',
        '900' => '900',
    ),
    'default' => 'normal'
),

'$btn-default-color' => array(
    'type' => 'color',
    'default' => '#333'
),
'$btn-default-bg' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$btn-default-border' => array(
    'type' => 'color',
    'default' => '#ccc'
),

'$btn-primary-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$btn-primary-bg' => array(
    'type' => 'color',
    'default' => '$brand-primary'
),
'$btn-primary-border' => array(
    'type' => 'color',
    'default' => 'darken($btn-primary-bg, 5%)'
),

'$btn-success-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$btn-success-bg' => array(
    'type' => 'color',
    'default' => '$brand-success'
),
'$btn-success-border' => array(
    'type' => 'color',
    'default' => 'darken($btn-success-bg, 5%)'
),

'$btn-info-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$btn-info-bg' => array(
    'type' => 'color',
    'default' => '$brand-info'
),
'$btn-info-border' => array(
    'type' => 'color',
    'default' => 'darken($btn-info-bg, 5%)'
),

'$btn-warning-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$btn-warning-bg' => array(
    'type' => 'color',
    'default' => '$brand-warning'
),
'$btn-warning-border' => array(
    'type' => 'color',
    'default' => 'darken($btn-warning-bg, 5%)'
),

'$btn-danger-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$btn-danger-bg' => array(
    'type' => 'color',
    'default' => '$brand-danger'
),
'$btn-danger-border' => array(
    'type' => 'color',
    'default' => 'darken($btn-danger-bg, 5%)'
),

'$btn-link-disabled-color' => array(
    'type' => 'color',
    'default' => '$gray-light'
),

// Allows for customizing button radius independently from global border radius
'$btn-border-radius-base' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$border-radius-base'
),
'$btn-border-radius-large' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$border-radius-large'
),
'$btn-border-radius-small' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$border-radius-small'
),


//== Forms
//
//##

//** `<input>` background color
'$input-bg' => array(
    'type' => 'color',
    'default' => '#fff'
),
//** `<input disabled>` background color
'$input-bg-disabled' => array(
    'type' => 'color',
    'default' => '$gray-lighter'
),

//** Text color for `<input>`s
'$input-color' => array(
    'type' => 'color',
    'default' => '$gray'
),
//** `<input>` border color
'$input-border' => array(
    'type' => 'color',
    'default' => '#ccc'
),

//** Default `.form-control` border radius
// This has no effect on `<select>`s in some browsers, due to the limited stylability of `<select>`s in CSS.
'$input-border-radius' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$border-radius-base'
),
//** Large `.form-control` border radius
'$input-border-radius-large' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$border-radius-large'
),
//** Small `.form-control` border radius
'$input-border-radius-small' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$border-radius-small'
),

//** Border color for inputs on focus
'$input-border-focus' => array(
    'type' => 'color',
    'default' => '#66afe9'
),

//** Placeholder text color
'$input-color-placeholder' => array(
    'type' => 'color',
    'default' => '#999'
),

//** Default `.form-control` height
'$input-height-base' => array(
    'type' => 'range',
    'default' => '($line-height-computed + ($padding-base-vertical * 2) + 2)'
),
//** Large `.form-control` height
'$input-height-large' => array(
    'type' => 'range',
    'default' => '(ceil($font-size-large * $line-height-large) + ($padding-large-vertical * 2) + 2)'
),
//** Small `.form-control` height
'$input-height-small' => array(
    'type' => 'range',
    'default' => '(floor($font-size-small * $line-height-small) + ($padding-small-vertical * 2) + 2)'
),

//** `.form-group` margin
'$form-group-margin-bottom' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '15px'
),

'$legend-color' => array(
    'type' => 'color',
    'default' => '$gray-dark'
),
'$legend-border-color' => array(
    'type' => 'color',
    'default' => '#e5e5e5'
),

//** Background color for textual input addons
'$input-group-addon-bg' => array(
    'type' => 'color',
    'default' => '$gray-lighter'
),
//** Border color for textual input addons
'$input-group-addon-border-color' => array(
    'type' => 'color',
    'default' => '$input-border'
),

//** Disabled cursor for form controls and buttons.
'$cursor-disabled' => array(
    'default' => 'not-allowed'
),


//== Dropdowns
//
//## Dropdown menu container and contents.

//** Background for the dropdown menu.
'$dropdown-bg' => array(
    'type' => 'color',
    'default' => '#fff'
),
//** Dropdown menu `border-color`.
'$dropdown-border' => array(
    'type' => 'color',
    'default' => 'rgba(0,0,0,.15)'
),
//** Dropdown menu `border-color` **for IE8**.
'$dropdown-fallback-border' => array(
    'type' => 'color',
    'default' => '#ccc'
),
//** Divider color for between dropdown items.
'$dropdown-divider-bg' => array(
    'type' => 'color',
    'default' => '#e5e5e5'
),

//** Dropdown link text color.
'$dropdown-link-color' => array(
    'type' => 'color',
    'default' => '$gray-dark'
),
//** Hover color for dropdown links.
'$dropdown-link-hover-color' => array(
    'type' => 'color',
    'default' => 'darken($gray-dark, 5%)'
),
//** Hover background for dropdown links.
'$dropdown-link-hover-bg' => array(
    'type' => 'color',
    'default' => '#f5f5f5'
),

//** Active dropdown menu item text color.
'$dropdown-link-active-color' => array(
    'type' => 'color',
    'default' => '$component-active-color'
),
//** Active dropdown menu item background color.
'$dropdown-link-active-bg' => array(
    'type' => 'color',
    'default' => '$component-active-bg'
),

//** Disabled dropdown menu item background color.
'$dropdown-link-disabled-color' => array(
    'type' => 'color',
    'default' => '$gray-light'
),

//** Text color for headers within dropdown menus.
'$dropdown-header-color' => array(
    'type' => 'color',
    'default' => '$gray-light'
),

//** Deprecated `$dropdown-caret-color` as of v3.1.0
'$dropdown-caret-color' => array(
    'type' => 'color',
    'default' => '#000'
),



// of components dependent on the z-axis and are designed to all work together.
//


'$zindex-navbar' => array(
    'default' => '1000'
),
'$zindex-dropdown' => array(
    'default' => '1000'
),
'$zindex-popover' => array(
    'default' => '1060'
),
'$zindex-tooltip' => array(
    'default' => '1070'
),
'$zindex-navbar-fixed' => array(
    'default' => '1030'
),
'$zindex-modal-background' => array(
    'default' => '1040'
),
'$zindex-modal' => array(
    'default' => '1050'
),


//== Media queries breakpoints
//
//## Define the breakpoints at which your layout will change, adapting to different screen sizes.

// Extra small screen / phone
//** Deprecated `$screen-xs` as of v3.0.1
'$screen-xs' => array(
    'default' => '480px'
),
//** Deprecated `$screen-xs-min` as of v3.2.0
'$screen-xs-min' => array(
    'default' => '$screen-xs'
),
//** Deprecated `$screen-phone` as of v3.0.1
'$screen-phone' => array(
    'default' => '$screen-xs-min'
),

// Small screen / tablet
//** Deprecated `$screen-sm` as of v3.0.1
'$screen-sm' => array(
    'default' => '768px'
),
'$screen-sm-min' => array(
    'default' => '$screen-sm'
),
//** Deprecated `$screen-tablet` as of v3.0.1
'$screen-tablet' => array(
    'default' => '$screen-sm-min'
),

// Medium screen / desktop
//** Deprecated `$screen-md` as of v3.0.1
'$screen-md' => array(
    'default' => '992px'
),
'$screen-md-min' => array(
    'default' => '$screen-md'
),
//** Deprecated `$screen-desktop` as of v3.0.1
'$screen-desktop' => array(
    'default' => '$screen-md-min'
),

// Large screen / wide desktop
//** Deprecated `$screen-lg` as of v3.0.1
'$screen-lg' => array(
    'default' => '1200px'
),
'$screen-lg-min' => array(
    'default' => '$screen-lg'
),
//** Deprecated `$screen-lg-desktop` as of v3.0.1
'$screen-lg-desktop' => array(
    'default' => '$screen-lg-min'
),

// So media queries don't overlap when required, provide a maximum
'$screen-xs-max' => array(
    'default' => '($screen-sm-min - 1)'
),
'$screen-sm-max' => array(
    'default' => '($screen-md-min - 1)'
),
'$screen-md-max' => array(
    'default' => '($screen-lg-min - 1)'
),


//== Grid system
//
//## Define your custom responsive grid.

//** Number of columns in the grid.
'$grid-columns' => array(
    'default' => '12'
),
//** Padding between columns. Gets divided in half for the left and right.
'$grid-gutter-width' => array(
    'default' => '30px'
),
// Navbar collapse
//** Point at which the navbar becomes uncollapsed.
'$grid-float-breakpoint' => array(
    'default' => '$screen-sm-min'
),
//** Point at which the navbar begins collapsing.
'$grid-float-breakpoint-max' => array(
    'default' => '($grid-float-breakpoint - 1)'
),


//== Container sizes
//
//## Define the maximum width of `.container` for different screen sizes.

// Small screen / tablet
'$container-tablet' => array(
    'default' => '(720px + $grid-gutter-width)'
),
//** For `$screen-sm-min` and up.
'$container-sm' => array(
    'default' => '$container-tablet'
),

// Medium screen / desktop
'$container-desktop' => array(
    'default' => '(940px + $grid-gutter-width)'
),
//** For `$screen-md-min` and up.
'$container-md' => array(
    'default' => '$container-desktop'
),

// Large screen / wide desktop
'$container-large-desktop' => array(
    'default' => '(1140px + $grid-gutter-width)'
),
//** For `$screen-lg-min` and up.
'$container-lg' => array(
    'default' => '$container-large-desktop'
),


//== Navbar
//
//##

// Basics of a navbar
'$navbar-height' => array(
    'default' => '50px'
),
'$navbar-margin-bottom' => array(
    'default' => '$line-height-computed'
),
'$navbar-border-radius' => array(
    'default' => '$border-radius-base'
),
'$navbar-padding-horizontal' => array(
    'default' => 'floor(($grid-gutter-width / 2))'
),
'$navbar-padding-vertical' => array(
    'default' => '(($navbar-height - $line-height-computed) / 2)'
),
'$navbar-collapse-max-height' => array(
    'default' => '340px'
),

'$navbar-default-color' => array(
    'default' => '#777'
),
'$navbar-default-bg' => array(
    'default' => '#f8f8f8'
),
'$navbar-default-border' => array(
    'default' => 'darken($navbar-default-bg, 6.5%)'
),

// Navbar links
'$navbar-default-link-color' => array(
    'type' => 'color',
    'default' => '#777'
),
'$navbar-default-link-hover-color' => array(
    'type' => 'color',
    'default' => '#333'
),
'$navbar-default-link-hover-bg' => array(
    'type' => 'color',
    'default' => 'transparent'
),
'$navbar-default-link-active-color' => array(
    'type' => 'color',
    'default' => '#555'
),
'$navbar-default-link-active-bg' => array(
    'type' => 'color',
    'default' => 'darken($navbar-default-bg, 6.5%)'
),
'$navbar-default-link-disabled-color' => array(
    'type' => 'color',
    'default' => '#ccc'
),
'$navbar-default-link-disabled-bg' => array(
    'type' => 'color',
    'default' => 'transparent'
),

// Navbar brand label
'$navbar-default-brand-color' => array(
    'type' => 'color',
    'default' => '$navbar-default-link-color'
),
'$navbar-default-brand-hover-color' => array(
    'type' => 'color',
    'default' => 'darken($navbar-default-brand-color, 10%)'
),
'$navbar-default-brand-hover-bg' => array(
    'type' => 'color',
    'default' => 'transparent'
),

// Navbar toggle
'$navbar-default-toggle-hover-bg' => array(
    'type' => 'color',
    'default' => '#ddd'
),
'$navbar-default-toggle-icon-bar-bg' => array(
    'type' => 'color',
    'default' => '#888'
),
'$navbar-default-toggle-border-color' => array(
    'type' => 'color',
    'default' => '#ddd'
),


//=== Inverted navbar
// Reset inverted navbar basics
'$navbar-inverse-color' => array(
    'type' => 'color',
    'default' => 'lighten($gray-light, 15%)'
),
'$navbar-inverse-bg' => array(
    'type' => 'color',
    'default' => ' #222'
),
'$navbar-inverse-border' => array(
    'type' => 'color',
    'default' => 'darken($navbar-inverse-bg, 10%)'
),

// Inverted navbar links
'$navbar-inverse-link-color' => array(
    'type' => 'color',
    'default' => 'lighten($gray-light, 15%)'
),
'$navbar-inverse-link-hover-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$navbar-inverse-link-hover-bg' => array(
    'type' => 'color',
    'default' => 'transparent'
),
'$navbar-inverse-link-active-color' => array(
    'type' => 'color',
    'default' => '$navbar-inverse-link-hover-color'
),
'$navbar-inverse-link-active-bg' => array(
    'type' => 'color',
    'default' => 'darken($navbar-inverse-bg, 10%)'
),
'$navbar-inverse-link-disabled-color' => array(
    'type' => 'color',
    'default' => '#444'
),
'$navbar-inverse-link-disabled-bg' => array(
    'type' => 'color',
    'default' => 'transparent'
),

// Inverted navbar brand label
'$navbar-inverse-brand-color' => array(
    'type' => 'color',
    'default' => '$navbar-inverse-link-color'
),
'$navbar-inverse-brand-hover-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$navbar-inverse-brand-hover-bg' => array(
    'type' => 'color',
    'default' => 'transparent'
),

// Inverted navbar toggle
'$navbar-inverse-toggle-hover-bg' => array(
    'type' => 'color',
    'default' => '#333'
),
'$navbar-inverse-toggle-icon-bar-bg' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$navbar-inverse-toggle-border-color' => array(
    'type' => 'color',
    'default' => '#333'
),


//== Navs
//
//##

//=== Shared nav styles
'$nav-link-padding' => array(
    'default' => '  10px 15px'
),
'$nav-link-hover-bg' => array(
    'type' => 'color',
    'default' => ' $gray-lighter'
),

'$nav-disabled-link-color' => array(
    'type' => 'color',
    'default' => '$gray-light'
),
'$nav-disabled-link-hover-color' => array(
    'type' => 'color',
    'default' => '$gray-light'
),

//== Tabs
'$nav-tabs-border-color' => array(
    'type' => 'color',
    'default' => '#ddd'
),

'$nav-tabs-link-hover-border-color' => array(
    'type' => 'color',
    'default' => '$gray-lighter'
),

'$nav-tabs-active-link-hover-bg' => array(
    'type' => 'color',
    'default' => '$body-bg'
),
'$nav-tabs-active-link-hover-color' => array(
    'type' => 'color',
    'default' => '$gray'
),
'$nav-tabs-active-link-hover-border-color' => array(
    'type' => 'color',
    'default' => '#ddd'
),

'$nav-tabs-justified-link-border-color' => array(
    'type' => 'color',
    'default' => '#ddd'
),
'$nav-tabs-justified-active-link-border-color' => array(
    'type' => 'color',
    'default' => '$body-bg'
),

//== Pills
'$nav-pills-border-radius' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$border-radius-base'
),
'$nav-pills-active-link-hover-bg' => array(
    'type' => 'color',
    'default' => '$component-active-bg'
),
'$nav-pills-active-link-hover-color' => array(
    'type' => 'color',
    'default' => '$component-active-color'
),


//== Pagination
//
//##

'$pagination-color' => array(
    'type' => 'color',
    'default' => '$link-color'
),
'$pagination-bg' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$pagination-border' => array(
    'type' => 'color',
    'default' => '#ddd'
),

'$pagination-hover-color' => array(
    'type' => 'color',
    'default' => '$link-hover-color'
),
'$pagination-hover-bg' => array(
    'type' => 'color',
    'default' => '$gray-lighter'
),
'$pagination-hover-border' => array(
    'type' => 'color',
    'default' => '#ddd'
),

'$pagination-active-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$pagination-active-bg' => array(
    'type' => 'color',
    'default' => '$brand-primary'
),
'$pagination-active-border' => array(
    'type' => 'color',
    'default' => '$brand-primary'
),

'$pagination-disabled-color' => array(
    'type' => 'color',
    'default' => '$gray-light'
),
'$pagination-disabled-bg' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$pagination-disabled-border' => array(
    'type' => 'color',
    'default' => '#ddd'
),


//== Pager
//
//##

'$pager-bg' => array(
    'type' => 'color',
    'default' => '$pagination-bg'
),
'$pager-border' => array(
    'type' => 'color',
    'default' => '$pagination-border'
),
'$pager-border-radius' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '15px'
),

'$pager-hover-bg' => array(
    'type' => 'color',
    'default' => '$pagination-hover-bg'
),

'$pager-active-bg' => array(
    'type' => 'color',
    'default' => '$pagination-active-bg'
),
'$pager-active-color' => array(
    'type' => 'color',
    'default' => '$pagination-active-color'
),

'$pager-disabled-color' => array(
    'type' => 'color',
    'default' => '$pagination-disabled-color'
),


//== Jumbotron
//
//##

'$jumbotron-padding' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '30px'
),
'$jumbotron-color' => array(
    'type' => 'color',
    'default' => 'inherit'
),
'$jumbotron-bg' => array(
    'type' => 'color',
    'default' => '$gray-lighter'
),
'$jumbotron-heading-color' => array(
    'type' => 'color',
    'default' => 'inherit'
),
'$jumbotron-font-size' => array(
    'type' => 'range',
    'default' => 'ceil(($font-size-base * 1.5))'
),
'$jumbotron-heading-font-size' => array(
    'type' => 'range',
    'default' => 'ceil(($font-size-base * 4.5))'
),


//== Form states and alerts
//
//## Define colors for form feedback states and, by default, alerts.

'$state-success-text' => array(
    'type' => 'color',
    'default' => '#3c763d'
),
'$state-success-bg' => array(
    'type' => 'color',
    'default' => '#dff0d8'
),
'$state-success-border' => array(
    'type' => 'color',
    'default' => 'darken(adjust-hue($state-success-bg, -10), 5%)'
),

'$state-info-text' => array(
    'type' => 'color',
    'default' => '#31708f'
),
'$state-info-bg' => array(
    'type' => 'color',
    'default' => '#d9edf7'
),
'$state-info-border' => array(
    'type' => 'color',
    'default' => 'darken(adjust-hue($state-info-bg, -10), 7%)'
),

'$state-warning-text' => array(
    'type' => 'color',
    'default' => '#8a6d3b'
),
'$state-warning-bg' => array(
    'type' => 'color',
    'default' => '#fcf8e3'
),
'$state-warning-border' => array(
    'type' => 'color',
    'default' => 'darken(adjust-hue($state-warning-bg, -10), 5%)'
),

'$state-danger-text' => array(
    'type' => 'color',
    'default' => '#a94442'
),
'$state-danger-bg' => array(
    'type' => 'color',
    'default' => '#f2dede'
),
'$state-danger-border' => array(
    'type' => 'color',
    'default' => 'darken(adjust-hue($state-danger-bg, -10), 5%)'
),


//== Tooltips
//
//##

//** Tooltip max width
'$tooltip-max-width' => array(
    'type' => 'range',
    'suffix' =>'px',
    'default' => '200px'
),
//** Tooltip text color
'$tooltip-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
//** Tooltip background color
'$tooltip-bg' => array(
    'type' => 'color',
    'default' => '#000'
),
'$tooltip-opacity' => array(
    'type' => 'range',
    'steps' => '.1'
    'default' => '.9'
),

//** Tooltip arrow width
'$tooltip-arrow-width' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '5px'
),
//** Tooltip arrow color
'$tooltip-arrow-color' => array(
    'type' => 'color',
    'default' => '$tooltip-bg'
),


//== Popovers
//
//##

//** Popover body background color
'$popover-bg' => array(
    'type' => 'color',
    'default' => '  #fff'
),
//** Popover maximum width
'$popover-max-width' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '276px'
),
//** Popover border color
'$popover-border-color' => array(
    'type' => 'color',
    'default' => 'rgba(0,0,0,.2)'
),
//** Popover fallback border color
'$popover-fallback-border-color' => array(
    'type' => 'color',
    'default' => '#ccc'
),

//** Popover title background color
'$popover-title-bg' => array(
    'type' => 'color',
    'default' => 'darken($popover-bg, 3%)'
),

//** Popover arrow width
'$popover-arrow-width' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '10px'
),
//** Popover arrow color
'$popover-arrow-color' => array(
    'type' => 'color',
    'default' => '$popover-bg'
),

//** Popover outer arrow width
'$popover-arrow-outer-width' => array(
    'default' => '($popover-arrow-width + 1)'
),
//** Popover outer arrow color
'$popover-arrow-outer-color' => array(
    'type' => 'color',
    'default' => 'fade_in($popover-border-color, 0.05)'
),
//** Popover outer arrow fallback color
'$popover-arrow-outer-fallback-color' => array(
    'type' => 'color',
    'default' => 'darken($popover-fallback-border-color, 20%)'
),


//== Labels
//
//##

//** Default label background color
'$label-default-bg' => array(
    'type' => 'color',
    'default' => '$gray-light'
),
//** Primary label background color
'$label-primary-bg' => array(
    'type' => 'color',
    'default' => '$brand-primary'
),
//** Success label background color
'$label-success-bg' => array(
    'type' => 'color',
    'default' => '$brand-success'
),
//** Info label background color
'$label-info-bg' => array(
    'type' => 'color',
    'default' => '$brand-info'
),
//** Warning label background color
'$label-warning-bg' => array(
    'type' => 'color',
    'default' => '$brand-warning'
),
//** Danger label background color
'$label-danger-bg' => array(
    'type' => 'color',
    'default' => '$brand-danger'
),

//** Default label text color
'$label-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
//** Default text color of a linked label
'$label-link-hover-color' => array(
    'type' => 'color',
    'default' => '#fff'
),


//== Modals
//
//##

//** Padding applied to the modal body
'$modal-inner-padding' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '15px'
),

//** Padding applied to the modal title
'$modal-title-padding' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '15px'
),
//** Modal title line-height
'$modal-title-line-height' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$line-height-base'
),

//** Background color of modal content area
'$modal-content-bg' => array(
    'type' => 'color',
    'default' => '#fff'
),
//** Modal content border color
'$modal-content-border-color' => array(
    'type' => 'color',
    'default' => 'rgba(0,0,0,.2)'
),
//** Modal content border color **for IE8**
'$modal-content-fallback-border-color' => array(
    'type' => 'color',
    'default' => '#999'
),

//** Modal backdrop background color
'$modal-backdrop-bg' => array(
    'type' => 'color',
    'default' => '#000'
),
//** Modal backdrop opacity
'$modal-backdrop-opacity' => array(
    'type' => 'range',
    'steps' => '.1',
    'default' => '.5'
),
//** Modal header border color
'$modal-header-border-color' => array(
    'type' => 'color',
    'default' => '#e5e5e5'
),
//** Modal footer border color
'$modal-footer-border-color' => array(
    'type' => 'color',
    'default' => '$modal-header-border-color'
),

'$modal-lg' => array(
    'default' => '900px'
),
'$modal-md' => array(
    'default' => '600px'
),
'$modal-sm' => array(
    'default' => '300px'
),


//== Alerts
//
//## Define alert colors, border radius, and padding.

'$alert-padding' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '15px'
),
'$alert-border-radius' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$border-radius-base'
),
'$alert-link-font-weight' => array(
    'type' => 'select',
    'choice' => array(
        '100' => '100',
        '200' => '200',
        '300' => '300',
        '400' => '400 (normal)',
        '500' => '500',
        '600' => '600',
        '700' => '700 (bold)',
        '800' => '800',
        '900' => '900',
    ),
    'default' => 'bold'
),

'$alert-success-bg' => array(
    'type' => 'color',
    'default' => '$state-success-bg'
),
'$alert-success-text' => array(
    'type' => 'color',
    'default' => '$state-success-text'
),
'$alert-success-border' => array(
    'type' => 'color',
    'default' => '$state-success-border'
),

'$alert-info-bg' => array(
    'type' => 'color',
    'default' => '$state-info-bg'
),
'$alert-info-text' => array(
    'type' => 'color',
    'default' => '$state-info-text'
),
'$alert-info-border' => array(
    'type' => 'color',
    'default' => '$state-info-border'
),

'$alert-warning-bg' => array(
    'type' => 'color',
    'default' => '$state-warning-bg'
),
'$alert-warning-text' => array(
    'type' => 'color',
    'default' => '$state-warning-text'
),
'$alert-warning-border' => array(
    'type' => 'color',
    'default' => '$state-warning-border'
),

'$alert-danger-bg' => array(
    'type' => 'color',
    'default' => '$state-danger-bg'
),
'$alert-danger-text' => array(
    'type' => 'color',
    'default' => '$state-danger-text'
),
'$alert-danger-border' => array(
    'type' => 'color',
    'default' => '$state-danger-border'
),


//== Progress bars
//
//##

//** Background color of the whole progress component
'$progress-bg' => array(
    'type' => 'color',
    'default' => '#f5f5f5'
),
//** Progress bar text color
'$progress-bar-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
//** Variable for setting rounded corners on progress bar.
'$progress-border-radius' => array(
    'type' => 'color',
    'default' => '$border-radius-base'
),

//** Default progress bar color
'$progress-bar-bg' => array(
    'type' => 'color',
    'default' => '$brand-primary'
),
//** Success progress bar color
'$progress-bar-success-bg' => array(
    'type' => 'color',
    'default' => '$brand-success'
),
//** Warning progress bar color
'$progress-bar-warning-bg' => array(
    'type' => 'color',
    'default' => '$brand-warning'
),
//** Danger progress bar color
'$progress-bar-danger-bg' => array(
    'type' => 'color',
    'default' => '$brand-danger'
),
//** Info progress bar color
'$progress-bar-info-bg' => array(
    'type' => 'color',
    'default' => '$brand-info'
),


//== List group
//
//##

//** Background color on `.list-group-item`
'$list-group-bg' => array(
    'type' => 'color',
    'default' => '#fff'
),
//** `.list-group-item` border color
'$list-group-border' => array(
    'type' => 'color',
    'default' => '#ddd'
),
//** List group border radius
'$list-group-border-radius' => array(
    'type' => 'color',
    'default' => '$border-radius-base'
),

//** Background color of single list items on hover
'$list-group-hover-bg' => array(
    'type' => 'color',
    'default' => '#f5f5f5'
),
//** Text color of active list items
'$list-group-active-color' => array(
    'type' => 'color',
    'default' => '$component-active-color'
),
//** Background color of active list items
'$list-group-active-bg' => array(
    'type' => 'color',
    'default' => '$component-active-bg'
),
//** Border color of active list elements
'$list-group-active-border' => array(
    'type' => 'color',
    'default' => '$list-group-active-bg'
),
//** Text color for content within active list items
'$list-group-active-text-color' => array(
    'type' => 'color',
    'default' => 'lighten($list-group-active-bg, 40%)'
),

//** Text color of disabled list items
'$list-group-disabled-color' => array(
    'type' => 'color',
    'default' => '$gray-light'
),
//** Background color of disabled list items
'$list-group-disabled-bg' => array(
    'type' => 'color',
    'default' => '$gray-lighter'
),
//** Text color for content within disabled list items
'$list-group-disabled-text-color' => array(
    'type' => 'color',
    'default' => '$list-group-disabled-color'
),

'$list-group-link-color' => array(
    'type' => 'color',
    'default' => '#555'
),
'$list-group-link-hover-color' => array(
    'type' => 'color',
    'default' => '$list-group-link-color'
),
'$list-group-link-heading-color' => array(
    'type' => 'color',
    'default' => '#333'
),


//== Panels
//
//##

'$panel-bg' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$panel-body-padding' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '15px'
),
'$panel-heading-padding' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '10px 15px'
),
'$panel-footer-padding' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$panel-heading-padding'
),
'$panel-border-radius' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$border-radius-base'
),

//** Border color for elements within panels
'$panel-inner-border' => array(
    'type' => 'color',
    'default' => '#ddd'
),
'$panel-footer-bg' => array(
    'type' => 'color',
    'default' => '#f5f5f5'
),

'$panel-default-text' => array(
    'type' => 'color',
    'default' => '$gray-dark'
),
'$panel-default-border' => array(
    'type' => 'color',
    'default' => '#ddd'
),
'$panel-default-heading-bg' => array(
    'type' => 'color',
    'default' => '#f5f5f5'
),

'$panel-primary-text' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$panel-primary-border' => array(
    'type' => 'color',
    'default' => '$brand-primary'
),
'$panel-primary-heading-bg' => array(
    'type' => 'color',
    'default' => '$brand-primary'
),

'$panel-success-text' => array(
    'type' => 'color',
    'default' => '$state-success-text'
),
'$panel-success-border' => array(
    'type' => 'color',
    'default' => '$state-success-border'
),
'$panel-success-heading-bg' => array(
    'type' => 'color',
    'default' => '$state-success-bg'
),

'$panel-info-text' => array(
    'type' => 'color',
    'default' => '$state-info-text'
),
'$panel-info-border' => array(
    'type' => 'color',
    'default' => '$state-info-border'
),
'$panel-info-heading-bg' => array(
    'type' => 'color',
    'default' => '$state-info-bg'
),

'$panel-warning-text' => array(
    'type' => 'color',
    'default' => '$state-warning-text'
),
'$panel-warning-border' => array(
    'type' => 'color',
    'default' => '$state-warning-border'
),
'$panel-warning-heading-bg' => array(
    'type' => 'color',
    'default' => '$state-warning-bg'
),

'$panel-danger-text' => array(
    'type' => 'color',
    'default' => '$state-danger-text'
),
'$panel-danger-border' => array(
    'type' => 'color',
    'default' => '$state-danger-border'
),
'$panel-danger-heading-bg' => array(
    'type' => 'color',
    'default' => '$state-danger-bg'
),


//== Thumbnails
//
//##

//** Padding around the thumbnail image
'$thumbnail-padding' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '4px'
),
//** Thumbnail background color
'$thumbnail-bg' => array(
    'type' => 'color',
    'default' => '$body-bg'
),
//** Thumbnail border color
'$thumbnail-border' => array(
    'type' => 'color',
    'default' => '#ddd'
),
//** Thumbnail border radius
'$thumbnail-border-radius' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '$border-radius-base'
),

//** Custom text color for thumbnail captions
'$thumbnail-caption-color' => array(
    'type' => 'color',
    'default' => '$text-color'
),
//** Padding around the thumbnail caption
'$thumbnail-caption-padding' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '9px'
),


//== Wells
//
//##

'$well-bg' => array(
    'type' => 'color',
    'default' => '#f5f5f5'
),
'$well-border' => array(
    'type' => 'color',
    'default' => 'darken($well-bg, 7%)'
),


//== Badges
//
//##

'$badge-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
//** Linked badge text color on hover
'$badge-link-hover-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$badge-bg' => array(
    'type' => 'color',
    'default' => '$gray-light'
),

//** Badge text color in active nav link
'$badge-active-color' => array(
    'type' => 'color',
    'default' => '$link-color'
),
//** Badge background color in active nav link
'$badge-active-bg' => array(
    'type' => 'color',
    'default' => '#fff'
),

'$badge-font-weight' => array(
    'type' => 'select',
    'choice' => array(
        '100' => '100',
        '200' => '200',
        '300' => '300',
        '400' => '400 (normal)',
        '500' => '500',
        '600' => '600',
        '700' => '700 (bold)',
        '800' => '800',
        '900' => '900',
    ),
    'default' => 'bold'
),
'$badge-line-height' => array(
    'default' => '1'
),
'$badge-border-radius' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '10px'
),


//== Breadcrumbs
//
//##

'$breadcrumb-padding-vertical' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '8px'
),
'$breadcrumb-padding-horizontal' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '15px'
),
//** Breadcrumb background color
'$breadcrumb-bg' => array(
    'type' => 'color',
    'default' => '#f5f5f5'
),
//** Breadcrumb text color
'$breadcrumb-color' => array(
    'type' => 'color',
    'default' => '#ccc'
),
//** Text color of current page in the breadcrumb
'$breadcrumb-active-color' => array(
    'type' => 'color',
    'default' => '$gray-light'
),
//** Textual separator for between breadcrumb elements
'$breadcrumb-separator' => array(
    'default' => '"/"'
),


//== Carousel
//
//##

'$carousel-text-shadow' => array(
    'type' => 'color',
    'default' => '0 1px 2px rgba(0,0,0,.6)'
),

'$carousel-control-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$carousel-control-width' => array(
    'default' => '15%'
),
'$carousel-control-opacity' => array(
    'type' => 'range',
    'steps' => '.1',
    'default' => '.5'
),
'$carousel-control-font-size' => array(
    'type' => 'range',
    'suffix' => 'px',
    'default' => '20px'
),

'$carousel-indicator-active-bg' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$carousel-indicator-border-color' => array(
    'type' => 'color',
    'default' => '#fff'
),

'$carousel-caption-color' => array(
    'type' => 'color',
    'default' => '#fff'
),


//== Close
//
//##

'$close-font-weight' => array(
    'type' => 'select',
    'choice' => array(
        '100' => '100',
        '200' => '200',
        '300' => '300',
        '400' => '400 (normal)',
        '500' => '500',
        '600' => '600',
        '700' => '700 (bold)',
        '800' => '800',
        '900' => '900',
    ),
    'default' => 'bold'
),
'$close-color' => array(
    'type' => 'color',
    'default' => '#000'
),
'$close-text-shadow' => array(
    'default' => '0 1px 0 #fff'
),


//== Code
//
//##

'$code-color' => array(
    'type' => 'color',
    'default' => '#c7254e'
),
'$code-bg' => array(
    'type' => 'color',
    'default' => '#f9f2f4'
),

'$kbd-color' => array(
    'type' => 'color',
    'default' => '#fff'
),
'$kbd-bg' => array(
    'type' => 'color',
    'default' => '#333'
),

'$pre-bg' => array(
    'type' => 'color',
    'default' => '#f5f5f5'
),
'$pre-color' => array(
    'type' => 'color',
    'default' => '$gray-dark'
),
'$pre-border-color' => array(
    'type' => 'color',
    'default' => '#ccc'
),
'$pre-scrollable-max-height' => array(
    'default' => '340px'
),


//== Type
//
//##

//** Horizontal offset for forms and lists.
'$component-offset-horizontal' => array(
    'default' => '180px'
),
//** Text muted color
'$text-muted' => array(
    'type' => 'color',
    'default' => '$gray-light'
),
//** Abbreviations and acronyms border color
'$abbr-border-color' => array(
    'type' => 'color',
    'default' => '$gray-light'
),
//** Headings small color
'$headings-small-color' => array(
    'type' => 'color',
    'default' => '$gray-light'
),
//** Blockquote small color
'$blockquote-small-color' => array(
    'type' => 'color',
    'default' => '$gray-light'
),
//** Blockquote font size
'$blockquote-font-size' => array(
    'default' => '($font-size-base * 1.25)'
),
//** Blockquote border color
'$blockquote-border-color' => array(
    'type' => 'color',
    'default' => '$gray-lighter'
),
//** Page header border color
'$page-header-border-color' => array(
    'type' => 'color',
    'default' => '$gray-lighter'
),
//** Width of horizontal description list titles
'$dl-horizontal-offset' => array(
    'default' => '$component-offset-horizontal'
),
//** Point at which .dl-horizontal becomes horizontal
'$dl-horizontal-breakpoint' => array(
    'default' => '$grid-float-breakpoint'
),
//** Horizontal line color.
'$hr-border' => array(
    'type' => 'color',
    'default' => '$gray-lighter'
),
