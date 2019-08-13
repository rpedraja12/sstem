<div class="container-fluid bg-lgray pb-1">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 py-3">
                <?php
                $category = get_the_category();
                ?>
                <a class="t-gray" href="#" onClick="history.go(-1);" title="<?php pll_e("go back");?>">< <?php pll_e("go back");?></a>
            </div>
        </div>

    </div>

</div>

<div class="container-fluid">
    <div class="row">
        <div class="" style="background: url('<?php echo get_the_post_thumbnail_url(get_post(), 'full'); ?>'); height: 380px;     /* Create the parallax scrolling effect */
             background-attachment: fixed;
             background-position: center;
             background-repeat: no-repeat;
             background-size: cover; width: 100%;">&nbsp;</div>
<?php //the_post_thumbnail('full', ['class' => 'rounded img-fluid w-100']); ?>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="single-post-newsevent-title mt-5 mb-2"><?php the_title(); ?></h1>
            <h2 class="single-post-newsevent-schedule">
                <?php
                $fieldName = 'date-schedule';
                $output = types_get_field_meta_value($fieldName);
                if (!empty($output)) {
                    echo $output;
                }
                ?>
            </h2>
        </div>
    </div>

</div>


<div class="container">

    <?php the_content(); ?>
</div>


<!-- news contents -->
<div class="container bg-dgray">
    <?php
    $args = array(
        'cat' => $category_id,
        'post_type' => ['news'],
        'posts_per_page' => 3,
    );
    $news_array = new WP_Query($args);
    wp_reset_postdata();
    ?>
    <h2 class="ml-2 py-3">News</h2>
    <div class="news-container row px-2">
        <?php if ($news_array->have_posts()) : $counter = 1; ?>

            <?php while ($news_array->have_posts()) : $news_array->the_post(); ?>
                <?php get_template_part('content', 'news-events-news'); ?>

                <?php $counter++; ?>
            <?php endwhile; ?>


        <?php endif; ?>
    </div>
    <?php if ($news_array->found_posts > 3): ?>
        <div class="invisible news-posts-num" data-items="<?php echo $news_array->found_posts; ?>"></div>
        <div class="row" id="news-next-container">
            <div class="col-sm-12 my-3" style="text-align: center;">
                <a class="btn btn-sm seadstem-news-load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                    <!--<span class="fa fa-refresh"></span>--> load more
                </a>
                <!--<a class="pagination__next" href="page2.html">Next page</a>-->
            </div>
        </div>

    <?php endif; ?>
    <div class="pb-1">&nbsp;</div>
</div>
<!-- end news contents -->

<!-- Events contents -->
<div class="container bg-lgray">
    <?php
    $args = array(
        'cat' => $category_id,
        'post_type' => ['event'],
        'posts_per_page' => 3,
    );
    $events_array = new WP_Query($args);
    wp_reset_postdata();
    ?>
    <h2 class="ml-2 py-3">Events</h2>
    <div class="events-container row px-2">
        <?php if ($events_array->have_posts()) : $counter = 1; ?>

            <?php while ($events_array->have_posts()) : $events_array->the_post(); ?>
                <?php get_template_part('content', 'news-events-events'); ?>

                <?php $counter++; ?>
            <?php endwhile; ?>


        <?php endif; ?>
    </div>
    <?php if ($events_array->found_posts > 3): ?>
        <div class="invisible events-posts-num" data-items="<?php echo $events_array->found_posts; ?>"></div>
        <div class="row" id="events-next-container">
            <div class="col-sm-12 my-3" style="text-align: center;">
                <a class="btn btn-sm seadstem-events-load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                    <!--<span class="fa fa-refresh"></span>--> load more
                </a>
                <!--<a class="pagination__next" href="page2.html">Next page</a>-->
            </div>
        </div>

    <?php endif; ?>
    <div class="pb-1">&nbsp;</div>
</div>
<!-- events end contents -->




