<?php
// ADD THEME SUPPORT | REGISTER MENUS
function boot_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('article-card', 300, 240, true);

    register_nav_menu('header-menu', 'Header Menu');
    register_nav_menu('topbar-menu', 'Top Bar Menu');
}
add_action('after_setup_theme', 'boot_setup');
