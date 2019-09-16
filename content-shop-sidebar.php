

<div class="accordion" id="shop-sidebar-accordion">

<?php
$categories = get_categories(array(
    'taxonomy' => 'product_cat',
    'orderby' => 'name',
    'hierarchical' => 1,
    'post_type' => 'product'
));
$catList = '';
foreach ($categories as $category) {
    $checked = '';
    if (isset($_POST['category']) && in_array($category->name,$_POST['category'])){

        $checked = ' checked';
    }

    $catList .= '<label>';
    $catList .= '<input 
        class="category_checkbox" 
        type="checkbox"
        data-catID="' . $category->cat_ID . '"
        name="category[]" 
        value="' . esc_attr($category->name) . '" '. $checked .'>' . esc_html($category->name) . '</label>';   
    
}

?>

<div class="shop__sidebar">


    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h4>Categories</h4>
                </button>
            </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#shop-sidebar-accordion">
            <div class="card-body">
                <div class="category_select">
                <form method="post" action="<?php the_permalink();?>" name="category_filter" id="category_filter">
                    <?php echo $catList; ?>
                    <input type="hidden" name="cat_submitted" id="submitted" value="true" />
                    <input type="hidden" name="action" value="myfilter">
                    <input type="submit" class="btn" />
                </form>
                </div>

            </div>
        </div>
    </div>
</div><!-- .shop__sidebar -->
</div><!-- .accordion #shop-sidebar-accordion -->