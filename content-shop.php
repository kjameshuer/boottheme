<div class="shop-content">
    <?php
    $hero_background_styles = 'background: blue;';
    if (has_post_thumbnail()) :
        $hero_background_styles = 'background:url(' . get_the_post_thumbnail_url(get_the_ID(), 'large') . ');';
        $hero_background_styles .= 'background-size: cover; background-position: center center; bakcground-repeat: no-repeat';
    endif;
    ?>
    <div class="hero container-fluid" style="<?php echo esc_attr($hero_background_styles) ?>">
        <div class="container hero-row">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </div>
    </div>
    <div class="content">
        <div class="content__row">
            <?php $content_right_classes = 'content__right is_full'; ?>
            <?php if (is_active_sidebar('sidebar-shop')) : ?>
                <?php $content_right_classes = 'content__right'; ?>
                <div class="content__left">
                    <div id="sidebar-shop" class="sidebar shop">
                        <?php dynamic_sidebar('sidebar-shop'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="<?php echo esc_attr($content_right_classes); ?>">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div><!-- .shop-content -->