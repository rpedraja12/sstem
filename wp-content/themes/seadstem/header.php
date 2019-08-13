<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Webtrekk 4, (c) www.webtrekk.de -->
<script src="//www.goethe.de/skripte/webtrekk_v4.min.js" type="text/javascript"></script>
<script src="//www.goethe.de/skripte/webtrekk-conf_contens.v2.js" type="text/javascript"></script>
<script type="text/javascript">if (typeof (wt.sendinfo) != "undefined")
        wt.sendinfo();</script>
<noscript>
<div><img src="//goetheinstitut01.webtrekk.net/382202390743064/wt.pl?p=212,&amp;ov=&amp;cr=&amp;oi=&amp;ba=&amp;co=&amp;qn=&amp;ca=&amp;pi=&amp;st=&amp;cd=&amp;cg=" height="1" width="1" alt="" /></div>
</noscript>
<!-- /Webtrekk -->
        <meta charset="utf-8"/>
        <title><?php wp_title(); ?></title>
        <script type="text/javascript">
            var templateUrl = "<?php echo get_template_directory_uri(); ?>";
        </script>
        <?php wp_head(); ?>

    </head>
    <body <?php body_class(); ?>>
        <div class="container">

            <div class="pos-f-t d-block d-md-none ">

                <nav class="navbar p-0 mt-3">
                    <button class="navbar-toggler mb-4" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars" style="color: #000;"></span>
                    </button>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/header-logo-mobile.png" alt="Seadstem Logo Small" style="margin: 0 auto; height: 33px; width:176px; display: block; margin-bottom: 20px;">
                </nav>
                <div class="collapse" id="navbarToggleExternalContent">
                    <div class="px-4 py-2">
                        <?php //wp_nav_menu(['theme_location' => 'collapsed-header']); ?>
                        <?php wp_nav_menu(['theme_location' => 'left-header']); ?>
                        <?php wp_nav_menu(['theme_location' => 'right-header']); ?>
                        <div class="clearfix"></div>
                        <div id="widget-side-bars-mobile" class="widgets-area-mobile">
                            <?php dynamic_sidebar('widget-container-2'); ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


            <div class="d-none d-md-block">
                <div class="row" id="header-nav">
                    <div class="col-xs-12 col-sm-5 pt-4" id="header-left">
                        <?php wp_nav_menu(['theme_location' => 'left-header']); ?>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <?php
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        if (has_custom_logo()) {
                            $link = get_category_link(pll_get_term(12,pll_current_language()));
                            echo '<a href="'.$link.'"><img src="' . esc_url($logo[0]) . '" class="img-fluid" id="logo"></a>';
                        } else {
                            echo '<h1>' . get_bloginfo('name') . '</h1>';
                        }
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 pt-4" id="header-right">
                        <?php get_sidebar(); ?>
                        <div class="clearfix"></div>
                        <?php wp_nav_menu(['theme_location' => 'right-header']); ?>
                    </div>

                </div>
            </div>
            <!--
            <div class="d-block d-md-none header-mobile">
                <div class="row">
                    <div class="col-sm-1">
                        <div id="header-nav-small">
                            <div class="dropdown" style="display: inline-block">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fa fa-align-justify"></span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php //wp_nav_menu(['theme_location' => 'collapsed-header']); ?>
                                    <?php wp_nav_menu(['theme_location' => 'left-header']); ?>
                                    <?php wp_nav_menu(['theme_location' => 'right-header']); ?>
                                    <div class="clearfix"></div>
                                    <div id="widget-side-bars" class="widgets-area">
                                        <?php dynamic_sidebar('widget-container-1'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-11">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/header-logo-mobile.png" alt="Seadstem Logo Small" style="margin: 0 auto; height: 33px; width:176px; display: block; ">
                    </div>

                </div>
            </div>
            -->

        </div>

