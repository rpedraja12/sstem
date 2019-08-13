<!-- description -->
<div class="mt-4">
    <div class="row bg-lblue toggle-bar my-2 py-1">
        <div class="col-sm-12">
            <span class="t-white" >
                <?php pll_e('Introduction/Description'); ?> 
            </span>
        </div>
    </div>
    <div id="description-container" class="row">
        <div class="col-sm-12 p-3">
            <?php echo get_post_meta(get_the_ID(), 'wpcf-introduction-description', true); ?>
        </div>

    </div>
</div>


<!-- videos -->
<?php
$fieldName = 'wpcf-videos';
$output = get_post_meta(get_the_ID(), $fieldName, true);
?>
<?php if (!empty($output)): ?>
    <div class="row mt-4">
        <div class="col-sm-12">
            <h2><?php pll_e('Videos'); ?></h2>
            <?php echo $output; ?>
        </div>
    </div>
<?php endif; ?>
<!-- Audio -->
<?php
$fieldName = 'wpcf-audio';
$output = get_post_meta(get_the_ID(), $fieldName, true);
?>
<?php if (!empty($output)): ?>
    <div class="row mt-4">
        <div class="col-sm-12">
            <h2><?php pll_e('Audio'); ?></h2>
            <?php echo $output; ?>
        </div>
    </div>
<?php endif; ?>