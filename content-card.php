<?php
$articleClass = "article-card col-4";
$trimWordCount = 20;
if (is_sticky()) :
    $articleClass .= " sticky";
    $trimWordCount = 50;
endif; ?>

<article class="<?php echo esc_attr($articleClass); ?>">
    <div class="card">
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
        <h4 class="card-title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
            </a>
        </h4>
        <p class="card-text"><?php echo wp_trim_words(get_the_content(), $trimWordCount); ?>
            <a class="card-more" href="<?php the_permalink(); ?>">....Read More</a>
        </p>
    </div>
</article>