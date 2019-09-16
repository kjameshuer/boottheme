<?php
function register_boot_sidebars()
{
    register_sidebar(array(
        'name'          => __('Shop Sidebar', 'boot'),
        'id'            => 'sidebar-shop',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'register_boot_sidebars');
