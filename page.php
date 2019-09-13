<?php
get_header(); ?>
<div class="single-content">
    <?php while (have_posts()) : the_post();
        get_template_part('content', 'shop');
    endwhile; ?>
</div><!-- .page-content -->
<?php
get_footer();