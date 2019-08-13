    
<footer class="bg-blue">
    <div class="container">
        <div class="d-none d-md-block">
            <div class="row">
                <div class="col-xs-12 col-md-5 t-small t-white" id="footer-left">
                    <?php wp_nav_menu(['theme_location' => 'left-footer']); ?>
                </div>
                <div class="col-xs-12 col-md-2">
                    <?php dynamic_sidebar('widget-footer-image-container-1'); ?>
                </div>
                <div class="col-xs-12 col-md-5 t-white" id="footer-right">
                    <?php dynamic_sidebar('widget-footer-container-1'); ?>
                    <?php wp_nav_menu(['theme_location' => 'right-footer']); ?>
                </div>
            </div>
        </div>
        <!-- mobile -->
        <div class="d-block d-md-none">
            <div class="row footer-mobile">
                <div class="col-sm-12 t-small t-white center">
                    <?php wp_nav_menu(['theme_location' => 'left-footer']); ?>
                </div>
                <div class="col-sm-12 t-white">
                    <?php dynamic_sidebar('widget-footer-container-1'); ?>
                    <?php wp_nav_menu(['theme_location' => 'right-footer']); ?>
                </div>
                <div class="col-sm-12">
                    <?php dynamic_sidebar('widget-footer-image-container-1'); ?>
                </div>

            </div>
        </div>
        <!-- mobile -->
    </div>
</footer>
</body>
</html>
<?php wp_footer(); ?>