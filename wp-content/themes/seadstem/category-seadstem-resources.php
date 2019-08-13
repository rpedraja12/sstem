
<?php
$category_id = get_query_var('cat');
$cpts = get_post_types(['_builtin' => false, 'public' => true, 'exclude_from_search' => false]);
$cpts = array_values($cpts);
$args = array(
    'cat' => $category_id,
    'list_mode' => 'category_search',
    'post_type' => $cpts,
    '_meta_or_title' => get_search_query(),
    's' => "",
    'meta_query' => [],
);

//$meta_query = [];
//$meta_query[] = array(
//    'key' => $fieldKey,
//    'value' => $fieldValue,
//    'compare' => 'LIKE'
//);
//if (count($meta_query)) {
//    $meta_query['relation'] = 'OR';
//}
//var_dump(get_search_query());

$categoryObj = get_category($category_id);
$posts_array = new WP_Query($args);
//var_dump($posts_array->request);
//var_dump($posts_array->request);
wp_reset_postdata();
?>
<br/>
<!--<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="mt-4"><?php echo __($categoryObj->name); ?></h1>
        </div>
    </div>
</div>-->

<?php get_search_form(); ?>
<div class="container-fluid bg-white">
    <div class="container" id="filter-container">
        <div class="row mt-2">
            <div class="col-sm-10">
                <div class="row">
                </div>
            </div>
            <div class="col-sm-2">
                <p><small class="f-arial" id="posts-num" data-items="<?php echo $posts_array->found_posts; ?>"><?php echo $posts_array->found_posts; ?> <?php pll_e("results");?></small></p>
            </div>
        </div>

    </div>

</div>

<?php if ($posts_array->have_posts()) : $counter = 1; ?>
    <div class="container-fluid bg-lgray pt-5">
        <div class="container" id="overlay-this">
            <div class="grid" style="min-height: 500px;">
                <div class="grid-sizer col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3"></div>

                <?php while ($posts_array->have_posts()) : $posts_array->the_post(); ?>
                    <?php get_template_part('content', 'category'); ?>

                    <?php $counter++; ?>
                <?php endwhile; ?>
            </div>

        </div>
        <?php if ($posts_array->found_posts > get_option('posts_per_page')): ?>
            <div class="row" id="next-container">
                <div class="col-sm-12 my-3" style="text-align: center;">
                    <a class="btn btn-sm seadstem-load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                        <!--<span class="fa fa-refresh"></span>--> <?php pll_e("load more");?>
                    </a>
                    <!--<a class="pagination__next" href="page2.html">Next page</a>-->
                </div>
            </div>

        <?php endif; ?>
    </div>
<?php endif; ?>

<?php get_footer(); ?>

