<div class='news-item col-xs-12 col-sm-12 col-md-4 col-lg-4'>
    <div class="news-item-content bg-white rounded">
        <a href="<?php the_permalink(); ?>" class="news-item-content-img-link">
            <?php the_post_thumbnail('news-and-events-thumbnail', ['class' => 'img-fluid img-d-block margin-lr-auto rounded']); ?>
        </a>
        <div class="news-item-content-details px-3">
            <div class="news-item-content-date-schedule">
                <?php
                $fieldName = 'wpcf-date-schedule';
                $output = get_post_meta(get_the_ID(), $fieldName, true);
                if (!empty($output)) {
                    echo $output;
                }
                ?>
            </div>
            <a href = "<?php the_permalink(); ?>" class = "news-item-content-title">
                <h3 class = "t-gray pt-3 pb-0">
                    <?php the_title();
                    ?>
                </h3>
            </a>

            <div class="news-item-content-excerpt  f-arial">
                <?php the_excerpt(); ?>
            </div>
            <div class="pb-1"></div>
        </div>

    </div>
</div>