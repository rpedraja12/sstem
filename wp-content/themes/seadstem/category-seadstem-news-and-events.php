<?php
$category_id = get_query_var('cat');
$categoryObj = get_category($category_id);
?>
<br/>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="mt-0 mb-3 ml-4"><?php echo __($categoryObj->name); ?></h1>
        </div>
    </div>
</div>
<!--
<div class="container-fluid bg-white">
    <div class="container">
        <div class="row mt-2">
            <div class="col-sm-10">
                <div class="row">
                </div>
            </div>
            <div class="col-sm-2">
                <p><small class="f-arial" id="posts-num" data-items="<?php echo $news_array->found_posts; ?>"><?php echo $news_array->found_posts; ?> results</small></p>
            </div>
        </div>

    </div>

</div>
-->
<div class="container bg-lgray">
    <?php
    $args = array(
        'cat' => $category_id,
        'post_type' => ['news', 'event'],
        'posts_per_page' => 3,
    );
    $latest_array = new WP_Query($args);
    wp_reset_postdata();
    ?>
    <h2 class="ml-2 py-3 news-and-events-latest"><?php pll_e("latest");?></h2>
    <div class="latest-container row px-2">
        <?php if ($latest_array->have_posts()) : $counter = 1; ?>

            <?php while ($latest_array->have_posts()) : $latest_array->the_post(); ?>
                <?php get_template_part('content', 'news-events-latest'); ?>

                <?php $counter++; ?>
            <?php endwhile; ?>


        <?php endif; ?>

    </div>
    <div class="pb-1">&nbsp;</div>
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
    <h2 class="ml-2 py-3"><?php pll_e("news");?></h2>
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
    <h2 class="ml-2 py-3"><?php pll_e("events");?></h2>
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
                    <!--<span class="fa fa-refresh"></span>--> <?php pll_e("load more");?>
                </a>
                <!--<a class="pagination__next" href="page2.html">Next page</a>-->
            </div>
        </div>

    <?php endif; ?>
    <div class="pb-1">&nbsp;</div>
</div>
<!-- events end contents -->

<?php get_footer(); ?>

<!-- RSS Feeds Google Alerts -->
<div class="container my-2">
    <div class="row">
        <?php echo do_shortcode('[rss size="10" feed="https://www.google.com/alerts/feeds/03786922906151449104/5322409239248130940" ]') ?>
    </div>
</div>