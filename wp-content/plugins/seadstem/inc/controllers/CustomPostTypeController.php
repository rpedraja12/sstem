<?php

namespace Inc\controllers;

class CustomPostTypeController {

    public $custom_post_types = [];
    public static $POST_TYPE_SLUG = 'ecertificate';

    public function __construct() {
        ;
    }

    public function register() {
        $this->registerCPT();
        add_action('init', [$this, 'registerCustomPostTypes']);
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post', [$this, 'save_meta_box']);
    }

    public function registerCPT() {
        $options = [
            'post_type' => 'ecertificate',
            'plural_name' => 'Certificate Files',
            'singular_name' => 'Certificate file',
            'public' => true,
            'has_archive' => false,
        ];
        $this->custom_post_types[] = array(
            'post_type' => $options['post_type'],
            'name' => $options['plural_name'],
            'singular_name' => $options['singular_name'],
            'menu_name' => $options['plural_name'],
            'name_admin_bar' => $options['singular_name'],
            'archives' => $options['singular_name'] . ' Archives',
            'attributes' => $options['singular_name'] . ' Attributes',
            'parent_item_colon' => 'Parent ' . $options['singular_name'],
            'all_items' => 'All ' . $options['plural_name'],
            'add_new_item' => 'Add New ' . $options['singular_name'],
            'add_new' => 'Add New',
            'new_item' => 'New ' . $options['singular_name'],
            'edit_item' => 'Edit ' . $options['singular_name'],
            'update_item' => 'Update ' . $options['singular_name'],
            'view_item' => 'View ' . $options['singular_name'],
            'view_items' => 'View ' . $options['plural_name'],
            'search_items' => 'Search ' . $options['plural_name'],
            'not_found' => 'No ' . $options['singular_name'] . ' Found',
            'not_found_in_trash' => 'No ' . $options['singular_name'] . ' Found in Trash',
            'featured_image' => 'Featured Image',
            'set_featured_image' => 'Set Featured Image',
            'remove_featured_image' => 'Remove Featured Image',
            'use_featured_image' => 'Use Featured Image',
            'insert_into_item' => 'Insert into ' . $options['singular_name'],
            'uploaded_to_this_item' => 'Upload to this ' . $options['singular_name'],
            'items_list' => $options['plural_name'] . ' List',
            'items_list_navigation' => $options['plural_name'] . ' List Navigation',
            'filter_items_list' => 'Filter' . $options['plural_name'] . ' List',
            'label' => $options['singular_name'],
            'description' => $options['plural_name'] . 'Custom Post Type',
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'taxonomies' => array('category', 'post_tag'),
            'hierarchical' => true,
            'public' => $options['public'],
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => $options['has_archive'],
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'post'
        );
    }

    public function registerCustomPostTypes() {
        foreach ($this->custom_post_types as $post_type) {
            register_post_type($post_type['post_type'], array(
                'labels' => array(
                    'name' => $post_type['name'],
                    'singular_name' => $post_type['singular_name'],
                    'menu_name' => $post_type['menu_name'],
                    'name_admin_bar' => $post_type['name_admin_bar'],
                    'archives' => $post_type['archives'],
                    'attributes' => $post_type['attributes'],
                    'parent_item_colon' => $post_type['parent_item_colon'],
                    'all_items' => $post_type['all_items'],
                    'add_new_item' => $post_type['add_new_item'],
                    'add_new' => $post_type['add_new'],
                    'new_item' => $post_type['new_item'],
                    'edit_item' => $post_type['edit_item'],
                    'update_item' => $post_type['update_item'],
                    'view_item' => $post_type['view_item'],
                    'view_items' => $post_type['view_items'],
                    'search_items' => $post_type['search_items'],
                    'not_found' => $post_type['not_found'],
                    'not_found_in_trash' => $post_type['not_found_in_trash'],
                    'featured_image' => $post_type['featured_image'],
                    'set_featured_image' => $post_type['set_featured_image'],
                    'remove_featured_image' => $post_type['remove_featured_image'],
                    'use_featured_image' => $post_type['use_featured_image'],
                    'insert_into_item' => $post_type['insert_into_item'],
                    'uploaded_to_this_item' => $post_type['uploaded_to_this_item'],
                    'items_list' => $post_type['items_list'],
                    'items_list_navigation' => $post_type['items_list_navigation'],
                    'filter_items_list' => $post_type['filter_items_list']
                ),
                'label' => $post_type['label'],
                'description' => $post_type['description'],
                'supports' => $post_type['supports'],
                'taxonomies' => $post_type['taxonomies'],
                'hierarchical' => $post_type['hierarchical'],
                'public' => $post_type['public'],
                'show_ui' => $post_type['show_ui'],
                'show_in_menu' => $post_type['show_in_menu'],
                'menu_position' => $post_type['menu_position'],
                'show_in_admin_bar' => $post_type['show_in_admin_bar'],
                'show_in_nav_menus' => $post_type['show_in_nav_menus'],
                'can_export' => $post_type['can_export'],
                'has_archive' => $post_type['has_archive'],
                'exclude_from_search' => $post_type['exclude_from_search'],
                'publicly_queryable' => $post_type['publicly_queryable'],
                'capability_type' => $post_type['capability_type']
                    )
            );
        }
    }

    public function add_meta_boxes() {
        add_meta_box('certificate_personal_info', "Certificate Info", [$this, 'render_personal_info'], 'ecertificate', 'normal', 'default');
        add_meta_box('certificate_parent_operation', "Certificate Operations", [$this, 'render_certificate_operation'], 'ecertificate', 'side', 'default');
    }

    public function render_certificate_operation($post) {
        ?>
        <p>
            <label class="meta-label" for="ecertificate_personal_prefix">Delete Certificates</label>
            <a href="<?php echo esc_url(admin_url('admin-post.php')); ?>?action=delete_certificates&id=<?php echo $post->ID;?>" class="button button-primary button-large">Delete Certificates</a>
        </p>
        <?php
    }

    public function render_personal_info($post) {

        wp_nonce_field('ecertificate_personal_info', 'ecertificate_personal_info_nonce');
        $data = get_post_meta($post->ID, '_seameo_ecertificate_personal_info_key', true);
        $prefix = isset($data['prefix']) ? $data['prefix'] : '';
        $first_name = isset($data['first_name']) ? $data['first_name'] : '';
        $last_name = isset($data['last_name']) ? $data['last_name'] : '';
        $middle_name = isset($data['middle_name']) ? $data['middle_name'] : '';
        $suffix = isset($data['suffix']) ? $data['suffix'] : '';
        $email = isset($data['email']) ? $data['email'] : '';
        $certificate_code = isset($data['certificate_code']) ? $data['certificate_code'] : '';
        $certificate_template = isset($data['certificate_template']) ? $data['certificate_template'] : '';
        ?>
        <p>
            <label class="meta-label" for="ecertificate_personal_prefix">Prefix</label>
            <input type="text" id="ecertificate_personal_info_prefix" name="ecertificate_personal_info_prefix" class="widefat" value="<?php echo esc_attr($prefix); ?>">
        </p>
        <p>
            <label class="meta-label" for="ecertificate_personal_info_first_name">First Name</label>
            <input type="text" id="ecertificate_personal_info_first_name" name="ecertificate_personal_info_first_name" class="widefat" value="<?php echo esc_attr($first_name); ?>">
        </p>
        <p>
            <label class="meta-label" for="ecertificate_personal_info_middle_name">Middle Name</label>
            <input type="text" id="ecertificate_personal_info_middle_name" name="ecertificate_personal_info_middle_name" class="widefat" value="<?php echo esc_attr($middle_name); ?>">
        </p>
        <p>
            <label class="meta-label" for="ecertificate_personal_info_last_name">Last Name</label>
            <input type="text" id="ecertificate_personal_info_last_name" name="ecertificate_personal_info_last_name" class="widefat" value="<?php echo esc_attr($last_name); ?>">
        </p>
        <p>
            <label class="meta-label" for="ecertificate_personal_info_suffix">Suffix</label>
            <input type="text" id="ecertificate_personal_info_suffix" name="ecertificate_personal_info_suffix" class="widefat" value="<?php echo esc_attr($suffix); ?>">
        </p>
        <p>
            <label class="meta-label" for="ecertificate_personal_info_email">Email</label>
            <input type="text" id="ecertificate_personal_info_email" name="ecertificate_personal_info_email" class="widefat" value="<?php echo esc_attr($email); ?>">
        </p>
        <p>
            <label class="meta-label" for="ecertificate_personal_info_certificate_code">Certificate Code</label>
            <input type="text" id="ecertificate_personal_info_certificate_code" name="ecertificate_personal_info_certificate_code" class="widefat" value="<?php echo esc_attr($certificate_code); ?>">
        </p>
        <hr/>
        <p>
            <label class="meta-label" for="ecertificate_personal_info_certificate_template"><h3>Certificate Template</h3></label>
            <input type="text" id="ecertificate_personal_info_certificate_template" name="ecertificate_personal_info_certificate_template" class="widefat" value="<?php echo esc_attr($certificate_template); ?>">
        </p>
        <label class="meta-label" for="mettaabox_ID"><h3>Verification Page</h3></label>
        <?php
        $text = isset($data['txtVerificationPage']) ? $data['txtVerificationPage'] : '';
        wp_editor(htmlspecialchars_decode($text), 'mettaabox_ID', $settings = array('textarea_name' => 'txtVerificationPage'));
        ?>
        <label class="meta-label" for="mettaabox_IDD"><h3>Certificate Body</h3></label>
        <a href="preview">preview</a>
        <?php
        $certificateBody = isset($data['txtCertificateBody']) ? $data['txtCertificateBody'] : '';
        wp_editor(htmlspecialchars_decode($certificateBody), 'mettaabox_IDD', $settings = array('textarea_name' => 'txtCertificateBody'));
    }

    public function save_meta_box($post_id) {
        if (!isset($_POST['ecertificate_personal_info_nonce'])) {
            return $post_id;
        }
        $nonce = $_POST['ecertificate_personal_info_nonce'];
        if (!wp_verify_nonce($nonce, 'ecertificate_personal_info')) {
            return $post_id;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
        $txtVerificationPage = '';
        if (!empty($_POST['txtVerificationPage'])) {
            $txtVerificationPage = htmlspecialchars($_POST['txtVerificationPage']); //make sanitization more strict !!
        }
        $txtCertificateBody = '';
        if (!empty($_POST['txtCertificateBody'])) {
            $txtCertificateBody = htmlspecialchars($_POST['txtCertificateBody']); //make sanitization more strict !!
        }
        $data = array(
            'prefix' => sanitize_text_field($_POST['ecertificate_personal_info_prefix']),
            'first_name' => sanitize_text_field($_POST['ecertificate_personal_info_first_name']),
            'middle_name' => sanitize_text_field($_POST['ecertificate_personal_info_middle_name']),
            'last_name' => sanitize_text_field($_POST['ecertificate_personal_info_last_name']),
            'suffix' => sanitize_text_field($_POST['ecertificate_personal_info_suffix']),
            'email' => sanitize_text_field($_POST['ecertificate_personal_info_email']),
            'certificate_code' => sanitize_text_field($_POST['ecertificate_personal_info_certificate_code']),
            'certificate_template' => sanitize_text_field($_POST['ecertificate_personal_info_certificate_template']),
            'txtVerificationPage' => $txtVerificationPage,
            'txtCertificateBody' => $txtCertificateBody,
//			'email' => sanitize_text_field( $_POST['alecaddd_testimonial_email'] ),
//			'approved' => isset($_POST['alecaddd_testimonial_approved']) ? 1 : 0,
//			'featured' => isset($_POST['alecaddd_testimonial_featured']) ? 1 : 0,
        );
        update_post_meta($post_id, '_seameo_ecertificate_personal_info_key', $data);
    }

}
