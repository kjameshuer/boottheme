<?php
get_header(); ?>

    <?php while (have_posts()) : the_post();

        if (is_woocommerce()) :
            get_template_part('content', 'shop');
        else : 
            get_template_part('content', 'page');
        endif;
    endwhile; ?>

<?php
get_footer();