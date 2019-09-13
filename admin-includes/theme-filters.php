<?php
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

