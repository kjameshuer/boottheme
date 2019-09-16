<?php
add_action('wp_ajax_myfilter', 'misha_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_myfilter', 'misha_filter_function');

function misha_filter_function()
{

    $catString = '';
    foreach ($_POST['category'] as $category) {
        $catString .= $category . ',';
    }
    
    $query = new WP_Query(array(
        'product_cat' => $catString
    ));

    while ($query->have_posts()) : $query->the_post();
        wc_get_template_part('content', 'product');
    endwhile;
    wp_reset_postdata();
    die();
}
