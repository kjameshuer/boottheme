<?php

//ACTIONS

// ADD THEME SUPPORT | REGISTER MENUS
function boot_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('article-card', 300, 240, true);

    register_nav_menu('header-menu', 'Header Menu');
}
add_action('after_setup_theme', 'boot_setup');

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


//FILTERS

// NAV MENU FILTER FOR MAIN MENU --------

function boot_menu_item_class($classes, $item, $args, $depth)
{
    if ($args->theme_location == 'header-menu') {
        $classes[] = 'nav-item'; // add classes
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'boot_menu_item_class', 10, 4);

function special_nav_class($classes, $item)
{
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active ';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

function atg_menu_classes($classes, $item, $args)
{
    if ($args->theme_location == 'header-menu') {
        $classes[] = 'nav-link';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'atg_menu_classes', 1, 3);

function add_menuclass($ulclass)
{
    return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
}
add_filter('wp_nav_menu', 'add_menuclass');

//----------------------------------------------------------------
