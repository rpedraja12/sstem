
<h1>Upload CSV to eCertificate</h1>
<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="upload_certificate_csv">
    <div class="form-group">
        <label for="fullname">Full Name</label>
        <select class="form-control" name="certificate_post">
            <?php
            $args = array(
                'cat' => $category_id,
                'post_type' => ['ecertificate'],
                'post_parent' => 0
            );
            $certificates = new WP_Query($args);
            while ($certificates->have_posts()) {
                $certificates->the_post();
                echo '<option value="'.  get_the_ID().'">'.  get_the_title().'</option>';
            }
            wp_reset_postdata();
            ?>
            
        </select>
    </div>
    <div class="form-group">
        <label for="fullname">CSV File</label>
        <input type="file" name="csv_file" class="form-control">
    </div>

    <input type="submit" value="Upload CSV" class="btn btn-primary">
</form>