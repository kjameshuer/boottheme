<?php

// WIDGETS

function boot_widgets_init()
{
    register_sidebar(array(
        'name'          => 'Footer 1',
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-widget footer-widget-1">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));
    register_sidebar(array(
        'name'          => 'Footer 2',
        'id'            => 'footer-2',
        'before_widget' => '<div class="footer-widget footer-widget-2">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));
    register_sidebar(array(
        'name'          => 'Footer 3',
        'id'            => 'footer-3',
        'before_widget' => '<div class="footer-widget footer-widget-1">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'boot_widgets_init');
