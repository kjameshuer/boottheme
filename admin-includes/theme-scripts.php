<?php
// LOAD STYLE AND SCRIPTS
function boot_custom_scripts()
{
    //styles
    wp_enqueue_style('fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('style',  get_stylesheet_uri());
    //scripts
    wp_enqueue_script('bundle', get_stylesheet_directory_uri() . '/dist/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'boot_custom_scripts');
