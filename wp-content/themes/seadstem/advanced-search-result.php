
<?php get_header(); ?>

<?php
$category_id = get_query_var('cat');
$cpts = get_post_types(['_builtin' => false, 'public' => true]);
$cpts = array_values($cpts);
$args = array(
    'post_type' => $cpts,
    'cat' => $category_id,
    'order' => 'DESC',
    'posts_per_page' => -1,
);
$categoryObj = get_category($category_id);
$posts_array = new WP_Query($args);
var_dump($_REQUEST);
if($_REQUEST['search'] == 'advanced'){
    echo '<h1>filter result</h1>';
}

?>


<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1><?php echo __($categoryObj->name); ?></h1>
        </div>
    </div>
</div>

<?php get_template_part('advanced', 'searchform'); ?>

<?php if ($posts_array->have_posts()) : ?>
    <div class="container-fluid bg-lgray pt-4">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="grid">
                        <?php while ($posts_array->have_posts()) : $posts_array->the_post(); ?>
                            <?php get_template_part('content', 'category'); ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php get_footer(); ?>