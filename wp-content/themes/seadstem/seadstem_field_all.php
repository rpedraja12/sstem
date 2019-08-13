
<!-- description -->
<div class="mt-4">
    <div class="row bg-lblue toggle-bar my-2 py-1">
        <div class="col-sm-12">
            <a class="btn-toggle" data-toggle="collapse" data-target="#description-container" href="#" role="button" aria-expanded="true">
                <?php pll_e('Introduction/Description'); ?> <span class="fa fa-plus float-right" style="margin-top: 5px;"></span>
            </a>
        </div>
    </div>
    <div id="description-container" class="row collapse">
        <div class="col-sm-12 p-3">
            <?php echo get_post_meta(get_the_ID(), 'wpcf-introduction-description', true); ?>
        </div>

    </div>
</div>
<!-- Key Objectives -->
<?php
$fieldName = 'wpcf-key-objectives-goals';
$output = get_post_meta(get_the_ID(), $fieldName, true);
if (!empty($output)):
    ?>
    <div>
        <div class="row bg-lblue toggle-bar my-2 py-1">
            <div class="col-sm-12">
                <a class="btn-toggle" data-toggle="collapse" data-target="#<?php echo $fieldName; ?>-container" href="#" role="button" aria-expanded="true">
                    <?php pll_e('Key Objectives(Goals)'); ?> <span class="fa fa-plus float-right" style="margin-top: 5px;"></span>
                </a>
            </div>
        </div>
        <div id="<?php echo $fieldName; ?>-container" class="row collapse">
            <div class="col-sm-12 p-3 f-arial">
                <?php echo $output; ?>
            </div>

        </div>
    </div>
<?php endif; ?>

<!-- Tutorials -->
<?php
$fieldName = 'wpcf-tutorial';
$output = get_post_meta(get_the_ID(), $fieldName, true);
if (!empty($output)):
    ?>
    <div>
        <div class="row bg-lblue toggle-bar my-2 py-1">
            <div class="col-sm-12">
                <a class="btn-toggle" data-toggle="collapse" data-target="#<?php echo $fieldName; ?>-container" href="#" role="button" aria-expanded="true">
                    <?php pll_e('Tutorial'); ?> <span class="fa fa-plus float-right" style="margin-top: 5px;"></span>
                </a>
            </div>
        </div>
        <div id="<?php echo $fieldName; ?>-container" class="row collapse">
            <div class="col-sm-12 p-3 f-arial">
                <?php echo $output; ?>
            </div>

        </div>
    </div>
<?php endif; ?>

<!-- Materials -->
<?php
$fieldName = 'wpcf-materials';
$output = get_post_meta(get_the_ID(), $fieldName, true);
if (!empty($output)):
    ?>
    <div>
        <div class="row bg-lblue toggle-bar my-2 py-1">
            <div class="col-sm-12">
                <a class="btn-toggle" data-toggle="collapse" data-target="#<?php echo $fieldName; ?>-container" href="#" role="button" aria-expanded="true">
                    <?php pll_e('Materials'); ?> <span class="fa fa-plus float-right" style="margin-top: 5px;"></span>
                </a>
            </div>
        </div>
        <div id="<?php echo $fieldName; ?>-container" class="row collapse">
            <div class="col-sm-12 p-3 f-arial">
                <?php echo $output; ?>
            </div>

        </div>
    </div>
<?php endif; ?>

<!-- Safety Instructions -->
<?php
$fieldName = 'wpcf-safety-instructions';
$output = get_post_meta(get_the_ID(), $fieldName, true);
if (!empty($output)):
    ?>
    <div>
        <div class="row bg-lblue toggle-bar my-2 py-1">
            <div class="col-sm-12">
                <a class="btn-toggle" data-toggle="collapse" data-target="#<?php echo $fieldName; ?>-container" href="#" role="button" aria-expanded="true">
                    <?php pll_e('Safety Instructions'); ?> <span class="fa fa-plus float-right" style="margin-top: 5px;"></span>
                </a>
            </div>
        </div>
        <div id="<?php echo $fieldName; ?>-container" class="row collapse">
            <div class="col-sm-12 p-3 f-arial">
                <?php echo $output; ?>
            </div>

        </div>
    </div>
<?php endif; ?>


<!-- Guiding Questions -->
<?php
$fieldName = 'wpcf-guiding-questions';
$output = get_post_meta(get_the_ID(), $fieldName, true);
if (!empty($output)):
    ?>
    <div>
        <div class="row bg-lblue toggle-bar my-2 py-1">
            <div class="col-sm-12">
                <a class="btn-toggle" data-toggle="collapse" data-target="#<?php echo $fieldName; ?>-container" href="#" role="button" aria-expanded="true">
                    <?php pll_e('Guiding Questions'); ?> <span class="fa fa-plus float-right" style="margin-top: 5px;"></span>
                </a>
            </div>
        </div>
        <div id="<?php echo $fieldName; ?>-container" class="row collapse">
            <div class="col-sm-12 p-3 f-arial">
                <?php echo $output; ?>
            </div>

        </div>
    </div>
<?php endif; ?>


<!-- Task Activities -->
<?php
$fieldName = 'wpcf-tasks-activities';
$output = get_post_meta(get_the_ID(), $fieldName, true);
if (!empty($output)):
    ?>
    <div>
        <div class="row bg-lblue toggle-bar my-2 py-1">
            <div class="col-sm-12">
                <a class="btn-toggle" data-toggle="collapse" data-target="#<?php echo $fieldName; ?>-container" href="#" role="button" aria-expanded="true">
                    <?php pll_e('Tasks/Activities'); ?> <span class="fa fa-plus float-right" style="margin-top: 5px;"></span>
                </a>
            </div>
        </div>
        <div id="<?php echo $fieldName; ?>-container" class="row collapse">
            <div class="col-sm-12 p-3 f-arial">
                <?php echo $output; ?>
            </div>

        </div>
    </div>
<?php endif; ?>

<!-- Assesment/Evaluation -->
<?php
$fieldName = 'wpcf-assesment-evaluation';
$output = get_post_meta(get_the_ID(), $fieldName, true);
if (!empty($output)):
    ?>
    <div>
        <div class="row bg-lblue toggle-bar my-2 py-1">
            <div class="col-sm-12">
                <a class="btn-toggle" data-toggle="collapse" data-target="#<?php echo $fieldName; ?>-container" href="#" role="button" aria-expanded="true">
                    <?php pll_e('Assesment/Evaluation'); ?> <span class="fa fa-plus float-right" style="margin-top: 5px;"></span>
                </a>
            </div>
        </div>
        <div id="<?php echo $fieldName; ?>-container" class="row collapse">
            <div class="col-sm-12 p-3 f-arial">
                <?php echo $output; ?>
            </div>

        </div>
    </div>
<?php endif; ?>

<!-- Cost -->
<?php
$fieldName = 'wpcf-costs';
$output = get_post_meta(get_the_ID(), $fieldName, true);
if (!empty($output)):
    ?>
    <div>
        <div class="row bg-lblue toggle-bar my-2 py-1">
            <div class="col-sm-12">
                <a class="btn-toggle" data-toggle="collapse" data-target="#<?php echo $fieldName; ?>-container" href="#" role="button" aria-expanded="true">
                    <?php pll_e('Costs'); ?> <span class="fa fa-plus float-right" style="margin-top: 5px;"></span>
                </a>
            </div>
        </div>
        <div id="<?php echo $fieldName; ?>-container" class="row collapse">
            <div class="col-sm-12 p-3 f-arial">
                <?php echo $output; ?>
            </div>

        </div>
    </div>
<?php endif; ?>


<!-- Cost -->
<?php
$fieldName = 'wpcf-length';
$output = get_post_meta(get_the_ID(), $fieldName, true);
if (!empty($output)):
    ?>
    <div>
        <div class="row bg-lblue toggle-bar my-2 py-1">
            <div class="col-sm-12">
                <a class="btn-toggle" data-toggle="collapse" data-target="#<?php echo $fieldName; ?>-container" href="#" role="button" aria-expanded="true">
                    <?php pll_e('Length'); ?> <span class="fa fa-plus float-right" style="margin-top: 5px;"></span>
                </a>
            </div>
        </div>
        <div id="<?php echo $fieldName; ?>-container" class="row collapse">
            <div class="col-sm-12 p-3 f-arial">
                <?php echo $output; ?>
            </div>

        </div>
    </div>
<?php endif; ?>

<!-- videos -->
<?php
$fieldName = 'wpcf-videos';
$output = get_post_meta(get_the_ID(), $fieldName, true);
?>
<?php if (!empty($output)): ?>
    <div class="row mt-4">
        <div class="col-sm-12">
            <h2><?php pll_e('Video'); ?></h2>
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