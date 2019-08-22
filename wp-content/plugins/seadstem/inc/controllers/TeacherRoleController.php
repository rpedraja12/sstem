<?php

namespace Inc\controllers;

class TeacherRoleController {

    public $custom_post_types = [];
    public static $POST_TYPE_SLUG = 'ecertificate';

    public function __construct() {
        ;
    }

    public function register() {

        //remove admin bar
        add_filter('show_admin_bar', [$this, 'removeAdminToolBar']);
        //block user access for teacher on admin module
        add_action('admin_init', [$this, 'blockTeacherToAdminModules']);

        add_role('teacher', __("Teacher"), ['delete_posts' => true, 'delete_posts' => true,
            'delete_published_posts' => true, 'edit_posts' => true, 'edit_published_posts' => true,
            'publish_posts' => true, 'read' => true, 'upload_files' => true,]);
    }

    public function removeAdminToolBar() {
        if (!current_user_can('teacher')) {
            return false;
        }
        return $show;
    }

    public function blockTeacherToAdminModules() {
        $user = wp_get_current_user();
        $roles = (array) $user->roles;
//        var_dump($roles);
//        if (in_array('teacher', $roles) && !( defined('DOING_AJAX') && DOING_AJAX )) {
//            wp_safe_redirect(home_url());
//            exit;
//        }
    }

}
