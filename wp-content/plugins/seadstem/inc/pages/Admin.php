<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Inc\pages;

/**
 * Description of AdminPages
 *
 * @author rpedraja
 */
class Admin {

    public function __construct() {
        
    }

    public function register() {
        add_action('admin_menu', [$this, 'add_admin_pages']);

        add_action('admin_post_upload_certificate_csv', [$this, 'process_upload_certificate_csv']);
        add_action('admin_post_delete_certificates', [$this, 'process_delete_certificates']);
        add_action('admin_post_generate_qr_code', [$this, 'process_generate_ecertificate_qr_code']);
        add_action('admin_post_nopriv_generate_qr_code', [$this, 'process_generate_ecertificate_qr_code']);
    }

    public function add_admin_pages() {
        $pages = [
            [
                'page_title' => 'e-Certificate Settings',
                "menu_title" => 'e-Certificate',
                "capability" => 'manage_options',
                "menu_slug" => 'e_certificate_settings',
                "callback" => [$this, 'admin_index'],
                "icon_url" => 'dashicons-id-alt',
                "position" => null
            ],
        ];
        $pages_sub = [
            [
                'parent_slug' => 'e_certificate_settings',
                'page_title' => 'e-Certificate Certicates',
                "menu_title" => 'e-Certificates',
                "capability" => 'manage_options',
                "menu_slug" => 'e_certificate_settings',
                "callback" => [$this, 'admin_index'],
                "icon_url" => 'dashicons-id-alt',
                "position" => null
            ],
            [
                'parent_slug' => 'e_certificate_settings',
                'page_title' => 'e-Certificate Certicates list',
                "menu_title" => 'e-Certificates List',
                "capability" => 'manage_options',
                "menu_slug" => 'e_certificate_list',
                "callback" => [$this, 'admin_index'],
                "icon_url" => 'dashicons-id-alt',
                "position" => null
            ],
            [
                'parent_slug' => 'e_certificate_settings',
                'page_title' => 'e-Certificate Certicates Upload',
                "menu_title" => 'e-Certificates Upload',
                "capability" => 'manage_options',
                "menu_slug" => 'e_certificate_upload',
                "callback" => [$this, 'admin_upload'],
                "icon_url" => 'dashicons-id-alt',
                "position" => null
            ],
        ];

        foreach ($pages as $page) {
            add_menu_page($page['page_title'], $page["menu_title"], $page["capability"], $page["menu_slug"], $page["callback"], $page["icon_url"], $page["position"]);
        }
        foreach ($pages_sub as $page) {
            add_submenu_page($page['parent_slug'], $page['page_title'], $page["menu_title"], $page["capability"], $page["menu_slug"], $page["callback"], $page["icon_url"], $page["position"]);
        }
    }

    public function admin_index() {
        //page that will laod on menu_page
        require_once PLUGIN_PATH . 'template/settings.php';
    }

//    public function settings_link($links) {
//        $settings_link = '<a href="admin.php?page=e_recruitment_settings">settings</a>';
//        array_push($links, $settings_link);
//        return $links;
//    }

    public function admin_upload() {
        //page that will laod on menu_page
        require_once PLUGIN_PATH . 'template/upload.php';
    }

    public function process_delete_certificates() {
        $args = array(
            'post_parent' => $_GET['id'],
            'post_type' => 'any',
            'numberposts' => -1,
            'post_status' => 'any'
        );
        $children = get_children($args);
        /* @var  $post \WP_Post */
        foreach ($children as $post) {
            echo 'DELETING: ';
            echo 'ID: ' . $post->ID . ' ;' . $post->post_title . '<br/>';
            wp_delete_post($post->ID);
        }
    }

    public function process_upload_certificate_csv() {

        $fp = fopen($_FILES['csv_file']['tmp_name'], 'rb');

        while (($line = fgets($fp)) !== false) {
            $content = str_getcsv($line);


            $fullName = $content[1] . ' ' . $content[2] . ' ' . $content[3];
            $post_name = sha1($fullName);
            $post = [
                'post_content' => $fullName,
                'post_title' => $fullName,
                'post_type' => \Inc\controllers\CustomPostTypeController::$POST_TYPE_SLUG,
                'post_parent' => $_POST['certificate_post'],
                'post_name' => $post_name,
                'meta_input' => [
                    '_seameo_ecertificate_personal_info_key' => [
                        'prefix' => trim($content[0]),
                        'first_name' => trim($content[1]),
                        'middle_name' => trim($content[2]),
                        'last_name' => trim($content[3]),
                        'suffix' => trim($content[4]),
                        'certificate_code' => trim($content[5]),
                        'email' => trim($content[6]),
                    ],
                ],
            ];
//            var_dump($post['meta_input']['_seameo_ecertificate_personal_info_key']);

            wp_insert_post($post);
        }

        fclose($fp);

        wp_redirect(admin_url());
//        echo 'here';
        exit;
    }

    public function process_generate_ecertificate_qr_code() {
        $post_id = $_GET['post_id'];
        $post = get_post($post_id);
//        echo 'hahaha';

        if (file_exists(PLUGIN_PATH . '/ext/phpqrcode/phpqrcode.php')) {
            require_once PLUGIN_PATH . '/ext/phpqrcode/phpqrcode.php';
        }
        $parent = get_post(get_post_ancestors($post)[0]);
        $template_file = get_post_meta($parent->ID, '_seameo_ecertificate_personal_info_key', true)['certificate_template'];
//        $certificateUrl = get_permalink($post) . '?template=certificate&certificate_template=' . $template_file;
        $certificateUrl = get_permalink($post);

        \QRcode::png($certificateUrl);
        exit;
    }

}
