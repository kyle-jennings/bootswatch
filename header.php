<?php bootswatches_template_settings(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<a class="skipnav" href="#primary">
    <?php esc_html_e('Skip to main content', 'bootswatches'); ?>
</a>


<?php
    bootswatches_the_header();
?>


<div class="overlay"></div>

<div id="page-wrapper" class="page-wrapper">