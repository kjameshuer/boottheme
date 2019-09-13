<?php
// LOAD STYLE AND SCRIPTS
function boot_custom_scripts()
{
    //styles
    wp_enqueue_style('fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('style',  get_stylesheet_uri());
    //scripts
    wp_enqueue_script('bundle', get_stylesheet_directory_uri() . '/dist/main.js', array('jquery'), null, true);
    wp_localize_script('bundle', 'siteData', array(
        'site_url' => get_site_url(),
        'small_product_placeholder_url' => get_theme_file_uri('/images/product-placeholder-small.png')
    ));
}
add_action('wp_enqueue_scripts', 'boot_custom_scripts');
