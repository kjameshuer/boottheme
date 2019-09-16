<?php
/* ----------------------------------------------------------------------------------
	TEMPLATE FOR DISPLAYING RELATED POSTS.
---------------------------------------------------------------------------------- */
function get_related_posts(){?>
    <hr>
    <div class="single-extras">
    <div class="single-extras__title">
        <h3>Related Posts</h3>
    </div>   
    <div class="single-extras__row">
            <?php get_template_part('content', 'related'); ?>
    </div>
</div>
<?php }