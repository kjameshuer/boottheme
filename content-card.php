<article class="card article-card ml-1">
    <?php if (has_post_thumbnail()) :
        $thumbnail_id = get_post_thumbnail_id(get_the_ID());
        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        if (empty($alt)) :
            $alt = esc_html(get_the_title() . '-featured-image');
        endif;
        the_post_thumbnail(
            'article-card',
            array(
                'alt' => $alt,
                'class' => 'card-img-top'
            )
        );
        ?>
    <?php endif; ?>
    <h4 class="card-title p-2">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
        </a>
    </h4>
    <div class="card-text p-2"><?php wp_trim_words(the_content(), 20); ?><div>
</article>