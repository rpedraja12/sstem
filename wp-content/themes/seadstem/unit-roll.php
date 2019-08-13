<?php
$cpts = get_post_types(['_builtin' => false, 'public' => true]);
$args = array(
    'post_type' => 'unit',
    'cat' => $category_id,
    'order' => 'ASC',
    'orderby' => 'menu_order'
//    'posts_per_page' => -1,
);
$unitPost = new WP_Query($args);
wp_reset_postdata();
?>
<div class="container-fluid">
    <div class="row">
        <div class="container" id="unit-roll">
            <?php if ($unitPost->have_posts()) : ?>
                <h1><?php pll_e('Units'); ?></h1>
                <div class="owl-carousel owl-theme unit-scroller" id="unit-scroller-container">
                    <?php while ($unitPost->have_posts()) : $unitPost->the_post(); ?>
                        <a href="<?php echo get_post_permalink(); ?>" class="t-gray" >
                            <div class="item">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'medium', ['class' => 'img-fluid rounded']); ?>
                                <div class="img-overlay">
                                    <div class="col-12 header-container"><h4><?php echo get_the_title(); ?></h4></div>


                                </div>

                                <?php //echo $myPost->post_title;  ?>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>