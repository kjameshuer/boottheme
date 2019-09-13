<?php
// ADD THEME SUPPORT | REGISTER MENUS
function boot_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => __('Primary', 'bootandberg'),
                'slug'  => 'primary',
                'color' => '#0f2d3c',
            ),
            array(
                'name'  => __('Secondary', 'bootandberg'),
                'slug'  => 'secondary',
                'color' => '#2aa198',
            ),
            array(
                'name'  => __('Dark Gray', 'bootandberg'),
                'slug'  => 'dark-gray',
                'color' => '#111',
            ),
            array(
                'name'  => __('Light Gray', 'bootandberg'),
                'slug'  => 'light-gray',
                'color' => '#767676',
            ),
            array(
                'name'  => __('White', 'bootandberg'),
                'slug'  => 'white',
                'color' => '#FFF',
            ),
        )
    );

    load_theme_textdomain('bootandberg');

    add_image_size('article-card', 300, 240, true);
    add_image_size('related-card', 100, 150, true);
    add_image_size('product-search-result', 70, 70, true);

    register_nav_menu('header-menu', 'Header Menu');
    register_nav_menu('topbar-menu', 'Top Bar Menu');

    add_editor_style('style-editor.css');
}
add_action('after_setup_theme', 'boot_setup');
