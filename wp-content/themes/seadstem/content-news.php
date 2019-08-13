Newssfasdf
<div class="container-fluid bg-lgray pb-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 t-gray py-3">
                <?php
                $category = get_the_category();
                ?>
                <a class="t-gray" href="#" onClick="history.go(-1);" title="<?php pll_e("go back");?>">< <?php pll_e("go back");?></a>
            </div>
        </div>
        <div class='row'>
            <div class="col-xs-12 col-sm-7">
                <div class="bg-white p-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1><?php the_title(); ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            <div style="position:relative;">
                                <?php
                                $get_description = get_post(get_post_thumbnail_id())->post_excerpt;
                                if (!empty($get_description)) {//If description is not empty show the div
                                    echo '<div class="featured_caption">' . $get_description . '</div>';
                                }
                                ?>
                                <?php the_post_thumbnail('medium', ['class' => 'rounded img-fluid w-100']); ?>

                                <div class="clearfix"></div>
                            </div>

                            <!-- tags goes here -->

                            <?php
                            $posttags = types_get_field_meta_value('tag');
                            if (count($posttags) > 0) {
                                ?>
                                <div class="my-2 t-small">
                                    <?php
                                    foreach ($posttags as $key => $tag) {

                                        echo!empty($tag) ? '<span class="tag-box t-blue p-1 t-bold rounded t-small mr-2">' . $tag . '</span>' : '';
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>


                            <!-- ratings goes here -->
                            <?php the_ratings(); ?>
                        </div>
                        <div class="col-sm-5">

                            <dl class="definition-terms-small-field">
                                <dt class="t-lgray t-small"><?php pll_e('Resource Type'); ?></dt>
                                <dd class="t-gray t-small t-bold"><?php echo ucwords(pll__(get_post_type_object(get_post_type())->labels->singular_name)); ?></dd>
                                <dt class="t-lgray t-small"><?php pll_e('Topics'); ?></dt>
                                <?php if (get_post_type() != 'topic'): ?>
                                    <dd class="t-gray t-small  t-bold">
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
                                    </dd>
                                <?php endif; ?>
                                <dt class="t-lgray t-small"><?php pll_e('Subjects'); ?></dt>
                                <dd class="t-gray t-small t-bold">
                                    <?php
                                    $meta_values = get_post_meta(get_the_ID(), 'wpcf-subjects', true);
                                    $meta_values = seadstem_get_multiple_meta($meta_values);
                                    echo implode(', ', $meta_values);
                                    ?>
                                </dd>

                            </dl>
                        </div>
                    </div>
                    <!-- content -->
                    <div class="mt-4 f-arial">
                        <?php the_content(); ?>
                    </div>



                    <!-- end the content -->
                    
                    <?php if (in_array(get_post_type(), ['worksheet', 'audio', 'video', 'medium'])): ?>
                        <?php get_template_part('seadstem_field_introduction_only'); ?>
                    <?php else: ?>
                        <?php get_template_part('seadstem_field_all'); ?>
                    <?php endif; ?>
                    <!-- end white bg -->


                    <?php if (!empty(types_get_field_meta_value('author'))): ?>
                        <dl class="mt-2">
                            <dt class = "t-lgray t-small"><?php pll_e('Author'); ?></dt>
                            <dd class="t-gray t-small t-bold"><?php echo types_get_field_meta_value('author'); ?></dd>
                        </dl>
                    <?php endif; ?>

                </div>

            </div>

            <div class="col-xs-12 col-sm-5">

                <!-- related post section start -->
                <?php
                //organize the related post
                global $related;
                $rel = $related->show(get_the_ID(), true);
                // Display the title and excerpt of each related post
                if (is_array($rel) && count($rel) > 0) {
                    ?>

                    <h2><?php pll_e('Related Resources'); ?></h2>
                    <?php
                    $separated_by_category = [];
                    foreach ($rel as $r) {

                        if (is_object($r)) {
                            if ($r->post_status != 'trash') {
                                $relatedCategory = get_post_type_object(get_post_type($r));
//                                var_dump($relatedCategory);
//                                var_dump($r->post_title);
                                $separated_by_category[$relatedCategory->name][] = $r;
                                setup_postdata($r);
//                                echo get_the_title($r->ID) . '<br />';
//                                the_excerpt();
                            }
                        }
                    }
                    wp_reset_postdata();



                    $cpt_categories = get_post_types(['_builtin' => false, 'public' => true, 'exclude_from_search' => false]);
                    $myOrder = array('experiment', 'project', 'worksheet', 'audio', 'video', 'app', 'game', 'simulation', 'virtual-lab');
                    $newOrder = [];
                    $categoriesUnknown = $cpt_categories;
                    foreach ($cpt_categories as $categoryKey => $categoryF) {
                        $key = array_search($categoryF, $myOrder);
                        if ($key === false) {
                            continue;
                        }
                        $newOrder[$key] = $categoryF;
                        unset($categoriesUnknown[$categoryKey]);
                    }
                    ksort($newOrder);
                    foreach ($categoriesUnknown as $category) {
                        $newOrder[] = $category;
                    }
                    foreach ($newOrder as $category) {
                        if (isset($separated_by_category[$category])) {
                            $postTypeObjectt = get_post_type_object($category);
                            ?>
                            <div class="row mb-1">
                                <div class="col-xs-12 col-sm-12">
                                    <div class="bg-white p-4">
                                        <h4 class="mb-3"><?php pll_e($postTypeObjectt->label); ?></h4>
                                        <div class="owl-carousel owl-theme ron-scroller" id="<?php echo $postTypeObjectt->label; ?>-related-post-container">
                                            <?php
                                            foreach ($separated_by_category[$category] as $myPost) {
                                                ?>

                                                <?php // foreach ($myPosts as $myPost): ?>
                                                <div class="item">
                                                    <?php echo get_the_post_thumbnail($myPost, 'medium', ['class' => 'img-fluid rounded']); ?>
                                                    <a href="<?php echo get_post_permalink($myPost); ?>" class=" t-gray"><?php echo $myPost->post_title; ?></a>
                                                    <?php //echo $myPost->post_title;     ?>
                                                </div>
                                                <?php // endforeach; ?>


                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
                <!-- related post section end -->
                <!-- links start  -->

                <?php
                if (get_field('link')):
                    ?>
                    <div class="row mb-1">
                        <div class="col-xs-12 col-sm-12">
                            <div class="bg-white p-4">
                                <h2 class="mb-3"><?php pll_e('Links'); ?></h2>
                                <?php
                                $links = get_field('link');
                                if (!empty($links)) {
                                    foreach ($links as $linkObj):
                                        ?>
                                        <p class="mb-1">
                                            <a class="t-gray" href="<?php echo $linkObj['link_url']; ?>" target="_blank" title="<?php echo $linkObj['link_description']; ?>">
                                                <?php $linkImage = seadstem_get_links_icon($linkObj['link_image']); ?>
                                                <span class="<?php echo $linkImage; ?>"></span>
                                                <?php echo $linkObj['link_title']; ?>
                                            </a>
                                        </p>
                                        <?php
                                    endforeach;
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- end links -->
                <!-- Document PDF attachment end -->
                <?php
                $media = get_attached_media('application/pdf');
                if (!empty($media)):
                    ?>
                    <div class="row mb-1">
                        <div class="col-xs-12 col-sm-12">
                            <div class="bg-white p-4">
                                <h2><?php pll_e('Documents'); ?></h2>

                                <?php foreach ($media as $medium): ?>
                                    <div class="row documents-file-container">
                                        <div class="col-sm-2">
                                            <i class="fa fa-file-pdf-o fa-3x"></i>
                                        </div>
                                        <div class="col-sm-10">
                                            <p class="mb-1"><?php
                                                $attachment_filesize = getSize(get_attached_file($medium->ID));
                                                echo '<a href="' . $medium->guid . '" class="t-gray" target="_blank">' . $medium->post_title . '</a>';
                                                ?>
                                            </p>
                                            <span class="t-lgray">PDF. <?php echo strtoupper($attachment_filesize); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>


                        </div>
                    </div>
                <?php endif; ?>
                <!-- Document PDF attachment end -->

            </div>

        </div>
    </div>

</div>
