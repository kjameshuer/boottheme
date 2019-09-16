<?php
add_action('woocommerce_product_query', 'boot_product_query');

function boot_product_query($q)
{
    if (isset($_POST['cat_submitted']) && isset($_POST['category'])) {
        $catString = '';
        foreach ($_POST['category'] as $category) {
            $catString .= $category . ',';
        }
        $q->set('product_cat', $catString);
    }
}