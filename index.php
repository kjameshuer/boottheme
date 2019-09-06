<?php
get_header(); ?>
<div class="page-content container">
    <div class="articles">
        <?php while (have_posts()) : the_post();
            get_template_part('content', 'card');
        endwhile; ?>
    </div>
</div><!-- .page-content -->
<?php
get_footer();
