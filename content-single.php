<?php
$hero_background_styles = 'background: blue;';
if (has_post_thumbnail()) :
    $hero_background_styles = 'background:url(' . get_the_post_thumbnail_url(get_the_ID(), 'large') . ');';
    $hero_background_styles .= 'background-size: cover; background-position: center center; bakcground-repeat: no-repeat';
endif;
?>
<div class="single-content">
    <div class="hero container-fluid" style="<?php echo esc_attr($hero_background_styles) ?>">
        <div class="container hero-row">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </div>
    </div>
    <div class="content">
        <div class="content__row">
            <?php the_content(); ?>
        </div>
        <div class="content__prev-next">
            <div class="btn btn-secondary"> <?php previous_post_link(); ?></div>
            <div class="btn btn-secondary"> <?php next_post_link(); ?></div>
        </div>
    </div>
</div>