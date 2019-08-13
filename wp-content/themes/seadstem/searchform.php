<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $wp;
//$url =  home_url( $wp->request )
//$category_id = get_query_var('cat');
//$categoryObj = get_category($category_id);
//var_dump($categoryObj);
?>

<div class="container-fluid bg-blue mt-3 d-block d-md-none">
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-3">
                <div class="accordion" id="search-form-mobile">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="pull-left">
                                        <?php
                                        pll_e('Subject');
                                        $subjectSelected = $_GET['wpcf-subjects'] == null ? [] : $_GET['wpcf-subjects'];
                                        ?>
                                    </span>
                                    <span class="fa fa-sort-down pull-right"></span>
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#search-form-mobile">
                            <div class="card-body cmb-search-subjects">
                                <?php
                                $fieldDetailObject = types_get_field('subjects');
                                $fields = seadstem_get_types_field_checkboxes_options($fieldDetailObject);
                                foreach ($fields as $fieldObject):
                                    ?>
                                    <a class="dropdown-item t-small <?php echo in_array($fieldObject['set_value'], $subjectSelected) ? 't-gray-o' : ''; ?>" href="#" data-value="<?php echo $fieldObject['set_value']; ?>" data-field="<?php echo $fieldObject['title']; ?>"><i class="fa fa-circle<?php echo in_array($fieldObject['set_value'], $subjectSelected) ? '' : '-o'; ?>"></i> <?php echo ucfirst(pll__($fieldObject['title'])); ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link  btn-block  text-left  p-0 collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="pull-left">
                                        <?php
                                        pll_e('Topic');
                                        $subjectSelected = $_GET['wpcf-topics'] == null ? [] : $_GET['wpcf-topics'];
                                        ?>
                                    </span>
                                    <span class="fa fa-sort-down pull-right"></span>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#search-form-mobile">
                            <div class="card-body cmb-search-topics">
                                <?php
                                $fieldDetailObject = types_get_field('topics');
                                $fields = seadstem_get_types_field_checkboxes_options($fieldDetailObject);
                                foreach ($fields as $fieldObject):
                                    ?>
                                    <a class="dropdown-item t-small <?php echo in_array($fieldObject['set_value'], $subjectSelected) ? 't-gray-o' : ''; ?>" href="#" data-value="<?php echo $fieldObject['set_value']; ?>"><i class="fa fa-circle<?php echo in_array($fieldObject['set_value'], $subjectSelected) ? '' : '-o'; ?>"></i> <?php echo ucfirst(pll__($fieldObject['title'])); ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- start Level -->

                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn btn-link  btn-block  text-left  p-0 collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span class="pull-left">
                                        <?php
                                        pll_e('Level');
                                        $subjectSelected = $_GET['wpcf-level'] == null ? [] : $_GET['wpcf-level'];
                                        ?>
                                    </span>
                                    <span class="fa fa-sort-down pull-right"></span>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#search-form-mobile">
                            <div class="card-body cmb-search-topics">
                                <?php
                                $fieldDetailObject = types_get_field('level');
                                $fields = seadstem_get_types_field_checkboxes_options($fieldDetailObject);
                                foreach ($fields as $fieldObject):
                                    if (!isset($fieldObject['title'])) {
                                        continue;
                                    }
                                    ?>
                                    <a class="dropdown-item t-small <?php echo in_array($fieldObject['value'], $subjectSelected) ? 't-gray-o' : ''; ?>" href="#" data-value="<?php echo $fieldObject['value']; ?>"><i class="fa fa-circle<?php echo in_array($fieldObject['value'], $subjectSelected) ? '' : '-o'; ?>"></i> <?php echo ucfirst(pll__($fieldObject['title'])); ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!-- end of level -->
                    
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link  btn-block  text-left  p-0 collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span class="pull-left">
                                        <?php
                                        pll_e('Resource Type');
                                        $postTypeSelected = $_GET['post_types'] == null ? [] : $_GET['post_types'];
                                        ?>
                                    </span>
                                    <span class="fa fa-sort-down pull-right"></span>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#search-form-mobile">
                            <div class="card-body cmb-search-post-types">
                                <?php
                                $exclude = ['news', 'event'];
                                $cpt_categories = get_post_types(['_builtin' => false, 'public' => true, 'exclude_from_search' => false]);
                                $myOrder = array('project', 'experiment', 'worksheet', 'audio', 'video', 'app', 'game', 'simulation', 'virtual-lab');
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
                                    if (in_array($category, $exclude)) {
                                        continue;
                                    }
                                    $newOrder[] = $category;
                                }
//                            $newOrder = array_merge($newOrder,$categoriesUnknown);
//                            usort($cpt_categories, function ($a, $b) use($order) {
//                                $pos_a = array_search($a, $order);
//                                $pos_b = array_search($b, $order);
//                                if ($pos_a === false && $pos_b === false) { // both items are dont cares
//                                    return 0;                      // a == b
//                                } else if ($pos_a === false) {           // $a is a dont care item
//                                    return 1;                      // $a > $b
//                                } else if ($pos_b === false) {           // $b is a dont care item
//                                    return -1;                     // $a < $b
//                                } else {
//                                    return $pos_a - $pos_b;
//                                }
//                                return $pos_a - $pos_b;
//                            });
//                            $cpt_categories = array_reverse($cpt_categories);
//                            foreach ($cpt_categories as $category):
//                            var_dump($newOrder);
                                foreach ($newOrder as $category):
                                    ?>
                                    <a class="dropdown-item t-small <?php echo in_array($category, $postTypeSelected) ? 't-gray-o' : ''; ?>" href="#" data-value="<?php echo $category; ?>"><i class="fa fa-circle<?php echo in_array($category, $postTypeSelected) ? '' : '-o'; ?>"></i> <?php echo pll__(ucfirst($category)); ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="input-group seadstem-search-field">
                    <input type="search" class="form-control" placeholder="<?php pll_e("search");?>" id="search-txt-mobile" value="<?php echo get_search_query() == '-custom-filter-' ? '' : get_search_query() ?>" name="s" title="<?php pll_e("search");?>" />
                    <div class="input-group-append" id="search-btn-mobile">
                        <div class="input-group-text"><span class="fa-search fa"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form role="search" method="get" action="<?php echo home_url('/'); ?>" id="search-form">

    <div class="container-fluid bg-blue mt-3 d-none d-md-block">
        <div class="container">
            <div class="row" id="search-panel">
                <div class=" col-sm-auto col-xs-12">
                    <div class="dropdown cmb-blue">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            pll_e('Subject');
                            $subjectSelected = $_GET['wpcf-subjects'] == null ? [] : $_GET['wpcf-subjects'];
                            ?>
                        </button>
                        <div class="dropdown-menu cmb-search-subjects" aria-labelledby="dropdownMenuButton">

                            <?php
                            $fieldDetailObject = types_get_field('subjects');
                            $fields = seadstem_get_types_field_checkboxes_options($fieldDetailObject);
                            foreach ($fields as $fieldObject):
                                ?>
                                <a class="dropdown-item t-small <?php echo in_array($fieldObject['set_value'], $subjectSelected) ? 't-gray-o' : ''; ?>" href="#" data-value="<?php echo $fieldObject['set_value']; ?>" data-field="<?php echo $fieldObject['title']; ?>"><i class="fa fa-circle<?php echo in_array($fieldObject['set_value'], $subjectSelected) ? '' : '-o'; ?>"></i> <?php echo ucfirst(pll__($fieldObject['title'])); ?></a>
                            <?php endforeach; ?>
                        </div>

                    </div>
                    <div class="d-none">
                        <select multiple="multiple" name="wpcf-subjects[]" id="true-cmb-subjects">
                            <?php
                            foreach ($fields as $fieldObject):
                                ?>
                                <option value="<?php echo $fieldObject['set_value']; ?>" data-value="<?php echo $fieldObject['set_value']; ?>" <?php echo in_array($fieldObject['set_value'], $subjectSelected) ? 'selected="selected"' : ''; ?>><?php echo ucfirst(pll__($fieldObject['title'])); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class=" col-sm-auto col-xs-12">
                    <div class="dropdown cmb-blue">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            pll_e('Topic');
                            $subjectSelected = $_GET['wpcf-topics'] == null ? [] : $_GET['wpcf-topics'];
                            ?>
                        </button>
                        <div class="dropdown-menu cmb-search-topics" aria-labelledby="dropdownMenuButton">
                            <?php
                            $fieldDetailObject = types_get_field('topics');
                            $fields = seadstem_get_types_field_checkboxes_options($fieldDetailObject);
                            foreach ($fields as $fieldObject):
                                ?>
                                <a class="dropdown-item t-small <?php echo in_array($fieldObject['set_value'], $subjectSelected) ? 't-gray-o' : ''; ?>" href="#" data-value="<?php echo $fieldObject['set_value']; ?>"><i class="fa fa-circle<?php echo in_array($fieldObject['set_value'], $subjectSelected) ? '' : '-o'; ?>"></i> <?php echo ucfirst(pll__($fieldObject['title'])); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="d-none">
                        <select multiple="multiple" name="wpcf-topics[]" id="true-cmb-topics">
                            <?php
                            foreach ($fields as $fieldObject):
                                ?>
                                <option value="<?php echo $fieldObject['set_value']; ?>" data-value="<?php echo $fieldObject['set_value']; ?>" <?php echo in_array($fieldObject['set_value'], $subjectSelected) ? 'selected="selected"' : ''; ?>><?php echo ucfirst(pll__($fieldObject['title'])); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                
                <!-- start level -->
                <div class=" col-sm-auto col-xs-12">
                    <div class="dropdown cmb-blue">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            pll_e('Level');
                            $subjectSelected = $_GET['wpcf-level'] == null ? [] : $_GET['wpcf-level'];
                            ?>
                        </button>
                        <div class="dropdown-menu cmb-search-level" aria-labelledby="dropdownMenuButton">
                            <?php
                            $fieldDetailObject = types_get_field('level');
                            $fields = seadstem_get_types_field_checkboxes_options($fieldDetailObject);
                            foreach ($fields as $fieldObject):
    
                                if (!isset($fieldObject['title'])) {
                                    continue;
                                }
                                ?>
                                <a class="dropdown-item t-small <?php echo in_array($fieldObject['value'], $subjectSelected) ? 't-gray-o' : ''; ?>" href="#" data-value="<?php echo $fieldObject['value']; ?>"><i class="fa fa-circle<?php echo in_array($fieldObject['value'], $subjectSelected) ? '' : '-o'; ?>"></i> <?php echo ucfirst(pll__($fieldObject['title'])); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="d-none">
                        <select multiple="multiple" name="wpcf-level[]" id="true-cmb-level">
                            <?php
                            foreach ($fields as $fieldObject):
                                if (!isset($fieldObject['title'])) {
                                    continue;
                                }
                                ?>
                                <option value="<?php echo $fieldObject['value']; ?>" data-value="<?php echo $fieldObject['value']; ?>" <?php echo in_array($fieldObject['value'], $subjectSelected) ? 'selected="selected"' : ''; ?>><?php echo ucfirst(pll__($fieldObject['title'])); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!-- end level -->
                
                <div class=" col-sm-auto col-xs-12">
                    <div class="dropdown cmb-gray">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            pll_e('Resource Type');
                            $postTypeSelected = $_GET['post_types'] == null ? [] : $_GET['post_types'];
                            ?>
                        </button>
                        <div class="dropdown-menu cmb-search-post-types" aria-labelledby="dropdownMenuButton">
                            <?php
                            $exclude = ['news', 'event'];
                            $cpt_categories = get_post_types(['_builtin' => false, 'public' => true, 'exclude_from_search' => false]);
                            $myOrder = array('project', 'experiment', 'worksheet', 'audio', 'video', 'app', 'game', 'simulation', 'virtual-lab');
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
                                if (in_array($category, $exclude)) {
                                    continue;
                                }
                                $newOrder[] = $category;
                            }
//                            $newOrder = array_merge($newOrder,$categoriesUnknown);
//                            usort($cpt_categories, function ($a, $b) use($order) {
//                                $pos_a = array_search($a, $order);
//                                $pos_b = array_search($b, $order);
//                                if ($pos_a === false && $pos_b === false) { // both items are dont cares
//                                    return 0;                      // a == b
//                                } else if ($pos_a === false) {           // $a is a dont care item
//                                    return 1;                      // $a > $b
//                                } else if ($pos_b === false) {           // $b is a dont care item
//                                    return -1;                     // $a < $b
//                                } else {
//                                    return $pos_a - $pos_b;
//                                }
//                                return $pos_a - $pos_b;
//                            });
//                            $cpt_categories = array_reverse($cpt_categories);
//                            foreach ($cpt_categories as $category):
//                            var_dump($newOrder);
                            foreach ($newOrder as $category):
                                ?>
                                <a class="dropdown-item t-small <?php echo in_array($category, $postTypeSelected) ? 't-gray-o' : ''; ?>" href="#" data-value="<?php echo $category; ?>"><i class="fa fa-circle<?php echo in_array($category, $postTypeSelected) ? '' : '-o'; ?>"></i> <?php echo pll__(ucfirst($category)); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="d-none">
                        <select multiple="multiple" name="post_types[]" id="true-cmb-post-types">
                            <?php
                            foreach ($newOrder as $category):
                                ?>
                                <a class="dropdown-item t-small" href="#"><i class="fa fa-circle-o"></i> <?php echo pll__(ucfirst($category)); ?></a>
                                <option value="<?php echo $category; ?>" data-value="<?php echo $category; ?>" <?php echo in_array($category, $postTypeSelected) ? 'selected="selected"' : ''; ?>><?php echo $category; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- PASSING THIS TO TRIGGER THE ADVANCED SEARCH RESULT PAGE FROM functions.php -->
<!--                    <input type="hidden" name="search" value="advanced">

                    <label for="name" class=""><?php _e('Name: ', 'textdomain'); ?></label><br>
                    <input type="text" value="" placeholder="<?php _e('Type the Car Name', 'textdomain'); ?>" name="name" id="name" />


                    <input type="submit" id="searchsubmit" value="Search" />-->
                </div>
                <div class=" col-xs-12 col">
                    <div class="input-group seadstem-search-field">
                        <input type="search" class="form-control" placeholder="<?php pll_e("search");?>" id="search-txt" value="<?php echo get_search_query() == '-custom-filter-' ? '' : get_search_query() ?>" name="s" title="<?php pll_e("search");?>" />
                        <div class="input-group-append" id="search-btn">
                            <div class="input-group-text"><span class="fa-search fa"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
