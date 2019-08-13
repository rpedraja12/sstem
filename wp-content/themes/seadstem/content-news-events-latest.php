<div class='latest-item col-xs-12 col-sm-12 col-md-4 col-lg-4'>
    <div class="latest-item-content bg-white rounded">
        <span class="latest-item-post-type"><?php echo ucwords(pll__(get_post_type_object(get_post_type())->labels->singular_name)); ?></span>
        <a href="<?php the_permalink(); ?>" class="latest-item-content-img-link">
            <?php the_post_thumbnail('news-and-events-thumbnail', ['class' => 'img-fluid img-d-block margin-lr-auto rounded']); ?>
        </a>
        <div class="latest-item-content-details px-3">
            <a href="<?php the_permalink(); ?>" class="latest-item-content-title">
                <h3 class="t-gray py-3">
                    <?php the_title(); ?>
                </h3>
            </a>

<!--            <div class="latest-item-content-excerpt">
                <?php the_excerpt(); ?>
            </div>-->
        </div>

    </div>
</div>