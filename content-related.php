<?php

// Current Post Variables
$authorName = get_the_author_meta('display_name');
$tags = wp_get_post_tags(get_the_ID(), array('fields' => 'ids'));
$categories = wp_get_post_categories(get_the_ID(), array('fields' => 'ids'));

// Related Posts Query / Display

$relatedArgs = array(
    'posts_per_page' => 6,
    'tax_query' => array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'category',
            'terms' => $categories,
            'include_children' => true,
            'operator' => 'IN'
        ),
        array(
            'taxonomy' => 'tag',
            'terms' => $tags,
            'operator' => 'IN'
        )
    )
);
$query = new WP_Query($relatedArgs);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post(); ?>
        <article class="related-card">
            <div class="card related">
                <?php if (has_post_thumbnail()) :
                            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                            $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                            if (empty($alt)) :
                                $alt = esc_html(get_the_title() . '-featured-image');
                            endif;
                            the_post_thumbnail(
                                'related-card',
                                array(
                                    'alt' => $alt,
                                    'class' => 'card-img-left'
                                )
                            );
                            ?>
                <?php endif; ?>
                <div class="card-text-holder">
                    <h5 class="card-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h5>
                    <p class="card-text"><?php echo esc_html(wp_trim_words(get_the_content()), 10); ?>
                        <a class="card-more" href="<?php the_permalink(); ?>">....Read More</a>
                    </p>
                </div>
            </div>
        </article>
<?php endwhile;
    wp_reset_postdata();
endif;

?>