<?php


/**
 * Adds a submenu item to the "appearance" menu and links to an about page
 */
function bootswatches_about_theme_menu_items() {
    add_theme_page(
        'About Bootswatches',
        'About Bootswatches',
        'manage_options',
        'about-bootswatches',
        'bootswatches_about_theme_page' 
    ); 
}
add_action( 'admin_menu', 'bootswatches_about_theme_menu_items' );



/**
 * The content about the "about bootswatches" page
 */
function bootswatches_about_theme_page() {
    ?>
    <div class="wrap">
        <h2><?php echo esc_html__('Welcome to Bootswatches', 'bootswatches'); ?></h2>
        
        <?php if(!function_exists('bootswatches_about_intro')) : ?>
        <p>
            <?php 
            echo esc_html__('Bootswatches is a flexible and feature rich WordPess theme built with The United States Digital Services','bootswatches') .
            ' <a href="https://standards.usa.gov" target="_blank">' . esc_html__('Web Design Standards','bootswatches') . '</a>, ';
            echo esc_html__('by WordPress developer ', 'bootswatches') . 
            '<a href="https://www.kylejennings.codes" target="_blank">' . esc_html__('Kyle Jennings', 'bootswatches') . '</a>';
            ?>

        </p>
        <?php endif; ?>
        
        <?php 
            if(!function_exists('bootswatches_plugin_advert')){
                echo bootswatches_get_franklin_advert(); // WPCS: xss ok.
            }
        ?>

        <?php if(!function_exists('bootswatches_feature_info')) : ?>
        <h2><?php echo esc_html__('Customize your site', 'bootswatches'); ?></h2>
        <p><?php echo esc_html__('Use WordPress\'s Customizer to preview changes to your site\'s settings in real time. 
        Configure every part of your site\'s layout, how the homepage acts, your 404 page, your header 
        and footer, and so much more. With the Customizer, you can personalize your site and really make it yours.','bootswatches');?>
        </p>
        <ul>
            <li>
                <span class="dashicons dashicons-art"></span>
                <?php echo esc_html__('Choose from 2 color schemes','bootswatches'); ?>
            </li>
            <li>
                <span class="dashicons dashicons-welcome-widgets-menus"></span>
                <?php echo esc_html__('Customizable layout settings', 'bootswatches'); ?>
            </li>
            <li>
                <span class="dashicons dashicons-id-alt"></span>
                <?php echo esc_html__('Template specific layout settings', 'bootswatches'); ?>
            </li>
            <li>
                <span class="dashicons dashicons-layout"></span>
                <?php echo esc_html__('Sortable Pages', 'bootswatches'); ?>
            </li>
            <li>
                <span class="dashicons dashicons-admin-post"></span>
                <?php echo esc_html__('Feed Featured Posts', 'bootswatches'); ?>
            </li>
            <li>
                <span class="dashicons dashicons-admin-generic"></span>
                <?php echo esc_html__('Header Settings & Footer Settings', 'bootswatches'); ?>
            </li>
            <li><?php echo esc_html__('And more', 'bootswatches'); ?></li>
        </ul>


        <h2><?php echo esc_html__('Get Started', 'bootswatches'); ?></h2>
        <a class="button button-primary button-hero load-customize hide-if-no-customize" 
            href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php echo esc_html__('Customize your site', 'bootswatches'); ?></a>

        <?php endif; ?>
    </div>
    <?php
}

