<?php
get_header(); ?>

    <?php while (have_posts()) : the_post();
        get_template_part('content', 'single');
        get_related_posts();
    endwhile; ?>

<?php
get_footer();
