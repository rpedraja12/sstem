<div class="grid-item col-xs-12 col-sm-6 col-md-4 col-lg-4  col-xl-3">
    <div class="grid-item-content">

        <a href="<?php the_permalink(); ?>">
            <?php
            $date1 = new DateTime(get_the_date('Y-m-d'));
            $date2 = new DateTime(date('Y-m-d'));
            $interval = $date1->diff($date2);
            ?>
            <div style="position: relative;">
                <div class="half-circle t-white float-left <?php echo ($interval->days > 60) ? 'invisible' : ''; ?>"><?php pll_e("new"); ?></div>

                <?php the_post_thumbnail([540, 0], ['class' => 'rounded img-fluid offset-margin-25 img-d-block margin-lr-auto float-right']); ?>
                <?php
                $get_description = get_post(get_post_thumbnail_id())->post_excerpt;
                if (!empty($get_description)) {//If description is not empty show the div
                    echo '<div class="featured_caption">' . $get_description . '</div>';
                }
                ?>
                <div class="clearfix"></div>
            </div>


        </a>

        <div class="p-3">
            <div class="category_rating">
                <div class="float-left">
                    <span class="lbl-category-post-type">
                        <?php echo ucwords(pll__(get_post_type())); ?>
                    </span>
                </div>
                <div class="float-right">
                    <?php the_ratings(); ?>
                </div>
            </div>
            <div class="clearfix"></div>

            <a href="<?php the_permalink(); ?>" class="page-title-link t-gray"><?php the_title(); ?></a>
            <p class="category-topic t-lgray t-small <?php echo get_post_type() == 'topic' ? 'd-none' : ''; ?>" >
                <?php
                $fieldDetails = types_get_field('topics');
                $meta_values = get_post_meta(get_the_ID(), 'wpcf-topics', true);
                $meta_values = seadstem_get_multiple_meta($meta_values);
                $options = seadstem_get_types_field_checkboxes_options($fieldDetails);
                $strTitle = [];
                foreach ($meta_values as $metaValue) {
                    $strTitle[] = seadstem_get_types_field_checkboxes_options_by_value($options, $metaValue);
                }
                $title_to_implode = [];
                foreach ($strTitle as $metaObj) {
                    if (!empty($metaObj)) {
                        $title_to_implode[] = pll__($metaObj['title']);
                    }
                }
                echo implode(', ', $title_to_implode);
                ?>
            </p>
            <p class="category-subject t-small t-blue">
                <?php
                $fieldDetails = types_get_field('subjects');
                $meta_values = get_post_meta(get_the_ID(), 'wpcf-subjects', true);
                $meta_values = seadstem_get_multiple_meta($meta_values);
                $options = seadstem_get_types_field_checkboxes_options($fieldDetails);
                $strTitle = [];
//                var_dump($options);
//                echo "<br/>";
//                echo "<br/>";
//                var_dump($meta_values);
                foreach ($meta_values as $metaValue) {
                    $strTitle[] = seadstem_get_types_field_checkboxes_options_by_value($options, $metaValue);
                }
                $title_to_implode = [];
                foreach ($strTitle as $metaObj) {
                    if (!empty($metaObj)) {
                        $title_to_implode[] = pll__($metaObj['title']);
                    }
                }
                echo implode(', ', $title_to_implode);
                ?>
            </p>
        </div>
    </div>

</div>



