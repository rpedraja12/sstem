
<?php get_header(); ?>

<?php get_template_part('unit', 'roll'); ?>

<?php
$meta_query = [];

$fieldKey = 'wpcf-subjects';
if (!empty($_GET[$fieldKey])) {
    foreach ($_GET[$fieldKey] as $fieldValue) {
        $meta_query[] = array(
            'key' => $fieldKey,
            'value' => '"' . $fieldValue . '"',
            'compare' => 'LIKE'
        );
    }
}

$fieldKey = 'wpcf-topics';
if (!empty($_GET[$fieldKey])) {
    foreach ($_GET[$fieldKey] as $fieldValue) {
        $meta_query[] = array(
            'key' => $fieldKey,
            'value' => '"' . $fieldValue . '"',
            'compare' => 'LIKE'
        );
    }
}

$fieldKey = 'wpcf-level';
if (!empty($_GET[$fieldKey])) {
    foreach ($_GET[$fieldKey] as $fieldValue) {
        $meta_query[] = array(
            'key' => $fieldKey,
            'value' => $fieldValue,
            'compare' => 'LIKE'
        );
    }
}

$fieldKey = 'wpcf-tag';
if (!empty($_GET[$fieldKey])) {
    $meta_query[] = array(
        'key' => $fieldKey,
        'value' => $fieldValue,
        'compare' => 'LIKE'
    );
}

$post_types = [];
$fieldKey = 'post_types';
$cpt_categories = get_post_types(['_builtin' => false, 'public' => true, 'exclude_from_search' => false]);
if (!empty($_GET[$fieldKey])) {

    $post_types = array_intersect($_GET[$fieldKey], array_values($cpt_categories));
} else {
    $post_types = array_values($cpt_categories);
}
$searchTerm = get_search_query();


if (count($meta_query)) {
    $meta_query['relation'] = 'OR';
}

if ($searchTerm == '-custom-filter-') {
    $searchTerm = "";
}
$category = pll_get_term(12); //category of resources

$args = [
    'cat' => $category,
    'list_mode' => 'category_search',
    'post_type' => $post_types,
    '_meta_or_title' => get_search_query(),
    's' => $searchTerm,
    'meta_query' => $meta_query,
];
$search = new WP_Query($args);
//var_dump($search->request);
//var_dump(unserialize('a:1:{s:64:"wpcf-fields-checkboxes-option-1f62400be1a5628b45289bc81f0e8a9c-1";a:1:{i:0;s:2:"10";}}')) ;
//var_dump()
?>
<?php get_search_form(); ?>

<div class="container-fluid bg-white">
    <div class="container">
        <div class="row mt-2" id="filter-container">
            <div class="col-md-8">
                <div class="row">
                    <?php if (isset($_GET['wpcf-subjects'])): ?>
                        <?php $fieldDetails = types_get_field('subjects'); ?>
                        <?php foreach ($_GET['wpcf-subjects'] as $topic): ?>
                            <div class="col-auto search-tag">
                                <div class="input-group">
                                    <div class="input-group-append remove-search-tag" data-value="<?php echo $topic; ?>" data-key="true-cmb-subjects">
                                        <div class="input-group-text"><i class="fa fa-times"></i></div>
                                    </div> 
                                    <?php
                                    $options = seadstem_get_types_field_checkboxes_options($fieldDetails);
                                    $matchFieldObj = seadstem_get_types_field_checkboxes_options_by_value($options, $topic);
                                    ?>
                                    <div class="input-group-text"><?php echo isset($matchFieldObj['set_value']) ? pll__($matchFieldObj['title']) : ''; ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (isset($_GET['wpcf-topics'])): ?>
                        <?php $fieldDetails = types_get_field('topics'); ?>
                        <?php foreach ($_GET['wpcf-topics'] as $topic): ?>
                            <div class="col-auto search-tag">
                                <div class="input-group">
                                    <div class="input-group-append remove-search-tag" data-value="<?php echo $topic; ?>" data-key="true-cmb-topics">
                                        <div class="input-group-text"><i class="fa fa-times"></i></div>
                                    </div> 
                                    <?php
                                    $options = seadstem_get_types_field_checkboxes_options($fieldDetails);
                                    $matchFieldObj = seadstem_get_types_field_checkboxes_options_by_value($options, $topic);
                                    ?>
                                    <div class="input-group-text"><?php echo isset($matchFieldObj['set_value']) ? pll__($matchFieldObj['title']) : ''; ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <!-- level -->

                    <?php if (isset($_GET['wpcf-level'])): ?>
                        <?php $fieldDetails = types_get_field('level'); ?>
                        <?php foreach ($_GET['wpcf-level'] as $topic): ?>
                            <div class="col-auto search-tag">
                                <div class="input-group">
                                    <div class="input-group-append remove-search-tag" data-value="<?php echo $topic; ?>" data-key="true-cmb-level">
                                        <div class="input-group-text"><i class="fa fa-times"></i></div>
                                    </div> 
                                    <?php
//                                    var_dump($fieldDetails);
                                    $options = seadstem_get_types_field_checkboxes_options($fieldDetails);
                                    $matchFieldObj = seadstem_get_types_field_checkboxes_options_by_value($options, $topic, 'value');
                                    ?>
                                    <div class="input-group-text"><?php echo isset($matchFieldObj['value']) ? pll__($matchFieldObj['title']) : ''; ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <!-- end level -->


                    <?php if (isset($_GET['post_types'])): ?>
                        <?php foreach ($_GET['post_types'] as $topic): ?>
                            <div class="col-auto search-tag">
                                <div class="input-group">
                                    <div class="input-group-append remove-search-tag" data-value="<?php echo $topic; ?>" data-key="true-cmb-post-types">
                                        <div class="input-group-text"><i class="fa fa-times"></i></div>
                                    </div> 
                                    <div class="input-group-text"><?php echo pll__(get_post_type_object($topic)->labels->singular_name); ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>
            <div class="col-md-4 remove-all-filters text-right">
                <div class="input-group">
                    <div class="input-group-append">
                        <?php $link = get_category_link(pll_get_term(12, pll_current_language())); ?>
                        <div class="input-group-text"><a href="<?php echo $link; ?>"><i class="fa fa-times"></i></a></div>
                    </div> 
                    <div class="input-group-text"><?php echo pll__('delete all filters'); ?></div>
                </div>
                <span><small class="f-arial" id="posts-num" data-items="<?php echo $search->found_posts; ?>"><?php echo $search->found_posts; ?> <?php pll_e("results"); ?></small></span>
            </div>
        </div>
    </div>
</div>

<?php wp_reset_postdata(); ?>
<?php if ($search->have_posts()) : $counter = 1; ?>
    <div class="container-fluid bg-lgray pt-4">
        <div class="container" id="overlay-this">
            <div class="grid" style="min-height: 500px;">
                <div class="grid-sizer col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3"></div>

                <?php while ($search->have_posts()) : $search->the_post(); ?>
                    <?php get_template_part('content', 'category'); ?>

                    <?php $counter++; ?>
                <?php endwhile; ?>
            </div>

        </div>
        <?php if ($search->found_posts > get_option('posts_per_page')): ?>
            <div class="row" id="next-container">
                <div class="col-sm-12 my-3" style="text-align: center;">
                    <a class="btn btn-sm seadstem-load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                        <!--<span class="fa fa-refresh"></span>--> load more
                    </a>
                    <!--<a class="pagination__next" href="page2.html">Next page</a>-->
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="container-fluid bg-lgray pt-4">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 pb-4">
                    <?php pll_e('No results found.'); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
