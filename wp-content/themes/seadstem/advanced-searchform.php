<?php
global $wp;
$current_url = esc_url(home_url(add_query_arg(array(), $wp->request)));
var_dump($current_url);
?>
<form method="get" id="advanced-searchform" role="search" action="<?php echo esc_url($current_url); ?>">
    <input type="submit"/>
<!--<input type="hidden" name="search" value="advanced">-->
    <input type="search" placeholder="<?php echo esc_attr('Search…', 'presentation'); ?>" name="s" id="search-input" value="<?php echo esc_attr(get_search_query()); ?>" />
                        <!--<h3><?php _e('Advanced Search', 'textdomain'); ?></h3>-->
    <div class="container-fluid bg-blue">
        <div class="container">
            <div class="row" id="search-panel">
                <div class=" col-sm-auto col-xs-12">
                    <div class="dropdown cmb-blue">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php pll_e('Resource Type'); ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                            $cpt_categories = get_post_types(['_builtin' => false, 'public' => true]);
                            foreach ($cpt_categories as $category):
                                ?>
                                <a class="dropdown-item t-small" href="#"><i class="fa fa-circle-o"></i> <?php echo pll__(ucfirst($category)); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class=" col-sm-auto col-xs-12">
                    <div class="dropdown cmb-blue">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php pll_e('Resource Type'); ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                            $cpt_categories = get_post_types(['_builtin' => false, 'public' => true]);
                            foreach ($cpt_categories as $category):
                                ?>
                                <a class="dropdown-item t-small" href="#"><i class="fa fa-circle-o"></i> <?php echo pll__(ucfirst($category)); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class=" col-sm-auto col-xs-12">
                    <div class="dropdown cmb-gray">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php pll_e('Resource Type'); ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                            $cpt_categories = get_post_types(['_builtin' => false, 'public' => true]);
                            foreach ($cpt_categories as $category):
                                ?>
                                <a class="dropdown-item t-small" href="#"><i class="fa fa-circle-o"></i> <?php echo pll__(ucfirst($category)); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- PASSING THIS TO TRIGGER THE ADVANCED SEARCH RESULT PAGE FROM functions.php -->
<!--                    <input type="hidden" name="search" value="advanced">

                    <label for="name" class=""><?php _e('Name: ', 'textdomain'); ?></label><br>
                    <input type="text" value="" placeholder="<?php _e('Type the Car Name', 'textdomain'); ?>" name="name" id="name" />


                    <input type="submit" id="searchsubmit" value="Search" />-->
                </div>
                <div class=" col-xs-12 col">
                    <div class="input-group seadstem-search-field">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fa-search fa"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white">
        <div class="container">
            test
        </div>
    </div>

</form>
