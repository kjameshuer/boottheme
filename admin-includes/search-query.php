<?php

function register_search()
{
    register_rest_route(
        'boot/v1',
        'search',
        array(
            'methods' => WP_REST_SERVER::READABLE,
            'callback' => 'search_results'
        )
    );
}

add_action('rest_api_init', 'register_search');

function search_results($data)
{
    $cleanSearchTerm = sanitize_text_field($data['term']);

    $searchQueryArgs = array(
        'post_type' => array('post', 'page', 'product'),
        's' => $cleanSearchTerm

    );
    $searchQuery = new WP_Query($searchQueryArgs);

    $results = array(
        'post' => array(),
        'page' => array(),
        'product' => array()
    );

    while ($searchQuery->have_posts()) {

        $searchQuery->the_post();
        $post_type = get_post_type();

        $searchQueryData = array(
            'title' => get_the_title(),
            'link' => get_the_permalink(),
            'post_type' => $post_type,
            'featured_image' => get_the_post_thumbnail_url(0, 'product-search-result'),
            'id' => get_the_id(),
            'author_name' => get_the_author()
        );

        if ($post_type == 'product') :
            $product = wc_get_product(get_the_ID());
            $searchQueryData['reg_price'] = $product->get_regular_price();
            $searchQueryData['sale_price'] = $product->get_sale_price();
            $searchQueryData['price'] = $product->get_price();

        endif;

        array_push($results[$post_type], $searchQueryData);
    }
    wp_reset_postdata();

    $relatedProductArgs = array(
        'post_type' => 'product',
        'tax_query'      => array(
            'relation'   => 'OR',
            array(
                'taxonomy'  => 'product_tag',
                'field'     => 'slug',
                'terms'     => $cleanSearchTerm,
            ),
            array(
                'taxonomy'  => 'product_cat',
                'field'     => 'slug',
                'terms'     => $cleanSearchTerm,
            )
        )
    );

    $relatedProductsQuery = new WP_Query($relatedProductArgs);

    while ($relatedProductsQuery->have_posts()) :
        $relatedProductsQuery->the_post();
        $product = wc_get_product(get_the_ID());
        $relatedProductQueryData = array(
            'title' => get_the_title(),
            'link' => get_the_permalink(),
            'post_type' => $post_type,
            'featured_image' => get_the_post_thumbnail_url(0, 'product-search-result'),
            'id' => get_the_id(),
            'reg_price' => $product->get_regular_price(),
            'sale_price' => $product->get_sale_price(),
            'price' => $product->get_price()
        );
        array_push($results['product'], $relatedProductQueryData);
    endwhile;
    wp_reset_postdata();

    $results['product'] = array_values(array_unique($results['product'], SORT_REGULAR));

    return $results;
}
